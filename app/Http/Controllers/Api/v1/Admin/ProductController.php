<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Requests\Api\v1\Admin\Product\StoreProductRequest;
use App\Http\Requests\Api\v1\Admin\Product\UpdateProductRequest;
use App\Http\Resources\Api\v1\Admin\ProductResource;
use App\Services\Api\v1\Admin\ProductService;
use Illuminate\Http\JsonResponse;

/**
 * @extends BaseController<ProductService>
 */
class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service, ProductResource::class);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $response = $this->service->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Registro creado',
            'data' => new ProductResource($response),
        ], 201);
    }

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $model = $this->service->update($request->validated(), $id);

        return response()->json([
            'success' => true,
            'message' => 'Registro actualizado',
            'data' => new ProductResource($model),
        ], 200);
    }
}
