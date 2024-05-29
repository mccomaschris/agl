<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Year;
use Illuminate\View\View;

class TeamStatsController extends Controller
{
    /**
     * @param  Year  $year
     * @return View
     */
    public function show(Year $year): View
    {
        $years = Year::orderBy('name', 'desc')->get();
        $teams = Team::where('year_id', $year->id)->with('players', 'players.user')->with([
            'players.scores' => function ($query) {
                $query->where('score_type', 'weekly_score');
            },
        ])->get();

        return view('team-stats.show', compact('year', 'years', 'teams'));
    }
}
