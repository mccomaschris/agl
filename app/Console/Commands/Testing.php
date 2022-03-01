<?php

namespace App\Console\Commands;

use App\Team;
use App\User;
use App\Week;
use App\Year;
use App\Score;
use App\Player;
use Carbon\Carbon;
use Illuminate\Console\Command;
use \Illuminate\Database\Eloquent\Factory;
use App\PlayerRecord;

class Testing extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'agl:test {--year=}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Used for developing: Currently developing the record vs opponents section';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		$week = Week::find(44);
		$year = Year::where('id', $week->year_id)->first();
        $weeks = Week::where('year_id', $year->id)->where('week_date', '>=', $week->week_date)->orderBy('week_date', 'asc')->get();

        $days = -7;

        foreach ($weeks as $week) {
			$old = Carbon::parse($week->week_date);
            $new = Carbon::parse($week->week_date)->addDays($days);

			
			if ($new == Carbon::parse($year->skip_date)) {
				$this->info("yes");
				$new = Carbon::parse($new)->addDays($days);
			}

			$this->info('Old: ' . $old . ' - ' . ' New: '. $new);
            // if (Carbon::parse($week->week_date)->addDays($days) == Carbon::parse($year->skip_date)) {
            //     $week->week_date = Carbon::parse($week->week_date)->addDays($days);
            // }

            // $week->save();

        }
    
	}
}
