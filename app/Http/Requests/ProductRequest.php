<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:0,1',
        ];

        // Chỉ validate ảnh khi có file upload mới
        if ($this->hasFile('img')) {
            $rules['img'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc',
            'price.required' => 'Giá sản phẩm là bắt buộc',
            'price.numeric' => 'Giá phải là số',
            'img.required' => 'Ảnh là bắt buộc',
            'img.image' => 'File phải là ảnh',
            'category_id.required' => 'Danh mục là bắt buộc',
            'status.required' => 'Trạng thái là bắt buộc',
        ];
    }
}
