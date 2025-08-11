<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Services\Api\v1\Admin\BaseService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseController extends Controller
{
    public function __construct(
        protected BaseService $service
    ){}

    //aqui deberia pasar el paginate
    public function index(): ResourceCollection
    {
        return $this->service->getAll();
    }

    public function show(string $id): JsonResource
    {
        return $this->service->getById($id);
    }
}
