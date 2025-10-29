<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Category;
use App\Repositories\Api\v1\Admin\Contracts\CategoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data)->refresh();
    }

    public function update(array $data, int $id): ?Model
    {
        $model = $this->model->find($id);

        if (!$model) {
            return null;
        }

        $model->update($data);
        return $model;
    }
}
