<?php

namespace App\Http\Requests\Api\v1\Admin\Cover;

use App\Exceptions\Api\v1\NotFoundException;
use App\Models\Cover;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateCoverRequest extends FormRequest
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
            'title' => [
                'sometimes',
                'required',
                'string',
                'between:3, 100',
                'unique:covers,title'

            ],
            'start_at' => [
                'sometimes',
                'required',
                Rule::date()->afterOrEqual(today())
            ],
            'end_at' => [
                'sometimes',
                'nullable',
                Rule::date()->afterOrEqual($this->input('start_at'))
            ],
            'image' => [
                'sometimes',
                'required',
                File::image()
            ],
            'status' => [
                'sometimes',
                'boolean:strict'
            ],
            'order' => [
                'sometimes',
                'integer:strict'
            ]
        ];
    }

    protected function prepareForValidation(): void
    {
        $id = $this->route('cover');
        if (!Cover::find($id)) {
            throw new NotFoundException();
        }
    }
}
