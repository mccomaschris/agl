<?php

namespace App\Console\Commands;

use App\Player;
use App\Score;
use App\Week;
use App\Year;
use App\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Handicaps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agl:hc {--year=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate handicaps for all players for a given year.';

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
     * Create a new command instance.
     *
     * @return $hc
     */
    public function calc($scores) {

        if (count($scores) == 0) return 0;
        $total_scores = count($scores);
        $counted_scores = round($total_scores / 2, 0);
        asort($scores, SORT_NUMERIC);

        $total_score = (array_sum(array_slice($scores, 0, $counted_scores, true)));
        $hc = round(($total_score / $counted_scores) - 37);
        return $hc;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('year') === null) {
            $year = Year::where('active', 1)->first();
        } else {
            $year = Year::where('name', $this->option('year'))->first();
        }

        $current_week = Week::where('year_id', $year->id)
            ->where('week_date', '<=', Carbon::yesterday())
            ->orderBy('week_order', 'desc')
            ->first();

        $teams = Team::where('year_id', $year->id)->pluck('id');

        $players = Player::whereIn('team_id', $teams)->get();

        foreach ($players as $player) {

            $this->info($player->user->name);
            $qtr_1_scores = [];
            $qtr_2_scores = [];
            $qtr_3_scores = [];
            $qtr_4_scores = [];
            $total_scores = [];

            $scores = Score::with('week')->where('score_type', 'weekly_score')->where('player_id', $player->id)
                                ->where('gross', '>', 0)
                                ->where('absent', false)
                                ->where('substitute_id', '0')
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

            // Calculate Handicaps
            $player->hc_second = $this->calc($qtr_1_scores);
            $player->hc_third = $this->calc($qtr_2_scores);
            $player->hc_fourth = $this->calc($qtr_3_scores);
            $player->hc_playoff = $this->calc($qtr_4_scores);
            $player->hc_18 = round($player->hc_playoff * 1.5);
            if (count($qtr_4_scores) == 0) {
                $player->hc_next_year = 0;
            } else {
                $player->hc_next_year = round((array_sum($qtr_4_scores) / count($qtr_4_scores)) - 37);
            }
            
            // Calculate Full Handicap for 1-4 rankings
            $total_scores = count($qtr_4_scores);
            $counted_scores = round($total_scores / 2, 0);
            asort($qtr_4_scores, SORT_NUMERIC);

            $total_score = (array_sum(array_slice($qtr_4_scores, 0, $counted_scores, true)));
            if ($counted_scores == 0) {
                $player->hc_full = 0;
            } else {
                $player->hc_full = ($total_score / $counted_scores) - 37;
            }

            // Set Current HC Based on Week
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
                    $player->hc_current = $hc_playoff;
            }

            $player->save();
        }


        // Rank Players in Ascending Order By Full Handicap for 1-4 Rankings
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

        // Delete our calc keys just in case
        // foreach (Redis::keys("calc*") as $key) {
        //     Redis::del($key);
        // }

        // // Calculate Handicaps usinchrog Redis
        // // All keys start with 'calc'
        // // All keys in Redis starting with 'calc' will be deleted at end of script
        // $scores = Score::with('week')->where('gross', '>', 0)->where('absent', false)->where('substitute', false)->get();

        // $bar = $this->output->createProgressBar(count($scores));

        // foreach ($scores as $score) {

        //     // Update Totals Based on Quarter
        //     switch ($score->week->week_order) {
        //         case in_array($score->week->week_order, range(1, 5)):
        //             Redis::incr("calc:hc:{$score->player_id}:qtr_1:rounds");
        //             Redis::zadd("calc:hc:{$score->player_id}:qtr_1:scores", array($score->week->week_order => $score->gross));
        //         case in_array($score->week->week_order, range(1, 10)):
        //             Redis::incr("calc:hc:{$score->player_id}:qtr_2:rounds");
        //             Redis::zadd("calc:hc:{$score->player_id}:qtr_2:scores", array($score->week->week_order => $score->gross));
        //         case in_array($score->week->week_order, range(1, 15)):
        //             Redis::incr("calc:hc:{$score->player_id}:qtr_3:rounds");
        //             Redis::zadd("calc:hc:{$score->player_id}:qtr_3:scores", array($score->week->week_order => $score->gross));
        //         case in_array($score->week->week_order, range(1, 20)):
        //             Redis::incr("calc:hc:{$score->player_id}:qtr_4:rounds");
        //             Redis::zadd("calc:hc:{$score->player_id}:qtr_4:scores", array($score->week->week_order => $score->gross));
        //     }

        //     $bar->advance();

        // }

        // $bar->finish();
        // $this->info("\nScores finished.");

        // // Calculate Handicaps for each Player

        // $players = Player::all();

        // $bar = $this->output->createProgressBar(count($players));

        // foreach ($players as $player) {

        //     if ($player->id == 13) {
        //         $player->hc_second = 4;
        //     } else {
        //         $player->hc_second = $this->calcHC($player, "qtr_1");
        //     }
        //     $player->hc_third = $this->calcHC($player, "qtr_2");
        //     $player->hc_fourth = $this->calcHC($player, "qtr_3");
        //     $player->hc_18 = round($player->hc_fourth * 1.5);



        //     $rounds = round(Redis::get("calc:hc:{$player->id}:qtr_4:rounds") / 2, 0);

        //     if ($rounds > 0) {
        //         $score = Redis::zrange("calc:hc:{$player->id}:qtr_4:scores", 0, $rounds - 1, "withscores");
        //         // $this->info("Scores: {$score}");
        //         $total = array_sum($score);
        //         $player->hc_full = ($total / $rounds) - 37;
        //         $player->hc_playoff = round(($total / $rounds) - 37);
        //     } else {
        //         $player->hc_full = $player->hc_current;
        //          $player->hc_playoff = $player->hc_current;
        //     }

        //     $rounds = Redis::get("calc:hc:{$player->id}:qtr_4:rounds");

        //     if ($rounds > 0) {
        //         $score = Redis::zrange("calc:hc:{$player->id}:qtr_4:scores", 0, -1, "withscores");
        //         $total = array_sum($score);
        //         $player->hc_next_year = ($total / $rounds) - 37;
        //     } else {
        //         $player->hc_next_year = $player->hc_current;
        //     }

        //     $player->save();

        //     $bar->advance();

        // }

        // $bar->finish();

        // for
        // $prev = 400;
        // $rank = 0;
        // $count = 0;

        // foreach (Player::orderBy('hc_full', 'asc')->get() as $player) {

        //     $count++;

        //     if ($player->hc_full == $prev) {
        //         $player->hc_full_rank = $rank;
        //     } else {
        //         $player->hc_full_rank = $count;
        //         $rank = $count;
        //     }

        //     $prev = $player->hc_full;
        //     $player->save();

        // }

        // // // Delete our calc keys that are no longer needed

        // // foreach (Redis::keys("calc*") as $key) {
        // //     Redis::del($key);
        // // }

        // $this->info("\n");
    } // end of handle

}
