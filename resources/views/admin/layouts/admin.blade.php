@include ('admin.layouts.MainHeader')
@include ('admin.layouts.MainSideBar')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      {{$title}}
    </h1>
  </section>
  <section class="content">
    @yield('main')
  </section>
</div>
@include ('admin.layouts.MainFooter')