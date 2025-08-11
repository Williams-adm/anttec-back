<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Category;
use App\Repositories\Api\v1\Admin\Contracts\CategoryInterface;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
