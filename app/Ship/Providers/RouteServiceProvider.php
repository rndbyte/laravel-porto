<?php

namespace App\Ship\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->mapGlobalRoutes();
        $this->mapContainerRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Configure global routes.
     *
     * @return void
     */
    protected function mapGlobalRoutes(): void
    {
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure container routes.
     *
     * @return void
     */
    protected function mapContainerRoutes(): void
    {
        foreach ($this->loadSectionDirectories() as $sectionPath) {
            foreach ($this->loadDirectories($sectionPath) as $containerPath) {
                $containerNamespace = $this->getContainerNamespace($containerPath);
                $containerProvider = $containerNamespace . '\Providers\ServiceProvider';

                if (empty($this->app->getProviders($containerProvider))) {
                    continue;
                }

                $this->registerWebRoutes($containerPath . '/UI/WEB/Routes/web.php', $containerNamespace);
                $this->registerAdminRoutes($containerPath . '/UI/WEB/Routes/admin.php', $containerNamespace);
                $this->registerApiRoutes($containerPath . '/UI/API/Routes/api.php', $containerNamespace);
            }
        }
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

    protected function registerWebRoutes(string $filePath, string $containerNamespace): void
    {
        if (file_exists($filePath)) {
            Route::middleware('web')
                ->namespace($containerNamespace . '\UI\WEB\Controllers')
                ->group($filePath);
        }
    }

    protected function registerAdminRoutes(string $filePath, string $containerNamespace): void
    {
        if (file_exists($filePath)) {
            Route::middleware('web')
                ->namespace($containerNamespace . '\UI\WEB\Controllers')
                ->prefix('/')
                ->group($filePath);
        }
    }

    protected function registerApiRoutes(string $filePath, string $containerNamespace): void
    {
        if (file_exists($filePath)) {
            Route::middleware('api')
                ->namespace($containerNamespace . '\UI\API\Controllers')
                ->prefix('api/v1')
                ->group($filePath);
        }
    }
}
