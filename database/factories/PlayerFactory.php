<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\User;
use App\Models\Year;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'year_id' => Year::where('active', true)->first() ?? Year::factory(),
            'team_id' => Team::inRandomOrder()->first()->id ?? Team::factory(), // Assign a random team
            'on_leave' => false,
            'substitute' => false,
            'position' => $this->faker->randomDigit(),
            'hc_current' => 0,
            'hc_first' => 0,
            'hc_second' => 0,
            'hc_third' => 0,
            'hc_fourth' => 0,
            'hc_playoff' => 0,
            'hc_next_year' => 0,
            'hc_18' => 0,
            'hc_full' => 0.00000,
            'hc_full_rank' => 0,
            'won' => 0,
            'lost' => 0,
            'tied' => 0,
            'win_pct' => 0.0000000,
            'points' => 0,
            'points_rank' => 0,
            'wins_rank' => 0,
            'gross_average' => 0.000000,
            'gross_par' => 0.000000,
            'net_average' => 0.000000,
            'net_par' => 0.000000,
            'low_gross' => 0,
            'high_gross' => 0,
            'low_net' => 0,
            'high_net' => 0,
            'position_net_rank' => 0,
            'overall_net_rank' => 0,
            'champion' => false,
            'tee_selection' => 'default',
            'make_ups' => 0,
        ];
    }
}
