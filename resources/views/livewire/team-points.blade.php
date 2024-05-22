<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Team Points</h1>

		<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More Years Team Points
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
						<a wire:navigate href="/team-points/{{ $item->name }}" class="{{ ($year->id == $item->id) ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }} text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $item->name }} Team Points</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

    <div class="rounded bg-grey-100 border-grey-300 mb-4 border px-4 py-4 text0s">NOTE: <strong>(S)</strong> denotes the round was played by a substitue.</div>

	@foreach ($teams as $team)
		<h3 class="mb-2 lg:text-xl text-darkest-grey" id="{{ $team->id }}">Team {{ $team->name }}</h3>

		<div class="overflow-x-scroll">
      		<table class="table table-bordered table-striped w-full mb-6 lg:mb-8">
        		<thead>
          			<tr class="course">
            			<th>Week</th>
						<th class="text-center">1</th>
						<th class="text-center">2</th>
						<th class="text-center">3</th>
						<th class="text-center">4</th>
						<th class="text-center">5</th>
						<th class="text-center">6</th>
						<th class="text-center">7</th>
						<th class="text-center">8</th>
						<th class="text-center">9</th>
						<th class="text-center">10</th>
						<th class="text-center">11</th>
						<th class="text-center">12</th>
						<th class="text-center">13</th>
						<th class="text-center">14</th>
						<th class="text-center">15</th>
						<th class="text-center">16</th>
						<th class="text-center">17</th>
						<th class="text-center">18</th>
						<th class="text-center">19</th>
						<th class="text-center">20</th>
						<th class="text-center">Total</th>
						<th class="text-center">Win %</th>
						<th class="text-center">Won</th>
						<th class="text-center">Lost</th>
						<th class="text-center">Tied</th>
						<th class="text-center">Win Rank</th>
					</tr>
				</thead>

				@foreach ($team->players as $player)
          			<tr>
						<td><a href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>

						@foreach ($player->scores as $score)
							@if ($score->absent)
								<td class="text-center absent_row">A</td>
							@elseif ($score->injury)
								<td class="text-center absent_row">I</td>
							@else
								<td class="text-center"><span class="text-grey-700">{{ $score->points }} @if($score->substitute_id > 0)<span class="font-bold">(S)</span>@endif</span></td>
							@endif
						@endforeach

						<td class="text-center font-semibold">{{ $player->points }}</td>
						<td class="text-center font-semibold">{{ number_format($player->win_pct, 3, '.', ',') }}</td>
						<td class="text-center font-semibold">{{ $player->won }}</td>
						<td class="text-center font-semibold">{{ $player->lost }}</td>
						<td class="text-center font-semibold">{{ $player->tied }}</td>
						<td class="text-center font-semibold">{{ $player->wins_rank }}</td>
					</tr>
				@endforeach

				<tr class="totals">
					<td colspan="21">TEAM TOTALS</td>
					<td class="text-center">{{ $team->points }}</td>
					<td class="text-center"></td>
					<td class="text-center">{{ $team->won }}</td>
					<td class="text-center">{{ $team->lost }}</td>
					<td class="text-center">{{ $team->tied }}</td>
					<td class="text-center"></td>
				</tr>
			</table>
		</div>
	@endforeach
</div>
