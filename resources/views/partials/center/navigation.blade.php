<!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm pl-3 pl-lg-5 pr-3 pr-lg-5 justify-navbar db-custom-topbar">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle">
                        <i class="fa fa-bars"></i>
                    </button>
                    {{-- logged in user data --}}
                    <div class="topbar-logged-in-user-data d-flex">
                        {{-- <div class="pr-5">
                            <img src="{{ asset('assets/app/img/logo.svg') }}" alt="">
                        </div> --}}
                        <div class="d-user-info">
                           <div class="escort_header_top_menu" style="display: grid; grid-template-columns: 1fr 1fr; font-size: 14px;">
                            <span>
                                <b>Welcome back :  </b><span class="user-values">{{auth()->user()->name ? substr(auth()->user()->name, 0, 15) : '--' }}</span>  
                            </span>
                            <span>
                                <span class="separator">|</span><b>Membership ID :  </b><span class="user-values">{{auth()->user()->member_id }}</span> 
                            </span>
                            <span>
                                <b>Home State :  </b><span class="user-values" style="padding-left: 10%;">{{auth()->user()->home_state  }} </span>
                            </span>
                            <span>
                                <span class="separator">|</span><b>My Agent :  </b>
                                <span class="user-values" style="padding-left: 15%;">

                                    @if(auth()->user()->my_agent)
                                    {{ Str::title(auth()->user()->my_agent->name) }}
                                    @else
                                        <a href="{{url('/center-dashboard/agent-request') }}" class="request-active"> Request one</a>
                                    @endif
                                    
                                
                                </span>
                        </span>
                           </div>
                           <div class="gap-b">
                           
                            
                   
                        
                   
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
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="Support tickets">
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
                            <a class="nav-link dropdown-toggle alert_notify_bell" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="top-icon-bg fas fa-bell fa-fw"></i>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span> -->
                                <img src="{{asset(auth()->user()->avatar_url)}}" class="img-profile rounded-circle avatarName custom-profile-pic">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right animated--grow-in custom-nav-dropdown"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2  saptate_by_border"></i>
                                    Membership ID: {{auth()->user()->member_id }}
                                </a>

                                @if(!auth()->user()->my_agent)
                                
                                <a class="dropdown-item" href="{{url('/center-dashboard/agent-request') }}">
                                @else
                                 <a class="dropdown-item" href="#">   
                                @endif    
                                    <i class="fas fa-user fa-sm fa-fw mr-2 saptate_by_border"></i>
                                        
                                        @if(auth()->user()->my_agent)
                                           My Agent ID :   {{ auth()->user()->my_agent->member_id }}
                                        @else
                                           My Agent ID : <span style="color:var(--peach)" class="request-active"> Request one</span>
                                        @endif
                                        
                                </a>
                               

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('center.account.edit')}}">
                                    <img class="mr-2" src="{{asset('assets/dashboard/img/menu-icon/account1-edit.png')}}">
                                    Edit my account
                                </a>
                               
                                {{-- <a class="dropdown-item" href="#">
                                    <img src="{{asset('assets/dashboard/img/menu-icon/bell-badge.png')}}">
                                    Notification & Features
                                </a> --}}
                                <a class="dropdown-item" href="{{ route('center.profile.information')}}">
                                <img class="mr-2" src="{{asset('assets/dashboard/img/menu-icon/cellphone-information.png')}}">
                                    Profile Information
                                </a> 
                                <a class="dropdown-item" href="{{ route('center.change.password')}}">
                                    <img class="mr-2 ml-1 pr-1" src="{{asset('assets/dashboard/img/menu-icon/changePassword.png')}}">
                                    Change password
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
