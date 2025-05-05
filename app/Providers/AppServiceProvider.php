<?php

namespace App\Providers;

use App\Models\Year;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
	}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Component::macro('notify', function ($message) {
            $this->dispatchBrowserEvent('notify', $message);
        });

        if (Schema::hasTable('years')) { // ✅ Prevents errors before migration runs
			$activeYear = Year::where('active', true)->first();
			view()->share('activeYear', $activeYear);
		}

        Blade::if('admin', function () {
            if (Auth::user() && Auth::user()->isAdmin()) {
                return true;
            }
        });
    }
}
