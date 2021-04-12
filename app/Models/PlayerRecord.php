<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerRecord extends Model
{

    protected $guarded = [];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function opponent()
    {
        return $this->belongsTo(Player::class);
    }
}
