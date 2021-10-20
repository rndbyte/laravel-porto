<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    private array $seeders = [];

    public function run(): void
    {
        $seeders = array_merge($this->seeders, $this->mapContainersSeeders());
        $this->call($seeders);
    }

    protected function mapContainersSeeders(): array
    {
        $seedersList = [];
        foreach ($this->loadSectionDirectories() as $sectionPath) {
            foreach ($this->loadDirectories($sectionPath) as $containerPath) {
                $containerNamespace = $this->getContainerNamespace($containerPath);
                $containerProvider = $containerNamespace . '\Providers\ServiceProvider';

                if (empty(app()->getProviders($containerProvider))) {
                    continue;
                }

                $seedersDirectory = $containerPath . DIRECTORY_SEPARATOR . 'Seeders';
                if (
                    File::isDirectory($seedersDirectory) &&
                    collect(File::files($seedersDirectory))->isNotEmpty()
                ) {
                    foreach (glob($seedersDirectory.'/*.php') as $file) {
                        $seeder = $containerNamespace . '\\Seeders\\' . basename($file, '.php');
                        if (class_exists($seeder)) {
                            $seedersList[] = $seeder;
                        }
                    }
                }
            }
        }
        return $seedersList;
    }

    protected function loadSectionDirectories(): array
    {
        return File::directories(app_path('Containers'));
    }

    protected function loadDirectories(string $path): array
    {
        return File::directories($path);
    }

    protected function getContainerNamespace(string $containerPath): string
    {
        $containerPathSegments = explode('/', $containerPath);
        [$sectionName, $containerName] = array_slice($containerPathSegments, -2);
        return 'App\Containers\\' . $sectionName . '\\' . $containerName;
    }
}
