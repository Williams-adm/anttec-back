<?php

namespace App\Providers;

use App\Contracts\Api\v1\Mobile\BrandMInterface;
use App\Contracts\Api\v1\Mobile\CategoryMInterface;
use App\Contracts\Api\v1\Mobile\ProductMInterface;
use App\Contracts\Api\v1\Mobile\VariantMInterface;
use App\Repositories\Api\v1\Mobile\BrandMRepository;
use App\Repositories\Api\v1\Mobile\CategoryMRepository;
use App\Repositories\Api\v1\Mobile\ProductMRepository;
use App\Repositories\Api\v1\Mobile\VariantMRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryMServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryMInterface::class, CategoryMRepository::class);
        $this->app->bind(BrandMInterface::class, BrandMRepository::class);
        $this->app->bind(ProductMInterface::class, ProductMRepository::class);
        $this->app->bind(VariantMInterface::class, VariantMRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
