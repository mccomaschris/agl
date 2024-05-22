<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} All Stats</h1>

		<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More Years All Stats
					<svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
						<a wire:navigate href="/all-stats/{{ $item->name }}" class="{{ ($year->id == $item->id) ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }} text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $item->name }} All Stats</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="my-12">
		<form wire:submit class="grid grid-cols-2 gap-12">
			<div>
				<select wire:model="sortBy">
					<option value="week_1">Week 1</option>
					<option value="week_2">Week 2</option>
					<option value="week_3">Week 3</option>
					<option value="week_4">Week 4</option>
					<option value="week_5">Week 5</option>
					<option value="week_6">Week 6</option>
					<option value="week_7">Week 7</option>
					<option value="week_8">Week 8</option>
					<option value="week_9">Week 9</option>
					<option value="week_10">Week 10</option>
					<option value="week_11">Week 11</option>
					<option value="week_12">Week 12</option>
					<option value="week_13">Week 13</option>
					<option value="week_14">Week 14</option>
					<option value="week_15">Week 15</option>
					<option value="week_16">Week 16</option>
					<option value="week_17">Week 17</option>
					<option value="week_18">Week 18</option>
					<option value="week_19">Week 19</option>
					<option value="week_20">Week 20</option>
					<option value="gross_avg">Gross Average</option>
					<option value="net_avg">Net Average</option>
					<option value="low_gross">Low Gross</option>
					<option value="high_gross">High Gross</option>
					<option value="low_net">Low Net</option>
					<option value="eagles">Eagles</option>
					<option value="birdies">Birdies</option>
				</select>
			</div>

			<div>
				<select wire:model="sortOrder">
					<option value="asc">Ascending</option>
					<option value="desc">Descending</option>
				</select>
			</div>
		</form>
	</div>

	<div class="overflow-x-scroll">
		<x-tables.stats-table :players="$year->players" />
	</div>
</div>
