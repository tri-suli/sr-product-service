<?php

namespace App\Http\Controllers\FullRestApi\Products;

use App\Contracts\Services\Entities\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  ShowProductRequest   $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ShowProductRequest $request, int $id)
    {
        $product = $this->service->getEntities(
            $this->service->findById($id)
        );

        return new ProductResource($product);
    }
}
