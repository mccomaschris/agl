<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
	<div class="">
		@include('_parts.home-team-table', [
			'hole' => '1',
			'teamA' => $week->team_a,
			'teamB' => $week->team_b,
			])
	</div>
	<div class="">
		@include('_parts.home-team-table', [
			'hole' => '3',
			'teamA' => $week->team_c,
			'teamB' => $week->team_d,
			])
	</div>
	<div class="">
		@include('_parts.home-team-table', [
			'hole' => '5',
			'teamA' => $week->team_e,
			'teamB' => $week->team_f,
			])
	</div>
</div>
