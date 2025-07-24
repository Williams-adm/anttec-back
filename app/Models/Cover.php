<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    protected $fillable = [
        'title',
        'start_at',
        'end_at',
        'status',
        'order',
    ];
}
