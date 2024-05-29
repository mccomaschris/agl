<?php

namespace App\Livewire;

use App\Models\Year;
use Livewire\Component;

class Handicaps extends Component
{
    public Year $year;

    public function render()
    {
        return view('livewire.handicaps', [
            'years' => Year::orderBy('name', 'desc')->get(),
            'ones' => $this->year->handicaps(1),
            'twos' => $this->year->handicaps(2),
            'threes' => $this->year->handicaps(3),
            'fours' => $this->year->handicaps(4),
        ]);
    }
}
