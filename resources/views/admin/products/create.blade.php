@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Thêm sản phẩm
                    <a href="{{ url('admin/products') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
                </h3>
            </div>

            <div class="card-body">
                <form action="{{url("admin/products")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">SEO Tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="detals-tab" data-bs-toggle="tab" data-bs-target="#detals-tab-pane" type="button" role="tab" aria-controls="detals-tab-pane" aria-selected="false">Chi tiết</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Ảnh sản phẩm</button>
                        </li>
                    </ul>
    
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="mb-3">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label>Tên tác giả</label>
                                <input type="text" name="author" class="form-control">
                                @error('author')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Danh mục</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $cate)
                                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Nhà xuất bản</label>
                                <select name="brand_id" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label>Mô tả ngắn (500 từ) </label>
                                <textarea name="small_description" id="" rows="4" class="form-control"></textarea>
                                @error('small_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label>Mô tả sản phẩm </label>
                                <textarea name="description" id="" rows="4" class="form-control"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            <div class="mb-3">
                                <label>Meta Title </label>
                                <input type="text" name="meta_title" class="form-control">
                                @error('meta_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Meta Keyword </label>
                                <textarea name="meta_keyword" id="" rows="4" class="form-control"></textarea>
                                @error('meta_keyword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Meta Description </label>
                                <textarea name="meta_description" id="" rows="4" class="form-control"></textarea>
                                @error('meta_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="detals-tab-pane" role="tabpanel" aria-labelledby="detals-tab" tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Giá gốc</label>
                                        <input type="text" name="original_price" class="form-control">
                                        @error('original_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Giá khuyến mãi</label>
                                        <input type="text" name="selling_price" class="form-control">
                                        @error('selling_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Số lượng</label>
                                        <input type="number" name="quantity" class="form-control">
                                        @error('quantity')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" name="trending" style="width:50px; height:50px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trạng thái</label>
                                        <input type="checkbox" name="status" style="width:50px; height:50px;">
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            <div class="mb-3">
                                <label>Upload ảnh sản phẩm</label>
                                <input type="file" name="image[]" class="form-control" multiple>
                            </div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
    
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-primary text-white">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

