<?php

namespace App\Console\Commands;

use App\Team;
use App\User;
use App\Week;
use App\Year;
use App\Score;
use App\Player;
use Carbon\Carbon;
use Illuminate\Console\Command;
use \Illuminate\Database\Eloquent\Factory;
use App\PlayerRecord;

class UpdateStats extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'agl:stats {--year=}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update player and team stats for a given year.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

    public function avgScores($array, $key)
    {
        if (count($array) == 0 ) return 0;
        $sum = 0;
        foreach ($array as $k => $v) {
            $sum += $v[$key];
        }
        return $sum / count($array);
    }

    public function sumScores($array, $key)
    {
        $sum = 0;
        foreach ($array as $k => $v) {
            $sum += $v[$key];
        }
        return $sum;
    }

    public function calcQuarter($score_type, $player, $year, $scores)
    {
        $rounds = count($scores);
        $hole_1 = $this->avgScores($scores, 'hole_1');
        $hole_2 = $this->avgScores($scores, 'hole_2');
        $hole_3 = $this->avgScores($scores, 'hole_3');
        $hole_4 = $this->avgScores($scores, 'hole_4');
        $hole_5 = $this->avgScores($scores, 'hole_5');
        $hole_6 = $this->avgScores($scores, 'hole_6');
        $hole_7 = $this->avgScores($scores, 'hole_7');
        $hole_8 = $this->avgScores($scores, 'hole_8');
        $hole_9 = $this->avgScores($scores, 'hole_9');
        $gross = $this->avgScores($scores, 'gross');
        $net = $this->avgScores($scores, 'net');
        $points = $this->sumScores($scores, 'points');
        $eagle = $this->sumScores($scores, 'eagle');
        $birdie = $this->sumScores($scores, 'birdie');
        $par = $this->sumScores($scores, 'par');
        $bogey = $this->sumScores($scores, 'bogey');
        $double_bogey = $this->sumScores($scores, 'double_bogey');

        if ($net > 0) { $net_par = $net - 37; } else { $net_par = 0;}
        if ($gross > 0) { $gross_par = $gross - 37; } else { $gross_par = 0;}

        Score::updateOrCreate(
            ['player_id' => $player, 'score_type' => $score_type, 'foreign_key' => $year],
            ['hole_1' => $hole_1, 'hole_2' => $hole_2, 'hole_3' => $hole_3,
             'hole_4' => $hole_4, 'hole_5' => $hole_5, 'hole_6' => $hole_6,
             'hole_7' => $hole_7, 'hole_8' => $hole_8, 'hole_9' => $hole_9,
             'gross' => $gross, 'gross_par' => $gross_par,
             'net' => $net, 'net_par' => $net_par, 'points' => $points,
             'eagle' => $eagle, 'birdie' => $birdie,
             'par' => $par, 'bogey' => $bogey, 'double_bogey' => $double_bogey
        ]);
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

        if ($this->option('year') === null) {
            $year = Year::where('active', 1)->first();
        } else {
            $year = Year::where('name', $this->option('year'))->first();
        }

        $teams = Team::where('year_id', $year->id)->pluck('id');

        $players = Player::whereIn('team_id', $teams)->get();

        // Reset Player Records
        foreach ($players as $player) {
            $player->won = 0;
            $player->lost = 0;
            $player->tied = 0;
            $player->points = 0;
            $player->save();
        }

        $weeks = Week::where('year_id', $year->id)->whereDate('week_date', '<', Carbon::today()->toDateString())->pluck('id');
        $scores = Score::with('player', 'week')->where('score_type', 'weekly_score')->whereIn('foreign_key', $weeks)->get();

        foreach ($scores as $score) {

            $player = Player::find($score->player->id);
            $week_order = $score->week->week_order;

            if (!$score->absent && $score->hole_1) {

                // Calculate Gross Score for Player Week
                $score->gross = array_sum([
                                    $score->hole_1, $score->hole_2, $score->hole_3,
                                    $score->hole_4, $score->hole_5, $score->hole_6,
                                    $score->hole_7, $score->hole_8, $score->hole_9
                                ]);

                // Calculate Net Score for Player Week
                switch ($week_order) {
                    case in_array($week_order, range(1, 5)):
                        $score->net = $score->gross - $score->player->hc_first;
                        break;
                    case in_array($week_order, range(6, 10)):
                        $score->net = $score->gross - $score->player->hc_second;
                        break;
                    case in_array($week_order, range(11, 15)):
                        $score->net = $score->gross - $score->player->hc_third;
                        break;
                    case in_array($week_order, range(16, 20)):
                        $score->net = $score->gross - $score->player->hc_fourth;
                        break;
                }

                // Calculate Gross and Net Score to Par
                $score->gross_par = $score->gross - 37;
                $score->net_par = $score->net - 37;

                // Reset Eagle, Birdie, Par, Bogey, and Double Bogey Count
                $score->eagle = $score->birdie = $score->par = $score->bogey = $score->double_bogey = 0;

                // Set Par 3, Par 4, and Par 5 holes
                $par_3s = [$score->hole_2, $score->hole_6];
                $par_4s = [$score->hole_1, $score->hole_3, $score->hole_4, $score->hole_8];
                $par_5s = [$score->hole_5, $score->hole_7, $score->hole_9];

                // Par 3 Eagle, Birdie, Par, Bogey, and Double Bogey Count
                foreach ($par_3s as $hole) {
                    if ($hole <= 1) {
                        $score->eagle++;
                    } elseif ($hole == 2) {
                        $score->birdie++;
                    } elseif ($hole == 3) {
                        $score->par++;
                    } elseif ($hole == 4) {
                        $score->bogey++;
                    } elseif ($hole >= 5) {
                        $score->double_bogey++;
                    }
                }

                // Par 4 Eagle, Birdie, Par, Bogey, and Double Bogey Count
                foreach ($par_4s as $hole) {
                    if ($hole <= 2) {
                        $score->eagle++;
                    } elseif ($hole == 3) {
                        $score->birdie++;
                    } elseif ($hole == 4) {
                        $score->par++;
                    } elseif ($hole == 5) {
                        $score->bogey++;
                    } elseif ($hole >= 6) {
                        $score->double_bogey++;
                    }
                }

                // Par 5 Eagle, Birdie, Par, Bogey, and Double Bogey Count
                foreach ($par_5s as $hole) {
                    if ($hole <= 3) {
                        $score->eagle++;
                    } elseif ($hole == 4) {
                        $score->birdie++;
                    } elseif ($hole == 5) {
                        $score->par++;
                    } elseif ($hole == 6) {
                        $score->bogey++;
                    } elseif ($hole >= 7) {
                        $score->double_bogey++;
                    }
                }

                // Save Score stats for week
                $score->save();

                // Calculate Player Record
                if (!$score->substitute_id) {
                    $points = $score->points;
                    switch ($points) {
                        case 0:
                            $player->lost++;
                            break;
                        case 1:
                            $player->tied++;
                            break;
                        case 2:
                            $player->won++;
                            break;
                    }
                }

                // Save Player record after Week
                $player->save();

            }
        }

        $players = Player::whereIn('team_id', $teams)->get();
        // Calculate Player Winning Percentage, Gross Average, Gross Average to Par,
        // Net Average, Net Average to Par, Low Gross, High Gross, Low Net, High Net
        foreach ($players as $player) {
            $gp = $player->won + $player->lost + $player->tied;

            if (($player->won + $player->lost + $player->tied) > 0) {

                $player->win_pct = $player->won / ($player->won + $player->lost + $player->tied);
                $player->points = ($player->won * 2) + $player->tied;

                $player->gross_average = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->where('gross', '>', 0)->where('absent', 0)->where('substitute_id', 0)->avg('gross');
                $player->gross_par = $player->gross_average - 37;

                $player->net_average = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->where('net', '>', 0)->where('absent', 0)->where('substitute_id', 0)->avg('net');
                $player->net_par = $player->net_average - 37;

                $player->low_gross = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->where('gross', '>', 0)->where('absent', 0)->where('substitute_id', 0)->min('gross');
                $player->high_gross = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->max('gross');

                $player->low_net = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->where('net', '>', 0)->where('absent', 0)->where('substitute_id', 0)->min('net');
                $player->high_net = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->max('net');

            }

            $player->save();
        }

        // Rank Players by Points
        $prev = 0;
        $rank = 0;
        $count = 0;

        $players = Player::whereIn('team_id', $teams)->stats('points', 'desc')->get();

        foreach ($players as $player) {

            $count++;
            if ($player->points == $prev) {
                $player->points_rank = $rank;
            } else {
                $player->points_rank = $count;
                $rank = $count;
            }

            $prev = $player->points;
            $player->save();

        }

        // Rank Players by Wins
        $prev = 0;
        $rank = 0;
        $count = 0;

        $players = Player::whereIn('team_id', $teams)->stats('won', 'desc')->get();

        foreach ($players as $player) {

            $count++;

            if ($player->won == $prev) {
                $player->wins_rank = $rank;
            } else {
                $player->wins_rank = $count;
                $rank = $count;
            }

            $prev = $player->won;
            $player->save();

        }

        // Rank Players by Net Average
        $prev = 400;
        $rank = 0;
        $count = 0;

        $players = Player::whereIn('team_id', $teams)->stats('net_average', 'desc')->get();

        foreach ($players as $player) {

            if ($player->net_average == 0) {
                $player->overall_net_rank = 24; // Players with no rounds automatically get ranked last
            } else {
                $count++;
                if ($player->net_average == $prev) {
                    $player->overall_net_rank = $rank;
                } else {
                    $rank = $count;
                }
                $prev = $player->net_average;
            }
            $player->save();
        }

        // Rank Players by Net Average in Position Groupings
        $players = Player::whereIn('team_id', $teams)->where('net_average', '>', 0)->stats('net_average', 'asc')
                        ->get()->groupBy('position');

        foreach ($players as $group) {

            $prev = 400;
            $prev = 0;
            $count = 0;

            foreach ($group as $player) {
                $count++;
                if ($player->net_average == $prev) {
                    $player->position_net_rank = $rank;
                } else {
                    $player->position_net_rank = $count;
                    $rank = $count;
                }
                $prev = $player->net_average;
                $player->save();
            }
        }

        // Calculate Player Quarterly Averages
        $players = $players = Player::whereIn('team_id', $teams)->get();

        foreach ($players as $player) {
            $qtr_1_total = [];
            $qtr_2_total = [];
            $qtr_3_total = [];
            $qtr_4_total = [];
            $season_total = [];

            $scores = Score::where('player_id', $player->id)
                        ->where('score_type', 'weekly_score')
                        ->where('gross', '>', 0)
                        ->where('absent', 0)
                        ->where('substitute_id', 0)
                        ->with('week')->get();

            foreach ($scores as $score) {

                $week_order = $score->week->week_order;

                switch ($week_order) {
                    case in_array($week_order, range(1, 5)):
                        array_push($qtr_1_total, $score);
                        break;
                    case in_array($week_order, range(6, 10)):
                        array_push($qtr_2_total, $score);
                        break;
                    case in_array($week_order, range(11, 15)):
                        array_push($qtr_3_total, $score);
                        break;
                    case in_array($week_order, range(16, 20)):
                        array_push($qtr_4_total, $score);
                        break;
                }
            }

            $this->calcQuarter('qtr_1_avg', $player->id, $year->id, $qtr_1_total);
            $this->calcQuarter('qtr_2_avg', $player->id, $year->id, $qtr_2_total);
            $this->calcQuarter('qtr_3_avg', $player->id, $year->id, $qtr_3_total);
            $this->calcQuarter('qtr_4_avg', $player->id, $year->id, $qtr_4_total);
            $this->calcQuarter('season_avg', $player->id, $year->id, $season_total);
        }

        // Rank Team By Stats
        $teams = Team::where('year_id', $year->id)->get();
        foreach ($teams as $team) {

            // Reset Each Team
            $team->won = 0;
            $team->lost = 0;
            $team->tied = 0;
            $team->points = 0;
            $team->p1_points = 0;
            $team->p2_points = 0;
            $team->p3_points = 0;
            $team->p4_points = 0;

            $players = Player::where('team_id', $team->id)->get();

            foreach ($players as $player) {
                $team->won += $player->won;
                $team->lost += $player->lost;
                $team->tied += $player->tied;
                $team->points += $player->points;

                if ($player->position == 1) {
                    $team->p1_points += $player->points;
                } elseif ($player->position == 2) {
                    $team->p2_points += $player->points;
                } elseif ($player->position == 3) {
                    $team->p3_points += $player->points;
                } elseif ($player->position == 4) {
                    $team->p4_points += $player->points;
                }
            }
            $team->save();
        }

        $count = 0;

        $teams = Team::where('year_id', $year->id)->orderBy('points', 'desc')
                    ->orderBy('p1_points', 'desc')
                    ->orderBy('p2_points', 'desc')
                    ->orderBy('p3_points', 'desc')
                    ->orderBy('p4_points', 'desc')
                    ->get();

        foreach ($teams as $team) {
            $count++;
            $team->rank = $count;
            $team->save();
        }

        // CALCULATE RECORDS VS OPPONENTS
        $teams = Team::where('year_id', $year->id)->pluck('id');
        $players = Player::whereIn('team_id', $teams)->pluck('id');
        $records = PlayerRecord::whereIn('player_id', $players)->get();

        // Reset Player Records
        foreach ($records as $record) {
            $record->won = 0;
            $record->lost = 0;
            $record->tied = 0;
            $record->save();
        }

        $teams = Team::where('year_id', $year->id)->pluck('id');
        $players = Player::whereIn('team_id', $teams)->get();

        foreach ($players as $player) {
            $scores = Score::where('player_id', $player->id)
                        ->whereNotNull('absent')
                        ->whereNotNull('injury')
                        ->where('substitute_id', '0')
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

                // 

                $this->info("Player ID " . $player->id . " vs " . $opponent->id);

                if ($opp_score->absent == 0) {

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

                    $record->save();
                }

                
            }
        }
	}
}
