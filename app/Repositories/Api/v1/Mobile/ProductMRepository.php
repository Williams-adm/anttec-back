<?php

namespace App\Repositories\Api\v1\Mobile;

use App\Contracts\Api\v1\Mobile\ProductMInterface;
use App\Filters\Api\v1\Mobile\Products\ProductBrandFilter;
use App\Filters\Api\v1\Mobile\Products\ProductCategoryFilter;
use App\Filters\Api\v1\Mobile\Products\ProductPriceFilter;
use App\Filters\Api\v1\Mobile\Products\ProductSubcategoryFilter;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class ProductMRepository implements ProductMInterface
{
    private int $branchId = 1;

    public function getAll(int $pagination): LengthAwarePaginator
    {
        $query = Product::query()
            ->whereHas('variants.branches', function ($q) {
                $q->where('branch_id', $this->branchId)
                    ->where('stock', '>', 0);
            })
            ->with([
                'brand',
                'variants' => function ($q) {
                    $q->whereHas('branches', function ($b) {
                        $b->where('branch_id', $this->branchId)
                            ->where('stock', '>', 0);
                    })
                        ->with([
                            'images' => function ($img) {
                                $img->orderBy('id')->limit(1);
                            },
                            'branches' => function ($b) {
                                $b->where('branch_id', $this->branchId);
                            }
                        ])
                        ->orderBy('selling_price', 'asc')
                        ->limit(1);
                }
            ]);

        $filters = [
            ProductBrandFilter::class,
            ProductCategoryFilter::class,
            ProductSubcategoryFilter::class,
            ProductPriceFilter::class,
        ];

        $query = app(Pipeline::class)
            ->send($query)
            ->through($filters)
            ->thenReturn();

        return $query->paginate($pagination);
    }

    public function getAllVariants(int $productId, int $variantId): Model
    {
        return Product::query()
            ->where('id', $productId)
            ->whereHas('variants', function ($q) use ($variantId) {
                $q->where('id', $variantId);
            })
            ->with([
                'brand',
                'specifications',
                'variants' => function ($q) {
                    $q->with([
                        'images',
                        'optionProductValues.optionValue',
                        'branches' => fn($b) => $b->where('branch_id', 1),
                    ]);
                }
            ])
            ->firstOrFail();
    }
}
