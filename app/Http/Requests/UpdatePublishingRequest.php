<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublishingRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên Nhà sản xuất',
        ];
    }
}
