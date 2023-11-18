<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view("admin.slider.list",compact("sliders"));
    }

    public function create(){
        return view("admin.slider.create");
    }

    public function store(SliderFormRequest $request){

        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move("uploads/slider",$filename);

            $validatedData["image"] = "uploads/slider/$filename";
        }

        $validatedData["status"] = $request->status == true ? "1" : "2";

        Slider::create([
            'title' => $request->input("title"),
            'description' => $request->input("description"),
            'image' => $validatedData["image"],
            'status' => $validatedData["status"],
        ]);

        return redirect("admin/sliders")->with("message","Thêm Slider thành công!");
    }

    public function edit(Slider $slider){
        return view("admin.slider.edit",compact("slider"));
    }

    public function update(SliderFormRequest $request,Slider $slider){
        
        $validatedData = $request->validated();

        if($request->hasFile('image')){

            $destination = $slider->image;

            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file("image");
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move("uploads/slider",$filename);

            $validatedData["image"] = "uploads/slider/$filename";
        }else{
            $validatedData["image"] = $slider->image;
        }

        $validatedData["status"] = $request->status == true ? "1" : "2";

        Slider::where("id",$slider->id)->update([
            'title' => $request->input("title"),
            'description' => $request->input("description"),
            'image' => $validatedData["image"],
            'status' => $validatedData["status"],
        ]);

        return redirect("admin/sliders")->with("message","Cập nhật Slider thành công!");
    }

    public function destroy(Slider $slider){

        if($slider->count() > 0){
            $destination = $slider->image;

            if(File::exists($destination)){
                File::delete($destination);
            }
            $slider->delete();
            return redirect("admin/sliders")->with("message","Xóa Slider thành công!");
        }
        return redirect("admin/sliders")->with("message","Có lỗi xảy ra");
    }
}
