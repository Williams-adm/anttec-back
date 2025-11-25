<?php

namespace App\Contracts\Api\v1\Admin;

use Illuminate\Database\Eloquent\Model;

interface ProductInterface extends BaseInterface
{
    public function create(array $data): Model;
    public function update(array $productData, array $specificationsData, int $id): Model;
}
