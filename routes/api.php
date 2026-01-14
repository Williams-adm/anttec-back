<?php

use App\Http\Controllers\Api\v1\Shop\CategorySController;
use App\Http\Controllers\Api\v1\Shop\CoverSController;
use App\Http\Controllers\Api\v1\Shop\ProductSController;
use Illuminate\Support\Facades\Route;

Route::get('categories', [CategorySController::class, 'getAll'])->name('categories.getAll');
Route::get('categories/{id}', [CategorySController::class, 'show'])->name('categories.show');
Route::get('covers', [CoverSController::class, 'getAll'])->name('covers.getAll');

Route::controller(ProductSController::class)->prefix('products')
    ->group(
        function () {
            Route::get('/', 'getAll')->name('products.getAll');
            Route::get('/last', 'getAllLasts')->name('products.getAllLasts');
            Route::get('/{productId}/variants/{variantId}', 'getAllVariants')->name('products.getAllVariants');
        }
    );
