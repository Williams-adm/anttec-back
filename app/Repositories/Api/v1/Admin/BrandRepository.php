<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Brand;
use App\Repositories\Api\v1\Admin\Contracts\BrandInterface;
use Illuminate\Database\Eloquent\Model;

class BrandRepository extends BaseRepository implements BrandInterface
{
    public function __construct(Brand $model)
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
