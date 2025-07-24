<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Distric extends Model
{
    protected $fillable = [
        'name',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function streets(): HasMany
    {
        return $this->hasMany(Street::class)->chaperone();
    }
}
