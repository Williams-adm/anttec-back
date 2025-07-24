<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    protected $fillable = [
        'number',
        'phoneable_id',
        'phoneable_type'
    ];

    public function prefix(): BelongsTo
    {
        return $this->belongsTo(Prefix::class);
    }

    //falta definir la relacion polimorfica
}
