<?php

namespace App\Http\Requests\Cash;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCashPayRequest extends FormRequest
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
           'cash_id' => 'required',
           'amount' => 'required|numeric',
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
           'title.*' => 'يجب إدخال بند الدين',
           'amount.*' => 'يجب إدخال المبلغ',
           'cash_id.*' => 'يجب إدخال نوع الكاش',
       ];
   }
}
