<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\Week;
use Carbon\Carbon;

new
#[Layout('components.layouts.admin')]
#[Title('Edit Scores')]
class extends Component {
	public Week $week;

    public function mount(Week $week)
    {
        $this->week = $week;
    }

    public function with(): array
    {
        return [
			'week' => $this->week,
            'matchup_1' => $this->week->matchup('a'),
            'matchup_2' => $this->week->matchup('b'),
            'matchup_3' => $this->week->matchup('c'),
            'weeks' => Week::where('year_id', $this->week->year_id)->where('week_date', '<',
                Carbon::today())->orderBy('week_order', 'desc')->get(),
        ];
    }
}; ?>

<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<flux:heading size="xl">Editing Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }} Results</flux:heading>
		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More {{ $week->year->name }} Weeks</flux:button>

			<flux:navmenu>
				@foreach ($weeks as $item)
					<flux:navmenu.item href="/scores/week/{{ $item->id }}/edit" wire:navigate class="{{ $item->id === $week->id ? 'text-green-700! bg-zinc-50!' : '' }}">Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
	</div>

    <div class="w-full mb-6">
        <flux:heading size="lg" class="mb-2">Matchup #1</flux:heading>
		<x-table>
			<x-table.thead>
				<x-table.tr>
					<x-table.th>Player</x-table.th>
					<x-table.th class="text-center">Abs</x-table.th>
					<x-table.th class="text-center">Win</x-table.th>
					<x-table.th class="text-center">Sub</x-table.th>
					<x-table.th class="text-center">1</x-table.th>
					<x-table.th class="text-center">2</x-table.th>
					<x-table.th class="text-center">3</x-table.th>
					<x-table.th class="text-center">4</x-table.th>
					<x-table.th class="text-center">5</x-table.th>
					<x-table.th class="text-center">6</x-table.th>
					<x-table.th class="text-center">7</x-table.th>
					<x-table.th class="text-center">8</x-table.th>
					<x-table.th class="text-center">9</x-table.th>
					<x-table.th class="text-center">GROSS</x-table.th>
					<x-table.th class="text-center">PTS</x-table.th>
					<x-table.th></x-table.th>
				</x-table.tr>
			</x-table.thead>

			@foreach ($matchup_1 as $score)
				<livewire:admin.scores.score :isOdd="$loop->iteration % 2 !== 0" :scoreId="$score->id" :key="$score->id" />
			@endforeach
		</x-table>
	</div>

	<div class="w-full mb-6">
        <flux:heading size="lg" class="mb-2">Matchup #2</flux:heading>

		<x-table>
			<x-table.thead>
				<x-table.tr>
					<x-table.th>Player</x-table.th>
					<x-table.th class="text-center">Abs</x-table.th>
					<x-table.th class="text-center">Win</x-table.th>
					<x-table.th class="text-center">Sub</x-table.th>
					<x-table.th class="text-center">1</x-table.th>
					<x-table.th class="text-center">2</x-table.th>
					<x-table.th class="text-center">3</x-table.th>
					<x-table.th class="text-center">4</x-table.th>
					<x-table.th class="text-center">5</x-table.th>
					<x-table.th class="text-center">6</x-table.th>
					<x-table.th class="text-center">7</x-table.th>
					<x-table.th class="text-center">8</x-table.th>
					<x-table.th class="text-center">9</x-table.th>
					<x-table.th class="text-center">GROSS</x-table.th>
					<x-table.th class="text-center">PTS</x-table.th>
					<x-table.th></x-table.th>
				</x-table.tr>
			</x-table.thead>

			@foreach ($matchup_2 as $score)
				<livewire:admin.scores.score :isOdd="$loop->iteration % 2 !== 0" :scoreId="$score->id" :key="$score->id" />
			@endforeach
		</x-table>
	</div>

	<div class="w-full mb-6">
        <flux:heading size="lg" class="mb-2">Matchup #3</flux:heading>

		<x-table>
			<x-table.thead>
				<x-table.tr>
					<x-table.th>Player</x-table.th>
					<x-table.th class="text-center">Abs</x-table.th>
					<x-table.th class="text-center">Win</x-table.th>
					<x-table.th class="text-center">Sub</x-table.th>
					<x-table.th class="text-center">1</x-table.th>
					<x-table.th class="text-center">2</x-table.th>
					<x-table.th class="text-center">3</x-table.th>
					<x-table.th class="text-center">4</x-table.th>
					<x-table.th class="text-center">5</x-table.th>
					<x-table.th class="text-center">6</x-table.th>
					<x-table.th class="text-center">7</x-table.th>
					<x-table.th class="text-center">8</x-table.th>
					<x-table.th class="text-center">9</x-table.th>
					<x-table.th class="text-center">GROSS</x-table.th>
					<x-table.th class="text-center">PTS</x-table.th>
					<x-table.th></x-table.th>
				</x-table.tr>
			</x-table.thead>

			@foreach ($matchup_3 as $score)
				<livewire:admin.scores.score :isOdd="$loop->iteration % 2 !== 0" :scoreId="$score->id" :key="$score->id" />
			@endforeach
		</x-table>
	</div>
</div>
