<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 6) as $teamNumber) {
            Team::firstOrCreate(['name' => $teamNumber]);
        }
    }
}
