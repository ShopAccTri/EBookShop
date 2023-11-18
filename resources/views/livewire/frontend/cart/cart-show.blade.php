<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>Giỏ hàng</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>Sản phẩm</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Giá</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Số lượng</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Tổng tiền</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Xóa</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($cart as $cartItem)
                            @if ($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-5 my-auto">
                                            <a href="{{"collections/". $cartItem->product->category->slug. "/". $cartItem->product->slug}}">
                                                <label class="product-name">
                                                    @if ($cartItem->product->productImages)
                                                        <img src="{{ $cartItem->product->productImages[0]->image }}" style="width: 50px; height: 50px" alt="{{ $cartItem->product->name }}">
                                                    @else
                                                        <img src=""  style="width: 50px; height: 50px" alt="">
                                                    @endif

                                                    {{ $cartItem->product->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">{{ number_format($cartItem->product->selling_price, 0, ',', '.') . ' vn₫' }}</label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity({{$cartItem->id}})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                    <input type="text" disabled value="{{ $cartItem->quantity }}" class="input-quantity" />
                                                    <button type="button" wire:loading.attr="disabled" wire:click="incrementQuantity({{$cartItem->id}})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">{{ number_format($cartItem->product->selling_price * $cartItem->quantity, 0, ',', '.') . ' vn₫' }}</label>
                                            @php
                                                $totalPrice += $cartItem->product->selling_price * $cartItem->quantity;
                                            @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{$cartItem->id}})" class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove wire:target="removeCartItem({{$cartItem->id}})">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </span>

                                                    <span wire:loading wire:target="removeCartItem({{$cartItem->id}})">
                                                        <i class="fa fa-trash"></i> Đang xóa...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>            
                            @endif
                        @empty
                            <div>Không có sản phẩm nào</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>Ở đây có những Deal hời nhất <a href="{{ url("/collections")}}">Mua ngay</a></h4>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Tổng tiền:
                            <span class="float-end">{{ number_format($totalPrice, 0, ',', '.') . ' vn₫' }}</span>
                        </h4>
                        <hr>
                        <a href="{{ url("/checkout") }}" class="btn btn-warning text-white w-100">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
