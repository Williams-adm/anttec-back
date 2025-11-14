<?php

namespace App\Contracts\Api\v1\Mobile;

use Illuminate\Database\Eloquent\Collection;

interface SubcategoryMInterface
{
    public function getAllList(): Collection;
}
