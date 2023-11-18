<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index(){
        return view("admin.category.list");
    }

    public function create(){
        return view("admin.category.create");
    }

    public function store(CategoryFormRequest $request){
        $data = new Category();

        $data->name = $request->input("name");
        $data->slug = Str::slug($request->input("name"));
        $data->description = $request->input("description");

        $uploadPath = "uploads/category/";

        if($request->hasFile('image')){
            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move("uploads/category",$filename);

           $data->image = $uploadPath.$filename;
        }

        $data->meta_title = $request->input("meta_title");
        $data->meta_keyword = $request->input("meta_keyword");
        $data->meta_description = $request->input("meta_description");

        $data->status = $request->status == true ? "1" : "0";

        $data->save();

        return redirect("admin/categories")->with("message","Thêm danh mục thành công!");
    }

    public function edit(Category $category){
        return view("admin.category.edit",compact("category"));
    }

    public function update(CategoryFormRequest $request,$category){

        $data = Category::findOrFail($category);

        $data->name = $request->input("name");
        $data->slug = Str::slug($request->input("name"));
        $data->description = $request->input("description");

        $uploadPath = "uploads/category/";

        if($request->hasFile('image')){

            $path = "uploads/category/".$data->image;

            if(File::exists($path)){
                File::delete($path);
            }

            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move("uploads/category",$filename);
            $data->image = $uploadPath.$filename;
        }


        $data->meta_title = $request->input("meta_title");
        $data->meta_keyword = $request->input("meta_keyword");
        $data->meta_description = $request->input("meta_description");

        $data->status = $request->status == true ? "1" : "0";

        $data->update();

        return redirect("admin/categories")->with("message","Sửa danh mục thành công!");
    }
}
