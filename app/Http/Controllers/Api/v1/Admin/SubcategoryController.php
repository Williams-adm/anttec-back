<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Requests\Api\v1\Admin\Subcategory\StoreSubcategoryRequest;
use App\Http\Requests\Api\v1\Admin\Subcategory\UpdateSubcategoryRequest;
use App\Services\Api\v1\Admin\SubcategoryService;
use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryController extends BaseController
{
    public function __construct(SubcategoryService $service)
    {
        parent::__construct($service);
    }

    public function store(StoreSubcategoryRequest $request): JsonResource
    {
        return $this->service->create($request->validated());
    }

    public function update(UpdateSubcategoryRequest $request, int $id): JsonResource
    {
        return $this->service->update($request->validated(), $id);
    }
}
