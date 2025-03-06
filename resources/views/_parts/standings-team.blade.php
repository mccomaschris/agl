<div>
	<div class="flow-root">
		<div class="">
			<div class="inline-block min-w-full py-2 align-middle">
				<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg">
					<table class="min-w-full divide-y divide-gray-300">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Rk</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Team</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">W</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">L</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">T</th>
								<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Pts</th>
								<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 hidden sm:table-cell">P1</th>
								<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 hidden sm:table-cell">P2</th>
								<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 hidden sm:table-cell">P3</th>
								<th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 hidden sm:table-cell">P4</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-gray-200">
							@foreach ($year->teamStandings as $team)
								<tr class="even:bg-white odd:bg-gray-50/50 {{ ($loop->index + 1) % 4 == 0 ? 'border-b-2 border-zinc-900' : '' }}">
									<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6">
										<span class="{{ $loop->index < 4 ? 'text-green-500' : 'text-red-500 ' }} font-bold">{{ $team->rank }}</span>
									</td>
									<td class="px-3 py-4 text-sm text-gray-500">
										<span class="font-bold text-gray-700">Team {{ $team->name }}</span>
										<br>
										<span class="text-xs">
										@foreach ($team->players as $player)
											{{ $player->user->last_name }}@if(!$loop->last), @endif
										@endforeach
										<br>
										<div class="block lg:hidden">
											{{ implode('-', $team->players->pluck('points')->toArray()) }}
										</div>
										</span>
									</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $team->won }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $team->lost }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $team->tied }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{ $team->points }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 hidden sm:table-cell">{{ $team->p1_points }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 hidden sm:table-cell">{{ $team->p2_points }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 hidden sm:table-cell">{{ $team->p3_points }}</td>
									<td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 hidden sm:table-cell">{{ $team->p4_points }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
