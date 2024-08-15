<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Week;
use App\Models\Year;
use App\Models\Score;
use Livewire\Component;
use Livewire\Attributes\Computed;

class SiteIndex extends Component
{
	#[Computed]
	public function weekUpdated()
	{
		$year = Year::where('active', 1)->first();
		$last_week = Week::where('year_id', $year->id)->where('week_date', '<', Carbon::today())->orderBy('week_date', 'desc')->first();
		return Score::where('score_type', 'weekly_score')->where('gross', '>', 0)->where('foreign_key', $last_week->id)->count();
	}


    public function render()
    {
		$year = Year::where('active', 1)->first();

        return view('livewire.site-index', [
			'year' => $year,
			'week' => Week::with('team_a', 'team_b','team_c', 'team_d','team_e', 'team_f')->where('year_id', $year->id)->where('week_date', '>', Carbon::yesterday())->first(),
			'last_week' => Week::where('year_id', $year->id)->where('week_date', '<', Carbon::today())->orderBy('week_date', 'desc')->first()
		]);
    }
}
