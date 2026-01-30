<?php

namespace App\Providers;

use App\Contracts\Api\v1\Shop\AddressSInterface;
use App\Contracts\Api\v1\Shop\BranchSInterface;
use App\Contracts\Api\v1\Shop\BranchVariantSInterface;
use App\Contracts\Api\v1\Shop\CartDetailSInterface;
use App\Contracts\Api\v1\Shop\CartSInterface;
use App\Contracts\Api\v1\Shop\CategorySInterface;
use App\Contracts\Api\v1\Shop\CoverSInterface;
use App\Contracts\Api\v1\Shop\LocationSInterface;
use App\Contracts\Api\v1\Shop\ProductSInterface;
use App\Contracts\Api\v1\Shop\UserSInterface;
use App\Repositories\Api\v1\Shop\AddressSRepository;
use App\Repositories\Api\v1\Shop\BranchSRepository;
use App\Repositories\Api\v1\Shop\BranchVariantSRepository;
use App\Repositories\Api\v1\Shop\CartDetailSRepository;
use App\Repositories\Api\v1\Shop\CartSRepository;
use App\Repositories\Api\v1\Shop\CategorySRepository;
use App\Repositories\Api\v1\Shop\CoverSRepository;
use App\Repositories\Api\v1\Shop\LocationSRepository;
use App\Repositories\Api\v1\Shop\ProductSRepository;
use App\Repositories\Api\v1\Shop\UserSRepository;
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
        $this->app->bind(UserSInterface::class, UserSRepository::class);
        $this->app->bind(CartSInterface::class, CartSRepository::class);
        $this->app->bind(BranchVariantSInterface::class, BranchVariantSRepository::class);
        $this->app->bind(CartDetailSInterface::class, CartDetailSRepository::class);
        $this->app->bind(BranchSInterface::class, BranchSRepository::class);
        $this->app->bind(AddressSInterface::class, AddressSRepository::class);
        $this->app->bind(LocationSInterface::class, LocationSRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
