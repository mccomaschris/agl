<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\Score;
use App\Models\Player;
use Livewire\Component;
use Livewire\Attributes\Computed;

class PlayerScore extends Component
{
	public Player $player;

	public function mount(Player $player)
	{
		$this->player = $player;
	}

	#[Computed]
	public function scores()
	{
		return Score::where('score_type', 'weekly_score')->where('player_id', $this->player->id)->countingscores()->get();
	}

	#[Computed]
	public function total_count()
	{
		return count($this->scores());
	}

	#[Computed]
	public function scores_count()
	{
		if ( $this->player->id === 159 ) {
            return 8;
        } else {
            return round($this->total_count / 2);
        }
	}

    public function render()
    {
        return view('livewire.player-score', [
			'qtr_1' => Score::where('score_type', 'weekly_score')->with('week')->where('player_id', $this->player->id)->quarter(1)->get(),
			'qtr_2' => Score::where('score_type', 'weekly_score')->with('week')->where('player_id', $this->player->id)->quarter(2)->get(),
			'qtr_3' => Score::where('score_type', 'weekly_score')->with('week')->where('player_id', $this->player->id)->quarter(3)->get(),
			'qtr_4' => Score::where('score_type', 'weekly_score')->with('week')->where('player_id', $this->player->id)->quarter(4)->get(),
			'prev_seasons' => $this->player->previous_seasons(),
			'notes' => Note::where('player_id', $this->player->id)->where('active', 1)->get(),
			'season_avg' => Score::where('score_type', 'season_avg')->where('player_id', $this->player->id)->first(),
			'qtr_1_avg' => Score::where('score_type', 'qtr_1_avg')->where('player_id', $this->player->id)->first(),
			'qtr_2_avg' => Score::where('score_type', 'qtr_2_avg')->where('player_id', $this->player->id)->first(),
			'qtr_3_avg' => Score::where('score_type', 'qtr_3_avg')->where('player_id', $this->player->id)->first(),
			'qtr_4_avg' => Score::where('score_type', 'qtr_4_avg')->where('player_id', $this->player->id)->first(),
			'weekly_wins' => Score::with('week')->where('player_id', $this->player->id)->where('weekly_winner', 1)->orderBy('id', 'asc')->get(),
			'counted' => Score::where('score_type', 'weekly_score')->where('player_id', $this->player->id)->countingscores()->orderBy('gross', 'asc')->take($this->scores_count)->pluck('gross'),
			'highest' => Score::where('score_type', 'weekly_score')->where('player_id', $this->player->id)->where('gross', '>', 0)->where('absent', 0)->where('substitute_id', 0)->orderBy('gross', 'asc')->skip($this->total_count($this->scores()) - 1)->take(1)->pluck('gross'),
		]);
    }
}
