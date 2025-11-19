<!-- Topbar -->
<nav
    class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm pl-3 pl-lg-5 pr-3 pr-lg-5 justify-navbar custom-navbar db-custom-topbar">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    {{-- logged in user data --}}
    <div class="topbar-logged-in-user-data">


        <div class="d-user-info">
            <div class="shareholder_header_top_menu">
                <span>
                    <b>Welcome back : </b><span class="user-values">Wayne Primrose</span>
                </span>
                <span>
                    <span class="separator">|</span> <b>Member ID : </b><span class="user-values"
                        style="padding-left: 7%;">
                        S60658
                    </span>
                </span>

                <span>
                    <b>Shareholder : </b><span class="user-values resident_home_state" style="margin-left:8%">Waykar Pty
                        Ltd</span>
                </span>
                <span>
                    <span class="separator">|</span> <b>Shareholding : </b><span
                        class="user-values live_current_location">18,500</span>
                </span>

            </div>
        </div>

    </div>
    {{-- end --}}

    <!-- Topbar Navbar -->
    <div class="navbar-nav ">
        {{-- Nav Item - Search visible all screen not only xs --}}
        <form class="form-inline navbar-search form-inline-custom" style="width: 14rem;">
            <div class="input-group " style="border: 1px solid #D6D7E3; border-radius: 7px;">
                <div class="input-group-append">
                    <button class="btn" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                <input type="text" class="form-control border-0 small" placeholder="Enter keywords..."
                    aria-label="Search" aria-describedby="basic-addon2">

            </div>
        </form>
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
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



        <!-- //////// Notification ///////////// -->

        <li class="nav-item dropdown no-arrow mx-1 support-tooltip-wrap">
            <span class="support-tooltip">Support Tickets</span>
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

        <li class="nav-item dropdown no-arrow mx-1 alert-tooltip-wrap">
            <span class="alert-tooltip">Alert Centre</span>
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


        <!-- //////// End Notification ///////////// -->


        <div class=" d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle pr-0" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('assets/dashboard/img/profile-icons/user.png') }}"
                    class="img-profile rounded-circle avatarName">

            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in custom-nav-dropdown"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/user.png') }}">
                    Membership ID : S60658
                </a>

                <a class="dropdown-item" href="#">
                    <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/user.png') }}">
                    Name : Wayne Primrose
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('shareholder.edit-my-account') }}">
                    <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/user.png') }}">
                    My account
                </a>
                <a class="dropdown-item" href="{{ route('shareholder.change-password') }}">
                    <img class="profile_icons"
                        src="{{ asset('assets/dashboard/img/profile-icons/reset-password.png') }}">
                    Change password
                </a>
                <a class="dropdown-item" href="{{ route('shareholder.shareholders') }}">
                    <img class="profile_icons"
                        src="{{ asset('assets/dashboard/img/profile-icons/shareholder.png') }}">
                    My Shareholding
                </a>

                <a class="dropdown-item" href="{{ route('shareholder.view-and-reply') }}">
                    <img class="profile_icons"
                        src="{{ asset('assets/dashboard/img/profile-icons/support-ticket.png') }}">
                    Support Ticket
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/logout.png') }}">
                    Logout
                </a>
            </div>
        </li>

        </ul>

</nav>
<!-- End of Topbar -->
