<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    protected $guarded = [];

    protected $with = ['player'];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
