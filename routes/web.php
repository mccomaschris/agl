<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\WeekController;
use App\Http\Controllers\HandicapController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\TeamPointsController;
use App\Http\Controllers\TeamStatsController;
use App\Http\Controllers\GroupStatsController;
use App\Http\Controllers\PlayerScoreController;
use App\Http\Controllers\WeekScoreController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\LiveScorecardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\WaitlistController;

Route::get('/', [SiteController::class, 'index']);

Route::get('rules', [RuleController::class, 'show'])->name('rules');
Route::get('agl-history', [HistoryController::class, 'show'])->name('history');
Route::get('schedule/{year}', [WeekController::class, 'show'])->name('schedule');
Route::get('handicaps/{year}', [HandicapController::class, 'show'])->name('handicaps');
Route::get('standings/{year}', [StandingController::class, 'show'])->name('standings');
Route::get('team-points/{year}', [TeamPointsController::class, 'show'])->name('team-points');
Route::get('team-stats/{year}', [TeamStatsController::class, 'show'])->name('team-stats');
Route::get('group-stats/{year}', [GroupStatsController::class, 'show'])->name('group-stats');
Route::get('scores/player/{player}', [PlayerScoreController::class, 'show'])->name('player-score');
Route::get('scores/week/{week}', [WeekScoreController::class, 'show'])->name('week-score');
Route::get('players/{user}', [PlayerController::class, 'show'])->name('player');
Route::get('scorecard/{week?}', [LiveScorecardController::class, 'show']);

Route::group(['auth:sanctum', 'verified'], function () {
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::resource('waitlist', WaitlistController::class);
});

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\AdminController@index');
    Route::post('scores/{score}', 'App\Http\Controllers\Admin\ScoreController@update')->name('admin.scores.update');
    Route::get('scores/week/{week}/edit', 'App\Http\Controllers\Admin\WeekScoreController@edit')->name('admin.week-scores');

    Route::get('scorecard/print/{quarter}', 'App\Http\Controllers\Admin\PrintScorecardController@show');
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
    Route::get('/cache', 'App\Http\Controllers\CommandController@cache');

    Route::patch('adjust-weeks/{week}', 'App\Http\Controllers\Admin\AdjustWeeksController@update');

});
