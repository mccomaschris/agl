<?php

use Illuminate\View\View;
use Livewire\Volt\Component;
use App\Models\Year;

new class extends Component {
	public Year $year;

	public function rendering(View $view)
    {
        $view->title($this->year->name . ' Handicaps');
    }

    public function with(): array
    {
		return [
            'years' => Year::orderBy('name', 'desc')->get(),
            'ones' => $this->year->handicaps(1),
            'twos' => $this->year->handicaps(2),
            'threes' => $this->year->handicaps(3),
            'fours' => $this->year->handicaps(4),
        ];
    }
}; ?>

<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<flux:heading size="xl">{{ $year->name }} Handicaps</flux:heading>
		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More Years Handicaps</flux:button>

			<flux:navmenu>
				@foreach ($years as $item)
					<flux:navmenu.item href="{{ route('handicaps', [$item]) }}" wire:navigate class="{{ $item->id === $year->id ? 'text-green-700! bg-zinc-50!' : '' }}">{{ $item->name }} Handicaps</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">One Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$ones" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">Two Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$twos" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">Three Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$threes" />
		</div>
	</div>

	<div class="mb-12">
		<flux:heading size="lg" class="mb-1">Four Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.handicap :players="$fours" />
		</div>
	</div>
</div>
