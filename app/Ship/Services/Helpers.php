<?php

declare(strict_types=1);

namespace App\Ship\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Carbon\Exceptions\InvalidDateException;

class Helpers
{
    public function __construct(private Request $request)
    {
    }

    public function period(): array
    {
        $from = $this->request->input('from');
        $to = $this->request->input('to');
        try {
            if (!empty($from) && !empty($to)) {
                return [
                    Carbon::make($from),
                    Carbon::make($to)?->endOfDay(),
                ];
            }
            if (!empty($from) && empty($to)) {
                return [
                    Carbon::make($from),
                    now()->endOfDay(),
                ];
            }
            if (empty($from) && !empty($to)) {
                return [
                    Carbon::make($from)?->startOfDay(),
                    Carbon::make($to)?->endOfDay(),
                ];
            }
        } catch (InvalidDateException $exception) {
        }
        return [
            now()->startOfDay(),
            now()->endOfDay(),
        ];
    }

    public function multiSort(array $array, string $key, bool $reverse = false): array
    {
        usort(
            $array,
            static function ($a, $b) use ($key) {
                return strnatcmp($a[$key], $b[$key]);
            }
        );
        return $reverse ? array_reverse($array) : $array;
    }

    public function pluralWords(string $string, int $num): ?string
    {
        if (empty($string)) {
            return null;
        }
        $words = explode('|', $string);
        if (count($words) === 3) {
            [$formFor1, $formFor2, $formFor3] = $words;
            $num = abs($num) % 100;
            $numX = $num % 10;
            if ($num > 10 && $num < 20) {
                return $formFor3;
            }
            if ($numX > 1 && $numX < 5) {
                return $formFor2;
            }
            if ($numX === 1) {
                return $formFor1;
            }
            return $formFor3;
        }
        return implode('|', $words);
    }

    public function ucFirsts(string $string, $encoding = 'UTF-8'): ?string
    {
        if (!empty($string)) {
            $string = mb_strtolower(trim($string));
            $string = mb_ereg_replace('\s\s+', ' ', $string);
            $strings = [];
            foreach (explode(' ', $string) as $subString) {
                $strings[] =
                    mb_strtoupper(mb_substr($subString, 0, 1, $encoding), $encoding).
                    mb_substr($subString, 1, mb_strlen($subString), $encoding);
            }
            return trim(implode(' ', $strings));
        }
        return null;
    }

    public function mb_ucFirst(string $string): string
    {
        $fc = mb_strtoupper(mb_substr($string, 0, 1));
        return $fc.mb_substr($string, 1);
    }

    public function stringIsEqual(string $string1, string $string2): bool
    {
        return md5($string1) === md5($string2);
    }

    public function intIsEqual(mixed $numeric1, mixed $numeric2): bool
    {
        return (int)$numeric1 === (int)$numeric2;
    }

    public function objectToArray(mixed $obj): array
    {
        $rc = (array)$obj;
        foreach ($rc as $key => $item) {
            $rc[$key] = (is_string($item) || is_numeric($item)) ? $item : (array)$item;
            if (is_array($rc[$key]) || is_object($rc[$key])) {
                foreach ($rc[$key] as $keys => $items) {
                    if (is_array($rc[$key][$keys]) || is_object($rc[$key][$keys])) {
                        $rc[$key][$keys] = $this->objectToArray($items);
                    } else {
                        $rc[$key][$keys] = $items;
                    }
                }
            }
        }
        return $rc;
    }

    public function randomColor(bool $hex = false): string
    {
        return
            ($hex ? '#' : '').
            str_pad(dechex(random_int(0, 255)), 2, '0', STR_PAD_LEFT).
            str_pad(dechex(random_int(0, 255)), 2, '0', STR_PAD_LEFT).
            str_pad(dechex(random_int(0, 255)), 2, '0', STR_PAD_LEFT);
    }
}
