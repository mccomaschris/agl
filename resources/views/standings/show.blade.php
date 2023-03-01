@extends('layouts.default')

@section('page-heading')
  <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Standings</h1>
    <div class="relative">
      <select onchange="location = this.value;">
        @foreach ($years as $item)
          <option value="/standings/{{ $item->name }}"
            @if ($year->id == $item->id)
              selected
            @endif
          >{{ $item->name }} Standings</option>
        @endforeach
      </select>

    </div>
  </div>
@endsection
@section('content')
<div class="flex flex-wrap mb-4">
    <div class="w-full lg:w-2/3 pr-0 lg:pr-4 mb-4 lg:mb-0">
      <h2 class="text-xl lg:text-2xl mt-2 mb-2">Standings</h2>
        @include('_parts.standings-team')
    </div>
    <div class="w-full lg:w-1/3">
      <h2 class="text-xl lg:text-2xl mt-2 mb-2">Individual Points</h2>
      @include('_parts.standings-player', ['take' => 24])
    </div>
  </div>
@endsection
