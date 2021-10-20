<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\DTO;

use App\Ship\Abstracts\DTO\DataTransferObject;
use App\Containers\UserSection\Authentication\Contracts\Credentials;

class WebCredentials extends DataTransferObject implements Credentials
{
    public string $email;
    public string $password;
    public bool $remember;
}
