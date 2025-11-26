<!-- Topbar -->
@php
$positions = config('staff.position');
$postionKey = auth()->user()->staff_detail->position;
$position = $positions[$postionKey] ?? "";
@endphp
<nav
    class="db-custom-topbar navbar justify-navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm pl-3 pl-lg-5 pr-3 pr-lg-5 ">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    {{-- logged in user data --}}
    <div class="topbar-logged-in-user-data d-flex">
        <div class="d-user-info">
            <div class="escort_header_top_menu"
                style="font-size: 14px;">
                <span>
                    <b>Welcome back : </b><span class="user-values">{{ auth()->user()->name }}</span> <span
                        class="separator">|</span>
                </span>
                <span>
                    <b>Membership ID : </b><span class="user-values">{{ auth()->user()->member_id }}</span> <span
                        class="separator">|</span>
                </span>
                <span>
                    <b>Position : </b><span class="user-values" >{{ $position}}</span> <span
                        class="separator"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="navbar-nav">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <form class="form-inline form-inline-custom navbar-search custom-nav-search" style="width: 23rem;">
            <div class="input-group dk-border-radius">
                <div class="input-group-append">
                    <button class="btn" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                <input type="text" class="form-control border-0 small" placeholder="Enter keywords..."
                    aria-label="Search" aria-describedby="basic-addon2">
            </div>
        </form>
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <div class=" d-none d-sm-block"></div>
        @php
            $avtar = !empty(auth()->user()->avatar_img) ? auth()->user()->avatar_url : 'assets/img/default_user.png';
        @endphp
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle pr-0" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span> -->
                <img src="{{ asset($avtar) }}" class="img-profile rounded-circle avatarName">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in custom-nav-dropdown"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 saptate_by_border "></i>
                    Member ID: {{ auth()->user()->member_id }}
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user-shield fa-sm fa-fw mr-2 saptate_by_border "></i>
                   Position: {{ $position }}
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 saptate_by_border"></i>
                    User Name: {{ auth()->user()->name }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('staff.account.edit') }}">
                    <img class="mr-2 ml-1 pr-1" style="filter: brightness(0) invert(0.2);width:25px;"
                        src="{{ asset('assets/dashboard/img/menu-icon/edit-my-account.png') }}">
                    Edit My Account
                </a>
                <a class="dropdown-item" href="{{ route('staff.change.password') }}">
                    <img class="mr-2 ml-1 pr-1" src="{{ asset('assets/dashboard/img/menu-icon/changePassword.png') }}">
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/logout.png') }}" alt="">
                    Logout
                </a>
            </div>
        </li>
    </ul>
    <!-- Topbar Navbar -->
</nav>
<!-- End of Topbar -->
