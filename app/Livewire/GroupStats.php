<?php

namespace App\Livewire;

use App\Models\Player;
use App\Models\Team;
use App\Models\Year;
use Livewire\Component;

class GroupStats extends Component
{
    public Year $year;

    public function render()
    {
        return view('livewire.group-stats', [
            'years' => Year::orderBy('name', 'desc')->get(),
            'teams' => Team::where('year_id', $this->year->id)->pluck('id'),
            'ones' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 1)->get(),
            'twos' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 2)->get(),
            'threes' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 3)->get(),
            'fours' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 4)->get(),
        ]);
    }
}
