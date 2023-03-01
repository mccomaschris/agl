@extends('layouts.default')

@section('page-heading')
  <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight leading-none mt-12 mb-6 lg:mb-0 lg:leading-none">{{ $user->name }} <br class="lg:hidden">League History</h1>
@endsection


@section('content')
    <div class="flex flex-wrap -mx-4 mt-6 mb-4">
        <div class="w-full lg:w-1/2 px-4">
            <div class="flex flex-col p-6 bg-grey-900 rounded ">
                <h3 class="font-semibold uppercase text-white text-base lg:text-lg">Career Averages</h3>
                <div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
                    <div class="w-1/2 lg:w-1/2 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Net</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ number_format($net_avg, 2, '.', ',') }}</span>
                    </div>
                    <div class="w-1/2 lg:w-1/2 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Gross</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ number_format($gross_avg, 2, '.', ',') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2 px-4 mt-4 lg:mt-0">
            <div class="flex flex-col p-6 bg-grey-900 rounded ">
                <h3 class="font-semibold uppercase text-white text-base lg:text-lg">Career Bests</h3>
                <div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
                    <div class="w-1/3 lg:w-1/3 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Rounds</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $total_scores }}</span>
                    </div>
                    <div class="w-1/3 lg:w-1/3 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Net</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ number_format($low_net, 0, '.', ',') }}</span>
                    </div>
                    <div class="w-1/3 lg:w-1/3 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Gross</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ number_format($low_gross, 0, '.', ',') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap -mx-4 mb-6">
        <div class="w-full px-4">
            <div class="flex flex-col p-6 bg-grey-900 rounded ">
                <h3 class="font-semibold uppercase text-white text-base lg:text-lg">Scoring</h3>
                <div class="flex flex-wrap items-center mt-2 lg:mt-4 ">
                    <div class="w-1/3 lg:w-1/6 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Holes</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $holes }}</span>
                    </div>
                    <div class="w-1/3 lg:w-1/6 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Eagle</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $eagle }} <span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($eagle / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="w-1/3 lg:w-1/6 flex flex-col text-green-bright">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Birdie</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $birdie }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($birdie / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="w-1/3 lg:w-1/6 flex flex-col text-green-bright mt-4 lg:mt-0">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Par</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $par }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($par / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="w-1/3 lg:w-1/6 flex flex-col text-green-bright mt-4 lg:mt-0">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">Bogey</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $bogey }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($bogey / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                    <div class="w-1/3 lg:w-1/6 flex flex-col text-green-bright mt-4 lg:mt-0">
                        <span class="block uppercase font-semibold tracking-tight text-grey-300">2 Bogey+</span>
                        <span class="block text-3xl lg:text-4xl font-bold">{{ $double_bogey }}<span class="text-xl font-normal text-gray-100 ml-2">({{ number_format(($double_bogey / $holes) * 100, 0, '.', ',') }}%)</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="flex flex-wrap -mx-4">
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

    <div class="flex flex-wrap -mx-4">
      <div class="w-full lg:w-3/4 px-4">
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
        <div class="w-full lg:w-1/4 px-4">
          @if(count($individual_championships))
          <h3 class="text-lg mt-2 mb-2 font-semibold">Individual Championships</h3>
          @foreach ($individual_championships as $item)
            <p>{{ $item->name }} Champion</p>
          @endforeach
          @endif

          @if(count($team_championships))
          <h3 class="text-lg mt-2 mb-2 font-semibold">Team Championships</h3>
          @foreach ($team_championships as $item)
            <p>{{ $item->year_name }} Champion Team {{ $item->team_name}}</p>
          @endforeach
          @endif

          @if(count($weekly_wins))
          <h3 class="text-lg mt-2 mb-2 font-semibold">Weekly Wins</h3>
          @foreach ($weekly_wins as $item)
            <p>{{ $item->name }} Week {{ $item->week_order }} - {{ $item->side_games }}</p>
          @endforeach
          @endif
        </div>
    </div>

@endsection
