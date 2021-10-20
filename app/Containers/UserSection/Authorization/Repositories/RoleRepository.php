<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Repositories;

use Spatie\Permission\Models\Role;
use App\Ship\Abstracts\Repositories\Repository as AbstractRepository;

class RoleRepository extends AbstractRepository
{
    public function __construct(private Role $model)
    {
    }

    public static function new(): self
    {
        return new self(resolve(Role::class));
    }
}
