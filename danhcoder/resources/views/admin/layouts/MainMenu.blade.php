<!-- STAR HEADER -->
<div class="header dl-flex header-pl">
    <div class="sidebar-icon rota-hori">
        <p class="m-0"><i class="fa-solid fa-arrow-right-to-bracket"></i></p>
    </div>
    <p class="note-form se-color"> {{session()->get('sessionStatusRoles')}}</p>
    <div class="info-user dl-flex al-center">
        <a href="edit-user/{{ Auth::user()->id }}">{{ Auth::user()->name }}</a>
        <div class="thumb-user ml-2">
            <img src="{{ asset('public/uploads/images/Internet.gif') }}" alt="">
            <div class="custom-user">
                <ul>
                    <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                            {{ __('Đăng xuất') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </div>

</div>
<!-- END HEADER -->