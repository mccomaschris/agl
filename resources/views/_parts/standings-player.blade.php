<div>
	<div class="flow-root">
		<div class="">
			<div class="inline-block min-w-full py-2 align-middle">
				<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg">
					<table class="min-w-full divide-y divide-gray-300">
						<thead class="bg-zinc-50">
							<tr>
								<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-zinc-900 sm:pl-6">Rk</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900">Player</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900">W</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900">L</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900">T</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900">Pts</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-gray-200">
							@foreach ($year->playerStandings(35) as $player)
								<tr class="even:bg-white odd:bg-zinc-50/50">
									<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-zinc-900 sm:pl-6">{{ $player->points_rank }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-zinc-500"><a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-zinc-500">{{ $player->won }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-zinc-500">{{ $player->lost }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-zinc-500">{{ $player->tied }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-zinc-500">{{ $player->points }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
