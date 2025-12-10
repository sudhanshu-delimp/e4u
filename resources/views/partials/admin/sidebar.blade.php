@php
    $securityLevel = isset(auth()->user()->staff_detail->security_level)
        ? auth()->user()->staff_detail->security_level
        : 0;
    $sidebar = staffPageAccessPermission($securityLevel, 'sidebar');

    $ocLavel = 'Management';
    if ($securityLevel == 2) {
        $ocLavel = 'Admin';
    } elseif ($securityLevel == 3) {
        $ocLavel = 'Admin';
    } elseif ($securityLevel == 4) {
        $ocLavel = 'Developer';
    }
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " alt="">
        </a> -->
    @if (auth()->user() && auth()->user()->type == 2)
        <a class="sidebar-brand text-left pb-3" href="{{ route('home') }}">
            <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt="">
        </a>

        <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-4">Opertions Console-Staff</span>
        <!-- Divider -->
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                        fill="white" />
                </svg>
                <span id="dash"
                    style="{{ $_SERVER['REQUEST_URI'] == '/admin-dashboard' ? 'color: #FF3C5F;' : '' }}">Dashboard
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.global-monitoring') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/globe.png') }}">
                <span>Global Monitoring </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('new') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/alert.png') }}">
                <span>Alerts </span>
            </a>
            <!--  <div id="collapsenew" class=" collapse @if (request()->segment(3) == 'new') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('new') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/new.png') }}">
                <span style="{{ request()->segment(3) == 'new' ? 'color: #FF3C5F;' : '' }}">New</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/edit.png') }}">
                <span style="">Edit</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/suspend.png') }}">
                <span style="">Suspend</span></a>
            </div>
        </div> -->
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Analytics </span>
            </a>
            <div id="Analytics" class="collapse @if (request()->segment(3) == 'publicpages' || request()->segment(3) == 'consoles') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('publicpages') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/advertiser.png') }}">
                        <span style="{{ request()->segment(3) == 'publicpages' ? 'color: #FF3C5F;' : '' }}">Public
                            Pages</span>
                    </a>
                    <a class="collapse-item" href="{{ route('consoles') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/console.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'consoles' ? 'color: #FF3C5F;' : '' }}">Consoles</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                <span>Concierge Services </span>
            </a>
            <div id="Concierge" class="collapse @if (request()->segment(3) == 'email-service-request' ||
                    request()->segment(3) == 'mobile-sim-request' ||
                    request()->segment(3) == 'product-request' ||
                    request()->segment(3) == 'visa-migration-request') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('email-service-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'email-service-request' ? 'color: #FF3C5F;' : '' }}">Email
                            Service Request</span>
                    </a>
                    <a class="collapse-item" href="{{ route('mobile-sim-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'mobile-sim-request' ? 'color: #FF3C5F;' : '' }}">Mobile
                            SIM Request</span>
                    </a>
                    <a class="collapse-item" href="{{ route('product-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'product-request' ? 'color: #FF3C5F;' : '' }}">Product
                            Request</span>
                    </a>
                    <a class="collapse-item" href="{{ route('visa-migration-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'visa-migration-request' ? 'color: #FF3C5F;' : '' }}">Visa
                            Migration Request</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#logs"
                aria-expanded="false" aria-controls="Website">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                <span>logs </span>
            </a>
            <div id="logs" class=" collapse  @if (request()->segment(3) == ' ') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.database') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/database.png') }}">
                <span>Database </span>
            </a>
            <!-- database
            <div id="collapseTwo" class=" collapse @if (request()->segment(3) == 'escorts') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('admin.e4u-database.escorts') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/escort.png') }}">
                    <span style="{{ request()->segment(3) == 'escorts' ? 'color: #FF3C5F;' : '' }}">Manage New Profiles</span></a>
                    <a class="collapse-item" href="#">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/media.png') }}">
                    <span style="">Media Verification</span></a>
                    <a class="collapse-item" href="#">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                    <span style="">Pin-Up Management</span></a>
                    <a class="collapse-item" href="#">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/agent.png') }}">
                    <span style="">Agent List</span></a>
                    <a class="collapse-item" href="#">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/contact-daata.png') }}">
                    <span style="">User List</span></a>
                </div>
            </div> -->
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reporting') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                <span>Reporting </span>
            </a>

            <div id="Reporting" class="collapse @if (request()->segment(3) == 'email-request' ||
                    request()->segment(3) == 'mobile-request' ||
                    request()->segment(3) == 'admin-product-request' ||
                    request()->segment(3) == 'punterbox-report') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                        <span style="">New Advertisers</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/view.png') }}">
                        <span style="">New Viewers</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/pachive.png') }}">
                        <span style="">Users Online</span></a>
                    <a class="collapse-item" href="{{ route('admin.email-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                        <span style="{{ request()->segment(3) == 'email-request' ? 'color: #FF3C5F;' : '' }}">Email
                            Requests</span></a>
                    <a class="collapse-item" href="{{ route('admin.mobile-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                        <span style="{{ request()->segment(3) == 'mobile-request' ? 'color: #FF3C5F;' : '' }}">Mobile
                            SIM Requests</span></a>
                    <a class="collapse-item" href="{{ route('admin.admin-product-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'admin-product-request' ? 'color: #FF3C5F;' : '' }}">Product
                            Orders</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                        <span style="">Visa Requests</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/icons.png') }}">
                        <span style="">Advertiser Reviews</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/report-card.png') }}">
                        <span style="">Report Advertiser</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/profit-report.png') }}">
                        <span style="">NUM Reports</span></a>
                    <a class="collapse-item" href="{{ route('admin.punterbox-report') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/icons.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'punterbox-report' ? 'color: #FF3C5F;' : '' }}">Punterbox
                            Report</span></a>
                </div>
            </div>

        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support"
                aria-expanded="true" aria-controls="collapseTwo">
                <img src="{{ asset('assets/dashboard/img/menu-icon/support.png') }}">
                <span>Support </span>
            </a>
            <div id="Support" class=" collapse @if (request()->segment(3) == 'abbreviations' ||
                    request()->segment(3) == 'classification-laws' ||
                    request()->segment(3) == 'laws' ||
                    request()->segment(3) == 'post' ||
                    request()->segment(3) == 'pricing') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('abbreviations') }}">
                        <img src="{{ asset('assets/app/img/Abrieviations.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'abbreviations' ? 'color: #FF3C5F;' : '' }}">Abbreviations</span>
                    </a>
                    <a href="{{ route('classification-laws') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/gavel.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'classification-laws' ? 'color: #FF3C5F;' : '' }}">Classification
                            Laws</span>
                    </a>
                    <a href="{{ route('laws') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/helptips.png') }}">
                        <span style="{{ request()->segment(3) == 'laws' ? 'color: #FF3C5F;' : '' }}">Local Laws</span>
                    </a>
                    <a href="{{ route('post') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reviewtwo.png') }}">
                        <span style="{{ request()->segment(3) == 'post' ? 'color: #FF3C5F;' : '' }}">Post
                            Office</span>
                    </a>
                    <a href="{{ route('pricing') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/dollar.png') }}">
                        <span style="{{ request()->segment(3) == 'pricing' ? 'color: #FF3C5F;' : '' }}">Pricing
                            Summaries</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.support-ticket.list') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                <span>Support Tickets </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Website"
                aria-expanded="false" aria-controls="Website">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/e4ucms.png') }}">
                <span>Website </span>
            </a>
            <div id="Website" class=" collapse  @if (request()->segment(3) == 'maintenance' || request()->segment(3) == 'global-notifications') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a href="{{ route('maintenance') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/contact-setting.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'maintenance' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Maintenance</span>
                    </a>
                    <a class="collapse-item" href="{{ route('global-notifications') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'global-notifications' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Global
                            Notifications</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount"
                aria-expanded="false" aria-controls="collapseTwo">
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                        fill="#C2CFE0"></path>
                </svg>
                <span>My Account </span>
            </a>
            <div id="myaccount" class="collapse @if (request()->segment(2) == 'update-account' ||
                    request()->segment(2) == 'profile-informations' ||
                    request()->segment(2) == 'change-password' ||
                    request()->segment(2) == 'upload-my-avatar') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('admin.account.edit') }}">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                        <span style="{{ request()->segment(2) == 'update-account' ? 'color: #FF3C5F;' : '' }}">Edit my
                            account..</span></a>
                    {{-- <a class="collapse-item" href="{{ route('center.profile.information')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{request()->segment(2) == 'profile-informations' ? 'color: #FF3C5F;' : ''}}">Profile information</span></a> --}}
                    <a class="collapse-item" href="{{ route('admin.change.password') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                        <span style="{{ request()->segment(2) == 'change-password' ? 'color: #FF3C5F;' : '' }}">Change
                            password</span></a>
                    <a class="collapse-item" href="{{ route('admin.profile.avatar') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #FF3C5F;' : '' }}">Upload
                            my avatar</span></a>
                </div>
            </div>
        </li>
    @endif
    @if (auth()->user() && auth()->user()->type == 1)
        <a class="sidebar-brand text-left" href="{{ route('home') }}">
            <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt=""><br>
            <span style="color:#FF3C5F;" class="font-weight-normal">OC ({{ $ocLavel }})</span>
        </a>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                        fill="white" />
                </svg>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Monitoring"
                aria-expanded="false" aria-controls="collapseMonitoring">
                <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Global Monitoring </span>
            </a>
            <div id="Monitoring" class="collapse @if (request()->is('*global-monitoring*') ||
                    request()->is('*logged-in-users*') ||
                    request()->is('*escort-listings*') ||
                    request()->is('*massage-centre-listings*') ||
                    request()->is('*visitors*') ||
                    request()->is('*pinup-listings*')) show @endif">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('admin.escort-listings', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}">
                        <span style="{{ request()->is('*escort-listings*') ? 'color: #FF3C5F;' : '' }}">Escort
                            Listings</span>
                    </a>

                    <a class="collapse-item"
                        href="{{ route('admin.massage-centre-listings', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png') }}">
                        <span
                            style="{{ request()->is('*massage-centre-listings*') ? 'color: #FF3C5F;' : '' }}">Massage
                            Centre Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.pin-up-listings', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*pinup-listings*') ? 'color: #FF3C5F;' : '' }}">Pin Up
                            Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.logged-in-users', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/login-user.png') }}">
                        <span style="{{ request()->is('*logged-in-users*') ? 'color: #FF3C5F;' : '' }}">Users Logged
                            In</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.visitors') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*visitors*') ? 'color: #FF3C5F;' : '' }}">Visitors</span>
                    </a>
                </div>
            </div>
        </li>
        

          <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px;margin-top: 10px;margin-bottom: 15px;"></li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration"
                    aria-expanded="false" aria-controls="Administration">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/administration.png') }}">
                    <span>Administration</span>
                </a>

                <div id="Administration"
                    class="collapse @if (in_array(request()->segment(3), [
                        'email-management','sim-management',
                        'publicpages','consoles',
                        'email-service-request','mobile-sim-request','product-request','visa-migration-request',
                        'manage-email','manage-sim',
                        'global','agents','viewer','escorts','centres',
                        'reports','send-reports',
                        'new','blog',
                        'credit','agent-requests','num','transaction-summary','advertiser-suspensions',
                        'registrations-reports','advertiser-reports','advertiser-reviews','support_tickets','application','revision','security'
                    ])) show @endif"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">

                    <div class="py-0 collapse-inner rounded mb-2">

                        {{-- Analytics --}}
                        <a class="nav-link collapsed collapsed" href="#" data-toggle="collapse"
                        data-target="#Analytics" aria-expanded="false" aria-controls="Analytics">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                            <span>Analytics</span>
                        </a>
                        <div id="Analytics" class="collapse @if (request()->segment(3) == 'publicpages' || request()->segment(3) == 'consoles') show @endif;">
                            <div class="py-0 collapse-inner rounded mb-2">
                                <a class="collapse-item" href="{{ route('publicpages') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/advertiser.png') }}">
                                    <span style="{{ request()->segment(3) == 'publicpages' ? 'color: #FF3C5F;' : '' }}">Public
                                        Pages</span>
                                </a>
                                <a class="collapse-item" href="{{ route('consoles') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/console.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'consoles' ? 'color: #FF3C5F;' : '' }}">Consoles</span>
                                </a>
                            </div>
                        </div>
                        {{-- end Analytics --}}

                    {{-- Concierge --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge"
                            aria-expanded="false" aria-controls="collapseTwo">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                            <span>Concierge</span>
                        </a>
                        <div id="Concierge" class="collapse @if (request()->segment(3) == 'email-service-request' ||
                                request()->segment(3) == 'mobile-sim-request' ||
                                request()->segment(3) == 'product-request' ||
                                request()->segment(3) == 'visa-migration-request') show @endif;"
                             style="">
                            <div class="py-0 collapse-inner rounded mb-2">
                                <a class="collapse-item" href="{{ route('email-service-request') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'email-service-request' ? 'color: #FF3C5F;' : '' }}">Email
                                        Requests</span>
                                </a>
                                <a class="collapse-item" href="{{ route('mobile-sim-request') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'mobile-sim-request' ? 'color: #FF3C5F;' : '' }}">SIM
                                        Requests</span>
                                </a>
                                <a class="collapse-item" href="{{ route('product-request') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'product-request' ? 'color: #FF3C5F;' : '' }}">Product
                                        Orders</span>
                                </a>
                                <a class="collapse-item" href="{{ route('visa-migration-request') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'visa-migration-request' ? 'color: #FF3C5F;' : '' }}">Visa
                                        Migration Request</span>
                                </a>
                            </div>
                        </div>
                    {{-- end Concierge --}}

                        {{-- Database --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Database"
                            aria-expanded="false" aria-controls="collapseTwo">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/admin-database.png') }}">
                            <span>Database</span>
                        </a>
                        <div id="Database" class="collapse @if (request()->segment(3) == 'manage-email' || request()->segment(3) == 'manage-sim') show @endif;"
                            style="">
                            <div class="py-0 collapse-inner rounded mb-2">
                                <a class="collapse-item" href="{{ route('manage-email') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                                    <span style="{{ request()->segment(3) == 'manage-email' ? 'color: #FF3C5F;' : '' }}">Manage
                                        Emails</span>
                                </a>

                                <a class="collapse-item" href="{{ route('manage-sim') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/add-sim-list.png') }}">
                                    <span style="{{ request()->segment(3) == 'manage-sim' ? 'color: #FF3C5F;' : '' }}">Manage
                                        SIMs</span>
                                </a>
                            </div>
                        </div>
                        {{-- Database --}}

                        {{-- logs --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#logs"
                            aria-expanded="false" aria-controls="Website">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                            <span>logs </span>
                        </a>
                        <div id="logs" class="collapse @if (request()->segment(3) == 'application' || request()->segment(3) == 'revision' || request()->segment(3) == 'security') show @endif;"
                            style="">
                            <div class="py-0 collapse-inner rounded mb-2">
                                <a class="collapse-item" href="{{ route('admin.application') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                    <span style="{{ request()->segment(3) == 'application' ? 'color: #FF3C5F;' : '' }}">Application</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.revision') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                    <span style="{{ request()->segment(3) == 'revision' ? 'color: #FF3C5F;' : '' }}">Revision</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.security') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                    <span style="{{ request()->segment(3) == 'security' ? 'color: #FF3C5F;' : '' }}">Security</span>
                                </a>
                            </div>
                        </div>
                        {{-- end --}}
                    
                    <!-- Notification -->

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#notification"
                            aria-expanded="false" aria-controls="notification">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/global-notification.png') }}">
                            <span>Notifications<!----></span>
                        </a>
                        <div id="notification" class=" collapse  @if (request()->segment(3) == 'global' ||
                                request()->segment(3) == 'agents' ||
                                request()->segment(3) == 'viewer' ||
                                request()->segment(3) == 'escorts' ||
                                request()->segment(3) == 'centres') show @endif;">

                            <div class="py-0 collapse-inner rounded mb-2">
                                {{-- global --}}
                                <a href="{{ route('admin.global', ['from' => 'sidebar']) }}" class="collapse-item">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/g-notification.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'global' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Global</span>
                                </a>
                                {{-- agents --}}

                                <a href="{{ route('admin.agent.notifications.index') }}" class="collapse-item">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/agent.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'agents' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Agents</span>
                                </a>
                                
                                {{-- escorts --}}
                                <a href="{{ route('admin.escorts') }}" class="collapse-item">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/e-notification.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'escorts' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Escorts</span>
                                </a>
                                {{-- centres --}}
                                <a href="{{ route('admin.centres.notifications.index') }}" class="collapse-item">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/c-notification.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'centres' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Massage
                                        Centres</span>
                                </a>


                                {{-- viewers --}}
                                <a href="{{ route('admin.viewer.notification.index') }}" class="collapse-item">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/v-notification.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'viewer' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Viewers</span>
                                </a>


                            </div>
                        </div>
                    <!-- end -->

                    <!-- post Office -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#PostOffice"
                            aria-expanded="false" aria-controls="PostOffice">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/post-office.png') }}">
                            <span>Post Office</span>
                        </a>
                        <div id="PostOffice" class=" collapse  @if (request()->segment(3) == 'reports' || request()->segment(3) == 'send-reports') show @endif;"
                           >
                            <div class="py-0 collapse-inner rounded mb-2">
                                <a href="{{ route('admin.send-reports') }}" class="collapse-item">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/email-report.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'send-reports' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">New</span>
                                </a>
                                <a href="{{ route('admin.reports') }}" class="collapse-item">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/email-report.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'reports' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Reports</span>
                                </a>

                            </div>
                        </div>
                    <!-- end -->

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Publications"
                            aria-expanded="false" aria-controls="collapseTwo">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/publication.png') }}">
                            <span>Publications</span>
                        </a>
                        <div id="Publications" class="collapse @if (request()->is('*new*') || request()->is('*blog*')) show @endif;"
                            >
                            <div class="py-0 collapse-inner rounded mb-2">
                                <a class="nav-link collapsed" href="{{ route('new') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/alert.png') }}">
                                    <span style="{{ request()->is('*new*') ? 'color: #FF3C5F;' : '' }}">Alerts</span>
                                </a>
                                <a class="nav-link collapsed" href="{{ route('admin.blog') }}">
                                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
                                        viewBox="0 0 512 512" xml:space="preserve" fill="#000000">

                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                        <g id="SVGRepo_iconCarrier">
                                            <style type="text/css">
                                                .st0 {
                                                    fill: #ffffffcc;
                                                }
                                            </style>
                                            <g>
                                                <path class="st0"
                                                    d="M421.073,221.719c-0.578,11.719-9.469,26.188-23.797,40.094v183.25c-0.016,4.719-1.875,8.719-5.016,11.844 c-3.156,3.063-7.25,4.875-12.063,4.906H81.558c-4.781-0.031-8.891-1.844-12.047-4.906c-3.141-3.125-4.984-7.125-5-11.844V152.219 c0.016-4.703,1.859-8.719,5-11.844c3.156-3.063,7.266-4.875,12.047-4.906h158.609c12.828-16.844,27.781-34.094,44.719-49.906 c0.078-0.094,0.141-0.188,0.219-0.281H81.558c-18.75-0.016-35.984,7.531-48.25,19.594c-12.328,12.063-20.016,28.938-20,47.344 v292.844c-0.016,18.406,7.672,35.313,20,47.344C45.573,504.469,62.808,512,81.558,512h298.641c18.781,0,36.016-7.531,48.281-19.594 c12.297-12.031,20-28.938,19.984-47.344V203.469c0,0-0.125-0.156-0.328-0.313C440.37,209.813,431.323,216.156,421.073,221.719z" />
                                                <path class="st0"
                                                    d="M498.058,0c0,0-15.688,23.438-118.156,58.109C275.417,93.469,211.104,237.313,211.104,237.313 c-15.484,29.469-76.688,151.906-76.688,151.906c-16.859,31.625,14.031,50.313,32.156,17.656 c34.734-62.688,57.156-119.969,109.969-121.594c77.047-2.375,129.734-69.656,113.156-66.531c-21.813,9.5-69.906,0.719-41.578-3.656 c68-5.453,109.906-56.563,96.25-60.031c-24.109,9.281-46.594,0.469-51-2.188C513.386,138.281,498.058,0,498.058,0z" />
                                            </g>
                                        </g>

                                    </svg>
                                    <span style="{{ request()->is('*blog*') ? 'color: #FF3C5F;' : '' }}">Blog</span>
                                </a>
                            </div>
                        </div>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reports"
                            aria-expanded="false" aria-controls="collapseTwo">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                            <span>Reports </span>
                        </a>



                        <div id="Reports" class="collapse @if (request()->is('*credit*') ||
                                request()->is('*agent-requests*') ||
                                request()->is('*num*') ||
                                request()->is('*transaction-summary*') ||
                                request()->is('*advertiser-suspensions*') ||
                                request()->is('*registrations-reports*') ||
                                request()->is('*advertiser-reports*') ||
                                request()->is('*advertiser-reviews*')) show @endif;">
                            <div class="py-0 collapse-inner rounded mb-2">
                               

                                <a class="nav-link collapsed" href="{{ route('admin.advertiser-reports') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/advertiser-reports.png') }}">
                                    <span style="{{ request()->is('*advertiser-reports*') ? 'color: #FF3C5F;' : '' }}">Advertiser Reports</span>
                                </a>
                                <a class="nav-link collapsed" href="{{ route('admin.advertiser-reviews') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/add-reviews.png') }}">
                                    <span style="{{ request()->is('*advertiser-reviews*') ? 'color: #FF3C5F;' : '' }}">Advertiser Reviews</span>
                                </a>
                                 <a class="nav-link collapsed" href="{{ route('admin.agent-requests', ['from' => 'sidebar']) }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/agent-request.png') }}">
                                    <span style="{{ request()->is('*agent-requests*') ? 'color: #FF3C5F;' : '' }}">Agent Requests</span>
                                </a>
                                <a class="nav-link collapsed" href="{{ route('admin.credit') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/credits.png') }}">
                                    <span style="{{ request()->is('*credit*') ? 'color: #FF3C5F;' : '' }}">Credits</span>
                                </a>

                                <a class="nav-link collapsed" href="{{ route('admin.num') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png') }}">
                                    <span style="{{ request()->is('*num*') ? 'color: #FF3C5F;' : '' }}">NUM</span>
                                </a>
                                <a class="nav-link collapsed"
                                    href="{{ route('admin.registrations-reports', ['from' => 'sidebar']) }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/registration-reports.png') }}">
                                    <span
                                        style="{{ request()->is('*registrations-reports*') ? 'color: #FF3C5F;' : '' }}">Registrations</span>
                                </a>
                                <a class="nav-link collapsed" href="{{ route('admin.advertiser-suspensions') }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/profile-suspensions.png') }}">
                                    <span
                                        style="{{ request()->is('*advertiser-suspensions*') ? 'color: #FF3C5F;' : '' }}">Suspensions</span>
                                </a>
                                <a class="nav-link collapsed"
                                    href="{{ route('admin.transaction-summary', ['from' => 'sidebar']) }}">
                                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                        src="{{ asset('assets/dashboard/img/menu-icon/transaction-summary.png') }}">
                                    <span
                                        style="{{ request()->is('*transaction-summary*') ? 'color: #FF3C5F;' : '' }}">Transaction
                                        Summary</span>
                                </a>
                            </div>
                        </div>

                        <a class="nav-link" href="{{ route('admin.support-ticket.list', ['from' => 'sidebar']) }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}" >
                            <span style="{{ request()->segment(3) == 'support_tickets' ? 'color: #FF3C5F;' : '' }}">Support Tickets </span>
                        </a>
                        
                    </div>
                </div>
            </li>

        @if (isset($sidebar['management']['yesNo']) && $sidebar['management']['yesNo'] == 'yes')
            <li
                style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px;margin-top: 10px;margin-bottom: 15px;">
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management"
                    aria-expanded="false" aria-controls="Management">
                    <img width="16" height="17"
                        src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
                    <span>Management</span>
                </a>

                <!-- Parent: Management -->
                <div id="Management" class="collapse @if (in_array(request()->segment(3), [
                        'email-management',
                        'sim-management',
                        'advertiser-templates', 'e4u-templates', 'agent-templates', 'operator-templates', 'shareholder-templates', 'viewer-templates',
                        'set-fees',
                        'manage-user',
                        'memberships',
                        'legbox-report',
                        'agents-monthly-report',
                        'punterbox-reports',
                        'tours',
                        'staff',
                        'competitor-database',
                        'monthly-fee-reports',
                        'commission-summary',
                        'operator-manage',
                        'profile',
                        'agent',
                        'manage-suppliers',
                        'dashboard',
                        'All-user',
                        'email-templates',
                        'annual-report',
                        'minutes',
                        'annual-profit-and-loss',
                        'balance-sheet',
                        'constitution',
                        'newsletter',
                        'shareholder-notices',
                        'subsidiaries-balance-sheet',
                        'subsidiaries-annual-profit-and-loss',
                        'updates',
                        'staff',
                    ])) show @endif"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#manageAgentMenu" aria-expanded="false" aria-controls="manageAgentMenu">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                            <span>Agents </span>
                        </a>
                        <div id="manageAgentMenu"
                            class="collapse @if (in_array(request()->segment(3), ['agent', 'agents-monthly-report'])) show @endif pl-3"
                            style="margin-left: 10px;">
                            <a class="collapse-item" href="{{ route('admin.agents-monthly-report') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'agents-monthly-report' ? 'color: #FF3C5F;' : '' }}">Monthly
                                    Report</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.agent') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span style="{{ request()->segment(3) == 'agent' ? 'color: #FF3C5F;' : '' }}">Manage
                                    Agents</span>
                            </a>

                        </div>

                        <!-- CMS -->
                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#CMSMenu" aria-expanded="false" aria-controls="CMSMenu">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/cms.png') }}">
                            <span>CMS</span>
                        </a>
                        <div id="CMSMenu" class="collapse @if (in_array(request()->segment(3), 
                        ['advertiser-templates', 'e4u-templates', 'agent-templates', 'operator-templates', 'shareholder-templates', 'viewer-templates'])) 
                        show @endif pl-3"
                            style="margin-left: 10px;">

                           

                            <a class="collapse-item" href="{{ route('admin.advertiser-templates') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'advertiser-templates' ? 'color: #FF3C5F;' : '' }}">Advertiser Templates</span>
                            </a>

                             <a class="collapse-item" href="{{ route('admin.agent-templates') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'agent-templates' ? 'color: #FF3C5F;' : '' }}">Agent Templates</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.e4u-templates') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'e4u-templates' ? 'color: #FF3C5F;' : '' }}">E4U Templates</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.operator-templates') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'operator-templates' ? 'color: #FF3C5F;' : '' }}">Operator Templates</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.shareholder-templates') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'shareholder-templates' ? 'color: #FF3C5F;' : '' }}">Shareholder Templates</span>
                            </a>
                            
                            <a class="collapse-item" href="{{ route('admin.viewer-templates') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'viewer-templates' ? 'color: #FF3C5F;' : '' }}">Viewer Templates</span>
                            </a>


                        </div>
                        {{-- end --}}
                        <!-- Concierge -->
                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#ConciergeMenu" aria-expanded="false" aria-controls="ConciergeMenu">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                            <span>Concierge</span>
                        </a>
                        <div id="ConciergeMenu" class="collapse @if (in_array(request()->segment(3), ['email-management', 'sim-management'])) show @endif pl-3"
                            style="margin-left: 10px;">
                            <a class="collapse-item" href="{{ route('admin.email-management') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'email-management' ? 'color: #FF3C5F;' : '' }}">Email
                                    Management</span>
                            </a>

                            <a class="collapse-item" href="{{ route('sim-management') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'sim-management' ? 'color: #FF3C5F;' : '' }}">SIM
                                    Management</span>
                            </a>
                        </div>
                        {{-- end --}}


                        <!-- Manage People -->
                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#managePeopleMenu" aria-expanded="false" aria-controls="managePeopleMenu">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                            <span>Manage People</span>
                        </a>
                        <div id="managePeopleMenu"
                            class="collapse @if (in_array(request()->segment(3), ['staff', 'manage-suppliers'])) show @endif pl-3"
                            style="margin-left: 10px;">
                            <a class="collapse-item" href="{{ route('admin.staff') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span style="{{ request()->segment(3) == 'staff' ? 'color: #FF3C5F;' : '' }}">
                                    Staff</span>
                            </a>
                            <!-- <a class="collapse-item" href="{{ route('admin.agent') }}">
                            <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                            <span style="{{ request()->segment(3) == 'agent' ? 'color: #FF3C5F;' : '' }}">Manage Agents</span>
                        </a> -->
                            <a class="collapse-item" href="{{ route('admin.manage-suppliers') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'manage-suppliers' ? 'color: #FF3C5F;' : '' }}">
                                    Suppliers</span>
                            </a>
                        </div>


                        <!-- Marketing -->
                        {{-- <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#Marketing" aria-expanded="false" aria-controls="Marketing">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                            <span>Marketing</span>
                        </a>
                        <div id="Marketing" class="collapse @if (in_array(request()->segment(3), ['marketing-templates-e4u', 'marketing-templates-agents'])) show @endif pl-3"
                            style="margin-left: 10px;">



                            <a class="collapse-item" href="{{ route('admin.marketing-templates-agents') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'marketing-templates-agents' ? 'color: #FF3C5F;' : '' }}">Templates
                                    - Agents</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.marketing-templates-e4u') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'marketing-templates-e4u' ? 'color: #FF3C5F;' : '' }}">Templates
                                    - E4U</span>
                            </a>
                        </div> --}}

                        <!-- Operator -->
                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#operatorMenu" aria-expanded="false" aria-controls="operatorMenu">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/operator.png') }}">
                            <span>Operator</span>
                        </a>
                        <div id="operatorMenu" class="collapse @if (in_array(request()->segment(3), ['monthly-fee-reports', 'commission-summary', 'operator-manage'])) show @endif pl-3"
                            style="margin-left: 10px;">
                            <a class="collapse-item" href="{{ route('admin.monthly-fee-reports') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'monthly-fee-reports' ? 'color: #FF3C5F;' : '' }}">Monthly
                                    Fee Reports</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.commission-summary') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'commission-summary' ? 'color: #FF3C5F;' : '' }}">Fees
                                    Summary</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.operator-manage') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'operator-manage' ? 'color: #FF3C5F;' : '' }}">Manage
                                    Operator</span>
                            </a>
                        </div>

                        <!-- Settings -->
                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#SettingsMenu" aria-expanded="false" aria-controls="SettingsMenu">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/statistic.png') }}">
                            <span>Settings</span>
                        </a>
                        <div id="SettingsMenu" class="collapse @if (in_array(request()->segment(3), ['All-user', 'set-fees'])) show @endif pl-3"
                            style="margin-left: 10px;">


                            <a class="collapse-item" href="{{ route('admin.set-fees') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'set-fees' ? 'color: #FF3C5F;' : '' }}">Fees
                                    & Variables - Users</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.management.allUser') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'All-user' ? 'color: #FF3C5F;' : '' }}">Security
                                    & Access Levels</span>
                            </a>

                        </div>

                        {{-- Shareholders --}}
                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#ShareholdersMenu" aria-expanded="false"
                            aria-controls="ShareholdersMenu">
                            <img src="{{ asset('assets//dashboard/img/menu-icon/profit.png') }}">
                            <span>Shareholders</span>
                        </a>
                        <div id="ShareholdersMenu"
                            class="collapse @if (in_array(request()->segment(3), [
                                    'annual-report',
                                    'annual-profit-and-loss',
                                    'balance-sheet',
                                    'constitution',
                                    'minutes',
                                    'newsletter',
                                    'shareholder-notices',
                                    'subsidiaries-balance-sheet',
                                    'subsidiaries-annual-profit-and-loss',
                                    'updates',
                                ])) show @endif pl-3"
                            style="margin-left: 10px;">


                            <a class="collapse-item" href="{{ route('admin.annual-report') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'annual-report' ? 'color: #FF3C5F;' : '' }}">Annual
                                    Report</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.annual-profit-and-loss') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'annual-profit-and-loss' ? 'color: #FF3C5F;' : '' }}">Annual
                                    Profit & Loss</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.balance-sheet') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'balance-sheet' ? 'color: #FF3C5F;' : '' }}">Balance
                                    Sheet</span>
                            </a>


                            <a class="collapse-item" href="{{ route('admin.constitution') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'constitution' ? 'color: #FF3C5F;' : '' }}">Constitution</span>
                            </a>


                            <a class="collapse-item" href="{{ route('admin.minutes') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'minutes' ? 'color: #FF3C5F;' : '' }}">Minutes</span>
                            </a>



                            <a class="collapse-item" href="{{ route('admin.newsletter') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'newsletter' ? 'color: #FF3C5F;' : '' }}">Newsletter</span>
                            </a>


                            <a class="collapse-item" href="{{ route('admin.shareholder-notices') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'shareholder-notices' ? 'color: #FF3C5F;' : '' }}">Shareholder
                                    Notices</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.subsidiaries-balance-sheet') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'subsidiaries-balance-sheet' ? 'color: #FF3C5F;' : '' }}">Subsidiaries
                                    Balance Sheet</span>
                            </a>

                            <a class="collapse-item"
                                href="{{ route('admin.subsidiaries-annual-profit-and-loss') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'subsidiaries-annual-profit-and-loss' ? 'color: #FF3C5F;' : '' }}">Subsidiaries
                                    Annual Profit & Loss</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.updates') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'updates' ? 'color: #FF3C5F;' : '' }}">Updates</span>
                            </a>
                        </div>
                        {{-- end --}}

                        <!-- Statistics -->
                        <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                            data-target="#statisticsMenu" aria-expanded="false" aria-controls="statisticsMenu">
                            <img width="16" height="17"
                                src="{{ asset('assets/dashboard/img/menu-icon/statistic.png') }}">
                            <span>Statistics</span>
                        </a>
                        <div id="statisticsMenu"
                            class="collapse @if (in_array(request()->segment(3), ['tours', 'profile', 'memberships'])) show @endif pl-3"
                            style="margin-left: 10px;">
                            <a class="collapse-item" href="{{ route('admin.memberships') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'memberships' ? 'color: #FF3C5F;' : '' }}">Memberships</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.profile') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Profile</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.tours') }}">
                                <img width="16" height="17"
                                    src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'tours' ? 'color: #FF3C5F;' : '' }}">Tours</span>
                            </a>

                        </div>
                    </div>
                </div>
            </li>
        @endif

        <li
            style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px;margin-top: 10px;margin-bottom: 15px;">
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount"
                aria-expanded="false" aria-controls="collapseTwo">
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                        fill="#C2CFE0"></path>
                </svg>
                <span>My Account </span>
            </a>
            <div id="myaccount" class="collapse @if (request()->segment(2) == 'update-account' ||
                    request()->segment(2) == 'profile-informations' ||
                    request()->segment(2) == 'change-password' ||
                    request()->segment(2) == 'upload-my-avatar') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('admin.account.edit') }}">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                        <span style="{{ request()->segment(2) == 'update-account' ? 'color: #FF3C5F;' : '' }}">Edit
                            my account..</span></a>
                    <a class="collapse-item" href="{{ route('admin.change.password') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'change-password' ? 'color: #FF3C5F;' : '' }}">Change
                            password</span></a>
                    <a class="collapse-item" href="{{ route('admin.profile.avatar') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #FF3C5F;' : '' }}">Upload
                            my avatar</span></a>
                </div>
            </div>
        </li>

    @endif
</ul>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var monitoring = document.getElementById("Monitoring");
        var toggle = document.querySelector('[data-target="#Monitoring"]');

        // Hamesha open rakho by default
        if (!monitoring.classList.contains("show")) {
            monitoring.classList.add("show");
        }

        // Prevent auto close (jab dusra menu click ho)
        $('#Monitoring').on('hide.bs.collapse', function(e) {
            if (!toggle.classList.contains("force-close")) {
                e.preventDefault();
            }
        });

        // Sirf jab Global Monitoring pe click ho tab hi band karo
        toggle.addEventListener("click", function(e) {
            e.preventDefault();
            if (monitoring.classList.contains("show")) {
                toggle.classList.add("force-close");
                $('#Monitoring').collapse('hide');
                setTimeout(() => toggle.classList.remove("force-close"), 300);
            } else {
                $('#Monitoring').collapse('show');
            }
        });
    });
</script>
<!-- End of Sidebar -->
