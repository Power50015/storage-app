<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductBrandRequest extends FormRequest
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
            'nameProductBrand' => 'required|unique:product_brands,name',
            'countryProductBrand' => 'required',
            'imageProductBrand' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
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
            'nameProductBrand.required' => 'يجب إدخال أسم الماركه',
            'nameProductBrand.unique' => 'يجب أن يكون أسم الماركه فريد',
            'countryProductBrand.required' => 'يجب إدخال بلد الماركه',
            'imageProductBrand.image' => 'يجب إدخال صوره للماركه',
        ];
    }
}
