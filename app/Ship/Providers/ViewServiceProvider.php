<?php

declare(strict_types=1);

namespace App\Ship\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;
use App\Ship\View\Components\{Messages, EmptyList, Calendars, UploadFile};

class ViewServiceProvider extends ServiceProvider
{
    private Factory $views;

    public function boot(Factory $viewFactory): void
    {
        $this->views = $viewFactory;
        $this->loadViewsFrom(resource_path('views/components'), 'components');
        Blade::component('empty-list', EmptyList::class);
        Blade::component('flash-messages', Messages::class);
        Blade::component('calendars', Calendars::class);
        Blade::component('upload-file', UploadFile::class);
    }

    private function compose(array|string $views, string $viewComposer): void
    {
        $this->app->singleton($viewComposer);
        $this->views->composer($views, $viewComposer);
    }
}
