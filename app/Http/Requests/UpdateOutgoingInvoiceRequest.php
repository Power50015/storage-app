<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOutgoingInvoiceRequest extends FormRequest
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
            'people' => 'required',
            'warehouses' => 'required',
            'pay_type' => 'required',
            'cash_type' =>'required_if:pay_type,true',
            'discount' => 'numeric',
            'date' => 'required|date',
            'content' => 'required|array',
            'content.*.product_id' => 'required',
            'content.*.price' => 'required|numeric|min:0.01',
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
            'people.required' => 'يجب إدخال المورد',
            'warehouses.required' => 'يجب إدخال المخزن المستقبل ',
            'cash_type.required_if' => 'يجب إدخال نوع الكاش  ',
            'discount.numeric' => 'يجب أن يكون الخصم رقم',
            'date.required' => 'يجب إدخال تاريخ الفاتوره',
            'date.date' => 'يجب إدخال تاريخ الفاتوره',
            'number.required' => 'يجب إدخال رقم الفاتورة',
            'content.*' => 'يجب إدخال محتوى الفاتورة',
            'content.*.product_id.required' => 'يجب إدخال المنتجات للفاتورة',
            'content.*.price.required' => 'يجب إدخال أسعار المنتجات فى الفاتورة',
            'content.*.quantity.required' =>  'يجب إدخال كميه المنتج فى الفاتورة',
            'content.*.price.numeric' => 'يجب إدخال أسعار المنتجات فى الفاتورة',
            'content.*.quantity.numeric' => 'يجب إدخال كميه المنتج فى الفاتورة',
            'content.*.price.min' => 'يجب إدخال أسعار المنتجات فى الفاتورة',
            'content.*.quantity.min' => 'يجب إدخال كميه المنتج فى الفاتورة',
        ];
    }
}
