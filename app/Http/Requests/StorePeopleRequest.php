<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeopleRequest extends FormRequest
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
            'name' => 'required|unique:people,name',
            'phone' => 'nullable|numeric|unique:people,phone',
            'type' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
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
            'name.required' => 'يجب إدخال أسم الشركه',
            'name.unique' => 'يجب أن يكون أسم الشركه فريد',
            'phone.numeric' => 'يجب أن يكون رقم الشركه رقم',
            'phone.unique' => 'يجب أن يكون رقم الشركه فريد',
            'type.required' => 'يجب إدخال نوع الشركه',
            'logo.image' => 'يجب إدخال شعار الشركه',
        ];
    }
}
