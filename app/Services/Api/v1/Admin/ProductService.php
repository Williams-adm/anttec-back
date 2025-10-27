<?php

namespace App\Services\Api\v1\Admin;

use App\Repositories\Api\v1\Admin\Contracts\ProductInterface;

class ProductService extends BaseService
{
    public function __construct(ProductInterface $repository)
    {
        parent::__construct($repository);
    }
}
