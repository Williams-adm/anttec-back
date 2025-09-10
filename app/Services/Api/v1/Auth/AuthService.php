<?php

namespace App\Services\Api\v1\Auth;

use App\Exceptions\Api\v1\Auth\InvalidCredentialsException;
use App\Repositories\Api\v1\Auth\Contracts\AuthInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected AuthInterface $repository
    ){}

    public function login (array $credentials): array
    {
        $user = $this->repository->finByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new InvalidCredentialsException();
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function logout ($user): void
    {
        $user->currentAccessToken()->delete();
    }
}
