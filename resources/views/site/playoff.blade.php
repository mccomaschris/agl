@extends('layouts.default')

@section('homepage-alert')
  <div class="flex items-center text-sm bg-grey-900 text-white px-4 lg:pr-8 py-4 lg:py-6 rounded shadow mb-6" role="alert">
      <svg class="h-12 w-12 text-green-bright fill-current mr-4 lg:mr-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z"/></svg>
      <div>
          {{-- <p><strong>Week One Starts May 14th</strong></p> --}}
          <a class="block lg:hidden text-green-bright" href="sms://+13045509393">Please text your scorecard to Chris after your round.</a>
          <p class=" mt-3">Week {{ $last_week->week_order }} scores are up! You can checkout the week's <a href="{{ route('week-score', ['week' => $last_week->id]) }}" class="font-semibold text-green-bright underline">results</a>!</p>
          <p class="hidden md:block mt-3">You can also check out <a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">team points</a>, <a href="{{ route('handicaps', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">handicaps</a>, <a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">individual stats by group</a>, and <a href="{{ route('team-stats', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">individual stats by team</a>.</p>
      </div>
  </div>
@endsection

@section('page-heading')
<div class="flex items-center lg:justify-center mx-auto mt-6 lg:mt-8 mb-2 lg:mb-4 text-darkest-grey">
    <span class="text-lg lg:text-2xl font-bold">Final Matchups</span>
</div>
@endsection

@section('jumbotron')
{{-- <div class="invisible lg:visible bg-cover bg-no-repeat h-px lg:min-h-325" style="background: url(../images/new-jumbo.png) center center;">&nbsp;</div> --}}
@endsection

@section('content')
<div class="flex flex-wrap mb-4">
    <div class="w-full lg:w-1/3 mb-4 lg:pr-4"></div>
    <div class="w-full lg:w-1/3 mb-4 lg:pr-4">
        <table class="table w-full mx-auto table-striped">
            <thead>
                <tr class="course">
                    <th class="text-center rounded-tl" colspan="2">Team 4</th>
                    <th class="text-center rounded-tr" colspan="2">Team 1</th>
                </tr>
            </thead>
            <tr>
                <td width="40%">Vance Bunn</td>
                <td width="10%" class="text-center">2</td>
                <td width="40%">Rick Reed</td>
                <td width="10%" class="text-center">-1</td>
            </tr>
            <tr class="border-b border-grey-900">
                <td class="">Tom Conard</td>
                <td class="text-center">4</td>
                <td class="">Mike Cartwright</td>
                <td class="text-center">4</td>
            </tr>
            <tr>
                <td width="40%">Aaron Perkins</td>
                <td width="10%" class="text-center">5</td>
                <td width="40%">Bob Hamlin</td>
                <td width="10%" class="text-center">5</td>
            </tr>
            <tr>
                <td width="40%">Roger Mills</td>
                <td width="10%" class="text-center">10</td>
                <td width="40%">Lew Baumgarner</td>
                <td width="10%" class="text-center">10</td>
            </tr>
        </table>
    </div>
    <div class="w-full lg:w-1/3"></div>
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
