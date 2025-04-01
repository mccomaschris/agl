<?php

namespace App\Models;

use Cache;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
	use HasFactory;

    protected $guarded = [];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class, 'foreign_key');
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function opponent(): Player|false
    {
        if ($this->score_type != 'weekly_score') {
            return false;
        }

        $week = Week::find($this->foreign_key);
        $player = Player::find($this->player_id);
        $team = Team::find($player->team_id);

        $opponent_team_id = null;

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

        return Player::where('team_id', $opponent_team_id)->where('position', $player->position)->first();
    }
}
