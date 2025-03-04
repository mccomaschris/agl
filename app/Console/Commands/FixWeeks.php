<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\Week;
use App\Models\Year;
use Illuminate\Console\Command;

class FixWeeks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agl:fix-weeks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = Year::where('active', 1)->first();

		$weeks = Week::where('year_id', $year->id)->get();

		foreach ($weeks as $week) {
			$week->a_first_id = Team::where('year_id', $year->id)->where('name', $week->a_first_id)->first()->id;
			$week->a_second_id = Team::where('year_id', $year->id)->where('name', $week->a_second_id)->first()->id;
			$week->b_first_id = Team::where('year_id', $year->id)->where('name', $week->b_first_id)->first()->id;
			$week->b_second_id = Team::where('year_id', $year->id)->where('name', $week->b_second_id)->first()->id;
			$week->c_first_id = Team::where('year_id', $year->id)->where('name', $week->c_first_id)->first()->id;
			$week->c_second_id = Team::where('year_id', $year->id)->where('name', $week->c_second_id)->first()->id;
			$week->save();
		}
    }
}
