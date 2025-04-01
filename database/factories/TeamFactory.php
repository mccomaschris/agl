<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Year;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([1, 2, 3, 4, 5, 6]), // Ensure team names are 1-6
			'year_id' => Year::factory(),
        ];
    }
}
