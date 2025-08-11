<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Subcategory;
use App\Repositories\Api\v1\Admin\Contracts\SubcategoryInterface;

class SubcategoryRepository extends BaseRepository implements SubcategoryInterface
{
    public function __construct(Subcategory $model)
    {
        parent::__construct($model);
    }
}
