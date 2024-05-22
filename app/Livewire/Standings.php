<?php

namespace App\Livewire;

use App\Models\Year;
use Livewire\Component;

class Standings extends Component
{
	public Year $year;

    public function render()
    {
        return view('livewire.standings', [
			'years' => Year::orderBy('name', 'desc')->get(),

		]);
    }
}
