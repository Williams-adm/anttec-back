<?php

namespace App\Repositories\Api\v1\Auth;

use App\Models\User;
use App\Repositories\Api\v1\Auth\Contracts\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function finByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
