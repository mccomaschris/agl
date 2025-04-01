<?php

namespace Database\Factories;

use App\Models\Week;
use App\Models\Year;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeekFactory extends Factory
{
    protected $model = Week::class;

    public function definition()
    {
        return [
            'year_id' => Year::where('active', true)->first() ?? Year::factory(), // Assign to active Year
            'week_order' => $this->faker->unique()->numberBetween(1, 20), // Week number 1-20
            'week_date' => now()->subWeeks($this->faker->numberBetween(1, 10))->toDateString(), // Past weeks only
            'side_games' => $this->faker->randomElement(['Net', 'Pin']), // Either "Net" or "Pin"
            'a_first_id' => Team::inRandomOrder()->first()->id ?? Team::factory(),
            'a_second_id' => Team::inRandomOrder()->first()->id ?? Team::factory(),
            'b_first_id' => Team::inRandomOrder()->first()->id ?? Team::factory(),
            'b_second_id' => Team::inRandomOrder()->first()->id ?? Team::factory(),
            'c_first_id' => Team::inRandomOrder()->first()->id ?? Team::factory(),
            'c_second_id' => Team::inRandomOrder()->first()->id ?? Team::factory(),
            'score_file' => null, // Can be set later if needed
            'ignore_scores' => false, // Default to not ignoring scores
            'back_nine' => false, // Randomly assign front or back 9
        ];
    }
}
