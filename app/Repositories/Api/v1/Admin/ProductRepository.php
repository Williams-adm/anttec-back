<?php

namespace App\Repositories\Api\v1\Admin;

use App\Contracts\Api\v1\Admin\ProductInterface;
use App\Models\Product;
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
                'model' => $data['model'],
                'description' => $data['description'] ?? null,
                'subcategory_id' => $data['subcategory_id'],
                'brand_id' => $data['brand_id'],
            ]);

            foreach ($data['specifications'] as $specification) {
                $product->specifications()->attach(
                    ['specification_id' => $specification['specification_id']],
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

    public function update(array $productData, $specificationsData, int $id): Model
    {
        DB::beginTransaction();
        try {
            $product = $this->getById($id);

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
            return $product->refresh();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
