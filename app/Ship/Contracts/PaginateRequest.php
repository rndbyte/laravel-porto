<?php

namespace App\Ship\Contracts;

interface PaginateRequest
{
    public function getLimit(): ?int;
    public function getOffset(): ?int;
}
