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
    public function calc($scores, $scores_to_count = 0) {
        if (count($scores) == 0) {
			return 0;
		}
        $total_scores = count($scores);
        $half_scores = round($total_scores / 2, 0);
        asort($scores, SORT_NUMERIC);

		# if i count 8 scores, but i only have 7 so far, use 7
		if ( $total_scores < $scores_to_count) {
			$deno = $total_scores;
		} else {
			$deno = $scores_to_count;
		}

        $total_score = (array_sum(array_slice($scores, 0, $scores_to_count, true)));
        $hc = round(($total_score / $deno) - 37);
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

        $player->hc_second = $this->calc($qtr_1_scores, 3);
        $player->hc_third = $this->calc($qtr_2_scores, 5);
        $player->hc_fourth = $this->calc($qtr_3_scores, 8);
        $player->hc_playoff = $this->calc($qtr_4_scores, 10);
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
    }
}
