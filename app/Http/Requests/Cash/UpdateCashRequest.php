<?php

namespace App\Http\Requests\Cash;

use App\Models\Cash\Cash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCashRequest extends FormRequest
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
        $cash = Cash::find($this->id);
        if ($cash->title == $this->title)
            return [
                'title' => 'required',
            ];

        return [
            'title' => 'required|unique:cashes,title',
        ];
    }
}
