<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
	<div class="">
		<x-tables.matchup :week="$week" :teamA="$week->team_a" :teamB="$week->team_b" />
	</div>
	<div class="">
		<x-tables.matchup :week="$week" :teamA="$week->team_c" :teamB="$week->team_d" />
	</div>
	<div class="">
		<x-tables.matchup :week="$week" :teamA="$week->team_e" :teamB="$week->team_f" />
	</div>
</div>
