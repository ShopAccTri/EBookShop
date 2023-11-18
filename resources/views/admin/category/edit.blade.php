@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Sửa danh mục
                        <a href="{{ url('admin/categories') }}"
                            class="btn btn-danger text-white btn-sm float-end">BACK</a>
                        </h4>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/categories/'.$category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tên danh mục</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Mô tả</label>
                                <textarea name="description" id="" rows="3" class="form-control">{{ $category->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Mô tả</label>
                                <input type="file" name="image" class="form-control">
                                <img src="{{ asset($category->image)}}" alt="" style="width:60px; height: 60px;">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Trạng thái</label><br>
                                <input type="checkbox" name="status" {{ $category->status == "1" ? "checked" : ""}}>

                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ $category->meta_title }}">
                                @error('meta_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta Keyword</label>
                                <textarea name="meta_keyword" id="" rows="3" class="form-control">{{ $category->meta_keyword }}</textarea>
                                @error('meta_keyword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" id="" rows="3" class="form-control">{{ $category->meta_description }}</textarea>
                                @error('meta_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
