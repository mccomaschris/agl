<div>
	<div class="flow-root">
		<div class="mx-1">
			<div class="inline-block min-w-full py-2 align-middle">
				<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg">
					<table class="min-w-full divide-y divide-gray-300">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Player</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">1st Qtr</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">2nd Qtr</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">3rd Qtr</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">4th Qtr</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Playoff</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">18 Hole</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">New Year</th>
								<th scope="col" colspan="2" class="px-3 py-3.5 text-sm font-semibold text-gray-900 text-right">Full Handicap/Rank</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-gray-200">
							@foreach ($players as $player)
								<tr class="even:bg-white odd:bg-gray-50/50">
									<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6"><a href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $player->hc_first }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $player->hc_second }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $player->hc_third }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $player->hc_fourth }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $player->hc_playoff }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $player->hc_18 }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $player->hc_playoff }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 text-right">{{ number_format($player->hc_full, 4, '.', ',') }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 text-right" width="5%">{{ $player->hc_full_rank }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
