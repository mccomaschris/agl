<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
			UsersSeeder::class,
			YearsSeeder::class,
			WeeksSeeder::class,
			WaitlistSeeder::class,
			TeamsSeeder::class,
			PlayersSeeder::class,
			PlayerRecordsSeeder::class,
			ScoresSeeder::class,
		]);
    }
}
