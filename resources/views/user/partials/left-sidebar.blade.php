<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{route('user.home.index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('123.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('123.png')}}" alt="" height="45">
                    </span>
                </a>
                <a href="{{route('user.home.index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('123.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('123.png')}}" alt="" height="45">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li>
                    <a href="{{route('user.home.index')}}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Home </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{route('user.profile.index')}}" class="tp-link">
                        <i data-feather="user"></i>
                        <span> Profile </span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{route('user.license.index')}}" class="tp-link">
                        <i data-feather="credit-card"></i>
                        <span> Lisensi </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.inspection.index')}}" class="tp-link">
                        <i data-feather="users"></i>
                        <span> Inspeksi </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.training.index')}}" class="tp-link">
                        <i data-feather="user"></i>
                        <span> Pelatihan K3 </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>