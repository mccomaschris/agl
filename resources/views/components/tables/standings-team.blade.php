<x-table>
	<x-table.thead>
		<x-table.tr>
			<x-table.th class="text-center! border-r-0!">Rk</x-table.th>
			<x-table.th class="text-left! border-r-0!">Team</x-table.th>
			<x-table.th class="hidden sm:table-cell border-r-0!">W</x-table.th>
			<x-table.th class="hidden sm:table-cell border-r-0!">L</x-table.th>
			<x-table.th class="hidden sm:table-cell border-r-0!">T</x-table.th>
			<x-table.th class="border-r-0!">Pts</x-table.th>
			<x-table.th class="hidden sm:table-cell border-r-0">P1</x-table.th>
			<x-table.th class="hidden sm:table-cell border-r-0">P2</x-table.th>
			<x-table.th class="hidden sm:table-cell border-r-0">P3</x-table.th>
			<x-table.th class="hidden sm:table-cell border-r-0">P4</x-table.th>
		</x-table.tr>
	</x-table.thead>
	<x-table.tbody>
		@foreach ($year->teamStandings as $team)
			<x-table.tr-body class="{{ ($loop->index + 1) % 4 == 0 ? 'border-b-2 border-zinc-900' : '' }} border-r-0! text-center! even:bg-white odd:bg-zinc-50/50 dark:bg-zinc-800! odd:dark:bg-zinc-700!">
				<x-table.td class="border-r-0! text-center!">
					<span class="{{ $loop->index < 4 ? 'text-green-500' : 'text-red-500 ' }} font-bold">{{ $team->rank }}</span>
				</x-table.td>
				<x-table.td class="text-left! border-r-0! whitespace-normal! lg:whitespace-nowrap!">
					<span class="font-bold text-zinc-700 dark:text-zinc-50!">Team {{ $team->name }}</span>
					<br>
					<span class="text-xs dark:text-zinc-300!">
					@foreach ($team->players as $player)
						{{ $player->user->last_name }}@if(!$loop->last), @endif
					@endforeach
					<br>
					<div class="block lg:hidden">
						{{ implode('-', $team->players->pluck('points')->toArray()) }}
					</div>
					</span>
				</x-table.td>
				<x-table.td class="hidden sm:table-cell border-r-0!  dark:text-zinc-100!">{{ $team->won }}</x-table.td>
				<x-table.td class="hidden sm:table-cell border-r-0!  dark:text-zinc-100!">{{ $team->lost }}</x-table.td>
				<x-table.td class="hidden sm:table-cell border-r-0!  dark:text-zinc-100!">{{ $team->tied }}</x-table.td>
				<x-table.td class="border-r-0! px-4! lg:px-1! dark:text-zinc-100!">{{ $team->points }}</x-table.td>
				<x-table.td class="hidden sm:table-cell border-r-0! dark:text-zinc-100!">{{ $team->p1_points }}</x-table.td>
				<x-table.td class="hidden sm:table-cell border-r-0! dark:text-zinc-100!">{{ $team->p2_points }}</x-table.td>
				<x-table.td class="hidden sm:table-cell border-r-0! dark:text-zinc-100!">{{ $team->p3_points }}</x-table.td>
				<x-table.td class="hidden sm:table-cell border-r-0! dark:text-zinc-100!">{{ $team->p4_points }}</x-table.td>
			</x-table.tr-body>
		@endforeach
	</x-table.tbody>
</x-table>
