<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\Repositories;

use App\Containers\UserSection\Users\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Containers\UserSection\Users\DTO\User as UserDTO;
use App\Containers\UserSection\Authentication\Entities\AccountEntity;
use App\Containers\UserSection\Authentication\Mappers\AccountMapper;
use App\Containers\UserSection\Authentication\Exceptions\AccountNotFoundException;

class AccountRepository
{
    public function __construct(protected User $model)
    {
    }

    public static function new(): self
    {
        return new self(resolve(User::class));
    }

    /**
     * @throws AccountNotFoundException
     */
    public function findById(int $accountId): AccountEntity
    {
        $accountOrmEntity = $this->findOrmEntityByColumn('id', $accountId);
        return AccountMapper::mapToDomain($accountOrmEntity);
    }

    /**
     * @throws AccountNotFoundException
     */
    public function findByNickname(string $nickname): AccountEntity
    {
        $accountOrmEntity = $this->findOrmEntityByColumn('name', $nickname);
        return AccountMapper::mapToDomain($accountOrmEntity);
    }

    /**
     * @throws AccountNotFoundException
     */
    public function findByEmail(string $email): AccountEntity
    {
        // TODO test incoming email by regexp
        $accountOrmEntity = $this->findOrmEntityByColumn('email', $email);
        return AccountMapper::mapToDomain($accountOrmEntity);
    }

    /**
     * @throws AccountNotFoundException
     */
    protected function findOrmEntityByColumn(string $column, mixed $value): User
    {
        try {
            /** @var User $accountOrmEntity */
            $accountOrmEntity = $this->model->newQuery()
                ->where($column, $value)
                ->firstOrFail();

            return $accountOrmEntity;
        } catch (ModelNotFoundException $e) {
            throw new AccountNotFoundException($e->getModel(), $e->getCode(), $e);
        }
    }

    /**
     * @throws AccountNotFoundException
     */
    public function update(int $accountId, UserDTO $dto): AccountEntity
    {
        $accountOrmEntity = $this->findOrmEntityByColumn('id', $accountId);
        $accountOrmEntity->update(attributes: $dto->toArray());
        return AccountMapper::mapToDomain($accountOrmEntity);
    }
}
