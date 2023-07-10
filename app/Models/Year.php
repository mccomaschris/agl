<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{

	protected $fillable = ['name', 'active', 'start_date', 'skip_date'];

	public function teams()
	{
		return $this->hasMany(Team::class)->with('players');
	}

	public function players()
	{
		return $this->hasMany(Player::class)->orderBy('team_id', 'asc')->orderBy('position', 'asc');
	}

	public function weeks()
	{
		return $this->hasMany(Week::class)->orderBy('week_date', 'asc');
	}

	public function scores()
	{
		return $this->hasMany(Score::class);
	}

	public function weeks_desc()
	{
		return $this->hasMany(Week::class)->orderBy('week_date', 'desc');
	}

	public function teamStandings()
	{
		return $this->hasMany(Team::class)
			->orderBy('points', 'desc')
			->orderBy('p1_points', 'desc')
			->orderBy('p2_points', 'desc')
			->orderBy('p3_points', 'desc')
			->orderBy('p4_points', 'desc');
	}

	public function playerStandings($take = null)
	{
		return Player::where('year_id', $this->id)
				->orderBy('points', 'desc')
				->take($take)
				->get();
	}

	public function handicaps($position)
	{
		return Player::where('year_id', $this->id)
					->where('position', $position)
					->orderBy('team_id', 'asc')
					->get();
	}

	/**
	* Get the route key for the model.
	*
	* @return string
	*/
	public function getRouteKeyName()
	{
		return 'name';
	}
}
