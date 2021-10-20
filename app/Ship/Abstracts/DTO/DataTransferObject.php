<?php

namespace App\Ship\Abstracts\DTO;

use App\Ship\Contracts\DataTransferObject as DTOContract;
use Spatie\DataTransferObject\DataTransferObject as SpatieDTO;

abstract class DataTransferObject extends SpatieDTO implements DTOContract
{
    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
