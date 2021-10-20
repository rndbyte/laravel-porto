<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Composers;

use Illuminate\Contracts\View\View;

abstract class Composer
{
    abstract public function compose(View $view): void;
}
