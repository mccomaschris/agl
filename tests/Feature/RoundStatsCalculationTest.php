<?php

use App\Jobs\UpdateRoundStats;
use App\Models\Player;
use App\Models\Score;
use App\Models\Week;
use App\Models\Year;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('correctly calculates round statistics', function () {
    // Create a player with known handicaps
    $player = Player::factory()->create([
        'hc_first'  => 5,
        'hc_second' => 7,
        'hc_third'  => 8,
        'hc_fourth' => 10,
    ]);

    // Create a week in the first quarter
    $week = Week::factory()->create([
        'week_order' => 4, // Should use hc_first
        'back_nine'  => false,
    ]);

    // Create a score with predefined hole values
    $score = Score::factory()->create([
        'player_id'  => $player->id,
        'foreign_key' => $week->id,
        'hole_1' => 4, 'hole_2' => 2, 'hole_3' => 4,
        'hole_4' => 4, 'hole_5' => 5, 'hole_6' => 2,
        'hole_7' => 5, 'hole_8' => 7, 'hole_9' => 6, // Total: 39
    ]);

    // Run the job manually (since no queue)
    (new UpdateRoundStats($score))->handle();

    // Reload score from DB
    $score->refresh();

    // Assertions for gross and net scores
    expect($score->gross)->toBe(39);
    expect($score->net)->toBe(34); // gross (38) - hc_first (5)

    // Assertions for par differences
    expect($score->gross_par)->toBe(2); // gross - 37
    expect($score->net_par)->toBe(-3);  // net - 37

    // Assertions for categorized scores
    expect($score->eagle)->toBe(0);
    expect($score->birdie)->toBe(2);  // Hole 2, Hole 6
    expect($score->par)->toBe(5);     // Holes 1, 3, 4, 5, 7
    expect($score->bogey)->toBe(1);   // Hole 9
    expect($score->double_bogey)->toBe(1); // Hole 8 (7 on a par 4)
});
