<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Mobile\SubcategoryMResource;
use App\Services\Api\v1\Mobile\SubcategoryMService;
use Illuminate\Http\JsonResponse;

class SubcategoryMController extends Controller
{
    public function __construct(
        protected SubcategoryMService $service
    ) {}

    public function getAllList(): JsonResponse
    {
        $array = SubcategoryMResource::collection(
            $this->service->getAllList()
        )->response()->getData(true);

        return response()->json([
            'success' => true,
            'message' => 'Listado exitoso',
            'data' => $array['data'],
        ], 200);
    }
}
