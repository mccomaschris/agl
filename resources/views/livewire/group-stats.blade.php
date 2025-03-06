<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Group Stats</h1>

		<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More Years Group Stats
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
					@foreach ($years as $item)
						<a wire:navigate href="/group-stats/{{ $item->name }}" class="{{ ($year->id == $item->id) ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700' }} text-zinc-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $item->name }} Group Stats</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="pointer-events-none sm:flex my-6 lg:my-10">
		<div class="flex items-center justify-between gap-x-6 bg-green-500 px-6 py-2.5 sm:rounded-xl sm:py-3 sm:pr-3.5 sm:pl-4">
			<p class="text-sm/6 text-white">
				<strong class="font-semibold">Note</strong>
				<svg viewBox="0 0 2 2" class="mx-2 inline size-0.5 fill-current" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>
				<strong>(S)</strong> denotes the round was played by a substitute.
			</p>
	 	</div>
  	</div>

	<div class="mb-12 last:mb-0">
		<h3 class="mb-2 lg:text-xl">One Players</h3>
		<div class="overflow-x-auto">
			<x-tables.stats-table :players="$ones" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<h3 class="mb-2 lg:text-xl">Two Players</h3>
		<div class="overflow-x-auto">
			<x-tables.stats-table :players="$twos" />
		</div>
	</div>

	<div class="mb-12 last:mb-0">
		<h3 class="mb-2 lg:text-xl">Three Players</h3>
		<div class="overflow-x-auto">
			<x-tables.stats-table :players="$threes" />
		</div>
	</div>

	<div class="mb-12">
		<h3 class="mb-2 lg:text-xl">Four Players</h3>
		<div class="overflow-x-auto">
			<x-tables.stats-table :players="$fours" />
		</div>
	</div>
</div>
