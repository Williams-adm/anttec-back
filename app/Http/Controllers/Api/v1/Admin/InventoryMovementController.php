<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Requests\Api\v1\Admin\InventoryMovement\StoreInventoryMovementRequest;
use App\Http\Resources\Api\v1\Admin\InventoryMovementResource;
use App\Services\Api\v1\Admin\InventoryMovementService;
use Illuminate\Http\JsonResponse;

/**
 * @extends BaseController<InventoryMovementService>
 */
class InventoryMovementController extends BaseController
{
    public function __construct(InventoryMovementService $service)
    {
        parent::__construct($service, InventoryMovementResource::class);
    }

    public function store(StoreInventoryMovementRequest $request): JsonResponse
    {
        $response = $this->service->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Registro creado',
            'data' => InventoryMovementResource::collection($response),
        ], 201);
    }
}
