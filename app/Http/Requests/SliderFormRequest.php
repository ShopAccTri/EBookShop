<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderFormRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:800',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ':attribute không được để trống',
            'title.string' => ':attribute phải là ký tự chữ',
            'title.max' => ':attribute không được quá 255 kí tự',
            'description.required' => ':attribute không được để trống',
            'description.string' => ':attribute phải là ký tự chữ',
            'image.image' => ':attribute phải là ảnh',
            'image.mime' => ':attribute phải là có đuôi ảnh',
        ];
    }

    public function attributes()
    {
        return [
            'title' => "Tiều đề",
            'description' => 'Mô tả',
            'image' => 'Ảnh',
        ];
    }
}
