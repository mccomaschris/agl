<x-main>
    @admin
        <livewire:admin-controls />
    @endadmin

    <div class="flex items-center text-sm bg-grey-900 text-white px-4 lg:pr-8 py-4 lg:py-6 rounded shadow mb-6" role="alert">
        <svg class="h-12 w-12 text-green-bright fill-current mr-4 lg:mr-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z"/></svg>
        <div>
            {{-- <p><strong>Week One Starts May 14th</strong></p> --}}
            <p class="-mt-2">We will be playing 20 weeks. The last week of the regular season will be September 16.</p>
            <p class="mt-3">For 2021 we are back to the original sand bunker rules. If you hit your ball in a bunker you must play from the sand. <strong>DO NOT</strong> remove it from the bunker before playing it.</p>
            <p class="md:block mt-3">Week {{ $last_week->week_order }} scores are up! You can checkout the week's <a href="{{ route('week-score', ['week' => $last_week->id]) }}" class="font-semibold text-green-bright underline">results</a>!</p>
            <p class="hidden md:block mt-3">You can also check out <a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">team points</a>, <a href="{{ route('handicaps', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">handicaps</a>, <a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">individual stats by group</a>, and <a href="{{ route('team-stats', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">individual stats by team</a>.</p>
        </div>
    </div>

    <div class="flex items-center lg:justify-center mx-auto mt-6 lg:mt-8 mb-2 lg:mb-4 text-darkest-grey">
        <span class="text-center text-lg font-semibold">Week {{ $week->week_order }}, {{ date('F d, Y', strtotime($week->week_date)) }} Matchups</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current  h-4 w-4"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
        <span class="text-center text-lg font-semibold">{{ $week->side_games }}</span>
    </div>

    <div class="flex flex-wrap mb-4">
        @include('site.week-table')
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
</x-main>
