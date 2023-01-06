<?php

namespace App\Http\Requests\Transfer;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
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
            'warehouse_from_id' => 'required',
            'warehouse_to_id' => 'required',
            'date' => 'required|date',
            'content' => 'required_if:kit,[]|array',
            'content.*.product' => 'required_if:kit,[]',
            'content.*.quantity' => 'required_if:kit,[]|numeric|min:1',
            'kit' => 'required_if:content,[]|array',
            'kit.*.kit' => 'required_if:content,[]',
            'kit.*.quantity' => 'required_if:content,[]|numeric|min:1',
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
            'content.*.product.required' => 'يجب إدخال المنتجات للنقله',
            'content.*.quantity.required' =>  'يجب إدخال كميه المنتج فى النقله',
            'content.*.quantity.numeric' => 'يجب إدخال كميه المنتج فى النقله',
            'content.*.quantity.min' => 'يجب إدخال كميه المنتج فى النقله',
            'kit.*' => 'يجب إدخال محتوى النقله',
            'kit.*.kit.required' => 'يجب إدخال المنتجات للنقله',
            'kit.*.quantity.required' =>  'يجب إدخال كميه قطع الغيار فى النقله',
        ];
    }
}
