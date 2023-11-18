<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $name, $slug, $status, $brand_id,$category_id;
    
    public function rules()
    {
        return [
            'name' => 'required|string',
            'status' => 'nullable',
            "category_id" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống',
            'name.string' => ':attribute phải là ký tự chữ',
            'category_id.required' => ':attribute không được để trống',
            'category_id.integer' => ':attribute phải là ký tự số',
        ];
    }

    public function attributes()
    {
        return [
            'name' => "Nhà xuất bản",
        ];
    }

    public function resetInput(){
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
        $this->category_id = NULL;
    }

    public function storeBrand(){

        $validatedData = $this->validate();

        Brand::create([
            "name" => $this->name,
            "slug" => Str::slug($this->name),
            "status" => $this->status == true ? "1" : "0",
            "category_id" => $this->category_id,
        ]);
        session()->flash("message","Đã thêm nhà xuất bản thành công!!");
        $this->dispatch("close-modal");
        $this->resetInput();
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function openModal(){
        $this->resetInput();
    }

    public function editBrand(int $brand_id){
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);

        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand(){
        $validatedData = $this->validate();

        Brand::findOrFail($this->brand_id)->update([
            "name" => $this->name,
            "slug" => Str::slug($this->name),
            "status" => $this->status == true ? "1" : "0",
            "category_id" => $this->category_id,
        ]);
        session()->flash("message","Cập nhật nhà xuất bản thành công!!");
        $this->dispatch("close-modal");
        $this->resetInput();
    }

    public function deleteBrand(int $brand_id){
        $this->brand_id = $brand_id;
    }

    public function destroyBrand(){
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash("message","Xóa nhà xuất bản thành công!!");
        $this->dispatch("close-modal");
        $this->resetInput();
    }


    public function render()
    {
        $categories = Category::where("status","1")->get();
        $brands = Brand::orderBy("id","DESC")->paginate(10);
        return view('livewire.admin.brand.index',compact("brands","categories"))->extends('layouts.admin')->section("content");
    }
}
