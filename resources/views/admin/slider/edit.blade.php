@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Cập nhật Slider
                        <a href="{{ url('admin/sliders') }}"
                            class="btn btn-danger text-white btn-sm float-end">BACK</a>
                        </h4>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/sliders/'.$slider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tên tiêu đề</label>
                                <input type="text" name="title" class="form-control" value="{{$slider->title}}">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Mô tả</label>
                                <textarea name="description" id="" rows="3" class="form-control">{{$slider->description}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Ảnh Slider</label>
                                <input type="file" name="image" class="form-control">
                                <img src="{{ asset("$slider->image")}}" alt="" style="width:50px; height: 50px;">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Trạng thái</label><br>
                                <input type="checkbox" name="status" style="width:30px; height:30px;" {{ $slider->status == "1" ? "checked" : ""}}>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
