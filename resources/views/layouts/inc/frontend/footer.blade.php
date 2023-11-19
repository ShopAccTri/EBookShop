<div>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="footer-heading">{{ $appSetting ->website_name ?? "Website Name"}}</h4>
                    <div class="footer-underline"></div>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </p>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Truy cập nhanh</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{ url("/") }}" class="text-white">Trang chủ</a></div>
                    <div class="mb-2"><a href="" class="text-white">About Us</a></div>
                    <div class="mb-2"><a href="" class="text-white">Liên hệ</a></div>
                    <div class="mb-2"><a href="" class="text-white">Tin tức</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Mua ngay</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{ url("/collections") }}" class="text-white">Danh mục</a></div>
                    <div class="mb-2"><a href="{{ url("/") }}" class="text-white">Sản phẩm Hot</a></div>
                    <div class="mb-2"><a href="{{ url("/new-arrivals") }}" class="text-white">Sản phẩm mới</a></div>
                    <div class="mb-2"><a href="{{ url("/featured-products") }}" class="text-white">Sản phẩm nổi bật</a></div>
                    <div class="mb-2"><a href="{{ url("/cart") }}" class="text-white">Giỏ hàng</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Reach Us</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <p>
                            <i class="fa fa-map-marker"></i> {{ $appSetting ->address ?? "Website Address"}}
                        </p>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-phone"></i> {{ $appSetting ->phone1 ?? "123456789"}}
                        </a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-envelope"></i> {{ $appSetting ->email1 ?? "email@gmail.com"}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class=""> &copy; 2023 - Book Shopping. All rights reserved.</p>
                </div>
                <div class="col-md-4 text-white">
                    <div class="social-media">
                        Kết nối:
                        @if ($appSetting->facebook)
                            <a href="{{ $appSetting->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        @endif
                        @if ($appSetting->twitter)
                            <a href="{{ $appSetting->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
                        @endif
                        @if ($appSetting->instagram)
                            <a href="{{ $appSetting->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
                        @endif
                        @if ($appSetting->youtube)
                            <a href="{{ $appSetting->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
