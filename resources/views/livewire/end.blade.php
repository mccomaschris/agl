<div>
	<table>
		<thead>
			<tr>
				<th>Team</th>
				<th>Pts</th>
				<th>Wk20</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($year->teamStandings as $team)
					<tr x-data="
						{
						points: {{ $team->points }},
						weekPts: 0,
						total() {
							return parseInt(this.weekPts) + parseInt(this.points);
						}
						}">
						<td class="overflow-x-hidden">
							<strong class="text-grey-900">Team {{ $team->name }}</strong>
							<br>
							<span class="text-xs">
								@foreach ($team->players as $player)
									{{ $player->user->last_name }}@if(!$loop->last), @endif
								@endforeach
							</td>
						<td>{{ $team->points }}</td>
						<td class="py-2"><input x-model="weekPts" type="number" class="text-input"></td>
						<td class="py-2"><span x-text="total"></span></td>
					</tr>
			@endforeach
		</tbody>
	</table>
</div>
