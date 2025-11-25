<?php

namespace App\Contracts\Api\v1\Admin;

use Illuminate\Database\Eloquent\Model;

interface VariantInterface extends BaseInterface
{
    public function create(array $variantData, array $images, array $variantFeatures, int $stockmin): Model;
    public function update(array $variantData, ?int $stockmin, ?array $images, ?array $variantFeatures, int $id): Model;
}
