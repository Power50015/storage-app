<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseStockRequest extends FormRequest
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
            'warehouse_id' => 'required',
            'date' => 'required|date',
            'content' => $this->request->all()["kit"] == [] ? 'required' : '',
            'content.*.product_id' => $this->request->all()["kit"] == [] ? 'required|numeric' : '',
            'content.*.price' => $this->request->all()["kit"] == [] ? 'required|numeric|min:0' : '',
            'content.*.quantity' => $this->request->all()["kit"] == [] ? 'required|numeric|min:0' : '',
            'kit' => $this->request->all()["content"] == [] ? 'required' : '',
            'kit.*.kit_id' => $this->request->all()["content"] == [] ? 'required|numeric' : '',
            'kit.*.quantity' => $this->request->all()["content"] == [] ? 'required|numeric|min:0' : '',
            'kit.*.price' => $this->request->all()["content"] == [] ? 'required|numeric|min:0' : '',
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
            'title.*' => 'يجب إدخال البند',
            'date.*' => 'يجب ادخال تاريخ',
            'warehouse_id.*' => 'يجب إدخال المخزن  ',
            'content.*' => 'يجب إدخال محتوى المخزون',
            'content.*.product_id.*' => 'يجب إدخال المنتجات للمخزون',
            'content.*.quantity.*' =>  'يجب إدخال كميه المنتج فى المخزون',
            'kit.*' => 'يجب إدخال محتوى المخزون',
            'kit.*.kit_id.*' => 'يجب إدخال المنتجات للمخزون',
            'kit.*.quantity.*' =>  'يجب إدخال كميه المنتج فى المخزون',
        ];
    }
}
