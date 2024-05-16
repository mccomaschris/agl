<?php

namespace App\Livewire;

use App\Jobs\UpdateHandicaps;
use App\Jobs\UpdatePlayerStats;
use App\Jobs\UpdateRecordVsOpponents;
use App\Jobs\UpdateRoundStats;
use App\Models\Player;
use App\Models\Score;
use App\Models\Year;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditScore extends Component
{
	public $scoreId;
    public $gross = 0;

    public Score $score;
	public $absent;
	public $weekly_winner;
	public $substitute_id;
	public $hole_1;
	public $hole_2;
	public $hole_3;
	public $hole_4;
	public $hole_5;
	public $hole_6;
	public $hole_7;
	public $hole_8;
	public $hole_9;
	public $points;

	public function mount($scoreId)
	{
		$this->score = Score::find($scoreId);

		$this->absent = $this->score->absent;
		$this->weekly_winner = $this->score->weekly_winner;
		$this->substitute_id = $this->score->substitute_id;
		$this->hole_1 = $this->score->hole_1;
		$this->hole_2 = $this->score->hole_2;
		$this->hole_3 = $this->score->hole_3;
		$this->hole_4 = $this->score->hole_4;
		$this->hole_5 = $this->score->hole_5;
		$this->hole_6 = $this->score->hole_6;
		$this->hole_7 = $this->score->hole_7;
		$this->hole_8 = $this->score->hole_8;
		$this->hole_9 = $this->score->hole_9;
		$this->points = $this->score->points;

		$this->countGross();
	}

    public function countGross()
    {
        $this->gross = $this->score->hole_1 + $this->score->hole_2 + $this->score->hole_3 + $this->score->hole_4 + $this->score->hole_5 + $this->score->hole_6 + $this->score->hole_7 + $this->score->hole_8 + $this->score->hole_9;
    }

    public function formatScore($score) {
        return number_format($score, 0);
    }

    public function save()
    {
		$validated = $this->validate([
            'hole_1' => 'integer|nullable',
			'hole_2' => 'integer|nullable',
			'hole_3' => 'integer|nullable',
			'hole_4' => 'integer|nullable',
			'hole_5' => 'integer|nullable',
			'hole_6' => 'integer|nullable',
			'hole_7' => 'integer|nullable',
			'hole_8' => 'integer|nullable',
			'hole_9' => 'integer|nullable',
			'points' => 'integer|nullable',
			'weekly_winner' => 'integer|nullable',
			'absent' => 'integer|nullable',
			'substitute_id' => 'integer|nullable',
        ]);

		$this->score->hole_1 = $validated['hole_1'];
		$this->score->hole_2 = $validated['hole_2'];
		$this->score->hole_3 = $validated['hole_3'];
		$this->score->hole_4 = $validated['hole_4'];
		$this->score->hole_5 = $validated['hole_5'];
		$this->score->hole_6 = $validated['hole_6'];
		$this->score->hole_7 = $validated['hole_7'];
		$this->score->hole_8 = $validated['hole_8'];
		$this->score->hole_9 = $validated['hole_9'];
		$this->score->points = $validated['points'];
		$this->score->weekly_winner = $validated['weekly_winner'];
		$this->score->absent = $validated['absent'];
		$this->score->substitute_id = $validated['substitute_id'];

        $this->score->save();

        $player = Player::find($this->score->player_id);
        $year = Year::find($player->year_id);

        UpdateRoundStats::withChain([
            new UpdatePlayerStats($this->score->player),
            new UpdateHandicaps($this->score->player),
            new UpdateRecordVsOpponents($year)
        ])->dispatch($this->score);
    }

    public function render()
    {
        return view('livewire.edit-score');
    }
}
