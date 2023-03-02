@extends('layouts.default')

@section('page-heading')
  <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mt-12 mb-6 lg:mb-0 lg:leading-none">{{ $user->name }} <br class="lg:hidden">League History</h1>
@endsection


@section('content')
	<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-6">
		<div class="p-6 bg-grey-900 rounded">
			<h3 class="font-semibold uppercase text-white text-lg mb-3">Career Averages</h3>
			<div class=" grid grid-cols-2">
				<div class="flex flex-col text-green-bright">
					<span class="block uppercase font-semibold tracking-tight text-grey-300">Net</span>
					<span class="block text-3xl lg:text-4xl font-bold">{{ number_format($net_avg, 2, '.', ',') }}</span>
				</div>
				<div class="flex flex-col text-green-bright">
					<span class="block uppercase font-semibold tracking-tight text-grey-300">Gross</span>
					<span class="block text-3xl lg:text-4xl font-bold">{{ number_format($gross_avg, 2, '.', ',') }}</span>
				</div>
			</div>
		</div>
		<div class="p-6 bg-grey-900 rounded">
			<h3 class="font-semibold uppercase text-white text-lg mb-3">Career Bests</h3>
			<div class="grid grid-cols-3">
				<div class="flex flex-col text-green-bright">
					<span class="block uppercase font-semibold tracking-tight text-grey-300">Rounds</span>
					<span class="block text-3xl lg:text-4xl font-bold">{{ $total_scores }}</span>
				</div>
				<div class="flex flex-col text-green-bright">
					<span class="block uppercase font-semibold tracking-tight text-grey-300">Net</span>
					<span class="block text-3xl lg:text-4xl font-bold">{{ number_format($low_net, 0, '.', ',') }}</span>
				</div>
				<div class="flex flex-col text-green-bright">
					<span class="block uppercase font-semibold tracking-tight text-grey-300">Gross</span>
					<span class="block text-3xl lg:text-4xl font-bold">{{ number_format($low_gross, 0, '.', ',') }}</span>
				</div>
			</div>
		</div>
	</div>

    <div class="flex flex-wrap -mx-4 mt-6">
        <div class="w-full px-4">
            <div class="flex flex-col p-6 bg-grey-900 rounded ">
                <h3 class="font-semibold uppercase text-white text-lg mb-3">Scoring</h3>
                <div class="grid grid-cols-2 lg:grid-cols-6 gap-4">
                    <div class="flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Holes</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $holes }}</span>
                    </div>
                    <div class="flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Eagle</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $eagle }} <span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($eagle / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Birdie</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $birdie }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($birdie / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Par</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $par }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($par / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Bogey</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $bogey }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($bogey / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">2 Bogey+</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $double_bogey }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($double_bogey / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

	@if(count($individual_championships))
	<div class="w-full mt-6">
		<div class="p-6 bg-grey-900 rounded ">
			<h3 class="font-semibold uppercase text-white text-lg mb-3">Individual Championships</h3>
			<div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
				@foreach ($individual_championships as $item)
					<div class="flex flex-col space-y-4 items-center justify-center py-4">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-green-bright w-6 h-6 lg:w-12 lg:h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" /></svg>
						<span class="text-white font-semibold uppercase text-sm text-center">{{ $item->name }} Champion</span>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@endif

	@if(count($team_championships))
	<div class="w-full mt-6">
		<div class="p-6 bg-grey-900 rounded ">
			<h3 class="font-semibold uppercase text-white text-lg mb-3">Team Championships</h3>
			<div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
				@foreach ($team_championships as $item)
					<div class="flex flex-col space-y-4 items-center justify-center py-4">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-green-bright w-6 h-6 lg:w-12 lg:h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" /></svg>
						<span class="text-white font-semibold uppercase text-sm text-center">{{ $item->year_name }} Champion Team {{ $item->team_name}}</span>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@endif

	@if(count($weekly_wins))
	<div class="w-full mt-6">
		<div class="p-6 bg-grey-900 rounded ">
			<h3 class="font-semibold uppercase text-white text-lg mb-3">Weekly Wins</h3>
			<div class="grid grid-cols-2 lg:grid-cols-8 gap-8">
				@foreach ($weekly_wins as $item)
					<div class="flex flex-col space-y-4 items-center justify-center py-4">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-green-bright h-6 w-6"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm1-5h1a3 3 0 0 0 0-6H7.99a1 1 0 0 1 0-2H14V5h-3V3H9v2H8a3 3 0 1 0 0 6h4a1 1 0 1 1 0 2H6v2h3v2h2v-2z"/></svg>
                        <span class="text-white font-semibold uppercase text-sm text-center">{{ $item->name }} Week {{ $item->week_order }} - {{ $item->side_games }}</span>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@endif

	<div class="flex flex-wrap -mx-4 mt-6">
		<div class="w-full px-4">
		  <h3 class="text-lg mt-2 mb-2 font-semibold">Season by Season</h3>
			<div class="overflow-x-scroll">
				<table class="table table-bordered w-full mb-8">
					<tr class="course">
						<th class="text-left">Year</th>
						<th class="text-center">Won</th>
						<th class="text-center">Lost</th>
						<th class="text-center">Tied</th>
						<th class="text-center">Points</th>
						<th class="text-center">Points Rank</th>
						<th class="text-center">Low Net</th>
						<th class="text-center">Low Gross</th>
					</tr>
					@foreach ($years as $year)
						<tr>
							<td><a href="{{ route('player-score', ['player' => $year->id]) }}">{{ $year->year->name }}</a></td>
							<td class="text-center">{{ $year->won }}</td>
							<td class="text-center">{{ $year->lost }}</td>
							<td class="text-center">{{ $year->tied }}</td>
							<td class="text-center">{{ $year->points }}</td>
							<td class="text-center">{{ $year->points_rank }}</td>
							<td class="text-center">{{ $year->low_net }}</td>
							<td class="text-center">{{ $year->low_gross }}</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>

    <div class="">
        <h3 class="text-lg mt-2 mb-2 font-semibold">Historical Scores</h3>
        <div class="overflow-x-scroll">
            <table class="table table-bordered w-full mb-8">
              @include('_parts.player-career-header')

              @foreach ($scores as $score)
                @if (($loop->index + 1) % 15 == 0)
                    @include('_parts.player-career-header')
                @endif
                <tr>
                      <td><a href="{{ route('week-score', ['week' => $score->week_id]) }}">{{ $score->year_name }} Week {{ $score->week_order }}</a></td>
                        <td class="text-center
                          @if ($score->hole_1 >= 1 and $score->hole_1 <=2)
                            eagle-hole
                          @elseif ($score->hole_1 == 3)
                            birdie-hole
                          @elseif ($score->hole_1 == 4)
                            par-hole
                          @elseif ($score->hole_1 == 5)
                            bogey-hole
                          @elseif ($score->hole_1 >= 6)
                            double-hole
                          @endif
                          ">
                          {{ $score->hole_1 ? number_format($score->hole_1, 0, '.', ',') : '' }}
                        </td>

                        <td class="text-center
                           @if ($score->hole_2 == 1)
                             eagle-hole
                           @elseif ($score->hole_2 == 2)
                             birdie-hole
                           @elseif ($score->hole_2 == 3)
                             par-hole
                           @elseif ($score->hole_2 == 4)
                             bogey-hole
                           @elseif ($score->hole_2 >= 5)
                             double-hole
                           @endif
                           ">
                           {{ $score->hole_2 ? number_format($score->hole_2, 0, '.', ',') : '' }}
                         </td>

                        <td class="text-center
                          @if ($score->hole_3 >= 1 and $score->hole_3 <=2)
                            eagle-hole
                          @elseif ($score->hole_3 == 3)
                            birdie-hole
                          @elseif ($score->hole_3 == 4)
                            par-hole
                          @elseif ($score->hole_3 == 5)
                            bogey-hole
                          @elseif ($score->hole_3 >= 6)
                            double-hole
                          @endif
                          ">
                          {{ $score->hole_3 ? number_format($score->hole_3, 0, '.', ',') : '' }}
                        </td>

                        <td class="text-center
                          @if ($score->hole_4 >= 1 and $score->hole_4 <=2)
                            eagle-hole
                          @elseif ($score->hole_4 == 3)
                            birdie-hole
                          @elseif ($score->hole_4 == 4)
                            par-hole
                          @elseif ($score->hole_4 == 5)
                            bogey-hole
                          @elseif ($score->hole_4 >= 6)
                            double-hole
                          @endif
                          ">
                          {{ $score->hole_4 ? number_format($score->hole_4, 0, '.', ',') : '' }}
                        </td>

                        <td class="text-center
                          @if ($score->hole_5 >= 1 and $score->hole_5 <= 3)
                            eagle-hole
                          @elseif ($score->hole_5 == 4)
                            birdie-hole
                          @elseif ($score->hole_5 == 5)
                            par-hole
                          @elseif ($score->hole_5 == 6)
                            bogey-hole
                          @elseif ($score->hole_5 >= 7)
                            double-hole
                          @endif
                          ">
                          {{ $score->hole_5 ? number_format($score->hole_5, 0, '.', ',') : '' }}
                        </td>

                        <td class="text-center
                           @if ($score->hole_6 == 1)
                             eagle-hole
                           @elseif ($score->hole_6 == 2)
                             birdie-hole
                           @elseif ($score->hole_6 == 3)
                             par-hole
                           @elseif ($score->hole_6 == 4)
                             bogey-hole
                           @elseif ($score->hole_6 >= 5)
                             double-hole
                           @endif
                           ">
                           {{ $score->hole_6 ? number_format($score->hole_6, 0, '.', ',') : '' }}
                         </td>

                         <td class="text-center
                           @if ($score->hole_7 >= 1 and $score->hole_7 <= 3)
                             eagle-hole
                           @elseif ($score->hole_7 == 4)
                             birdie-hole
                           @elseif ($score->hole_7 == 5)
                             par-hole
                           @elseif ($score->hole_7 == 6)
                             bogey-hole
                           @elseif ($score->hole_7 >= 7)
                             double-hole
                           @endif
                           ">
                           {{ $score->hole_7 ? number_format($score->hole_7, 0, '.', ',') : '' }}
                         </td>

                        <td class="text-center
                          @if ($score->hole_8 >= 1 and $score->hole_8 <=2)
                            eagle-hole
                          @elseif ($score->hole_8 == 3)
                            birdie-hole
                          @elseif ($score->hole_8 == 4)
                            par-hole
                          @elseif ($score->hole_8 == 5)
                            bogey-hole
                          @elseif ($score->hole_8 >= 6)
                            double-hole
                          @endif
                          ">
                          {{ $score->hole_8 ? number_format($score->hole_8, 0, '.', ',') : '' }}
                        </td>

                        <td class="text-center
                          @if ($score->hole_9 >= 1 and $score->hole_9 <= 3)
                            eagle-hole
                          @elseif ($score->hole_9 == 4)
                            birdie-hole
                          @elseif ($score->hole_9 == 5)
                            par-hole
                          @elseif ($score->hole_9 == 6)
                            bogey-hole
                          @elseif ($score->hole_9 >= 7)
                            double-hole
                          @endif
                          ">
                          {{ $score->hole_9 ? number_format($score->hole_9, 0, '.', ',') : '' }}
                        </td>

                        <td class="text-center">
                            <strong><span class="">
                                {{ $score->gross ? number_format($score->gross, 0, '.', ',') : '' }}
                            </span><strong>
                        </td>
                        <td class="text-center">
                            <strong><span class="">
                                {{ $score->gross_par ? number_format($score->gross_par, 0, '.', ',') : '' }}
                            </span><strong>
                        </td>
                        <td class="text-center">
                            <strong><span class="">
                                {{ $score->net ? number_format($score->net, 0, '.', ',') : '' }}
                            </span><strong>
                        </td>
                        <td class="text-center">
                            <strong><span class="">
                                {{ $score->net_par ? number_format($score->net_par, 0, '.', ',') : '' }}
                            </span><strong>
                        </td>
                        <td class="text-center font-bold">
                          <span class="
                          @if ($score->points == 2)
                              text-green
                            @elseif ($score->points === 0)
                              text-red
                            @else
                              text-grey-800
                            @endif">
                          {{ $score->points }}</span>
                        </td>
                        <td class="text-center">{{ $score->eagle}}</td>
                        <td class="text-center">{{ $score->birdie}}</td>
                        <td class="text-center">{{ $score->par}}</td>
                        <td class="text-center">{{ $score->bogey}}</td>
                        <td class="text-center">{{ $score->double_bogey }}</td>
                      </tr>
                @endforeach
            </table>
        </div>
        </div>
    </div>

@endsection
