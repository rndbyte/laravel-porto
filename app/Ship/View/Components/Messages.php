<?php

declare(strict_types=1);

namespace App\Ship\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Messages extends Component
{
    public function render(): View
    {
        return view('components::messages');
    }
}
