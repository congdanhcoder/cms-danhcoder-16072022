        <!-- STAR SIDEBAR -->
        <div class="sidebar mr-1">
            <div class="box-logo p-2 primary-bg">
                <img class="logo" src="{{ asset('resources/admin/images/danh-logo.png') }}" alt="" srcset="">
            </div>
            <div class="simplebar-mask p-4">
                <nav>
                    <ul class="main-menu">
                        <li class="item-nav dl-flex">
                            <div class="box-nav dl-flex">
                                <a href="{{ route('dashboard') }}">
                                    <p><i class="fa-solid fa-house-user"></i> <span class="ml-2">Trang chủ</span> </p>
                                </a>
                            </div>
                        </li>
                        <li class="item-nav dl-flex">
                            <div class="box-nav dl-flex">
                                <a href="{{ route('listGallery') }}">
                                    <p><i class="fa-solid fa-photo-film"></i> <span class="ml-2">Gallery</span> </p>
                                </a>
                            </div>
                        </li>
                        @if(Auth::user()->positions_id == 1)
                        <li class="item-nav">
                            <div class="box-nav dl-flex">
                                <p><i class="fa-solid fa-file"></i> <span class="ml-2">Front End</span> </p>
                                <p class="drop-icon">
                                    <i class="fa-solid fa-angle-right"></i>
                                </p>
                            </div>
                            <ul class="sub-menu secondary-bg">
                                <li class="item-nav">
                                    <a href="#"> Trang chủ</a>
                                </li>
                                <li class="item-nav">
                                    <a href="#"> Liên hệ</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->positions_id == 1 || Auth::user()->positions_id == 2 || Auth::user()->positions_id == 3 || Auth::user()->positions_id == 4)
                        <li class="item-nav">
                            <div class="box-nav dl-flex">
                                <p><i class="fa-solid fa-book"></i> <span class="ml-2">Bài viết</span> </p>
                                <p class="drop-icon">
                                    <i class="fa-solid fa-angle-right"></i>
                                </p>
                            </div>
                            <ul class="sub-menu secondary-bg">
                                <li class="item-nav">
                                    <a href="{{ route('addPost') }}"> Thêm mới</a>
                                </li>
                                <li class="item-nav">
                                    <a href="{{ route('listPost') }}"> Danh Sách</a>
                                </li>
                                <li class="item-nav">
                                    <a href="{{ route('listCatPost') }}"> Danh mục</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->positions_id == 1 || Auth::user()->positions_id == 2 || Auth::user()->positions_id == 3 || Auth::user()->positions_id == 5)
                        <li class="item-nav">
                            <div class="box-nav dl-flex">
                                <p><i class="fa-solid fa-shop"></i> <span class="ml-2">Sản Phẩm</span> </p>
                                <p class="drop-icon">
                                    <i class="fa-solid fa-angle-right"></i>
                                </p>
                            </div>
                            <ul class="sub-menu secondary-bg">
                                <li class="item-nav">
                                    <a href="{{ route('addProduct') }}"> Thêm mới</a>
                                </li>
                                <li class="item-nav">
                                    <a href="{{ route('listProduct') }}"> Danh Sách</a>
                                </li>
                                <li class="item-nav">
                                    <a href="{{ route('listCatProduct') }}"> Danh mục</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->positions_id == 1 || Auth::user()->positions_id == 2 || Auth::user()->positions_id == 3)
                        <li class="item-nav">
                            <div class="box-nav dl-flex">
                                <p><i class="fa-solid fa-file-image"></i> <span class="ml-2">Slider</span> </p>
                                <p class="drop-icon">
                                    <i class="fa-solid fa-angle-right"></i>
                                </p>
                            </div>
                            <ul class="sub-menu secondary-bg">
                                <li class="item-nav">
                                    <a href="#"> Thêm mới</a>
                                </li>
                                <li class="item-nav">
                                    <a href="#"> Danh Sách</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->positions_id == 1 || Auth::user()->positions_id == 2 )
                        <li class="item-nav">
                            <div class="box-nav dl-flex">
                                <p><i class="fa-solid fa-people-group"></i> <span class="ml-2">Users</span> </p>
                                <p class="drop-icon">
                                    <i class="fa-solid fa-angle-right"></i>
                                </p>
                            </div>
                            <ul class="sub-menu secondary-bg">
                                <li class="item-nav">
                                    <a href="{{ route('addUser') }}"> Thêm mới</a>
                                </li>
                                <li class="item-nav">
                                    <a href="{{ route('listUser') }}"> Danh Sách</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="sidebar-bottom secondary-bg p-2">
                <p class="text-center m-0">Bản quyền: Danh Coder</p>
            </div>
        </div>
        <!-- END SIDER BAR -->