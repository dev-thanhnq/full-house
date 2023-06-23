<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'address' => 'required|min:1|max:255',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users',
            'phone' => 'required|max:10',
            'password' => 'required|min:6|max:255|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'email' => ':attribute phải có dạng email',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Họ tên',
            'address' => 'Địa chỉ',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Xác nhận mật khẩu',
        ];
    }
}
