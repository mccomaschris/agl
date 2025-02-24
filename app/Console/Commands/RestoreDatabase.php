<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use function Laravel\Prompts\confirm;

class RestoreDatabase extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'database:restore';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Restore the database from a backup file';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{

		if (app()->environment('production')) {
			$this->warn('You are running this command in production!');
			$confirmed = confirm(
				label: 'Do you really want to run this command in production?',
				default: false,
			);
		}

		if ( ! $confirmed) {
			$this->warn('Command cancelled.');
			return 1; // Exit with error code
		}

		// Database connection credentials from .env
		$database = config('database.connections.mysql.database');
		$username = config('database.connections.mysql.username');
		$password = config('database.connections.mysql.password');
		$host = config('database.connections.mysql.host');
		$backupFile = storage_path('app/public/preseason-2025backup.dump'); // Path to the backup file

		// Check if the backup file exists
		if (!file_exists($backupFile)) {
			$this->error("Backup file not found: $backupFile");
			return 1; // Exit with error code
		}

		$this->info('Restoring database...');

		// Command to execute the MySQL restore
		$command = "mysql -h {$host} -u {$username} --password=\"{$password}\" {$database} < {$backupFile}";

		$process = Process::fromShellCommandline($command);
		$process->setTimeout(300); // Set timeout to 5 minutes

		try {
			$process->mustRun();
			$this->info('Database restored successfully.');
		} catch (ProcessFailedException $exception) {
			$this->error('Database restore failed: ' . $exception->getMessage());
			return 1; // Exit with error code
		}

		return 0; // Exit successfully
	}
}
