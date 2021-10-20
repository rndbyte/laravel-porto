<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Actions;

use Illuminate\Database\Eloquent\Model;
use App\Ship\Contracts\{Action, OrmModel};
use App\Containers\UserSection\Authorization\Repositories\PermissionRepository;

class FindPermissionAction implements Action
{
    public function __construct(
        private int $permissionId,
        private PermissionRepository $repository,
    )
    {
    }

    public static function new(int $permissionId, PermissionRepository $repository): self
    {
        return new self($permissionId, $repository);
    }

    public function run(): Model|PermissionRepository|OrmModel
    {
        return $this->repository->find($this->permissionId);
    }
}
