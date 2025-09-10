<?php

namespace App\Repositories\Api\v1\Auth\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface AuthInterface {
    public function finByEmail(string $email): ?User;
}
