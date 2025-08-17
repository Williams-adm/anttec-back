<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Requests\Api\v1\Admin\Brand\StoreBrandRequest;
use App\Http\Requests\Api\v1\Admin\Brand\UpdateBrandRequest;
use App\Services\Api\v1\Admin\BrandService;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandController extends BaseController
{
    public function __construct(BrandService $service)
    {
        parent::__construct($service);
    }

    public function store(StoreBrandRequest $request): JsonResource
    {
        return $this->service->create($request->validated());
    }

    public function update(UpdateBrandRequest $request, int $id): JsonResource
    {
        return $this->service->update($request->validated(), $id);
    }
}
