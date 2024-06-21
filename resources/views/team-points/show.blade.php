@extends('layouts.default')

@section('page-heading')
  <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">{{ $year->name }} Team Points</h1>
      <div class="relative">
        <select onchange="location = this.value;" class="">
          @foreach ($years as $item)
            <option value="/team-points/{{ $item->name }}"
              @if ($year->id == $item->id)
                selected
              @endif
            >{{ $item->name }} Team Points</option>
          @endforeach
        </select>
      </div>
  </div>
@endsection

@section('content')

  <div class="rounded bg-grey-100 border-grey-300 mb-4 border px-4 py-4 text0s">NOTE: <strong>(S)</strong> denotes the round was played by a substitute.</div>

  @foreach ($teams as $team)

    <h3 class="mb-2 lg:text-xl text-darkest-grey" id="{{ $team->id }}">Team {{ $team->name }}</h3>
    <div class="overflow-x-auto">
      <table class="table table-bordered table-striped w-full mb-6 lg:mb-8">
        <thead>
          <tr class="course">
            <th>Week</th>
            <th class="text-center">1</th>
            <th class="text-center">2</th>
            <th class="text-center">3</th>
            <th class="text-center">4</th>
            <th class="text-center">5</th>
            <th class="text-center">6</th>
            <th class="text-center">7</th>
            <th class="text-center">8</th>
            <th class="text-center">9</th>
            <th class="text-center">10</th>
            <th class="text-center">11</th>
            <th class="text-center">12</th>
            <th class="text-center">13</th>
            <th class="text-center">14</th>
            <th class="text-center">15</th>
            <th class="text-center">16</th>
            <th class="text-center">17</th>
            <th class="text-center">18</th>
            <th class="text-center">19</th>
            <th class="text-center">20</th>
            <th class="text-center">Total</th>
            <th class="text-center">Win %</th>
            <th class="text-center">Won</th>
            <th class="text-center">Lost</th>
            <th class="text-center">Tied</th>
            <th class="text-center">Win Rank</th>
          </tr>
        </thead>

        @foreach ($team->players as $player)
          <tr>
            <td><a href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>

              @foreach ($player->scores as $score)
                @if ($score->absent)
                  <td class="text-center absent_row">A</td>
                @elseif ($score->injury)
                  <td class="text-center absent_row">I</td>
                @else
                  <td class="text-center"><span class="text-grey-700">{{ $score->points }} @if($score->substitute_id > 0)<span class="font-bold">(S)</span>@endif</span></td>
                @endif
              @endforeach

            <td class="text-center font-semibold">{{ $player->points }}</td>
            <td class="text-center font-semibold">{{ number_format($player->win_pct, 3, '.', ',') }}</td>
            <td class="text-center font-semibold">{{ $player->won }}</td>
            <td class="text-center font-semibold">{{ $player->lost }}</td>
            <td class="text-center font-semibold">{{ $player->tied }}</td>
            <td class="text-center font-semibold">{{ $player->wins_rank }}</td>
          </tr>
        @endforeach

        <tr class="totals">
            <td colspan="21">TEAM TOTALS</td>
            <td class="text-center">{{ $team->points }}</td>
            <td class="text-center"></td>
            <td class="text-center">{{ $team->won }}</td>
            <td class="text-center">{{ $team->lost }}</td>
            <td class="text-center">{{ $team->tied }}</td>
            <td class="text-center"></td>
        </tr>
      </table>
    </div>

  @endforeach
@endsection
