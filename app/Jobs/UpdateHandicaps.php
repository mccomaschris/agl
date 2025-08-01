<?php

namespace App\Jobs;

use App\Models\Player;
use App\Models\Score;
use App\Models\Week;
use App\Models\Team;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UpdateHandicaps implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $player;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Calculate the Handicap
     *
     * @return $hc
     */
    public function calc($scores, $scores_to_count = 0, $qtr = null) {
        if (count($scores) == 0) {
			return 0;
		}

        $total_scores = count($scores);
        $half_scores = round($total_scores / 2, 0);
        asort($scores, SORT_NUMERIC);

		# if i count 8 scores, but i only have 7 so far, use 7
		$deno = $half_scores;

        $total_score = (array_sum(array_slice($scores, 0, $half_scores, true)));

		$sum = ($total_score / $deno);
		Log::debug('Sum: ' . $sum);
        $hc = round($sum - 37);
        return $hc;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $player = $this->player;

        $year = Year::where('active', 1)->first();

        $current_week = Week::where('year_id', $year->id)
            ->where('week_date', '<=', Carbon::yesterday())
            ->orderBy('week_order', 'desc')
            ->first();

        $qtr_1_scores = [];
        $qtr_2_scores = [];
        $qtr_3_scores = [];
        $qtr_4_scores = [];
        $total_scores = [];

		$weeks = Week::where('year_id', $year->id)->where('back_nine', false)->where('week_date', '<=', Carbon::yesterday())->pluck('id');

        $scores = Score::with('week')->whereIn('foreign_key', $weeks)->where('score_type', 'weekly_score')->where('player_id', $player->id)
                    ->where('gross', '>', 0)
                    ->where('absent', false)
                    ->where('substitute_id', false)
                    ->get();

        foreach ($scores as $score) {
            switch ($score->week->week_order) {
                case in_array($score->week->week_order, range(1, 5)):
                    array_push($qtr_1_scores, $score->gross);
                case in_array($score->week->week_order, range(1, 10)):
                    array_push($qtr_2_scores, $score->gross);
                case in_array($score->week->week_order, range(1, 15)):
                    array_push($qtr_3_scores, $score->gross);
                case in_array($score->week->week_order, range(1, 20)):
                    array_push($qtr_4_scores, $score->gross);
            }
        }

        $player->hc_second = $this->calc($qtr_1_scores, 3, '2');
        $player->hc_third = $this->calc($qtr_2_scores, 5, '3');
        $player->hc_fourth = $this->calc($qtr_3_scores, 8, '4');
        $player->hc_playoff = $this->calc($qtr_4_scores, 10, 'po');
        $player->hc_18 = round($player->hc_playoff * 1.5);

        if (count($qtr_4_scores) == 0) {
            $player->hc_next_year = 0;
        } else {
            $player->hc_next_year = round((array_sum($qtr_4_scores) / count($qtr_4_scores)) - 37);
        }

        // Calculate Full Handicap for 1-4 rankings
        $total_scores = count($qtr_4_scores);

        if ( $player->id === 159) {
            $counted_scores = 8;
        } else {
            $counted_scores = round($total_scores / 2, 0);
        }
        asort($qtr_4_scores, SORT_NUMERIC);

        $total_score = (array_sum(array_slice($qtr_4_scores, 0, $counted_scores, true)));
        if ($counted_scores == 0) {
            $player->hc_full = 0;
        } else {
            $player->hc_full = ($total_score / $counted_scores) - 37;
        }

        switch ($current_week->week_order) {
            case in_array($current_week->week_order, range(1, 4)):
                $player->hc_current = $player->hc_first;
                break;
            case in_array($current_week->week_order, range(5, 9)):
                $player->hc_current = $player->hc_second;
                break;
            case in_array($current_week->week_order, range(10, 14)):
                $player->hc_current = $player->hc_third;
                break;
            case in_array($current_week->week_order, range(15, 20)):
                $player->hc_current = $player->hc_fourth;
                break;
            default:
                $player->hc_current = $player->hc_first;
        }

		$absences = Score::where('player_id', $player->id)->where('absent', true)->where('substitute_id', 0)->count();

		Log::info($player->user->name . ' Absences: ' . $absences);

		// Calculate hc_ten with absence-adjusted denominator
		$gross_scores = $scores->pluck('gross')->toArray();
		sort($gross_scores, SORT_NUMERIC);

		$played_rounds = count($gross_scores);

		// Only apply absence rule if player has 10 or more rounds
		if ($played_rounds >= 10) {
			$absences = Score::where('player_id', $player->id)
				->where('absent', true)
				->where('substitute_id', 0)
				->count();

			if ($absences <= 1) {
				$deno = 10;
			} elseif ($absences <= 3) {
				$deno = 9;
			} elseif ($absences <= 5) {
				$deno = 8;
			} else {
				$deno = 10; // Optional: fallback if absences are too high
			}
		} else {
			$deno = $played_rounds;
		}

		// Get lowest scores to use
		$lowest_scores = array_slice($gross_scores, 0, $deno);
		$player->hc_ten = $deno > 0 ? (array_sum($lowest_scores) / $deno) - 37 : 0;

        $player->save();

        $teams = Team::where('year_id', $year->id)->pluck('id');
        $players = Player::whereIn('team_id', $teams)->where('substitute', '0')->orderBy('hc_full', 'asc')->get();

        $prev = 400;
        $rank = 0;
        $count = 0;

        foreach ($players as $player) {
            $count++;

            if ($player->hc_full == $prev) {
                $player->hc_full_rank = $rank;
            } else {
                $player->hc_full_rank = $count;
                $rank = $count;
            }

            $prev = $player->hc_full;
            $player->save();
        }

		$players = Player::whereIn('team_id', $teams)->where('substitute', '0')->orderBy('hc_ten', 'asc')->get();

		$prev = 400;
		$rank = 0;
		$count = 0;

		foreach ($players as $player) {
			$count++;

			if ($player->hc_ten == $prev) {
				$player->hc_ten_rank = $rank;
			} else {
				$player->hc_ten_rank = $count;
				$rank = $count;
			}

			$prev = $player->hc_ten;
			$player->save();
		}
    }
}
