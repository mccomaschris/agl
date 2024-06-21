<x-main>
	<div class="flex flex-wrap items-center lg:items-start w-full my-8">
		<div class="flex flex-col flex-grow leading-snug">
			<h1 class="text-2xl lg:text-4xl uppercase font-semibold">{{ $user->name }}</h1>
			<div class="mt-6 flex items-center">
				<div class="">
					<a href="/players/years/{{ $user->id }}" class="inline-block w-auto bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded hover:text-white focus:outline-none focus:shadow-outline font-semibold">{{ $user->name }} Yearly History</a>
				</div>
				<div class="ml-4">
					<a href="/players/{{ $user->id }}" class="inline-block w-auto bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded hover:text-white focus:outline-none focus:shadow-outline font-semibold">{{ $user->name }} Full History</a>
				</div>
			</div>
		</div>
		<div class="mt-6 lg:mt-0 w-full lg:w-auto">
			<div class="flex flex-col lg:flex-row items-center">
				<div class="mt-4 lg:mt-0">

				</div>
			</div>
    	</div>
  	</div>

	<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
		<div class="lg:col-span-3">
			<div class="flex my-2 items-center uppercase">
				<div class="flex-grow font-semibold lg:text-lg">Season Totals/Averages</div>
			</div>
			<div class="overflow-x-auto">
				<table class="table table-bordered w-full mb-8">
					<thead>
						<tr class="course">
							<th class="text-left">Hole</th>
							<th class="text-center">1</th>
							<th class="text-center">2</th>
							<th class="text-center">3</th>
							<th class="text-center">4</th>
							<th class="text-center">5</th>
							<th class="text-center">6</th>
							<th class="text-center">7</th>
							<th class="text-center">8</th>
							<th class="text-center">9</th>
							<th colspan="5"></th>
							<th colspan="5"></th>
						</tr>
					</thead>
					<tr class="score">
						<td class="">Par</td>
						<td class="text-center ">4</td>
						<td class="text-center ">3</td>
						<td class="text-center ">4</td>
						<td class="text-center ">4</td>
						<td class="text-center ">5</td>
						<td class="text-center ">3</td>
						<td class="text-center ">5</td>
						<td class="text-center ">4</td>
						<td class="text-center ">5</td>
						<td class="text-center ">Gross</td>
						<td class="text-center ">Par</td>
						<td class="text-center ">Net</td>
						<td class="text-center ">Par</td>
						<td class="text-center ">Pts</td>
						<td class="text-center eagle-hole font-semibold">Eg</td>
						<td class="text-center birdie-hole font-semibold">Br</td>
						<td class="text-center par-hole font-semibold">Par</td>
						<td class="text-center bogey-hole font-semibold">Bg</td>
						<td class="text-center double-hole font-semibold">DblBg+</td>
					</tr>
					@foreach($years as $year)
						<tr class="score totals !bg-white">
							<td class="!bg-white">{{ $year->year->name }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_1, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_2, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_3, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_4, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_5, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_6, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_7, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_8, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->hole_9, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->gross, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->gross_par, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->net, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ number_format($year->net_par, 1, '.', ',') }}</td>
							<td class="text-center !bg-white">{{ $year->points ? $year->points : '0' }}</td>
							<td class="text-center !bg-white">{{ $year->eagle ? $year->eagle : '0' }}</td>
							<td class="text-center !bg-white">{{ $year->birdie ? $year->birdie : '0' }}</td>
							<td class="text-center !bg-white">{{ $year->par ? $year->par : '0' }}</td>
							<td class="text-center !bg-white">{{ $year->bogey ? $year->bogey : '0' }}</td>
							<td class="text-center !bg-white">{{ $year->double_bogey ? $year->double_bogey : '0' }}</td>
						</tr>
					@endforeach
				</table>
			</div>

		</div>

	</div>
	</div>
<div>
</x-main>
