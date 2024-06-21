<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Week;
use App\Models\Year;

class WeekIndex extends Component
{
	use WithPagination;

	public $yearFilter = '';

	#[Layout('components.admin')]
    public function render()
    {
		$query = Week::query();

		if ($this->yearFilter) {
			$query->where('year_id', $this->yearFilter);
		}

        return view('livewire.week-index', [
			'weeks' => $query->orderby('id', 'desc')->paginate(20),
			'years' => Year::orderby('name', 'desc')->get(),
		]);
    }
}
