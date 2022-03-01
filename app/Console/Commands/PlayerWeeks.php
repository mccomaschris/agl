<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\Score;
use App\Models\Week;
use App\Models\Year;
use App\Models\Team;
use Illuminate\Console\Command;

class PlayerWeeks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agl:scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create weekly and quaterly/total score rows in database for each player if they do not exist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $current_year = Year::where('name', '2022')->first();

        if ($this->confirm("Do you wish to generate blank scorecards for the " . $current_year->name . "?")) {
            $year = $current_year->name;
        } else {
            $year = $this->ask('What year would you like to do this for?');
        }

        $selected_year = Year::where('name', $year)->first();

        $weeks = Week::where('year_id', $selected_year->id)->pluck('id')->toArray();
        $scores = Score::where('player_id', 30)->whereIn('foreign_key', $weeks)->get();

        $teams = Team::where('year_id', $selected_year->id)->get();

        foreach ($teams as $team) {

            $players = Player::where('team_id', $team->id)->get();

            foreach ($players as $player) {

                 // CREATE WEEKLY STATS
                foreach ($weeks as $week) {

                    $score = Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'weekly_score', 'foreign_key' => $week]);

                }

                // CREATE QUARTER AND FINAL STATS
                $qtr_1_avg = Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_1_avg', 'foreign_key' => $selected_year->id]);
                $qtr_2_avg = Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_2_avg', 'foreign_key' => $selected_year->id]);
                $qtr_3_avg = Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_3_avg', 'foreign_key' => $selected_year->id]);
                $qtr_4_avg = Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_4_avg', 'foreign_key' => $selected_year->id]);
                $season_avg = Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'season_avg', 'foreign_key' => $selected_year->id]);
            }

        }
    }
}
