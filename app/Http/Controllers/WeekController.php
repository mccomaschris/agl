<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class WeekController extends Controller
{
    /**
     * @param  Year  $year
     * @return View
     */
    public function show(Year $year): View
    {
        $weeks = Cache::remember('weeks', 43200, function () use ($year) {
            return Week::with('team_a', 'team_b', 'team_c', 'team_d', 'team_e', 'team_f')
                ->where('year_id', $year->id)
                ->where('week_date', '>', Carbon::yesterday())->get();
        });

        return view('weeks.show', compact('year', 'weeks'));
    }
}
