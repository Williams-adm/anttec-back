<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DocumentType extends Model
{
    protected $fillable = [
        'number',
        'documentable_id',
        'documentable_type',
    ];

    public function documentNumbers(): HasMany
    {
        return $this->hasMany(DocumentNumber::class);
    }

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
