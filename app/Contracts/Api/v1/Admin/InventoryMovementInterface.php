<?php

namespace App\Contracts\Api\v1\Admin;

interface InventoryMovementInterface extends BaseInterface
{
    public function createInflow(array $data): array;
    public function createOutflow(array $data): array;
}
