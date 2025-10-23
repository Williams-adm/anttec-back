<?php

namespace App\Providers;

use App\Repositories\Api\v1\Admin\BaseRepository;
use App\Repositories\Api\v1\Admin\BrandRepository;
use App\Repositories\Api\v1\Admin\CategoryRepository;
use App\Repositories\Api\v1\Admin\Contracts\BaseInterface;
use App\Repositories\Api\v1\Admin\Contracts\BrandInterface;
use App\Repositories\Api\v1\Admin\Contracts\CategoryInterface;
use App\Repositories\Api\v1\Admin\Contracts\CoverInterface;
use App\Repositories\Api\v1\Admin\Contracts\ProductInterface;
use App\Repositories\Api\v1\Admin\Contracts\SubcategoryInterface;
use App\Repositories\Api\v1\Admin\CoverRepository;
use App\Repositories\Api\v1\Admin\ProductRepository;
use App\Repositories\Api\v1\Admin\SubcategoryRepository;
use App\Repositories\Api\v1\Auth\AuthRepository;
use App\Repositories\Api\v1\Auth\Contracts\AuthInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(BaseInterface::class, BaseRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubcategoryInterface::class, SubcategoryRepository::class);
        $this->app->bind(BrandInterface::class, BrandRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(CoverInterface::class, CoverRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
