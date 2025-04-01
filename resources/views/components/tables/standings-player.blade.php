<x-table>
	<x-table.thead>
		<x-table.tr>
			<x-table.th class="text-center! border-r-0!">Rk</x-table.th>
			<x-table.th class="text-left! border-r-0!">Player</x-table.th>
			<x-table.th class="border-r-0!">W</x-table.th>
			<x-table.th class="border-r-0!">L</x-table.th>
			<x-table.th class="border-r-0!">T</x-table.th>
			<x-table.th class="border-r-0!">Pts</x-table.th>
		</x-table.tr>
	</x-table.thead>
	<x-table.tbody>
		@foreach ($year->playerStandings(35) as $player)
			<x-table.tr-body>
				<x-table.td class="text-center! border-r-0!">{{ $player->points_rank }}</x-table.td>
				<x-table.td class="border-r-0! text-left! whitespace-normal! lg:whitespace-nowrap!"><a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></x-table.td>
				<x-table.td class="border-r-0!">{{ $player->won }}</x-table.td>
				<x-table.td class="border-r-0!">{{ $player->lost }}</x-table.td>
				<x-table.td class="border-r-0!">{{ $player->tied }}</x-table.td>
				<x-table.td class="border-r-0!">{{ $player->points }}</x-table.td>
			</x-table.tr-body>
		@endforeach
	</x-table.tbody>
</x-table>
