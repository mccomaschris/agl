@extends('layouts.default')

@section('page-heading')
<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
	<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Group Stats</h1>
	<div class="relative">
		<select onchange="location = this.value;">
			@foreach ($years as $item)
			<option value="/group-stats/{{ $item->name }}"
				@if ($year->id == $item->id)
				selected
				@endif
				>{{ $item->name }} Group Stats</option>
				@endforeach
			</select>

		</div>
	</div>
	@endsection

@section('content')

	<div class="rounded bg-grey-100 border-grey-300 mb-4 border px-4 py-4 text0s">NOTE: <strong>(S)</strong> denotes the round was played by a substitute.</div>

	<h3 class="mb-2 lg:text-xl">One Players</h3>
	<div class="overflow-x-scroll">
		@include('_parts.stats-table', ['players' => $ones])
	</div>

	<h3 class="mb-2 lg:text-xl mt-6">Two Players</h3>
	<div class="overflow-x-scroll">
		@include('_parts.stats-table', ['players' => $twos])
	</div>

	<h3 class="mb-2 lg:text-xl mt-6">Three Players</h3>
	<div class="overflow-x-scroll">
		@include('_parts.stats-table', ['players' => $threes])
	</div>

	<h3 class="mb-2 lg:text-xl mt-6">Four Players</h3>
	<div class="overflow-x-scroll">
		@include('_parts.stats-table', ['players' => $fours])
	</div>
@endsection
