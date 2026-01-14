<?php

namespace App\Providers;

use App\Contracts\Api\v1\Shop\CategorySInterface;
use App\Contracts\Api\v1\Shop\CoverSInterface;
use App\Contracts\Api\v1\Shop\ProductSInterface;
use App\Repositories\Api\v1\Shop\CategorySRepository;
use App\Repositories\Api\v1\Shop\CoverSRepository;
use App\Repositories\Api\v1\Shop\ProductSRepository;
use Illuminate\Support\ServiceProvider;

class RepositorySServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategorySInterface::class, CategorySRepository::class);
        $this->app->bind(CoverSInterface::class, CoverSRepository::class);
        $this->app->bind(ProductSInterface::class, ProductSRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
