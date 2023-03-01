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

    </div>
  </div>
@endsection

@section('content')

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
