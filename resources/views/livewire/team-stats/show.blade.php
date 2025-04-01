<?php

use Illuminate\View\View;
use Livewire\Volt\Component;
use App\Models\Team;
use App\Models\Year;

new class extends Component {
	public Year $year;

	public function rendering(View $view)
    {
        $view->title($this->year->name . ' Team Stats');
    }

    public function with(): array
    {
		return [
            'years' => Year::orderBy('name', 'desc')->get(),
			'teams' => Team::where('year_id', $this->year->id)->with('players', 'players.user')->with(['players.scores' => function ($query) {
				$query->where('score_type', 'weekly_score');
			}])->get(),
        ];
    }
}; ?>

<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<flux:heading size="xl">{{ $year->name }} Team Stats</flux:heading>
		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More Years Team Stats</flux:button>

			<flux:navmenu>
				@foreach ($years as $item)
					<flux:navmenu.item href="{{ route('team-stats', [$item]) }}" wire:navigate class="{{ $item->id === $year->id ? 'text-green-700! bg-zinc-50!' : '' }}">{{ $item->name }} Team Stats</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
	</div>

	<x-sub-note />

    @foreach ($teams as $team)
		<div class="mb-12 last:mb-0">
			<flux:heading size="lg" class="mb-1" id="{{ $team->id }}">Team {{ $team->name }}</flux:heading>
			<div class="overflow-x-auto">
				<x-tables.stats :players="$team->players" />
			</div>
		</div>
	@endforeach
</div>
