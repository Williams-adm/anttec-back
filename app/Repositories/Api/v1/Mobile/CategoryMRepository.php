<?php

namespace App\Repositories\Api\v1\Mobile;

use App\Contracts\Api\v1\Mobile\CategoryMInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryMRepository implements CategoryMInterface
{
    public function getAllList(): Collection
    {
        return Category::all();
    }
}
