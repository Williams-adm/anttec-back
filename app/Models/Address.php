<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    protected $fillable = [
        'favorite',
        'reference',
        'addressable_id',
        'addressable_type',
    ];

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class);
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
