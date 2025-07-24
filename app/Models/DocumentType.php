<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    protected $fillable = [
        'number',
        'documentable_id',
        'documentable_type',
    ];

    public function documentNumbers(): HasMany
    {
        return $this->hasMany(DocumentNumber::class)->chaperone();
    }
}
