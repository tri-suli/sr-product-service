<?php

namespace App\Http\Controllers\FullRestApi\Categories;

use App\Contracts\Services\Entities\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;    
    }

    /**
     * Handle the incoming request.
     *
     * @param  DeleteCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DeleteCategoryRequest $request)
    {
        $id = $request->category_id;
        $isDeleted = $this->service->delete($id);

        if (!$isDeleted) {
            return new CategoryResource(['errors' => "Cannot delete entity with key [{$id}]"]);
        }

        return new CategoryResource(['message' => 'Entity deleted']);
    }
}
