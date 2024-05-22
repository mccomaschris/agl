<?php

namespace App\Livewire;

use App\Models\Team;
use App\Models\Year;
use Livewire\Component;

class TeamStats extends Component
{
	public Year $year;

    public function render()
    {
        return view('livewire.team-stats', [
			'years' => Year::orderBy('name', 'desc')->get(),
			'teams' => Team::where('year_id', $this->year->id)->with('players', 'players.user')->with(['players.scores' => function ($query) {
				$query->where('score_type', 'weekly_score');
			}])->get(),
		]);
    }
}
