<?php

namespace App\Providers;

use App\Contracts\Services\CategoryService;
use App\Services\CategoryService as ServicesCategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CategoryService::class, ServicesCategoryService::class, true);
    }
}
