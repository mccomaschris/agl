<?php

namespace App\Http\Controllers;

use App\Models\Year;

class HandicapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        $years = Year::orderBy('name', 'desc')->get();
        $ones = $year->handicaps(1);
        $twos = $year->handicaps(2);
        $threes = $year->handicaps(3);
        $fours = $year->handicaps(4);

        return view('handicaps.show', compact('year', 'years', 'ones', 'twos', 'threes', 'fours'));
    }
}
