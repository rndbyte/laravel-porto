<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

abstract class ApiController extends BaseController
{
    public function needAccept(): Response
    {
        return response('The server requires a header "Accept"', Response::HTTP_BAD_REQUEST);
    }
}
