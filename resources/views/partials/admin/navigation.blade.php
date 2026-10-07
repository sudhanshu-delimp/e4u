<!-- Topbar -->
@php
$positions = config('staff.position');
$levels = config('staff.security_level');
$postionKey = auth()->user()->staff_detail?->position;
$level = auth()->user()->staff_detail?->security_level;
$position = $positions[$postionKey] ?? "";
$levelName = $levels[$level] ?? "";
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
            <div class="common_top_menu">
                <span>
                    <b>Welcome back : </b><span class="user-values">{{ auth()->user()->name }}</span>
                </span>
                <span>
                    <span class="separator">|</span>
                    <b>Membership ID : </b><span class="user-values">{{ auth()->user()->member_id }}</span> 
                </span>
                <span>
                    <b>Position : </b><span class="user-values" >{{ $position}}</span>
                </span>
                 <span>
                    <span class="separator">|</span>
                    <b>Security Level : </b><span class="user-values" >{{ $levelName}}</span>
                    
                </span>
            </div>
        </div>
    </div>
    
    <div class="navbar-nav">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <form class="form-inline form-inline-custom navbar-search custom-nav-search d-none" style="width: 23rem;">
                            <div class="input-group dk-border-radius">
                                <div class="input-group-append">
                                    <button class="btn" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control border-0 small" placeholder="Enter keywords..." aria-label="Search" aria-describedby="basic-addon2">

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
        
         <!-- Messages btn -->
        @if(in_array($postionKey, [1, 2]))
            <li class="nav-item messages_btn">
                <a class="nav-link" href="{{ route('admin.messages') }}" role="button">
                    <span>
                        <svg width="22px" height="22px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                            xmlns="http://www.w3.org/2000/svg" fill="#fff" stroke="#fff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: none;
                                            stroke: #fff;
                                            stroke-miterlimit: 10;
                                            stroke-width: 1.91px;
                                        }
                                    </style>
                                </defs>
                                <path class="cls-1"
                                    d="M18.68,8.16V15.8a2.86,2.86,0,0,1-2.86,2.86H13.91v2.86L8.18,18.66H4.36A2.86,2.86,0,0,1,1.5,15.8V8.16A2.86,2.86,0,0,1,4.36,5.3H15.82A2.86,2.86,0,0,1,18.68,8.16Z">
                                </path>
                                <path class="cls-1"
                                    d="M18.68,14.84h1A2.86,2.86,0,0,0,22.5,12V4.34a2.86,2.86,0,0,0-2.86-2.86H8.18A2.86,2.86,0,0,0,5.32,4.34v1">
                                </path>
                                <line class="cls-1" x1="5.32" y1="11.98" x2="7.23" y2="11.98"></line>
                                <line class="cls-1" x1="9.14" y1="11.98" x2="11.05" y2="11.98"></line>
                                <line class="cls-1" x1="12.95" y1="11.98" x2="14.86" y2="11.98"></line>
                            </g>
                        </svg> Messages
                    </span>
                </a>
            </li>
        @endif
        <!--- End --->
        <!-- //////// Notification ///////////// -->

        <li class="nav-item dropdown no-arrow mx-1 esc-tooltip-wrap">
            <span class="esc-tooltip esc-tooltip-support">Support Tickets</span>
            <a class="nav-link dropdown-toggle support_notify_bell" href="#" id="ticketNotificationDropdown"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip"
                title="">
                <i class="top-icon-bg fas fa-ticket-alt fa-fw"></i>
            </a>

            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="ticketNotificationDropdown">
                <h6 class="dropdown-header">Support Ticket Alert</h6>
                <div class="support_notify_html">

                    <div class="text-center">No new notification</div>

                </div>
            </div>

        </li>

        <li class="nav-item dropdown no-arrow mx-1 esc-tooltip-wrap">
            <span class="esc-tooltip esc-tooltip-support">Alert Centre</span>
            <a class="nav-link dropdown-toggle alert_notify_bell common-tooltip" href="#" id="alertsDropdown"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="top-icon-bg fas fa-bell fa-fw"></i>
                <span class="tooltip-text">Alerts Center</span>
            </a>


            <div class="dropdown-list  dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Alerts Center</h6>
                <div class="alert_notify_html">

                    <div class="text-center">No new notification</div>

                </div>
            </div>
        </li>
        
        <div class=" d-none d-sm-block"></div>
        @php
            $avtar = !empty(auth()->user()->avatar_img) ? auth()->user()->avatar_url : 'assets/img/default_user.png';
        @endphp
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span> -->
                <img src="{{ asset($avtar) }}" class="img-profile rounded-circle avatarName">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in custom-nav-dropdown"
                aria-labelledby="userDropdown">
                <div class="highlight-menu">
                    
                    <a class="dropdown-item menu-profile" href="javascript:void(0);">                        
                        <span>{{ auth()->user()->name }}</span> <br> ({{ $position }}) 
                    </a>
                </div>

                <div class="dropdown-item account-toggle d-flex justify-content-between align-items-center">
                    <span>
                        My account
                    </span>
                    <i class="fas fa-chevron-down chevron-icon"></i>
                </div>

                <div class="collapse" id="accountMenu">   
                
                <a class="dropdown-item" href="{{ route('admin.account.edit') }}">
                    <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/edit-account.png') }}">
                    Edit My Account
                </a>
                <a class="dropdown-item" href="{{ route('admin.change.password') }}">
                    <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/reset-password.png') }}">
                    Change Password
                </a>
                </div>
                 {{-- <div class="dropdown-divider"></div>

                 <a class="dropdown-item" href="{{ route('admin.escort-listings') }}">
                        <img class="profile_icons" src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}"> Escort Listings
                    </a>

                    <a class="dropdown-item" href="{{ route('admin.massage-centre-listings') }}">
                        <img class="profile_icons" src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png') }}">
                        Massage Centre Listings
                    </a> 
                <div class="dropdown-divider"></div>--}}
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/logout.png') }}">
                    Logout
                </a>
            </div>
        </li>
    </ul>
    <!-- Topbar Navbar -->
</nav>
<!-- End of Topbar -->
