<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\BrandInterface;
use App\Exceptions\Api\v1\NotFoundException;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseService<BrandInterface>
 */
class BrandService extends BaseService
{
    public function __construct(BrandInterface $repository)
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
