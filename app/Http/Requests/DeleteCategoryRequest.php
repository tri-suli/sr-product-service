<?php

namespace App\Http\Requests;

use App\Http\Resources\CategoryResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteCategoryRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id']
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
            $resource = new CategoryResource([
                'errors' => $validator->errors(),
            ]);

            throw new HttpResponseException($resource->response());
        }

        return parent::failedValidation($validator);
    }
}
