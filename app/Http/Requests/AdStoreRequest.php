<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'title' => ['required'],
            'description' => ['required'],
            'attributes' => ['array'],
            'attributes.*.attribute_id' => ['required', 'numeric', Rule::exists('attributes', 'id')],
            'attributes.*.value' => ['required'],
        ];
    }
}
