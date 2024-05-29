<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    protected $guarded = [];

    protected $with = ['user'];

    protected $appends = ['ten'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->orderBy('name', 'asc');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function weekly_scores(): HasMany
    {
        return $this->hasMany(Score::class)->where('score_type', 'weekly_score');
    }

    public function season_avg(): HasOne
    {
        return $this->hasOne(Score::class)->where('score_type', 'season_avg');
    }

    public function opponent_records(): HasMany
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

    public function name()
    {
        return $this->user->name;
    }

    public function getTenAttribute(): float|int
    {
        $absences = Score::where('player_id', $this->id)->where('score_type', 'weekly_score')->where('absent',
            1)->pluck('id');
        $total = 0;

        if (count($absences) >= 2 && count($absences) <= 3) {
            $denominator = 9;
        } elseif (count($absences) == 4) {
            $denominator = 8;
        } else {
            $denominator = 10;
        }

        $scores = Score::where('player_id', $this->id)->where('score_type', 'weekly_score')->where('gross', '>',
            0)->orderBy('gross', 'asc')->limit($denominator)->pluck('gross');

        foreach ($scores as $score) {
            $total += $score;
        }

        return ($total / $denominator) - 37;
    }

    public function scopeGroup($query, $year, $position)
    {
        return $query->with('team')->where('position', $position)->whereBetween('team_id', [7, 12]);
    }

    /**
     * Get the players average scores.
     */
    public function getEagles(): Score
    {
        return Score::where('score_type', 'season_avg')->where('player_id', $this->id)->first(['eagle']);
    }

    public function weeks(): BelongsToMany
    {
        return $this->belongsToMany(Week::class, 'weekly_winner');
    }
}
