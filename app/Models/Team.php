<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $appends = ['one_player_last'];

    protected $fillable = [
        'name', 'year_id', 'champions',
    ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function onePlayer()
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 1);
    }

    public function twoPlayer()
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 2);
    }

    public function threePlayer()
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 3);
    }

    public function fourPlayer()
    {
        return $this->hasOne(Player::class)->with('user')->where('position', 4);
    }

    public function getTeamNamesAttribute()
    {
        return $this->onePlayer->last_name . ", " . $this->twoPlayer->last_name  . ", " . $this->threePlayer->last_name . ", " . $this->fourPlayer->last_name;
    }

    public function getOnePlayerLastAttribute()
    {
        return explode(" ", $this->onePlayer->user->name)[1];
    }

    public function scopeStats($query, $field, $order)
    {
        return $query->orderBy($field, $order);
    }

    public function players()
    {
        return $this->hasMany(Player::class)->orderby('position', 'asc');
    }

    public function fullName()
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
