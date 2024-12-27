<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{route('admin.home.index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('logo.png')}}" alt="" height="45">
                    </span>
                </a>
                <a href="{{route('admin.home.index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('logo.png')}}" alt="" height="45">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li>
                    <a href="{{route('admin.home.index')}}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Home </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.license.index')}}" class="tp-link">
                        <i data-feather="credit-card"></i>
                        <span> Lisensi </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.inspection.index')}}" class="tp-link">
                        <i data-feather="users"></i>
                        <span> Inspeksi </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{route('admin.training.index')}}" class="tp-link">
                        <i data-feather="user"></i>
                        <span> Pelatihan K3 </span>
                    </a>
                </li>
                --}}
                <li>
                    <a href="#sidebarMasterData" data-bs-toggle="collapse">
                        <i data-feather="database"></i>
                        <span> Master Data </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMasterData">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('admin.admin.index')}}" class="tp-link">Admin</a>
                            </li>
                            <li>
                                <a href="{{route('admin.user.index')}}" class="tp-link">User</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>