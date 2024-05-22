<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="">
          <i class="fa fa-home"></i> <span>Trang chủ</span>
        </a>
      </li>
      <li class="treeview active">
        <a href="#">
          <i class="fa-regular fa-floppy-disk"></i> <span>Quản lý dữ liệu</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('category')}}"><i class="fa-solid fa-tag"></i> Loại hàng</a></li>
          <li><a href="{{route('store')}}"><i class="fa-solid fa-code-branch"></i> Chi nhánh cửa hàng</a></li>
          <li><a href="{{route('customer')}}"><i class="fa-solid fa-users"></i> Khách hàng</a></li>
          <li><a href="{{route('employee')}}"><i class="fa-solid fa-user-tie"></i> Nhân viên</a></li>
          <li><a href="{{route('shipper')}}"><i class="fa-solid fa-dolly"></i> Người giao hàng</a></li>
          <li><a href="{{route('product')}}"><i class="fa-solid fa-shirt"></i> Mặt hàng</a>
          <li><a href="{{route('color')}}"><i class="fa-solid fa-palette"></i> Màu sắc</a></li>
          <li><a href="{{route('size')}}"><i class="fa-solid fa-up-right-and-down-left-from-center"></i> Kích cở</a></li>
          <li><a href="{{route('saleoff')}}"><i class="fa-solid fa-ticket"></i> Khuyến mãi</a></li>
          <li><a href="{{route('tag')}}"><i class="fa-solid fa-tag"></i> Tag</a></li>
        </ul>
      </li>

      <li class="treeview active">
        <a href="#">
          <i class="fa-regular fa-floppy-disk"></i> <span>Quản lý bán hàng</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('order')}}"><i class="fa-solid fa-list-check"></i> Danh mục đơn hàng</a></li>
          <li><a href=""><i class="fa-solid fa-cart-plus"></i> Lập đơn hàng</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>