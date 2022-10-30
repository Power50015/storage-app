<?php

namespace App\Http\Requests\Product;

use App\Models\Product\ProductBrand;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductBrandRequest extends FormRequest
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
        $ProductBrand = ProductBrand::find($this->id);
        if ($ProductBrand->name == $this->name)
            return [
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
                'product_country_id' => 'required',

            ];
        return [
            'name' => 'required|unique:product_brands,name',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
            'product_country_id' => 'required',

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
            'name.required' => 'يجب إدخال أسم الماركه',
            'name.unique' => 'يجب أن يكون أسم الماركه فريد',
            'image.*' => 'يجب إدخال صوره للماركه',
            'product_country_id.required' => 'يجب إدخال بلد الماركه',
        ];
    }
}
