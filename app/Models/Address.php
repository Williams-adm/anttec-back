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
        'street',
        'street_number',
        'reference',
        'distric_id',
        'addressable_id',
        'addressable_type',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function shippingRate(): MorphOne
    {
        return $this->morphOne(ShippingRate::class, 'shippable');
    }
}
