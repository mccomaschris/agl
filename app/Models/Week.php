<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Week extends Model
{

    protected $with = ['winners', 'year'];
    protected $appends = ['quarter', 'game_name'];

    /**
     * Get the year that owns the week.
     */
    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function getQuarterAttribute()
    {
        if ($this->week_order >= 1 && $this->week_order <= 5) {
            return 1;
        } elseif ($this->week_order >= 6 && $this->week_order <= 10) {
            return 2;
        } elseif ($this->week_order >= 11 && $this->week_order <= 15) {
            return 3;
        } elseif ($this->week_order >= 16 && $this->week_order <= 20) {
            return 4;
        }
    }

    public function getFormatDateAttribute()
    {
        return Carbon::parse($this->week_date)->toFormattedDateString();
    }

    public function getGameNameAttribute()
    {
        if ($this->side_games == 'Net') {
            return "Low Net";
        } elseif ($this->side_games == 'Pin') {
            return "Closest to the Pin";
        } else {
            return "Low Putts";
        }
    }

    /**
     * Get the team that owns the Match 1, 1st Team.
     */
    public function team_a()
    {
        return $this->belongsTo(Team::class, 'a_first_id')->with('onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer');
    }

    /**
     * Get the team that owns the Match 1, 2nd Team.
     */
    public function team_b()
    {
        return $this->belongsTo(Team::class, 'a_second_id')->with('onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer');
    }

    /**
     * Get the team that owns the Match 2, 1st Team.
     */
    public function team_c()
    {
        return $this->belongsTo(Team::class, 'b_first_id')->with('onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer');
    }

    /**
     * Get the team that owns the Match 2, 2nd Team.
     */
    public function team_d()
    {
        return $this->belongsTo(Team::class, 'b_second_id')->with('onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer');
    }

    /**
     * Get the team that owns the Match 3, 1st Team.
     */
    public function team_e()
    {
        return $this->belongsTo(Team::class, 'c_first_id')->with('onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer');
    }

    /**
     * Get the team that owns the Match 3, 2nd Team.
     */
    public function team_f()
    {
        return $this->belongsTo(Team::class, 'c_second_id')->with('onePlayer', 'twoPlayer', 'threePlayer', 'fourPlayer');
    }

    /**
     * Get the scores for the week.
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function winners()
    {
        return $this->belongsToMany(Player::class, 'weekly_winner');
    }

    public function scopeQuarter($query, $quarter, $player_id)
    {

        switch ($quarter) {
            case 1:
                $splice = [0, 5];
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

        return $query
            ->where('week_order', '>=', $splice[0])
            ->where('week_order', '<=', $splice[1])
            ->with(['scores' => function ($query) use ($player_id) {
                $query->where('player_id', $player_id);
            }]);
    }

    public function firstGroup($teamA, $teamB)
    {
        $players = Player::whereIn('team_id', [$teamA, $teamB]);

        if ($this->quarter == 1 or $this->quarter == 4) {
            $players->whereRaw('(position = 1 or position = 2)');
        } elseif ($this->quarter == 2) {
            $players->whereRaw('(position = 1 or position = 3)');
        } elseif ($this->quarter == 3) {
            $players->whereRaw('(position = 1 or position = 4)');
        }

        return $players->orderBy('position', 'asc')->orderBy('team_id', 'asc')->get();
    }

    public function matchup( $selected_matchup ) {
        $matchups = [
            'a' => [$this->id, $this->a_first_id, $this->a_second_id],
            'b' => [$this->id, $this->b_first_id, $this->b_second_id],
            'c' => [$this->id, $this->c_first_id, $this->c_second_id],
        ];

        return DB::table('scores')
                    ->join('players', 'scores.player_id', '=', 'players.id')
                    ->join('teams', 'players.team_id', '=', 'teams.id')
                    ->join('users', 'players.user_id', '=', 'users.id')
                    ->join('weeks', 'scores.foreign_key', '=', 'weeks.id')
                    ->select('teams.name as team_name', 'teams.id', 'users.name as player_name', 'scores.*')
                    ->whereRaw('weeks.id = ? and score_type = "weekly_score" and (teams.id =? or teams.id = ?)', $matchups[$selected_matchup])
                    ->orderBy('players.position', 'asc')
                    ->orderBy('teams.name', 'asc')
                    ->get();
    }
}
