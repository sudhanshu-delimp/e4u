
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm pl-3 pl-lg-5 pr-3 pr-lg-5 justify-navbar custom-navbar db-custom-topbar" >

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        {{-- logged in user data --}}
        <div class="topbar-logged-in-user-data">
           
            
            <div class="d-user-info">
                <div class="shareholder_header_top_menu">
                    <span>
                        <b>Welcome back :  </b><span class="user-values">{{\Illuminate\Support\Str::limit(auth()->user()->name, 12, '..') }}</span>  
                    </span>
                    <span>
                        <span class="separator">|</span> <b>Membership ID :  </b><span class="user-values" style="padding-left: 4%;">{{auth()->user()->member_id }}</span> 
                    </span>
                    <br>
                     <span>
                        <b>Home State :  </b><span class="user-values resident_home_state" style="margin-left:11%">--</span> 
                    </span>
                    <span>
                        <span class="separator">|</span> <b>Current Location :  </b><span class="user-values live_current_location">--</span> 
                    </span>
                    <span>
                        <span class="separator">|</span>  <b>Location time :  </b><span class="user-values live_current_time">00:00 AM</span>
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
                            <a class="nav-link dropdown-toggle alert_notify_bell common-tooltip" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span> -->
                    <img src="{{ asset(auth()->user()->avatar_url)}}" class="img-profile rounded-circle avatarName">

                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in custom-nav-dropdown"
                     aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 saptate_by_border"></i>
                        Membership ID : {{auth()->user()->member_id }}
                    </a>

            
                     @if(!auth()->user()->my_agent)
                                <a class="dropdown-item" href="{{url('/escort-dashboard/escort-agency-request') }}">
                                @else
                                 <a class="dropdown-item" href="#">   
                                @endif    
                                    <i class="fas fa-user fa-sm fa-fw mr-2 saptate_by_border"></i>
                                        
                                        @if(auth()->user()->my_agent)
                                        My Agent :  {{ auth()->user()->my_agent->member_id }}
                                        @else
                                           My Agent ID : <span class="request-active"> Request one</span>
                                        @endif
                                        
                                </a>

                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 saptate_by_border"></i>
                        User Name: {{auth()->user()->name }} 
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('escort.account.edit')}}">
                        {{-- <img class="mr-2" src="{{asset('assets/dashboard/img/menu-icon/account1-edit.png')}}"> --}}
                        <img class="mr-2 ml-1 pr-1" style="filter: brightness(0) invert(0.2);" src="{{asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        My account
                    </a>
                    <a class="dropdown-item" href="{{ route('escort.change.password')}}">
                        <img class="mr-2 ml-1 pr-1" src="{{asset('assets/dashboard/img/menu-icon/changePassword.png')}}">
                        Change password
                    </a>
                    <a class="dropdown-item" href="{{ route('escort.profile')}}">
                        <img class="mr-2" src="{{asset('assets/dashboard/img/menu-icon/cellphone-information.png')}}">
                        New Profile
                    </a>
                    <a class="dropdown-item" href="{{url('escort-dashboard/create-tour')}}">
                        <img class="mr-2" src="{{asset('assets/dashboard/img/menu-icon/bell-badge.png')}}">
                        New Tour
                    </a>

                    <a class="dropdown-item" href="{{route('support-ticket.list')}}">
                        <img class="mr-2" src="{{asset('assets/dashboard/img/menu-icon/ticket.png')}}">
                        Support Ticket
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <img src="{{asset('assets/dashboard/img/menu-icon/logout.png')}}">
                        Logout
                    </a>
                </div>
            </li>

            </ul>

    </nav>
    <!-- End of Topbar -->
