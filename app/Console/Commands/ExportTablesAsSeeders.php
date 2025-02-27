<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ExportTablesAsSeeders extends Command
{
    protected $signature = 'export:seeders'; // Accept multiple table names as arguments
    protected $description = 'Export database tables as Laravel seeders';

    public function handle()
    {
        $seedersPath = database_path('seeders');

		$tables = [
			'player_records',
			'players',
			'scores',
			'teams',
			'users',
			'waitlist',
			'weeks',
			'years',
		];

        foreach ($tables as $table) {
            $this->info("Exporting table: $table");

            $records = DB::table($table)->get()->toArray();

            if (empty($records)) {
                $this->warn("No records found in table: $table");
                continue;
            }

			$seederClassName = ucfirst(Str::camel($table)) . 'Seeder';
            $seederFilePath = "$seedersPath/{$seederClassName}.php";

            $seederContent = $this->generateSeederClass($seederClassName, $table, $records);
            File::put($seederFilePath, $seederContent);

            $this->info("Seeder created: $seederFilePath");
        }

        return Command::SUCCESS;
    }

    protected function generateSeederClass($className, $table, $records)
    {
        $data = var_export(json_decode(json_encode($records), true), true);
        $data = str_replace(['array (', ')'], ['[', ']'], $data); // Convert to PHP 7+ array format

        return <<<PHP
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class {$className} extends Seeder
{
    public function run()
    {
        DB::table('{$table}')->insert({$data});
    }
}
PHP;
    }
}
