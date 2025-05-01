<?php

use App\Http\Controllers\ChrisVsMikeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Admin\PrintScorecardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\WaitlistController;
use App\Http\Controllers\WeekController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\AllStats;
use App\Livewire\EditScores;
use App\Livewire\GroupStats;
use App\Livewire\Handicaps;
use App\Livewire\PlayerScore;
use App\Livewire\SiteIndex;
use App\Livewire\Standings;
use App\Livewire\TeamPoints;
use App\Livewire\TeamStats;
use App\Livewire\WeekScores;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', SiteIndex::class)->name('home');

Route::get('rules', [RuleController::class, 'index'])->name('rules');
Route::get('agl-history', [HistoryController::class, 'index'])->name('history');
Route::get('schedule/{year}', [WeekController::class, 'show'])->name('schedule');
Route::get('players/{user}', [PlayerController::class, 'show'])->name('player');

Volt::route('team-stats/{year}', 'team-stats.show')->name('team-stats');
Volt::route('group-stats/{year}', 'group-stats.show')->name('group-stats');
Volt::route('standings/{year}', 'standings.show')->name('standings');
Volt::route('handicaps/{year}', 'handicaps.show')->name('handicaps');
Volt::route('team-points/{year}', 'team-points.show')->name('team-points');

Volt::route('scores/player/{player}', 'player.score')->name('player-score');
Route::get('scores/week/{week}', WeekScores::class)->name('week-score');

Route::get('chris-vs-mike', [ChrisVsMikeController::class, 'show']);

Route::middleware(['auth'])->group(function () {
	Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::resource('waitlist', WaitlistController::class);
});

Route::middleware([IsAdmin::class])->group(function () {
	Route::get('scorecard/print/{quarter}', [PrintScorecardController::class, 'show'])->name('scorecard.print');
	Route::get('scores/week/{week}/edit', EditScores::class)->name('week-score-edit');

	Volt::route('/admin/', 'admin.index')->name('admin.index');

	Route::post('/admin/clear-cache', function () {
		Artisan::call('cache:clear');
		Artisan::call('config:clear');
		Artisan::call('view:clear');
		Artisan::call('route:clear');

		return response()->json(['success' => true, 'message' => 'The application cache has been cleared.']);
	})->name('admin.clear-cache');

	Volt::route('/admin/users', 'admin.users.index')->name('admin.users.index');
	Volt::route('/admin/users/{user}', 'admin.users.show')->name('admin.users.show');
	Volt::route('/admin/years', 'admin.years.index')->name('admin.years.index');
	Volt::route('/admin/weeks', 'admin.weeks.index')->name('admin.weeks.index');
	Volt::route('/admin/teams', 'admin.teams.index')->name('admin.teams.index');
	Volt::route('/admin/scores/week/{week}/edit', 'admin.scores.edit')->name('week-score-edit');
	// Route::get('scores/week/{week}/edit', EditScores::class)->name('week-score-edit');
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

require __DIR__.'/auth.php';
