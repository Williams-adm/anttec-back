<?php

namespace App\Services\Api\v1\Admin;

use App\Repositories\Api\v1\Admin\Contracts\CategoryInterface;

class CategoryService extends BaseService
{
    public function __construct(CategoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
