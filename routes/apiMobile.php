<?php

use App\Http\Controllers\Api\v1\Mobile\BrandMController;
use App\Http\Controllers\Api\v1\Mobile\CategoryMController;
use App\Http\Controllers\Api\v1\Mobile\SubcategoryMController;
use Illuminate\Support\Facades\Route;

Route::get('categories',[CategoryMController::class, 'getAllList'])->name('categories.list');
Route::get('brands',[BrandMController::class, 'getAllList'])->name('brands.list');
Route::get('subcategories',[SubcategoryMController::class, 'getAllList'])->name('subcategories.list');
