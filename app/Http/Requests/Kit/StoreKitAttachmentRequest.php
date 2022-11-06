<?php

namespace App\Http\Requests\Kit;

use Illuminate\Foundation\Http\FormRequest;

class StoreKitAttachmentRequest extends FormRequest
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
            'attachment' => 'required|file|mimes:csv,txt,jpeg,jpg,png,gif,svg,bmp,doc,docx,pdf,tif,tiff,xlsx,xls'
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
            'title.*' => 'يجب إدخال عنوان ',
            'attachment.*' => 'يجب إدخال الملف ',
        ];
    }
}
