<?php

declare(strict_types=1);

namespace App\Ship\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UploadFile extends Component
{
    public function __construct(public ?string $id)
    {
    }

    public function render(): View
    {
        return view('components::upload-file');
    }
}
