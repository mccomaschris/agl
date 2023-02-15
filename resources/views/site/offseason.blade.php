@extends('layouts.default')

@section('homepage-alert')
  <div class="flex items-center text-sm bg-grey-900 text-white px-4 lg:pr-8 py-4 lg:py-6 rounded shadow mb-6" role="alert">
      <svg class="h-12 w-12 text-green-bright fill-current mr-4 lg:mr-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z"/></svg>
      <div>
		<div class="font-bold mb-3">Important Date for 2023</div>
		<div>
			<ul>
				<li>League Preseason Meeting, February 28, 6:30PM Logan's Roadhouse</li>
				<li>Snowball April 2, 1PM</li>
				<li>League begins April 6, 5:30PM</li>
				<li>End of year tournament September 24, 1PM</li>
			</ul>
		</div>
      </div>
  </div>
@endsection



@section('jumbotron')
{{-- <div class="invisible lg:visible bg-cover bg-no-repeat h-px lg:min-h-325" style="background: url(../images/new-jumbo.png) center center;">&nbsp;</div> --}}
@endsection

@section('content')
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
