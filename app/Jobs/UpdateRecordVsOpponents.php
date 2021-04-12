<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Year;
use App\Models\Team;
use App\Models\PlayerRecord;
use App\Models\Player;
use App\Models\Week;
use App\Models\Score;

class UpdateRecordVsOpponents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $year;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Year $year)
    {
        $this->year = $year;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $year = $this->year;
        // CALCULATE RECORDS VS OPPONENTS
        $players = Player::where('year_id', $year->id)->pluck('id');
        $records = PlayerRecord::whereIn('player_id', $players)->get();

        // Reset Player Records
        foreach ($records as $record) {
            $record->won = 0;
            $record->lost = 0;
            $record->tied = 0;
            $record->save();
        }

        $players = Player::where('year_id', $year->id)->where('substitute', '0')->get();

        foreach ($players as $player) {

            $scores = Score::where('official', 1)->where('player_id', $player->id)
                        ->where('absent', 0)
                        ->where('injury', 0)
                        ->where('substitute_id', 0)
                        ->whereNotNull('points')
                        ->where('score_type', 'weekly_score')->get();

            foreach ($scores as $score) {

                $week = Week::find($score->foreign_key);

                switch ($player->team_id) {
                    case $week->a_first_id:
                        $opponent = Player::where('position', $player->position)->where('team_id', $week->a_second_id)->first();
                        break;
                    case $week->a_second_id:
                        $opponent = Player::where('position', $player->position)->where('team_id', $week->a_first_id)->first();
                        break;
                    case $week->b_first_id:
                        $opponent = Player::where('position', $player->position)->where('team_id', $week->b_second_id)->first();
                        break;
                    case $week->b_second_id:
                        $opponent = Player::where('position', $player->position)->where('team_id', $week->b_first_id)->first();
                        break;
                    case $week->c_first_id:
                        $opponent = Player::where('position', $player->position)->where('team_id', $week->c_second_id)->first();
                        break;
                    case $week->c_second_id:
                        $opponent = Player::where('position', $player->position)->where('team_id', $week->c_first_id)->first();
                        break;
                }

                $opp_score = Score::with('player')->where('player_id', $opponent->id)->where('foreign_key', $week->id)->where('score_type', 'weekly_score')->first();

                if ($opp_score->absent == 0 && $opp_score->injury == 0 && $opp_score->substitute_id == 0 && $opp_score->gross > 0) {
                    $record = PlayerRecord::firstOrNew(
                        ['player_id' => $player->id, 'opponent_id' => $opponent->id]
                    );

                    if ($score->points == 2) {
                        $record->won += 1;
                    } elseif ($score->points == 1) {
                        $record->tied += 1;
                    } elseif ($score->points == 0) {
                        $record->lost += 1;
                    }
                }

                $record->save();
            }
        }
    }
}
