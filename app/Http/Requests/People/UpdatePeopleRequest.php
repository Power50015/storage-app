<?php

namespace App\Http\Requests\People;

use App\Models\People\People;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePeopleRequest extends FormRequest
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
        $People = People::find($this->id);
        if ($People->name == $this->name)
            return [
                'name' => 'required',
                'phone' => 'nullable|numeric',
                'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg'
            ];
        return [
            'name' => 'required|unique:people,name',
            'phone' => 'nullable|numeric',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg'
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
            'logo.*' => 'يجب إدخال شعار الشركه',
        ];
    }
}
