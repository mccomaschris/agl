<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Team Stats</h1>

		<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-grey-900 shadow-sm ring-1 ring-inset ring-grey-300 hover:bg-grey-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More Years Team Stats
					<svg class="-mr-1 h-5 w-5 text-grey-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
					@foreach ($years as $item)
						<a wire:navigate href="/team-stats/{{ $item->name }}" class="{{ ($year->id == $item->id) ? 'bg-grey-100 text-grey-900' : 'text-grey-700' }} text-grey-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $item->name }} Team Stats</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="rounded bg-grey-100 border-grey-300 mb-4 border px-4 py-4 text-sm flex flex-col gap-2">
		<div class="font-bold text-base">NOTE</div>
		<div><strong>(S)</strong> denotes the round was played by a substitute.</div>
	</div>

    @foreach ($teams as $team)
		<h3 class="mb-2 lg:text-xl {{ $loop->first ? 'mt-0' : 'mt-6' }}">Team {{ $team->name }}</h3>
		<div class="overflow-x-auto">
			<x-tables.stats-table :players="$team->players" />
		</div>
	@endforeach
</div>
