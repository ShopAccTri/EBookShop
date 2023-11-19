@extends('layouts.app')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Thông tin cá nhân
                        <a href="{{ url("change-password") }}" class="btn btn-warning float-end text-white">Đổi mật khẩu</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>

                <div class="col-md-10">

                    @if (session("message"))
                        <p class="alert alert-success">{{ session("message") }}</p>
                    @endif

                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4>Chi tiết User</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url("profile") }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Tên người dùng</label>
                                            <input type="text" name="username" value="{{ Auth::user()->name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Email</label>
                                            <input type="text" name="email"  readonly value="{{ Auth::user()->email }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Số điện thoại</label>
                                            <input type="text" name="phone" value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Pin code</label>
                                            <input type="text" name="pincode" value="{{ Auth::user()->userDetail->pincode ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">Địa chỉ</label>
                                            <textarea name="address" class="form-control" rows="3">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
