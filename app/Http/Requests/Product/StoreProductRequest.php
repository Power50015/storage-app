<?php

namespace App\Http\Requests\Product;

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
        // dd($this->request);
        return [
            'product_category_id' => 'required|exists:product_categories,id',
            'product_type_id' => 'required|exists:product_types,id',
            'product_brand_id' => 'nullable|exists:product_brands,id',
            'product_collection_id' => 'nullable|exists:product_collections,id',
            'product_model_id' => 'nullable|exists:product_models,id',
            'name' => 'required',
            'product_color_id' => 'required|exists:product_colors,id',
            'product_material_id' => 'required|exists:product_materials,id',
            'product_country_id' => 'required|exists:product_countries,id',
            'description' => 'nullable',
            'sku' => 'nullable',
            'price' => 'nullable',
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
            'product_category_id.*' => 'يجب إدخال قسم المنتج',
            'product_type_id.*' => 'يجب إدخال نوع المنتج',
            'name.*' => 'يجب إدخال اسم المنتج',
            'product_color_id.*' => 'يجب إدخال لون المنتج',
            'product_material_id.*' => 'يجب إدخال خامه المنتج',
            'product_country_id.*' => 'يجب إدخال بلد المنتج',
            'image.*' => 'يجب إدخال صوره المنتج',
        ];
    }
}
