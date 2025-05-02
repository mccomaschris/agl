<?php

namespace App\Jobs;

use App\Models\Week;
use App\Models\Score;
use App\Models\Year;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdatePlayerStats implements ShouldQueue
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

        if ($net > 0) {
			$net_par = $net - 37;
		} else {
			$net_par = 0;
		}

		if ($gross > 0) {
			$gross_par = $gross - 37;
		} else {
			$gross_par = 0;
		}

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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $player = $this->player;

        $player->won = 0;
        $player->lost = 0;
        $player->tied = 0;

        $weeks = Week::where('year_id', $player->year_id)->whereDate('week_date', '<', Carbon::today()->toDateString())->pluck('id');
		$points_scores = Score::where('player_id', $player->id)->where('score_type', 'weekly_score')->whereIn('foreign_key', $weeks)->get();

        foreach ($points_scores as $score) {
            $week_order = $score->week->week_order;

            if (!$score->absent && $score->hole_1) {
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
                $player->save();
            }
        }

		$scores = Score::where('player_id', $player->id)->where('score_type', 'weekly_score')->where('substitute_id', 0)->whereIn('foreign_key', $weeks)->get();

        $gp = $player->won + $player->lost + $player->tied;

        if (($player->won + $player->lost + $player->tied) > 0) {
            $player->win_pct = $player->won / ($player->won + $player->lost + $player->tied);
            $player->points = ($player->won * 2) + $player->tied;

			// $scores = Score::where('player_id', $player->id)->where('score_type', 'weekly_score')->where('substitute_id', 0)->whereIn('foreign_key', $weeks)->get();
			if (count($scores) > 0 ) {
				$weeks = Week::where('year_id', $player->year_id)->where('back_nine', false)->whereDate('week_date', '<', Carbon::today()->toDateString())->pluck('id');

				$player->gross_average = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->whereIn('foreign_key', $weeks)->where('gross', '>', 0)->where('absent', 0)->where('substitute_id', 0)->avg('gross');
				$player->gross_par = $player->gross_average - 37;

				$player->net_average = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->whereIn('foreign_key', $weeks)->where('net', '>', 0)->where('absent', 0)->where('substitute_id', 0)->avg('net');
				$player->net_par = $player->net_average - 37;

				$player->low_gross = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->whereIn('foreign_key', $weeks)->where('gross', '>', 0)->where('absent', 0)->where('substitute_id', 0)->min('gross');
				$player->high_gross = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->whereIn('foreign_key', $weeks)->max('gross');

				$player->low_net = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->whereIn('foreign_key', $weeks)->where('net', '>', 0)->where('absent', 0)->where('substitute_id', 0)->min('net');
				$player->high_net = Score::where('score_type', 'weekly_score')->where('player_id', $player->id)->whereIn('foreign_key', $weeks)->max('net');
			}
        }

        $player->save();

        $year = Year::where('active', 1)->first();

        // Rank Players by Points
        $prev = 0;
        $rank = 0;
        $count = 0;

        $players = Player::where('year_id', $year->id)->where('substitute', '0')->stats('points', 'desc')->get();

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

        $players = Player::where('year_id', $year->id)->where('substitute', '0')->stats('won', 'desc')->get();

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

        $players = Player::where('year_id', $year->id)->where('substitute', '0')->stats('net_average', 'desc')->get();

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
        $players = Player::where('year_id', $year->id)->where('substitute', '0')->where('net_average', '>', 0)->stats('net_average', 'asc')
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
			$points = 0;

            foreach ($players as $player) {
                $team->won += $player->won;
                $team->lost += $player->lost;
                $team->tied += $player->tied;
				$team->points += $player->points;

                if ($player->position == 1) {
                    $team->p1_points = $player->points;
                } elseif ($player->position == 2) {
                    $team->p2_points = $player->points;
                } elseif ($player->position == 3) {
                    $team->p3_points = $player->points;
                } elseif ($player->position == 4) {
                    $team->p4_points = $player->points;
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
    }
}
