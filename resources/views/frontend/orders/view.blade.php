@extends('layouts.app')

@section('title', 'Chi tiết hóa đơn')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> Chi tiết hóa đơn của tôi
                            <a href="{{ url("orders")}}" class="btn btn-danger btn-sm float-end">Back </a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Chi tiết hóa đơn</h5>
                                <hr>
                                <h6>ID hóa đơn: {{$order->id}}</h6>
                                <h6>Mã vận chuyển: {{$order->tracking_no}}</h6>
                                <h6>Ngày đặt hàng: {{ $order->created_at->format("d-m-Y") }}</h6>
                                <h6>Phương thức thanh toán: {{$order->payment_mode}}</h6>
                                <h6 class="border p-2 text-success">
                                    Trạng thái hóa đơn: <span class="text-uppercase">{{$order->status_message}}</span>
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <h5>Chi tiết người đặt</h5>
                                <hr>
                                <h6>Họ và tên: {{$order->fullname}}</h6>
                                <h6>Email: {{$order->email}}</h6>
                                <h6>Số điện thoại: {{$order->phone}}</h6>
                                <h6>Địa chỉ: {{$order->address}}</h6>
                                <h6>Pincode: {{$order->pincode}}</h6>
                            </div>
                        </div>

                        <br>
                        <h5>Danh mục hóa đơn</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td width="10%">{{ $orderItem->id }}</td>
                                            <td width="10%">
                                                @if ($orderItem->product->productImages)
                                                    <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="{{ $orderItem->product->name }}">
                                                @else
                                                    <img src=""  style="width: 50px; height: 50px" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $orderItem->product->name }}</td>
                                            <td width="10%">{{ number_format($orderItem->price, 0, ',', '.') . ' vn₫' }}</td>
                                            <td width="10%">{{ $orderItem->quantity }}</td>
                                            <td width="10%" class="fw-bold">{{ number_format($orderItem->quantity * $orderItem->price, 0, ',', '.') . ' vn₫' }}</td>
                                            @php
                                                $totalPrice += $orderItem->quantity * $orderItem->price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Tổng tiền</td>
                                        <td colspan="1" class="fw-bold">{{ number_format($totalPrice, 0, ',', '.') . ' vn₫' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <div>
                                {{ $orders->links() }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
