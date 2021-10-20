<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\DTO\Casters;

use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\Caster;

final class HashCaster implements Caster
{
    public function cast(mixed $value): string
    {
        return Hash::make($value);
    }
}
