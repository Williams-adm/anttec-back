<?php

namespace App\Exceptions\Api\v1;

use Exception;

class NotFoundException extends Exception
{
    public function render ()
    {
        return response()->json([
            'success' => 'false',
            'message' => 'Recurso no encontrado'
        ], 404);
    }
}
