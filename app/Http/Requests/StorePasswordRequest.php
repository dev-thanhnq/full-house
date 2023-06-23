<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'pass' => 'required|min:6|max:255|',
            'newPass' => 'required|min:6|max:255||same:pass'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống!',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'same' => ':attribute không giống nhau'
        ];
    }

    public function attributes()
    {
        return [
            'pass' => 'Mật khẩu',
            'newPass' => 'Mật khẩu',
        ];
    }
}
