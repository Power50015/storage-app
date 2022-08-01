<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
{/**
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
            'warehouseFrom' => 'required',
            'warehouseTo' => 'required',
            'date' => 'required|date',
            'content' => 'required|array',
            'content.*.product' => 'required',
            'content.*.quantity' => 'required|numeric|min:1',
            'attachment' => 'nullable|array',
            'attachment.*.attachment' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,bmp,doc,docx,pdf,tif,tiff,xlsx,xls,csv',
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
            'warehouseFrom.required' => 'يجب إدخال المخزن المورد ',
            'warehouseTo.required' => 'يجب إدخال المخزن المستقبل ',
            'date.*' => 'يجب إدخال التاريخ ',
            'content.*' => 'يجب إدخال محتوى النقله',
            'content.*.product.required' => 'يجب إدخال المنتجات النقله',
            'content.*.quantity.required' =>  'يجب إدخال كميه المنتج فى النقله',
            'content.*.quantity.numeric' => 'يجب إدخال كميه المنتج فى النقله',
            'content.*.quantity.min' => 'يجب إدخال كميه المنتج فى النقله',
        ];
    }
}
