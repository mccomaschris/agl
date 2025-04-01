<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FindUnusedBladeTemplates extends Command
{
    protected $signature = 'cleanup:unused-views';
    protected $description = 'Find unused Blade templates in the Laravel application';

    public function handle()
    {
        $viewsPath = resource_path('views');
        $views = collect(File::allFiles($viewsPath))
            ->map(fn ($file) => str_replace(['.blade.php', '/'], ['', '.'], $file->getRelativePathname()));

        $references = collect(File::allFiles(base_path()))
            ->flatMap(fn ($file) => file($file->getRealPath()))
            ->filter(fn ($line) => preg_match('/(\'|")([a-zA-Z0-9_.-]+)(\'|")/', $line))
            ->implode("\n");

        $unusedViews = $views->reject(fn ($view) => str_contains($references, $view));

        if ($unusedViews->isEmpty()) {
            $this->info('No unused Blade templates found.');
        } else {
            $this->warn("Unused Blade Templates:\n" . $unusedViews->implode("\n"));
        }
    }
}
