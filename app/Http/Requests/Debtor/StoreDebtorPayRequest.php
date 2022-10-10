<?php

namespace App\Http\Requests\Debtor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDebtorPayRequest extends FormRequest
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
            'company' => 'numeric',
            'pay_type' => 'required',
            'cash_type' => 'required_if:pay_type,true',
            'amount' => 'required|numeric',
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
            'title.required' => 'يجب إدخال بند الدين',
            'company.required' => 'يجب إدخال الشركه',
            'amount.required' => 'يجب إدخال المخزن المبلغ',
            'amount.numeric' => 'يجب أن يكون المبلغ رقم',
            'cash_type.required_if' => 'يجب إدخال نوع الكاش',
            'pay_type.required' => 'يجب إدخال نوع الدفع',
        ];
    }
}
