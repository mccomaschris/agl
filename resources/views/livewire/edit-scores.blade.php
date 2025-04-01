<div>
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight"></h1>

    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }}  Results</h1>

		<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More {{ $week->year->name }} Weeks
					<svg class="-mr-1 h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
					</svg>
				</button>
			</div>

			<div
				x-cloak
				x-show="open"
				x-transition:enter="transition ease-out duration-100"
				x-transition:enter-start="transform opacity-0 scale-95"
				x-transition:enter-end="transform opacity-100 scale-100"
				x-transition:leave="transition ease-in duration-75"
				x-transition:leave-start="transform opacity-100 scale-100"
				x-transition:leave-end="transform opacity-0 scale-95"
				class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
			>
				<div class="py-1" role="none">
					@foreach ($weeks as $item)
						<a wire:navigate href="/scores/week/{{ $item->id }}/edit" class="{{ ($week->id == $item->id) ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700' }} text-zinc-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</a>
					@endforeach
				</div>
			</div>
		</div>
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
				<livewire:edit-score :scoreId="$score->id" :key="$score->id" />
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
				<livewire:edit-score :scoreId="$score->id" :key="$score->id" />
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
				<livewire:edit-score :scoreId="$score->id" :key="$score->id" />
			@endforeach
		</x-table>
	</div>
</div>
