<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCashRequest extends FormRequest
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
            'title' => 'required|unique:cashes,title',
            'attachment' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,bmp,doc,docx,pdf,tif,tiff,xlsx,xls,csv'
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
            'title.required' => 'يجب إدخال بند الكاش',
            'title.unique' => 'يجب أن يكون بند الكاش فريد',
            'attachment.mimes' => 'نوع الملف غير صالح .',
        ];
    }
}
