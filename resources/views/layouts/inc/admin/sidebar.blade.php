<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route("admin.dashboard")}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Thống kê</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url("admin/orders")}}">
          <i class="mdi mdi-sale menu-icon"></i>
          <span class="menu-title">Hóa đơn</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-cate" aria-expanded="false" aria-controls="ui-cate">
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
          <span class="menu-title">Danh mục</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-cate">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/categories/create")}}">Thêm danh mục</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/categories")}}">Danh sách danh mục</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-product" aria-expanded="false" aria-controls="ui-product">
          <i class="mdi mdi-book-open-variant menu-icon"></i>
          <span class="menu-title">Sản phẩm</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-product">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/products/create")}}">Thêm sản phẩm</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/products")}}">Danh sách sản phẩm</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url("admin/brands")}}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Nhà xuất bản</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account-multiple-plus menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/users/create") }}">Thêm User</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url("admin/users") }}"> Danh sách User </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url("admin/comments")}}">
          <i class="mdi mdi-comment menu-icon"></i>
          <span class="menu-title">Bình luận</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url("admin/sliders")}}">
          <i class="mdi mdi-view-carousel menu-icon"></i>
          <span class="menu-title">Home Slider</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url("admin/settings")}}">
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">Cài đặt</span>
        </a>
      </li>
    </ul>
  </nav>