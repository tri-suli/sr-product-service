<?php

namespace App\Http\Requests;

use App\Http\Resources\ProductResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'product_id' => ['required', 'exists:products,id']
        ];
    }

    /**
    * Get the error messages for the defined validation rules.*
    *
    * {@override}
    */
    protected function failedValidation(Validator $validator)
    {
        if (request()->wantsJson()) {
            $resource = new ProductResource([
                'errors' => $validator->errors(),
            ]);

            throw new HttpResponseException($resource->response());
        }

        return parent::failedValidation($validator);
    }
}
