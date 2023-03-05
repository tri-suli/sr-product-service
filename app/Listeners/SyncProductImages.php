<?php

namespace App\Listeners;

use App\Contracts\Models\Product;
use App\Contracts\Services\Entities\ImageService;
use App\Contracts\Services\Entities\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class SyncProductImages
{
    /**
     * The product service instance
     *
     * @var ImageService
     */
    private ImageService $imageService;

    /**
     * The product service instance
     *
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * Create the event listener.
     *
     * @param   ProductService $productService
     * @return  void
     */
    public function __construct(ProductService $productService, ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->productService = $productService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $images = $event->images;
        $product = $event->product;

        if (request()->isMethod('post')) {
            $images = $this->imageService->storeMany("products/{$product->id}", $images);
            $this->productService->syncImages($product, $images);
        } else if (request()->isMethod('patch')) {
            $images = $this->imageService->storeMany("products/{$product->id}", $images);
            if ($images->isNotEmpty()) {
                $product = $this->productService->updateSyncs($product, ['images' => $images]);
                if ($product instanceof Product) {
                    Storage::delete("products/{$product->id}");
                    $this->productService->syncImages($product, $images);
                }
            }
        }
    }
}
