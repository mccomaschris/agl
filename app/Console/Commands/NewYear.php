<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NewYear extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'agl:new';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Year, Teams, and Weeks for new year.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Create new Year
	 *
	 * @return Year database object
	 */
	public function create_year($year_name, $year_active) {

		// Only one YEAR should be active at a time.
		// Make sure all other years are inactive if this one is active.

		if ($year_active) {
			$years = Year::where('active', 1)->get();

			foreach ($years as $year) {
				$year->active = false;
				$year->save();
			}
		}

		$year = new Year;
		$year->name = $year_name;
		$year->active = $year_active;
		$year->save();

		return $year;
	}

	/**
	 * Create new Week
	 *
	 * @return Week database object
	 */
	public function create_week($year_id, $week_order, $start_week, $previous_game) {
		$week = new Week;
		$week->year_id = $year_id;
		$week->week_order = $week_order;
		$week->week_date = $start_week;

		// GET PREVIOUS GAME
		switch ($previous_game) {
		case "Net":
			$week->side_games = "Pin";
			break;
		case "Pin":
			$week->side_games = "Putts";
			break;
		case "Putts":
			$week->side_games = "Net";
			break;
		default:
			$week->side_games = "Net";
		}

		// FIGURE OUT WEEKLY MATCHUPS
		switch (substr(strval($week_order), -1)) {
		case 1:
		case 6:
			$week_matches = [1, 2, 3, 4, 5, 6];
			break;
		case 2:
		case 7:
			$week_matches = [4, 6, 2, 5, 1, 3];
			break;
		case 3:
		case 8:
			$week_matches = [3, 5, 1, 4, 2, 6];
			break;
		case 4:
		case 9:
			$week_matches = [2, 4, 3, 6, 1, 5];
			break;
		case 5:
		case 0:
			$week_matches = [1, 6, 2, 3, 4, 5];
			break;
		}

		// FIGURE OUT WEEKLY TEE TIMES
		switch ($week_order) {
		case in_array($week_order, range(6, 10)):
			$week_matches = array_merge(array_slice($week_matches, 2), array_slice($week_matches, 0, 2));
			break;
		case in_array($week_order, range(11, 15)):
			$week_matches = array_merge(array_slice($week_matches, 4), array_slice($week_matches, 0, 4));
			break;
		}

		// UPDATE WEEKLY MATCHES
		$week->a_first_id = $week_matches[0];
		$week->a_second_id = $week_matches[1];
		$week->b_first_id = $week_matches[2];
		$week->b_second_id = $week_matches[3];
		$week->c_first_id = $week_matches[4];
		$week->c_second_id = $week_matches[5];

		// SAVE WEEK AND RETURN IT
		$week->save();
		return $week;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		// Create Year
		// Current year is given as default
		$year_active = false; // default setting

		$year_name = $this->ask('What is the YEAR?', Carbon::now()->year);

		if ($this->confirm('Should this YEAR be set to active?', true)) {

			$year_active = true;

		}

		$year = $this->create_year($year_name, $year_active);

		// Create Teams for created Year
		// 6 Teams per Year is the default
		$team_total = $this->ask('How many TEAMS for this season?', 6);

		if ($team_total > 0) {

			for ($i = 0; $i < intval($team_total); $i++) {

				$team = new Team;
				$team->year_id = $year->id;
				$team->name = strval($i + 1);
				$team->save();

			}

		}

		// Create Weeks for created Year
		// 20 weeks is the default
		// Enter YYYY-MM-DD for starting Thursday
		// Enter YYYY-MM-DD for the Thursday traditionally skipped for Greenbrier Classic
		$week_total = $this->ask('How many weeks this season?', 20);

		if ($week_total > 0) {

			$start_week = new Carbon($this->ask('What is the start week? (YYYY-MM-DD)', '2017-04-13'));

			$skip_week = new Carbon($this->ask('What is the skip week? (YYYY-MM-DD)', '2017-07-06'));

			$previous_game = "Putts";
			$week_order = 0;

			for ($i = 0; $i < intval($week_total + 1); $i++) {

				if ($start_week == $skip_week) {

					$start_week = $start_week->addWeek();

				} else {

					$week_order++;
					$week = $this->create_week($year->id, $week_order, $start_week, $previous_game);
					$start_week = $week->week_date->addWeek();
					$previous_game = $week->side_games;
				}
			}
		}
	}
}
