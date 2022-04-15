
@extends('layouts.admin')

@section('content')
<div class="px-8">
	<div class="flex justify-between">
		<h1 class="mb-8 font-bold text-3xl">
			Scores
			<span class="text-green-500 font-medium">/</span>
			<span class="text-grey-700 font-medium">{{ $week->year->name }} Scores - Week #{{ $week->week_order }}</span>
		</h1>
		<div>
			<div class="relative">
				<select onchange="location = this.value;">
					@foreach($weeks as $item)
						<option value="{{ route('admin.week-scores', ['week' => $item->id]) }}" {{ ($week->id == $item->id) ? 'selected' : ''}}>
							Scores for Week {{ $item->week_order }} ({{ date('F d, Y', strtotime($item->week_date)) }})
						</option>
					@endforeach
					</select>
				<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
					<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
				</div>
			</div>
		</div>
	</div>


	<div class="bg-white rounded shadow overflow-hidden">
		<div class="overflow-x-scroll">
			<table class="w-full whitespace-no-wrap">
				<thead>
					<tr class="text-left font-bold">
						<th class="px-3 pt-6 pb-4">PLAYER</th>
						<th class="px-1 pt-6 pb-4 text-center">ABS</th>
						<th class="px-1 pt-6 pb-4 text-center">WIN</th>
						<th class="px-1 pt-6 pb-4 text-center">SUB</th>
						<th class="px-1 pt-6 pb-4 text-center">1</th>
						<th class="px-1 pt-6 pb-4 text-center">2</th>
						<th class="px-1 pt-6 pb-4 text-center">3</th>
						<th class="px-1 pt-6 pb-4 text-center">4</th>
						<th class="px-1 pt-6 pb-4 text-center">5</th>
						<th class="px-1 pt-6 pb-4 text-center">6</th>
						<th class="px-1 pt-6 pb-4 text-center">7</th>
						<th class="px-1 pt-6 pb-4 text-center">8</th>
						<th class="px-1 pt-6 pb-4 text-center">9</th>
						<th class="px-1 pt-6 pb-4 text-center">GROSS</th>
						<th class="px-1 pt-6 pb-4 text-center">PTS</th>
						<th class="px-1 pt-6 pb-4"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($matchup_1 as $score)
                        <livewire:edit-score :scoreId="$score->id" />
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="bg-white rounded shadow overflow-hidden mt-6">
		<div class="overflow-x-scroll">
			<table class="w-full whitespace-no-wrap">
				<thead>
					<tr class="text-left font-bold">
						<th class="px-3 pt-6 pb-4">PLAYER</th>
						<th class="px-1 pt-6 pb-4 text-center">ABS</th>
						<th class="px-1 pt-6 pb-4 text-center">WIN</th>
						<th class="px-1 pt-6 pb-4 text-center">SUB</th>
						<th class="px-1 pt-6 pb-4 text-center">1</th>
						<th class="px-1 pt-6 pb-4 text-center">2</th>
						<th class="px-1 pt-6 pb-4 text-center">3</th>
						<th class="px-1 pt-6 pb-4 text-center">4</th>
						<th class="px-1 pt-6 pb-4 text-center">5</th>
						<th class="px-1 pt-6 pb-4 text-center">6</th>
						<th class="px-1 pt-6 pb-4 text-center">7</th>
						<th class="px-1 pt-6 pb-4 text-center">8</th>
						<th class="px-1 pt-6 pb-4 text-center">9</th>
						<th class="px-1 pt-6 pb-4 text-center">GROSS</th>
						<th class="px-1 pt-6 pb-4 text-center">PTS</th>
						<th class="px-1 pt-6 pb-4"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($matchup_2 as $score)
                        <livewire:edit-score :scoreId="$score->id" />
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="bg-white rounded shadow overflow-hidden mt-6">
		<div class="overflow-x-scroll">
			<table class="w-full whitespace-no-wrap">
				<thead>
					<tr class="text-left font-bold">
						<th class="px-3 pt-6 pb-4">PLAYER</th>
						<th class="px-1 pt-6 pb-4 text-center">ABS</th>
						<th class="px-1 pt-6 pb-4 text-center">WIN</th>
						<th class="px-1 pt-6 pb-4 text-center">SUB</th>
						<th class="px-1 pt-6 pb-4 text-center">1</th>
						<th class="px-1 pt-6 pb-4 text-center">2</th>
						<th class="px-1 pt-6 pb-4 text-center">3</th>
						<th class="px-1 pt-6 pb-4 text-center">4</th>
						<th class="px-1 pt-6 pb-4 text-center">5</th>
						<th class="px-1 pt-6 pb-4 text-center">6</th>
						<th class="px-1 pt-6 pb-4 text-center">7</th>
						<th class="px-1 pt-6 pb-4 text-center">8</th>
						<th class="px-1 pt-6 pb-4 text-center">9</th>
						<th class="px-1 pt-6 pb-4 text-center">GROSS</th>
						<th class="px-1 pt-6 pb-4 text-center">PTS</th>
						<th class="px-1 pt-6 pb-4"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($matchup_3 as $score)
                        <livewire:edit-score :scoreId="$score->id" />
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
