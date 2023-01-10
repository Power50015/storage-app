<?php

namespace App\Http\Requests\ReturnedIncomingInvoice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReturnedIncomingInvoiceRequest extends FormRequest
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
            'date.required' => 'يجب إدخال تاريخ المرتجع',
            'date.date' => 'يجب إدخال تاريخ المرتجع',
        ];
    }
}
