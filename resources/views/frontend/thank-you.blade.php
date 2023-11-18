@extends('layouts.app')

@section('title', 'Cảm ơn quý khách')

@section('content')

    <div class="py-3 pty-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (session("message"))
                        <h5 class="alert alert-success">{{session("message")}}</h5>
                    @endif
                    <div class="p-4 shadow bg-white">
                        <h2>Book Shopping</h2>
                        <h4>Cảm ơn bạn đã mua sản phẩm của chúng tôi</h4>
                        <a href="{{ url('collections') }}" class="btn btn-warning text-white">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
