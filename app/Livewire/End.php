<?php

namespace App\Livewire;

use App\Models\Year;
use Livewire\Component;

class End extends Component
{
    public function render()
    {
        return view('livewire.end', [
			'year' => Year::where('active', 1)->first(),
		]);
    }
}
