<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearsSeeder extends Seeder
{
    public function run()
    {
        DB::table('years')->insert([
  0 => 
  [
    'id' => 1,
    'name' => '2017',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2017-04-04 14:33:55',
    'updated_at' => '2017-04-04 14:33:55',
  ],
  1 => 
  [
    'id' => 2,
    'name' => '2018',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2018-03-13 15:09:25',
    'updated_at' => '2019-02-25 14:12:50',
  ],
  2 => 
  [
    'id' => 3,
    'name' => '2019',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2019-02-25 14:12:50',
    'updated_at' => '2020-03-03 07:59:39',
  ],
  3 => 
  [
    'id' => 5,
    'name' => '2016',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2019-04-16 08:11:58',
    'updated_at' => '2019-04-16 08:11:58',
  ],
  4 => 
  [
    'id' => 6,
    'name' => '2015',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2019-04-16 11:04:37',
    'updated_at' => '2019-04-16 11:04:37',
  ],
  5 => 
  [
    'id' => 7,
    'name' => '2014',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2019-04-16 14:19:27',
    'updated_at' => '2019-04-16 14:19:27',
  ],
  6 => 
  [
    'id' => 8,
    'name' => '2020',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2020-03-03 07:59:39',
    'updated_at' => '2021-03-02 02:58:28',
  ],
  7 => 
  [
    'id' => 9,
    'name' => '2021',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2021-03-02 02:58:28',
    'updated_at' => '2022-03-01 10:13:24',
  ],
  8 => 
  [
    'id' => 10,
    'name' => '2022',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2022-03-01 10:13:24',
    'updated_at' => '2023-03-01 07:41:50',
  ],
  9 => 
  [
    'id' => 11,
    'name' => '2023',
    'active' => 0,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2023-03-01 07:41:50',
    'updated_at' => '2024-03-05 08:48:53',
  ],
  10 => 
  [
    'id' => 12,
    'name' => '2024',
    'active' => 1,
    'skip_date' => NULL,
    'start_date' => NULL,
    'created_at' => '2024-03-05 08:48:53',
    'updated_at' => '2024-03-05 08:48:53',
  ],
]);
    }
}