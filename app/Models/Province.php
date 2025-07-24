<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = [
        'name',
        'shipment_cost',
    ];

    public function departament(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function districs(): HasMany
    {
        return $this->hasMany(Distric::class)->chaperone();
    }
}
