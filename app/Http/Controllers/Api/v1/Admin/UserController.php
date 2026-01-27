<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Admin\User\StoreUserRequest;
use App\Http\Resources\Api\v1\Admin\UserResource;
use App\Services\Api\v1\Admin\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    public function store(StoreUserRequest $request): JsonResponse
    {
        $response = $this->service->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Registro creado',
            'data' => new UserResource($response),
        ], 201);
    }
}
