# New Season Wizard — Implementation Status

## Overview

A web-based admin wizard that replaces the `agl:new` Artisan command for creating a new season. It's a 6-step Livewire single file component at `/admin/seasons/create`.

## What's Been Done

### Files Created

- **`resources/views/livewire/admin/seasons/create.blade.php`** — Livewire 4 single file component (6-step wizard)
- **`tests/Feature/Admin/SeasonWizardTest.php`** — 18 Pest tests (all passing)

### Files Modified

- **`routes/web.php`** — Added `Route::livewire('/admin/seasons/create', 'admin.seasons.create')` inside the `IsAdmin` middleware group
- **`resources/views/components/layouts/admin.blade.php`** — Added "New Season" nav item with `plus-circle` icon in the sidebar `flux:navlist`
- **`CLAUDE.md`** — Added "Livewire Components" section documenting single file component patterns
- **`.env.testing`** — Added `APP_KEY` (required for Livewire component rendering with Flux UI)

### Files Deleted

- **`app/Console/Commands/NewYear.php`** — The CLI command this wizard replaces

## How the Wizard Works

### 6 Steps

1. **Year** — Name (defaults to current year) and active toggle
2. **Teams** — Count (default 6, named 1-N automatically)
3. **Weeks** — Count (default 20), start date, optional skip date
4. **Previous Year** — Dropdown of existing years for handicap lookup
5. **Players** — One team per page (4 positions per team). Native `<select>` for each player, handicap input, yellow tees toggle for position 4. Auto-fills handicap from previous year's `hc_next_year` when a user is selected.
6. **Review** — Read-only summary, "Generate Blank Scorecards" toggle, "Create Season" button

Step 5 pages through teams one at a time (`$currentTeam` property). "Continue" advances to next team, "Back" goes to previous team. Badge indicators show team progress.

### Creation Logic (ported from `NewYear.php`)

All in a DB transaction inside `createSeason()`:
- `createYear()` — Creates Year record (Year model's `saving` event handles deactivating others)
- `createTeams()` — Creates N teams named "1" through "N"
- `createWeeks()` — Creates weeks with matchup rotation and side game alternation
- `createPlayers()` — Creates Player records with handicap and tee selection
- `createScores()` — Creates blank weekly scores + quarterly/season averages per player

### Week Matchup Logic

- Matchups rotate based on last digit of `week_order` (see `createWeek()` method)
- Tee time rotation shifts the matchup array: +2 positions for weeks 6-10, +4 for weeks 11-15
- Side games alternate Net/Pin starting from Net (initial state is 'Putts', first flip is to 'Net')
- `a_first_id`/`a_second_id` etc. store team name numbers (1-6), NOT actual team DB IDs

### User Filtering

The player dropdowns only show active users: `User::where('active', true)`. The `active` column doesn't exist in the SQLite test schema, so `with()` uses `Schema::hasColumn('users', 'active')` to conditionally apply the filter.

## Known Bug — Player Selection Glitch on Step 5

**Symptom:** After assigning 4 players on Team 1, advancing to Team 2, and selecting the first couple players, the selected value changes to a different user than what was picked.

**Root Cause:** Native `<select>` elements with `wire:model.live` combined with a dynamically filtered options list. When a player is selected, `wire:model.live` triggers a server roundtrip. The `availableUsersForSlot()` method recalculates the available options (excluding newly assigned users). When the `<option>` list shifts, the browser's selected index can become mismatched with the intended value. Livewire's DOM diffing then reassigns the wrong user.

**Possible Fixes (in order of preference):**

1. **Use `wire:model` instead of `wire:model.live`** on the player selects, and add a separate "Confirm Team" or use `wire:change` to trigger the handicap lookup. This avoids the mid-selection re-render.
2. **Don't filter out assigned users from the dropdown** — show all active users in every dropdown and instead validate duplicates only on "Next Team". This eliminates the shifting options problem entirely.
3. **Use `flux:select variant="listbox"`** (without `searchable`) — Flux listbox manages its own state better than native `<select>` with Livewire. This was previously too slow with `searchable` but without it, and with only 4 selects per page and ~24 active users, it may be fine.
4. **Use `wire:model.live` only for the handicap auto-fill**, and use Alpine.js `x-on:change` to handle the selection locally before syncing to Livewire.

**The handicap auto-fill depends on `wire:model.live`** — the `updatedPlayerAssignments()` hook fires when a user is selected and looks up their previous year handicap. Whatever fix is chosen needs to preserve this behavior.

## Test Details

Tests use `Livewire::test()` which bypasses route middleware, so they don't need the `admin` column (which is missing from the SQLite test migration). The test file has helper functions:

- `advanceToStep5($component)` — Calls `nextStep()` 4 times (steps 1→5)
- `assignAllPlayersAndAdvance($component, $users, $teamCount)` — Assigns users to all teams and advances through each team page to step 6

### Test Coverage

- Step navigation forward and backward
- Validation on each step (year name required/unique, team count min 2, start date required)
- Team paging within step 5 (forward, backward, back to step 4)
- Handicap auto-population from previous year
- User exclusion from dropdowns when already assigned
- Full season creation (year, 6 teams, 20 weeks, 24 players, 600 scores)
- Week matchup rotation correctness
- Side game alternation (Net/Pin)
- Skip date handling
- Yellow tees for position 4
- Year deactivation when creating an active season

## Architecture Notes

- The component uses `$step` (1-6) and `$currentTeam` (1-N) to control which page is shown
- Player assignments stored in `public array $playerAssignments` — nested `[team][position] => [user_id, handicap, yellow_tees]`
- `getAssignedUserIdsProperty()` is a Livewire computed property (cached per request)
- `availableUsersForSlot()` takes the full users collection as a parameter to avoid re-querying
- Validation on step 5 validates only the current team (`validateTeamAssignments()`)
- The review step (6) validates nothing — `createSeason()` calls `validateCurrentStep()` which hits the `default => null` case
