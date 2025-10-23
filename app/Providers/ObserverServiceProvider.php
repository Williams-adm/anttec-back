<?php

namespace App\Providers;

use App\Models\Cover;
use App\Observers\Api\v1\Admin\CoverObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Cover::observe(CoverObserver::class);
    }
}
