<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Team;

class TeamPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        $years = Year::orderBy('name', 'desc')->get();
        $teams = Team::where('year_id', $year->id)->with('players', 'players.user')->with(['players.scores' => function ($query) {
            $query->where('score_type', 'weekly_score');
        }])->get();

        return view('team-points.show', compact('year', 'years', 'teams'));
    }
}
