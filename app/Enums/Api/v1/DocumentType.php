<?php

namespace App\Enums\Api\v1;

enum  DocumentType: string
{
    case DNI = 'DNI';
    case CE = 'CE';
    case PASAPORTE = 'Pasaporte';
    case RUC = 'RUC';

    public function label(): string
    {
        return match ($this) {
            self::DNI => 'DNI',
            self::CE => 'CE',
            self::PASAPORTE => 'Pasaporte',
            self::RUC => 'RUC',
        };
    }
}
