<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Brand;
use App\Repositories\Api\v1\Admin\Contracts\BrandInterface;

class BrandRepository extends BaseRepository implements BrandInterface
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }
}
