<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseStockRequest extends FormRequest
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
            'title' => 'required',
            'warehouses' => 'required',
            'content' => 'required_if:kit.*,null|array',
            'content.*.product' => 'required_if:kit.*,null',
            'content.*.quantity' => 'required_if:kit.*,null|numeric|min:1',
            'attachment' => 'nullable|array',
            'attachment.*.attachment' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,bmp,doc,docx,pdf,tif,tiff,xlsx,xls,csv',
            'kit' => 'required_if:content.*,null|array',
            'kit.*.product' => 'required_if:content.*,null',
            'kit.*.quantity' => 'required_if:content.*,null|numeric|min:1',
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
            'title.required' => 'يجب إدخال البند',
            'warehouses.required' => 'يجب إدخال المخزن  ',
            'content.*' => 'يجب إدخال محتوى المخزون',
            'content.*.product.required_if' => 'يجب إدخال المنتجات للمخزون',
            'content.*.quantity.required_if' =>  'يجب إدخال كميه المنتج فى المخزون',
            'content.*.quantity.numeric' => 'يجب إدخال كميه المنتج فى المخزون',
            'content.*.quantity.min' => 'يجب إدخال كميه المنتج فى المخزون',
        ];
    }
}
