<?php

namespace App\Providers;

use App\Contracts\Api\v1\Admin\BaseInterface;
use App\Contracts\Api\v1\Admin\BrandInterface;
use App\Contracts\Api\v1\Admin\CategoryInterface;
use App\Contracts\Api\v1\Admin\CoverInterface;
use App\Contracts\Api\v1\Admin\OptionInterface;
use App\Contracts\Api\v1\Admin\OptionProductInterface;
use App\Contracts\Api\v1\Admin\OptionValueInterface;
use App\Contracts\Api\v1\Admin\ProductInterface;
use App\Contracts\Api\v1\Admin\SpecificationInterface;
use App\Contracts\Api\v1\Admin\SubcategoryInterface;
use App\Contracts\Api\v1\Auth\AuthInterface;
use App\Repositories\Api\v1\Admin\BaseRepository;
use App\Repositories\Api\v1\Admin\BrandRepository;
use App\Repositories\Api\v1\Admin\CategoryRepository;
use App\Repositories\Api\v1\Admin\CoverRepository;
use App\Repositories\Api\v1\Admin\OptionProductRepository;
use App\Repositories\Api\v1\Admin\OptionRepository;
use App\Repositories\Api\v1\Admin\OptionValueRepository;
use App\Repositories\Api\v1\Admin\ProductRepository;
use App\Repositories\Api\v1\Admin\SpecificationRepository;
use App\Repositories\Api\v1\Admin\SubcategoryRepository;
use App\Repositories\Api\v1\Auth\AuthRepository;
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
        $this->app->bind(SpecificationInterface::class, SpecificationRepository::class);
        $this->app->bind(OptionInterface::class, OptionRepository::class);
        $this->app->bind(OptionValueInterface::class, OptionValueRepository::class);
        $this->app->bind(OptionProductInterface::class, OptionProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
