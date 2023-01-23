<?php

namespace App\Http\Requests\Debtor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDebtorPayRequest extends FormRequest
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
            'people_id' => 'required|numeric',
            'pay_type' => 'required',
            'cash_id' => 'required_if:pay_type,true',
            'amount' => 'required|numeric',
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
            'people_id.*' => 'يجب إدخال الشركه',
            'amount.*' => 'يجب إدخال المبلغ',
            'cash_type.*' => 'يجب إدخال نوع الكاش',
            'pay_type.*' => 'يجب إدخال نوع الدفع',
        ];
    }
}
