<?php

namespace App\Services\Api\v1\Admin;

use App\Repositories\Api\v1\Admin\Contracts\BaseInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseService
{
    public function __construct(
        protected BaseInterface $repository,
        protected string $resourceClass,
    ){}

    public function getAll(int $pagination = 15): ResourceCollection
    {
        return $this->resourceClass::collection(
            $this->repository->getAll($pagination)
        );
    }

    public function getById(int $id): JsonResource
    {
        return new $this->resourceClass(
            $this->repository->getById($id)
        );
    }

    public function create(array $data): JsonResource
    {
        return new ($this->resourceClass)(
            $this->repository->create($data)
        );
    }

    public function update(array $data, int $id): JsonResource
    {
        return new ($this->resourceClass)(
            $this->repository->update($data, $id)
        );
    }
}
