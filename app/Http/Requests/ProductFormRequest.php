<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string',
            'author' => 'required|string|max:255',
            'small_description' => 'required|string',
            'description' => 'required|string',
            'original_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'quantity' => 'required|integer',
            'trending' => 'nullable',
            'status' => 'nullable',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
            'image' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên :attribute không được để trống',
            'name.string' => 'Tên :attribute phải là ký tự chữ',

            'author.required' => 'Tên :attribute không được để trống',
            'author.string' => 'Tên :attribute phải là ký tự chữ',
            'author.max' => 'Tên :attribute đối đa 255 kí tự',

            'author.required' => 'Tên :attribute không được để trống',
            'author.string' => 'Tên :attribute phải là ký tự chữ',

            'small_description.required' => ':attribute không được để trống',
            'small_description.string' => 'Tên :attribute phải là ký tự chữ',

            'description.required' => ':attribute không được để trống',
            'description.string' => 'Tên :attribute phải là ký tự chữ',

            'original_price.required' => ':attribute không được để trống',
            'original_price.integer' => 'Tên :attribute phải là số',

            'selling_price.required' => ':attribute không được để trống',
            'selling_price.integer' => 'Tên :attribute phải là số',

            'quantity.required' => ':attribute không được để trống',
            'quantity.integer' => 'Tên :attribute phải là số',

            'meta_title.required' => ':attribute không được để trống',
            'meta_title.string' => ':attribute phải là ký tự chữ',

            'meta_keyword.required' => ':attribute không được để trống',
            'meta_keyword.string' => ':attribute phải là ký tự chữ',
            'meta_keyword.max' => 'Tên :attribute đối đa 255 kí tự',

            'meta_description.required' => ':attribute không được để trống',
            'meta_description.string' => ':attribute phải là ký tự chữ',

            // 'image.mimetypes' => ':attribute phải là đuôi jpg,jpeg,png.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => "sản phẩm",
            'small_description' => 'Mô tả ngắn',
            'description' => 'Mô tả',
            'author' => "Tác giả",
            'image' => "Ảnh",
            'original_price' => 'Giá gốc',
            'selling_price' => 'Giá khuyết mãi',
            'quantity' => 'Số lượng',       
            'meta_title' => 'Tiêu đề meta',
            'meta_keyword' => 'Từ khóa meta',
            'meta_description' => 'Mô tả meta',
        ];
    }
}
