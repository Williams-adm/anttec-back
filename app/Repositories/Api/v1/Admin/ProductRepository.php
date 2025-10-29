<?php

namespace App\Repositories\Api\v1\Admin;

use App\Models\Product;
use App\Repositories\Api\v1\Admin\Contracts\ProductInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): Model
    {
        DB::beginTransaction();
        try{
            $product = Product::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'subcategory_id' => $data['subcategory_id'],
                'brand_id' => $data['brand_id'],
            ]);

            foreach ($data['specifications'] as $specification) {
                $product->specifications()->attach(
                    $specification['specification_id'],
                    ['value' => $specification['value']]
                );
            }

            DB::commit();

            return $product->refresh();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(array $productData, $specificationsData, int $id): ?Model
    {
        $product = $this->model->find($id);

        if (!$product) {
            return null;
        }

        DB::beginTransaction();
        try {
            if (!empty($productData)) {
                $product->update($productData);
            }

            if (!empty($specificationsData['specifications'])) {
                $specs = collect($specificationsData['specifications'])
                    ->mapWithKeys(fn($s) => [
                        $s['specification_id'] => ['value' => $s['value']]
                    ])
                    ->toArray();

                $product->specifications()->syncWithoutDetaching($specs);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return $product->refresh();
    }
}
