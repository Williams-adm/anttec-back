<?php

namespace App\Services\Api\v1\Admin;

use App\Exceptions\Api\v1\NotFoundException;
use App\Repositories\Api\v1\Admin\Contracts\BaseInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    public function __construct(
        protected BaseInterface $repository,
    ){}

    public function getAll(int $pagination = 15): LengthAwarePaginator
    {
        return $this->repository->getAll($pagination);
    }

    public function getAllList(): Collection
    {
        return $this->repository->getAllList();
    }

    public function getById(int $id): ?Model
    {
        $model = $this->repository->getById($id);

        if(!$model) {
            throw new NotFoundException();
        }

        return $model;
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(array $data, int $id): ?Model
    {
        $model = $this->repository->update($data, $id);

        if (!$model) {
            throw new NotFoundException();
        }

        return $model;
    }
}
