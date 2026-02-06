<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\View\View;

class WeekController extends Controller
{
    public function show(Year $year): View
    {
        $weeks = Week::with('team_a', 'team_b', 'team_c', 'team_d', 'team_e', 'team_f')
            ->where('year_id', $year->id)
            ->where('week_date', '>', Carbon::yesterday())->get();

        return view('weeks.show', compact('year', 'weeks'));
    }
}
