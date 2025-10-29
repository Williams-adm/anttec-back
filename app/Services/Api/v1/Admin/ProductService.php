<?php

namespace App\Services\Api\v1\Admin;

use App\Exceptions\Api\v1\InternalServerErrorException;
use App\Exceptions\Api\v1\NotFoundException;
use App\Repositories\Api\v1\Admin\Contracts\ProductInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * @extends BaseService<ProductInterface>
 */
class ProductService extends BaseService
{
    public function __construct(ProductInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(array $data, int $id): ?Model
    {
        try{
            $productData = Arr::only($data, [
                'name',
                'description',
                'status',
                'subcategory_id',
                'brand_id',
            ]);

            $specificationsData = Arr::only($data, ['specifications']);

            $model = $this->repository->update($productData, $specificationsData,$id);

            if (!$model) {
                throw new NotFoundException();
            }

            return $model;
        } catch (\Exception $e) {
            throw new InternalServerErrorException(
                'No se pudo actualizar el producto',
                $e->getMessage()
            );
        }
    }
}
