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

    protected Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Calculates handicap based on best half of scores
     */
    private function calculateHandicap(array $scores): int
    {
        if (empty($scores)) return 0;

        sort($scores, SORT_NUMERIC);
        $countedScores = ceil(count($scores) / 2);
        return round((array_sum(array_slice($scores, 0, $countedScores)) / $countedScores) - 37);
    }

    /**
     * Fetches all valid scores for a player in the active season
     */
    private function fetchValidScores(Player $player, Year $year)
	{
		return Score::where('player_id', $player->id)
			->where('score_type', 'weekly_score')
			->where('gross', '>', 0)
			->where('absent', false)
			->whereNotNull('week_id') // Ensure the score is linked to a valid week
			->where(function ($query) {
				$query->whereNull('substitute_id')->orWhere('substitute_id', 0);
			})
			->whereHas('week', function ($query) use ($year) {
				$query->where('year_id', $year->id)
					->where('week_date', '<=', Carbon::yesterday())
					->where(function ($q) {
						$q->whereNull('back_nine')->orWhere('back_nine', 0);
					});
			})
			->with('week')
			->get()
			->groupBy(fn($score) => match (true) {
				$score->week->week_order <= 5 => 'qtr_1',
				$score->week->week_order <= 10 => 'qtr_2',
				$score->week->week_order <= 15 => 'qtr_3',
				$score->week->week_order <= 20 => 'qtr_4',
				default => 'all',
			});
	}


    /**
     * Execute the job.
     */
    public function handle()
    {
        $player = $this->player;
        $year = Year::find($player->year_id);

        if (!$year) {
            logger()->warning("No active year found for player {$player->id}");
            return;
        }

        // Get valid scores
        $scoresByQuarter = $this->fetchValidScores($player, $year);

        $quarters = ['qtr_1', 'qtr_2', 'qtr_3', 'qtr_4'];
		$handicapFields = ['hc_second', 'hc_third', 'hc_fourth', 'hc_playoff'];

		foreach ($quarters as $index => $quarter) {
			$player->{$handicapFields[$index]} = $this->calculateHandicap(
				isset($scoresByQuarter[$quarter]) ? $scoresByQuarter[$quarter]->pluck('gross')->toArray() : []
			);
		}

        $player->hc_18 = round($player->hc_playoff * 1.5);

        // Handicap for next year
        $qtr4Scores = $scoresByQuarter['qtr_4'] ?? [];
        $player->hc_next_year = empty($qtr4Scores) ? 0 : round(array_sum($qtr4Scores) / count($qtr4Scores) - 37);

        // Full Handicap
        $totalScores = count($qtr4Scores);
        $countedScores = ($player->id === 159) ? 8 : ceil($totalScores / 2);
        $player->hc_full = ($countedScores > 0) ? round(array_sum(array_slice($qtr4Scores, 0, $countedScores)) / $countedScores - 37) : 0;

        // Determine current handicap based on the latest week
        $currentWeek = Week::where('year_id', $year->id)
            ->where('week_date', '<=', Carbon::yesterday())
            ->orderByDesc('week_order')
            ->first();

        if ($currentWeek) {
            $player->hc_current = match (true) {
                $currentWeek->week_order <= 4 => $player->hc_first,
                $currentWeek->week_order <= 9 => $player->hc_second,
                $currentWeek->week_order <= 14 => $player->hc_third,
                $currentWeek->week_order <= 20 => $player->hc_fourth,
                default => $player->hc_first,
            };
        }

        $player->save();

        // Update handicap ranks
        $this->updateHandicapRanks($year);
    }

    /**
     * Update the ranking of players based on handicap
     */
    private function updateHandicapRanks(Year $year)
    {
        $teams = Team::where('year_id', $year->id)->pluck('id');

        $players = Player::whereIn('team_id', $teams)
            ->where('substitute', false)
            ->orderBy('hc_full', 'asc')
            ->get();

        $prev = null;
        $rank = 0;
        $count = 0;

        foreach ($players as $player) {
            $count++;

            if ($player->hc_full === $prev) {
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
