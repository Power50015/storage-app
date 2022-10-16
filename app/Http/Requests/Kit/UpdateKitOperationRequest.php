<?php

namespace App\Http\Requests\Kit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKitOperationRequest extends FormRequest
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
            'quantity' => 'required|numeric|min:1',
            'action' => 'required',
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
            'title.required' => 'يجب إدخال البند .',
            'quantity.*' => 'يجب إدخال الكميه .',
            'date.*' => 'يجب إدخال تاريخ العمليه .',
        ];
    }
}
