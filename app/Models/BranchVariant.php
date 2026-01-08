<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function movements(): BelongsToMany
    {
        return $this->belongsToMany(Movement::class, 'inventory_movement', 'branch_variant_id','movement_id')->using(InventoryMovement::class)->withPivot('id', 'quantity')->withTimestamps();
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
}
