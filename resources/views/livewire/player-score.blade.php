<div>
	@if(count($notes))
		<div class="bg-red-700 w-full px-4 py-4 rounded">
			<div class="text-white font-bold text-lg uppercase">Note</div>

			<div class="mt-4 text-white">
				@foreach ($notes as $note)
					{{ $note->note }}
				@endforeach
			</div>
		</div>
	@endif

	<div class="flex flex-wrap items-center lg:items-start w-full my-8">
		<div class="flex flex-col flex-grow leading-snug">
			<h1 class="text-2xl lg:text-4xl uppercase font-semibold">{{ $player->user->name }}</h1>
			<span class="text-lg lg:text-2xl text-zinc-600 uppercase font-semibold">{{ $player->team->year->name }} <span class="font-normal">Season</span></span></h1>
		</div>

		<div class="mt-6 lg:mt-0 w-full lg:w-auto">
			<div class="flex flex-col lg:flex-row items-center">
				<div class="mr-0 lg:mr-3 ">
					<a href="/players/{{ $player->user->id }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded hover:text-white focus:outline-none focus:shadow-outline font-semibold">{{ $player->user->name }} Full History</a>
				</div>

				<div class="mt-4 lg:mt-0">
					@if(count($prev_seasons) > 1)
						<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
							<div>
								<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-1 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
									More {{ $player->user->name }} Seasons
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
									@foreach ($prev_seasons as $season)
										<a wire:navigate href="{{ route('player-score', ['player' => $season->player_id]) }}" class="{{ ($player->id == $season->player_id) ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700' }} text-zinc-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $player->user->name }} {{ $season->year_name }} Season</a>
									@endforeach
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
		<div class="lg:col-span-3">
			<div class="flex my-2 items-center uppercase">
				<div class="flex-grow font-semibold lg:text-lg">Season Totals/Averages</div>
			</div>
			<div class="overflow-x-auto">
				<div class="flow-root">
					<div class="">
						<div class="inline-block min-w-full py-2 align-middle">
							<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg mx-1">
								<div class="overflow-x-auto">
									<table class="min-w-full divide-y divide-gray-300">
										<thead class="bg-gray-50">
											<tr>
												<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6 border-r border-zinc-300">Hole</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">1</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">2</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">3</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">4</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">5</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">6</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">7</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">8</th>
												<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">9</th>
												<th scope="col" colspan="10" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900"></th>
											</tr>
										</thead>
										<tbody>
											<tr class="bg-green-600">
												<td class="py-3.5 pr-3 pl-4 text-left text-sm text-green-100 sm:pl-6 border-r border-green-800">Par</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">4</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">3</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">4</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">4</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">5</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">3</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">5</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">4</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">5</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Gross</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Par</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Net</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Par</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Points</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Eg</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Br</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Par</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Bg</td>
												<td class="text-center px-1 py-3.5 text-sm text-green-100 border-r border-green-800">Dbg+</td>
											</tr>
											<tr class="even:bg-white odd:bg-gray-50/50 border-b border-zinc-300">
												<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6 border-r border-zinc-300">Totals</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_1, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_2, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_3, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_4, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_5, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_6, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_7, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_8, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->hole_9, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->gross, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->gross_par, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->net, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ number_format($season_avg->net_par, 1, '.', ',') }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ $season_avg->points ? $season_avg->points : '0' }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ $season_avg->eagle ? $season_avg->eagle : '0' }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ $season_avg->birdie ? $season_avg->birdie : '0' }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ $season_avg->par ? $season_avg->par : '0' }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ $season_avg->bogey ? $season_avg->bogey : '0' }}</td>
												<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300">{{ $season_avg->double_bogey ? $season_avg->double_bogey : '0' }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mb-12 mt-12 last:mb-0">
				<x-tables.player-scores-table :scores="$qtr_1" :average="$qtr_1_avg" :handicap="$player->hc_first" title="Weeks 1-5" />
			</div>

			<div class="mb-12 last:mb-0">
				<x-tables.player-scores-table :scores="$qtr_2" :average="$qtr_2_avg" :handicap="$player->hc_second" title="Weeks 6-10" />
			</div>

			<div class="mb-12 last:mb-0">
				<x-tables.player-scores-table :scores="$qtr_3" :average="$qtr_3_avg" :handicap="$player->hc_third" title="Weeks 11-15" />
			</div>

			@if ( $player->team->year->name != '2020' )
				<div class="mb-12 last:mb-0">
					<x-tables.player-scores-table :scores="$qtr_4" :average="$qtr_4_avg" :handicap="$player->hc_fourth" title="Weeks 16-20" />
				</div>
			@endif
		</div>

		<div class="">
			<div class="grid grid-cols-1 gap-4">
				<div class="">
					<div class="flex flex-col p-6 lg:pb-2 bg-zinc-900 rounded lg:rounded-b-none">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Points</h3>
						<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-zinc-300">Total</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ $player->points }}</span>
							</div>
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-zinc-300">Rank</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ ordinal($player->points_rank) }}</span>
							</div>
						</div>
					</div>
				</div>

				<div class="">
					<div class="flex flex-col p-6 lg:pt-2 bg-zinc-900 rounded lg:rounded-t-none">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Wins</h3>
						<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-zinc-300">Total</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ $player->won }}</span>
							</div>
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-zinc-300">Rank</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ ordinal($player->wins_rank) }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-wrap mt-6">
				<div class="w-full">
					<div class="flex flex-col pt-6 px-6 bg-green-500 rounded rounded-b-none">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Gross Scores</h3>
						<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
							<div class="w-1/2 flex flex-col text-zinc-900">
								<span class="block uppercase font-semibold tracking-tight text-green-900">Average</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ number_format($player->gross_average, 2) }}</span>
							</div>
							<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
								<span class="block uppercase font-semibold tracking-tight text-green-900">Low</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ $player->low_gross }}</span>
							</div>
							<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
								<span class="block uppercase font-semibold tracking-tight text-green-900">High</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ $player->high_gross }}</span>
							</div>
						</div>
					</div>
					<div class="flex flex-col pb-6 px-6 pt-6 bg-green-500 rounded rounded-t-none">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Net Scores</h3>
						<div class="flex flex-wrap items-center mt-2 lg:mt-4">
							<div class="w-1/2 flex flex-col text-zinc-900">
								<span class="block uppercase font-semibold tracking-tight text-green-900">Average</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ number_format($player->net_average, 2) }}</span>
							</div>
							<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
								<span class="block uppercase font-semibold tracking-tight text-green-900">Low</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ $player->low_net }}</span>
							</div>
							<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
								<span class="block uppercase font-semibold tracking-tight text-green-900">High</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ $player->high_net }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			@if(count($weekly_wins))
				<div class="mb-6 mt-6">
					<div class="bg-green-500 rounded py-6 px-4">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg mb-4">Weekly Winnings</h3>
						@foreach ($weekly_wins as $week)
							<div class="flex items-center mt-3 text-sm">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="text-white fill-current h-4 w-4"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-5h1a3 3 0 0 0 0-6H7.99a1 1 0 0 1 0-2H14V5h-3V3H9v2H8a3 3 0 1 0 0 6h4a1 1 0 1 1 0 2H6v2h3v2h2v-2z"/></svg>
								<div class="text-white ml-2"><a href="{{ route('week-score', ['week' => $week->week->id ]) }}" class="text-white underline hover:text-white hover:underline">Week {{ $week->week->week_order }}</a>
									@if ($week->week->side_games == 'Net')
										Low Net Winner
									@elseif ($week->week->side_games == 'Pin')
										Closest to the Pin Winner
									@else
										Low Putts Winner
									@endif
								</div>
							</div>
						@endforeach
					</div>
				</div>
			@endif

			@if($player->id != 64)
				@if(count($highest))
					<div class="w-full px-0 mb-6 mt-6">
						<div class="flex flex-col p-6 bg-zinc-900 rounded">
							<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Handicap</h3>
							<div class="flex flex-col items-center mt-2 lg:mt-4 ">
								{{-- <div class="w-full flex flex-col text-green-bright">
									<span class="block uppercase font-semibold tracking-tight text-zinc-300">Highest Counting</span>
									<span class="block text-3xl lg:text-3xl font-bold">{{ $highest ? number_format($highest[0], 0) : '' }}</span>
								</div> --}}
								<div class="w-full flex flex-col text-green-bright mt-4">
									<span class="block uppercase font-semibold tracking-tight text-zinc-300 mb-1">Counted Scores</span>
									<div class="flex">
										@foreach ($counted as $score)
											{{ number_format($score, 0, '.', ',') }}@if(!$loop->last), @endif
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endif
		</div>
	</div>
</div>
