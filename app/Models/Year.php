<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Year extends Model
{
	use HasFactory;

    protected $fillable = ['name', 'active', 'start_date', 'skip_date'];

	protected static function boot()
    {
        parent::boot();

        static::saving(function ($year) {
            if ($year->active) {
                // Set all other years to inactive
                Year::where('id', '!=', $year->id)->update(['active' => 0]);
            }
        });
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class)->with('players');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class)->orderBy('team_id', 'asc')->orderBy('position', 'asc');
    }

    public function weeks(): HasMany
    {
        return $this->hasMany(Week::class)->orderBy('week_date', 'asc');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function weeks_desc(): HasMany
    {
        return $this->hasMany(Week::class)->orderBy('week_date', 'desc');
    }

    public function teamStandings(): HasMany
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
			->orderBy('won', 'desc')
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
    public function getRouteKeyName(): string
    {
        return 'name';
    }
}
