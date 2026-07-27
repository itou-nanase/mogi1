<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'product_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'categories'    => 'required|array',
            'categories.*' => 'exists:categories,id',
            'condition'     => 'required|exists:conditions,id',
            'name'          => 'required|string|max:255',
            'brand'         => 'nullable|string|max:255',
            'description'   => 'required|string',
            'price'         => 'required|integer|min:1',
        ];
    }

}
