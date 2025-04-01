<?php

use App\Jobs\UpdateHandicaps;
use App\Models\Player;
use App\Models\Score;
use App\Models\Week;
use App\Models\Year;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('calculates quarter 1 handicap correctly for a player with all rounds', function () {
    // Arrange
    $year = Year::factory()->create(['active' => true]);
    $player = Player::factory()->create(['year_id' => $year->id]);

    // Create Weeks 1-5
    $weeks = collect(range(1, 5))->map(fn ($weekOrder) =>
        Week::factory()->create([
            'year_id' => $year->id,
            'week_order' => $weekOrder,
            'week_date' => now()->subWeeks(10 - $weekOrder),
        ])
    );

	$savedWeeks = Week::all(); // Fetches all Score records in the test database
    dump($savedWeeks->toArray()); // See what is actually stored

    // Assign scores to the player for those **exact weeks**
    $scores = collect([40, 42, 38, 36, 39])->map(function ($score, $index) use ($player, $weeks) {
        return Score::factory()->create([
            'player_id' => $player->id,
            'foreign_key' => $weeks[$index]->id,
            'score_type' => 'weekly_score',
            'gross' => $score,
        ]);
    });

    // ✅ Fetch the actual saved scores from the database and dump them
    $savedScores = Score::all(); // Fetches all Score records in the test database
    dump($savedScores->toArray()); // See what is actually stored

    // Act
    (new UpdateHandicaps($player))->handle();

    // ✅ Fetch the updated player from the database and dump handicap info
    $updatedPlayer = Player::find($player->id);

    // Assert
    $bestScores = [36, 38, 39];
    $expectedHandicap = round((array_sum($bestScores) / count($bestScores)) - 37);

    expect($player->hc_second)->toEqual($expectedHandicap);
});

it('calculates quarter 1 handicap correctly for a player who missed a round', function () {
    // Arrange
    $year = Year::factory()->create(['active' => true]);
    $player = Player::factory()->create(['year_id' => $year->id]);

    // Create Weeks 1-5
    $weeks = collect(range(1, 4))->map(fn ($weekOrder) =>
        Week::factory()->create([
            'year_id' => $year->id,
            'week_order' => $weekOrder,
            'week_date' => now()->subWeeks(10 - $weekOrder),
        ])
    );

	$savedWeeks = Week::all(); // Fetches all Score records in the test database
    dump($savedWeeks->toArray()); // See what is actually stored

    // Assign scores to the player for those **exact weeks**
    $scores = collect([40, 42, 38, 36])->map(function ($score, $index) use ($player, $weeks) {
        return Score::factory()->create([
            'player_id' => $player->id,
            'foreign_key' => $weeks[$index]->id,
            'score_type' => 'weekly_score',
            'gross' => $score,
        ]);
    });

    // ✅ Fetch the actual saved scores from the database and dump them
    $savedScores = Score::all(); // Fetches all Score records in the test database
    dump($savedScores->toArray()); // See what is actually stored

    // Act
    (new UpdateHandicaps($player))->handle();

    // ✅ Fetch the updated player from the database and dump handicap info
    $updatedPlayer = Player::find($player->id);

    // Assert
    $bestScores = [36, 38];
    $expectedHandicap = round((array_sum($bestScores) / count($bestScores)) - 37);

    expect($player->hc_second)->toEqual($expectedHandicap);
});

it('calculates quarter 2 handicap correctly for a player with all rounds', function () {
    // Arrange
    $year = Year::factory()->create(['active' => true]);
    $player = Player::factory()->create(['year_id' => $year->id]);

    // Create Weeks 1-10
    $weeks = collect(range(1, 10))->map(fn ($weekOrder) =>
        Week::factory()->create([
            'year_id' => $year->id,
            'week_order' => $weekOrder,
            'week_date' => now()->subWeeks(25 - $weekOrder),
        ])
    );

    // Assign scores to the player for those **exact weeks**
    $scores = collect([40, 42, 38, 36, 39, 40, 39, 38, 37, 64])->map(function ($score, $index) use ($player, $weeks) {
        return Score::factory()->create([
            'player_id' => $player->id,
            'foreign_key' => $weeks[$index]->id,
            'score_type' => 'weekly_score',
            'gross' => $score,
        ]);
    });

    // Act
    (new UpdateHandicaps($player))->handle();

    // Assert
    $bestScores = [36, 37, 38, 38, 39];
    $expectedHandicap = round((array_sum($bestScores) / count($bestScores)) - 37);

    expect($player->hc_second)->toEqual($expectedHandicap);
});

it('calculates quarter 2 handicap correctly for a player who missed a round', function () {
    // Arrange
    $year = Year::factory()->create(['active' => true]);
    $player = Player::factory()->create(['year_id' => $year->id]);

    // Create Weeks 1-10
    $weeks = collect(range(1, 10))->map(fn ($weekOrder) =>
        Week::factory()->create([
            'year_id' => $year->id,
            'week_order' => $weekOrder,
            'week_date' => now()->subWeeks(25 - $weekOrder),
        ])
    );

    // Assign scores to the player for those **exact weeks**
    $scores = collect([40, 42, 38, 36, 39, 39, 38, 37, 64])->map(function ($score, $index) use ($player, $weeks) {
        return Score::factory()->create([
            'player_id' => $player->id,
            'foreign_key' => $weeks[$index]->id,
            'score_type' => 'weekly_score',
            'gross' => $score,
        ]);
    });

    // Act
    (new UpdateHandicaps($player))->handle();

    // Assert
    $bestScores = [36, 37, 38, 38, 39];
    $expectedHandicap = round((array_sum($bestScores) / count($bestScores)) - 37);

    expect($player->hc_second)->toEqual($expectedHandicap);
});

it('calculates quarter 2 handicap correctly for a player who missed 2 rounds', function () {
    // Arrange
    $year = Year::factory()->create(['active' => true]);
    $player = Player::factory()->create(['year_id' => $year->id]);

    // Create Weeks 1-10
    $weeks = collect(range(1, 10))->map(fn ($weekOrder) =>
        Week::factory()->create([
            'year_id' => $year->id,
            'week_order' => $weekOrder,
            'week_date' => now()->subWeeks(25 - $weekOrder),
        ])
    );

    // Assign scores to the player for those **exact weeks**
    $scores = collect([40, 42, 38, 36, 39, 39, 38, 64])->map(function ($score, $index) use ($player, $weeks) {
        return Score::factory()->create([
            'player_id' => $player->id,
            'foreign_key' => $weeks[$index]->id,
            'score_type' => 'weekly_score',
            'gross' => $score,
        ]);
    });

    // Act
    (new UpdateHandicaps($player))->handle();

    // Assert
    $bestScores = [36, 38, 38, 39];
    $expectedHandicap = round((array_sum($bestScores) / count($bestScores)) - 37);

    expect($player->hc_second)->toEqual($expectedHandicap);
});
