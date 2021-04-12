@extends('layouts.default')

@section('page-heading')
<h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight"></h1>
<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
	<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }}  Results</h1>
	<div class="relative">
		<select onchange="location = this.value;">
			@foreach ($weeks as $item)
			<option value="/scores/week/{{ $item->id }}"
				@if ($week->id == $item->id)
				selected
				@endif
				>Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</option>
				@endforeach
			</select>
			<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
				<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
			</div>
		</div>
	</div>
	@endsection

@section('content')
	<livewire:week-scores :week="$week" />
@endsection
