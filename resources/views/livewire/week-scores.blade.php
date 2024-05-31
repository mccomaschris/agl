<div>
    <h1 class="text-center lg:text-left text-2xl lg:text-3xl mt-6 mb-4 tracking-tight"></h1>
    <div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-6 items-center">
        <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mb-4 lg:mb-0">Week {{ $week->week_order }} - {{ date('F d, Y', strtotime($week->week_date)) }}  Results</h1>
        <div x-data="{ open: false }" x-on:click.away="open = false" class="relative inline-block text-left">
			<div>
				<button x-on:click="open = true" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
					More {{ $week->year->name }} Weeks
					<svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
					</svg>
				</button>
			</div>

			<div
				x-cloak
				x-show="open"
				x-transition:enter="transition ease-out duration-100"
				x-transition:enter-start="transform opacity-0 scale-95"
				x-transition:enter-end="transform opacity-100 scale-100"
				x-transition:leave="transition ease-in duration-75"
				x-transition:leave-start="transform opacity-100 scale-100"
				x-transition:leave-end="transform opacity-0 scale-95"
				class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
			>
				<div class="py-1" role="none">
					@foreach ($weeks as $item)
						<a wire:navigate href="/scores/week/{{ $item->id }}" class="{{ ($week->id == $item->id) ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }} text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Week {{ $item->week_order }} - {{ date('F d, Y', strtotime($item->week_date)) }} Results</a>
					@endforeach
				</div>
			</div>
		</div>
    </div>

    @if(count($weekly_winners))
		<div class="flex mb-4 items-center text-sm lg:text-base">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="text-green-500 fill-current h-4 w-4"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-5h1a3 3 0 0 0 0-6H7.99a1 1 0 0 1 0-2H14V5h-3V3H9v2H8a3 3 0 1 0 0 6h4a1 1 0 1 1 0 2H6v2h3v2h2v-2z"/></svg>
			<div class="ml-2 font-semibold">{{ $week->game_name }} {{ count($weekly_winners) > 1 ? 'Winners' : 'Winner' }}
				@foreach ($weekly_winners as $winner)
					<a href="{{ route('player-score', ['player' => $winner->player->id]) }}">{{ $winner->player->user->name }}</a>@if (!$loop->last), @endif
				@endforeach
			</div>
		</div>
	@endif

    <div class="w-full mb-6">
        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #1</h3>
        <div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                <x-tables.week-score-th />

                @foreach ($matchup_1 as $score)
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
							<x-tables.absent />
						@elseif ($score->injury)
							<x-tables.injury />
						@elseif ($week->back_nine)
							<x-tables.back-nine-td :score="$score" />
						@else
							<x-tables.week-score-td :score="$score" />
						@endif
					</tr>
                @endforeach
            </table>
        </div>

        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #2</h3>
        <div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                <x-tables.week-score-th />

                @foreach ($matchup_2 as $score)
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
							<x-tables.absent />
						@elseif ($score->injury)
							<x-tables.injury />
						@else
							<x-tables.week-score-td :score="$score" />
						@endif
					</tr>
                @endforeach
				</table>
        </div>

        <h3 class="lg:text-xl mb-2 font-semibold">Matchup #3</h3>
        <div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
                <x-tables.week-score-th />

                @foreach ($matchup_3 as $score)
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
							<x-tables.absent />
						@elseif ($score->injury)
							<x-tables.injury />
						@else
							<x-tables.week-score-td :score="$score" />
						@endif
					</tr>
                @endforeach
			</table>
        </div>
    </div>
</div>
