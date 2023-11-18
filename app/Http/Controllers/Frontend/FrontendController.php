<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where("status", "1")->get();
        $trendingProducts = Product::where("trending","1")->latest()->take(15)->get();
        return view("frontend.home", compact("sliders","trendingProducts"));
    }

    public function categories()
    {
        $categories = Category::where("status", "1")->get();
        return view("frontend.collections.category.index", compact("categories"));
    }

    public function products($category_slug)
    {

        $category = Category::where("slug", $category_slug)->first();

        if ($category) {
            return view("frontend.collections.products.index", compact("category"));
        } else {
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {

        $category = Category::where("slug", $category_slug)->first();

        if ($category) {
            $product = $category->products()->where("slug", $product_slug)->where("status", "1")->first();

            if ($product) {
                return view("frontend.collections.products.view", compact("product","category"));
            }
            else{
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function thankyou(){
        return view("frontend.thank-you");
    }
}
