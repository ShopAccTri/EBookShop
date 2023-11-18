@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session("message"))
            <div class="alert alert-success">{{ session("message") }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Danh sách Slider
                    <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary text-white btn-sm float-end">Thêm Slider</a>
                </h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Mô tả</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                        <tr>
                            <td>{{ $slider->id }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->description }}</td>
                            <td>
                                <img src="{{ asset("$slider->image")}}" alt="" style="width:70px; height: 70px;">
                            </td>
                            <td>{{ $slider->status == "1" ? "Hiện" : "Ẩn" }}</td>
                            <td>
                                <a href="{{ url("admin/sliders/".$slider->id."/edit") }}" class="btn btn-sm btn-success text-white">Sửa</a>
                                <a href="{{ url("admin/sliders/".$slider->id."/delete") }}" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" class="btn btn-sm btn-danger text-white">Xóa</a>
                            </td>
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có Slider</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
