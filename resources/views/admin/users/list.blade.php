@extends('layouts.admin')

@section("title","Danh sách User")

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
                <h3>Danh sách User
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary text-white btn-sm float-end">Thêm User</a>
                </h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role_id == '1')
                                    <label class="badge btn-danger">Admin</label>
                                @elseif ($user->role_id == '2')
                                    <label class="badge btn-primary">User</label>
                                @else    
                                    <label class="badge btn-primary">None</label>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url("admin/users/".$user->id."/edit") }}" class="btn btn-sm btn-success text-white">Sửa</a>
                                <a href="{{ url("admin/users/".$user->id."/delete") }}" onclick="return confirm('Bạn có chắc muốn xóa users này không?')" class="btn btn-sm btn-danger text-white">Xóa</a>
                            </td>
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có User nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
