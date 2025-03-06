<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Team Points</h1>

		<div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More Years Team Points
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
						<a wire:navigate href="/team-points/{{ $item->name }}" class="{{ ($year->id == $item->id) ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-700' }} text-zinc-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">{{ $item->name }} Team Points</a>
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


	@foreach ($teams as $team)
		<div class="mb-12 last:mb-0">
			<h3 class="mb-2 lg:text-xl text-darkest-grey" id="{{ $team->id }}">Team {{ $team->name }}</h3>

			<div class="flow-root">
				<div class="">
					<div class="inline-block min-w-full py-2 align-middle">
						<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg">
							<div class="overflow-x-auto">
								<table class="min-w-full divide-y divide-gray-300">
									<thead class="bg-gray-50">
										<tr>
											<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Player</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">1</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">2</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">3</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">4</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">5</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">6</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">7</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">8</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">9</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">10</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">11</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">12</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">13</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">14</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">15</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">16</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">17</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">18</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">19</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">20</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">Total</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">W%</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">Won</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">Lost</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">Tied</th>
											<th scope="col" class="text-center px-3 py-3.5 text-sm font-semibold text-gray-900">W Rk</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($team->players as $player)
											<tr class="even:bg-white odd:bg-gray-50/50 border-b border-zinc-300">
												<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6 border-r border-zinc-300"><a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
												@foreach ($player->scores as $score)
													<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 border-r border-zinc-300 {{ $score->absent ? 'absent_row' : '' }}">
														@if ($score->absent)
															<span class="text-white">A</span>
														@elseif ($score->injury)
															<span>I</span>
														@else
															<span class="text-zinc-500">{{ $score->points }} @if($score->substitute_id > 0)<span class="font-bold">(S)</span>@endif</span>
														@endif
													</td>
												@endforeach

												<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $player->points }}</td>
												<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ number_format($player->win_pct, 3, '.', ',') }}</td>
												<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $player->won }}</td>
												<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $player->lost }}</td>
												<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $player->tied }}</td>
												<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold">{{ $player->wins_rank }}</td>
											</tr>
										@endforeach
										<tr class="totals">
											<td class="text-right px-3 py-3.5 text-sm font-semibold text-gray-900 sm:pl-6 border-r border-zinc-300" colspan="21">TEAM TOTALS</td>
											<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $team->points }}</td>
											<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300"></td>
											<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $team->won }}</td>
											<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $team->lost }}</td>
											<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold border-r border-zinc-300">{{ $team->tied }}</td>
											<td class="text-center px-3 py-4 text-sm whitespace-nowrap text-gray-500 font-semibold"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
