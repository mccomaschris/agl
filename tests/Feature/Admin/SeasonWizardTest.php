<?php

use App\Models\Player;
use App\Models\Score;
use App\Models\Team;
use App\Models\User;
use App\Models\Week;
use App\Models\Year;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

// Helper: navigate to step 5 (team 1)
function advanceToStep5($component): void
{
    $component
        ->call('nextStep')  // step 1 -> 2
        ->call('nextStep')  // step 2 -> 3
        ->call('nextStep')  // step 3 -> 4
        ->call('nextStep'); // step 4 -> 5
}

// Helper: assign all players across teams, then advance through all teams to step 6 (Handicaps)
function assignAllPlayersAndAdvance($component, $users, int $teamCount = 6): void
{
    $userIndex = 0;
    for ($t = 1; $t <= $teamCount; $t++) {
        for ($p = 1; $p <= 4; $p++) {
            $component->set("playerAssignments.{$t}.{$p}.user_id", $users[$userIndex]->id);
            $userIndex++;
        }
        // Each nextStep advances to next team, last one advances to step 6
        $component->call('nextStep');
    }
}

// Helper: set handicaps for all players on step 6 and advance to step 7 (Review)
function setHandicapsAndAdvance($component, int $teamCount = 6): void
{
    for ($t = 1; $t <= $teamCount; $t++) {
        for ($p = 1; $p <= 4; $p++) {
            $component->set("playerAssignments.{$t}.{$p}.handicap", '3');
        }
    }
    $component->call('nextStep');
}

it('renders step 1 by default', function () {
    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->assertSet('step', 1)
        ->assertSee('Year Name');
});

it('validates year name is required before advancing', function () {
    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '')
        ->call('nextStep')
        ->assertHasErrors(['yearName'])
        ->assertSet('step', 1);
});

it('validates year name is unique before advancing', function () {
    Year::factory()->create(['name' => '2025', 'active' => false]);

    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2025')
        ->call('nextStep')
        ->assertHasErrors(['yearName'])
        ->assertSet('step', 1);
});

it('advances from step 1 to step 2', function () {
    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->assertSet('step', 2)
        ->assertSee('Number of Teams');
});

it('goes back from step 2 to step 1', function () {
    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->assertSet('step', 2)
        ->call('previousStep')
        ->assertSet('step', 1);
});

it('validates team count is at least 2', function () {
    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->set('teamCount', 1)
        ->call('nextStep')
        ->assertHasErrors(['teamCount'])
        ->assertSet('step', 2);
});

it('validates start date is required', function () {
    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->call('nextStep')
        ->set('startDate', '')
        ->call('nextStep')
        ->assertHasErrors(['startDate'])
        ->assertSet('step', 3);
});

it('advances through steps to step 5', function () {
    Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->assertSet('step', 2)
        ->call('nextStep')
        ->assertSet('step', 3)
        ->call('nextStep')
        ->assertSet('step', 4)
        ->call('nextStep')
        ->assertSet('step', 5)
        ->assertSet('currentTeam', 1);
});

it('pages through teams within step 5', function () {
    $users = User::factory()->count(8)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('teamCount', 2);

    advanceToStep5($component);

    $component->assertSet('step', 5)->assertSet('currentTeam', 1);

    // Assign team 1 players and advance
    for ($p = 1; $p <= 4; $p++) {
        $component->set("playerAssignments.1.{$p}.user_id", $users[$p - 1]->id);
    }
    $component->call('nextStep');
    $component->assertSet('step', 5)->assertSet('currentTeam', 2);

    // Assign team 2 players and advance to step 6 (Handicaps)
    for ($p = 1; $p <= 4; $p++) {
        $component->set("playerAssignments.2.{$p}.user_id", $users[$p + 3]->id);
    }
    $component->call('nextStep');
    $component->assertSet('step', 6);
});

it('goes back between teams in step 5', function () {
    $users = User::factory()->count(8)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('teamCount', 2);

    advanceToStep5($component);

    // Assign team 1 and advance to team 2
    for ($p = 1; $p <= 4; $p++) {
        $component->set("playerAssignments.1.{$p}.user_id", $users[$p - 1]->id);
    }
    $component->call('nextStep');
    $component->assertSet('currentTeam', 2);

    // Go back to team 1
    $component->call('previousStep');
    $component->assertSet('step', 5)->assertSet('currentTeam', 1);

    // Go back to step 4
    $component->call('previousStep');
    $component->assertSet('step', 4);
});

it('advances from step 6 handicaps to step 7 review', function () {
    $users = User::factory()->count(8)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('teamCount', 2);

    advanceToStep5($component);
    assignAllPlayersAndAdvance($component, $users, 2);

    $component->assertSet('step', 6);

    setHandicapsAndAdvance($component, 2);

    $component->assertSet('step', 7);
});

it('goes back from step 7 review to step 6 handicaps', function () {
    $users = User::factory()->count(8)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('teamCount', 2);

    advanceToStep5($component);
    assignAllPlayersAndAdvance($component, $users, 2);
    setHandicapsAndAdvance($component, 2);

    $component
        ->assertSet('step', 7)
        ->call('previousStep')
        ->assertSet('step', 6);
});

it('goes back from step 6 handicaps to step 5 last team', function () {
    $users = User::factory()->count(8)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('teamCount', 2);

    advanceToStep5($component);
    assignAllPlayersAndAdvance($component, $users, 2);

    $component
        ->assertSet('step', 6)
        ->call('previousStep')
        ->assertSet('step', 5)
        ->assertSet('currentTeam', 2);
});

it('populates handicaps from previous year on step 6', function () {
    $previousYear = Year::factory()->create(['name' => '2098', 'active' => false]);
    $users = User::factory()->count(8)->create();
    $previousTeam = Team::where('year_id', $previousYear->id)->first();

    // Give two users previous year records with known handicaps
    Player::factory()->create([
        'user_id' => $users[0]->id,
        'year_id' => $previousYear->id,
        'team_id' => $previousTeam->id,
        'hc_next_year' => 5,
    ]);
    Player::factory()->create([
        'user_id' => $users[4]->id,
        'year_id' => $previousYear->id,
        'team_id' => $previousTeam->id,
        'hc_next_year' => 8,
    ]);

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('teamCount', 2)
        ->set('previousYearId', $previousYear->id);

    advanceToStep5($component);
    assignAllPlayersAndAdvance($component, $users, 2);

    $component
        ->assertSet('step', 6)
        // Players with previous year records get their hc_next_year
        ->assertSet('playerAssignments.1.1.handicap', '5')
        ->assertSet('playerAssignments.2.1.handicap', '8')
        // Players without previous year records stay empty
        ->assertSet('playerAssignments.1.2.handicap', '');
});

it('leaves handicaps empty when no previous year selected', function () {
    $users = User::factory()->count(8)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('teamCount', 2);

    advanceToStep5($component);
    assignAllPlayersAndAdvance($component, $users, 2);

    $component
        ->assertSet('step', 6)
        ->assertSet('playerAssignments.1.1.handicap', '');
});

it('excludes already-assigned users from other dropdowns', function () {
    $users = User::factory()->count(24)->create();
    $firstUser = $users->first();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099');

    advanceToStep5($component);

    $component->set('playerAssignments.1.1.user_id', $firstUser->id);

    $allUsers = User::orderBy('name')->get();

    // The assigned user should not appear in a different slot's available users
    $availableForSlot2 = $component->instance()->availableUsersForSlot(1, 2, $allUsers);
    expect($availableForSlot2->pluck('id'))->not->toContain($firstUser->id);

    // But should still appear in their own slot
    $availableForSlot1 = $component->instance()->availableUsersForSlot(1, 1, $allUsers);
    expect($availableForSlot1->pluck('id'))->toContain($firstUser->id);
});

it('creates a complete season with all entities', function () {
    $users = User::factory()->count(24)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('yearActive', true)
        ->call('nextStep')
        ->set('teamCount', 6)
        ->call('nextStep')
        ->set('weekCount', 20)
        ->set('startDate', '2099-04-10')
        ->set('skipDate', '')
        ->call('nextStep')
        ->call('nextStep');

    // Assign all 24 players across 6 teams, advancing through each
    assignAllPlayersAndAdvance($component, $users);

    $component->assertSet('step', 6);

    // Set handicaps and advance to review
    setHandicapsAndAdvance($component);

    $component
        ->assertSet('step', 7)
        ->set('generateScores', true)
        ->call('createSeason')
        ->assertRedirect(route('admin.years.index'));

    // Verify year was created
    $year = Year::where('name', '2099')->first();
    expect($year)->not->toBeNull();
    expect($year->active)->toBeTruthy();

    // Verify teams
    expect(Team::where('year_id', $year->id)->count())->toBe(6);

    // Verify weeks
    expect(Week::where('year_id', $year->id)->count())->toBe(20);

    // Verify players
    expect(Player::where('year_id', $year->id)->count())->toBe(24);

    // Verify scores (24 players x 20 weeks + 24 players x 5 averages)
    $weeklyScores = Score::whereHas('player', fn ($q) => $q->where('year_id', $year->id))
        ->where('score_type', 'weekly_score')
        ->count();
    expect($weeklyScores)->toBe(480);

    $avgScores = Score::whereHas('player', fn ($q) => $q->where('year_id', $year->id))
        ->whereIn('score_type', ['qtr_1_avg', 'qtr_2_avg', 'qtr_3_avg', 'qtr_4_avg', 'season_avg'])
        ->count();
    expect($avgScores)->toBe(120);
});

it('generates correct matchup rotation for weeks', function () {
    $users = User::factory()->count(24)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->set('teamCount', 6)
        ->call('nextStep')
        ->set('weekCount', 5)
        ->set('startDate', '2099-04-10')
        ->set('skipDate', '')
        ->call('nextStep')
        ->call('nextStep');

    assignAllPlayersAndAdvance($component, $users);
    setHandicapsAndAdvance($component);

    $component
        ->set('generateScores', false)
        ->call('createSeason');

    $year = Year::where('name', '2099')->first();

    // Week 1: matchup [1,2,3,4,5,6]
    $week1 = Week::where('year_id', $year->id)->where('week_order', 1)->first();
    expect($week1->a_first_id)->toBe(1);
    expect($week1->a_second_id)->toBe(2);
    expect($week1->b_first_id)->toBe(3);
    expect($week1->b_second_id)->toBe(4);
    expect($week1->c_first_id)->toBe(5);
    expect($week1->c_second_id)->toBe(6);

    // Week 2: matchup [4,6,2,5,1,3]
    $week2 = Week::where('year_id', $year->id)->where('week_order', 2)->first();
    expect($week2->a_first_id)->toBe(4);
    expect($week2->a_second_id)->toBe(6);
    expect($week2->b_first_id)->toBe(2);
    expect($week2->b_second_id)->toBe(5);
    expect($week2->c_first_id)->toBe(1);
    expect($week2->c_second_id)->toBe(3);
});

it('alternates side games between Net and Pin', function () {
    $users = User::factory()->count(24)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->set('teamCount', 6)
        ->call('nextStep')
        ->set('weekCount', 4)
        ->set('startDate', '2099-04-10')
        ->set('skipDate', '')
        ->call('nextStep')
        ->call('nextStep');

    assignAllPlayersAndAdvance($component, $users);
    setHandicapsAndAdvance($component);

    $component
        ->set('generateScores', false)
        ->call('createSeason');

    $year = Year::where('name', '2099')->first();
    $weeks = Week::where('year_id', $year->id)->orderBy('week_order')->get();

    // First week starts with Net (opposite of initial 'Putts')
    expect($weeks[0]->side_games)->toBe('Net');
    expect($weeks[1]->side_games)->toBe('Pin');
    expect($weeks[2]->side_games)->toBe('Net');
    expect($weeks[3]->side_games)->toBe('Pin');
});

it('skips the specified skip date when creating weeks', function () {
    $users = User::factory()->count(24)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->set('teamCount', 6)
        ->call('nextStep')
        ->set('weekCount', 3)
        ->set('startDate', '2099-04-10')
        ->set('skipDate', '2099-04-17')
        ->call('nextStep')
        ->call('nextStep');

    assignAllPlayersAndAdvance($component, $users);
    setHandicapsAndAdvance($component);

    $component
        ->set('generateScores', false)
        ->call('createSeason');

    $year = Year::where('name', '2099')->first();
    $weeks = Week::where('year_id', $year->id)->orderBy('week_order')->get();

    expect($weeks)->toHaveCount(3);
    // Week 1: Apr 10, Week 2: Apr 24 (Apr 17 skipped), Week 3: May 1
    expect($weeks[0]->week_date->format('Y-m-d'))->toBe('2099-04-10');
    expect($weeks[1]->week_date->format('Y-m-d'))->toBe('2099-04-24');
    expect($weeks[2]->week_date->format('Y-m-d'))->toBe('2099-05-01');
});

it('sets yellow tees for position 4 players when enabled', function () {
    $users = User::factory()->count(24)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->call('nextStep')
        ->set('teamCount', 6)
        ->call('nextStep')
        ->set('weekCount', 1)
        ->set('startDate', '2099-04-10')
        ->call('nextStep')
        ->call('nextStep');

    // Assign all players, but set yellow tees on team 1 position 4
    $userIndex = 0;
    for ($t = 1; $t <= 6; $t++) {
        for ($p = 1; $p <= 4; $p++) {
            $component->set("playerAssignments.{$t}.{$p}.user_id", $users[$userIndex]->id);
            if ($p === 4 && $t === 1) {
                $component->set("playerAssignments.{$t}.{$p}.yellow_tees", true);
            }
            $userIndex++;
        }
        $component->call('nextStep');
    }

    // Set handicaps and advance to review
    setHandicapsAndAdvance($component);

    $component
        ->set('generateScores', false)
        ->call('createSeason');

    $year = Year::where('name', '2099')->first();
    $team1 = Team::where('year_id', $year->id)->where('name', '1')->first();

    $pos4 = Player::where('team_id', $team1->id)->where('position', 4)->first();
    expect($pos4->tee_selection)->toBe('Yellow');

    // Other position 4 players should be White
    $team2 = Team::where('year_id', $year->id)->where('name', '2')->first();
    $pos4team2 = Player::where('team_id', $team2->id)->where('position', 4)->first();
    expect($pos4team2->tee_selection)->toBe('White');
});

it('deactivates other years when creating an active season', function () {
    $existingYear = Year::factory()->create(['name' => '2098', 'active' => true]);
    $users = User::factory()->count(24)->create();

    $component = Livewire::actingAs($this->user)
        ->test('admin.seasons.create')
        ->set('yearName', '2099')
        ->set('yearActive', true)
        ->call('nextStep')
        ->call('nextStep')
        ->set('weekCount', 1)
        ->set('startDate', '2099-04-10')
        ->call('nextStep')
        ->call('nextStep');

    assignAllPlayersAndAdvance($component, $users);
    setHandicapsAndAdvance($component);

    $component
        ->set('generateScores', false)
        ->call('createSeason');

    expect(Year::where('name', '2099')->first()->active)->toBeTruthy();
    expect(Year::find($existingYear->id)->active)->toBeFalsy();
});
