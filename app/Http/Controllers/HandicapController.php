<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\View\View;

class HandicapController extends Controller
{
    /**
     * @param  Year  $year
     * @return View
     */
    public function show(Year $year): View
    {
        $years = Year::orderBy('name', 'desc')->get();
        $ones = $year->handicaps(1);
        $twos = $year->handicaps(2);
        $threes = $year->handicaps(3);
        $fours = $year->handicaps(4);

        return view('handicaps.show', compact('year', 'years', 'ones', 'twos', 'threes', 'fours'));
    }
}
