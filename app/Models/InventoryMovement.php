<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryMovement extends Model
{
    protected $fillable = [
        'type',
        'detail_transaction',
        'quantity',
        'branch_variant_id'
    ];

    public function branchVariant(): BelongsTo
    {
        return $this->belongsTo(BranchVariant::class);
    }
}
