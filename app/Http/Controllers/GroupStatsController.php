<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Team;
use App\Models\Player;

class GroupStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        $years = Year::orderBy('name', 'desc')->get();

        $teams = Team::where('year_id', $year->id)->pluck('id');

        $ones = Player::with('weekly_scores')->where('year_id', $year->id)->where('position', 1)->get();
        $twos = Player::with('weekly_scores')->where('year_id', $year->id)->where('position', 2)->get();
        $threes = Player::with('weekly_scores')->where('year_id', $year->id)->where('position', 3)->get();
        $fours = Player::with('weekly_scores')->where('year_id', $year->id)->where('position', 4)->get();

        return view('group-stats.show', compact('year', 'years', 'ones', 'twos', 'threes', 'fours'));
    }
}
