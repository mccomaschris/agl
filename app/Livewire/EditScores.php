<?php

namespace App\Livewire;

use App\Models\Week;
use Carbon\Carbon;
use Livewire\Component;

class EditScores extends Component
{
    public Week $week;

    public function mount(Week $week)
    {
        $this->week = $week;
    }

    public function render()
    {
        return view('livewire.edit-scores', [
            'week' => $this->week,
            'matchup_1' => $this->week->matchup('a'),
            'matchup_2' => $this->week->matchup('b'),
            'matchup_3' => $this->week->matchup('c'),
            'weeks' => Week::where('year_id', $this->week->year_id)->where('week_date', '<',
                Carbon::today())->orderBy('week_order', 'desc')->get(),
        ]);
    }
}
