<?php

namespace App\Repositories\Api\v1\Auth;

use App\Contracts\Api\v1\Auth\AuthInterface;
use App\Models\User;

class AuthRepository implements AuthInterface
{
    public function finByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
