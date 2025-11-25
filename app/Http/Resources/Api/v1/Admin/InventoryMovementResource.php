<?php

namespace App\Http\Resources\Api\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryMovementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'detail_transaction' => $this->detail_transaction,
            'quantity' => $this->quantity,
            'branch_variant_id' => $this->branch_variant_id
        ];
    }
}
