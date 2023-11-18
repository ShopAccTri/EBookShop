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
                <h3>Danh sách sản phẩm
                    <a href="{{ url('admin/products/create') }}" class="btn btn-primary text-white btn-sm float-end">Thêm sản phẩm</a>
                </h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Danh mục</th>
                            <th>Tên sản phẩm</th>
                            <th>Tác giả</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->category)
                                    {{ $product->category->name }}
                                @else
                                    Không có danh mục
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->author }}</td>
                            <td>{{ $product->original_price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->status == "1" ? "Hiện" : "Ẩn" }}</td>
                            <td>
                                <a href="{{ url("admin/products/".$product->id."/edit") }}" class="btn btn-sm btn-success text-white">Sửa</a>
                                <a href="{{ url("admin/products/".$product->id."/delete") }}" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" class="btn btn-sm btn-danger text-white">Xóa</a>
                            </td>
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có sản phẩm</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
