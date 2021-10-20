<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\DTO;

use Illuminate\Support\Str;
use App\Ship\Abstracts\DTO\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Containers\UserSection\Users\DTO\Casters\HashCaster;

final class User extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $rememberToken;
    #[CastWith(HashCaster::class)]
    public string $password;

    /**
     * @throws UnknownProperties
     */
    public function __construct(...$args)
    {
        // default values, can be overwritten by args
        $this->rememberToken = Str::random(60);
        $this->password = Str::random();
        parent::__construct($args);
    }

    public function __toString(): string
    {
        return $this->email.'::'.$this->name;
    }
}
