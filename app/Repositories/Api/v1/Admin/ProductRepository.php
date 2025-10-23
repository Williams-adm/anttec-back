<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Product;
use App\Repositories\Api\v1\Admin\Contracts\ProductInterface;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
