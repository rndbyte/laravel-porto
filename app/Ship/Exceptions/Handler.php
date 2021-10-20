<?php

declare(strict_types=1);

namespace App\Ship\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(
            static function (Throwable $e) {
            }
        );
    }

    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);
        if ($response->status() === 419) {
            return back()->with(['message' => 'The page expired, please try again.']);
        }
        return $response;
    }
}
