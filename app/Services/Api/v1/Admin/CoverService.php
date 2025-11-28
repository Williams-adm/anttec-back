<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\CoverInterface;
use App\Exceptions\Api\v1\InternalServerErrorException;
use App\Exceptions\Api\v1\NotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;

/**
 * @extends BaseService<CoverInterface>
 */
class CoverService extends BaseService
{
    protected $cloudinary;
    public function __construct(CoverInterface $repository)
    {
        parent::__construct($repository);
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_KEY'),
                'api_secret' => env('CLOUDINARY_SECRET'),
            ],
        ]);
    }

    public function create(array $data): Model
    {
        try {
            // Subir archivo usando la API moderna
            $upload = $this->cloudinary->uploadApi()->upload($data['image']->getRealPath(), [
                'folder' => 'covers',
                'resource_type' => 'image',
            ]);

            // Guardar public_id
            $data['image'] = $upload['public_id'];

            return $this->repository->create($data);
        } catch (\Exception $e) {
            if (isset($path)) {
                $this->cloudinary->uploadApi()->destroy($upload['public_id']);
            }

            throw new InternalServerErrorException(
                'No se pudo crear la portada',
                $e->getMessage()
            );
        }
    }

    public function update(array $data, int $id): Model
    {
        try {
            $cover = $this->repository->getById($id);

            if (isset($data['image'])) {

                // Eliminar imagen antigua de Cloudinary si existe
                if ($cover->image) {
                    $this->cloudinary->uploadApi()->destroy($cover->image);
                }

                // Subir nueva imagen
                $upload = $this->cloudinary->uploadApi()->upload(
                    $data['image']->getRealPath(),
                    [
                        'folder' => 'covers',
                        'resource_type' => 'image',
                    ]
                );

                // Guardar public_id en $data
                $data['image'] = $upload['public_id'];
            }

            $coverData = Arr::only($data, [
                'title',
                'start_at',
                'end_at',
                'status',
            ]);

            $imageData = Arr::only($data, ['image']);
            return $this->repository->update($coverData, $imageData, $id);

        } catch (ModelNotFoundException $e) {
            throw new NotFoundException();
        } catch (\Exception $e) {
            if (isset($upload['public_id'])) {
                $this->cloudinary->uploadApi()->destroy($upload['public_id']);
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
