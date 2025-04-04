<?php

use Illuminate\View\View;
use Livewire\Volt\Component;
use App\Models\Score;
use App\Models\Player;
use App\Models\Year;
use App\Models\Week;
use App\Models\Note;
use Illuminate\Support\Facades\DB;

new class extends Component {
	public Player $player;

	public $totalScores;
    public $handicapCount;
    public $handicapScores;

	public function rendering(View $view)
    {
        $view->title($this->player->user->name . ' ' . $this->player->year->name . ' Scores');
    }

	public function mount(Player $player)
	{
		$this->player = $player;
        $this->calculateHandicapScores();
	}

	public function calculateHandicapScores()
    {
        // Get all valid scores
        $scores = $this->player->scores
            ->where('gross', '>', 0)
            ->where('score_type', 'weekly_score')
            ->sortBy('gross'); // Sort by lowest score (best scores)

        $this->totalScores = $scores->count();
        $this->handicapCount = ceil($this->totalScores / 2); // Round up
        $this->handicapScores = $scores->take($this->handicapCount);
    }

	private function baseQuery()
    {
        return Score::selectRaw("
            player_id,
            ROUND(AVG(gross), 1) AS avg_gross,
            ROUND(AVG(gross_par), 1) AS avg_gross_par,
            ROUND(AVG(net), 1) AS avg_net,
            ROUND(AVG(net_par), 1) AS avg_net_par,
            SUM(points) AS total_points,
            SUM(birdie) AS total_birdies,
            SUM(eagle) AS total_eagles,
            SUM(par) AS total_pars,
            SUM(bogey) AS total_bogeys,
            SUM(double_bogey) AS total_double_bogeys,
            AVG(hole_1) AS hole_1,
            AVG(hole_2) AS hole_2,
            AVG(hole_3) AS hole_3,
            AVG(hole_4) AS hole_4,
            AVG(hole_5) AS hole_5,
            AVG(hole_6) AS hole_6,
            AVG(hole_7) AS hole_7,
            AVG(hole_8) AS hole_8,
            AVG(hole_9) AS hole_9
        ")
        ->join('weeks', 'scores.foreign_key', '=', 'weeks.id')
        ->where('scores.player_id', $this->player->id)
        ->where('scores.score_type', 'weekly_score');
    }

    private function fetchQuarterAverages()
    {
        return $this->baseQuery()
            ->selectRaw("
                CASE
                    WHEN weeks.week_order BETWEEN 1 AND 5 THEN 'qtr_1'
                    WHEN weeks.week_order BETWEEN 6 AND 10 THEN 'qtr_2'
                    WHEN weeks.week_order BETWEEN 11 AND 15 THEN 'qtr_3'
                    WHEN weeks.week_order BETWEEN 16 AND 20 THEN 'qtr_4'
                END AS quarter
            ")
			->where('scores.absent', false)
			->where('scores.injury', false)
			->where(function ($query) {
				$query->where('weeks.back_nine', false)->orWhereNull('weeks.back_nine');
			})
			->where(function ($query) {
				$query->whereNull('scores.substitute_id')->orWhere('scores.substitute_id', 0);
			})
            ->groupBy('quarter', 'scores.player_id')
            ->get()
            ->keyBy('quarter');
    }

    private function fetchAllAverages()
    {
        return $this->baseQuery()
			->where('scores.absent', false)
			->where('scores.injury', false)
			->where(function ($query) {
				$query->where('weeks.back_nine', false)->orWhereNull('weeks.back_nine');
			})
			->where(function ($query) {
				$query->whereNull('scores.substitute_id')->orWhere('scores.substitute_id', 0);
			})
            ->selectRaw("'all' AS quarter")
            ->groupBy('player_id')
            ->first() ?? (object) [
                'avg_gross' => null, 'avg_gross_par' => null, 'avg_net' => null, 'avg_net_par' => null,
                'total_points' => null, 'total_birdies' => null, 'total_eagles' => null, 'total_pars' => null,
                'total_bogeys' => null, 'total_double_bogeys' => null,
                'hole_1' => null, 'hole_2' => null, 'hole_3' => null, 'hole_4' => null,
                'hole_5' => null, 'hole_6' => null, 'hole_7' => null, 'hole_8' => null, 'hole_9' => null
            ];
    }

    private function fetchScoresByQuarter()
    {
        return Score::select(
            'scores.player_id',
            'scores.foreign_key AS week_id',
            'weeks.week_order', 'weeks.back_nine',
			'scores.absent', 'scores.injury', 'scores.substitute_id',
            'scores.gross', 'scores.gross_par', 'scores.net', 'scores.net_par',
            'scores.points', 'scores.birdie', 'scores.eagle', 'scores.par',
            'scores.bogey', 'scores.double_bogey',
            'scores.hole_1', 'scores.hole_2', 'scores.hole_3', 'scores.hole_4',
            'scores.hole_5', 'scores.hole_6', 'scores.hole_7', 'scores.hole_8', 'scores.hole_9'
        )
        ->join('weeks', 'scores.foreign_key', '=', 'weeks.id')
        ->where('scores.player_id', $this->player->id)
        ->where('scores.score_type', 'weekly_score')
        ->orderBy('weeks.week_order')
        ->get()
        ->groupBy(function ($score) {
            if ($score->week_order <= 5) return 'qtr_1';
            if ($score->week_order <= 10) return 'qtr_2';
            if ($score->week_order <= 15) return 'qtr_3';
            return 'qtr_4';
        });
    }

    public function with(): array
    {
        return [
            'scoresByQuarter' => $this->fetchScoresByQuarter(),
            'quarterAverages' => $this->fetchQuarterAverages(),
            'allAverages' => $this->fetchAllAverages(),
            'prev_seasons' => $this->player->previous_seasons(),
            'notes' => Note::where('player_id', $this->player->id)->where('active', 1)->get(),
            'weekly_wins' => Score::with('week')
                ->where('player_id', $this->player->id)
                ->where('weekly_winner', 1)
                ->orderBy('id', 'asc')
                ->get(),
        ];
    }
}; ?>

<div>
	<div class="flex flex-wrap gap-4 items-center justify-between my-12">
		<div>
			<flux:subheading size="lg">{{ $player->team->year->name }} Season</flux:subheading>
			<flux:heading size="xl">{{ $player->user->name }}</flux:heading>
		</div>

		<div class="gap-x-2">
			<flux:button href="/players/{{ $player->user->id }}">{{ $player->user->name }} Full History</flux:button>

			@if ($prev_seasons->count() > 1)
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
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_1, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_2, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_3, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_4, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_5, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_6, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_7, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_8, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->hole_9, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->avg_gross, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->avg_gross_par, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->avg_net, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ number_format($allAverages->avg_net_par, 1, '.', ',') }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ $allAverages->total_points ? $allAverages->total_points : '0' }}</x-table.td>
						<x-table.td class="font-bold text-yellow-800! bg-zinc-100! dark:bg-zinc-800! dark:text-yellow-200!">{{ $allAverages->total_eagles ? $allAverages->total_eagles : '0' }}</x-table.td>
						<x-table.td class="font-bold text-green-800! bg-zinc-100! dark:bg-zinc-800! dark:text-green-200!">{{ $allAverages->total_birdies ? $allAverages->total_birdies : '0' }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100! dark:text-zinc-50! dark:bg-zinc-800!">{{ $allAverages->total_pars ? $allAverages->total_pars : '0' }}</x-table.td>
						<x-table.td class="font-bold text-red-800! dark:text-red-200! bg-zinc-100! dark:bg-zinc-800!">{{ $allAverages->total_bogeys ? $allAverages->total_bogeys : '0' }}</x-table.td>
						<x-table.td class="font-bold text-blue-800! bg-zinc-100! dark:bg-zinc-800!">{{ $allAverages->total_double_bogeys ? $allAverages->total_double_bogeys : '0' }}</x-table.td>
					</x-table.tr-body>
				</x-table.tbody>
			</x-table>

			@foreach (['qtr_1', 'qtr_2', 'qtr_3', 'qtr_4'] as $quarter)
				@php
					// Define mappings for weeks and handicap based on the quarter
					$quarterDetails = [
						'qtr_1' => ['weeks' => 'Weeks 1-5', 'hc' => $player->hc_first],
						'qtr_2' => ['weeks' => 'Weeks 6-10', 'hc' => $player->hc_second],
						'qtr_3' => ['weeks' => 'Weeks 11-15', 'hc' => $player->hc_third],
						'qtr_4' => ['weeks' => 'Weeks 16-20', 'hc' => $player->hc_fourth],
					];
				@endphp

				<div class="mb-12 mt-12 last:mb-0">
					<div class="flex mb-1 items-center uppercase justify-between">
						<flux:heading size="lg">{{ $quarterDetails[$quarter]['weeks'] }}</flux:heading>

						<div class="flex items-center">
							<div class="text-zinc-500">HC</div>
							<div class="ml-1 text-green-500 font-bold text-xl border-b border-dotted border-zinc-500 dark:text-green-bright">
								{{ $quarterDetails[$quarter]['hc'] }}
							</div>
						</div>
					</div>

					<x-scorecard :scores="$scoresByQuarter[$quarter]" :averages="$quarterAverages[$quarter]" />
				</div>
			@endforeach

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

			@if ($weekly_wins->isNotEmpty())
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

			<div class="mb-6 mt-6">
				<div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
					<flux:subheading>Scores Counting Toward Handicap</flux:subheading>

                    <flux:heading size="xl" class="mb-6">{{ $handicapCount }}</flux:heading>

					<flux:subheading class="mt-6">Top Scores</flux:subheading>
					<flux:heading size="xl" class="mb-2">{{ $handicapScores->pluck('gross')->map(fn($score) => number_format($score, 0))->join(', ', ' and ') }}</flux:heading>
				</div>
			</div>
		</div>
	</div>
</div>
