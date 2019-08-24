<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceptionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       if ($this->path() == 'reception/confirm')
       {
            return true;
       } else {
            return false;
       }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'peoples' => 'required|numeric',
            'seat_id' => 'numeric',
            'smoke_id' => 'numeric',
            'tell_number' => 'regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',
        ];
    }

    public function messages()
    {
        return [
            'peoples.required'  => '人数を入力してください',
            'peoples.numeric'   => '半角数字で入力してください',
            'seat_id.numeric'   => '半角数字で入力してください',
            'smoke_id.numeric'  => '半角数字で入力してください',
            'tell_number.regex' => '半角数字で入力してください',
        ];
    }
}
