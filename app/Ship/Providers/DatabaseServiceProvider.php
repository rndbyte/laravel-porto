<?php

declare(strict_types=1);

namespace App\Ship\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->mapContainersMigrations();
    }

    private function mapContainersMigrations(): void
    {
        $containerProviders = collect(config('app.providers'))
            ->filter(fn($provider) => str_contains($provider, 'App\Containers\\'))
            ->flip()
            ->toArray();

        foreach ($this->loadSectionDirectories() as $sectionPath) {
            foreach ($this->loadDirectories($sectionPath) as $containerPath) {
                $containerNamespace = $this->getContainerNamespace($containerPath);
                $containerProvider = $containerNamespace . '\Providers\ServiceProvider';

                if (empty($this->app->getProviders($containerProvider))) {
                    continue;
                }

                $migrationsDirectory = $containerPath . DIRECTORY_SEPARATOR . 'Migrations';
                if (is_dir($migrationsDirectory) === false) {
                    unset($containerProviders[$containerProvider]);
                    continue;
                }
                $containerProviders[$containerProvider] = $migrationsDirectory;
            }
        }

        $paths = collect([database_path('migrations')])
            ->merge(collect($containerProviders)->values())
            ->toArray();
        $this->loadMigrationsFrom($paths);
    }

    private function loadSectionDirectories(): array
    {
        return File::directories(app_path('Containers'));
    }

    private function loadDirectories(string $path): array
    {
        return File::directories($path);
    }

    private function getContainerNamespace(string $containerPath): string
    {
        $containerPathSegments = explode('/', $containerPath);
        [$sectionName, $containerName] = array_slice($containerPathSegments, -2);
        return 'App\Containers\\' . $sectionName . '\\' . $containerName;
    }
}
