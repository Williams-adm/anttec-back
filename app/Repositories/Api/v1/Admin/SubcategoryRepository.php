<?php

namespace App\Repositories\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\SubcategoryInterface;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryRepository extends BaseRepository implements SubcategoryInterface
{
    public function __construct(Subcategory $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data)->refresh();
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->getById($id);
        $model->update($data);
        return $model->refresh();
    }
}
