<?php

namespace App\Http\Requests\Warehouse;

use App\Models\Warehouse\Warehouse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseRequest extends FormRequest
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
        $warehouse = Warehouse::find($this->id);
        if ($warehouse->name == $this->name)
            return [
                'name' => 'required',
            ];

        return [
            'name' => 'required|unique:warehouses,name',
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
            'name.required' => 'يجب إدخال اسم المخزن',
            'name.unique' => 'يجب أن يكون الأسم فريد',
        ];
    }
}
