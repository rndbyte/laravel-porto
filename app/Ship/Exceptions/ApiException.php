<?php

declare(strict_types=1);

namespace App\Ship\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ApiException extends Exception
{
    public function __construct($message = "")
    {
        parent::__construct(
            message: $message,
            code: $code = Response::HTTP_BAD_REQUEST,
            previous: $previous = null
        );
    }
}
