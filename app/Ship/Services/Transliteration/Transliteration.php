<?php

declare(strict_types=1);

namespace App\Ship\Services\Transliteration;

use App\Ship\Contracts\TransliterationStrategy;

class Transliteration
{
    public function __construct(
        private TransliterationStrategy $latinToCyrillicStrategy,
        private TransliterationStrategy $cyrillicToLatinStrategy,
    )
    {
    }

    public function latinToCyrillic(string $string): string
    {
        return $this->latinToCyrillicStrategy->setSeparator(' ')->transliterate($string);
    }

    public function cyrillicToLatin(string $string): string
    {
        return $this->cyrillicToLatinStrategy->setSeparator('-')->transliterate($string);
    }
}
