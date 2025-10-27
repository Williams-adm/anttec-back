<?php

namespace App\Services\Api\v1\Admin;

use App\Repositories\Api\v1\Admin\Contracts\BrandInterface;

class BrandService extends BaseService
{
    public function __construct(BrandInterface $repository)
    {
        parent::__construct($repository);
    }
}
