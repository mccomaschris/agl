<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Score;
use App\Round;

class MigrateScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agl:mig';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $score = Score::where('score_type', 'weekly_score')->get();

        foreach ($score as $score) {

            $round = Round::firstOrNew(
                ['player_id' => $player->id, 'opponent_id' => $opponent->id]
            );

            if ($score->points == 2) {
                $record->won += 1;
            } elseif ($score->points == 1) {
                $record->tied += 1;
            } elseif ($score->points == 0) {
                $record->lost += 1;
            }

            $record->save();
        }
    }
}
