<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Actions;

use App\Ship\Contracts\Action;
use Spatie\Permission\Models\Role;
use App\Containers\UserSection\Authorization\Repositories\RoleRepository;
use App\Containers\UserSection\Authorization\Repositories\PermissionRepository;

class AttachPermissionToRoleAction implements Action
{
    /**
     * AttachPermissionToRoleAction constructor.
     * @param int $roleId
     * @param int[] $permissionIds
     */
    public function __construct(
        private int $roleId,
        private array $permissionIds,
    )
    {
    }

    public static function new(int $roleId, int ...$permissionIds): self
    {
        return new self($roleId, $permissionIds);
    }

    public function run(): Role
    {
        /** @var Role $role */
        $role = FindRoleAction::new($this->roleId, RoleRepository::new())->run();

        $permissions = array_map(static function ($permissionId) {
            return FindPermissionAction::new($permissionId, PermissionRepository::new())->run();
        }, $this->permissionIds);

        return $role->givePermissionTo($permissions);
    }
}
