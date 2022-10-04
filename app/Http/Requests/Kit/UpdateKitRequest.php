<?php

namespace App\Http\Requests\Kit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKitRequest extends FormRequest
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
            'kit' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg',
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
            'title.required' => 'يجب إدخال بند قطعه الغيار',
            'kit.numeric' => 'يجب إدخال المنتج',
            'attachment.*' => 'يجب ملفات قطعه الغيار ',
            'attachment.*.*' => 'يجب ملفات قطعه الغيار ',
            'image.image' => 'يجب إدخال صوره قطعه الغيار',
        ];
    }
}
