<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Services;

use App\Ship\Contracts\TransliterationStrategy;

abstract class AbstractTransliterationStrategy implements TransliterationStrategy
{
    public function __construct(
        private string $separator = '-',
        private bool $lowerCase = true,
    )
    {
    }

    public function isLowerCase(): bool
    {
        return $this->lowerCase;
    }

    public function getSeparator(): string
    {
        return $this->separator;
    }

    public function setLowerCase(bool $lowerCase): self
    {
        $this->lowerCase = $lowerCase;
        return $this;
    }

    public function setSeparator(string $separator): self
    {
        $this->separator = $separator;
        return $this;
    }

    public function transliterate(string $string): string
    {
        $transliteratedString = strtr(
            $this->clearAndPrepareString($string),
            $this->getAlphabet(),
        );

        $transliteratedString = $this->handleWordsSeparation($transliteratedString);

        return $this->modifyAfterTransliteration($transliteratedString);
    }

    protected function clearAndPrepareString(string $string): string
    {
        $preparedString = strip_tags($string);
        $preparedString = str_replace(["\n", "\r"], ' ', $preparedString);
        $preparedString = preg_replace('/ +/', ' ', $preparedString);
        $preparedString = trim($preparedString);

        if ($this->isLowerCase())
            $preparedString = $this->getStringLowerCase($preparedString);

        return $preparedString;
    }

    protected function getStringLowerCase(string $string): string
    {
        return function_exists('mb_strtolower') ? mb_strtolower($string) : strtolower($string);
    }

    protected function handleWordsSeparation(string $string): string
    {
        return str_replace(' ', $this->getSeparator(), $string);
    }

    abstract protected function modifyAfterTransliteration(string $transliteratedString): string;
}
