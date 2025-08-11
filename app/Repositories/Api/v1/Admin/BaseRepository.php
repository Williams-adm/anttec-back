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

    public function getById(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        $model = $this->model->create($data);
        return $model->refresh();
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);
        return $model;
    }
}
