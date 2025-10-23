<?php

namespace App\Services\Api\v1\Admin;

use App\Exceptions\Api\v1\InternalServerErrorException;
use App\Http\Resources\Api\v1\Admin\CoverResource;
use App\Repositories\Api\v1\Admin\Contracts\CoverInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CoverService extends BaseService
{
    public function __construct(CoverInterface $repository)
    {
        parent::__construct($repository, CoverResource::class);
    }

    public function create(array $data): Model
    {
        try {
            $path = Storage::putFile('covers', $data['image']);
            $data['image'] = $path;
            return $this->repository->create($data);
        } catch (\Exception $e) {
            if (isset($path)) {
                Storage::delete($path);
            }

            throw new InternalServerErrorException(
                'No se pudo crear la portada',
                $e->getMessage()
            );
        }
    }
}
