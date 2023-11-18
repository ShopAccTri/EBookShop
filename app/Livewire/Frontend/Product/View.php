<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $product, $category, $quantityCount = 1;

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where("user_id", auth()->user()->id)->where("product_id", $productId)->exists()) {
                session()->flash("message", "Sản phẩm đã có trong trang yêu thích");
                $this->dispatch('message', [
                    'text' => "Sản phẩm đã có trong trang yêu thích",
                    'type' => "success",
                    'status' => 409,
                ]);
                return false;
            } else {
                Wishlist::create([
                    "user_id" => auth()->user()->id,
                    "product_id" => $productId,
                ]);
                $this->dispatch('wishlistAddedUpdated');
                session()->flash("message", "Thêm sản phẩm yêu thích thành công !");
                $this->dispatch('message', [
                    'text' => "Thêm sản phẩm yêu thích thành công !",
                    'type' => "success",
                    'status' => 200,
                ]);
            }
        } else {
            session()->flash("message", "Bạn phải đăng nhập để tiếp tục");
            $this->dispatch('message', [
                'text' => "Bạn phải đăng nhập để tiếp tục",
                'type' => "info",
                'status' => 401,
            ]);
            return false;
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }

    public function addToCart($productId)
    {
        if (Auth::check()) {
            if($this->product->where("id",$productId)->where("status","1")->exists()){

                if(Cart::where("user_id",auth()->user()->id)->where("product_id",$productId)->exists()){
                    $this->dispatch('message', [
                        'text' => "Đã có trong giỏ hàng rồi",
                        'type' => "warning",
                        'status' => 404,
                    ]);
                }else{
                    if($this->product->quantity > 0){
                        if($this->product->quantity >= $this->quantityCount){
                            Cart::create([
                                "user_id" => auth()->user()->id,
                                "product_id" => $productId,
                                "quantity" => $this->quantityCount,
                            ]);

                            $this->dispatch('CartAddedUpdated');
                            $this->dispatch('message', [
                                'text' => "Thêm giỏ hàng thành công!",
                                'type' => "success",
                                'status' => 200,
                            ]);
                        }else{
                            $this->dispatch('message', [
                                'text' => "Chỉ còn ". $this->product->quantity ." sản phẩm",
                                'type' => "warning",
                                'status' => 404,
                            ]);
                        }
                    }else{
                        $this->dispatch('message', [
                            'text' => "Đã hết hàng",
                            'type' => "warning",
                            'status' => 404,
                        ]);
                    }
                }
            }else{
                $this->dispatch('message', [
                    'text' => "Sản phẩm không tồn tại",
                    'type' => "warning",
                    'status' => 404,
                ]);
            }

        } else {
            session()->flash("message", "Bạn phải đăng nhập để tiếp tục");
            $this->dispatch('message', [
                'text' => "Bạn phải đăng nhập mới thêm được giỏ hàng",
                'type' => "info",
                'status' => 401,
            ]);
            return false;
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            "product" => $this->product,
            "category" => $this->category,
        ]);
    }
}
