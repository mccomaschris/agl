<table class="table table-bordered table-striped w-full md:mb-6 mb-8">
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
            <th class="text-ce nter">20</th>
            <th class="text-center">Avg</th>
            <th class="text-center">NetAvg</th>
            {{-- <th class="text-center">Rank</th> --}}
            <th class="text-center">Low</th>
            <th class="text-center">High</th>
            <th class="text-center">LowNet</th>
        </tr>
    </thead>
    @foreach ($players as $player)
    <tr>
        <td><a href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></td>
            @foreach ($player->weekly_scores as $score)
                @if ($score->absent)
                    <td class="text-center absent_row">A</td>
                @elseif ($score->injury)
                    <td class="text-center absent_row">I</td>
                @else
                    <td class="text-center @if($score->gross < 37) low-score @endif">
                        <span class="text-grey-700">{{ $score->gross ? number_format($score->gross, 0, '.', ',') : '' }}</span>
                        @if($score->substitute_id > 0) <span class="font-bold">(S)</span> @endif
                    </td>
                @endif
            @endforeach
        <td class="text-center font-semibold @if ($player->gross_average < 37) low-score @endif">{{ number_format($player->gross_average, 1, '.', ',') }}</td>
        <td class="text-center font-semibold @if ($player->net_average < 37) low-score @endif">{{ number_format($player->net_average, 1, '.', ',') }}</td>
        {{-- <td class="text-center font-semibold">{{ $player->position_net_rank }}</td> --}}
        <td class="text-center font-semibold @if ($player->low_gross < 37) low-score @endif">{{ $player->low_gross }}</td>
        <td class="text-center font-semibold @if ($player->high_gross < 37) low-score @endif">{{ $player->high_gross }}</td>
        <td class="text-center font-semibold @if ($player->low_net < 37) low-score @endif">{{ $player->low_net }}</td>
    </tr>
    @endforeach
</table>