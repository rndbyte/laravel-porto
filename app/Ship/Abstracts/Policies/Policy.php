<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

abstract class Policy
{
    use HandlesAuthorization;
}
