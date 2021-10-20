<?php

declare(strict_types=1);

namespace App\Ship\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\{Model, Builder, Collection};

interface Repository
{
    public function getModelName(): string;
    public function builder(): Builder|Model|OrmModel|static;
    public function newInstance(array $attributes = []): Model|OrmModel;
    public function all(array $columns = ['*']): Collection;
    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator;
    public function create(array $attributes): Model|OrmModel|static;
    public function find(int $id, array $columns = ['*']): Model|OrmModel|static;
    public function findAndSetModel(int|string $id, array $columns = ['*']): Model|OrmModel|static;
    public function update(array $attributes): bool;
    public function destroy(): bool;
}
