<?php

namespace Database\Factories;

use App\Models\Year;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class YearFactory extends Factory
{
    protected $model = Year::class;

    public function definition()
    {
        return [
            'name' => $this->faker->year, // Example: "2025"
            'active' => !Year::where('active', true)->exists(), // Ensure only one year is active
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Year $year) {
            foreach (range(1, 6) as $teamNumber) {
                Team::create([
                    'year_id' => $year->id,
                    'name' => $teamNumber,
                    'points' => 0,
                    'won' => 0,
                    'lost' => 0,
                    'tied' => 0,
                    'rank' => 0,
                    'p1_points' => 0,
                    'p2_points' => 0,
                    'p3_points' => 0,
                    'p4_points' => 0,
                    'champions' => 0,
                ]);
            }
        });
    }
}
