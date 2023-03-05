<?php

namespace App\Http\Requests;

use App\Http\Resources\ProductResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveProductRequest extends FormRequest
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
            'name' => ['required', 'max:100'],
            'description' => ['required'],
            'images' => ['nullable', 'array', 'filled'],
            'images.*' => ['image'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'enable' => ['nullable', 'boolean']
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
