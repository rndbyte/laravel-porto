<?php

use Illuminate\Routing\Router;
use App\Containers\UserSection\Users\UI\API\Controllers\{PasswordResetController, PasswordForgotController};

/* @var Router $router */

$router->group(
    ['prefix' => 'user/password', 'middleware' => ['doc.api'], 'as' => 'api.user.password.'],
    static function(Router $router) {
        $router->post('forgot', [PasswordForgotController::class, 'action'])->name('forgot');
        $router->post('reset', [PasswordResetController::class, 'action'])->name('reset');
    }
);
