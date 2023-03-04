<?php

namespace App\Http\Controllers\FullRestApi\Categories;

use App\Contracts\Services\Entities\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class ListController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $result = $this->service->all();

        return new CategoryResource($result);
    }
}
