<div>
    <div class="py-3 py-md-5">
        <div class="container">

            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                            {{-- <img src="{{ asset($product->productImages[0]->image)}}" class="w-100" alt="Img"> --}}

                            <div class="exzoom" id="exzoom">

                                <div class="exzoom_img_box">
                                  <ul class='exzoom_img_ul'>
                                    @foreach ($product->productImages as $itemImg)                      
                                        <li><img src="{{ asset($itemImg->image)}}"/></li>
                                    @endforeach
                                  </ul>
                                </div>

                                <div class="exzoom_nav"></div>

                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            Không có ảnh sản phẩm
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                            @if ($product->quantity > 0)
                                <label class="label-stock bg-success p-2">Còn hàng</label>
                            @else
                                <label class="label-stock bg-danger p-2">Hết hàng</label>
                            @endif
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">{{ number_format($product->selling_price, 0, ',', '.') . ' vn₫' }}</span>
                            <span class="original-price">{{ number_format($product->original_price, 0, ',', '.') . ' vn₫' }}</span>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                            </button>
                            <button type="button" wire:click="addToWishList({{ $product->id }})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Yêu thích
                                </span>
                                <span wire:loading wire:target="addToWishList">Đang thêm...</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{ $product->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("scripts")
    <script>
        $(function(){

            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000 
            });

            });
    </script>
@endpush
