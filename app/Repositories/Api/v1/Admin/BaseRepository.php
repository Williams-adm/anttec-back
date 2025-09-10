<?php

namespace App\Repositories\Api\v1\Admin;

use App\Repositories\Api\v1\Admin\Contracts\BaseInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseInterface
{
    public function __construct(
        protected Model $model
    ){}

    public function getAll(int $pagination): LengthAwarePaginator
    {
        return $this->model->paginate($pagination);
    }

    public function getById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data)->refresh();
    }

    public function update(array $data, int $id): ?Model
    {
        $model = $this->model->find($id);

        if ($model) {
            $model->update($data);
        }

        return $model;
    }
}
