<?php

use Illuminate\View\View;
use Livewire\Volt\Component;
use App\Models\Year;

new class extends Component {
	public Year $year;

	public function rendering(View $view)
    {
        $view->title($this->year->name . ' Standings');
    }

    public function with(): array
    {
		return [
            'years' => Year::orderBy('name', 'desc')->get()
        ];
    }
}; ?>

<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<flux:heading size="xl">{{ $year->name }} Standings</flux:heading>
		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More Years Standings</flux:button>

			<flux:navmenu>
				@foreach ($years as $item)
					<flux:navmenu.item href="{{ route('standings', [$item]) }}" wire:navigate class="{{ $item->id === $year->id ? 'text-green-700! bg-zinc-50!' : '' }}">{{ $item->name }} Standings</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
	</div>

    <div class="flex flex-wrap mb-4">
		<div class="w-full lg:w-2/3 pr-0 lg:pr-4 mb-4 lg:mb-0">
			<flux:heading size="lg">Standings</flux:heading>
			<x-tables.standings-team :year="$this->year" />
		</div>

		<div class="w-full lg:w-1/3">
			<flux:heading size="lg">Individual Points</flux:heading>
			<x-tables.standings-player :year="$this->year" />
		</div>
	</div>
</div>
