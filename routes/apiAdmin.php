<?php

use App\Http\Controllers\Api\v1\Admin\BrandController;
use App\Http\Controllers\Api\v1\Admin\CategoryController;
use App\Http\Controllers\Api\v1\Admin\CoverController;
use App\Http\Controllers\Api\v1\Admin\OptionController;
use App\Http\Controllers\Api\v1\Admin\OptionProductController;
use App\Http\Controllers\Api\v1\Admin\OptionValueController;
use App\Http\Controllers\Api\v1\Admin\ProductController;
use App\Http\Controllers\Api\v1\Admin\SpecificationController;
use App\Http\Controllers\Api\v1\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('categories/list', [CategoryController::class, 'getAllList'])->name('apiAdmin.categories.list');
Route::get('subcategories/list', [SubcategoryController::class, 'getAllList'])->name('apiAdmin.subcategories.list');
Route::get('brands/list', [BrandController::class, 'getAllList'])->name('apiAdmin.brands.list');
Route::get('specifications/list', [SpecificationController::class, 'getAllList'])->name('apiAdmin.specifications.list');
Route::get('options/list', [OptionController::class, 'getAllList'])->name('apiAdmin.options.list');
Route::post('covers/order', [CoverController::class, 'reorder'])->name('apiAdmin.covers.reorder');

Route::apiResources([
    'categories' => CategoryController::class,
    'subcategories' => SubcategoryController::class,
    'brands' => BrandController::class,
    'products' => ProductController::class,
    'covers' => CoverController::class,
    'specifications' => SpecificationController::class,
    'options' => OptionController::class,
]);

Route::controller(ProductController::class)->prefix('products')
    ->group(
        function () {
            Route::get('/{id}/options', 'getAllOptions')->name('apiAdmin.optionValues.getAllOptions');
        }
    );

Route::controller(OptionValueController::class)->prefix('option-values')
    ->group(function () {
        Route::post('/', 'store')->name('apiAdmin.optionValues.store');
        Route::get('/{id}', 'show')->name('apiAdmin.optionValues.show');
    }
);

Route::controller(OptionProductController::class)->prefix('option-products')
    ->group(function () {
        Route::post('/', 'store')->name('apiAdmin.optionProducts.store');
        Route::post('/values', 'addValues')->name('apiAdmin.optionProducts.addValues');
        Route::get('/{id}', 'show')->name('apiAdmin.optionProducts.show');
    }
);
