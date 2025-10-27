<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Specification;
use App\Repositories\Api\v1\Admin\Contracts\SpecificationInterface;

class SpecificationRepository extends BaseRepository implements SpecificationInterface
{
    public function __construct(Specification $model)
    {
        parent::__construct($model);
    }
}
