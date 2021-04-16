<div>
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight"></h1>
    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }}  Results</h1>
        <div class="relative">
            <select wire:model="week">
                @foreach ($weeks as $item)
                    <option value="/scores/week/{{ $item->id }}">Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="w-full mb-6">
        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #1</h3>
        <div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                @admin
                    @include('_parts.week-score-edit-head')
                @else
                    @include('_parts.week-score-head')
                @endadmin

                @foreach ($matchup_1 as $score)
                    @admin
                        @livewire('edit-score', ['scoreId' => $score->id])
                    @else

                        @if (($loop->index + 1) % 2 == 0)
                            <tr style="border-bottom: 4px solid #333;" id="{{ $score->player_id }}">
                        @else
                            <tr id="{{ $score->player_id }}">
                        @endif
                            <td>Team #{{ $score->team_name }}</td>
                            <td><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player_name }}</a>
                                @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
                            </td>
                            <td class="text-center">{{ $score->gross > 0 ? $score->gross - $score->net : '' }}</td>

                            @if ($score->absent)
                                @include('_parts.absent-row', ['colspan' => 19])
                            @elseif ($score->injury)
                                @include('_parts.injury-row', ['colspan' => 19])
                            @elseif (Auth::user() && Auth::user()->isAdmin())

                            @else
                                @include('_parts.week-score-row', ['score' => $score])
                            @endif
                        </tr>
                    @endadmin
                @endforeach
            </table>
        </div>

        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #2</h3>
        <div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                @admin
                    @include('_parts.week-score-edit-head')
                @else
                    @include('_parts.week-score-head')
                @endadmin

                @foreach ($matchup_2 as $score)
                    @admin
                        @livewire('edit-score', ['scoreId' => $score->id])
                    @else

                        @if (($loop->index + 1) % 2 == 0)
                            <tr style="border-bottom: 4px solid #333;" id="{{ $score->player_id }}">
                        @else
                            <tr id="{{ $score->player_id }}">
                        @endif
                            <td>Team #{{ $score->team_name }}</td>
                            <td><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player_name }}</a>
                                @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
                            </td>
                            <td class="text-center">{{ $score->gross > 0 ? $score->gross - $score->net : '' }}</td>

                            @if ($score->absent)
                                @include('_parts.absent-row', ['colspan' => 19])
                            @elseif ($score->injury)
                                @include('_parts.injury-row', ['colspan' => 19])
                            @elseif (Auth::user() && Auth::user()->isAdmin())

                            @else
                                @include('_parts.week-score-row', ['score' => $score])
                            @endif
                        </tr>
                    @endadmin
                @endforeach
            </table>
        </div>

        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #3</h3>
        <div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                @admin
                    @include('_parts.week-score-edit-head')
                @else
                    @include('_parts.week-score-head')
                @endadmin

                @foreach ($matchup_3 as $score)
                    @admin
                        @livewire('edit-score', ['scoreId' => $score->id])
                    @else

                        @if (($loop->index + 1) % 2 == 0)
                            <tr style="border-bottom: 4px solid #333;" id="{{ $score->player_id }}">
                        @else
                            <tr id="{{ $score->player_id }}">
                        @endif
                            <td>Team #{{ $score->team_name }}</td>
                            <td><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player_name }}</a>
                                @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
                            </td>
                            <td class="text-center">{{ $score->gross > 0 ? $score->gross - $score->net : '' }}</td>

                            @if ($score->absent)
                                @include('_parts.absent-row', ['colspan' => 19])
                            @elseif ($score->injury)
                                @include('_parts.injury-row', ['colspan' => 19])
                            @elseif (Auth::user() && Auth::user()->isAdmin())

                            @else
                                @include('_parts.week-score-row', ['score' => $score])
                            @endif
                        </tr>
                    @endadmin
                @endforeach
            </table>
        </div>

    </div>

</div>
