<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Role $admin */
        $admin = Role::create(['name' => 'admin']);
        /** @var Role $user */
        $user = Role::create(['name' => 'user']);

        $admin->givePermissionTo('read-users');
        $admin->givePermissionTo('edit-users');
        $admin->givePermissionTo('create-users');
        $admin->givePermissionTo('delete-users');
    }
}
