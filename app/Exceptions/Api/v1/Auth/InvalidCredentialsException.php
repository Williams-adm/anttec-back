<?php

namespace App\Exceptions\Api\v1\Auth;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function render()
    {
        return response()->json([
            'success' => 'false',
            'message' => 'Credenciales incorrectas'
        ], 401);
    }
}
