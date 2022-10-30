<?php

namespace App\Http\Requests\Product;

use App\Models\Product\ProductType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductTypeRequest extends FormRequest
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
        $ProductType = ProductType::find($this->id);
        if ($ProductType->name == $this->name)
            return [
                'name' => 'required',
            ];

        return [
            'name' => 'required|unique:product_categories,name',
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
            'name.required' => 'يجب إدخال قسم المنتج',
            'name.unique' => 'يجب أن يكون أسم القسم فريد',
        ];
    }
}
