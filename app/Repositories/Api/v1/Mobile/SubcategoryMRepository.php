<?php

namespace App\Repositories\Api\v1\Mobile;

use App\Contracts\Api\v1\Mobile\SubcategoryMInterface;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Collection;

class SubcategoryMRepository implements SubcategoryMInterface
{
    public function getAllList(): Collection
    {
        return Subcategory::select('name')->distinct()->orderBy('name')->get();
    }
}
