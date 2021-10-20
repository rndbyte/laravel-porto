<?php

use Illuminate\Routing\Router;
use App\Containers\UserSection\Users\UI\WEB\Controllers\UserController;

/* @var Router $router */

$router->group(
    ['prefix' => 'users', 'middleware' => ['auth', 'admin'], 'as' => 'admin.users.'],
    static function (Router $router) {
        $router->get('/', [UserController::class, 'index'])->name('index');
    }
);
