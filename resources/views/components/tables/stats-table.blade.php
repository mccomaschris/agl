<div class="flow-root">
	<div class="">
		<div class="inline-block min-w-full py-2 align-middle">
			<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg mx-1">
				<div class="overflow-x-auto">
					<table class="min-w-full divide-y divide-gray-300">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Week</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">1</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">2</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">3</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">4</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">5</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">6</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">7</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">8</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">9</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">10</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">11</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">12</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">13</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">14</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">15</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">16</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">17</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">18</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">19</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">20</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">Avg</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">NetAvg</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">Low</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">High</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">LowNet</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">Eg</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">Br</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">Par</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">Bg</th>
								<th class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900">DblBg+</th>
							</tr>
						</thead>
						@foreach ($players as $player)
							<tr class="even:bg-white odd:bg-gray-50/50 border-b border-zinc-300">
								<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6 border-r border-zinc-300">
									<a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
									@foreach ($player->weekly_scores as $score)
										<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-400 border-r border-zinc-300 {{ $score->absent ? 'absent_row' : '' }}">
											@if ($score->absent)
												<span class="text-white">A</span>
											@elseif ($score->injury)
												<span class="text-white">-</span>
											@elseif ($score->week->back_nine)
												<span class="">-</span>
											@else
												<span class="text-zinc-500">{{ $score->gross ? number_format($score->gross, 0, '.', ',') : '' }} @if($score->substitute_id > 0)<span class="font-bold">(S)</span>@endif</span>
											@endif
										</td>
									@endforeach
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-600 border-r border-zinc-300 font-semibold">{{ number_format($player->gross_average, 1, '.', ',') }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-600 border-r border-zinc-300 font-semibold">{{ number_format($player->net_average, 1, '.', ',') }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-600 border-r border-zinc-300 font-semibold">{{ $player->low_gross }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-600 border-r border-zinc-300 font-semibold">{{ $player->high_gross }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-600 border-r border-zinc-300 font-semibold">{{ $player->low_net }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-yellow-800 border-r border-zinc-300 bg-yellow-200 font-semibold">{{ $player->season_avg->eagle }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-green-800 border-r border-zinc-300 bg-green-200 font-semibold">{{ $player->season_avg->birdie }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-gray-600 border-r border-zinc-300 par-hole font-semibold">{{ $player->season_avg->par }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-red-800 border-r border-zinc-300 bg-red-200 font-semibold">{{ $player->season_avg->bogey }}</td>
								<td class="text-center px-1 py-4 text-sm whitespace-nowrap text-sky-800 border-r border-zinc-300 bg-sky-200 font-semibold">{{ $player->season_avg->double_bogey }}</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
