<?php

declare(strict_types=1);

namespace App\Ship\Abstracts\Repositories;

use Illuminate\Support\LazyCollection;
use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Ship\Contracts\{OrmModel, Repository as RepositoryContract};
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class Repository
 * @package App\Repositories
 * @property \App\Ship\Abstracts\Models\Model|OrmModel|Builder model
 */
abstract class Repository implements RepositoryContract
{
    public function getModelName(): string
    {
        return (string)$this->model;
    }

    public function getModel(): Builder|Model|OrmModel
    {
        return $this->model;
    }

    public function setModel(OrmModel $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function builder(): Builder|Model|OrmModel
    {
        return $this->getModel()->query();
    }

    public function all(array $columns = ['*']): EloquentCollection
    {
        return $this->getModel()->orderBy($this->model->getKeyName())->get($columns);
    }

    public function cursor(array $columns = ['*'], string $order = null): LazyCollection
    {
        return $this->getModel()
            ->select($columns)
            ->orderBy($order ?? $this->model->getKeyName())
            ->cursor();
    }

    public function findByIds(array $ids, array $columns = ['*']): EloquentCollection
    {
        return $this->builder()
            ->whereIn($this->model->getKeyName(), $ids)
            ->orderBy($this->model->getKeyName())
            ->get($columns);
    }

    public function getList(string $column = 'title', string $key = 'id'): SupportCollection
    {
        return $this->builder()
            ->where($this->model->getKeyName(), '>', 0)
            ->orderBy($this->model->getKeyName())
            ->pluck($column, $key);
    }

    public function paginate(int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->getModel()->paginate($perPage, $columns);
    }

    public function create(array $attributes): Model|OrmModel|static
    {
        return $this->getModel()->create($attributes);
    }

    public function find(int|string $id, array $columns = ['*']): Model|OrmModel|static
    {
        return $this->getModel()->findOrFail($id, $columns);
    }

    public function findAndSetModel(int|string $id, array $columns = ['*']): Model|OrmModel|static
    {
        $model = $this->getModel()->findOrFail($id, $columns);
        $this->setModel($model);
        return $this->getModel();
    }

    public function update(array $attributes): bool
    {
        return $this->getModel()->update($attributes);
    }

    public function destroy(): bool
    {
        return true;
    }

    public function newInstance(array $attributes = []): Model|OrmModel
    {
        return $this->getModel()->newInstance($attributes);
    }

    public function combinePivot(SupportCollection $ids, array $pivots = []): SupportCollection
    {
        $pivotArray = [];
        foreach ($pivots as $pivot => $value) {
            $pivotArray += [$pivot => $value];
        }
        $total = $ids->count();
        $filler = array_fill(0, $total, $pivotArray);
        return $ids->combine($filler);
    }
}
