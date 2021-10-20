<?php

declare(strict_types=1);

namespace App\Ship\Facades;

use Illuminate\Support\{Carbon, Facades\Facade};

/**
 * Class Helper
 * @package App\Ship\Facades
 * @see \App\Ship\Services\Helpers
 * @method static array|Carbon[] period()
 * @method static array multiSort(array $array, string $key, bool $reverse = false)
 * @method static string|null pluralWords(string $string, int $num)
 * @method static string|null ucFirsts(string $string, $encoding = 'UTF-8')
 * @method static string randomColor(bool $hex = false)
 * @method static string mb_ucFirst(string $string)
 * @method static bool stringIsEqual(string $string1, string $string2)
 * @method static bool intIsEqual(mixed $numeric1, mixed $numeric2)
 * @method static array objectToArray(mixed $obj)
 */
class Helper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'helpers_service';
    }
}
