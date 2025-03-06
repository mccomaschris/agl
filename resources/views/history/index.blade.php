<x-layouts.app>
	<x-slot name="header">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight">Appliance Golf League History &amp; Records</h1>
	</x-slot>

	<div class="flex flex-col lg:flex-row my-6">
		<div class="py-2 text-center lg:text-left lg:mr-6"><a href="#individual-season">Individual Season Records</a></div>
		<div class="py-2 text-center lg:text-left lg:mr-6"><a href="#individual-round">Individual Round Records</a></div>
		<div class="py-2 text-center lg:text-left"><a href="#team-season">Team Season Records</a></div>
	</div>
	<div class="flex flex-col mt-6">
		<div class="w-full mb-6">
			<h3 class="font-semibold mb-2 lg:text-xl">Seasons</h3>
			<ul>
				@foreach ($years as $item)
				<li class="mb-2 text-sm lg:text-base">
					<span class="font-semibold">{{ $item->name }}</span>
					<a href="{{ route('team-points', ['year' => $item->name]) }}">Team Points</a> | <a href="{{ route('handicaps', ['year' => $item->name]) }}">Handicaps</a> | <a href="{{ route('group-stats', ['year' => $item->name]) }}">Group Stats</a> | <a href="{{ route('team-stats', ['year' => $item->name]) }}">Team Stats</a> | <a href="{{ route('standings', ['year' => $item->name]) }}">Standings</a>
				</li>
				@endforeach
			</ul>
		</div>

		<div class="w-full mt-2 lg: mb-6">
			<h3 class="font-semibold lg:text-xl" id="individual-season">Champions</h3>
			<p class="text-sm my-4">NOTE: All records only go back to the {{ $first_year->name }} season</p>
			<div class="flex flex-wrap -mx-2">
				<div class="w-full lg:w-1/2 mb-4 lg:mb-8 px-2">
					<h4 class="font-semibold mb-2">Team Champions</h4>
					<table class="w-full table table-bordered table-striped">
						<tr>
							<th class="text-center">Year</th>
							<th>Team</th>
							{{-- <th class="text-center">Points</th> --}}
						</tr>
						@foreach($team_champions as $item)
						@if(count($item->teams))
						<tr>
							<td class="text-center">{{ $item->name }}</td>
							<td><strong class="text-zinc-900">Team {{ $item->teams[0]->name }}</strong>
								<br>
								<span class="text-xs">
									@foreach ($item->teams[0]->players as $player)
									{{ $player->user->last_name }}@if (!$loop->last),@endif
									@endforeach
								</span></td>

								{{-- <td class="text-center">{{ $item->teams[0]->points }}</td> --}}
							</tr>
							@endif
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/2 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Individual Champion</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center">Year</th>
								<th>Player</th>
							</tr>
							@foreach($individual_champions as $item)
							@if(count($item->players))
							<tr>
								<td class="text-center">{{ $item->name }}</td>
								<td>
									@foreach($item->players as $player)
									{{ $player->user->name }}@if (!$loop->last),@endif
									@endforeach
								</td>
							</tr>
							@endif
							@endforeach
						</table>
					</div>
				</div>
			</div>

			<div class="w-full mt-2 lg: mb-6">
				<h3 class="font-semibold lg:text-xl" id="individual-season">Individual Season Records</h3>
				<p class="text-sm my-4">NOTE: All records only go back to the {{ $first_year->name }} season</p>

				<div class="flex flex-wrap -mx-2">
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Points</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Points</th>
							</tr>
							@foreach($season_individual_most_points as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ $item->points }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Fewest Points</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Points</th>
							</tr>
							@foreach($season_individual_least_points as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ $item->points }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Wins</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Wins</th>
							</tr>
							@foreach($season_individual_most_wins as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ $item->won }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Fewest Wins</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Wins</th>
							</tr>
							@foreach($season_individual_least_wins as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ $item->won }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Ties</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Ties</th>
							</tr>
							@foreach($season_individual_most_ties as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ $item->tied }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Losses</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Losses</th>
							</tr>
							@foreach($season_individual_most_losses as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ $item->lost }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Fewest Losses</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Losses</th>
							</tr>
							@foreach($season_individual_least_losses as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ $item->lost }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Low Net Average</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Score</th>
							</tr>
							@foreach($season_individual_net as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ number_format($item->net_average, 2, '.', ',') }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/4 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Low Gross Average</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Year</th>
								<th class="text-center">Score</th>
							</tr>
							@foreach($season_individual_gross as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->id]) }}">{{ $item->user->name }}</a></td>
								<td class="text-center">{{ $item->year->name }}</td>
								<td class="text-center">{{ number_format($item->gross_average, 2, '.', ',') }}</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
			<div class="w-full mt-2 lg: mb-6">
				<h3 class="font-semibold lg:text-xl" id="individual-rounds">Individual Rounds Records</h3>
				<p class="text-sm my-4">NOTE: All records only go back to the {{ $first_year->name }} season</p>
				<div class="flex flex-wrap -mx-2">
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Lowest Gross Round</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Week/Year</th>
								<th class="text-center">Score</th>
							</tr>
							@foreach($round_low_gross as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->week->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->player->id]) }}">{{ $item->player->user->name }}</a></td>
								<td class="text-center"><a href="{{ route('week-score', ['week' => $item->week->id]) }}/#{{ $item->player->id }}">Week #{{ $item->week->week_order }}, {{ $item->week->year->name }}</a></td>
								<td class="text-center">{{ number_format($item->gross, 0, '.', ',') }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Lowest Net Round</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Week/Year</th>
								<th class="text-center">Score</th>
							</tr>
							@foreach($round_low_net as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->week->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->player->id]) }}">{{ $item->player->user->name }}</a></td>
								<td class="text-center"><a href="{{ route('week-score', ['week' => $item->week->id]) }}/#{{ $item->player->id }}">Week #{{ $item->week->week_order }}, {{ $item->week->year->name }}</a></td>
								<td class="text-center">{{ number_format($item->net, 0, '.', ',') }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Eagles</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Week/Year</th>
								<th class="text-center">Eagles</th>
							</tr>
							@foreach($round_most_eagles as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->week->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->player->id]) }}">{{ $item->player->user->name }}</a></td>
								<td class="text-center"><a href="{{ route('week-score', ['week' => $item->week->id]) }}/#{{ $item->player->id }}">Week #{{ $item->week->week_order }}, {{ $item->week->year->name }}</a></td>
								<td class="text-center">{{ $item->eagle }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Birdies</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Week/Year</th>
								<th class="text-center">Birdies</th>
							</tr>
							@foreach($round_most_birdies as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->week->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->player->id]) }}">{{ $item->player->user->name }}</a></td>
								<td class="text-center"><a href="{{ route('week-score', ['week' => $item->week->id]) }}/#{{ $item->player->id }}">Week #{{ $item->week->week_order }}, {{ $item->week->year->name }}</a></td>
								<td class="text-center">{{ $item->birdie }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Pars</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Player</th>
								<th class="text-center">Week/Year</th>
								<th class="text-center">Pars</th>
							</tr>
							@foreach($round_most_pars as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->week->year->id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td><a href="{{ route('player-score', ['player' => $item->player->id]) }}">{{ $item->player->user->name }}</a></td>
								<td class="text-center"><a href="{{ route('week-score', ['week' => $item->week->id]) }}/#{{ $item->player->id }}">Week #{{ $item->week->week_order }}, {{ $item->week->year->name }}</a></td>
								<td class="text-center">{{ $item->par }}</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
			<div class="w-full mt-2 lg: mb-6">
				<h3 class="font-semibold lg:text-xl" id="team-season">Season Team Records</h3>
				<p class="text-sm my-4">NOTE: All records only go back to the {{ $first_year->name }} season</p>
				<div class="flex flex-wrap -mx-2">
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Points</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Team</th>
								<th class="text-center">Points</th>
							</tr>
							@foreach($season_team_points as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year_id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td>
									<a href="{{ route('team-points', ['year' => $item->year->id]) }}">{{ $item->year->name }} Team #{{ $item->name }}</a><br>
									<span class="text-zinc-dark text-xs">
										@foreach ($item->players as $player)
										{{ $player->user->last_name }}@if (!$loop->last),@endif
										@endforeach
									</span>
								</td>
								<td class="text-center">{{ $item->points }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Fewest Points</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Team</th>
								<th class="text-center">Points</th>
							</tr>
							@foreach($season_team_low_points as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year_id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td>
									<a href="{{ route('team-points', ['year' => $item->year->id]) }}">{{ $item->year->name }} Team #{{ $item->name }}</a><br>
									<span class="text-zinc-dark text-xs">
										@foreach ($item->players as $player)
										{{ $player->user->last_name }}@if (!$loop->last),@endif
										@endforeach
									</span>
								</td>
								<td class="text-center">{{ $item->points }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Wins</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Team</th>
								<th class="text-center">Wins</th>
							</tr>
							@foreach($season_team_wins as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year_id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td>
									<a href="{{ route('team-points', ['year' => $item->year->id]) }}">{{ $item->year->name }} Team #{{ $item->name }}</a><br>
									<span class="text-zinc-dark text-xs">
										@foreach ($item->players as $player)
										{{ $player->user->last_name }}@if (!$loop->last),@endif
										@endforeach
									</span>
								</td>
								<td class="text-center">{{ $item->won }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Fewest Wins</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Team</th>
								<th class="text-center">Wins</th>
							</tr>
							@foreach($season_team_low_wins as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year_id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td>
									<a href="{{ route('team-points', ['year' => $item->year->id]) }}">{{ $item->year->name }} Team #{{ $item->name }}</a><br>
									<span class="text-zinc-dark text-xs">
										@foreach ($item->players as $player)
										{{ $player->user->last_name }}@if (!$loop->last),@endif
										@endforeach
									</span>
								</td>
								<td class="text-center">{{ $item->won }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Most Losses</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Team</th>
								<th class="text-center">Lost</th>
							</tr>
							@foreach($season_team_losses as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year_id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td>
									<a href="{{ route('team-points', ['year' => $item->year->id]) }}">{{ $item->year->name }} Team #{{ $item->name }}</a><br>
									<span class="text-zinc-dark text-xs">
										@foreach ($item->players as $player)
										{{ $player->user->last_name }}@if (!$loop->last),@endif
										@endforeach
									</span>
								</td>
								<td class="text-center">{{ $item->lost }}</td>
							</tr>
							@endforeach
						</table>
					</div>
					<div class="w-full lg:w-1/3 mb-4 lg:mb-8 px-2">
						<h4 class="font-semibold mb-2">Fewest Losses</h4>
						<table class="w-full table table-bordered table-striped">
							<tr>
								<th class="text-center"></th>
								<th>Team</th>
								<th class="text-center">Lost</th>
							</tr>
							@foreach($season_team_low_losses as $item)
							<tr class="@if($loop->index > 4) hidden lg:table-row @endif  @if($item->year_id == $year->id) active-record @endif">
								<td class="text-center">{{ $loop->iteration }}</td>
								<td>
									<a href="{{ route('team-points', ['year' => $item->year->id]) }}">{{ $item->year->name }} Team #{{ $item->name }}</a><br>
									<span class="text-zinc-dark text-xs">
										@foreach ($item->players as $player)
										{{ $player->user->last_name }}@if (!$loop->last),@endif
										@endforeach
									</span>
								</td>
								<td class="text-center">{{ $item->lost }}</td>
							</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</x-layouts.app>
