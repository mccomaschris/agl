<?php

namespace App\Livewire;

use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Livewire\Component;

class PlayoffIndex extends Component
{
    public function render()
    {
		$year = Year::where('active', 1)->first();

		return view('livewire.playoff-index', [
			'year' => $year,
			'week' => Week::with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->where('year_id', $year->id)->where('week_date', '>', Carbon::yesterday())->first(),
			'last_week' => Week::where('year_id', $year->id)->where('week_date', '<', Carbon::today())->orderBy('week_date', 'desc')->first()
		]);
    }
}
