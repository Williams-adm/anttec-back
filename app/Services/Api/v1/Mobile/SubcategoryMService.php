<?php

namespace App\Services\Api\v1\Mobile;

use App\Contracts\Api\v1\Mobile\SubcategoryMInterface;
use Illuminate\Database\Eloquent\Collection;

class SubcategoryMService
{
    public function __construct(
        protected SubcategoryMInterface $repository
    ) {}

    public function getAllList(): Collection
    {
        return $this->repository->getAllList();
    }
}
