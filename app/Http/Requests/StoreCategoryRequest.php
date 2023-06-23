<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'parent_id' => ''
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống!',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'parent_id' => 'Danh mục cha'
        ];
    }
}
