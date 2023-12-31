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
                            <h5 class="mb-0">Mô tả ngắn</h5>
                            <p>
                                {!! $product->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Mô tả sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Sản phẩm tương tự</h3>
                    <div class="underline"></div>
                </div>

                @forelse ($category->relatedProducts as $relatedProductItem)
                <div class="col-md-3 mb-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($relatedProductItem->productImages->count() > 0)
                                    <a
                                        href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                        <img src="{{ asset($relatedProductItem->productImages[0]->image) }}"
                                            alt="{{ $relatedProductItem->name }}">
                                    </a>
                                @endif
                            </div>

                            <div class="product-card-body">
                                <p class="product-brand">{{ $relatedProductItem->brand->name }}</p>
                                <h5 class="product-name">
                                    <a
                                        href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                        {{ $relatedProductItem->name }}
                                    </a>
                                </h5>

                                <div>
                                    <span
                                        class="selling-price">{{ number_format($relatedProductItem->selling_price, 0, ',', '.') . ' vn₫' }}</span>
                                    <span
                                        class="original-price">{{ number_format($relatedProductItem->original_price, 0, ',', '.') . ' vn₫' }}</span>
                                </div>
                            </div>
                        </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>Không có sản phẩm nào</h4>
                        </div>
                    </div>    
                @endforelse
            </div>
        </div>
    </div>


    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Bình luận</h3>
                    <div class="underline"></div>

                    <div class="comment-area mt-4">

                        @if(session("message"))
                            <h6 class="alert alert-warning mb-3">{{ session("message") }}</h6>
                        @endif

                        <div class="card card-body">
                            <h6 class="card-title">Bình luận ở đây</h6>
                            <form action="{{ url("comments") }}" method="post">
                                @csrf
                                <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                                <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Gửi</button>
                            </form>
                        </div>

                        @forelse ($product->comments as $comment)
                            <div class="comment-container card card-body shadow-sm mt-3">
                                <div class="detail-area">
                                    <h6 class="user-name mb-1">
                                        @if ($comment->user)
                                            {{$comment->user->name }}
                                        @endif
                                        <small class="ms-3 text-primary">{{$comment->created_at->format("h:i d-m-Y") }}</small>
                                    </h6>
                                    <p class="user-comment mb-1">
                                        {!! $comment->comment_body !!}
                                    </p>
                                </div>
                                @if(Auth::check() && Auth::id() == $comment->user_id )
                                    <div>
                                        <button type="button" value="{{ $comment->id }}" class="deleteComment btn btn-danger btn-sm me-2">Xóa</button>
                                        {{-- <a class="btn btn-danger btn-sm me-2">Xóa</a> --}}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="card card-body shadow-sm mt-3">
                                <h6>Không có bình luận nào.</h6>
                            </div>
                        @endforelse
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

@section("scripts")
    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click",".deleteComment", function(){
                if(confirm("Bạn có muốn xóa bình luận này không?")){
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();
                    
                    $.ajax({
                        type: "POST",
                        url: "/delete-comment",
                        data: {
                            "comment_id": comment_id
                        },
                        success: function (res){
                            if(res.status == 200){
                                thisClicked.closest(".comment-container").remove();
                                alert(res.message);
                            }else{
                                alert(res.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection