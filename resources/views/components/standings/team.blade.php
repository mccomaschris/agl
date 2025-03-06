<table class="table w-full table-striped">
    <thead>
        <tr class="">
            <th class="text-center rounded-tl ">Rk</th>
            <th class="text-left">Team</th>
            <th class="text-center hidden lg:table-cell">W</th>
            <th class="text-center hidden lg:table-cell">L</th>
            <th class="text-center hidden lg:table-cell">T</th>
            <th class="text-center rounded-tr lg:rounded-tr-none">Pts</th>
            <th class="text-center hidden sm:table-cell">P1</th>
            <th class="text-center hidden sm:table-cell">P2</th>
            <th class="text-center hidden sm:table-cell">P3</th>
            <th class="text-center rounded-tr hidden sm:table-cell">P4</th>
        </tr>
    </thead>
    @foreach ($year->teamStandings as $team)
        @if (($loop->index + 1) % 4 == 0)
            <tr class="border-b-2 border-zinc-900">
        @else
            <tr>
        @endif
			<td class="text-center">{{ $team->rank }}</td>
			<td class="overflow-x-hidden">
				<strong class="text-zinc-900">Team {{ $team->name }}</strong>
				<br>
				<span class="text-xs">
					@foreach ($team->players as $player)
						{{ $player->user->last_name }}@if(!$loop->last), @endif
					@endforeach
					<br>
					<div class="block lg:hidden">
						@foreach ($team->players as $player)
							{{ $player->points }}@if (!$loop->last)-@endif
						@endforeach
					</div>
				</span>
			</td>
			<td class="text-center hidden lg:table-cell">{{ $team->won }} </td>
			<td class="text-center hidden lg:table-cell">{{ $team->lost }}</td>
			<td class="text-center hidden lg:table-cell">{{ $team->tied }}</td>
			<td class="text-center"><strong class="text-zinc-900">{{ $team->points }}</strong></td>
			<td class="text-center hidden sm:table-cell">{{ $team->p1_points }}</td>
			<td class="text-center hidden sm:table-cell">{{ $team->p2_points }}</td>
			<td class="text-center hidden sm:table-cell">{{ $team->p3_points }}</td>
			<td class="text-center hidden sm:table-cell">{{ $team->p4_points }}</td>
		</tr>
    @endforeach
</table>
