<?php

namespace App\Http\Requests\Creditor;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditorRequest extends FormRequest
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
            'amount.*' => 'يجب إدخال  المبلغ ',
        ];
    }
}
