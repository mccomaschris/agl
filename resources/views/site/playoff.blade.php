@extends('layouts.default')

@section('homepage-alert')

@endsection

@section('page-heading')

@endsection

@section('jumbotron')
{{-- <div class="invisible lg:visible bg-cover bg-no-repeat h-px lg:min-h-325" style="background: url(../images/new-jumbo.png) center center;">&nbsp;</div> --}}
@endsection

@section('content')

@if ($last_week)
<div class="flex items-center text-sm bg-grey-900 text-white px-4 lg:pr-8 py-4 lg:py-6 rounded shadow mb-6"
	 role="alert">
	<svg class="h-12 w-12 text-green-bright fill-current mr-4 lg:mr-8" xmlns="http://www.w3.org/2000/svg"
		 viewBox="0 0 20 20">
		<path d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z"/>
	</svg>
	<div>
		<p class="md:block mt-3">Week {{ $last_week->week_order }} scores are up! You can checkout the week's <a
				href="{{ route('week-score', ['week' => $last_week->id]) }}"
				class="font-semibold text-green-bright underline">results</a>!</p>
		<p class="hidden md:block mt-3">You can also check out <a
				href="{{ route('team-points', ['year' => $activeYear->name]) }}"
				class="font-semibold text-green-bright underline">team points</a>, <a
				href="{{ route('handicaps', ['year' => $activeYear->name]) }}"
				class="font-semibold text-green-bright underline">handicaps</a>, <a
				href="{{ route('group-stats', ['year' => $activeYear->name]) }}"
				class="font-semibold text-green-bright underline">individual stats by group</a>, and <a
				href="{{ route('team-stats', ['year' => $activeYear->name]) }}"
				class="font-semibold text-green-bright underline">individual stats by team</a>.</p>
	</div>
</div>
@endif

<div class="flex flex-wrap mb-4">
    <div class="w-full lg:w-1/3 mb-4 lg:pr-4">
		<table class="table w-full mx-auto table-striped">
			<thead>
				<tr class="course">
					<th class="text-center rounded-tl" colspan="2">Team 6</th>
					<th class="text-center rounded-tr" colspan="2">Team 5</th>
				</tr>
			</thead>
			<tr>
				<td width="40%">Freeman</td>
				<td width="10%" class="text-center">3</td>
				<td width="40%">Patton</td>
				<td width="10%" class="text-center">2</td>
			</tr>
			<tr class="border-b border-grey-900">
				<td width="40%">T Mills</td>
				<td width="10%" class="text-center">3</td>
				<td width="40%">Cartwright</td>
				<td width="10%" class="text-center">4</td>
			</tr>
			<tr>
				<td width="40%">Chandler</td>
				<td width="10%" class="text-center">8</td>
				<td width="40%">Baumgarner</td>
				<td width="10%" class="text-center">10</td>
			</tr>
			<tr>
				<td width="40%">R Mills</td>
				<td width="10%" class="text-center">10</td>
				<td width="40%">Dumont</td>
				<td width="10%" class="text-center">10</td>
			</tr>
		</table>
    </div>
    <div class="w-full lg:w-1/3">
		<table class="table w-full mx-auto table-striped">
			<thead>
				<tr class="course">
					<th class="text-center rounded-tl" colspan="2">Team 1</th>
					<th class="text-center rounded-tr" colspan="2">Team 3</th>
				</tr>
			</thead>
			<tr>
				<td width="40%">Reed</td>
				<td width="10%" class="text-center">-1</td>
				<td width="40%">Bunn</td>
				<td width="10%" class="text-center">0</td>
			</tr>
			<tr class="border-b border-grey-900">
				<td width="40%">Yablonsky</td>
				<td width="10%" class="text-center">3</td>
				<td width="40%">Edwards</td>
				<td width="10%" class="text-center">4</td>
			</tr>
			<tr>
				<td width="40%">Evans</td>
				<td width="10%" class="text-center">6</td>
				<td width="40%">Adkins</td>
				<td width="10%" class="text-center">7</td>
			</tr>
			<tr>
				<td width="40%">Mi McComas</td>
				<td width="10%" class="text-center">21</td>
				<td width="40%">Thornburg</td>
				<td width="10%" class="text-center">17</td>
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
