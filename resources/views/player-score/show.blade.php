<x-main>
	<div class="flex flex-wrap items-center lg:items-start w-full my-8">
		<div class="flex flex-col flex-grow leading-snug">
			<h1 class="text-2xl lg:text-4xl uppercase font-semibold">{{ $player->user->name }}</h1>
			<span class="text-lg lg:text-2xl text-grey-600 uppercase font-semibold">{{ $player->team->year->name }} <span class="font-normal">Season</span></span></h1>
		</div>
		<div class="mt-6 lg:mt-0 w-full lg:w-auto">
			<div class="flex flex-col lg:flex-row items-center">
				<div class="mr-0 lg:mr-3 ">
					<a href="/players/{{ $player->user->id }}" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded hover:text-white focus:outline-none focus:shadow-outline font-semibold">{{ $player->user->name }} Full History</a>
				</div>
				<div class="mt-4 lg:mt-0">
					@if(count($prev_seasons) > 1)
						<div class="relative">
							<select onchange="location = this.value;">
								@foreach ($prev_seasons as $season)
									<option value="{{ route('player-score', ['player' => $season->player_id]) }}" {{ ($player->id == $season->player_id) ? 'selected' : '' }}>{{ $player->user->name }} {{ $season->year_name }} Season</option>
								@endforeach
							</select>
						</div>
					@endif
				</div>
			</div>
    	</div>
  	</div>

	<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
		<div class="lg:col-span-3">
			<div class="flex my-2 items-center uppercase">
				<div class="flex-grow font-semibold lg:text-lg">Season Totals/Averages</div>
			</div>
			<div class="overflow-x-scroll">
				<table class="table table-bordered w-full mb-8">
					<thead>
						<tr class="course">
							<th class="text-left">Hole</th>
							<th class="text-center">1</th>
							<th class="text-center">2</th>
							<th class="text-center">3</th>
							<th class="text-center">4</th>
							<th class="text-center">5</th>
							<th class="text-center">6</th>
							<th class="text-center">7</th>
							<th class="text-center">8</th>
							<th class="text-center">9</th>
							<th colspan="5"></th>
							<th colspan="5"></th>
						</tr>
					</thead>
					<tr class="score">
						<td class="">Par</td>
						<td class="text-center ">4</td>
						<td class="text-center ">3</td>
						<td class="text-center ">4</td>
						<td class="text-center ">4</td>
						<td class="text-center ">5</td>
						<td class="text-center ">3</td>
						<td class="text-center ">5</td>
						<td class="text-center ">4</td>
						<td class="text-center ">5</td>
						<td class="text-center ">Gross</td>
						<td class="text-center ">Par</td>
						<td class="text-center ">Net</td>
						<td class="text-center ">Par</td>
						<td class="text-center ">Pts</td>
						<td class="text-center eagle-hole font-semibold">Eg</td>
						<td class="text-center birdie-hole font-semibold">Br</td>
						<td class="text-center par-hole font-semibold">Par</td>
						<td class="text-center bogey-hole font-semibold">Bg</td>
						<td class="text-center double-hole font-semibold">DblBg+</td>
					</tr>
					<tr class="score totals">
						<td>Totals</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_1, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_2, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_3, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_4, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_5, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_6, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_7, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_8, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->hole_9, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->gross, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->gross_par, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->net, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ number_format($season_avg->net_par, 1, '.', ',') }}</td>
						<td class="text-center bg-white">{{ $season_avg->points ? $season_avg->points : '0' }}</td>
						<td class="text-center bg-white">{{ $season_avg->eagle ? $season_avg->eagle : '0' }}</td>
						<td class="text-center bg-white">{{ $season_avg->birdie ? $season_avg->birdie : '0' }}</td>
						<td class="text-center bg-white">{{ $season_avg->par ? $season_avg->par : '0' }}</td>
						<td class="text-center bg-white">{{ $season_avg->bogey ? $season_avg->bogey : '0' }}</td>
						<td class="text-center bg-white">{{ $season_avg->double_bogey ? $season_avg->double_bogey : '0' }}</td>
					</tr>
				</table>
			</div>

			@include('_parts.player-scores-table', [
				'title' => 'Weeks 1-5',
				'handicap' => $player->hc_first,
				'scores' => $qtr_1,
				'average' => $qtr_1_avg
            ])

			@include('_parts.player-scores-table', [
				'title' => 'Weeks 6-10',
				'handicap' => $player->hc_second,
				'scores' => $qtr_2,
				'average' => $qtr_2_avg
            ])
			@include('_parts.player-scores-table', [
				'title' => 'Weeks 11-15',
				'handicap' => $player->hc_third,
				'scores' => $qtr_3,
				'average' => $qtr_3_avg
            ])

			@if ( $player->team->year->name != '2020' )
				@include('_parts.player-scores-table', [
					'title' => 'Weeks 16-20',
					'handicap' => $player->hc_fourth,
					'scores' => $qtr_4,
					'average' => $qtr_4_avg
				])
			@endif
		</div>

		<!-- Start Sidebar -->
		<div class="">
			<div class="grid grid-cols-2 gap-4">
				<div class="">
					<div class="flex flex-col p-6 lg:pb-2 bg-grey-900 rounded lg:rounded-b-none">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Points</h3>
						<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-grey-300">Total</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ $player->points }}</span>
							</div>
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-grey-300">Rank</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ ordinal($player->points_rank) }}</span>
							</div>
						</div>
					</div>
				</div>
				<div class="">
					<div class="flex flex-col p-6 lg:pt-2 bg-grey-900 rounded lg:rounded-t-none">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Wins</h3>
						<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-grey-300">Total</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ $player->won }}</span>
							</div>
							<div class="w-1/2 flex flex-col text-green-bright">
								<span class="block uppercase font-semibold tracking-tight text-grey-300">Rank</span>
								<span class="block text-3xl lg:text-3xl font-bold">{{ ordinal($player->wins_rank) }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-wrap mt-6">
				<div class="w-full">
					<div class="flex flex-col pt-6 px-6 bg-green-500 rounded rounded-b-none">
						<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Gross Scores</h3>
						<div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
							<div class="w-1/2 flex flex-col text-grey-900">
								<span class="block uppercase font-semibold tracking-tight text-green-900 uppercase">Average</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ number_format($player->gross_average, 2) }}</span>
							</div>
							<div class="w-1/4 flex flex-col text-grey-900 lg:text-right">
								<span class="block uppercase font-semibold tracking-tight text-green-900 uppercase">Low</span>
								<span class="block text-2xl lg:text-3xl font-bold">{{ $player->low_gross }}</span>
							</div>
							<div class="w-1/4 flex flex-col text-grey-900 lg:text-right">
							<span class="block uppercase font-semibold tracking-tight text-green-900 uppercase">High</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ $player->high_gross }}</span>
						</div>
					</div>
				</div>
				<div class="flex flex-col pb-6 px-6 pt-6 bg-green-500 rounded rounded-t-none">
					<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Net Scores</h3>
					<div class="flex flex-wrap items-center mt-2 lg:mt-4">
						<div class="w-1/2 flex flex-col text-grey-900">
							<span class="block uppercase font-semibold tracking-tight text-green-900 uppercase">Average</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ number_format($player->net_average, 2) }}</span>
						</div>
						<div class="w-1/4 flex flex-col text-grey-900 lg:text-right">
							<span class="block uppercase font-semibold tracking-tight text-green-900 uppercase">Low</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ $player->low_net }}</span>
						</div>
						<div class="w-1/4 flex flex-col text-grey-900 lg:text-right">
							<span class="block uppercase font-semibold tracking-tight text-green-900 uppercase">High</span>
							<span class="block text-2xl lg:text-3xl font-bold">{{ $player->high_net }}</span>
						</div>
					</div>
				</div>
			</div>

		</div>




          {{-- <div class="mt-4 mb-8">
            <h4 class="text-base font-semibold mb-2">Vs Opponents</h4>
            <table class="w-full table table-condensed">
                <thead>
                  <tr>
                      <th class="text-left rounded-tl">Opponent</th>
                      <th class="text-center">W</th>
                      <th class="text-center">L</th>
                      <th class="text-center rounded-tr">T</th>
                  </tr>
                </thead>
                @foreach($opponents as $opponent)
                  <tr>
                      <td><a href="{{ route('player-score', ['player' => $opponent->opponent->id]) }}">{{ $opponent->opponent->user->name }}</a></td>
                      <td class="text-center">{{ $opponent->won }}</td>
                      <td class="text-center">{{ $opponent->lost }}</td>
                      <td class="text-center">{{ $opponent->tied }}</td>
                  </tr>
                @endforeach
            </table>
          </div> --}}

          @if(count($weekly_wins))
            <div class="mb-6">
              <div class="bg-green-500 rounded py-6 px-4">
                  <h3 class="font-semibold uppercase text-white text-base lg:text-lg mb-4">Weekly Winnings</h3>
                  @foreach ($weekly_wins as $week)
                    <div class="flex items-center mt-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="text-white fill-current h-4 w-4"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-5h1a3 3 0 0 0 0-6H7.99a1 1 0 0 1 0-2H14V5h-3V3H9v2H8a3 3 0 1 0 0 6h4a1 1 0 1 1 0 2H6v2h3v2h2v-2z"/></svg>
                        <div class="text-white ml-2"><a href="{{ route('week-score', ['week' => $week->week->id ]) }}" class="text-white underline hover:text-white hover:underline">Week {{ $week->week->week_order }}</a>


                          @if ($week->week->side_games == 'Net')
                            Low Net Winner
                          @elseif ($week->week->side_games == 'Pin')
                            Closest to the Pin Winner
                          @else
                            Low Putts Winner
                          @endif
                        </div>
                    </div>
                  @endforeach
              </div>
            </div>
		@endif

		@if($player->id != 64)
			@if(count($highest))
    <div class="w-full px-0 mb-6">
				<div class="flex flex-col p-6 bg-grey-900 rounded">
					<h3 class="font-semibold uppercase text-white text-base lg:text-lg">Handicap</h3>
					<div class="flex flex-col items-center mt-2 lg:mt-4 ">
						<div class="w-full flex flex-col text-green-bright">
							<span class="block uppercase font-semibold tracking-tight text-grey-300">Highest Counting</span>
							<span class="block text-3xl lg:text-3xl font-bold">{{ $highest ? number_format($highest[0], 0) : '' }}</span>
						</div>
						<div class="w-full flex flex-col text-green-bright mt-4">
							<span class="block uppercase font-semibold tracking-tight text-grey-300 mb-1">Counted Scores</span>
							<div class="flex">
								@foreach ($counted as $score)
									{{ number_format($score, 0, '.', ',') }}@if(!$loop->last), @endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif
			@endif
        </div>
      </div>
	</div>
<div>
</x-main>
