<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Week;
use Carbon\Carbon;

class StandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        $years = Year::orderBy('name', 'desc')->get();
        $week = Week::where('year_id', $year->id)
            ->where('week_date', '>', Carbon::yesterday())
            ->first();

        $show_max = false;

        return view('standings.show', compact('year', 'years', 'show_max'));
    }
}
