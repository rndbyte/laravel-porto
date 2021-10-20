<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Actions;

use App\Ship\Contracts\Action;
use App\Ship\Contracts\OrmModel;
use Illuminate\Database\Eloquent\Model;
use App\Containers\UserSection\Authorization\Repositories\RoleRepository;

class FindRoleAction implements Action
{
    public function __construct(
        private int $roleId,
        private RoleRepository $repository,
    )
    {
    }

    public static function new(int $roleId, RoleRepository $repository): self
    {
        return new self($roleId, $repository);
    }

    public function run(): Model|RoleRepository|OrmModel
    {
        return $this->repository->find($this->roleId);
    }
}
