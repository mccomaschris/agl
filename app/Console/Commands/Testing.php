<?php

namespace App\Console\Commands;

use App\Jobs\UpdateHandicaps;
use App\Jobs\UpdatePlayerStats;
use App\Jobs\UpdateRecordVsOpponents;
use App\Jobs\UpdateRoundStats;
use App\Models\Year;
use App\Models\Week;
use App\Models\Score;
use App\Models\Player;
use Illuminate\Console\Command;

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
        $scores = Score::where('score_type', 'weekly_score')->where('foreign_key', 163)->get();

        foreach ( $scores as $score ) {
            $player = Player::find($score->player_id);
            $year = Year::find($player->year_id);

            UpdateRoundStats::withChain([
                new UpdatePlayerStats($score->player),
                new UpdateHandicaps($score->player),
                new UpdateRecordVsOpponents($year)
            ])->dispatch($score);
        }
	}
}
