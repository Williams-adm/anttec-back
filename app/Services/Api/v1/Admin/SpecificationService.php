<?php

namespace App\Services\Api\v1\Admin;

use App\Repositories\Api\v1\Admin\Contracts\SpecificationInterface;

class SpecificationService extends BaseService
{
    public function __construct(SpecificationInterface $repository)
    {
        parent::__construct($repository);
    }
}
