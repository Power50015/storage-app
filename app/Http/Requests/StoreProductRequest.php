<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category' => 'required|numeric',
            'type' => 'required|numeric',
            'name' => 'required',
            'color' => 'required|numeric',
            'material' => 'required|numeric',
            'country' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'category.required' => 'يجب إدخال قسم المنتج',
            'type.required' => 'يجب إدخال نوع المنتج',
            'name.required' => 'يجب إدخال اسم المنتج',
            'color.required' => 'يجب إدخال لون المنتج',
            'material.required' => 'يجب إدخال خامه المنتج',
            'country.required' => 'يجب إدخال بلد المنتج',
            'image.image' => 'يجب إدخال صوره المنتج',
            'image.required' => 'يجب إدخال صوره المنتج',
        ];
    }
}
