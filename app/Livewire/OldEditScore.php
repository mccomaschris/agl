<?php

namespace App\Livewire;
use Flux;
use App\Jobs\UpdateHandicaps;
use App\Jobs\UpdatePlayerStats;
use App\Jobs\UpdateRecordVsOpponents;
use App\Jobs\UpdateRoundStats;
use App\Models\Player;
use App\Models\Score;
use App\Models\Year;
use Flux\Flux as FluxFlux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OldEditScore extends Component
{
    public $scoreId;

    public $gross = 0;

    public Score $score;

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

    public function mount($scoreId): void
    {
        $this->score = Score::find($scoreId);

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

    public function countGross(): void
    {
        $this->gross = $this->hole_1 + $this->hole_2 + $this->hole_3 + $this->hole_4 + $this->hole_5 + $this->hole_6 + $this->hole_7 + $this->hole_8 + $this->hole_9;
    }

	public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'hole_')) {
            $this->calculateGross();
        }
    }

	public function calculateGross()
    {
        $this->gross = $this->hole_1 + $this->hole_2 + $this->hole_3 + $this->hole_4 +
                       $this->hole_5 + $this->hole_6 + $this->hole_7 + $this->hole_8 +
                       $this->hole_9;
    }

    public function formatScore($score): string
    {
        return number_format($score, 0);
    }

    public function save(): void
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
            new UpdateRecordVsOpponents($year),
        ])->dispatch($this->score);

		Flux::toast(
			heading: 'Score updated.',
			text: $player->user->name . ' score has been updated.',
			variant: 'success',
		);
	}

    public function render()
    {
        return view('livewire.edit-score');
    }
}
