<?php

namespace App\Repositories\Api\v1\Admin\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ProductInterface extends BaseInterface
{
    public function create(array $data): Model;
    public function update(array $productData, array $specificationsData, int $id): ?Model;
}
