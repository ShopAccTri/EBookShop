@extends('layouts.admin')

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
                <h3>Danh sách bình luận
                </h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Đăng vào sản phẩm</th>
                            <th>Nội dung bình luận</th>
                            <th>Người đăng</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>
                                @if ($comment->product)
                                    {{ $comment->product->name }}
                                @else
                                    Không có tên sản phẩm
                                @endif
                            </td>
                            <td>{!! $comment->comment_body !!}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>
                                <a href="{{ url("admin/comments/".$comment->id."/delete") }}" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" class="btn btn-sm btn-danger text-white">Xóa</a>
                            </td>
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có bình luận</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
