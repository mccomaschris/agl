<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight">{{ $year->name }} Upcoming Schedule</h1>
    </x-slot>

    <div class="flex flex-col gap-8 mt-8">
        @foreach ($weeks as $week)
			<div>
				<div class="mb-6">
					<flux:heading size="lg">{{ $year->name }} Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }} Matchups</flux:heading>
					<flux:subheading>
						@if($week->side_games == 'Net')
							<flux:badge color="orange" icon="arrow-trending-down">Low Net</flux:badge>
						@elseif($week->side_games == 'Pin')
							<flux:badge color="blue" icon="flag">Closest to the Pin</flux:badge>
						@elseif($week->side_games == 'Putt')
							<flux:badge color="yellow">Low Putts</flux:badge>
						@endif
					</flux:subheading>
				</div>

				<x-site.week-table :week="$week" />
			</div>
        @endforeach
    </div>
</x-layouts.app>
