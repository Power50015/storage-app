<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'amount' => 'required|numeric|min:0.1',
            'date' => 'required|date',
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
            'title.required' => 'يجب إدخال بند المصروف',
            'amount.required' => 'يجب إدخال المصروف',
            'amount.numeric' => 'يجب إدخال مبلغ المصروف',
            'amount.min' => 'يجب إدخال مبلغ المصروف',
            'date.required' => 'يجب إدخال تاريخ المصروف',
            'date.date' => 'يجب إدخال تاريخ المصروف',
        ];
    }
}
