<?php

use Illuminate\Routing\Router;
use App\Containers\UserSection\Authentication\UI\API\Controllers\AuthenticationController;

/* @var Router $router */

$router->post('login', [AuthenticationController::class, 'login'])
    ->name('api.login.attempt')
    ->middleware('guest');

$router->post('logout', [AuthenticationController::class, 'logout'])
    ->name('api.logout')
    ->middleware('auth');
