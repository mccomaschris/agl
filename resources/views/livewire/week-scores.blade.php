<div>
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight"></h1>
    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
		<div class="flex-1">
			<h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }}  Results</h1>
		</div>

		@admin
			<div class="mr-3">
				<flux:button href="{{ route('week-score-edit', $week) }}" variant="ghost">Edit Week</flux:button>
			</div>
		@endadmin

		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More {{ $week->year->name }} Weeks</flux:button>

			<flux:navmenu>
				@foreach ($weeks as $item)
					<flux:navmenu.item href="{{ route('week-score', ['week' => $item->id]) }}" wire:navigate class="{{ $week->id === $item->id ? 'text-green-700! bg-zinc-50!' : '' }}">Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
    </div>

    @unless(empty($weekly_winners))
		@php
			$gameStyles = [
				'Net' => ['color' => 'orange', 'icon' => 'arrow-trending-down'],
				'Pin' => ['color' => 'blue', 'icon' => 'flag'],
				'Putts' => ['color' => 'pink', 'icon' => null],
			];

			$style = $gameStyles[$week->side_games] ?? ['color' => 'gray', 'icon' => 'info']; // Default fallback
		@endphp

		@if($weekly_winners->isNotEmpty())
			<flux:callout color="{{ $style['color'] }}" icon="{{ $style['icon'] }}" class="mb-12">
				<flux:callout.heading class="flex gap-2 @max-md:flex-col items-start">
					{{ $week->game_name }} {{ Str::plural('Winner', $weekly_winners->count()) }}
					<flux:text>Congrats to {{ formatWinnersList($weekly_winners) }}.</flux:text>
				</flux:callout.heading>
			</flux:callout>
		@endif
	@endunless

    <div class="w-full mb-8 space-y-2">
		<flux:heading size="lg">Matchup #1</flux:heading>
		<x-tables.weekly>
			@foreach ($matchup_1 as $score)
				<x-table.tr-body class="{{ (($loop->index + 1) % 2 == 0) ? 'border-b-4! border-zinc-500 last:border-b-0!' : '' }}" id="{{ $score->player_id }}">
					<x-table.td>Team #{{ $score->team_name }}</x-table.td>
					<x-table.td class="text-left! pl-2!"><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player_name }}</a>
						@if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
					</x-table.td>
					<x-table.td>{{ $score->gross > 0 ? $score->gross - $score->net : '' }}</x-table.td>
					@if ($score->absent)
						<x-table.td colspan="19" absent="true">ABSENT</x-table.td>
					@elseif ($score->injury)
						<x-table.td colspan="19" injury="true">INJURY</x-table.td>
					@else
						<x-scorecard.week :score="$score" />
					@endif
				</x-table.tr-body>
			@endforeach
		</x-tables.weekly>
    </div>

	<div class="w-full mb-8 space-y-2">
		<flux:heading size="lg">Matchup #2</flux:heading>
		<x-tables.weekly>
			@foreach ($matchup_2 as $score)
				<x-table.tr-body class="{{ (($loop->index + 1) % 2 == 0) ? 'border-b-4! border-zinc-500 last:border-b-0!' : '' }}" id="{{ $score->player_id }}">
					<x-table.td>Team #{{ $score->team_name }}</x-table.td>
					<x-table.td class="text-left! pl-2!"><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player_name }}</a>
						@if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
					</x-table.td>
					<x-table.td>{{ $score->gross > 0 ? $score->gross - $score->net : '' }}</x-table.td>
					@if ($score->absent)
						<x-table.td colspan="19" absent="true">ABSENT</x-table.td>
					@elseif ($score->injury)
						<x-table.td colspan="19" injury="true">INJURY</x-table.td>
					@else
						<x-scorecard.week :score="$score" />
					@endif
				</x-table.tr-body>
			@endforeach
		</x-tables.weekly>
    </div>

	<div class="w-full mb-8 space-y-2">
		<flux:heading size="lg">Matchup #3</flux:heading>
		<x-tables.weekly>
			@foreach ($matchup_3 as $score)
				<x-table.tr-body class="{{ (($loop->index + 1) % 2 == 0) ? 'border-b-4! border-zinc-500 last:border-b-0!' : '' }}" id="{{ $score->player_id }}">
					<x-table.td>Team #{{ $score->team_name }}</x-table.td>
					<x-table.td class="text-left! pl-2!"><a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player_name }}</a>
						@if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
					</x-table.td>
					<x-table.td>{{ $score->gross > 0 ? $score->gross - $score->net : '' }}</x-table.td>
					@if ($score->absent)
						<x-table.td colspan="19" absent="true">ABSENT</x-table.td>
					@elseif ($score->injury)
						<x-table.td colspan="19" injury="true">INJURY</x-table.td>
					@else
						<x-scorecard.week :score="$score" />
					@endif
				</x-table.tr-body>
			@endforeach
		</x-tables.weekly>
    </div>
</div>
