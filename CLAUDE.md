# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

AGL (Amateur Golf League) - a Laravel application for managing a recreational golf league. Tracks players, teams, weekly scores, handicaps, standings, and statistics across seasons.

## Common Commands

```bash
# Run all tests
php artisan test --compact

# Run a specific test file
php artisan test --compact tests/Feature/HandicapCalculationTest.php

# Run tests matching a name
php artisan test --compact --filter=testName

# Lint / fix code style
vendor/bin/pint --dirty --format agent

# Build CSS (Tailwind v4 via CLI, not Vite)
npm run build

# Watch CSS during development
npm run dev

# Create a new Pest test
php artisan make:test --pest SomeTest

# Create a new model with factory/migration
php artisan make:model ModelName -mf --no-interaction
```

## Architecture

### Laravel 10 Structure (on Laravel 12)

This project was upgraded from Laravel 10 to 12 but keeps the Laravel 10 file structure. This is intentional.

- Middleware registration: `app/Http/Kernel.php`
- Console commands/schedule: `app/Console/Kernel.php`
- No `bootstrap/app.php` configuration

### Frontend

- **No Vite for CSS** - Uses Tailwind CSS v4 CLI directly
- Two CSS entry points: `resources/assets/css/main.css` (public) and `resources/assets/css/admin.css`
- CSS partials in `resources/assets/css/` prefixed with `_` (buttons, forms, nav, tables, utils, base)
- `twcss()` helper for cache-busting CSS file paths
- Three Blade layouts: `resources/views/components/layouts/app.blade.php`, `admin.blade.php`, `auth.blade.php`
- Custom green color palette defined in main.css `@theme` block

### UI Layer

- Full-page Livewire components for most views (registered via `Route::livewire()`)
- Flux UI Pro (`<flux:*>`) components for admin interfaces
- Alpine.js for client-side interactivity
- Livewire views: `resources/views/livewire/`
- Admin views nested under: `resources/views/livewire/admin/`

### Domain Model

Core entity hierarchy: **Year** → **Team** (6 per year) → **Player** (4 per team, positions 1-4) → **Score**

- **Year**: A season. One year is `active` at a time (enforced by model `saving` event). Routes use `name` as route key.
- **Team**: Named by letter/number. Has exactly 4 players at positions 1-4. Tracks cumulative `points`, `p1_points`-`p4_points`.
- **Player**: Belongs to a User, Team, and Year. Same User can have Player records across multiple years. Tracks multiple handicap values. May have a `substitute` (User ID).
- **Score**: Two types via `score_type`: `weekly_score` (individual round) and `season_avg`. Week relationship uses `foreign_key` column (not `week_id`).
- **Week**: Represents a weekly matchup. Contains 3 matches via team foreign keys: `a_first_id`/`a_second_id`, `b_first_id`/`b_second_id`, `c_first_id`/`c_second_id`. Has `week_order` (1-20) determining quarter (1-5, 6-10, 11-15, 16-20).
- **PlayerRecord**: Head-to-head records between players.

### Handicap System

The handicap calculation (`UpdateHandicaps` job) is central business logic:

- Uses best 50% of non-absent, non-substitute gross scores minus 37 (par)
- Quarterly handicaps: `hc_first` (starting/previous year), `hc_second` (after Q1), `hc_third` (after Q2), `hc_fourth` (after Q3), `hc_playoff` (after Q4)
- `hc_current` reflects which quarter is active based on `week_order`
- `hc_ten`: 10-best handicap with absence-adjusted denominator
- `hc_full`: Used for overall ranking; decimal precision kept
- `hc_18`: `hc_playoff * 1.5`
- Players are ranked by `hc_full` and `hc_ten` with tied-rank handling

### Queued Jobs (via Horizon)

- `UpdateHandicaps` - Recalculates all handicap fields for a player, then re-ranks all players
- `UpdatePlayerStats` - Recalculates player win/loss/points statistics
- `UpdateRoundStats` - Per-round statistical calculations
- `UpdateRecordVsOpponents` - Head-to-head record tracking

### Auth & Authorization

- Laravel Breeze + Google OAuth (Socialite)
- `User.admin` boolean field controls admin access
- `IsAdmin` middleware returns 404 for non-admins
- `@admin` Blade directive available for conditional rendering
- `$activeYear` shared globally to all views via `AppServiceProvider`

### Global Helpers (`app/helpers.php`)

- `ordinal()` - Number to ordinal string (1st, 2nd, 3rd)
- `last_name_clean()` - Disambiguates duplicate last names with first initial
- `str_possessive()` - Makes strings possessive
- `twcss()` - CSS path with cache-busting query string
- `formatWinnersList()` - Comma-separated list with "and" for last item

### Livewire Components

- Uses Livewire 4 native single file components (`new class extends Component` in a `.blade.php` file) — not Volt
- Scaffold with `php artisan make:livewire` then convert to single file component in `resources/views/livewire/`
- Multi-step wizards use `$step` property with `@if ($step === N)` blocks (see `admin/seasons/create.blade.php`)

### Models Convention Notes

- Most models use `$guarded = []`; Team and Year use `$fillable`
- Player eagerly loads `user` by default (`$with = ['user']`)
- Week eagerly loads `winners` and `year` by default
- Models use `$casts` property (not `casts()` method) - follow this convention
