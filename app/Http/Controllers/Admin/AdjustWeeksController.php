<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;

class AdjustWeeksController extends Controller
{
    public function update(Request $request, Week $week)
    {
        $year = Year::where('id', $week->year_id)->first();
        $weeks = Week::where('year_id', $year->id)->where('week_date', '>=', $week->week_date)->orderBy('week_date', 'asc')->get();

        $days = 7;

        foreach ($weeks as $week) {
            $new_date = Carbon::parse($week->week_date)->addDays($days);

            if($new_date == Carbon::parse($year->skip_date)) {
                $new_date = Carbon::parse($new_date)->addDays($days);
            }

            $week->week_date = $new_date;
            $week->save();

        }
    }
}
