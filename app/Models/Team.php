<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
	use HasFactory;

    protected $appends = ['one_player_last'];

    protected $fillable = [
        'name', 'year_id', 'champions',
    ];

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function onePlayer(): HasOne
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 1);
    }

    public function twoPlayer(): HasOne
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 2);
    }

    public function threePlayer(): HasOne
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 3);
    }

    public function fourPlayer(): HasOne
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 4);
    }

    public function getTeamNamesAttribute(): string
    {
        return $this->onePlayer->last_name.', '.$this->twoPlayer->last_name.', '.$this->threePlayer->last_name.', '.$this->fourPlayer->last_name;
    }

    public function getOnePlayerLastAttribute(): string
    {
        return explode(' ', $this->onePlayer->user->name)[1];
    }

    public function scopeStats($query, $field, $order)
    {
        return $query->orderBy($field, $order);
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class)->orderby('position', 'asc');
    }

    public function fullName(): string
    {
        return "Team {$this->name}";
    }

    public function scopeStandings($query)
    {
        return $query
            ->orderBy('points', 'desc')
            ->orderBy('p1_points', 'desc')
            ->orderBy('p2_points', 'desc')
            ->orderBy('p3_points', 'desc')
            ->orderBy('p4_points', 'desc');
    }
}
