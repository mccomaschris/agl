<?php

namespace App\Models;

use App\Filters\PlayerFilters;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $guarded = [];

    protected $with = ['user'];

    protected $appends = ['ten'];

    public function user()
    {
        return $this->belongsTo(User::class)->orderBy('name', 'asc');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function weekly_scores()
    {
        return $this->hasMany(Score::class)->where('score_type', 'weekly_score');
    }

    public function opponent_records()
    {
        return $this->hasMany(PlayerRecord::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('team_id', 'asc')->orderby('position', 'asc')->get();
    }

    public function scopeStats($query, $field, $order)
    {
        return $query->orderBy($field, $order);
    }

    public function previous_seasons()
    {
        return Player::select('players.id as player_id', 'years.name as year_name', 'years.id as year_id')
            ->join('years', 'players.year_id', '=', 'years.id')
            ->where('user_id', $this->user_id)
            ->orderBy('years.name', 'desc')
            ->get();
    }

    public function getTenAttribute()
    {
        $absences = Score::where('player_id', $this->id)->where('score_type', 'weekly_score')->where('absent', 1)->pluck('id');
        $total = 0;
        $scores = Score::where('player_id', $this->id)->where('score_type', 'weekly_score')->where('gross', '>', 0)->orderBy('gross', 'asc')->limit(10)->pluck('gross');
        foreach ($scores as $score) {
            $total += $score;
        }

        if (count($absences) >= 2) {
            $denominator = 9;
        } else {
            $denominator = 10;
        }
        return ($total / $denominator) - 37;
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  PlayerFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, PlayerFilters $filters)
    {
        return $filters->apply($query);
    }

    public function scopeGroup($query, $year, $position)
    {
        return $query->with('team')->where('position', $position)->whereBetween('team_id', [7,12]);
    }

    public function weeks()
    {
        return $this->belongsToMany(Week::class, 'weekly_winner');
    }
}
