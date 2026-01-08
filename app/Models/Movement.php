<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movement extends Model
{
    protected $fillable = [
        'type',
        'reason',
        'detail_transaction',
    ];

    public function branchVariants(): BelongsToMany
    {
        return $this->belongsToMany(BranchVariant::class, 'inventory_movement', 'movement_id', 'branch_variant_id')->using(InventoryMovement::class)->withPivot('id', 'quantity')->withTimestamps();
    }
}
