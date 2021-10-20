<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // admin permissions
        Permission::create(['name' => 'read-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'delete-users']);
    }
}
