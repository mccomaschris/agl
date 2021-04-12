<table class="table table-bordered table-striped w-full mb-6 lg:mb-8">
	<thead>
		<tr class="course">
			<th style="min-width: 175px">Player</th>
			<th class="text-center">1st Qtr</th>
			<th class="text-center">2nd Qtr</th>
			<th class="text-center">3rd Qtr</th>
			<th class="text-center">4th Qtr</th>
			<th class="text-center">Playoff</th>
			<th class="text-center">18 Hole</th>
			<th class="text-center">New Year</th>
			<th class="text-center" colspan="2">Full Handicap/Rank</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($players as $player)
			<tr>
				<td><a href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
				<td class="text-center">{{ $player->hc_first }}</td>
				<td class="text-center">{{ $player->hc_second }}</td>
				<td class="text-center">{{ $player->hc_third }}</td>
				<td class="text-center">{{ $player->hc_fourth }}</td>
				<td class="text-center">{{ $player->hc_playoff }}</td>
				<td class="text-center">{{ $player->hc_18 }}</td>
				<td class="text-center">{{ $player->hc_next_year }}</td>
				<td class="text-center">{{ number_format($player->hc_full, 4, '.', ',') }}</td>
				<td class="text-center" width="5%">{{ $player->hc_full_rank }}</td>
			</tr>
		@endforeach
	</tbody>
</table>  