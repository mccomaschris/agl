@extends('layouts.default')

@section('page-heading')
	<div class="flex flex-wrap items-center lg:items-start w-full my-8">
		<div class="flex flex-col flex-grow leading-snug">
			<h1 class="text-2xl lg:text-4xl uppercase font-semibold">{{ $player->user->name }}</h1>
			<span class="text-lg lg:text-xl lg:text-2xl font-normal text-grey-600 uppercase font-semibold">{{ $player->team->year->name }} <span class="font-normal">Week {{ $week->week_order }} Scorecard</span></span></h1>
		</div>
  	</div>
@endsection

@section('content')

    @livewire('live-scorecard', ['score' => $score, 'opp_score' => $opp_score])

@endsection