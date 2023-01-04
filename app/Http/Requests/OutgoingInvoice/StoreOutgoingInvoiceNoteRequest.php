<?php

namespace App\Http\Requests\OutgoingInvoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreOutgoingInvoiceNoteRequest extends FormRequest
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
            'note' => 'required',
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
            'note.required' => 'يجب إدخال الملاحظه .',
        ];
    }
}
