<?php

namespace App\Services\Api\v1\Admin;

use App\Repositories\Api\v1\Admin\Contracts\SubcategoryInterface;

class SubcategoryService extends BaseService
{
    public function __construct(SubcategoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
