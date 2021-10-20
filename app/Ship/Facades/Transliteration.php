<?php

declare(strict_types=1);

namespace App\Ship\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Transliteration
 * @package App\Ship\Facades
 * @method static string latinToCyrillic(string $string)
 * @method static string cyrillicToLatin(string $string)
 *
 * @see \App\Ship\Services\Transliteration\Transliteration
 */
class Transliteration extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'transliteration';
    }
}
