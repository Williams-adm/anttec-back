<?php

namespace App\Repositories\Api\v1\Admin\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface BaseInterface {
    public function getAll(int $pagination): LengthAwarePaginator;
    public function getById(int $id): ?Model;
    public function create(array $data): Model;
    public function update(array $data, int $id): ?Model;
}
