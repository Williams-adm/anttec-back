<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Specification;
use App\Repositories\Api\v1\Admin\Contracts\SpecificationInterface;
use Illuminate\Database\Eloquent\Model;

class SpecificationRepository extends BaseRepository implements SpecificationInterface
{
    public function __construct(Specification $model)
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
