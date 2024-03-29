<?php

namespace App\Http\Requests\Driver;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|unique:drivers,phone',
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
            'name.required' => 'يجب إدخال أسم السائق',
            'phone.unique' => 'يجب أن يكون رقم الهاتف للسائق فريد',
            'phone.required' => 'يجب إدخال رقم الهاتف للسائق',
        ];
    }
}
