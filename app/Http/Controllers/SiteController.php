<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{

    /**
     * Show the homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = Year::where('active', 1)->first();

        // $week = Week::with(
        //         'team_a', 'team_b',
        //         'team_c', 'team_d',
        //         'team_e', 'team_f')
        //         ->where('year_id', $year->id)
        //         ->where('week_date', '>', Carbon::yesterday())
        //         ->first();


        $last_week = Week::where('year_id', $year->id)->where('week_date', '<', Carbon::today())->orderBy('week_date', 'desc')->first();

        // return view('site.index', compact('year', 'week', 'last_week'));
        return view('site.playoff', compact('year', 'last_week'));
    }
}
