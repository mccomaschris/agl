<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaitlistSeeder extends Seeder
{
    public function run()
    {
        DB::table('waitlist')->insert([
  0 => 
  [
    'id' => 1,
    'active' => 0,
    'user_id' => 12,
    'name' => 'Tom Allen',
    'projected_hc' => '9',
    'created_at' => '2017-05-12 13:11:33',
    'updated_at' => '2017-05-12 13:11:33',
  ],
  1 => 
  [
    'id' => 2,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Todd Webb',
    'projected_hc' => '2',
    'created_at' => '2017-05-01 08:00:00',
    'updated_at' => '2017-05-01 08:00:00',
  ],
  2 => 
  [
    'id' => 3,
    'active' => 0,
    'user_id' => 3,
    'name' => 'jay Gressner',
    'projected_hc' => '8',
    'created_at' => '2017-08-15 14:45:08',
    'updated_at' => '2017-08-15 14:45:08',
  ],
  3 => 
  [
    'id' => 4,
    'active' => 0,
    'user_id' => 3,
    'name' => 'Joe Priest',
    'projected_hc' => '7',
    'created_at' => '2017-08-25 08:39:46',
    'updated_at' => '2017-08-25 08:39:46',
  ],
  4 => 
  [
    'id' => 5,
    'active' => 0,
    'user_id' => 3,
    'name' => 'Tyler Barker',
    'projected_hc' => '7',
    'created_at' => '2017-11-07 10:56:28',
    'updated_at' => '2017-11-07 10:56:28',
  ],
  5 => 
  [
    'id' => 6,
    'active' => 1,
    'user_id' => 4,
    'name' => 'Sean Adkins',
    'projected_hc' => '5',
    'created_at' => '2018-07-12 11:46:59',
    'updated_at' => '2018-07-12 11:46:59',
  ],
  6 => 
  [
    'id' => 7,
    'active' => 0,
    'user_id' => 6,
    'name' => 'Dirk McFaddin',
    'projected_hc' => '2',
    'created_at' => '2018-09-19 14:55:09',
    'updated_at' => '2018-09-19 14:55:09',
  ],
  7 => 
  [
    'id' => 8,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Bob Hamlin',
    'projected_hc' => '10',
    'created_at' => '2019-06-14 07:54:32',
    'updated_at' => '2019-06-14 07:54:32',
  ],
  8 => 
  [
    'id' => 9,
    'active' => 0,
    'user_id' => 20,
    'name' => 'Jason Isaacs',
    'projected_hc' => '13',
    'created_at' => '2019-08-19 23:08:17',
    'updated_at' => '2019-08-19 23:08:17',
  ],
  9 => 
  [
    'id' => 10,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Robbie Keyser',
    'projected_hc' => '10',
    'created_at' => '2019-06-12 07:54:32',
    'updated_at' => '2019-06-12 07:54:32',
  ],
  10 => 
  [
    'id' => 11,
    'active' => 0,
    'user_id' => 44,
    'name' => 'Bruce Prater',
    'projected_hc' => '5',
    'created_at' => '2020-02-18 08:19:54',
    'updated_at' => '2020-02-18 08:19:54',
  ],
  11 => 
  [
    'id' => 12,
    'active' => 0,
    'user_id' => 4,
    'name' => 'Sean Adkins',
    'projected_hc' => '10',
    'created_at' => '2020-01-02 10:34:38',
    'updated_at' => '2020-03-02 10:34:38',
  ],
  12 => 
  [
    'id' => 13,
    'active' => 0,
    'user_id' => 6,
    'name' => 'John Bledsoe',
    'projected_hc' => '2',
    'created_at' => '2020-07-29 15:34:02',
    'updated_at' => '2020-07-29 15:34:02',
  ],
  13 => 
  [
    'id' => 14,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Bruce Prater',
    'projected_hc' => '5',
    'created_at' => '2020-09-28 09:29:03',
    'updated_at' => '2020-09-28 09:29:03',
  ],
  14 => 
  [
    'id' => 15,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Roger Mills',
    'projected_hc' => '11',
    'created_at' => '2020-09-28 09:29:27',
    'updated_at' => '2020-09-28 09:29:27',
  ],
  15 => 
  [
    'id' => 16,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Phil Dumont',
    'projected_hc' => '20',
    'created_at' => '2020-09-27 09:30:18',
    'updated_at' => '2020-09-28 09:30:18',
  ],
  16 => 
  [
    'id' => 17,
    'active' => 0,
    'user_id' => 6,
    'name' => 'Marc Rutherford',
    'projected_hc' => '5',
    'created_at' => '2022-01-19 19:46:23',
    'updated_at' => '2022-01-19 19:46:23',
  ],
  17 => 
  [
    'id' => 18,
    'active' => 1,
    'user_id' => 2,
    'name' => 'Brandon Scott',
    'projected_hc' => '5',
    'created_at' => '2021-05-02 09:06:49',
    'updated_at' => '2022-05-02 09:06:49',
  ],
  18 => 
  [
    'id' => 19,
    'active' => 1,
    'user_id' => 5,
    'name' => 'Casey Rowe',
    'projected_hc' => '15',
    'created_at' => '2022-05-03 09:06:49',
    'updated_at' => '2022-05-03 09:06:49',
  ],
  19 => 
  [
    'id' => 20,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Justin Adkins',
    'projected_hc' => '12',
    'created_at' => '2022-05-02 09:06:49',
    'updated_at' => '2022-05-02 09:06:49',
  ],
  20 => 
  [
    'id' => 21,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Brent Patton',
    'projected_hc' => '3',
    'created_at' => '2022-08-12 09:10:14',
    'updated_at' => '2022-08-12 09:10:14',
  ],
  21 => 
  [
    'id' => 22,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Tres Baumgarner',
    'projected_hc' => '17',
    'created_at' => '2019-05-01 08:00:00',
    'updated_at' => '2019-05-01 08:00:00',
  ],
  22 => 
  [
    'id' => 23,
    'active' => 0,
    'user_id' => 2,
    'name' => 'Brett Barber',
    'projected_hc' => '3',
    'created_at' => '2022-12-07 15:21:55',
    'updated_at' => '2022-12-07 15:21:55',
  ],
  23 => 
  [
    'id' => 24,
    'active' => 0,
    'user_id' => 5,
    'name' => 'Randy Kirk',
    'projected_hc' => '7',
    'created_at' => '2023-12-04 08:18:57',
    'updated_at' => '2023-12-04 08:18:57',
  ],
  24 => 
  [
    'id' => 25,
    'active' => 1,
    'user_id' => 5,
    'name' => 'Randy Keeney',
    'projected_hc' => '5',
    'created_at' => '2023-12-04 08:19:26',
    'updated_at' => '2023-12-04 08:19:26',
  ],
  25 => 
  [
    'id' => 26,
    'active' => 1,
    'user_id' => 2,
    'name' => 'Anthony Dishman',
    'projected_hc' => '8',
    'created_at' => '2024-01-29 17:46:12',
    'updated_at' => '2024-01-29 17:46:12',
  ],
  26 => 
  [
    'id' => 27,
    'active' => 1,
    'user_id' => 2,
    'name' => 'Jeromy Dishman',
    'projected_hc' => '12',
    'created_at' => '2024-01-29 17:46:23',
    'updated_at' => '2024-01-29 17:46:23',
  ],
  27 => 
  [
    'id' => 28,
    'active' => 1,
    'user_id' => 10,
    'name' => 'Lew Baumgarner',
    'projected_hc' => '12',
    'created_at' => '2022-01-21 19:46:23',
    'updated_at' => '2022-01-21 19:46:23',
  ],
]);
    }
}