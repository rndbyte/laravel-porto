<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadViewsFrom(dirname(__DIR__) . '/UI/WEB/Views', 'users');
        $this->loadTranslationsFrom(dirname(__DIR__) . '/Lang', 'users');
    }
}
