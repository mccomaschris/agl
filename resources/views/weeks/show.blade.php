<x-main>
    <x-slot name="header">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight">{{ $year->name }} Upcoming Schedule</h1>
    </x-slot>

    <div class="flex flex-col">
        @foreach ($weeks as $week)
            <div class="flex items-center mx-auto mb-4 mt-4">
                <span class="text-center text-lg font-semibold">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }} Matchups </span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current  h-4 w-4"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                <span class="text-center text-lg font-semibold">{{ $week->side_games }}</span>
            </div>

            <div class="flex flex-wrap mb-4">
                <div class="w-full lg:w-1/3 mb-4 lg:pr-4">
                    @include('_parts.home-team-table', [
                    'teamA' => $week->team_a,
                    'teamB' => $week->team_b,
                    ])
                </div>
                <div class="w-full lg:w-1/3 mb-4 lg:pr-4">
                    @include('_parts.home-team-table', [
                    'teamA' => $week->team_c,
                    'teamB' => $week->team_d,
                    ])
                </div>
                <div class="w-full lg:w-1/3">
                    @include('_parts.home-team-table', [
                    'teamA' => $week->team_e,
                    'teamB' => $week->team_f,
                    ])
                </div>
            </div>
        @endforeach
    </div>
</x-main>
