<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\UI\WEB\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Containers\UserSection\Users\Repositories\UserRepository;
use App\Ship\Abstracts\Controllers\Controller as AbstractController;

class UserController extends AbstractController
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function index(Request $request): View
    {
        return view('admin');
    }

    public function getMe(Request $request)
    {
        return $request->user();
    }
}
