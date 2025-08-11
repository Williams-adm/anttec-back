<?php

namespace App\Providers;

use App\Repositories\Api\v1\Admin\BaseRepository;
use App\Repositories\Api\v1\Admin\CategoryRepository;
use App\Repositories\Api\v1\Admin\Contracts\BaseInterface;
use App\Repositories\Api\v1\Admin\Contracts\CategoryInterface;
use App\Repositories\Api\v1\Admin\Contracts\SubcategoryInterface;
use App\Repositories\Api\v1\Admin\SubcategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BaseInterface::class, BaseRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubcategoryInterface::class, SubcategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
