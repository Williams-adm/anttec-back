<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\OptionValueInterface;
use App\Exceptions\Api\v1\NotFoundException;
use Illuminate\Database\Eloquent\Model;

class OptionValueService
{
    public function __construct(
        protected OptionValueInterface $repository
    ){ }

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
}
