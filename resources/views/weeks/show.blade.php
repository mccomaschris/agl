<x-main>
    <x-slot name="header">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight">{{ $year->name }} Upcoming Schedule</h1>
    </x-slot>

    <div class="flex flex-col">
        @foreach ($weeks as $week)
            <div class="flex items-center mx-auto mb-4 mt-4">
                <span class="text-center text-lg font-semibold">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }} Matchups - {{ $week->side_games }}</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="">
                    @include('_parts.home-team-table', [
                    'teamA' => $week->team_a,
                    'teamB' => $week->team_b,
                    ])
                </div>
                <div class="">
                    @include('_parts.home-team-table', [
                    'teamA' => $week->team_c,
                    'teamB' => $week->team_d,
                    ])
                </div>
                <div class="">
                    @include('_parts.home-team-table', [
                    'teamA' => $week->team_e,
                    'teamB' => $week->team_f,
                    ])
                </div>
            </div>
        @endforeach
    </div>
</x-main>
