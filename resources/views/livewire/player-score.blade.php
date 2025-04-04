<div>
	<div class="flex flex-wrap gap-4 items-center justify-between my-12">
		<div>
			<flux:subheading size="lg">{{ $player->team->year->name }} Season</flux:subheading>
			<flux:heading size="xl">{{ $player->user->name }}</flux:heading>
		</div>

		<div class="gap-x-2">
			<flux:button href="/players/{{ $player->user->id }}">{{ $player->user->name }} Full History</flux:button>

			@if(count($prev_seasons) > 1)
				<flux:dropdown position="bottom" align="end">
					<flux:button icon-trailing="chevron-down">More {{ $player->user->name }} Seasons</flux:button>

					<flux:navmenu>
						@foreach ($prev_seasons as $season)
							<flux:navmenu.item href="{{ route('player-score', ['player' => $season->player_id]) }}" wire:navigate class="{{ $player->id == $season->player_id ? 'text-green-700! bg-zinc-50!' : '' }}">{{ $player->user->name }} {{ $season->year_name }} Season</flux:navmenu.item>
						@endforeach
					</flux:navmenu>
				</flux:dropdown>
			@endif
		</div>
	</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
	<div class="lg:col-span-3">
		<flux:heading size="lg">Season Totals/Averages</flux:heading>

		<x-table>
			<x-table.thead>
				<x-table.tr>
					<x-table.th class="text-left">Hole</x-table.th>
					<x-table.th class="text-center">1</x-table.th>
					<x-table.th class="text-center">2</x-table.th>
					<x-table.th class="text-center">3</x-table.th>
					<x-table.th class="text-center">4</x-table.th>
					<x-table.th class="text-center">5</x-table.th>
					<x-table.th class="text-center">6</x-table.th>
					<x-table.th class="text-center">7</x-table.th>
					<x-table.th class="text-center">8</x-table.th>
					<x-table.th class="text-center">9</x-table.th>
					<x-table.th colspan="10"></x-table.th>
				</x-table.tr>
			</x-table.thead>
			<x-table.tbody>
				<x-table.tr-body subheading="true">
					<x-table.td>Par</x-table.td>
					<x-table.td>4</x-table.td>
					<x-table.td>3</x-table.td>
					<x-table.td>4</x-table.td>
					<x-table.td>4</x-table.td>
					<x-table.td>5</x-table.td>
					<x-table.td>3</x-table.td>
					<x-table.td>5</x-table.td>
					<x-table.td>4</x-table.td>
					<x-table.td>5</x-table.td>
					<x-table.td>Gross</x-table.td>
					<x-table.td>Par</x-table.td>
					<x-table.td>Net</x-table.td>
					<x-table.td>Par</x-table.td>
					<x-table.td>Points</x-table.td>
					<x-table.td>Eg</x-table.td>
					<x-table.td>Br</x-table.td>
					<x-table.td>Par</x-table.td>
					<x-table.td>Bg</x-table.td>
					<x-table.td>Dbg+</x-table.td>
				</x-table.tr-body>
				<x-table.tr-body>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">Totals</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_1, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_2, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_3, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_4, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_5, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_6, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_7, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_8, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->hole_9, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->gross, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->gross_par, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->net, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($season_avg->net_par, 1, '.', ',') }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ $season_avg->points ? $season_avg->points : '0' }}</x-table.td>
					<x-table.td class="font-bold text-yellow-800! bg-zinc-100! dark:bg-zinc-800! dark:text-yellow-100!">{{ $season_avg->eagle ? $season_avg->eagle : '0' }}</x-table.td>
					<x-table.td class="font-bold text-green-800! bg-zinc-100!">{{ $season_avg->birdie ? $season_avg->birdie : '0' }}</x-table.td>
					<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ $season_avg->par ? $season_avg->par : '0' }}</x-table.td>
					<x-table.td class="font-bold text-red-800! bg-zinc-100!">{{ $season_avg->bogey ? $season_avg->bogey : '0' }}</x-table.td>
					<x-table.td class="font-bold text-blue-800! bg-zinc-100!">{{ $season_avg->double_bogey ? $season_avg->double_bogey : '0' }}</x-table.td>
				</x-table.tr-body>
			</x-table.tbody>
		</x-table>

		<div class="mb-12 mt-12 last:mb-0">
			<div class="flex mb-1 items-center uppercase justify-between">
				<flux:heading size="lg">Weeks 1-5</flux:heading>

				<div class="flex items-center">
					<div class="text-zinc-500">HC</div>
					<div class="ml-1 text-green-500 font-bold text-xl border-b border-dotted border-zinc-500">{{ $player->hc_first }}</div>
				</div>
			</div>

			<x-scorecard :scores="$qtr_1" :average="$qtr_1_avg" />
		</div>

		<div class="mb-12 mt-12 last:mb-0">
			<div class="flex mb-1 items-center uppercase justify-between">
				<flux:heading size="lg">Weeks 6-10</flux:heading>

				<div class="flex items-center">
					<div class="text-zinc-500">HC</div>
					<div class="ml-1 text-green-500 font-bold text-xl border-b border-dotted border-zinc-500">{{ $player->hc_second }}</div>
				</div>
			</div>

			<x-scorecard :scores="$qtr_2" :average="$qtr_2_avg" />
		</div>

		<div class="mb-12 mt-12 last:mb-0">
			<div class="flex mb-1 items-center uppercase justify-between">
				<flux:heading size="lg">Weeks 11-15</flux:heading>

				<div class="flex items-center">
					<div class="text-zinc-500">HC</div>
					<div class="ml-1 text-green-500 font-bold text-xl border-b border-dotted border-zinc-500">{{ $player->hc_third }}</div>
				</div>
			</div>

			<x-scorecard :scores="$qtr_3" :average="$qtr_3_avg" />
		</div>

		<div class="mb-12 mt-12 last:mb-0">
			<div class="flex mb-1 items-center uppercase justify-between">
				<flux:heading size="lg">Weeks 16-20</flux:heading>

				<div class="flex items-center">
					<div class="text-zinc-500">HC</div>
					<div class="ml-1 text-green-500 font-bold text-xl border-b border-dotted border-zinc-500">{{ $player->hc_fourth }}</div>
				</div>
			</div>

			<x-scorecard :scores="$qtr_4" :average="$qtr_4_avg" />
		</div>
	</div>
	<div class="">
		<div class="grid grid-cols-1 gap-4">
			<div class="">
				<div class="flex flex-col p-6 lg:pb-2 bg-zinc-900 rounded-lg">
					<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Points</h3>
					<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
						<div class="w-1/2 flex flex-col text-green-bright">
							<span class="block uppercase font-semibold tracking-tight text-zinc-300">Total</span>
							<span class="block text-3xl lg:text-3xl font-bold">{{ $player->points }}</span>
						</div>
						<div class="w-1/2 flex flex-col text-green-bright">
							<span class="block uppercase font-semibold tracking-tight text-zinc-300">Rank</span>
							<span class="block text-3xl lg:text-3xl font-bold">{{ ordinal($player->points_rank) }}</span>
						</div>
					</div>
				</div>
			</div>

			<div class="">
				<div class="flex flex-col p-6 lg:pt-2 bg-zinc-900 rounded-lg">
					<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Wins</h3>
					<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
						<div class="w-1/2 flex flex-col text-green-bright">
							<span class="block uppercase font-semibold tracking-tight text-zinc-300">Total</span>
							<span class="block text-3xl lg:text-3xl font-bold">{{ $player->won }}</span>
						</div>
						<div class="w-1/2 flex flex-col text-green-bright">
							<span class="block uppercase font-semibold tracking-tight text-zinc-300">Rank</span>
							<span class="block text-3xl lg:text-3xl font-bold">{{ ordinal($player->wins_rank) }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="flex flex-wrap mt-6 ">
			<div class="w-full flex flex-col gap-4">
				<div class="flex flex-col pb-6 px-6 pt-6 bg-green-500 rounded-lg">
					<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Gross Scores</h3>
					<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
						<div class="w-1/2 flex flex-col text-zinc-900">
							<span class="block uppercase font-semibold tracking-tight text-green-900">Average</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ number_format($player->gross_average, 2) }}</span>
						</div>
						<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
							<span class="block uppercase font-semibold tracking-tight text-green-900">Low</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ $player->low_gross }}</span>
						</div>
						<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
							<span class="block uppercase font-semibold tracking-tight text-green-900">High</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ $player->high_gross }}</span>
						</div>
					</div>
				</div>
				<div class="flex flex-col pb-6 px-6 pt-6 bg-green-500 rounded-lg">
					<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Net Scores</h3>
					<div class="flex flex-wrap items-center mt-2 lg:mt-4">
						<div class="w-1/2 flex flex-col text-zinc-900">
							<span class="block uppercase font-semibold tracking-tight text-green-900">Average</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ number_format($player->net_average, 2) }}</span>
						</div>
						<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
							<span class="block uppercase font-semibold tracking-tight text-green-900">Low</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ $player->low_net }}</span>
						</div>
						<div class="w-1/4 flex flex-col text-zinc-900 lg:text-right">
							<span class="block uppercase font-semibold tracking-tight text-green-900">High</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ $player->high_net }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		@if(count($weekly_wins))
			<div class="mb-6 mt-6">
				<flux:heading size="lg">Weekly Winnings</flux:heading>

				<div class="gap-4 mt-6">
					@foreach ($weekly_wins as $week)
						<div>
							@if ($week->week->side_games == 'Net')
								<flux:badge color="orange" icon="arrow-trending-down">Week #{{ $week->week->week_order }} Low Net</flux:badge>
							@elseif ($week->week->side_games == 'Pin')
								<flux:badge color="blue" icon="flag">Week #{{ $week->week->week_order }} Closest to the Pin</flux:badge>
							@elseif($week->week->side_games == 'Putts')
								<flux:badge color="pink">Week #{{ $week->week->week_order }} Low Putts</flux:badge>
							@endif
						</div>
					@endforeach
				</div>
			</div>
		@endif
	</div>
</div>
</div>
