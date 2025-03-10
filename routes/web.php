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
use App\Http\Middleware\IsAdmin;
use App\Livewire\AdminUsers;
use Illuminate\Support\Facades\Artisan;
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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/admin/weeks', WeekIndex::class)->name('admin.week.index');

Route::middleware(['auth'])->group(function () {
	Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::resource('waitlist', WaitlistController::class);
});

Route::middleware([IsAdmin::class])->group(function () {
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
