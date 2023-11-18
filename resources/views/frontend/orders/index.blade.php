@extends('layouts.app')

@section('title', 'Hóa đơn')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">Hóa đơn của tôi</h4>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID đơn hàng</th>
                                        <th>Mã vận chuyển</th>
                                        <th>Tên hiển thị</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($orders as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->tracking_no }}</td>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->payment_mode }}</td>
                                            <td>{{ $item->created_at->format("d-m-Y") }}</td>
                                            <td>{{ $item->status_message }}</td>
                                            <td><a href="{{ url("orders/".$item->id) }}" class="btn btn-primary btn-sm text-white">Xem chi tiết</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Không có hóa đơn nào</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
