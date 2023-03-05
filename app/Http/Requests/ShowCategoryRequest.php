<?php

namespace App\Http\Requests;

use App\Contracts\Models\Category;
use App\Contracts\Services\Entities\CategoryService;
use App\Http\Resources\CategoryResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShowCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $service = app()->make(CategoryService::class);
        $category = $service->findById($this->id);
        if (!($category instanceof Category)) {
            $resource = new CategoryResource([
                'errors' => [
                    'message' => 'Entity not found!'
                ],
            ]);

            throw new HttpResponseException($resource->response());
        }
        
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
