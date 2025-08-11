<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Requests\Api\v1\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Api\v1\Admin\Category\UpdateCategoryRequest;
use App\Services\Api\v1\Admin\CategoryService;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends BaseController
{
    public function __construct(CategoryService $service)
    {
        parent::__construct($service);
    }

    public function store(StoreCategoryRequest $request): JsonResource
    {
        return $this->service->create($request->validated());
    }

    public function update(UpdateCategoryRequest $request, int $id): JsonResource
    {
        return $this->service->update($request->validated(), $id);
    }
}
