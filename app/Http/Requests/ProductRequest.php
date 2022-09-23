<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'detail' => 'required|string',
            'price' => 'required|numeric|between:0,999999.99',
            'stock' => 'required|integer|digits_between:0,6',
            'discount' => 'required|integer|between:0,30',
        ];
    }
}
