<?php

use App\Http\Controllers\Api\v1\Admin\CategoryController;
use App\Http\Controllers\Api\v1\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'categories' => CategoryController::class,
    'subcategories' => SubcategoryController::class,
]);

