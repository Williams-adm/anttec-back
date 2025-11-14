<?php

namespace App\Http\Controllers\Api\v1\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Mobile\CategoryMResource;
use App\Services\Api\v1\Mobile\CategoryMService;
use Illuminate\Http\JsonResponse;

class CategoryMController extends Controller
{
    public function __construct(
        protected CategoryMService $service
    )
    { }

    public function getAllList(): JsonResponse
    {
        $array = CategoryMResource::collection(
            $this->service->getAllList()
        )->response()->getData(true);

        return response()->json([
            'success' => true,
            'message' => 'Listado exitoso',
            'data' => $array['data'],
        ], 200);
    }
}
