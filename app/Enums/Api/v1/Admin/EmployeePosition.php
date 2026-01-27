<?php

namespace App\Enums\Api\v1\Admin;

enum  EmployeePosition: string
{
    case ADMIN = 'admin';
    case SELLER = 'seller';
    case CASHIER = 'cashier';
    case SUPPORT = 'support';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::SELLER => 'Vendedor',
            self::CASHIER => 'Cajero',
            self::SUPPORT => 'Soporte',
            self::OTHER => 'Otro',
        };
    }
}
