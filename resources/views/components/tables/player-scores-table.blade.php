<div class="flex mb-4 items-center uppercase">
    <div class="flex-grow font-semibold lg:text-lg">{{ $title }}</div>
    <div class="flex items-center">
        <div class="text-zinc-500">HC</div>
        <div class="ml-1 text-green-500 font-bold text-xl border-b border-dotted border-zinc-500">{{ $handicap }}</div>
    </div>
</div>
<div class="flow-root">
	<div class="">
		<div class="inline-block min-w-full py-2 align-middle">
			<div class="overflow-hidden ring-1 shadow-sm ring-black/5 rounded-lg mx-1">
				<div class="overflow-x-auto">
					<table class="min-w-full divide-y divide-gray-300">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6 border-r border-zinc-300">Hole</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">1</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">2</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">3</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">4</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">5</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">6</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">7</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">8</th>
								<th scope="col" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900 border-r border-zinc-300">9</th>
								<th scope="col" colspan="10" class="text-center px-1 py-3.5 text-sm font-semibold text-gray-900"></th>
							</tr>
						</thead>
						<tbody>
							<tr class="bg-green-600">
								<td class="py-3.5 pr-3 pl-4 text-left text-sm sm:pl-6 border-r border-green-800 text-green-100 font-semibold">Par</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">4</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">3</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">4</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">4</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">5</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">3</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">5</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">4</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">5</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Gross</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Par</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Net</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Par</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Points</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Eg</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Br</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Par</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Bg</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm border-r border-green-800 text-green-100">Dbg+</td>
							</tr>
							@foreach ($scores as $score)
								<tr class="even:bg-white odd:bg-gray-50/50 border-b border-zinc-300">
									<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6 border-r border-zinc-300">
										<a class="font-semibold underline hover:no-underline" href="{{ route('week-score', ['week' => $score->foreign_key]) }}">
											Wk {{ $score->week->week_order }}
										</a>
										<span class="text-xs block font-normal text-zinc-500 mt-1">vs {{ $score->opponent()->user->last_name }}</span>
										@if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
									</td>
									@if ($score->absent)
										<x-tables.absent />
									@elseif ($score->injury)
										<x-tables.injury />
									@elseif ($score->week->back_nine)
										<x-tables.back-nine-td :score="$score" />
									@else
										<x-tables.week-score-td :score="$score" />
									@endif
								</tr>
							@endforeach
							<tr class="score totals">
								<td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6 border-r border-zinc-300">Totals</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_1, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_2, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_3, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_4, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_5, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_6, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_7, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_8, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->hole_9, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->gross, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->gross_par, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->net, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ number_format($average->net_par, 1, '.', ',') }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ $average->points ? $average->points : '0' }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-yellow-800 border-r border-zinc-300 bg-gray-100">{{ $average->eagle ? $average->eagle : '0' }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-green-800 border-r border-zinc-300 bg-gray-100">{{ $average->birdie ? $average->birdie : '0' }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-gray-900 border-r border-zinc-300 bg-gray-100">{{ $average->par ? $average->par : '0' }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-red-800 border-r border-zinc-300 bg-gray-100">{{ $average->bogey ? $average->bogey : '0' }}</td>
								<td class="text-center font-semibold px-1 py-3.5 text-sm text-blue-800 border-r border-zinc-300 bg-gray-100">{{ $average->double_bogey ? $average->double_bogey : '0' }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
