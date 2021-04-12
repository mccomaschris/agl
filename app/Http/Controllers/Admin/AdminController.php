<?php

namespace App\Http\Controllers\Admin;

use App\Models\Week;
use App\Models\Year;
use App\Models\Score;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $year = Year::where('active', 1)->first();
        $weeks = Week::where('year_id', $year->id)->orderBy('week_order', 'desc')->get();
        $last_week = Week::where('year_id', $year->id)->where('week_date', '<=', Carbon::yesterday())->orderBy('week_date', 'desc')->first();

        return view('admin.index', compact('year', 'weeks', 'last_week'));
    }

    public function rankings()
    {

        $one = Score::where('score_type', 'weekly_score')->whereNotNull('hole_1')->average('hole_1');
        $two = Score::where('score_type', 'weekly_score')->whereNotNull('hole_2')->average('hole_2');
        $three = Score::where('score_type', 'weekly_score')->whereNotNull('hole_3')->average('hole_3');
        $four = Score::where('score_type', 'weekly_score')->whereNotNull('hole_4')->average('hole_4');
        $five = Score::where('score_type', 'weekly_score')->whereNotNull('hole_5')->average('hole_5');
        $six = Score::where('score_type', 'weekly_score')->whereNotNull('hole_6')->average('hole_6');
        $seven = Score::where('score_type', 'weekly_score')->whereNotNull('hole_7')->average('hole_7');
        $eight = Score::where('score_type', 'weekly_score')->whereNotNull('hole_8')->average('hole_8');
        $nine = Score::where('score_type', 'weekly_score')->whereNotNull('hole_9')->average('hole_9');

        return view('admin.rankings', compact('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'));
    }
}
