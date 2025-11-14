<?php

namespace App\Services\Api\v1\Mobile;

use App\Contracts\Api\v1\Mobile\CategoryMInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryMService
{
    public function __construct(
        protected CategoryMInterface $repository
    ){ }

    public function getAllList(): Collection
    {
        return $this->repository->getAllList();
    }
}
