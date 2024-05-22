<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\WeekController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\LiveScorecardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ChrisVsMikeController;
use App\Http\Controllers\WaitlistController;
use App\Livewire\AdminUsers;
use App\Livewire\EditScores;
use App\Livewire\WeekScores;
use App\Livewire\PlayerScore;
use App\Livewire\SiteIndex;
use App\Livewire\TeamPoints;
use App\Livewire\Handicaps;
use App\Livewire\Standings;
use App\Livewire\GroupStats;
use App\Livewire\TeamStats;
use App\Livewire\AllStats;

Route::get('/', SiteIndex::class)->name('home');

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

Route::group(['auth:sanctum', 'verified'], function () {
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::resource('waitlist', WaitlistController::class);
});

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\AdminController@index');
    Route::get('/top10', 'App\Http\Controllers\Admin\AdminController@topten');
    Route::post('scores/{score}', 'App\Http\Controllers\Admin\ScoreController@update')->name('admin.scores.update');
    Route::get('scores/week/{week}/edit', 'App\Http\Controllers\Admin\WeekScoreController@edit')->name('admin.week-scores');


    Route::get('scores', 'App\Http\Controllers\Admin\ScoreController@index');

    Route::get('rankings', 'App\Http\Controllers\Admin\AdminController@rankings');

    Route::resource('users', 'App\Http\Controllers\Admin\UserController');
    Route::resource('years', 'App\Http\Controllers\Admin\YearController');
    Route::resource('teams', 'App\Http\Controllers\Admin\TeamController');
    Route::resource('players', 'App\Http\Controllers\Admin\PlayerController');

    Route::patch('/scorecard/{week}/edit', 'App\Http\Controllers\ScorecardController@update');
    Route::get('/scorecard/{week}', 'App\Http\Controllers\ScorecardController@edit');
    Route::get('/scorecard/{week}/team/{team}', 'App\Http\Controllers\ScorecardController@edit');
    Route::get('/scorecard/{week}/matchup', 'App\Http\Controllers\ScorecardController@matchup');

    Route::get('/handicaps', 'App\Http\Controllers\CommandController@handicaps');
    Route::get('/stats', 'App\Http\Controllers\CommandController@stats');
    Route::post('/cache', 'App\Http\Controllers\CommandController@cache');

    Route::patch('adjust-weeks/{week}', 'App\Http\Controllers\Admin\AdjustWeeksController@update');

	Route::get('/users', AdminUsers::class);

});

require __DIR__.'/auth.php';
