<?php

namespace App\Services\Api\v1\Admin;

use App\Http\Resources\Api\v1\Admin\ProductResource;
use App\Repositories\Api\v1\Admin\Contracts\ProductInterface;

class ProductService extends BaseService
{
    public function __construct(ProductInterface $repository)
    {
        parent::__construct($repository, ProductResource::class);
    }
}
