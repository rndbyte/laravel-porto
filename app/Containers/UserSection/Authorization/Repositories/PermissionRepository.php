<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Repositories;

use Spatie\Permission\Models\Permission;
use App\Ship\Abstracts\Repositories\Repository as AbstractRepository;

class PermissionRepository extends AbstractRepository
{
    public function __construct(private Permission $model)
    {
    }

    public static function new(): self
    {
        return new self(resolve(Permission::class));
    }
}
