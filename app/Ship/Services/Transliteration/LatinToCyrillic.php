<?php

declare(strict_types=1);

namespace App\Ship\Services\Transliteration;

use App\Ship\Abstracts\Services\AbstractTransliterationStrategy;

class LatinToCyrillic extends AbstractTransliterationStrategy
{
    public function getAlphabet(): array
    {
        return [
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г',
            'd' => 'д',
            'e' => 'е',
            'io' => 'ё',
            'j' => 'ж',
            'z' => 'з',
            'i' => 'и',
            'y' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'h' => 'х',
            'c' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'sch' => 'щ',
            'yu' => 'ю',
            'ya' => 'я',
            'A' => 'А',
            'B' => 'Б',
            'V' => 'В',
            'G' => 'Г',
            'D' => 'Д',
            'E' => 'Е',
            'IO' => 'Ё',
            'J' => 'Ж',
            'Z' => 'З',
            'I' => 'И',
            'Y' => 'Й',
            'K' => 'К',
            'L' => 'Л',
            'M' => 'М',
            'N' => 'Н',
            'O' => 'О',
            'P' => 'П',
            'R' => 'Р',
            'S' => 'С',
            'T' => 'Т',
            'U' => 'У',
            'F' => 'Ф',
            'H' => 'Х',
            'C' => 'Ц',
            'CH' => 'Ч',
            'SH' => 'Ш',
            'SCH' => 'Щ',
            'YU' => 'Ю',
            'YA' => 'Я',
        ];
    }

    protected function modifyAfterTransliteration(string $transliteratedString): string
    {
        return preg_replace('/[^0-9А-Яа-я-_]/i', '', $transliteratedString);
    }
}
