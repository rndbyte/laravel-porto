<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\UI\Console;

use App\Ship\Abstracts\Console\Command;
use App\Containers\UserSection\Users\DTO\User;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Containers\UserSection\Users\Actions\CreateAdminAction;

class CreateAdminCommand extends Command
{
    protected $signature = 'user:create:admin';
    protected $description = 'Create a new User with the ADMIN role';

    /**
     * @throws UnknownProperties
     */
    public function handle(): void
    {
        $username = $this->ask('Enter the username for this admin');
        $email = $this->ask('Enter the email address of this admin');
        $password = $this->secret('Enter the password for this admin');
        $passwordConfirmation = $this->secret('Please confirm the password');

        if ($password !== $passwordConfirmation) {
            $this->error('Passwords do not match - exiting!');
            return;
        }

        $dto = new User(
            email: $email,
            name: $username,
            password: $password,
        );

        CreateAdminAction::new($dto)->run();

        $this->info('Admin ' . $email . ' was successfully created');
    }
}
