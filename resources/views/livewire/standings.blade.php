<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Standings</h1>

		<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More Years Standings
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
						<a wire:navigate href="/standings/{{ $item->name }}" class="{{ ($year->id == $item->id) ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700' }} text-zinc-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $item->name }} Standings</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

    <div class="flex flex-wrap mb-4">
		<div class="w-full lg:w-2/3 pr-0 lg:pr-4 mb-4 lg:mb-0">
			<h2 class="text-xl lg:text-2xl mt-2 mb-2">Standings</h2>
			<x-standings.team :year="$this->year" />
		</div>

		<div class="w-full lg:w-1/3">
			<h2 class="text-xl lg:text-2xl mt-2 mb-2">Individual Points</h2>
			<x-standings.player :year="$this->year" />
		</div>
	</div>
</div>
