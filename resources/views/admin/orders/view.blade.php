@extends('layouts.admin')

@section('title', 'Chi tiết hóa đơn')

@section('content')

    <div class="row">
        <div class="col-md-12">

            @if (session("message"))
                <h4 class="alert alert-success">{{ session("message") }}</h4>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <h3>Chi tiết hóa đơn</h3>
                </div>

                <div class="card-body">
                    <div class="shadow bg-white p-3">

                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> Chi tiết hóa đơn của tôi
                            <a href="{{ url('admin/orders') }}" class="btn btn-danger btn-sm float-end text-white mx-1">Back </a>
                            <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-primary btn-sm float-end text-white mx-1">Tải hóa đơn</a>
                            <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-warning btn-sm float-end text-white mx-1">Xem hóa đơn</a>
                            <a href="{{ url('admin/invoice/'.$order->id.'/mail') }}" class="btn btn-info btn-sm float-end text-white mx-1">Gửi hóa đơn về Email</a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Chi tiết hóa đơn</h5>
                                <hr>
                                <h6>ID hóa đơn: {{ $order->id }}</h6>
                                <h6>Mã vận chuyển: {{ $order->tracking_no }}</h6>
                                <h6>Ngày đặt hàng: {{ $order->created_at->format('d-m-Y') }}</h6>
                                <h6>Phương thức thanh toán: {{ $order->payment_mode }}</h6>
                                <h6 class="border p-2 text-success">
                                    Trạng thái hóa đơn: <span class="text-uppercase">{{ $order->status_message }}</span>
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <h5>Chi tiết người đặt</h5>
                                <hr>
                                <h6>Họ và tên: {{ $order->fullname }}</h6>
                                <h6>Email: {{ $order->email }}</h6>
                                <h6>Số điện thoại: {{ $order->phone }}</h6>
                                <h6>Địa chỉ: {{ $order->address }}</h6>
                                <h6>Pincode: {{ $order->pincode }}</h6>
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
                                                    <img src="{{ asset($orderItem->product->productImages[0]->image) }}"
                                                        style="width: 50px; height: 50px"
                                                        alt="{{ $orderItem->product->name }}">
                                                @else
                                                    <img src="" style="width: 50px; height: 50px" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $orderItem->product->name }}</td>
                                            <td width="10%">{{ number_format($orderItem->price, 0, ',', '.') . ' vn₫' }}
                                            </td>
                                            <td width="10%">{{ $orderItem->quantity }}</td>
                                            <td width="10%" class="fw-bold">
                                                {{ number_format($orderItem->quantity * $orderItem->price, 0, ',', '.') . ' vn₫' }}
                                            </td>
                                            @php
                                                $totalPrice += $orderItem->quantity * $orderItem->price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Tổng tiền</td>
                                        <td colspan="1" class="fw-bold">
                                            {{ number_format($totalPrice, 0, ',', '.') . ' vn₫' }}</td>
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

            <div class="card border mt-3">
                <div class="card-body">
                    <h4>Trạng thái đơn hàng (Cập nhật) </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ url('admin/orders/'.$order->id) }}" method="POST">
                                @csrf
                                @method("PUT")

                                <label>Cập nhập trạng thái đơn hàng</label>
                                <div class="input-group">
                                    <select name="order_status" id="" class="form-select">
                                        <option value="" disabled>Chọn trạng thái</option>
                                        <option value="Đang tiến hành" {{ Request::get("status") == 'Đang tiến hành' ? 'selected' : ''}}>Đang tiến hành</option>
                                        <option value="Đã hoàn thành" {{ Request::get("status") == 'Đã hoàn thành' ? 'selected' : ''}}>Đã hoàn thành</option>
                                        <option value="Chờ xử lý" {{ Request::get("status") == 'Chờ xử lý' ? 'selected' : ''}}>Chờ xử lý</option>
                                        <option value="Đã hủy" {{ Request::get("status") == 'Đã hủy' ? 'selected' : ''}}>Đã hủy</option>
                                        <option value="Đang vận chuyển" {{ Request::get("status") == 'Đang vận chuyển' ? 'selected' : ''}}>Đang vận chuyển</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary text-white">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-7">
                            <br>
                            <h4 class="mt-3">Trạng thái hiện tại: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
