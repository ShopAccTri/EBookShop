<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view("admin.products.list",compact("products"));
    }

    public function create(){
        $brands = Brand::all();
        $categories = Category::all();
        return view("admin.products.create",compact("categories","brands"));
    }

    public function store(ProductFormRequest $request){

        $category = Category::findOrFail($request->input("category_id"));

        $product = $category->products()->create([
            'brand_id' => $request->input("brand_id"),
            'category_id' => $request->input("category_id"),

            'name' => $request->input("name"),
            'slug' => Str::slug($request->input("name")),
            'author' => $request->input("author"),
            'description' => $request->input("description"),
            'small_description' => $request->input("small_description"),

            'quantity' => $request->input("quantity"),
            'original_price' => $request->input("original_price"),
            'selling_price' => $request->input("selling_price"),

            'meta_title' => $request->input("meta_title"),
            'meta_keyword' => $request->input("meta_keyword"),
            'meta_description' => $request->input("meta_description"),

            'trending' => $request->trending == true ? "1" : "0",
            'status' => $request->status == true ? "1" : "0",
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';

            $i = 1;
            foreach($request->file("image") as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]); 
            }
        }

        return redirect("admin/products")->with("message","Thêm sản phẩm thành công!");
    }

    public function edit(int $product_id){
        $product = Product::findOrFail($product_id);
        $brands = Brand::all();
        $categories = Category::all();
        return view("admin.products.edit",compact("product","categories","brands"));
    }

    public function update(ProductFormRequest $request,int $product_id){


        $product = Category::findOrFail($request->input("category_id"))->products()->where("id",$product_id)->first();

        if($product){
            $product->update([
                'brand_id' => $request->input("brand_id"),
                'category_id' => $request->input("category_id"),
    
                'name' => $request->input("name"),
                'slug' => Str::slug($request->input("name")),
                'author' => $request->input("author"),
                'description' => $request->input("description"),
                'small_description' => $request->input("small_description"),
    
                'quantity' => $request->input("quantity"),
                'original_price' => $request->input("original_price"),
                'selling_price' => $request->input("selling_price"),
    
                'meta_title' => $request->input("meta_title"),
                'meta_keyword' => $request->input("meta_keyword"),
                'meta_description' => $request->input("meta_description"),
    
                'trending' => $request->trending == true ? "1" : "0",
                'status' => $request->status == true ? "1" : "0",
            ]);

            if($request->hasFile('image')){
                $uploadPath = 'uploads/products/';
    
                $i = 1;
                foreach($request->file("image") as $imageFile){
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$extension;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName = $uploadPath.$filename;
    
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]); 
                }
            }
            return redirect("admin/products")->with("message","Cập nhật sản phẩm thành công!");
        }else{
            return redirect("admin/products")->with("fail","Cập nhật không thành công. Vui lòng xóa đi làm lại");
        }
    }

    public function destroyImage(int $product_image_id){
        $productImage = ProductImage::findOrFail($product_image_id);

        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        
        $productImage->delete();
        return redirect()->back()->with("message","Ảnh sản phẩm đã được xóa");
    }

    public function destroy(int $product_id){
        $product = Product::findOrFail($product_id);
        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with("message","Đã xóa sản phẩm với tất cả ảnh");
    }
}
