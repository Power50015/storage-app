<?php

namespace App\Http\Requests;

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
            'Rdate' => 'required|date',
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
            'Rdate.required' => 'يجب إدخال تاريخ الفاتوره',
            'Rdate.date' => 'يجب إدخال تاريخ الفاتوره',
        ];
    }
}
