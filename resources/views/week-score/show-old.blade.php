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

		</div>
	</div>
	@endsection

@section('content')
	@if(count($weekly_winners))
	<div class="flex mb-4 items-center text-sm lg:text-base">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="text-green-500 fill-current h-4 w-4"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-5h1a3 3 0 0 0 0-6H7.99a1 1 0 0 1 0-2H14V5h-3V3H9v2H8a3 3 0 1 0 0 6h4a1 1 0 1 1 0 2H6v2h3v2h2v-2z"/></svg>
		<div class="ml-2 font-semibold">{{ $week->game_name }} {{ count($weekly_winners) > 1 ? 'Winners' : 'Winner' }}
			@foreach ($weekly_winners as $winner)
			<a href="{{ route('player-score', ['player' => $winner->player->id]) }}">{{ $winner->player->user->name }}</a>@if (!$loop->last), @endif
			@endforeach
		</div>
	</div>
	@endif
	<div class="flex flex-col">
        <livewire:edit-score :week="$week">
	</div>
@endsection
