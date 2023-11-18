<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống',
            'name.string' => ':attribute phải là ký tự chữ',
            'description.required' => ':attribute không được để trống',
            'meta_title.required' => ':attribute không được để trống',
            'meta_title.string' => ':attribute phải là ký tự chữ',
            'meta_keyword.required' => ':attribute không được để trống',
            'meta_keyword.string' => ':attribute phải là ký tự chữ',
            'meta_description.required' => ':attribute không được để trống',
            'meta_description.string' => ':attribute phải là ký tự chữ',
        ];
    }

    public function attributes()
    {
        return [
            'name' => "Thể loại",
            'description' => 'Mô tả',
            'image' => 'Ảnh',
            'meta_title' => 'Tiêu đề meta',
            'meta_keyword' => 'Từ khóa meta',
            'meta_description' => 'Mô tả meta',
        ];
    }
}
