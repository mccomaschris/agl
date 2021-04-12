@extends('layouts.default')

@section('page-heading')
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
		<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Team Stats</h1>
		<div class="relative">
			<select onchange="location = this.value;">
				@foreach ($years as $item)
					<option value="/team-stats/{{ $item->name }}" {{ ($year->id == $item->id) ? 'selected' : ''}}>{{ $item->name }} Team Stats</option>
				@endforeach
			</select>
			<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
				<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
			</div>
		</div>
	</div>
@endsection
	
@section('content')
	@foreach ($teams as $team)
		<h3 class="mb-2 lg:text-xl {{ $loop->first ? 'mt-0' : 'mt-6' }}">Team {{ $team->name }}</h3>
		<div class="overflow-x-scroll">
			@include('_parts.stats-table', ['players' => $team->players])
		</div>
	@endforeach
@endsection
	