<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

interface Cache
{
    public const EXPIRE_DAY = 24 * 60 * 60; # 24 часа
    public const EXPIRE_WEEK = self::EXPIRE_DAY * 7; # неделя
    public const EXPIRE_HALF_DAY = self::EXPIRE_DAY / 2; # 12 часов
    public const EXPIRE_QUARTER_DAY = self::EXPIRE_DAY / 4; # 6 часов

    public function setToCache(string $key, string $payload, int $ttl = self::EXPIRE_DAY): void;

    public function getFromCache(string $key): array|null;
}
