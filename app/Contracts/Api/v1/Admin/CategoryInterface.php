<?php

namespace App\Contracts\Api\v1\Admin;

use Illuminate\Database\Eloquent\Model;

interface CategoryInterface extends BaseInterface
{
    public function create(array $data): Model;
    public function update(array $data, int $id): Model;
}
