<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Week;
use Carbon\Carbon;
use Illuminate\View\View;

class StandingController extends Controller
{
    /**
     * @param  Year  $year
     * @return View
     */
    public function show(Year $year): View
    {
        $years = Year::orderBy('name', 'desc')->get();
        $week = Week::where('year_id', $year->id)
            ->where('week_date', '>', Carbon::yesterday())
            ->first();

        $show_max = false;

        return view('standings.show', compact('year', 'years', 'show_max'));
    }
}
