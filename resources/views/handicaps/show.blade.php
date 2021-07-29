@extends('layouts.default')

@section('page-heading')
<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Handicaps</h1>
    <div class="relative">
      <select onchange="location = this.value;">
        @foreach ($years as $item)
          <option value="/handicaps/{{ $item->name }}"
            @if ($year->id == $item->id)
              selected
            @endif
          >{{ $item->name }} Handicaps</option>
        @endforeach
      </select>
      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
      </div>
    </div>
  </div>
@endsection

@section('content')

{{-- <div class="text-xs bg-grey-200 border-l-4 border-green-500 p-4 leading-medium lg:leading-normal mb-6" role="alert">
  <p class="mb-2">The <strong>Full Handicap</strong> is a player's handicap based on the best half of all scores for the season. This is the handicap used at the end of the season to determine 1, 2, 3, and 4 players for the following season.</p>
  <p>The number in partenthesis represents that players current rank in the league based on that handicap. Players ranked 1-6 are in line to be 1 players, players ranked 7-12 are in line to be 2 players, etc.</p>
</div> --}}

  <h3 class="lg:text-xl mb-2">One Players</h3>
  <div class="overflow-x-scroll">
      @include('_parts.handicap-table', ['players' => $ones])
  </div>

  <h3 class="lg:text-xl mb-2 mt-6">Two Players</h3>
  <div class="overflow-x-scroll">
      @include('_parts.handicap-table', ['players' => $twos])
  </div>

  <h3 class="lg:text-xl mb-2 mt-6">Three Players</h3>
  <div class="overflow-x-scroll">
      @include('_parts.handicap-table', ['players' => $threes])
  </div>

  <h3 class="lg:text-xl mb-2 mt-6">Four Players</h3>
  <div class="overflow-x-scroll">
      @include('_parts.handicap-table', ['players' => $fours])
  </div>

@endsection
