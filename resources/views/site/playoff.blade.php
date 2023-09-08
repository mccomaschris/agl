@extends('layouts.default')

@section('homepage-alert')
  <div class="flex items-center text-sm bg-grey-900 text-white px-4 lg:pr-8 py-4 lg:py-6 rounded shadow mb-6" role="alert">
	<svg class="h-12 w-12 text-green-bright fill-current mr-4 lg:mr-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z"/></svg>
	<div>
		<p class="md:block mt-3">Week {{ $last_week->week_order }} scores are up! You can checkout the week's <a href="{{ route('week-score', ['week' => $last_week->id]) }}" class="font-semibold text-green-bright underline">results</a>!</p>
		<p class="hidden md:block mt-3">You can also check out <a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">team points</a>, <a href="{{ route('handicaps', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">handicaps</a>, <a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">individual stats by group</a>, and <a href="{{ route('team-stats', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">individual stats by team</a>.</p>
	</div>
</div>

<div class="py-12 flex  flex-col">
	<img src="/craig.jpg" class="h-32 lg:h-64 w-auto mx-auto" />
	<div class="text-xl font-bold mt-2 text-center">Congrats to Craig Edwards for being the WORST golfer in Appliance Golf League history!</div>
</div>
@endsection

@section('page-heading')
<div class="flex items-center lg:justify-center mx-auto mt-6 lg:mt-8 mb-2 lg:mb-4 text-darkest-grey">
    <span class="text-lg lg:text-2xl font-bold">Finals Matchups</span>
</div>
@endsection

@section('jumbotron')
{{-- <div class="invisible lg:visible bg-cover bg-no-repeat h-px lg:min-h-325" style="background: url(../images/new-jumbo.png) center center;">&nbsp;</div> --}}
@endsection

@section('content')

<div class="flex flex-wrap mb-4">
    <div class="w-full lg:w-1/3 mb-4 lg:pr-4">

    </div>
    <div class="w-full lg:w-1/3">
		<table class="table w-full mx-auto table-striped">
            <thead>
                <tr class="course">
                    <th class="text-center rounded-tl" colspan="2">Team 1</th>
                    <th class="text-center rounded-tr" colspan="2">Team 2</th>
                </tr>
            </thead>
            <tr>
                <td width="40%">Reed</td>
                <td width="10%" class="text-center">-1</td>
                <td width="40%">Patton</td>
                <td width="10%" class="text-center">4</td>
            </tr>
            <tr class="border-b border-grey-900">
                <td class="">Ma. McComas</td>
                <td class="text-center">7</td>
                <td class="">Cartwright</td>
                <td class="text-center">6</td>
            </tr>
            <tr>
                <td width="40%">Conard</td>
                <td width="10%" class="text-center">9</td>
                <td width="40%">Keyser</td>
                <td width="10%" class="text-center">8</td>
            </tr>
            <tr>
                <td width="40%">Cutlip</td>
                <td width="10%" class="text-center">11</td>
                <td width="40%">Hedrick</td>
                <td width="10%" class="text-center">10</td>
            </tr>
        </table>
    </div>
	<div class="w-full lg:w-1/3 mb-4 lg:pr-4">

    </div>
</div>
<div class="flex flex-wrap lg:-mx-4 mb-4">
  <div class="w-full lg:w-2/3 pr-0 lg:px-4 mb-4 lg:mb-0">
    <h2 class="text-lg mt-2 mb-2 font-semibold">Team Standings</h2>
    @include('_parts.standings-team', ['show_max' => true])
  </div>
  <div class="w-full lg:w-1/3  lg:px-4">
    <h2 class="text-lg mt-2 mb-2 font-semibold">Individual Standings</h2>
    @include('_parts.standings-player', ['take' => 5])
  </div>
</div>

@endsection
