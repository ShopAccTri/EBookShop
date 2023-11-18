@extends('layouts.admin')

@section("title","Cập nhật User")

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session("message"))
            <div class="alert alert-success">{{ session("message") }}</div>
        @endif
        @if(session("fail"))
            <div class="alert alert-danger">{{ session("fail") }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Cập nhật User
                    <a href="{{ url('admin/users') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
                </h3>
            </div>

            <div class="card-body">
                <form action="{{ url("admin/users/".$user->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Tên người dùng</label>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" readonly value="{{$user->email}}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Quyền</label>
                            <select name="role_id" class="form-control">
                                <option value="">Chọn quyền</option>
                                <option value="1" {{ $user->role_id == "1" ? "selected" : ""}} >Admin</option>
                                <option value="2" {{ $user->role_id == "2" ? "selected" : ""}} >User</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary text-white">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
