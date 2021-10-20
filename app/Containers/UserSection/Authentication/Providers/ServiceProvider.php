<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Containers\UserSection\Authentication\Services\Social\{GithubService, SocialAccountServiceImp,};
use App\Containers\UserSection\Authentication\Contracts\UseCases\{LoginUser, LogoutUser, LoginSocialUser};
use App\Containers\UserSection\Authentication\Contracts\{OAuthService, AccountService, SocialAccountService};
use App\Containers\UserSection\Authentication\Actions\{ApiLoginAction,
    WebLoginAction,
    ApiLogoutAction,
    WebLogoutAction};
use App\Containers\UserSection\Authentication\Services\{AccountServiceImp,
    ApiAuthenticationService,
    WebAuthenticationService,
    SocialAuthenticationService,};

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->when(ApiLoginAction::class)
            ->needs(LoginUser::class)
            ->give(ApiAuthenticationService::class);

        $this->app->when(ApiLogoutAction::class)
            ->needs(LogoutUser::class)
            ->give(ApiAuthenticationService::class);

        $this->app->when(WebLoginAction::class)
            ->needs(LoginUser::class)
            ->give(WebAuthenticationService::class);

        $this->app->when(WebLogoutAction::class)
            ->needs(LogoutUser::class)
            ->give(WebAuthenticationService::class);

        $this->app->singleton(
            LoginSocialUser::class,
            SocialAuthenticationService::class,
        );
        $this->app->singleton(
            OAuthService::class,
            GithubService::class,
        );
        $this->app->singleton(
            AccountService::class,
            AccountServiceImp::class,
        );
        $this->app->singleton(
            SocialAccountService::class,
            SocialAccountServiceImp::class,
        );
    }

    public function boot(): void
    {
        $this->loadViewsFrom(dirname(__DIR__) . '/UI/WEB/Views', 'authentication');
        $this->loadTranslationsFrom(dirname(__DIR__) . '/Lang', 'authentication');
    }
}
