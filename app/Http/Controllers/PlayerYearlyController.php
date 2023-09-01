<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Score;
use App\Models\Player;
use App\Models\Year;
use Illuminate\Http\Request;

class PlayerYearlyController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
		$players = Player::where('user_id', $user->id)->pluck('id');
        $years = Score::with('year')
			->whereIn('player_id', $players)
			->where('score_type', 'season_avg')
			->orderBy(Year::select('name')
			->whereColumn('years.id', 'scores.foreign_key'))
			->get();

        return view('player-year.show',
            compact('players', 'years', 'user')
		);
    }
}
