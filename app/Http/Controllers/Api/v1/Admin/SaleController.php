<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Admin\SaleResource;
use App\Services\Api\v1\Admin\SaleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(
        protected SaleService $service
    ) {}

    public function index(): JsonResponse
    {
        $array = SaleResource::collection(
            $this->service->getAll()
        )->response()->getData(true);

        return response()->json([
            'success' => true,
            'message' => 'Listado paginado exitoso',
            'data' => $array['data'],
            'links' => $array['links'],
            'meta' => $array['meta'],
        ], 200);
    }

    public function show(string $id): JsonResponse
    {
        $model = $this->service->getById($id);

        return response()->json([
            'success' => true,
            'message' => 'Exitoso',
            'data' => new SaleResource($model),
        ], 200);
    }
}
