<x-main>

    @admin
        <livewire:admin-controls />
    @endadmin

    <x-slot name="header">
        <div class="flex items-center lg:justify-center mx-auto mt-6 lg:mt-8 mb-2 lg:mb-4 text-darkest-grey">
            <span class="text-center text-lg font-semibold">Week {{ $week->week_order }}, {{ date('F d, Y', strtotime($week->week_date)) }} Matchups</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current  h-4 w-4"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            <span class="text-center text-lg font-semibold">{{ $week->side_games }}</span>
        </div>
    </x-slot>

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
