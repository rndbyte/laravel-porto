<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\DTO;

use Illuminate\Support\Str;
use App\Ship\Abstracts\DTO\DataTransferObject;
use App\Containers\UserSection\Users\DTO\Casters\HashCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class Password extends DataTransferObject
{
    #[CastWith(HashCaster::class)]
    public string $password;
    public string $rememberToken;

    /**
     * @throws UnknownProperties
     */
    public function __construct(...$args)
    {
        parent::__construct($args);
        $this->rememberToken = Str::random(60);
    }

    public function __toString(): string
    {
        return 'password hidden';
    }

    public function toArray(): array
    {
        return [];
    }
}
