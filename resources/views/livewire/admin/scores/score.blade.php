<?php

use Livewire\Attributes\{Layout, Title, Validate};
use App\Jobs\UpdateHandicaps;
use App\Jobs\UpdatePlayerStats;
use App\Jobs\UpdateRoundStats;
use Livewire\Volt\Component;
use App\Models\Player;
use App\Models\Score;
use App\Models\Year;
use Carbon\Carbon;

new class extends Component {
	public $scoreId;
	public $isOdd;

	public Score $score;
	public $gross;

	#[Validate('integer|nullable')]
    public $absent;

    #[Validate('integer|nullable')]
    public $weekly_winner;

    #[Validate('integer|nullable')]
    public $substitute_id;

    #[Validate('integer|nullable')]
    public $hole_1;

    #[Validate('integer|nullable')]
    public $hole_2;

    #[Validate('integer|nullable')]
    public $hole_3;

    #[Validate('integer|nullable')]
    public $hole_4;

    #[Validate('integer|nullable')]
    public $hole_5;

    #[Validate('integer|nullable')]
    public $hole_6;

    #[Validate('integer|nullable')]
    public $hole_7;

    #[Validate('integer|nullable')]
    public $hole_8;

    #[Validate('integer|nullable')]
    public $hole_9;

    #[Validate('integer|nullable')]
    public $points;

    public function mount($scoreId, $isOdd)
    {
        $this->score = Score::find($scoreId);
		$this->isOdd = $isOdd;

		$this->absent = (bool) $this->score->absent;
        $this->weekly_winner = (bool) $this->score->weekly_winner;
        $this->substitute_id = (bool) $this->score->substitute_id;
        $this->hole_1 = intval($this->score->hole_1);
        $this->hole_2 = intval($this->score->hole_2);
        $this->hole_3 = intval($this->score->hole_3);
        $this->hole_4 = intval($this->score->hole_4);
        $this->hole_5 = intval($this->score->hole_5);
        $this->hole_6 = intval($this->score->hole_6);
        $this->hole_7 = intval($this->score->hole_7);
        $this->hole_8 = intval($this->score->hole_8);
        $this->hole_9 = intval($this->score->hole_9);
        $this->points = intval($this->score->points);

        $this->calculateGross();
    }

	public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'hole_')) {
            $this->calculateGross();
        }
    }

	public function calculateGross()
	{
		$this->gross =
			(int) $this->hole_1 +
			(int) $this->hole_2 +
			(int) $this->hole_3 +
			(int) $this->hole_4 +
			(int) $this->hole_5 +
			(int) $this->hole_6 +
			(int) $this->hole_7 +
			(int) $this->hole_8 +
			(int) $this->hole_9;
	}

	public function save()
    {
        $this->score->hole_1 = $this->hole_1;
        $this->score->hole_2 = $this->hole_2;
        $this->score->hole_3 = $this->hole_3;
        $this->score->hole_4 = $this->hole_4;
        $this->score->hole_5 = $this->hole_5;
        $this->score->hole_6 = $this->hole_6;
        $this->score->hole_7 = $this->hole_7;
        $this->score->hole_8 = $this->hole_8;
        $this->score->hole_9 = $this->hole_9;
        $this->score->points = $this->points;
        $this->score->weekly_winner = $this->weekly_winner;
        $this->score->absent = $this->absent;
        $this->score->substitute_id = $this->substitute_id;

        $this->score->save();

        $player = Player::find($this->score->player_id);
        $year = Year::find($player->year_id);

        UpdateRoundStats::withChain([
            new UpdatePlayerStats($this->score->player),
            new UpdateHandicaps($this->score->player),
        ])->dispatch($this->score);

		Flux::toast(
			heading: 'Score updated.',
			text: $player->user->name . ' score has been updated.',
			variant: 'success',
		);
	}
	public function with(): array
    {
        return [
			'score' => $this->score,
			'gross' => $this->gross,
			'hole_1' => $this->hole_1,
			'hole_2' => $this->hole_2,
			'hole_3' => $this->hole_3,
			'hole_4' => $this->hole_4,
			'hole_5' => $this->hole_5,
			'hole_6' => $this->hole_6,
			'hole_7' => $this->hole_7,
			'hole_8' => $this->hole_8,
			'hole_9' => $this->hole_9,
			'points' => $this->points,
			'absent' => $this->absent,
			'weekly_winner' => $this->weekly_winner,
			'substitute_id' => $this->substitute_id,

        ];
    }
}; ?>

<x-table.tr-body class="{{ $isOdd ? '' : 'not-last:border-b-4! border-zinc-500' }}">
	<x-table.td id="{{ $score->id }}" class="text-sm! pl-2! text-left! whitespace-normal!">
		<a href="{{ route('player-score', ['player' => $score->player_id]) }}">{{ $score->player->user->name }}</a>
        @if ($score->substitute_id > 0) <span class="font-bold">(S)</span>@endif
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:checkbox class="mx-auto!" wire:model.live="absent" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:checkbox class="mx-auto!" wire:model="weekly_winner" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:checkbox class="mx-auto!" wire:model="substitute_id" />
	</x-table.td>

    <x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_1" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_2" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_3" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_4" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_5" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_6" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_7" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_8" class="w-20!" onfocus="this.select()" />
	</x-table.td>
	<x-table.td class="text-sm!">
		<flux:input pattern="[0-9]*" inputmode="numeric" type="number" :disabled="$absent" wire:model.live="hole_9" class="w-20!" onfocus="this.select()" />
	</x-table.td>
    <x-table.td class="text-sm!">{{ number_format($gross, 0) }}</x-table.td>
    <x-table.td class="text-sm!">
		<flux:select wire:model="points" wire:blur="save">
			<flux:select.option value=""></flux:select.option>
			<flux:select.option value="0">0</flux:select.option>
			<flux:select.option value="1">1</flux:select.option>
			<flux:select.option value="2">2</flux:select.option>
		</flux:select>
    </x-table.td>

    <x-table.td class="text-sm!">
		<flux:button wire:click="save" icon="check-circle" />
    </x-table.td>
</x-table.tr-body>
