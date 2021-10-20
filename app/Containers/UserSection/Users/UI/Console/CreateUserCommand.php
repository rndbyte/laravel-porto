<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Users\UI\Console;

use App\Ship\Abstracts\Console\Command;
use App\Containers\UserSection\Users\DTO\User;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Containers\UserSection\Users\Actions\CreateUserAction;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create';
    protected $description = 'Create a new User with';

    /**
     * @throws UnknownProperties
     */
    public function handle(): void
    {
        $username = $this->ask('Enter the username for this user');
        $email = $this->ask('Enter the email address of this user');
        $password = $this->secret('Enter the password for this user');
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

        CreateUserAction::new($dto)->run();

        $this->info('User ' . $email . ' was successfully created');
    }
}
