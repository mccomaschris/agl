<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\View\View;

class ChrisVsMikeController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        $mike = Score::where('player_id', 293)->where('score_type', 'season_avg')->first();

        $chris = Score::where('player_id', 281)->where('score_type', 'season_avg')->first();

        return view('chris-vs-mike', compact('mike', 'chris'));
    }
}
