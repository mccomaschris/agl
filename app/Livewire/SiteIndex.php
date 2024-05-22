<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Week;
use App\Models\Year;
use Livewire\Component;

class SiteIndex extends Component
{
    public function render()
    {
		$year = Year::where('active', 1)->first();
        return view('livewire.site-index', [
			'year' => $year,
			'week' => Week::with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->where('year_id', $year->id)->where('week_date', '>', Carbon::yesterday())->first(),
			'last_week' => Week::where('year_id', $year->id)->where('week_date', '<', Carbon::today())->orderBy('week_date', 'desc')->first(),
		]);
    }
}
