<?php

use App\Http\Controllers\Api\v1\Admin\BrandController;
use App\Http\Controllers\Api\v1\Admin\CategoryController;
use App\Http\Controllers\Api\v1\Admin\CoverController;
use App\Http\Controllers\Api\v1\Admin\ProductController;
use App\Http\Controllers\Api\v1\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('categories/list', [CategoryController::class, 'getAllList'])->name('apiAdmin.categories.list');
Route::get('subcategories/list', [SubcategoryController::class, 'getAllList'])->name('apiAdmin.subcategories.list');
Route::get('brands/list', [BrandController::class, 'getAllList'])->name('apiAdmin.brands.list');

Route::apiResources([
    'categories' => CategoryController::class,
    'subcategories' => SubcategoryController::class,
    'brands' => BrandController::class,
    'products' => ProductController::class,
    'covers' => CoverController::class
]);
