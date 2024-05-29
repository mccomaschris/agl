<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Score;
use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Nova\Http\Requests\ResourcePreviewRequest;

class LiveScorecardController extends Controller
{
    /**
     * @param  Week|null  $week
     * @return RedirectResponse|View
     */
    public function show(?Week $week = null): RedirectResponse|View
    {
        if ($week == null) {
            $week = Week::whereDate('week_date', Carbon::now())->first();
        }

        if ($week->week_date < Carbon::now()->toDateString()) {
            return redirect('/scores/week/'.$week->id);
        }

        $year = Year::where('active', 1)->first();
        $player = Player::where('user_id', Auth::user()->id)->where('year_id', $year->id)->first();
        $score = Score::where('player_id', $player->id)->where('foreign_key', $week->id)->where('score_type',
            'weekly_score')->first();
        $opp_score = Score::where('player_id', $score->opponent()->id)->where('foreign_key',
            $week->id)->where('score_type', 'weekly_score')->first();

        return view('scorecard', [
            'week' => $week,
            'player' => $player,
            'score' => $score,
            'opp_score' => $opp_score,
        ]);
    }
}
