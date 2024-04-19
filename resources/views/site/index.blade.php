<x-main>

	{{-- <div class="flex items-center text-sm bg-grey-900 text-white px-4 lg:pr-8 py-4 lg:py-6 rounded shadow mb-6" role="alert">
        <svg class="h-12 w-12 text-green-bright fill-current mr-4 lg:mr-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z"/></svg>
        <div>
            <p class="md:block mt-3 text-lg">Because of weather, Week 1 has been delayed to April 18th. The schedule has been updated.</p>
        </div>
    </div> --}}

	@if ($last_week)
		<div class="flex items-center text-sm bg-grey-900 text-white px-4 lg:pr-8 py-4 lg:py-6 rounded shadow mb-6" role="alert">
			<svg class="h-12 w-12 text-green-bright fill-current mr-4 lg:mr-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3 6c0-1.1.9-2 2-2h8l4-4h2v16h-2l-4-4H5a2 2 0 0 1-2-2H1V6h2zm8 9v5H8l-1.67-5H5v-2h8v2h-2z"/></svg>
			<div>
				<p class="md:block mt-3">Week {{ $last_week->week_order }} scores are up! You can checkout the week's <a href="{{ route('week-score', ['week' => $last_week->id]) }}" class="font-semibold text-green-bright underline">results</a>!</p>
				<p class="hidden md:block mt-3">You can also check out <a href="{{ route('team-points', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">team points</a>, <a href="{{ route('handicaps', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">handicaps</a>, <a href="{{ route('group-stats', ['year' => $activeYear->name]) }}" class="font-semibold text-green-bright underline">individual stats by group</a>, and <a href="{{ route('team-stats', ['year' => $activeYear->name]) }}"  class="font-semibold text-green-bright underline">individual stats by team</a>.</p>
			</div>
		</div>
	@endif

	@if ($week)
		<div class="flex items-center lg:justify-center mx-auto mt-6 lg:mt-8 mb-2 lg:mb-4 text-darkest-grey">
			<span class="text-center text-lg font-semibold">Week {{ $week->week_order }}, {{ date('F d, Y', strtotime($week->week_date)) }} Matchups - {{ $week->side_games }}</span>
		</div>

		@include('site.week-table')
	@endif

	<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12 pb-12">
		<div class="lg:col-span-2">
			<h2 class="text-lg mt-2 mb-2 font-semibold">Team Standings</h2>
			@include('_parts.standings-team', ['show_max' => true])
		</div>

		<div class="">
			<h2 class="text-lg mt-2 mb-2 font-semibold">Individual Standings</h2>
			@include('_parts.standings-player')
		</div>
	</div>
</x-main>
