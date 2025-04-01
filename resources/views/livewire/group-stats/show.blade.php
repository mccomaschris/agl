<?php

use Illuminate\View\View;
use Livewire\Volt\Component;
use App\Models\Year;
use App\Models\Player;
use App\Models\Team;

new class extends Component {
	public Year $year;

	public function rendering(View $view)
    {
        $view->title($this->year->name . ' Group Stats');
    }

    public function with(): array
    {
		return [
            'years' => Year::orderBy('name', 'desc')->get(),
            'teams' => Team::where('year_id', $this->year->id)->pluck('id'),
            'ones' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 1)->get(),
            'twos' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 2)->get(),
            'threes' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 3)->get(),
            'fours' => Player::with('weekly_scores')->where('year_id', $this->year->id)->where('position', 4)->get(),
        ];
    }
}; ?>

<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<flux:heading size="xl">{{ $year->name }} Group Stats</flux:heading>
		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More Years Group Stats</flux:button>

			<flux:navmenu>
				@foreach ($years as $item)
					<flux:navmenu.item href="{{ route('group-stats', [$item]) }}" wire:navigate class="{{ $item->id === $year->id ? 'text-green-700! bg-zinc-50!' : '' }}">{{ $item->name }} Group Stats</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
	</div>

	<x-sub-note />

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">One Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.stats :players="$ones" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">Two Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.stats :players="$twos" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<flux:heading size="lg" class="mb-1">Three Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.stats :players="$threes" />
		</div>
	</div>

	<div class="mb-12">
		<flux:heading size="lg" class="mb-1">Four Players</flux:heading>
		<div class="overflow-x-auto">
			<x-tables.stats :players="$fours" />
		</div>
	</div>
</div>
