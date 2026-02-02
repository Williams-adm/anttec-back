<?php

namespace App\Repositories\Api\v1\Shop;

use App\Contracts\Api\v1\Shop\CustomerSInterface;
use App\Models\Customer;
use App\Models\DocumentNumber;
use Illuminate\Database\Eloquent\Model;

class CustomerSRepository implements CustomerSInterface
{
    public function getBYCustomerDNI(string $dni): ?Model
    {
        $doc = DocumentNumber::where('number', $dni)
            ->whereRelation('documentType', 'type', 'DNI')
            ->where('documentable_type', Customer::class)
            ->first();
        return $doc?->documentable;
    }
}
