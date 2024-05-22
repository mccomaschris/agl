<?php

namespace App\Livewire;

use App\Models\Year;
use Livewire\Component;
use Livewire\Attributes\Url;

class AllStats extends Component
{
	public Year $year;

	#[Url]
	public $sortCol = 'gross_avg';

	#[Url]
	public $sortAsc = false;

	public function sortBy($column)
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortCol = $column;
            $this->sortAsc = false;
        }
    }

    protected function applySorting($query)
    {
        if ($this->sortCol) {
            $column = match ($this->sortCol) {
                'gross_avg' => 'gross_avg',
            };

            $query->orderBy($column, $this->sortAsc ? 'asc' : 'desc');
        }

        return $query;
    }

    public function render()
    {
		$query = $this->year->players()->with('user')->with(['scores' => function ($query) {
			$query->where('score_type', 'weekly_score');
		}]);

		$query = $this->applySorting($query);

        return view('livewire.all-stats', [
			'years' => Year::orderBy('name', 'desc')->get(),
			'players' => $query->get(),
		]);
    }
}
