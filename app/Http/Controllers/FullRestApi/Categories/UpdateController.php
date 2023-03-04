<?php

namespace App\Http\Controllers\FullRestApi\Categories;

use App\Contracts\Services\Entities\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCategoryRequest;
use App\Http\Resources\CategoryResource;

class UpdateController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SaveCategoryRequest $request, int $id)
    {
        $result = $this->service->update(
            $id, $request->only('name', 'enable')
        );

        return new CategoryResource($result);
    }
}
