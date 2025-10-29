<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'subcategory_id',
        'brand_id'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function specifications(): BelongsToMany
    {
        return $this->belongsToMany(Specification::class)->withPivot('value')->withTimestamps();
    }
}
