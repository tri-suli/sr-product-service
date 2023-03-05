<?php

namespace App\Http\Controllers\FullRestApi\Categories;

use App\Contracts\Services\Entities\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowCategoryRequest;
use App\Http\Resources\CategoryResource;

class ShowController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  ShowCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ShowCategoryRequest $request, int $id)
    {
        $entity = $this->service->findById($id);

        return new CategoryResource($entity);
    }
}
