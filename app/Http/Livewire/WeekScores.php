<?php

namespace App\Http\Livewire;

use App\Models\Week;
use Carbon\Carbon;
use Livewire\Component;

class WeekScores extends Component
{
    public $week;

    protected $rules = [
        'week' => 'required',
    ];

    public function render()
    {
        return view('livewire.week-scores', [
            'week' => $this->week,
            'weeks' => Week::where('year_id', $this->week->year_id)->orderBy('week_order', 'desc')->get(),
            'matchup_1' => $this->week->matchup('a'),
            'matchup_2' => $this->week->matchup('b'),
            'matchup_3' => $this->week->matchup('c'),
        ]);
    }
}
