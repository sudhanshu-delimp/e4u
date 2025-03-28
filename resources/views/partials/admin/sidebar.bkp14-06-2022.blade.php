<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " alt="">
        </a> -->
    @if(auth()->user()->type == 2)
    <a class="sidebar-brand text-left" href="{{ route('home') }}">
    <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt=""><br>
    <span style="color:#FF3C5F;" class="font-weight-normal">Opertions Console-Staff</span>
    </a>
    <!-- Divider -->
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index')}}">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="white" />
            </svg>
            <span>Dashboard </span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#global-monitoring" aria-expanded="false" aria-controls="collapseTwo">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/globe.png')}}">
        <span>Global Monitoring</span>
        </a>
        <div id="global-monitoring" class="collapse @if(request()->segment(3) == 'advertisers') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('admin.contact-database.advertisers')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/advertise.png')}}">
                <span style="{{request()->segment(3) == 'advertisers' ? 'color: #e5365a;' : ''}}">Advertisers</span>
            </a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/pachive.png')}}">
                <span>Staff</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/view.png')}}">
                <span>Viewers</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/visitors.png')}}">
                <span>Agent</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/login.png')}}">
                <span>Attempts</span></a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accounting-reports" aria-expanded="false" aria-controls="collapseTwo">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/book.png')}}">
        <span>Accounting Reports</span>
        </a>
        <div id="accounting-reports" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="" class="collapse">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/front-desk.png')}}">
                <span>Concierge Services</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/revenue.png')}}">
                <span>Revenue (Whole)</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/view.png')}}">
                <span>Sales (Whole)</span></a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsenew" aria-expanded="false" aria-controls="collapsenew">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/alert.png')}}">
        <span>Alerts</span>
        </a>
        <div id="collapsenew" class=" collapse @if(request()->segment(3) == 'new') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('new') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/new.png')}}">
                <span style="{{request()->segment(3) == 'new' ? 'color: #e5365a;' : ''}}">New</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/edit.png')}}">
                <span style="">Edit</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/suspend.png')}}">
                <span style="">Suspend</span></a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics" aria-expanded="false" aria-controls="collapseTwo">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/chart.png')}}">
        <span>Analytics</span>
        </a>
        <div id="Analytics" class="collapse @if(request()->segment(3) == 'publicpages' || request()->segment(3) == 'consoles') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('publicpages') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/advertiser.png')}}">
                <span style="{{request()->segment(3) == 'publicpages' ? 'color: #e5365a;' : ''}}">Public Pages</span>
                </a>
                <a class="collapse-item" href="{{ route('consoles') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/console.png')}}">
                <span style="{{request()->segment(3) == 'consoles' ? 'color: #e5365a;' : ''}}">Consoles</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge" aria-expanded="false" aria-controls="collapseTwo">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png')}}">
        <span>Concierge</span>
        </a>
        <div id="Concierge" class="collapse @if(request()->segment(3) == 'email-service-request' || request()->segment(3) == 'mobile-sim-request' || request()->segment(3) == 'product-request' || request()->segment(3) == 'visa-migration-request') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('email-service-request')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/at.png')}}">
                <span style="{{request()->segment(3) == 'email-service-request' ? 'color: #e5365a;' : ''}}">Email Service Request</span>
                </a>
                <a class="collapse-item" href="{{ route('mobile-sim-request')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png')}}">
                <span style="{{request()->segment(3) == 'mobile-sim-request' ? 'color: #e5365a;' : ''}}">Mobile SIM Request</span>
                </a>
                <a class="collapse-item" href="{{ route('product-request')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png')}}">
                <span style="{{request()->segment(3) == 'product-request' ? 'color: #e5365a;' : ''}}">Product Request</span>
                </a>
                <a class="collapse-item" href="{{ route('visa-migration-request')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Migration.png')}}">
                <span style="{{request()->segment(3) == 'visa-migration-request' ? 'color: #e5365a;' : ''}}">Visa Migration Request</span>
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/database.png')}}">
        <span>Database</span>
        </a>
        <div id="collapseTwo" class=" collapse @if(request()->segment(3) == 'escorts') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('admin.e4u-database.escorts')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/escort.png')}}">
                <span style="{{ request()->segment(3) == 'escorts' ? 'color: #e5365a;' : '' }}">Manage New Profiles</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/media.png')}}">
                <span style="">Media Verification</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Migration.png')}}">
                <span style="">Pin-Up Management</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/agent.png')}}">
                <span style="">Agent List</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/contact-daata.png')}}">
                <span style="">User List</span></a>
            </div>
        </div>
    </li>
<!--     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Logs" aria-expanded="false" aria-controls="collapseTwo">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png')}}">
        <span>Logs</span>
        </a>
        <div id="Logs" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="" class="collapse">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/escort.png')}}">
                <span style="">Subitem</span></a>
            </div>
        </div>
    </li> -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reporting" aria-expanded="false" aria-controls="collapseTwo">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/online.png')}}">
        <span>Reporting</span>
        </a>
        <div id="Reporting" class="collapse @if(request()->segment(3) == 'email-request' || request()->segment(3) == 'mobile-request' || request()->segment(3) == 'admin-product-request' || request()->segment(3) == 'punterbox-report') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/online.png')}}">
                <span style="">New Advertisers</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/view.png')}}">
                <span style="">New Viewers</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/pachive.png')}}">
                <span style="">Users Online</span></a>
                <a class="collapse-item" href="{{ route('admin.email-request')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/at.png')}}">
                <span style="{{ request()->segment(3) == 'email-request' ? 'color: #e5365a;' : '' }}">Email Requests</span></a>
                <a class="collapse-item" href="{{ route('admin.mobile-request')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png')}}">
                <span style="{{ request()->segment(3) == 'mobile-request' ? 'color: #e5365a;' : '' }}">Mobile SIM Requests</span></a>
                <a class="collapse-item" href="{{ route('admin.admin-product-request')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png')}}">
                <span style="{{ request()->segment(3) == 'admin-product-request' ? 'color: #e5365a;' : '' }}">Product Orders</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Migration.png')}}">
                <span style="">Visa Requests</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/icons.png')}}">
                <span style="">Advertiser Reviews</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/report-card.png')}}">
                <span style="">Report Advertiser</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/profit-report.png')}}">
                <span style="">NUM Reports</span></a>
                <a class="collapse-item" href="{{ route('admin.punterbox-report')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/icons.png')}}">
                <span style="{{ request()->segment(3) == 'punterbox-report' ? 'color: #e5365a;' : '' }}">Punterbox Report</span></a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support"
            aria-expanded="true" aria-controls="collapseTwo">
        <img src="{{ asset('assets/dashboard/img/menu-icon/support.png')}}">
        <span>Support</span>
        </a>
        <div id="Support" class=" collapse @if(request()->segment(3) == 'abbreviations' || request()->segment(3) == 'classification-laws' || request()->segment(3) == 'laws' || request()->segment(3) == 'post' || request()->segment(3) == 'pricing') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('abbreviations') }}">
                <img src="{{ asset('assets/app/img/Abrieviations.png')}}">
                <span style="{{request()->segment(3) == 'abbreviations' ? 'color: #e5365a;' : ''}}">Abbreviations</span>
                </a>
                 
                <a href="{{route('classification-laws')}}" class="collapse-item">
                <img src="{{ asset('assets/app/img/gavel.png')}}">
                <span style="{{request()->segment(3) == 'classification-laws' ? 'color: #e5365a;' : ''}}">Classification Laws</span>
                </a>
                <a href="{{route('laws')}}" class="collapse-item">
                <img src="{{ asset('assets/app/img/helptips.png')}}">
                <span style="{{request()->segment(3) == 'laws' ? 'color: #e5365a;' : ''}}">Local Laws</span>
                </a>
                <a href="{{route('post')}}" class="collapse-item">
                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewtwo.png')}}">
                <span style="{{request()->segment(3) == 'post' ? 'color: #e5365a;' : ''}}">Post Office</span>
                </a>
                <a href="{{route('pricing')}}" class="collapse-item">
                <img src="{{ asset('assets/app/img/dollar.png')}}">
                <span style="{{request()->segment(3) == 'pricing' ? 'color: #e5365a;' : ''}}">Pricing Summaries</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support-Tickets" aria-expanded="false" aria-controls="Website">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
        <span>Support Tickets</span>
        </a>
        <div id="Support-Tickets" class=" collapse  @if( request()->segment(3) == 'global-notifications') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Migration.png')}}">
                <span>New Ticket</span>
                </a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Migration.png')}}">
                <span>View Tickets</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Website" aria-expanded="false" aria-controls="Website">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/e4ucms.png')}}">
        <span>Website</span>
        </a>
        <div id="Website" class=" collapse  @if( request()->segment(3) == 'maintenance' || request()->segment(3) == 'classification-laws') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a href="{{ route('maintenance')}}" class="collapse-item">
                <img src="{{ asset('assets/dashboard/img/menu-icon/contact-setting.png')}}">
                <span style="{{ request()->segment(3) == 'maintenance' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : ''}}">Maintenance</span>
                </a>
                <a class="collapse-item" href="{{ route('global-notifications')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{ request()->segment(3) == 'global-notifications' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : ''}}">Global Notifications</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount" aria-expanded="false" aria-controls="collapseTwo">
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z" fill="#C2CFE0"></path>
            </svg>
            <span>My Account</span>
        </a>
        <div id="myaccount" class="collapse @if(request()->segment(2) == 'update-account' || request()->segment(2) == 'profile-informations' || request()->segment(2) == 'change-password' || request()->segment(2) == 'upload-my-avatar') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('admin.account.edit')}}">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                <span style="{{request()->segment(2) == 'update-account' ? 'color: #e5365a;' : ''}}">Edit my account..</span></a>
                {{-- <a class="collapse-item" href="{{ route('center.profile.information')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{request()->segment(2) == 'profile-informations' ? 'color: #e5365a;' : ''}}">Profile information</span></a> --}}
                <a class="collapse-item" href="{{ route('admin.change.password')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png')}}">
                <span style="{{request()->segment(2) == 'change-password' ? 'color: #e5365a;' : ''}}">Change password</span></a>
                <a class="collapse-item" href="{{route('admin.profile.avatar')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png')}}">
                <span style="{{request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : ''}}">Upload my avatar</span></a>
            </div>
        </div>
    </li>
    @endif
    @if(auth()->user()->type == 1)
    <a class="sidebar-brand text-left" href="{{ route('home') }}">
    <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt=""><br>
    <span style="color:#FF3C5F;" class="font-weight-normal">Owner  Console</span>
    </a>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Dashboard" aria-expanded="false" aria-controls="collapseelavan">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z" fill="white"></path>
            </svg>
            <span>Dashboard</span>
        </a>
        <div id="Dashboard" class=" collapse @if(request()->segment(2) == 'service') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Global%20Monitoring.png') }}"> Global Monitoring</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Accounting.png') }}"> <span style="{{request()->segment(2) == 'pages' ? 'color: #e5365a;' : ''}}">Accounting</span></a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Database.png') }}"> Database</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Profiles&Tours.png') }}"> 
                Profiles & Tours
                </a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Reporting.png') }}"> 
                Reporting
                </a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Usermanagement.png') }}">  
                User management
                </a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Webiste.png') }}"> 
                Webiste
                </a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/Developer.png') }}">
                Developer
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/email-plus-outline.png') }}">
        <span>Email Template</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#database" aria-expanded="false" aria-controls="collapsetwale">
        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/database.png') }}">
        <span>E4U Database</span>
        </a>
        <div id="database" class="collapse" aria-labelledby="headingtwale" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
                <a href="#" class="collapse-item">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z" fill="#C2CFE0"></path>
                    </svg>
                    <span class="pl-3">Escorts</span>
                </a>
                <a href="#" class="collapse-item">
                <img class="m-0" width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/app/img/owner/dashboard/massage.png') }}"> <span class="pl-3">Massage Centres</span></a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cms" aria-expanded="false" aria-controls="collapsetwale">
        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/e4ucms.png') }}">
        <span>E4U CMS</span>
        </a>
        <div id="cms" class="collapse" aria-labelledby="headingtwale" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}"> Pages</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/abc.png') }}"> Abbreviations</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/menu.png') }}"> Menus</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Marketing" aria-expanded="false" aria-controls="collapsetwale">
        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/database.png') }}">
        <span>Marketing</span>
        </a>
        <div id="Marketing" class="collapse" aria-labelledby="headingtwale" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/contact-daata.png') }}"><span class="pl-1">Contact Database</span></a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/advertiser.png') }}"><span class="pl-1">Advertisers</span></a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/esteblitment.png') }}"> Establishments</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/comptitor.png') }}"> Competitor Database</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/contact-setting.png') }}"> Contact Settings</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/location.png') }}"> Location</a>
                <a href="#" class="collapse-item">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/pin.png') }}"> Pin-up Manager</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
        <img src="{{ asset('assets/dashboard/img/menu-icon/alert.png')}}">
        <span>Alerts</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#To_do"
            aria-expanded="true" aria-controls="collapseTwo">
        <img src="{{ asset('assets/dashboard/img/menu-icon/to-do.png')}}">
        <span>To do</span>
        </a>
        <div id="To_do" class=" collapse @if(request()->segment(2) == 'service' || request()->segment(2) == 'global-monitoring' || request()->segment(2) == 'online-monitoring-staff' || request()->segment(2) == 'pages') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-2 collapse-inner rounded">
                <a href="{{route('admin.service.index')}}" class="collapse-item">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3" style="{{request()->segment(2) == 'service' ? 'color: #e5365a;' : ''}}">Service</span>
                </a>
                <a href="{{route('admin.monitor')}}" class="collapse-item">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3" style="{{request()->segment(2) == 'global-monitoring' ? 'color: #e5365a;' : ''}}">Attempted Logins</span>
                </a>
                <a href="{{route('admin.monitor.onlineStaff')}}" class="collapse-item">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3" style="{{request()->segment(2) == 'online-monitoring-staff' ? 'color: #e5365a;' : ''}}">Online Users</span>
                </a>
                <a href="{{ route('admin.page.index')}}" class="collapse-item">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3" style="{{request()->segment(2) == 'pages' ? 'color: #e5365a;' : ''}}">Pages</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
        <img src="{{ asset('assets/dashboard/img/menu-icon/support.png')}}">
        <span>Support</span>
        </a>
    </li>
    @endif
</ul>
<!-- End of Sidebar -->