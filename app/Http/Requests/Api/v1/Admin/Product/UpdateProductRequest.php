<?php

namespace App\Http\Requests\Api\v1\Admin\Product;

use App\Exceptions\Api\v1\NotFoundException;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'between:3, 100',
                Rule::unique('products')->ignore($this->route('product'))
            ],
            'description' => [
                'sometimes',
                'string',
                'min:10'
            ],
            'status' => [
                'sometimes',
                'boolean:strict'
            ],
            'subcategory_id' => [
                'required',
                'exists:subcategories,id'
            ],
            'brand_id' => [
                'required',
                'exists:brands,id'
            ]
        ];
    }

    protected function prepareForValidation(): void
    {
        $id = $this->route('product');
        if (!Product::find($id)) {
            throw new NotFoundException();
        }
    }
}
