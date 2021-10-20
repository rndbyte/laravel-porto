<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\Seeders;

use Illuminate\Database\Seeder;
use App\Containers\UserSection\Users\DTO\User;
use App\Containers\UserSection\Users\Actions\{CreateAdminAction, CreateUserAction};

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminDto = new User(
            email: 'testadmin@example.com',
            name: 'admin',
            password: 'testadmin123',
        );
        $userDto = new User(
            email: 'testuser@example.com',
            name: 'testuser',
            password: 'testuser123',
        );

        CreateAdminAction::new($adminDto)->run();
        CreateUserAction::new($userDto)->run();
    }
}
