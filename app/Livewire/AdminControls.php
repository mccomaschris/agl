<?php

namespace App\Livewire;

use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class AdminControls extends Component
{
    public $weeksToAdd = 1;

    public function clearCache() {
        $exitCode = Artisan::call('cache:clear');
        $this->notify('The cache has been cleared.');
    }
    public function updateHandicaps() {
        Artisan::call('agl:hc');
        $this->notify('Handicaps have been updated.');
    }

    public function addWeeks() {
        $active_year = Year::where('active', true)->first();
        $weeks = Week::where('year_id', $active_year->id)->where('week_date', '>', Carbon::yesterday())->orderBy('week_date', 'asc')->get();
        foreach($weeks as $week) {
            $week->week_date = Carbon::create($week->week_date)->addWeeks($this->weeksToAdd);
            $week->save();
        }
        $this->notify('Weeks have been updated.');
    }

    public function render()
    {
        return view('livewire.admin-controls');
    }
}
