<?php

namespace App\Http\Requests\OutgoingInvoice;

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
            'warehouse_id' => 'required',
            'pay_type' => 'required',
            'cash_id' =>'required_if:pay_type,true',
            'people_id' => 'required',
            'discount' => 'numeric',
            'date' => 'required|date',
            'content' => $this->request->all()["kit"] == [] ? 'required' : '',
            'content.*.product_id' => $this->request->all()["kit"] == [] ? 'required|numeric' : '',
            'content.*.price' => $this->request->all()["kit"] == [] ? 'required|numeric|min:0' : '',
            'content.*.quantity' => $this->request->all()["kit"] == [] ? 'required|numeric|min:0' : '',
            'kit' => $this->request->all()["content"] == [] ? 'required' : '',
            'kit.*.kit_id' => $this->request->all()["content"] == [] ? 'required|numeric' : '',
            'kit.*.quantity' => $this->request->all()["content"] == [] ? 'required|numeric|min:0' : '',
            'kit.*.price' => $this->request->all()["content"] == [] ? 'required|numeric|min:0' : '',
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
            'warehouse_id.*' => 'يجب إدخال المخزن المستقبل ',
            'cash_id.*' => 'يجب إدخال نوع الكاش  ',
            'discount.*' => 'يجب أن يكون الخصم رقم',
            'people_id.*' => 'يجب إدخال  الشركه  ',
            'date.*' => 'يجب إدخال تاريخ الفاتوره',
            'content.*' => 'يجب إدخال محتوى الفاتورة',
            'content.*.product.*' => 'يجب إدخال المنتجات للفاتورة',
            'content.*.price.*' => 'يجب إدخال أسعار المنتجات فى الفاتورة',
            'content.*.quantity.*' =>  'يجب إدخال كميه المنتج فى الفاتورة',
            'content.*.price.*' => 'يجب إدخال أسعار المنتجات فى الفاتورة',
            'content.*.quantity.*' => 'يجب إدخال كميه المنتج فى الفاتورة',
            'content.*.price.*' => 'يجب إدخال أسعار المنتجات فى الفاتورة',
            'content.*.quantity.*' => 'يجب إدخال كميه المنتج فى الفاتورة',
            'kit.*' => 'يجب إدخال محتوى الفاتورة',
            'kit.*.kit_id.*' => 'يجب إدخال المنتجات للفاتورة',
            'kit.*.quantity.*' =>  'يجب إدخال كميه قطع الغيار فى الفاتورة',
            'kit.*.price.*' =>  'يجب إدخال سعر قطع الغيار فى الفاتورة',
        ];
    }
}
