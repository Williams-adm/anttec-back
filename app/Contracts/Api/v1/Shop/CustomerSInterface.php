<?php

namespace App\Contracts\Api\v1\Shop;

use Illuminate\Database\Eloquent\Model;

interface CustomerSInterface {
    public function getBYCustomerDNI(string $dni): ?Model;
    public function getBYCustomerRUC(string $ruc): ?Model;
}

