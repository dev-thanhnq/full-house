<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'sale_price' => 'required|min:1',
            'discount_percent' => 'nullable|integer|min:1',
            'total' => 'integer|min:1',
            'content' => 'max:5000',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|required|max:10000',
            'status' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'image' => 'File không hợp lệ',
            'integer' => ':attribute phải là kiểu số',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'category_id' => 'Danh mục',
            'author_id' => 'Tác giả',
            'publishing_company_id' => 'Nhà sản xuất',
            'origin_price' => 'Giá gốc',
            'discount_percent' => 'Phần trăm giảm giá',
            'content' => 'Mô tả',
            'status' => 'Trạng thái',
            'image' => 'Ảnh sản phẩm',
            'total' => 'Số lượng',
        ];
    }
}
