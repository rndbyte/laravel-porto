<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

interface TransliterationStrategy
{
    public function isLowerCase(): bool;
    public function getAlphabet(): array;
    public function getSeparator(): string;
    public function setLowerCase(bool $lowerCase): self;
    public function setSeparator(string $separator): self;
    public function transliterate(string $string): string;
}
