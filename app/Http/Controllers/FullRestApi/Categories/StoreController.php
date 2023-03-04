<?php

namespace App\Http\Controllers\FullRestApi\Categories;

use App\Contracts\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCategoryRequest;
use App\Http\Resources\CategoryResource;

class StoreController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  SaveCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SaveCategoryRequest $request)
    {
        $result = $this->service->store($request->only('name', 'enable'));

        return new CategoryResource($result);
    }
}
