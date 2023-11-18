<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where("user_id", auth()->user()->id)->where("id", $cartId)->first();

        if ($cartData) {
            if ($cartData->quantity > 1) {
                if ($cartData->product->quantity >= $cartData->quantity) {
                    $cartData->decrement("quantity");
                    $this->dispatch('message', [
                        'text' => "Đã cập nhật số lượng",
                        'type' => "success",
                        'status' => 200,
                    ]);
                } else {
                    $this->dispatch('message', [
                        'text' => "Chỉ còn " . $cartData->quantity . " sản phẩm",
                        'type' => "success",
                        'status' => 200,
                    ]);
                }
            } else {
                $this->dispatch('message', [
                    'text' => "Không thể giảm sản phẩm xuống 0",
                    'type' => "success",
                    'status' => 200,
                ]);
            }
        } else {
            $this->dispatch('message', [
                'text' => "Có lỗi xảy ra",
                'type' => "error",
                'status' => 404,
            ]);
        }
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where("user_id", auth()->user()->id)->where("id", $cartId)->first();

        if ($cartData) {
            if ($cartData->product->quantity > $cartData->quantity) {
                $cartData->increment("quantity");
                $this->dispatch('message', [
                    'text' => "Đã cập nhật số lượng",
                    'type' => "success",
                    'status' => 200,
                ]);
            } else {
                $this->dispatch('message', [
                    'text' => "Chỉ còn " . $cartData->quantity . " sản phẩm",
                    'type' => "success",
                    'status' => 200,
                ]);
            }
        } else {
            $this->dispatch('message', [
                'text' => "Có lỗi xảy ra",
                'type' => "error",
                'status' => 404,
            ]);
        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = Cart::where("user_id", auth()->user()->id)->where("id", $cartId)->first();

        if ($cartRemoveData) {
            $cartRemoveData->delete();

            $this->dispatch('CartAddedUpdated');
            $this->dispatch('message', [
                'text' => "Xóa giỏ hàng thành công!",
                'type' => "success",
                'status' => 200,
            ]);
        }else{
            $this->dispatch('message', [
                'text' => "Có lỗi xảy ra",
                'type' => "error",
                'status' => 500,
            ]);
        }
    }

    public function render()
    {
        $this->cart = Cart::where("user_id", auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart,
        ]);
    }
}
