@include('admin.layouts.Header')
@include('admin.layouts.Sidebar')
<div class="wrapper p3">
    @include('admin.layouts.MainMenu')
    @yield('content')
</div>
@include('admin.layouts.Footer')