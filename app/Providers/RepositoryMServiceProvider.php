<?php

namespace App\Providers;

use App\Contracts\Api\v1\Mobile\BranchVariantMInterface;
use App\Contracts\Api\v1\Mobile\BrandMInterface;
use App\Contracts\Api\v1\Mobile\CartDetailMInterface;
use App\Contracts\Api\v1\Mobile\CartMInterface;
use App\Contracts\Api\v1\Mobile\CategoryMInterface;
use App\Contracts\Api\v1\Mobile\ProductMInterface;
use App\Contracts\Api\v1\Mobile\UserMInterface;
use App\Contracts\Api\v1\Mobile\VariantMInterface;
use App\Repositories\Api\v1\Mobile\BranchVariantMRepository;
use App\Repositories\Api\v1\Mobile\BrandMRepository;
use App\Repositories\Api\v1\Mobile\CartDetailMRepository;
use App\Repositories\Api\v1\Mobile\CartMRepository;
use App\Repositories\Api\v1\Mobile\CategoryMRepository;
use App\Repositories\Api\v1\Mobile\ProductMRepository;
use App\Repositories\Api\v1\Mobile\UserMRepository;
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
        $this->app->bind(CartMInterface::class, CartMRepository::class);
        $this->app->bind(CartDetailMInterface::class, CartDetailMRepository::class);
        $this->app->bind(BranchVariantMInterface::class, BranchVariantMRepository::class);
        $this->app->bind(UserMInterface::class, UserMRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
