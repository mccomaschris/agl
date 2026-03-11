<?php

use App\Http\Controllers\Admin\PrintScorecardController;
use App\Http\Controllers\ChrisVsMikeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\WeekController;
use App\Http\Middleware\IsAdmin;
use App\Livewire\SiteIndex;
use App\Livewire\WeekScores;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', SiteIndex::class)->name('home');

Route::get('/offline', fn () => view('offline'))->name('offline');

Route::get('rules', [RuleController::class, 'index'])->name('rules');
Route::get('agl-history', [HistoryController::class, 'index'])->name('history');
Route::get('schedule/{year}', [WeekController::class, 'show'])->name('schedule');
Route::get('players/{user}', [PlayerController::class, 'show'])->name('player');

Route::livewire('team-stats/{year}', 'team-stats.show')->name('team-stats');
Route::livewire('group-stats/{year}', 'group-stats.show')->name('group-stats');
Route::livewire('standings/{year}', 'standings.show')->name('standings');
Route::livewire('handicaps/{year}', 'handicaps.show')->name('handicaps');
Route::livewire('team-points/{year}', 'team-points.show')->name('team-points');

Route::livewire('scores/player/{player}', 'player.score')->name('player-score');
Route::get('scores/week/{week}', WeekScores::class)->name('week-score');

Route::get('chris-vs-mike', [ChrisVsMikeController::class, 'show']);

Route::middleware(['auth'])->group(function () {
    Route::livewire('members', 'members.index')->name('members');
    Route::livewire('waitlist', 'waitlist.index')->name('waitlist.index');
});

Route::middleware([IsAdmin::class])->group(function () {
    Route::get('scorecard/print/{quarter}', [PrintScorecardController::class, 'show'])->name('scorecard.print');

    Route::livewire('/admin/', 'admin.index')->name('admin.index');

    Route::post('/admin/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return response()->json(['success' => true, 'message' => 'The application cache has been cleared.']);
    })->name('admin.clear-cache');

    Route::livewire('/admin/users', 'admin.users.index')->name('admin.users.index');
    Route::livewire('/admin/users/{user}', 'admin.users.show')->name('admin.users.show');
    Route::livewire('/admin/years', 'admin.years.index')->name('admin.years.index');
    Route::livewire('/admin/weeks', 'admin.weeks.index')->name('admin.weeks.index');
    Route::livewire('/admin/teams', 'admin.teams.index')->name('admin.teams.index');
    Route::livewire('/admin/seasons/create', 'admin.seasons.create')->name('admin.seasons.create');
    Route::livewire('/admin/scores/week/{week}/edit', 'admin.scores.edit')->name('week-score-edit');
    Route::livewire('/admin/waitlist', 'admin.waitlist.index')->name('admin.waitlist.index');
});

Route::get('/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('email', $googleUser->email)->first();

    if ($user) {
        Auth::login($user);

        return redirect('/');
    } else {
        return response('Unauthorized.', 401);
    }
});

Route::get('/health', function () {
    return response()->json(['status' => 'ok'], 200);
});

require __DIR__.'/auth.php';
