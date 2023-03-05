<?php

namespace App\Http\Controllers\FullRestApi\Products;

use App\Contracts\Services\Entities\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Resources\ProductResource;

class DeleteController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  DeleteProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DeleteProductRequest $request)
    {
        $id = $request->product_id;
        $isDeleted = $this->service->deleteSyncs($id);

        if (!$isDeleted) {
            return new ProductResource(['errors' => "Cannot delete entity with key [{$id}]"]);
        }

        return new ProductResource(['message' => 'Entity deleted']);
    }
}
