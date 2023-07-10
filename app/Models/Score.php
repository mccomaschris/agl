<?php

namespace App\Models;

use Agl\TotalHoles\TotalHoles;
use Cache;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Score extends Model
{

    protected $appends = ['handicap'];

    protected $guarded = [];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function week()
    {
        return $this->belongsTo(Week::class, 'foreign_key');
    }

	public function year()
	{
		return $this->belongsTo(Year::class);
	}

    public function scopeQuarter($query, $quarter)
    {

        switch ($quarter) {
            case 1:
                $splice = [1, 5];
                break;
            case 2:
                $splice = [6, 10];
                break;
            case 3:
                $splice = [11, 15];
                break;
            case 4:
                $splice = [16, 20];
                break;
        }

        $weeks = Week::whereBetween('week_order', $splice)->pluck('id')->toArray();
        return $query->whereIn('foreign_key', $weeks);
    }

    public function getHandicapAttribute()
    {
        // if (in_array($this->week->week_order, [1, 2, 3, 4, 5]) ) {
        //     return $this->player->hc_first;
        // } elseif (in_array($this->week->week_order, [6, 7, 8, 9, 10]) ) {
        //     return $this->player->hc_second;
        // } elseif (in_array($this->week->week_order, [11, 12, 13, 14, 15]) ) {
        //     return $this->player->hc_third;
        // } elseif (in_array($this->week->week_order, [16, 17, 18, 19, 20]) ) {
        //     return $this->player->hc_four;
        // }
    }

    public function getQuarterAttribute()
    {
        if (in_array($this->week->week_order, [1, 2, 3, 4, 5]) ) {
            return "1";
        } elseif (in_array($this->week->week_order, [6, 7, 8, 9, 10]) ) {
            return "2";
        } elseif (in_array($this->week->week_order, [11, 12, 13, 14, 15]) ) {
            return "2";
        } elseif (in_array($this->week->week_order, [16, 17, 18, 19, 20]) ) {
            return "2";
        }
    }

    public function opponent()
    {
        if ($this->score_type != 'weekly_score') { return false; }

        $week = Week::find($this->foreign_key);
        $player = Player::find($this->player_id);
        $team = Team::find($player->team_id);

        if ($team->id == $week->a_first_id) {
            $opponent_team_id = $week->a_second_id;
        } elseif ($team->id == $week->a_second_id) {
            $opponent_team_id = $week->a_first_id;
        } elseif ($team->id == $week->b_first_id) {
            $opponent_team_id = $week->b_second_id;
        } elseif ($team->id == $week->b_second_id) {
            $opponent_team_id = $week->b_first_id;
        } elseif ($team->id == $week->c_first_id) {
            $opponent_team_id = $week->c_second_id;
        } elseif ($team->id == $week->c_second_id) {
            $opponent_team_id = $week->c_first_id;
        }

        $opponent = Player::where('team_id', $opponent_team_id)->where('position', $player->position)->first();
        return $opponent;
    }

    public function scopeCountingScores($query)
    {
        return $query->where('gross', '>', 0)->where('absent', 0)->where('substitute_id', 0);
    }

    public function scopeTotals($query, $quarter, $player)
    {

        switch ($quarter) {
            case 1:
                $splice = [1, 5];
                break;
            case 2:
                $splice = [6, 10];
                break;
            case 3:
                $splice = [11, 15];
                break;
            case 4:
                $splice = [16, 20];
                break;
        }

        $weeks = Cache::remember("weekIDs:{$quarter}", 1400, function () use ($splice) {
            return Week::whereBetween('week_order', $splice)->pluck('id')->toArray();
        });

        return Cache::remember("totals:{$player->id}:{$quarter}", 1400, function () use ($query, $player, $weeks) {
            return $query->where('player_id', $player->id)->where('absent', 0)
                ->whereIn('week_id', $weeks)->select(DB::raw(
                'AVG(hole_1) as hole_1_avg,
           AVG(hole_2) as hole_2_avg,
           AVG(hole_3) as hole_3_avg,
           AVG(hole_4) as hole_4_avg,
           AVG(hole_5) as hole_5_avg,
           AVG(hole_6) as hole_6_avg,
           AVG(hole_7) as hole_7_avg,
           AVG(hole_8) as hole_8_avg,
           AVG(hole_9) as hole_9_avg,
           AVG(gross) as gross_avg,
           AVG(gross_par) as gross_par_avg,
           AVG(gross) as gross_avg,
           AVG(gross_par) as gross_par_avg,
           AVG(net) as net_avg,
           AVG(net_par) as net_par_avg,
           SUM(points) as points_total,
           SUM(eagle) as eagle_total,
           SUM(birdie) as birdie_total,
           SUM(par) as par_total,
           SUM(bogey) as bogey_total,
           SUM(double_bogey) as double_bogey_total
        '));
        });
    }
}
