<?php

namespace App\Providers;

use App\Contracts\Models as AbstractModel;
use App\Contracts\Services\Entities as AbstractEntityService;
use App\Models as ConcreteModel;
use App\Services\Entities as ConcreteEntityService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Map all models abstract with their concrete implmentation
     *
     * @var array
     */
    protected array $models = [
        AbstractModel\Category::class => ConcreteModel\Category::class,
        AbstractModel\Image::class => ConcreteModel\Image::class,
        AbstractModel\Product::class => ConcreteModel\Product::class,
    ];

    /**
     * Map all services abstract with their concrete implmentation
     *
     * @var array
     */
    protected array $services = [
        AbstractEntityService\CategoryService::class => ConcreteEntityService\CategoryService::class,
        AbstractEntityService\ImageService::class => ConcreteEntityService\ImageService::class,
        AbstractEntityService\ProductService::class => ConcreteEntityService\ProductService::class,
    ];

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
        $this->bootModels();
        
        $this->bootEntityServices();
    }

    /**
     * Bind all the abstract models to each of concrete classes
     * into service container
     * 
     * @return void
     */
    private function bootModels(): void
    {
        foreach($this->models as $abstract => $concrete) {
            $this->app->bind($abstract,$concrete);
        }
    }

    /**
     * Bind all the contract services to each of concrete classes
     * into service container
     * 
     * @return void
     */
    private function bootEntityServices(): void
    {
        foreach($this->services as $abstract => $concrete) {
            $this->app->bind($abstract,$concrete);
        }
    }
}
