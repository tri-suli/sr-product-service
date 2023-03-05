<?php

namespace App\Http\Requests;

use App\Contracts\Models\Product;
use App\Contracts\Services\Entities\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShowProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $service = app()->make(ProductService::class);
        $product = $service->findById($this->id);
        if (!($product instanceof Product)) {
            $resource = new ProductResource([
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
