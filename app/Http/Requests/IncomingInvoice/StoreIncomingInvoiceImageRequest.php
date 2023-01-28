<?php

namespace App\Http\Requests\IncomingInvoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomingInvoiceImageRequest extends FormRequest
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
            'image' => 'required|file|mimes:jpeg,jpg,png,gif,svg|size:5120'
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
            'image.*' => 'يجب إدخال صوره',
            'image.size' => 'يجب إدخال صوره اقل من 5 ميجا',
        ];
    }
}
