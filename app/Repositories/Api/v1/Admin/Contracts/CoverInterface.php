<?php

namespace App\Repositories\Api\v1\Admin\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CoverInterface extends BaseInterface
{
    public function updateWithImage(array $coverData, array $imageData, int $id): ?Model;
    public function reorder(array $orderIds): void;
}
