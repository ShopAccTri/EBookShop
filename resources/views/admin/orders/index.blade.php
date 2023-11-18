@extends('layouts.admin')

@section('title', 'Hóa đơn')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Hóa đơn</h3>
                </div>

                <div class="card-body">
                    <form action="" method="get">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Sắp xếp theo ngày</label>
                                <input type="date" name="date" value="{{ Request::get("date") ?? date("Y-m-d") }}" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label>Sắp xếp theo trạng thái hóa đơn</label>
                                <select name="status" class="form-select">
                                    <option value="" disabled>Chọn trạng thái</option>
                                    <option value="Đang tiến hành" {{ Request::get("status") == 'Đang tiến hành' ? 'selected' : ''}}>Đang tiến hành</option>
                                    <option value="Đã hoàn thành" {{ Request::get("status") == 'Đã hoàn thành' ? 'selected' : ''}}>Đã hoàn thành</option>
                                    <option value="Chờ xử lý" {{ Request::get("status") == 'Chờ xử lý' ? 'selected' : ''}}>Chờ xử lý</option>
                                    <option value="Đã hủy" {{ Request::get("status") == 'Đã hủy' ? 'selected' : ''}}>Đã hủy</option>
                                    <option value="Đang vận chuyển" {{ Request::get("status") == 'Đang vận chuyển' ? 'selected' : ''}}>Đang vận chuyển</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <br>
                                <button type="submit" class="btn btn-primary text-white">Sắp xếp</button>
                            </div>
                        </div>
                    </form>

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
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $item->status_message }}</td>
                                        <td><a href="{{ url('admin/orders/' . $item->id) }}"
                                                class="btn btn-primary btn-sm text-white">Xem chi tiết</a></td>
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

@endsection
