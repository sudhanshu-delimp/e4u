<!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm  pl-3 pl-lg-5 pr-3 pr-lg-5 justify-navbar db-custom-topbar">
                    
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    {{-- logged in user data --}}
                    <div class="topbar-logged-in-user-data d-flex">
                        {{-- <div class="pr-5">
                            <img src="{{ asset('assets/app/img/logo.svg') }}" alt="">
                        </div> --}}
                        <div class="d-user-info">
                           <div class="common_top_menu">
                                <span>
                                    <b>Welcome back :  </b><span class="user-values">{{auth()->user()->name }}</span>  
                                </span>
                                <span>
                                    <span class="separator">|</span>
                                    <b>Membership ID :  </b><span class="user-values">{{auth()->user()->member_id }}</span>
                                </span>
                                <span>
                                    <b>Home State :  </b><span class="user-values">{{auth()->user()->home_state  }} </span>
                                </span>
                           </div>
                        </div>
                    </div>
                    {{-- end --}}
                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group dk-border-radius">
                            <div class="input-group-append">
                                <button class="btn" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control border-0 small" placeholder="Enter keywords..."
                                aria-label="Search" aria-describedby="basic-addon2">

                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <div class="navbar-nav">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <form class="form-inline navbar-search form-inline-custom" style="width: 22rem;">
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle support_notify_bell" href="#" id="ticketNotificationDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="">
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
                            <a class="nav-link dropdown-toggle alert_notify_bell " href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="top-icon-bg fas fa-bell fa-fw"></i>
                            </a>
                          

                                <div class="dropdown-list  dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">Alerts Center dd</h6>
                                    <div class="alert_notify_html">

                                       <div class="text-center">No new notification</div>

                                    </div>
                                </div>
                        </li>

                        <!-- //////// End Notification ///////////// -->



                        <div class=" d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="img-profile rounded-circle avatarName" src="{{ !auth()->user()->avatar_img ? asset('assets/dashboard/img/undraw_profile.svg') : asset('avatars/'.auth()->user()->avatar_img) }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in custom-nav-dropdown"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/user.png') }}">
                                        Member ID : {{auth()->user()->member_id }}
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/user.png') }}">
                                        User Name : {{auth()->user()->name }}
                                    </a>
                                            <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/user-dashboard/change-features">
                                        <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/setting.png') }}">
                                        Change Features
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.change.password')}}">
                                        <img class="profile_icons" src="{{ asset('assets/dashboard/img/profile-icons/reset-password.png') }}">
                                        Change Password
                                    </a>
                                    
                                    <a class="dropdown-item" href="/user-dashboard/my-legbox-list">
                                    <img class="profile_icons" src="{{asset('assets/dashboard/img/menu-icon/Icon_MyLegbox.png')}}">
                                        My Legbox
                                    </a>
                                    
                                    <a class="dropdown-item" href="/user-dashboard/notebox/list">
                                        <img class="profile_icons" src="{{asset('assets/dashboard/img/menu-icon/Icon_MyNotebox.png')}}">
                                        My Notebox
                                    </a>
                                    
                                    <a class="dropdown-item" href="/user-dashboard/punterbox/lookup">
                                        <img class="profile_icons" src="{{asset('assets/dashboard/img/boxicon/icon_punterbox.png')}}">
                                        Punterbox
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
