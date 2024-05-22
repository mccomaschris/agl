<?php

namespace App\Http\Controllers;

use App\Models\Score;

class ChrisVsMikeController extends Controller
{
    public function show()
	{
		$mike = Score::where('player_id', 293)->where('score_type', 'season_avg')->first();

		$chris = Score::where('player_id', 281)->where('score_type', 'season_avg')->first();

		return view('chris-vs-mike', compact('mike', 'chris'));
	}
}
