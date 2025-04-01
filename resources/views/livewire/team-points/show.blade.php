<?php

use Illuminate\View\View;
use Livewire\Volt\Component;
use App\Models\Team;
use App\Models\Year;

new class extends Component {
	public Year $year;

	public function rendering(View $view)
    {
        $view->title($this->year->name . ' Team Points');
    }

    public function with(): array
    {
		return [
            'years' => Year::orderBy('name', 'desc')->get(),
			'teams' => Team::where('year_id', $this->year->id)
						->with('players', 'players.user')
						->with(['players.scores' => function ($query) {
							$query->where('score_type', 'weekly_score');
							}])
						->get()
        ];
    }
}; ?>

<div>
	<div class="flex flex-col lg:flex-row lg:justify-between mt-12 mb-10 items-center">
		<flux:heading size="xl">{{ $year->name }} Team Points</flux:heading>
		<flux:dropdown position="bottom" align="end">
			<flux:button icon-trailing="chevron-down">More Years Team Points</flux:button>

			<flux:navmenu>
				@foreach ($years as $item)
					<flux:navmenu.item href="{{ route('team-points', [$item]) }}" wire:navigate class="{{ $item->id === $year->id ? 'text-green-700! bg-zinc-50!' : '' }}">{{ $item->name }} Team Points</flux:navmenu.item>
				@endforeach
			</flux:navmenu>
		</flux:dropdown>
	</div>

	<x-sub-note />

	@foreach ($teams as $team)
		<div class="mb-12 last:mb-0">
			<flux:heading size="lg" class="mb-1" id="{{ $team->id }}">Team {{ $team->name }}</flux:heading>

			<x-table>
				<x-table.thead>
					<x-table.tr>
						<x-table.th>Player</x-table.th>
						<x-table.th>1</x-table.th>
						<x-table.th>2</x-table.th>
						<x-table.th>3</x-table.th>
						<x-table.th>4</x-table.th>
						<x-table.th>5</x-table.th>
						<x-table.th>6</x-table.th>
						<x-table.th>7</x-table.th>
						<x-table.th>8</x-table.th>
						<x-table.th>9</x-table.th>
						<x-table.th>10</x-table.th>
						<x-table.th>11</x-table.th>
						<x-table.th>12</x-table.th>
						<x-table.th>13</x-table.th>
						<x-table.th>14</x-table.th>
						<x-table.th>15</x-table.th>
						<x-table.th>16</x-table.th>
						<x-table.th>17</x-table.th>
						<x-table.th>18</x-table.th>
						<x-table.th>19</x-table.th>
						<x-table.th>20</x-table.th>
						<x-table.th>Total</x-table.th>
						<x-table.th>W%</x-table.th>
						<x-table.th>Won</x-table.th>
						<x-table.th>Lost</x-table.th>
						<x-table.th>Tied</x-table.th>
						<x-table.th>W Rk</x-table.th>
					</x-table.tr>
				</x-table.thead>
				<x-table.tbody>
					@foreach ($team->players as $player)
						<x-table.tr-body>
							<x-table.td><a class="font-semibold underline hover:no-underline" href="{{ route('player-score', ['player' => $player->id]) }}">{{ $player->user->name }}</a></x-table.td>
							@foreach ($player->scores as $score)
								@if ($score->absent)
									<x-table.td class="bg-zinc-900! text-white! font-bold text-center">A</x-table.td>
								@elseif ($score->injury)
									<x-table.td class="bg-zinc-900! text-white! font-bold text-center">I</x-table.td>
								@else
									<x-table.td>{{ $score->points }} @if($score->substitute_id > 0)<span class="font-bold">(S)</span>@endif</x-table.td>
								@endif
							@endforeach

							<x-table.td>{{ $player->points }}</x-table.td>
							<x-table.td>{{ number_format($player->win_pct, 3, '.', ',') }}</x-table.td>
							<x-table.td>{{ $player->won }}</x-table.td>
							<x-table.td>{{ $player->lost }}</x-table.td>
							<x-table.td>{{ $player->tied }}</x-table.td>
							<x-table.td>{{ $player->wins_rank }}</x-table.td>
						</x-table.tr-body>
					@endforeach
					<x-table.tr-body>
						<x-table.td colspan="21" class="font-bold text-zinc-900! text-right!">Team Total</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100!">{{ $team->points }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100!"></x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100!">{{ $team->won }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100!">{{ $team->lost }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900! bg-zinc-100!">{{ $team->tied }}</x-table.td>
						<x-table.td class="font-bold text-zinc-900!"></x-table.td>
					</x-table.tr-body>
				</x-table.tbody>
			</x-table>
		</div>
	@endforeach
</div>
