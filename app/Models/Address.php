<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    //falta definir la relacion polimorfica
}
