@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset($sliderItem->image) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                {{ $sliderItem->title }}
                            </h1>
                            <p>
                                {{ $sliderItem->description }}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Mua ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Chào mừng bạn đến với BookShopping</h4>
                    <div class="underline mx-auto"></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Incidunt ipsum assumenda unde facilis nemo natus libero.
                        Recusandae voluptate accusantium aperiam ea! Magni soluta corrupti ullam expedita eum
                        consequuntur mollitia repellat?
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Sản phẩm HOT</h4>
                    <div class="underline mb-4"></div>
                </div>

                @if ($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($trendingProducts as $productItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
    
                                            <label class="stock bg-danger">HOT</label>
    
    
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                        alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brand->name }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span
                                                    class="selling-price">{{ number_format($productItem->selling_price, 0, ',', '.') . ' vn₫' }}</span>
                                                <span
                                                    class="original-price">{{ number_format($productItem->original_price, 0, ',', '.') . ' vn₫' }}</span>
                                            </div>
                                            {{-- <div class="mt-2">
                                            <a href="" class="btn btn1">Thêm vào giỏ hàng</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="" class="btn btn1"> Chi tiết </a>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>Không có sản phẩm nào</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Sản phẩm nổi bật
                        <a href="{{ url("featured-products") }}" class="btn btn-warning float-end text-white">Xem thêm</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>

                @if ($featuredProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($featuredProducts as $productItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
    
                                            <label class="stock bg-danger">Mới</label>
    
    
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                        alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brand->name }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span
                                                    class="selling-price">{{ number_format($productItem->selling_price, 0, ',', '.') . ' vn₫' }}</span>
                                                <span
                                                    class="original-price">{{ number_format($productItem->original_price, 0, ',', '.') . ' vn₫' }}</span>
                                            </div>
                                            {{-- <div class="mt-2">
                                            <a href="" class="btn btn1">Thêm vào giỏ hàng</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="" class="btn btn1"> Chi tiết </a>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>Không có sản phẩm nổi bật nào</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Sản phẩm mới</h4>
                    <div class="underline mb-4"></div>
                </div>

                @if ($newArrivalsProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($newArrivalsProducts as $productItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
    
                                            <label class="stock bg-danger">Mới</label>
    
    
                                            @if ($productItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                        alt="{{ $productItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brand->name }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    {{ $productItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span
                                                    class="selling-price">{{ number_format($productItem->selling_price, 0, ',', '.') . ' vn₫' }}</span>
                                                <span
                                                    class="original-price">{{ number_format($productItem->original_price, 0, ',', '.') . ' vn₫' }}</span>
                                            </div>
                                            {{-- <div class="mt-2">
                                            <a href="" class="btn btn1">Thêm vào giỏ hàng</a>
                                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                            <a href="" class="btn btn1"> Chi tiết </a>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>Không có sản phẩm mới nào</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script>
        $('.four-carousel').owlCarousel({
        loop:true,
        margin:10,
        dots:true,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
        })
    </script>
@endsection