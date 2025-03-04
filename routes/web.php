<?php

use App\Http\Controllers\ChrisVsMikeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LiveScorecardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\WaitlistController;
use App\Http\Controllers\WeekController;
use App\Livewire\AdminUsers;
use App\Livewire\AllStats;
use App\Livewire\EditScores;
use App\Livewire\End;
use App\Livewire\GroupStats;
use App\Livewire\Handicaps;
use App\Livewire\PlayerScore;
use App\Livewire\PlayoffIndex;
use App\Livewire\SiteIndex;
use App\Livewire\Standings;
use App\Livewire\TeamPoints;
use App\Livewire\TeamStats;
use App\Livewire\WeekIndex;
use App\Livewire\WeekScores;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', SiteIndex::class)->name('home');
// Route::get('/', PlayoffIndex::class)->name('home');

Route::get('rules', [RuleController::class, 'show'])->name('rules');
Route::get('agl-history', [HistoryController::class, 'show'])->name('history');
Route::get('schedule/{year}', [WeekController::class, 'show'])->name('schedule');
Route::get('players/{user}', [PlayerController::class, 'show'])->name('player');

Route::get('all-stats/{year}', AllStats::class)->name('all-stats');
Route::get('team-stats/{year}', TeamStats::class)->name('team-stats');
Route::get('group-stats/{year}', GroupStats::class)->name('group-stats');
Route::get('standings/{year}', Standings::class)->name('standings');
Route::get('handicaps/{year}', Handicaps::class)->name('handicaps');
Route::get('team-points/{year}', TeamPoints::class)->name('team-points');
Route::get('scores/player/{player}', PlayerScore::class)->name('player-score');
Route::get('scores/week/{week}', WeekScores::class)->name('week-score');
Route::get('scores/week/{week}/edit', EditScores::class)->name('week-score-edit');

Route::get('scorecard/{week?}', [LiveScorecardController::class, 'show']);

Route::get('chris-vs-mike', [ChrisVsMikeController::class, 'show']);

Route::get('scorecard/print/{quarter}', 'App\Http\Controllers\Admin\PrintScorecardController@show');

Route::get('/admin/weeks', WeekIndex::class)->name('admin.week.index');

Route::group(['auth:sanctum', 'verified'], function () {
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::resource('waitlist', WaitlistController::class);
});


Volt::route('/admin/users', 'admin.users.index')->name('admin.users.index');
Volt::route('/admin/users/{user}', 'admin.users.show')->name('admin.users.show');

Volt::route('/admin/years', 'admin.years.index')->name('admin.years.index');


require __DIR__.'/auth.php';
