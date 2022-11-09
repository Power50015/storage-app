<?php

namespace App\Http\Requests\Creditor;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditorPayRequest extends FormRequest
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
            'people_id' => 'required',
            'pay_type' => 'required',
            'cash_type' => 'required_if:pay_type,true',
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
            'title.required' => 'يجب إدخال بند الدين',
            'people_id.required' => 'يجب إدخال الشركه',
            'amount.*' => 'يجب إدخال المبلغ',
            'cash_type.required_if' => 'يجب إدخال نوع الكاش',
            'pay_type.required' => 'يجب إدخال نوع الدفع',
        ];
    }
}
