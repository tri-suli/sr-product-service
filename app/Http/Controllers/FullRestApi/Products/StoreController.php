<?php

namespace App\Http\Controllers\FullRestApi\Products;

use App\Contracts\Models\Product;
use App\Contracts\Services\Entities\ProductService;
use App\Events\SyncUploadedImagesWithProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveProductRequest;
use App\Http\Resources\ProductResource;

class StoreController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  SaveProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SaveProductRequest $request)
    {
        // dd($request->all());
        $entity = $this->service->store(
            $request->only([
                Product::FIELD_NAME,
                Product::FIELD_DESCRIPTION,
                Product::FIELD_ENABLE,
            ])
        );

        if ($request->hasFile('images')) {
            event(new SyncUploadedImagesWithProduct($entity, $request->file('images')));
        }

        return new ProductResource(
            $this->service->getEntities($entity)
        );
    }
}
