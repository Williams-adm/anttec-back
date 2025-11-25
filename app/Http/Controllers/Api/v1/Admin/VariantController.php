<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Requests\Api\v1\Admin\Variant\StoreVariantRequest;
use App\Http\Requests\Api\v1\Admin\Variant\UpdateVariantRequest;
use App\Http\Resources\Api\v1\Admin\VariantResource;
use App\Services\Api\v1\Admin\VariantService;
use Illuminate\Http\JsonResponse;

/**
 * @extends BaseController<VariantService>
 */
class VariantController extends BaseController
{
    public function __construct(VariantService $service)
    {
        parent::__construct($service, VariantResource::class);
    }

    public function store(StoreVariantRequest $request): JsonResponse
    {
        $response = $this->service->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Registro creado',
            'data' => new VariantResource($response),
        ], 201);
    }

    public function update(UpdateVariantRequest $request, int $id): JsonResponse
    {
        $model = $this->service->update($request->validated(), $id);

        return response()->json([
            'success' => true,
            'message' => 'Registro actualizado',
            'data' => new VariantResource($model),
        ], 200);
    }
}
