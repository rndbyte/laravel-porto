<?php

use Illuminate\Routing\Router;
use App\Containers\UserSection\Users\UI\WEB\Controllers\UserController;

/* @var Router $router */

$router->get('user', [UserController::class, 'getMe'])
    ->middleware('auth')
    ->name('user.me');
