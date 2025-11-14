<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\OptionProductInterface;
use App\Exceptions\Api\v1\NotFoundException;
use Illuminate\Database\Eloquent\Model;

class OptionProductService
{
    public function __construct(
        protected OptionProductInterface $repository
    ) {}

    public function getById(int $id): ?Model
    {
        $model = $this->repository->getById($id);

        if (!$model) {
            throw new NotFoundException();
        }

        return $model;
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function addValues(array $data): Model
    {
        return $this->repository->addValues($data);
    }
}
