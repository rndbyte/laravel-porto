<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\DTO;

use Illuminate\Support\Carbon;
use App\Ship\Abstracts\DTO\DataTransferObject;

class SocialUser extends DataTransferObject
{
    public string $token;
    public string $refreshToken;
    public Carbon $tokenExpiresAt;
    public string $provider_id;
    public string $nickname;
    public string $name;
    public string $email;
    public string $avatar;

    public function __toString(): string
    {
        return $this->provider_id.'::'.$this->nickname;
    }
}
