<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:1|max:255',
            'email' => 'required|email|unique:users|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
            'role' => 'required',
            'address' => 'max:300',
            'phone' => 'max:10',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'unique' => ':attribute đã tồn tại!'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Họ tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'role' => 'Quyền',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
        ];
    }
}
