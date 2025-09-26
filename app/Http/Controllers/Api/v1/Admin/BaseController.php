<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Services\Api\v1\Admin\BaseService;
use Illuminate\Http\JsonResponse;

abstract class BaseController extends Controller
{
    public function __construct(
        protected BaseService $service,
        protected string $resourceClass
    ) {}

    //aqui deberia pasar el paginate
    public function index(): JsonResponse
    {
        $array = $this->resourceClass::collection(
            $this->service->getAll()
        )->response()->getData(true);

        return response()->json([
            'success' => true,
            'message' => 'Listado exitoso',
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
            'data' => new ($this->resourceClass)($model),
        ], 200);
    }
}
