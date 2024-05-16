<?php

namespace App\Livewire;

use App\Models\Score as ModelsScore;
use Livewire\Component;

class Score extends Component
{

    public $score;

    protected $rules = [
        'hole_1' => 'integer',
        'hole_2' => 'integer',
        'hole_3' => 'integer',
        'hole_4' => 'integer',
        'hole_5' => 'integer',
        'hole_6' => 'integer',
        'hole_7' => 'integer',
        'hole_8' => 'integer',
        'hole_9' => 'integer',
    ];

    public function render()
    {
        return view('livewire.score', [
            'score' => $this->score,
        ]);
    }
}
