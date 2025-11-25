<?php

namespace App\Enums\Api\v1\Admin;

enum InventoryMovementType : string
{
    case INFLOW = 'inflow';
    case OUTFLOW = 'outflow';
}
