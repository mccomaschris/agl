<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FindUnusedControllers extends Command
{
    protected $signature = 'cleanup:unused-controllers';
    protected $description = 'Find unused controllers in the Laravel application';

    public function handle()
    {
        ini_set('memory_limit', '-1'); // Increase memory limit if needed

        $controllerPath = app_path('Http/Controllers');
        $controllers = collect(File::allFiles($controllerPath))
            ->map(fn ($file) => str_replace(['.php', '/'], ['', '\\'], 'App\\Http\\Controllers\\' . $file->getRelativePathname()))
            ->map(fn ($class) => str_replace('\\\\', '\\', $class));

        // Define directories to search, excluding large ones
        $searchPaths = [
            app_path(),
            resource_path('views'),
            base_path('routes'),
        ];

        $references = collect();

        foreach ($searchPaths as $path) {
            $files = File::allFiles($path);

            foreach ($files as $file) {
                $content = file_get_contents($file->getRealPath());
                foreach ($controllers as $controller) {
                    if (str_contains($content, class_basename($controller)) || str_contains($content, $controller)) {
                        $references->push($controller);
                    }
                }
            }
        }

        $unusedControllers = $controllers->diff($references->unique());

        if ($unusedControllers->isEmpty()) {
            $this->info('No unused controllers found.');
        } else {
            $this->warn("Unused Controllers:\n" . $unusedControllers->implode("\n"));
        }
    }
}
