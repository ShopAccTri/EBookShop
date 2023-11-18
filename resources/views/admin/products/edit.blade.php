@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session("message"))
            <h5 class="alert alert-success mb-2">{{session("message")}}</h5>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Cập nhật sản phẩm
                    <a href="{{ url('admin/products') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
                </h3>
            </div>

            <div class="card-body">
                <form action="{{url("admin/products/".$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
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
                                <input type="text" name="name" class="form-control" value="{{$product->name}}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label>Tên tác giả</label>
                                <input type="text" name="author" class="form-control" value="{{$product->author}}">
                                @error('author')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Danh mục</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $cate)
                                        <option value="{{$cate->id}}" {{ $cate->id == $product->category_id ? "selected" : ""}}>
                                            {{$cate->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Nhà xuất bản</label>
                                <select name="brand_id" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}" {{ $brand->id == $product->brand_id ? "selected" : ""}}>
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label>Mô tả ngắn (500 từ) </label>
                                <textarea name="small_description" id="" rows="4" class="form-control">{{$product->small_description}}</textarea>
                                @error('small_description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label>Mô tả sản phẩm </label>
                                <textarea name="description" id="" rows="4" class="form-control">{{$product->description}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            <div class="mb-3">
                                <label>Meta Title </label>
                                <input type="text" name="meta_title" class="form-control" value="{{$product->meta_title}}">
                                @error('meta_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Meta Keyword </label>
                                <textarea name="meta_keyword" id="" rows="4" class="form-control">{{$product->meta_keyword}}</textarea>
                                @error('meta_keyword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Meta Description </label>
                                <textarea name="meta_description" id="" rows="4" class="form-control">{{$product->meta_description}}</textarea>
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
                                        <input type="text" name="original_price" class="form-control" value="{{$product->original_price}}">
                                        @error('original_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Giá khuyến mãi</label>
                                        <input type="text" name="selling_price" class="form-control" value="{{$product->selling_price}}">
                                        @error('selling_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Số lượng</label>
                                        <input type="number" name="quantity" class="form-control"  value="{{$product->quantity}}">
                                        @error('quantity')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" name="trending" {{ $product->trending == "1" ? "checked" : ""}} style="width:50px; height:50px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trạng thái</label>
                                        <input type="checkbox" name="status" {{ $product->status == "1" ? "checked" : "" }} style="width:50px; height:50px;">
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            <div class="mb-3">
                                <label>Upload ảnh sản phẩm</label>
                                <input type="file" name="image[]" class="form-control" multiple>
                            </div>
                            <div>
                                @if ($product->productImages)
                                <div class="row">
                                    @foreach ($product->productImages as $image)
                                        <div class="col-md-2">
                                            <img src="{{ asset($image->image) }}" style="width 80px; height: 80px;" alt="Img" class="me-4">
                                            <a href="{{ url("admin/product-image/".$image->id."/delete") }}" class="d-block">Xóa</a>
                                        </div>
                                    @endforeach
                                </div>
                                @else
                                    <h5>Không có ảnh nào</h5>
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-primary text-white">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

