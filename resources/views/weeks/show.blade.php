<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight">{{ $year->name }} Upcoming Schedule</h1>
    </x-slot>

    <div class="flex flex-col gap-8 mt-8">
        @foreach ($weeks as $week)
			<div>
				<div class="mb-4">
					<h2 class="text-lg font-semibold text-gray-900">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }} Matchups - {{ $week->side_games }}</h2>
				</div>

				<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-8">
					<div class="w-full">
						@include('_parts.home-team-table', [
						'teamA' => $week->team_a,
						'teamB' => $week->team_b,
						])
					</div>
					<div class="w-full">
						@include('_parts.home-team-table', [
						'teamA' => $week->team_c,
						'teamB' => $week->team_d,
						])
					</div>
					<div class="w-full">
						@include('_parts.home-team-table', [
						'teamA' => $week->team_e,
						'teamB' => $week->team_f,
						])
					</div>
				</div>
			</div>
        @endforeach
    </div>
</x-layouts.app>
