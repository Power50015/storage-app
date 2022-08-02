<?php

namespace App\Http\Requests;

use App\Models\Warehouse;
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
        if ($warehouse->name == $this->nameEdit)
            return [
                'nameEdit' => 'required',
            ];

        return [
            'nameEdit' => 'required|unique:warehouses,name',
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
            'nameEdit.required' => 'يجب إدخال اسم المخزن',
            'nameEdit.unique' => 'يجب أن يكون الأسم فريد',
        ];
    }
}
