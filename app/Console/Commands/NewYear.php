<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;

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
		$year_name = text(
			label: 'What is the year?',
			placeholder: 'E.g. ' . Carbon::now()->year,
			default: Carbon::now()->year,
		);

		$year_active = confirm(
			label: 'Should this year be set to active?',
			default: true
		);

		$year = $this->create_year($year_name, $year_active);

		$team_total = text(
			label: 'How many teams this season?',
			default: '6',
			validate: 'numeric',
		);

		$this->create_teams($year->id, $team_total);

		// Create Weeks for created Year
		$week_total = text(
			label: 'How many weeks this season?',
			default: '20',
			validate: 'numeric',
		);

		if ($week_total > 0) {
			$start_week = new Carbon(
				text(
					label: 'What is the start week?',
					placeholder: 'YYYY-MM-DD',
					default: '2025-04-10',
				)
			);

			$skip_week = new Carbon(
				text(
					label: 'What is the skip week?',
					placeholder: 'YYYY-MM-DD',
				)
			);

			$this->create_weeks($year, $week_total, $start_week, $skip_week);
		}

		$previous_year = select(
			label: 'What was the previous year?',
			options: Year::where('active', 0)->orderBy('name', 'desc')->pluck('name', 'id')->toArray(),
			scroll: 10
		);

		$teams = Team::where('year_id', $year->id)->get();
		$players_per_team = 4;

        $users = User::orderBy('name')->get(); // Fetch all users sorted alphabetically

		if ($users->isEmpty()) {
            $this->error('No users found.');
            return;
        }

        $assignedPlayers = [];

		for ($teamNumber = 1; $teamNumber <= count($teams); $teamNumber++) {
			$team = Team::where('year_id', $year->id)->where('name', strval($teamNumber))->first();

            if (!$team) {
                $this->error("Team {$teamNumber} not found.");
                continue;
            }

            for ($position = 1; $position <= $players_per_team; $position++) {
                $availableUsers = $users->reject(fn($user) => in_array($user->id, $assignedPlayers));

                if ($availableUsers->isEmpty()) {
                    $this->error('No more available users to assign.');
                    return;
                }

                // Select player using Laravel Prompts
				$selectedUserId = select(
					label: "Who should be Team {$teamNumber}'s #{$position} player?",
					options: $availableUsers->pluck('name', 'id')->toArray(),
					scroll: 10
				);

                $selectedUser = $users->firstWhere('id', $selectedUserId);

				$previous_player = Player::where('user_id', $selectedUser->id)->where('year_id', $previous_year)->first();

				if ($previous_player) {
					$use_db_hc = confirm(
						label: "Do you want to set the handicap for {$selectedUser->name} as {$previous_player->hc_next_year}?",
						default: true,
					);
					$new_hc = $use_db_hc ? $previous_player->hc_next_year : text(
						label: "What is the handicap for {$selectedUser->name}?",
						default: $previous_player->hc_next_year,
						validate: 'numeric',
					);
				} else {
					$new_hc = text(
						label: "What is the handicap for {$selectedUser->name}?",
						default: '0',
						validate: 'numeric',
					);
				}

				$tee_selection = 'White';
				if ($position === 4) {
					$yellow_tees = $confirmed = confirm('Will this player use yellow tees?');
					$tee_selection = $yellow_tees ? 'Yellow' : 'White';
				}

                // Store the Player record in the database
                Player::create([
                    'team_id' => $team->id,
                    'user_id' => $selectedUser->id,
					'year_id' => $year->id,
					'position' => $position,
					'tee_selection' => $tee_selection,
					'on_leave' => false,
					'substitute' => false,
					'hc_current' => $new_hc,
					'hc_first' => $new_hc,
					'hc_second' => 0,
					'hc_third' => 0,
					'hc_fourth' => 0,
					'hc_playoff' => 0,
					'hc_next_year' => 0,
					'hc_18' => 0,
					'hc_full' => 0,
					'won' => 0,
					'lost' => 0,
					'tied' => 0,
					'win_pct' => 0,
					'points' => 0,
					'points_rank' => 0,
					'wins_rank' => 0,
					'gross_average' => 0,
					'gross_par' => 0,
					'net_average' => 0,
					'net_par' => 0,
					'low_gross' => 0,
					'low_net' => 0,
					'high_gross' => 0,
					'high_net' => 0,
					'position_net_rank' => 0,
					'overall_net_rank' => 0,
					'champion' => false,
					'make_ups' => 0,
                ]);

                $assignedPlayers[] = $selectedUser->id;

                $this->info("Assigned {$selectedUser->name} as Team {$teamNumber}'s #{$position} player.");
            }
        }
	}

	private function create_teams($year_id, $team_total) {
		if ($team_total > 0) {
			for ($i = 0; $i < intval($team_total); $i++) {
				$team = new Team;
				$team->year_id = $year_id;
				$team->name = strval($i + 1);
				$team->save();
			}
		}
	}

	private function create_weeks($year, $week_total, $start_week, $skip_week) {
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
