<?php

namespace App\Repositories\Api\v1\Admin\Contracts;

use Illuminate\Database\Eloquent\Model;

interface BrandInterface extends BaseInterface
{
    public function create(array $data): Model;
    public function update(array $data, int $id): ?Model;
}
