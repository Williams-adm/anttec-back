<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BranchVariant extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        'stock',
        'stock_min',
        'branch_id',
        'variant_id'
    ];

    public function inventoryMovements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class)->chaperone();
    }
}
