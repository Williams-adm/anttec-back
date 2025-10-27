<?php

namespace App\Http\Requests\Api\v1\Admin\Product;

use App\Rules\Api\v1\Admin\Product\UniqueSpecificationIds;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
                'required',
                'string',
                'between:3, 100',
                'unique:products,name'
            ],
            'description' => [
                'nullable',
                'string',
                'min:10'
            ],
            'subcategory_id' => [
                'required',
                'exists:subcategories,id'
            ],
            'brand_id' => [
                'required',
                'exists:brands,id'
            ],
            'specifications' => [
                'required',
                'array',
                'min:1',
                new UniqueSpecificationIds,
            ],
            'specifications.*.specification_id' => [
                'required',
                'integer:strict',
                'exists:specifications,id'
            ],
            'specifications.*.value' => [
                'required',
                'string',
                'min:2'
            ]
        ];
    }
}
