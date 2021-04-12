<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Year;
use App\Models\Player;
use App\Models\Score;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveScorecardController extends Controller
{
    public function show(Week $week = null)
    {
        if ($week == null) {
            $week = Week::whereDate('week_date', Carbon::now())->first();
        }

        if ($week->week_date < Carbon::now()->toDateString()) {
            return redirect('/scores/week/' . $week->id);
        }

        $year = Year::where('active', 1)->first();
        $player = Player::where('user_id', Auth::user()->id)->where('year_id', $year->id)->first();
        $score = Score::where('player_id', $player->id)->where('foreign_key', $week->id)->where('score_type', 'weekly_score')->first();
        $opp_score = Score::where('player_id', $score->opponent()->id)->where('foreign_key', $week->id)->where('score_type', 'weekly_score')->first();
        return view('scorecard', [
            'week' => $week,
            'player' => $player,
            'score' => $score,
            'opp_score' => $opp_score
        ]);

    }
}
