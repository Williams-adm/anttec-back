<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\CoverInterface;
use App\Exceptions\Api\v1\InternalServerErrorException;
use App\Exceptions\Api\v1\NotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * @extends BaseService<CoverInterface>
 */
class CoverService extends BaseService
{
    public function __construct(CoverInterface $repository)
    {
        parent::__construct($repository);
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

    public function update(array $data, int $id): ?Model
    {
        $cover = $this->repository->getById($id);

        if (!$cover) {
            throw new NotFoundException();
        }

        try {
            if(isset($data['image']) && Storage::exists($cover->image->path)) {
                if($cover->image->path) {
                    Storage::delete($cover->image->path);
                }
                $path = Storage::putFile('covers', $data['image']);
            }

            $coverData = Arr::only($data, [
                'title',
                'start_at',
                'end_at',
                'status',
            ]);

            $imageData = Arr::only($data, ['image']);

            $cover = $this->repository->update($coverData, $imageData, $id);

            return $cover;

        } catch (\Exception $e) {
            if (isset($path)) {
                Storage::delete($path);
            }

            throw new InternalServerErrorException(
                'No se pudo actualizar la portada',
                $e->getMessage()
            );
        }
    }

    public function reorder(array $orderIds): void
    {
        $this->repository->reorder($orderIds);
    }
}
