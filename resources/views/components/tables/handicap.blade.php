<x-table>
	<x-table.thead>
		<x-table.tr>
			<x-table.th>Player</x-table.th>
			<x-table.th>1st Qtr</x-table.th>
			<x-table.th>2nd Qtr</x-table.th>
			<x-table.th>3rd Qtr</x-table.th>
			<x-table.th>4th Qtr</x-table.th>
			<x-table.th>Playoff</x-table.th>
			<x-table.th>18 Hole</x-table.th>
			<x-table.th>New Year</x-table.th>
			<x-table.th colspan="2">Full Handicap/Rank</x-table.th>
		</x-table.tr>
	</x-table.thead>
	<x-table.tbody>
		@foreach ($players as $player)
			<x-table.tr-body>
				<x-table.td><a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></x-table.td>
				<x-table.td>{{ $player->hc_first }}</x-table.td>
				<x-table.td>{{ $player->hc_second }}</x-table.td>
				<x-table.td>{{ $player->hc_third }}</x-table.td>
				<x-table.td>{{ $player->hc_fourth }}</x-table.td>
				<x-table.td>{{ $player->hc_playoff }}</x-table.td>
				<x-table.td>{{ $player->hc_18 }}</x-table.td>
				<x-table.td>{{ $player->hc_playoff }}</x-table.td>
				<x-table.td>{{ number_format($player->hc_full, 4, '.', ',') }}</x-table.td>
				<x-table.td>{{ $player->hc_full_rank }}</x-table.td>
			</x-table.tr-body>
		@endforeach
	</x-table.tbody>
</x-table>
