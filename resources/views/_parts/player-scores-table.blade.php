<div class="flex my-2 items-center uppercase">
    <div class="flex-grow font-semibold lg:text-lg">{{ $title }}</div>
    <div class="flex items-center">
        <div class="text-zinc-500">HC</div>
        <div class="ml-1 text-green-500 font-bold text-lg">{{ $handicap }}</div>
    </div>
</div>
<div class="overflow-x-auto">
    <table class="table table-bordered w-full mb-8">
        <thead>
            <tr class="course">
                <th class="text-left">Hole</th>
                <th class="text-center">1</th>
                <th class="text-center">2</th>
                <th class="text-center">3</th>
                <th class="text-center">4</th>
                <th class="text-center">5</th>
                <th class="text-center">6</th>
                <th class="text-center">7</th>
                <th class="text-center">8</th>
                <th class="text-center">9</th>
                <th colspan="5"></th>
                <th colspan="5"></th>
            </tr>
        </thead>
        <tr class="score">
            <td class="">Par</td>
            <td class="text-center ">4</td>
            <td class="text-center ">3</td>
            <td class="text-center ">4</td>
            <td class="text-center ">4</td>
            <td class="text-center ">5</td>
            <td class="text-center ">3</td>
            <td class="text-center ">5</td>
            <td class="text-center ">4</td>
            <td class="text-center ">5</td>
            <td class="text-center ">Gross</td>
            <td class="text-center ">Par</td>
            <td class="text-center ">Net</td>
            <td class="text-center ">Par</td>
            <td class="text-center ">Pts</td>
            <td class="text-center eagle-hole font-semibold">Eg</td>
            <td class="text-center birdie-hole font-semibold">Br</td>
            <td class="text-center par-hole font-semibold">Par</td>
            <td class="text-center bogey-hole font-semibold">Bg</td>
            <td class="text-center double-hole font-semibold">DblBg+</td>
        </tr>

        @foreach ($scores as $score)
            <tr>
                <td>
                    <a href="{{ route('week-score', ['week' => $score->foreign_key]) }}">
                        <span class="hidden lg:inline-block">Week</span>
                        <span class="inline-block lg:hidden">Wk</span>{{ $score->week->week_order }}
						@if($score->week->back_nine) <span class="font-bold">(*)</span> @endif
                    </a>
                    @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
                </td>
                @if ($score->absent)
                    @include('_parts.absent-row', ['colspan' => 19])
                @elseif ($score->injury)
                    @include('_parts.injury-row', ['colspan' => 19])
                @else
                    @include('_parts.player-score-row')
                @endif
            </tr>
        @endforeach

        <tr class="score totals">
            <td>Totals</td>
            <td class="text-center">{{ number_format($average->hole_1, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_2, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_3, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_4, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_5, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_6, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_7, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_8, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->hole_9, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->gross, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->gross_par, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->net, 1, '.', ',') }}</td>
            <td class="text-center">{{ number_format($average->net_par, 1, '.', ',') }}</td>
            <td class="text-center">{{ $average->points ? $average->points : '0' }}</td>
            <td class="text-center">{{ $average->eagle ? $average->eagle : '0' }}</td>
            <td class="text-center">{{ $average->birdie ? $average->birdie : '0' }}</td>
            <td class="text-center">{{ $average->par ? $average->par : '0' }}</td>
            <td class="text-center">{{ $average->bogey ? $average->bogey : '0' }}</td>
            <td class="text-center">{{ $average->double_bogey ? $average->double_bogey : '0' }}</td>
        </tr>
    </table>
</div>
