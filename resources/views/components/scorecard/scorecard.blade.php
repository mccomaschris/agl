<x-table>
	<x-table.thead>
		<x-table.tr>
			<x-table.th class="text-left">Hole</x-table.th>
			<x-table.th class="text-center">1</x-table.th>
			<x-table.th class="text-center">2</x-table.th>
			<x-table.th class="text-center">3</x-table.th>
			<x-table.th class="text-center">4</x-table.th>
			<x-table.th class="text-center">5</x-table.th>
			<x-table.th class="text-center">6</x-table.th>
			<x-table.th class="text-center">7</x-table.th>
			<x-table.th class="text-center">8</x-table.th>
			<x-table.th class="text-center">9</x-table.th>
			<x-table.th colspan="10"></x-table.th>
		</x-table.tr>
	</x-table.thead>
	<x-table.tbody>
		<x-table.tr-body subheading="true">
			<x-table.td>Par</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>3</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>5</x-table.td>
			<x-table.td>3</x-table.td>
			<x-table.td>5</x-table.td>
			<x-table.td>4</x-table.td>
			<x-table.td>5</x-table.td>
			<x-table.td>Gross</x-table.td>
			<x-table.td>Par</x-table.td>
			<x-table.td>Net</x-table.td>
			<x-table.td>Par</x-table.td>
			<x-table.td>Points</x-table.td>
			<x-table.td>Eg</x-table.td>
			<x-table.td>Br</x-table.td>
			<x-table.td>Par</x-table.td>
			<x-table.td>Bg</x-table.td>
			<x-table.td>Dbg+</x-table.td>
		</x-table.tr-body>
		@foreach ($scores as $score)
			<x-table.tr-body>
				<x-table.td>
					<a class="font-semibold underline hover:no-underline" href="{{ route('week-score', ['week' => $score->week_id]) }}">
						Wk {{ $score->week_order }}
					</a>
					{{-- <span class="text-xs block font-normal text-zinc-500 mt-1">vs {{ $score->opponent()->user->last_name }}</span> --}}
					@if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
				</x-table.td>
				@if ($score->absent)
					<x-table.td colspan="19" absent="true">ABSENT</x-table.td>
				@elseif ($score->back_nine)
					<x-scorecard.back-nine :score="$score" colspan="19">BACK NINE</x-table.back-nine-td>
				@elseif ($score->injury)
					<x-table.td colspan="19" injury="true">INJURY</x-table.td>
				@else
					<x-scorecard.week :score="$score" />
				@endif
			</x-table.tr-body>
		@endforeach
		@if ($averages)
			<x-table.tr-body>
				<x-table.td class="text-base! font-bold text-zinc-900!">Totals</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_1, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_2, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_3, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_4, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_5, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_6, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_7, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_8, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->hole_9, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->avg_gross, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->avg_gross_par, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->avg_net, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($averages->avg_net_par, 1, '.', ',') }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ $averages->total_points ? $averages->total_points : '0' }}</x-table.td>
				<x-table.td class="text-base! font-bold text-yellow-800!">{{ $averages->total_eagles ? $averages->total_eagles : '0' }}</x-table.td>
				<x-table.td class="text-base! font-bold text-green-800!">{{ $averages->total_birdies ? $averages->total_birdies : '0' }}</x-table.td>
				<x-table.td class="text-base! font-bold text-zinc-900! dark:text-zinc-50! dark:bg-zinc-800!">{{ $averages->total_pars ? $averages->total_pars : '0' }}</x-table.td>
				<x-table.td class="text-base! font-bold text-red-800!">{{ $averages->total_bogeys ? $averages->total_bogeys : '0' }}</x-table.td>
				<x-table.td class="text-base! font-bold text-blue-800!">{{ $averages->total_double_bogeys ? $averages->total_double_bogeys : '0' }}</x-table.td>
			</x-table.tr-body>
		@endif
	</x-table.tbody>
</x-table>
