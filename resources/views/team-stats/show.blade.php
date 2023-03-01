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
