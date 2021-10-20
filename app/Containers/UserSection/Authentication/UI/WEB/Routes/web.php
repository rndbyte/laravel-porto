<?php

use Illuminate\Routing\Router;
use App\Containers\UserSection\Authentication\UI\WEB\Controllers\{AuthenticationController, GithubController};

/* @var Router $router */

$router->group(
    ['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'],
    static function(Router $router) {
        $router->get('', [AuthenticationController::class, 'index'])->name('index');
        $router->post('', [AuthenticationController::class, 'login'])->name('attempt');
        $router->group(
            ['prefix' => 'github', 'as' => 'github.'],
            static function(Router $router) {
                $router->get('', [GithubController::class, 'oauth'])->name('oauth');
                $router->get('redirect', [GithubController::class, 'auth'])->name('redirect');
            }
        );
    }
);

$router->post('logout', [AuthenticationController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// TODO add throttle here
$router->get('login/status', [AuthenticationController::class, 'status'])
    ->name('login.status');
