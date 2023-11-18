@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session("message"))
                <h2 class="alert alert-success">{{ session("message")}}</h2>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>Chào mừng trở lại, {{ Auth::user()->name }}</h2>
                <p class="mb-md-0">Đây là trang thống kê admin.</p>
                <hr>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label for="">Tổng đơn hàng</label>
                        <h1>{{ $totalOrder }}</h1>
                        <a href="{{ url("admin/orders") }}" class="text-white">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label for="">Đơn hàng theo ngày</label>
                        <h1>{{ $todayOrder }}</h1>
                        <a href="{{ url("admin/orders") }}" class="text-white">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label for="">Đơn hàng theo tháng</label>
                        <h1>{{ $thisMonthOrder }}</h1>
                        <a href="{{ url("admin/orders") }}" class="text-white">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label for="">Đơn hàng theo năm</label>
                        <h1>{{ $thisYearOrder }}</h1>
                        <a href="{{ url("admin/orders") }}" class="text-white">Xem</a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label for="">Tổng sản phẩm</label>
                        <h1>{{ $totalProducts }}</h1>
                        <a href="{{ url("admin/products") }}" class="text-white">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label for="">Tổng Danh mục</label>
                        <h1>{{ $totalCategories }}</h1>
                        <a href="{{ url("admin/categories") }}" class="text-white">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label for="">Tổng nhà xuất bản</label>
                        <h1>{{ $totalBrands }}</h1>
                        <a href="{{ url("admin/brands") }}" class="text-white">Xem</a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label for="">Tổng User</label>
                        <h1>{{ $totalAllUsers }}</h1>
                        <a href="{{ url("admin/users") }}" class="text-white">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label for="">User</label>
                        <h1>{{ $totalUser }}</h1>
                        <a href="{{ url("admin/users") }}" class="text-white">Xem</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label for="">Admin</label>
                        <h1>{{ $totalAdmin }}</h1>
                        <a href="{{ url("admin/users") }}" class="text-white">Xem</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
