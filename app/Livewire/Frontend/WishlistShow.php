<?php

namespace App\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{

    public function removeWishListItem(int $wishlistId)
    {
        Wishlist::where("user_id", auth()->user()->id)->where("id", $wishlistId)->delete();
        $this->dispatch('wishlistAddedUpdated');
        $this->dispatch('message', [
            'text' => "Đã xóa sản phẩm khỏi trang yêu thích",
            'type' => "success",
            'status' => 200,
        ]);
    }

    public function render()
    {
        $wishlist = Wishlist::where("user_id",auth()->user()->id)->get(); 
        return view('livewire.frontend.wishlist-show',compact("wishlist"));
    }
}
