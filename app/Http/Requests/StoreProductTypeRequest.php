<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductTypeRequest extends FormRequest
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
            'nameProductType' => 'required|unique:product_types,name',
            'productCategory' => 'required',
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
            'nameProductType.required' => 'يجب إدخال نوع المنتج',
            'nameProductType.unique' => 'يجب أن يكون أسم النوع فريد',
            'productCategory.required' => 'يجب إدخال قسم المنتج',
        ];
    }
}
