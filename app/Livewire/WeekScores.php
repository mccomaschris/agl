<?php

namespace App\Livewire;

use App\Models\Score;
use App\Models\Week;
use Livewire\Component;

class WeekScores extends Component
{
    public $week;

    public function mount(Week $week)
    {
        $this->week = $week;
    }

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
            'weekly_winners' => Score::with('player')->where('foreign_key', $this->week->id)->where('weekly_winner', 1)->where('score_type', 'weekly_score')->orderby('id', 'desc')->get(),
        ]);
    }
}
