@extends('layouts.default')

@section('homepage-alert')

@endsection

@section('page-heading')

@endsection

@section('jumbotron')
{{-- <div class="invisible lg:visible bg-cover bg-no-repeat h-px lg:min-h-325" style="background: url(../images/new-jumbo.png) center center;">&nbsp;</div> --}}
@endsection

@section('content')

<div class="flex flex-wrap mb-4">
    <div class="w-full lg:w-1/3 mb-4 lg:pr-4">

    </div>
    <div class="w-full lg:w-1/3">

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
