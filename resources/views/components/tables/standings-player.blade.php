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
			<x-table.tr-body class="even:bg-white odd:bg-zinc-50/50 dark:bg-zinc-800! odd:dark:bg-zinc-700!">
				<x-table.td class="text-center! border-r-0! dark:text-zinc-50!">{{ $player->points_rank }}</x-table.td>
				<x-table.td class="border-r-0! text-left! whitespace-normal! lg:whitespace-nowrap!"><a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></x-table.td>
				<x-table.td class="border-r-0! dark:text-zinc-100!">{{ $player->won }}</x-table.td>
				<x-table.td class="border-r-0! dark:text-zinc-100!">{{ $player->lost }}</x-table.td>
				<x-table.td class="border-r-0! dark:text-zinc-100!">{{ $player->tied }}</x-table.td>
				<x-table.td class="border-r-0! dark:text-zinc-100!">{{ $player->points }}</x-table.td>
			</x-table.tr-body>
		@endforeach
	</x-table.tbody>
</x-table>
