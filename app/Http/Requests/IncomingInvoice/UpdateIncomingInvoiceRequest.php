<?php

namespace App\Http\Requests\IncomingInvoice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomingInvoiceRequest extends FormRequest
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
            'number' => 'required',
            'warehouse_id' => 'required',
            'pay_type' => 'required',
            'people_id' => 'required',
            'cash_id' =>'required_if:pay_type,true',
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
            'number.*' => 'يجب إدخال رقم الفاتورة',
            'warehouse_id.*' => 'يجب إدخال المخزن المستقبل ',
            'cash_id.*' => 'يجب إدخال نوع الكاش  ',
            'people_id.*' => 'يجب إدخال  الشركه  ',
            'discount.*' => 'يجب أن يكون الخصم رقم',
            'date.*' => 'يجب إدخال تاريخ الفاتوره',
            'content.*' => 'يجب إدخال محتوى الفاتورة',
            'content.*.product_id.*' => 'يجب إدخال المنتجات للفاتورة',
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
