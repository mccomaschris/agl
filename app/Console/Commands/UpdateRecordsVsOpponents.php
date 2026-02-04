<?php

namespace App\Console\Commands;

use App\Jobs\UpdateRecordVsOpponents;
use App\Models\Year;
use Illuminate\Console\Command;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;

class UpdateRecordsVsOpponents extends Command
{
    protected $signature = 'agl:update-records';

    protected $description = 'Calculate head-to-head records for all players in a year';

    public function handle(): int
    {
        $years = Year::orderBy('name', 'desc')->pluck('name', 'id')->toArray();

        if (empty($years)) {
            $this->error('No years found.');

            return self::FAILURE;
        }

        $yearId = select(
            label: 'Which year do you want to update records for?',
            options: $years,
        );

        $year = Year::find($yearId);

        $playerCount = $year->players()->count();

        $confirmed = confirm(
            label: "Update head-to-head records for {$year->name} ({$playerCount} players)?",
            default: true,
        );

        if (! $confirmed) {
            $this->info('Cancelled.');

            return self::SUCCESS;
        }

        $this->info("Calculating records for {$year->name}...");

        UpdateRecordVsOpponents::dispatchSync($year);

        $this->info('Done! Player records have been updated.');

        return self::SUCCESS;
    }
}
