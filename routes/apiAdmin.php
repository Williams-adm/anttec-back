<?php

use App\Http\Controllers\Api\v1\Admin\BranchController;
use App\Http\Controllers\Api\v1\Admin\BrandController;
use App\Http\Controllers\Api\v1\Admin\CategoryController;
use App\Http\Controllers\Api\v1\Admin\CoverController;
use App\Http\Controllers\Api\v1\Admin\InventoryMovementController;
use App\Http\Controllers\Api\v1\Admin\OptionController;
use App\Http\Controllers\Api\v1\Admin\OptionProductController;
use App\Http\Controllers\Api\v1\Admin\OptionValueController;
use App\Http\Controllers\Api\v1\Admin\ProductController;
use App\Http\Controllers\Api\v1\Admin\SpecificationController;
use App\Http\Controllers\Api\v1\Admin\SubcategoryController;
use App\Http\Controllers\Api\v1\Admin\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('categories/list', [CategoryController::class, 'getAllList'])->name('categories.list');
Route::get('subcategories/list', [SubcategoryController::class, 'getAllList'])->name('subcategories.list');
Route::get('brands/list', [BrandController::class, 'getAllList'])->name('brands.list');
Route::get('specifications/list', [SpecificationController::class, 'getAllList'])->name('specifications.list');
Route::get('options/list', [OptionController::class, 'getAllList'])->name('options.list');
Route::post('covers/order', [CoverController::class, 'reorder'])->name('covers.reorder');

Route::get('categories/{id}/subcategories', [CategoryController::class, 'getSubcategories'])->name('categories.getSubcategories');

Route::apiResources([
    'categories' => CategoryController::class,
    'subcategories' => SubcategoryController::class,
    'brands' => BrandController::class,
    'products' => ProductController::class,
    'covers' => CoverController::class,
    'specifications' => SpecificationController::class,
    'options' => OptionController::class,
    'branches' => BranchController::class,
    'variants' => VariantController::class,
]);

Route::controller(InventoryMovementController::class)->prefix('inventory-movements')
    ->group(function () {
        Route::get('/', 'index')->name('inventory-movements.index');
        Route::post('/', 'store')->name('inventory-movements.store');
        Route::get('/{id}', 'show')->name('inventory-movements.show');
    }
);

Route::controller(ProductController::class)->prefix('products')
    ->group(
        function () {
            Route::get('/{id}/options', 'getAllOptions')->name('optionValues.getAllOptions');
        }
    );

Route::controller(OptionValueController::class)->prefix('option-values')
    ->group(function () {
        Route::post('/', 'store')->name('optionValues.store');
        Route::get('/{id}', 'show')->name('optionValues.show');
    }
);

Route::controller(OptionProductController::class)->prefix('option-products')
    ->group(function () {
        Route::post('/', 'store')->name('optionProducts.store');
        Route::post('/values', 'addValues')->name('optionProducts.addValues');
        Route::get('/{id}', 'show')->name('optionProducts.show');
    }
);
