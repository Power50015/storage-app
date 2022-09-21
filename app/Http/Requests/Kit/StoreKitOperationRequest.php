<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKitOperationRequest extends FormRequest
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
            'action' => 'required|numeric',
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
            'title.required' => 'يجب إدخال الملاحظه .',
            'quantity.required' => 'يجب إدخال الملاحظه .',
            'action.required' => 'يجب إدخال الملاحظه .',
        ];
    }
}
