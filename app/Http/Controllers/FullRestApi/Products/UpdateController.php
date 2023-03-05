<?php

namespace App\Http\Controllers\FullRestApi\Products;

use App\Contracts\Models\Product;
use App\Contracts\Services\Entities\ProductService;
use App\Events\SyncUploadedImagesWithProduct;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $id)
    {
        $entity = $this->service->updateSyncs(
            $this->service->findById($id),
            $request->only([
                Product::FIELD_NAME,
                Product::FIELD_DESCRIPTION,
                Product::FIELD_ENABLE,
                'categories'
            ]
        ));

        if ($request->hasFile('images')) {
            event(new SyncUploadedImagesWithProduct($entity, $request->file('images')));
        }

        return new ProductResource(
            $this->service->getEntities($entity)
        );
    }
}
