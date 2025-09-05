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


		<div class="flex flex-wrap mb-4">
		<div class="w-full lg:w-1/3 mb-4 lg:pr-4">
			<table class="table w-full mx-auto table-striped">
				<thead>
					<tr class="course">
						<th class="text-center rounded-tl" colspan="2">Team 2</th>
						<th class="text-center rounded-tr" colspan="2">Team 6</th>
					</tr>
				</thead>
				<tr>
					<td width="40%">Webb</td>
					<td width="10%" class="text-center">0</td>
					<td width="40%">Keeney</td>
					<td width="10%" class="text-center">2</td>
				</tr>
				<tr class="border-b border-zinc-900">
					<td width="40%">Freeman</td>
					<td width="10%" class="text-center">5</td>
					<td width="40%">Evans</td>
					<td width="10%" class="text-center">5</td>
				</tr>
				<tr>
					<td width="40%">S Adkins</td>
					<td width="10%" class="text-center">6</td>
					<td width="40%">Keyser</td>
					<td width="10%" class="text-center">7</td>
				</tr>
				<tr>
					<td width="40%">Dishman</td>
					<td width="10%" class="text-center">7</td>
					<td width="40%">Baumgarner</td>
					<td width="10%" class="text-center">12</td>
				</tr>
			</table>
		</div>
		<div class="w-full lg:w-1/3">
			<table class="table w-full mx-auto table-striped">
				<thead>
					<tr class="course">
						<th class="text-center rounded-tl" colspan="2">Team 1</th>
						<th class="text-center rounded-tr" colspan="2">Team 3</th>
					</tr>
				</thead>
				<tr>
					<td width="40%">Reed</td>
					<td width="10%" class="text-center">-1</td>
					<td width="40%">Bunn</td>
					<td width="10%" class="text-center">2</td>
				</tr>
				<tr class="border-b border-zinc-900">
					<td width="40%">Aliff</td>
					<td width="10%" class="text-center">6</td>
					<td width="40%">T Mills</td>
					<td width="10%" class="text-center">6</td>
				</tr>
				<tr>
					<td width="40%">Dumont</td>
					<td width="10%" class="text-center">11</td>
					<td width="40%">Chandler</td>
					<td width="10%" class="text-center">8</td>
				</tr>
				<tr>
					<td width="40%">Cutlip</td>
					<td width="10%" class="text-center">12</td>
					<td width="40%">Thornburg</td>
					<td width="10%" class="text-center">13</td>
				</tr>
			</table>
		</div>
		<div class="w-full lg:w-1/3 mb-4 lg:pr-4">

		</div>
	</div>

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
