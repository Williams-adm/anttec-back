<?php

namespace App\Contracts\Api\v1\Mobile;

use Illuminate\Database\Eloquent\Model;

interface CartMInterface {
    public function getCart(int $userId): ?Model;
    public function getOrCreateCart(int $userId): ?Model;
    public function update(int $id, array $data): Model;
}
