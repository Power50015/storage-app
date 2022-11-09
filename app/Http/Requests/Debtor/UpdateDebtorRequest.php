<?php

namespace App\Http\Requests\Debtor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDebtorRequest extends FormRequest
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
            'required' => 'required',
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
            'people_id.*' => 'يجب إدخال الشركه',
            'amount.*' => 'يجب إدخال المبلغ ',
        ];
    }
}
