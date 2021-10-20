<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

use Stringable;

interface DataTransferObject extends Stringable
{
    public function toArray(): array;
    public function __toString(): string;
}
