<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Street extends Model
{
    protected $fillable = [
        'name',
        'number',
    ];

    public function distric(): BelongsTo
    {
        return $this->belongsTo(Distric::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class)->chaperone();
    }
}
