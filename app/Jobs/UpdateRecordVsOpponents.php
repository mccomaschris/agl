<?php

namespace App\Jobs;

use App\Models\Player;
use App\Models\PlayerRecord;
use App\Models\Score;
use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateRecordVsOpponents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Year $year;

    public function __construct(Year $year)
    {
        $this->year = $year;
    }

    public function handle(): void
    {
        $playerIds = Player::where('year_id', $this->year->id)->pluck('id');

        // Clear existing records for players in this year
        PlayerRecord::whereIn('player_id', $playerIds)->delete();

        // Get all weeks that have been played
        $weeks = Week::where('year_id', $this->year->id)
            ->whereDate('week_date', '<', Carbon::today()->toDateString())
            ->get();

        foreach ($weeks as $week) {
            $this->processWeekMatchups($week);
        }
    }

    protected function processWeekMatchups(Week $week): void
    {
        // Process all 3 matchups (A, B, C)
        $matchups = [
            [$week->a_first_id, $week->a_second_id],
            [$week->b_first_id, $week->b_second_id],
            [$week->c_first_id, $week->c_second_id],
        ];

        foreach ($matchups as [$team1Id, $team2Id]) {
            if (! $team1Id || ! $team2Id) {
                continue;
            }

            // Process each position (1-4)
            for ($position = 1; $position <= 4; $position++) {
                $this->processPositionMatchup($week, $team1Id, $team2Id, $position);
            }
        }
    }

    protected function processPositionMatchup(Week $week, int $team1Id, int $team2Id, int $position): void
    {
        $player1 = Player::where('team_id', $team1Id)
            ->where('position', $position)
            ->first();

        $player2 = Player::where('team_id', $team2Id)
            ->where('position', $position)
            ->first();

        if (! $player1 || ! $player2) {
            return;
        }

        // Get scores for both players this week
        $score1 = Score::where('player_id', $player1->id)
            ->where('score_type', 'weekly_score')
            ->where('foreign_key', $week->id)
            ->first();

        $score2 = Score::where('player_id', $player2->id)
            ->where('score_type', 'weekly_score')
            ->where('foreign_key', $week->id)
            ->first();

        if (! $score1 || ! $score2) {
            return;
        }

        // Skip if either player was absent or has no score
        if ($score1->absent || $score2->absent || ! $score1->hole_1 || ! $score2->hole_1) {
            return;
        }

        // Update records based on player 1's points
        // points: 2 = win, 1 = tie, 0 = loss
        $this->updatePlayerRecord($player1->id, $player2->id, $score1->points);
        $this->updatePlayerRecord($player2->id, $player1->id, $score2->points);
    }

    protected function updatePlayerRecord(int $playerId, int $opponentId, ?int $points): void
    {
        if ($points === null) {
            return;
        }

        $record = PlayerRecord::firstOrCreate(
            ['player_id' => $playerId, 'opponent_id' => $opponentId],
            ['won' => 0, 'lost' => 0, 'tied' => 0]
        );

        switch ($points) {
            case 2:
                $record->won++;
                break;
            case 1:
                $record->tied++;
                break;
            case 0:
                $record->lost++;
                break;
        }

        $record->save();
    }
}
