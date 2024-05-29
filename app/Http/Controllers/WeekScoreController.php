<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Score;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WeekScoreController extends Controller
{
    /**
     * @param  Week  $week
     * @return View
     */
    public function show(Week $week): View
    {
        $weeks = Week::where('year_id', $week->year_id)->where('week_date', '<', Carbon::today())->orderBy('week_order',
            'desc')->get();

        $matchup_1 = $week->matchup('a');
        $matchup_2 = $week->matchup('b');
        $matchup_3 = $week->matchup('c');

        $weekly_winners = Score::with('player')->where('foreign_key', $week->id)->where('weekly_winner',
            1)->where('score_type', 'weekly_score')->get();

        return view('week-score.show',
            compact('week', 'weeks', 'matchup_1', 'matchup_2', 'matchup_3', 'weekly_winners'));
    }
}
