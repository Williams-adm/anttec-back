<?php

namespace App\Services\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\VariantInterface;
use App\Exceptions\Api\v1\InternalServerErrorException;
use App\Exceptions\Api\v1\NotFoundException;
use App\Models\Variant;
use App\traits\SkuGenerator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

/**
 * @extends BaseService<VariantInterface>
 */
class VariantService extends BaseService
{
    use SkuGenerator;

    public function __construct(VariantInterface $repository)
    {
        parent::__construct($repository);
    }

    public function getAllShort(int $id, int $pagination = 15): LengthAwarePaginator
    {
        return $this->repository->getAllShort($pagination, $id);
    }

    public function create(array $data): Model
    {
        $sku = $this->generateSkuVariant($data['product_id']);
        $data['sku'] = $sku;

        try {
            $variantData = Arr::only($data, [
                'selling_price',
                'purcharse_price',
                'product_id',
                'sku',
            ]);
            $images = [];
            foreach($data['images'] as $image) {
                $path = Storage::putFile('variants', $image['image']);
                $images[] = $path;
            }

            $variantFeatures = collect($data['features'])
                ->pluck('option_product_value')
                ->sort()
                ->values()
                ->toArray();

            $this->validateUniqueCombination(
                $data['product_id'],
                $variantFeatures
            );

            return $this->repository->create($variantData, $images, $variantFeatures, $data['stock_min']);
        } catch (\Exception $e) {
            if(!empty($images)){
                foreach($images as $imagePath) {
                    Storage::delete($imagePath);
                }
            }
            throw new InternalServerErrorException(
                'No se pudo crear la variante',
                $e->getMessage()
            );
        }
    }

    public function update(array $data, int $id): Model
    {
        $variantData = Arr::only($data, [
            'selling_price',
            'purcharse_price',
            'product_id',
            'status'
        ]);

        if(isset($data['image'])) {
            $images = [];
            foreach ($data['images'] as $image) {
                $path = Storage::putFile('variants', $image['image']);
                $images[] = $path;
            }
        }

        if(isset($data['features'])) {
            $variantFeatures = array_column($data['features'], 'option_product_value');
        }

        try {
            return $this->repository->update($variantData, $data['stock_min'] ?? null, $images ?? null, $variantFeatures ?? null, $id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException();
        } catch (\Exception $e) {
            throw new InternalServerErrorException(
                'No se pudo actualizar la variante',
                $e->getMessage()
            );
            if (!empty($images)) {
                foreach ($images as $imagePath) {
                    Storage::delete($imagePath);
                }
            }
        }
    }

    private function validateUniqueCombination(int $productId, array $variantFeatures): void
    {
        $features = collect($variantFeatures)->sort()->values()->toArray();

        $exists = Variant::where('product_id', $productId)
            ->whereHas('optionProductValues', function ($q) use ($features) {
                $q->whereIn('option_product_value_id', $features);
            }, '=', count($features))
            ->whereDoesntHave('optionProductValues', function ($q) use ($features) {
                $q->whereNotIn('option_product_value_id', $features);
            })
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'features' => 'Ya existe una variante con esta combinación'
            ]);
        }
    }
}
