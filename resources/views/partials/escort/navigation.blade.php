<div{{-- style="position: fixed; width: 75%; z-index: 9999;"--}}>
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm pl-3 pl-lg-5 pr-3 pr-lg-5">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        {{-- logged in user data --}}
        <div class="topbar-logged-in-user-data">
           
            
            <div class="d-user-info">
                <div>
                    <span>
                        <b>Welcome back :  </b><span class="user-values">{{auth()->user()->name }}</span> <span class="separator">|</span> 
                    </span>
                    <span>
                        <b>Membership ID :  </b><span class="user-values">{{auth()->user()->member_id }}</span> <span class="separator">|</span>
                    </span>
                    <span>
                        <b>My Agent :  </b><span class="user-values">Andrew Stephen</span>
                    </span>
                </div>
                
                <div>
                    <span>
                        <b>Territory :  </b><span class="user-values">{{auth()->user()->home_state }}</span> <span class="separator">|</span> 
                    </span>
                    <span>
                        <b>Current Location :  </b><span class="user-values">{{auth()->user()->home_state }}</span> <span class="separator">|</span>
                    </span>
                    <span>
                        <b>Location time :  </b><span class="user-values">10:55 am</span>
                    </span>
                </div>
            </div>
            
        </div>
        {{-- end --}}
        <!-- Topbar Search -->
        {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
        <div class="navbar-nav ml-auto">
            {{-- Nav Item - Search visible all screen not only xs --}}
                <form class="form-inline navbar-search form-inline-custom">
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
            <!-- Nav Item - support tickets -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="ticketNotificationDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="Support tickets">
                    <i class="top-icon-bg fas fa-ticket-alt fa-fw"></i>
                    <!-- Counter - Alerts -->
                    @if(count($support_tickets))
                    <span class="badge badge-danger badge-counter">{{count($support_tickets)}}</span>
                    @endif
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="ticketNotificationDropdown">
                    <h6 class="dropdown-header">
                        Support Ticket Alert
                    </h6>
                    @if(count($support_tickets))
                        @foreach($support_tickets as $ticket)
                            <a class="dropdown-item d-flex align-items-center" href="{{route('support-ticket.list', $ticket->id)}}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                        {{-- <div class="small text-gray-500">December 12, 2019</div>--}}
                                        <span class="font-weight-bold">{{$ticket->subject}}</span>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="text-center">No new notification</div>
                    @endif
                    <a class="dropdown-item text-center small text-gray-500" href="{{route('support-ticket.list')}}">Support Tickets</a>
                </div>
                <!-- Dropdown - Alerts -->
            </li>

            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="top-icon-bg fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter"> </span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">12-06-2025</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">02-05-2025</div>
                            $290.29 has been deposited into your account!
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">17-04-2025</div>
                            Spending Alert: We've noticed unusually high spending for your account.
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-dark">
                                <i class="fas fas fa-comments text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">18-02-2025</div>
                            A message has been sent from an Advertiser
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-info">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">15-01-2025</div>
                            Profile has been posted.
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
            </li>



            <div class=" d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle pr-0" href="#" id="userDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span> -->
                    <img src="{{ !auth()->user()->avatar_img ? asset('assets/dashboard/img/undraw_profile.svg') : asset('avatars/'.auth()->user()->avatar_img) }}" class="img-profile rounded-circle avatarName">

                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 saptate_by_border"></i>
                        Escort ID: {{auth()->user()->member_id }}
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
</div>
