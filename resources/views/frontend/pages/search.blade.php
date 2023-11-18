@extends('layouts.app')

@section('title', 'Sản phẩm tìm kiếm')

@section('content')
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h4>Kết quả tìm kiếm</h4>
                    <div class="underline mb-4"></div>
                </div>

                @forelse ($searchProducts as $productItem)
                <div class="col-md-3">
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

                <div>
                    {{ $searchProducts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
