<?php

namespace Database\Factories;

use App\Models\Score;
use App\Models\Player;
use App\Models\Week;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    protected $model = Score::class;

    public function definition()
    {
        return [
            'score_type' => 'weekly_score', // Default to weekly scores
            'foreign_key' => Week::inRandomOrder()->first()->id ?? Week::factory(), // Links to a valid Week
            'player_id' => Player::factory(), // Assign a valid Player
            'absent' => false, // Default to not absent
            'hole_1' => $this->faker->numberBetween(3, 6),
            'hole_2' => $this->faker->numberBetween(3, 6),
            'hole_3' => $this->faker->numberBetween(3, 6),
            'hole_4' => $this->faker->numberBetween(3, 6),
            'hole_5' => $this->faker->numberBetween(3, 6),
            'hole_6' => $this->faker->numberBetween(3, 6),
            'hole_7' => $this->faker->numberBetween(3, 6),
            'hole_8' => $this->faker->numberBetween(3, 6),
            'hole_9' => $this->faker->numberBetween(3, 6),
            'points' => $this->faker->numberBetween(0, 10),
            'gross' => function (array $attributes) {
                return array_sum([
                    $attributes['hole_1'],
                    $attributes['hole_2'],
                    $attributes['hole_3'],
                    $attributes['hole_4'],
                    $attributes['hole_5'],
                    $attributes['hole_6'],
                    $attributes['hole_7'],
                    $attributes['hole_8'],
                    $attributes['hole_9'],
                ]);
            }, // Gross is sum of holes
            'gross_par' => $this->faker->randomFloat(2, 0, 10), // Example values
            'net' => $this->faker->randomFloat(2, 30, 45),
            'net_par' => $this->faker->randomFloat(2, 0, 10),
            'eagle' => $this->faker->numberBetween(0, 2),
            'birdie' => $this->faker->numberBetween(0, 5),
            'par' => $this->faker->numberBetween(0, 9),
            'bogey' => $this->faker->numberBetween(0, 9),
            'double_bogey' => $this->faker->numberBetween(0, 3),
            'current_average' => 0.000000,
            'injury' => false,
            'substitute_id' => 0,
            'weekly_winner' => false,
            'official' => true,
        ];
    }
}
