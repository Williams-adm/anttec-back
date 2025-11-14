<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\SpecificationInterface;
use App\Exceptions\Api\v1\NotFoundException;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseService<SpecificationInterface>
 */
class SpecificationService extends BaseService
{
    public function __construct(SpecificationInterface $repository)
    {
        parent::__construct($repository);
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
