<?php

namespace App\Http\Livewire;

use App\Jobs\UpdateHandicaps;
use App\Jobs\UpdatePlayerStats;
use App\Jobs\UpdateRecordVsOpponents;
use App\Jobs\UpdateRoundStats;
use App\Models\Player;
use App\Models\Score as Score;
use App\Models\Year;
use Livewire\Component;

class EditScore extends Component
{

    public $scoreId;
    public $score;
    public $gross = 0;

    public function mount( $scoreId)
    {
        $this->score = Score::find($scoreId);
        $this->gross = $this->score->gross;
    }

    public function countGross()
    {
        $this->gross = $this->score->hole_1 + $this->score->hole_2 + $this->score->hole_3 + $this->score->hole_4 + $this->score->hole_5 + $this->score->hole_6 + $this->score->hole_7 + $this->score->hole_8 + $this->score->hole_9;
    }

    protected $rules = [
        'score.hole_1' => 'integer|nullable',
        'score.hole_2' => 'integer|nullable',
        'score.hole_3' => 'integer|nullable',
        'score.hole_4' => 'integer|nullable',
        'score.hole_5' => 'integer|nullable',
        'score.hole_6' => 'integer|nullable',
        'score.hole_7' => 'integer|nullable',
        'score.hole_8' => 'integer|nullable',
        'score.hole_9' => 'integer|nullable',
        'score.points' => 'integer|nullable|between:0,2',
        'score.weekly_winner' => 'integer|nullable',
        'score.absent' => 'integer|nullable',
        'score.substitute_id' => 'integer|nullable',
    ];

    public function save()
    {
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
        return view('livewire.edit-score', [
            'score' => $this->score,
        ]);
    }
}
