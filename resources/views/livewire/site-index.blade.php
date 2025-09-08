<div class="mt-12">
	<!-- Thundr -->
	@if ($last_week)
		<flux:callout color="green" icon="check-circle" class="mb-12">
			<flux:callout.heading>Week {{ $last_week->week_order }} scores are up!</flux:callout.heading>
			<flux:callout.text>You can checkout the week's <flux:callout.link href="{{ route('week-score', ['week' => $last_week->id]) }}">results</flux:callout.link>!</flux:callout.text>
		</flux:callout>
	@endif

	@if ($week)
		<div class="space-y-6">
			<flux:heading size="lg">{{ $year->name }} Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }} Matchups</flux:heading>
			@if($week->side_games == 'Net')
				<flux:badge color="orange" icon="arrow-trending-down">Low Net</flux:badge>
			@elseif($week->side_games == 'Pin')
				<flux:badge color="blue" icon="flag">Closest to the Pin</flux:badge>
			@elseif($week->side_games == 'Putt')
				<flux:badge color="yellow">Low Putts</flux:badge>
			@endif

			<x-site.week-table :week="$week" />
		</div>
	@endif

	<x-playoffs />

	<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12 pb-12">
		<div class="lg:col-span-2">
			<div class="flex justify-between items-center">
				<flux:heading size="lg">Team Standings</flux:heading>
				<flux:button variant="ghost" size="sm" href="{{ route('standings', [$year]) }}">View Past Years</flux:button>
			</div>
			<x-tables.standings-team :year="$year" />
		</div>

		<div class="">
			<div>
				<flux:heading size="lg">Individual Standings</flux:heading>
			</div>
			<x-tables.standings-player :year="$year" />
		</div>
	</div>
</div>
