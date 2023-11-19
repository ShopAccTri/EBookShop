@extends('layouts.admin')

@section('title',"Cài đặt admin")


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">

            @if (session("message"))
                <div class="alert alert-success mb-3">{{session("message")}}</div>
            @endif

            <form action="{{ url("/admin/settings") }}" method="post">
                @csrf

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Website</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Tên website</label>
                                <input type="text" name="website_name" value="{{ $setting->website_name ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Đường dẫn website</label>
                                <input type="text" name="website_url"  value="{{ $setting->website_url ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Tiêu đề trang</label>
                                <input type="text" name="title"  value="{{ $setting->title ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Meta Keyword</label>
                                <textarea name="meta_keyword" rows="3" class="form-control">{{ $setting->meta_keyword ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Meta description</label>
                                <textarea name="meta_description" rows="3" class="form-control">{{ $setting->meta_description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Thông tin website</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Địa chỉ</label>
                                <textarea name="address" rows="3" class="form-control">{{ $setting->address ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Số điện thoại 1</label>
                                <input type="text" name="phone1" value="{{ $setting->phone1 ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Số điện thoại 2</label>
                                <input type="text" name="phone2" value="{{ $setting->phone2 ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Địa chỉ Email 1</label>
                                <input type="text" name="email1" value="{{ $setting->email1 ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Địa chỉ Email 2</label>
                                <input type="text" name="email2" value="{{ $setting->email2 ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Truyền thông xã hội</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Facebook (Nếu có)</label>
                                <input type="text" name="facebook" value="{{ $setting->youtube ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Twitter (Nếu có)</label>
                                <input type="text" name="twitter" value="{{ $setting->twitter ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Instagram (Nếu có)</label>
                                <input type="text" name="instagram" value="{{ $setting->instagram ?? '' }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Youtube (Nếu có)</label>
                                <input type="text" name="youtube" value="{{ $setting->youtube ?? '' }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary text-white">Lưu cài đặt</button>
                </div>
            </form>
        </div>
    </div>
@endsection
