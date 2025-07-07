<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " alt="">
        </a> -->
    @if (auth()->user()->type == 2)
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
                    style="{{ $_SERVER['REQUEST_URI'] == '/admin-dashboard' ? 'color: #e5365a;' : '' }}">Dashboard
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
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.accounting-reports') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/book.png') }}">
                <span>Accounting Reports </span>
            </a>
        </li> --}}
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
                <span style="{{ request()->segment(3) == 'new' ? 'color: #e5365a;' : '' }}">New</span></a>
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
                        <span style="{{ request()->segment(3) == 'publicpages' ? 'color: #e5365a;' : '' }}">Public
                            Pages</span>
                    </a>
                    <a class="collapse-item" href="{{ route('consoles') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/console.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'consoles' ? 'color: #e5365a;' : '' }}">Consoles</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Billing"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Billing (Support Services) </span>
            </a>
        </li> --}}
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
                            style="{{ request()->segment(3) == 'email-service-request' ? 'color: #e5365a;' : '' }}">Email
                            Service Request</span>
                    </a>
                    <a class="collapse-item" href="{{ route('mobile-sim-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'mobile-sim-request' ? 'color: #e5365a;' : '' }}">Mobile
                            SIM Request</span>
                    </a>
                    <a class="collapse-item" href="{{ route('product-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'product-request' ? 'color: #e5365a;' : '' }}">Product
                            Request</span>
                    </a>
                    <a class="collapse-item" href="{{ route('visa-migration-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'visa-migration-request' ? 'color: #e5365a;' : '' }}">Visa
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
                <span>Database &#10060;</span>
            </a>
            <!-- database
        <div id="collapseTwo" class=" collapse @if (request()->segment(3) == 'escorts') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('admin.e4u-database.escorts') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/escort.png') }}">
                <span style="{{ request()->segment(3) == 'escorts' ? 'color: #e5365a;' : '' }}">Manage New Profiles</span></a>
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
        </div>
        -->
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reporting') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                <span>Reporting &#10060;</span>
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
                        <span style="{{ request()->segment(3) == 'email-request' ? 'color: #e5365a;' : '' }}">Email
                            Requests</span></a>
                    <a class="collapse-item" href="{{ route('admin.mobile-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                        <span style="{{ request()->segment(3) == 'mobile-request' ? 'color: #e5365a;' : '' }}">Mobile
                            SIM Requests</span></a>
                    <a class="collapse-item" href="{{ route('admin.admin-product-request') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'admin-product-request' ? 'color: #e5365a;' : '' }}">Product
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
                            style="{{ request()->segment(3) == 'punterbox-report' ? 'color: #e5365a;' : '' }}">Punterbox
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
                            style="{{ request()->segment(3) == 'abbreviations' ? 'color: #e5365a;' : '' }}">Abbreviations</span>
                    </a>
                    <a href="{{ route('classification-laws') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/gavel.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'classification-laws' ? 'color: #e5365a;' : '' }}">Classification
                            Laws</span>
                    </a>
                    <a href="{{ route('laws') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/helptips.png') }}">
                        <span style="{{ request()->segment(3) == 'laws' ? 'color: #e5365a;' : '' }}">Local Laws</span>
                    </a>
                    <a href="{{ route('post') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reviewtwo.png') }}">
                        <span style="{{ request()->segment(3) == 'post' ? 'color: #e5365a;' : '' }}">Post
                            Office</span>
                    </a>
                    <a href="{{ route('pricing') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/dollar.png') }}">
                        <span style="{{ request()->segment(3) == 'pricing' ? 'color: #e5365a;' : '' }}">Pricing
                            Summaries</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            {{--        <a class="nav-link" href="{{ route('admin.support-tickets')}}"> --}}
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
                            style="{{ request()->segment(3) == 'maintenance' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Maintenance</span>
                    </a>
                    <a class="collapse-item" href="{{ route('global-notifications') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'global-notifications' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Global
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
                        <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">Edit my
                            account..</span></a>
                    {{-- <a class="collapse-item" href="{{ route('center.profile.information')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{request()->segment(2) == 'profile-informations' ? 'color: #e5365a;' : ''}}">Profile information</span></a> --}}
                    <a class="collapse-item" href="{{ route('admin.change.password') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                        <span style="{{ request()->segment(2) == 'change-password' ? 'color: #e5365a;' : '' }}">Change
                            password</span></a>
                    <a class="collapse-item" href="{{ route('admin.profile.avatar') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload
                            my avatar</span></a>
                </div>
            </div>
        </li>
    @endif
    @if (auth()->user()->type == 1)
        <a class="sidebar-brand text-left" href="{{ route('home') }}">
            <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt=""><br>
            <span style="color:#FF3C5F;" class="font-weight-normal">Operational Console-Admin</span>
        </a>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                        fill="white" />
                </svg>
                <span>Dashboard &#10060;</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Monitoring"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Global Monitoring </span>
            </a>
            <div id="Monitoring" class="collapse @if (request()->is('*global-monitoring*') ||
                    request()->is('*logged-in-users*') ||
                    request()->is('*escort-listings*') ||
                    request()->is('*massage-centre-listings*') ||
                    request()->is('*visitors*')) show @endif"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    {{-- <a class="collapse-item" href="{{ route('admin.global-monitoring') }}">

                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/globe.png') }}">
                        <span style="{{ request()->is('*global-monitoring*') ? 'color: #e5365a;' : '' }}">Global
                            Monitoring</span>
                    </a> --}}
                    <a class="collapse-item" href="{{ route('admin.escort-listings') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}">
                        <span style="{{ request()->is('*escort-listings*') ? 'color: #e5365a;' : '' }}">Escort
                            Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.logged-in-users') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/login-user.png') }}">
                        <span style="{{ request()->is('*logged-in-users*') ? 'color: #e5365a;' : '' }}">Logged in
                            Users</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.massage-centre-listings') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png') }}">
                        <span
                            style="{{ request()->is('*massage-centre-listings*') ? 'color: #e5365a;' : '' }}">Massage
                            Centre Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.visitors') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*visitors*') ? 'color: #e5365a;' : '' }}">Visitors</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.pin-up-listings') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*pinup-listings*') ? 'color: #e5365a;' : '' }}">Pin Up Listings</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.blog') }}">
                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 512 512"
                    xml:space="preserve" fill="#000000">

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
                <span>Blog &#10060;</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.database') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/database.png') }}">
                <span>Database &#10060;</span>
            </a>
        </li>
        <!-- Notification -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#notification"
                aria-expanded="false" aria-controls="notification">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/global-notification.png') }}">
                <span>Notifications &#10060;<!----></span>
            </a>
            <div id="notification" class=" collapse  @if (request()->segment(3) == 'global' ||
                    request()->segment(3) == 'agents' ||
                    request()->segment(3) == 'viewers' ||
                    request()->segment(3) == 'escorts' ||
                    request()->segment(3) == 'centres') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    {{-- global --}}
                    <a href="{{ route('admin.global') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/g-notification.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'global' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Global</span>
                    </a>
                    {{-- agents --}}
                    <a href="{{ route('admin.agents') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/agent.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'agents' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Agents</span>
                    </a>
                    {{-- viewers --}}
                    <a href="{{ route('admin.viewers') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/v-notification.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'viewers' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Viewers</span>
                    </a>
                    {{-- escorts --}}
                    <a href="{{ route('admin.escorts') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/e-notification.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'escorts' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Escorts</span>
                    </a>
                    {{-- centres --}}
                    <a href="{{ route('admin.centres') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/c-notification.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'centres' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Centres</span>
                    </a>
                </div>
            </div>
        </li>
        <!-- end -->

        <!-- post Office -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#PostOffice"
                aria-expanded="false" aria-controls="PostOffice">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/post-office.png') }}">
                <span>Post Office &#10060;</span>
            </a>
            {{-- <div id="PostOffice" class=" collapse  @if (request()->segment(3) == 'newpost') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a href="#" class="collapse-item">
                        <!-- Uploaded to: SVG Repo, www.svgrepo.com, Transformed by: SVG Repo Mixer Tools -->
                        <svg width="15px" height="15px" viewBox="0 0 32 32" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ffffffcc"
                            style="margin-right: 15px;">

                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                            <g id="SVGRepo_iconCarrier">
                                <title>new</title>
                                <defs> </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd" sketch:type="MSPage">
                                    <g id="Icon-Set" sketch:type="MSLayerGroup"
                                        transform="translate(-516.000000, -99.000000)" fill="#ffffffcc">
                                        <path
                                            d="M527.786,122.02 L522.414,125.273 C521.925,125.501 521.485,125.029 521.713,124.571 L524.965,119.195 L527.786,122.02 L527.786,122.02 Z M537.239,106.222 L540.776,109.712 L529.536,120.959 C528.22,119.641 526.397,117.817 526.024,117.444 L537.239,106.222 L537.239,106.222 Z M540.776,102.683 C541.164,102.294 541.793,102.294 542.182,102.683 L544.289,104.791 C544.677,105.18 544.677,105.809 544.289,106.197 L542.182,108.306 L538.719,104.74 L540.776,102.683 L540.776,102.683 Z M524.11,117.068 L519.81,125.773 C519.449,126.754 520.233,127.632 521.213,127.177 L529.912,122.874 C530.287,122.801 530.651,122.655 530.941,122.365 L546.396,106.899 C547.172,106.124 547.172,104.864 546.396,104.088 L542.884,100.573 C542.107,99.797 540.85,99.797 540.074,100.573 L524.619,116.038 C524.328,116.329 524.184,116.693 524.11,117.068 L524.11,117.068 Z M546,111 L546,127 C546,128.099 544.914,129.012 543.817,129.012 L519.974,129.012 C518.877,129.012 517.987,128.122 517.987,127.023 L517.987,103.165 C517.987,102.066 518.902,101 520,101 L536,101 L536,99 L520,99 C517.806,99 516,100.969 516,103.165 L516,127.023 C516,129.22 517.779,131 519.974,131 L543.817,131 C546.012,131 548,129.196 548,127 L548,111 L546,111 L546,111 Z"
                                            id="new" sketch:type="MSShapeGroup"> </path>
                                    </g>
                                </g>
                            </g>

                        </svg>
                        <span
                            style="{{ request()->segment(3) == 'newpost' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">New</span>
                    </a>
                </div>
            </div> --}}
            <div id="PostOffice" class=" collapse  @if (request()->segment(3) == 'reports' || request()->segment(3) == 'send-reports') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a href="{{ route('admin.send-reports') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/email-report.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'send-reports' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">New</span>
                    </a>
                    <a href="{{ route('admin.reports') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/email-report.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'reports' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Reports</span>
                    </a>

                </div>
            </div>
        </li>
        <!-- end -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Publications"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/publication.png') }}">
                <span>Publications &#10060;</span>
            </a>
            <div id="Publications" class="collapse @if (request()->is('*new*')) show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="nav-link collapsed" href="{{ route('new') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/alert.png') }}">
                        <span style="{{ request()->is('*new*') ? 'color: #e5365a;' : '' }}">Alerts</span>
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support"
                aria-expanded="true" aria-controls="collapseTwo">
                <img src="{{ asset('assets/dashboard/img/menu-icon/support.png') }}">
                <span>Support &#10060; <!-- --> </span>
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
                            style="{{ request()->segment(3) == 'abbreviations' ? 'color: #e5365a;' : '' }}">Abbreviations</span>
                    </a>
                    <a href="{{ route('classification-laws') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/gavel.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'classification-laws' ? 'color: #e5365a;' : '' }}">Classification
                            Laws</span>
                    </a>
                    <a href="{{ route('laws') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/helptips.png') }}">
                        <span style="{{ request()->segment(3) == 'laws' ? 'color: #e5365a;' : '' }}">Local
                            Laws</span>
                    </a>
                    <a href="{{ route('post') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reviewtwo.png') }}">
                        <span style="{{ request()->segment(3) == 'post' ? 'color: #e5365a;' : '' }}">Post
                            Office</span>
                    </a>
                    <a href="{{ route('pricing') }}" class="collapse-item">
                        <img src="{{ asset('assets/app/img/dollar.png') }}">
                        <span style="{{ request()->segment(3) == 'pricing' ? 'color: #e5365a;' : '' }}">Pricing
                            Summaries</span>
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            {{-- <a class="nav-link" href="{{ route('admin.support-tickets') }}"> --}}
            <a class="nav-link" href="{{ route('admin.support-ticket.list') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                <span>Support Tickets </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.accounting-reports') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/book.png') }}">
                <span>Accounting Reports &#10060;</span>
            </a>
            <div id="accounting-reports" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style=""
                class="collapse">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/front-desk.png') }}">
                        <span>Concierge Services</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/revenue.png') }}">
                        <span>Revenue (Whole)</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/view.png') }}">
                        <span>Sales (Whole)</span></a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Analytics &#10060;</span>
            </a>
            <div id="Analytics" class="collapse @if (request()->segment(3) == 'publicpages' || request()->segment(3) == 'consoles') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('publicpages') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/advertiser.png') }}">
                        <span style="{{ request()->segment(3) == 'publicpages' ? 'color: #e5365a;' : '' }}">Public
                            Pages</span>
                    </a>
                    <a class="collapse-item" href="{{ route('consoles') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/console.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'consoles' ? 'color: #e5365a;' : '' }}">Consoles</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Billing"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Billing (Support Services)</span>
            </a>
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#logs"
                aria-expanded="false" aria-controls="Website">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                <span>logs &#10060;</span>
            </a>
            <div id="logs" class=" collapse  @if (request()->segment(3) == ' ') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reportings"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                <span>Reportings </span>
            </a>
            <div id="Reportings" class="collapse @if (request()->is('*reporting*') || request()->is('*advertiser-reports*')) show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="nav-link collapsed" href="{{ route('admin.reporting') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                        <span style="{{ request()->is('*reporting*') ? 'color: #e5365a;' : '' }}">Reporting</span>
                    </a>

                    <a class="nav-link collapsed" href="{{ route('admin.advertiser-reports') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/advertiser-reports.png') }}">
                        <span style="{{ request()->is('*advertiser-reports*') ? 'color: #e5365a;' : '' }}">Advertiser
                            Reports</span>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reports"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                <span>Reports </span>
            </a>
            <div id="Reports" class="collapse @if (request()->is('*reports*') || request()->is('**')) show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="nav-link collapsed" href="{{ route('admin.credit') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                        <span style="{{ request()->is('*reports*') ? 'color: #e5365a;' : '' }}">Credits</span>
                    </a>
                </div>
            </div>
        </li>



        {{-- 
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Website"
                aria-expanded="false" aria-controls="Website">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/e4ucms.png') }}">
                <span>Website &#10060;</span>
            </a>
            <div id="Website" class=" collapse  @if (request()->segment(3) == 'maintenance' || request()->segment(3) == 'global-notifications') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a href="{{ route('maintenance') }}" class="collapse-item">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/contact-setting.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'maintenance' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Maintenance</span>
                    </a>
                    <a class="collapse-item" href="{{ route('global-notifications') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'global-notifications' || request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Global
                            Notifications</span>
                    </a>
                </div>
            </div>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount"
                aria-expanded="false" aria-controls="collapseTwo">
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                        fill="#C2CFE0"></path>
                </svg>
                <span>My Account &#10060;</span>
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
                        <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">Edit
                            my account..</span></a>
                    {{-- <a class="collapse-item" href="{{ route('center.profile.information')}}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{request()->segment(2) == 'profile-informations' ? 'color: #e5365a;' : ''}}">Profile information</span></a> --}}
                    <a class="collapse-item" href="{{ route('admin.change.password') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'change-password' ? 'color: #e5365a;' : '' }}">Change
                            password</span></a>
                    <a class="collapse-item" href="{{ route('admin.profile.avatar') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload
                            my avatar</span></a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management"
                aria-expanded="false" aria-controls="collapseTwo">
                <svg fill="#ffffffcc" height="16px" width="17px" version="1.1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 490 490" xml:space="preserve">

                    <g id="SVGRepo_bgCarrier" stroke-width="0" />

                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <g>
                                    <path
                                        d="M418.246,71.754C371.975,25.482,310.448,0,245,0S118.025,25.482,71.754,71.754C25.483,118.025,0,179.552,0,245 s25.483,126.975,71.754,173.246C118.025,464.518,179.552,490,245,490s126.974-25.483,173.246-71.754 C464.518,371.975,490,310.448,490,245S464.517,118.026,418.246,71.754z M404.104,404.104C361.61,446.598,305.105,470,245,470 c-60.106,0-116.61-23.402-159.104-65.896C43.402,361.61,20,305.105,20,245S43.402,128.39,85.896,85.896S184.894,20,245,20 c60.105,0,116.61,23.402,159.104,65.896S470,184.895,470,245C470,305.105,446.598,361.61,404.104,404.104z" />
                                    <path
                                        d="M245,40c-28.989,0-57.003,5.922-83.264,17.601c-25.381,11.288-47.876,27.367-66.855,47.785 C59.491,143.397,40,192.98,40,245c0,53.442,20.427,103.964,57.493,142.232c18.884,19.63,41.084,35.069,65.984,45.889 C189.253,444.321,216.681,450,245,450c54.775,0,106.261-21.318,144.972-60.028C428.682,351.261,450,299.775,450,245 C450,131.963,358.037,40,245,40z M382.708,368.566l-35.637-35.637l-14.143,14.143l35.637,35.637 c-31.516,28.345-71.212,44.781-113.565,47.02V380h-20v49.732c-43.625-2.296-84.226-19.591-116.109-49.477l33.181-33.185 l-14.143-14.141l-32.91,32.914C78.094,334.836,62.46,296.112,60.274,255H110v-20H60.277 c2.128-39.815,16.932-77.588,42.393-108.187l35.258,35.258l14.143-14.143l-35.807-35.807 c15.641-15.194,33.63-27.367,53.599-36.247c20.655-9.186,42.522-14.421,65.136-15.61V110h20V60.273 c44.742,2.395,85.306,20.766,116.094,49.491l-38.165,38.165l14.143,14.143l37.904-37.904 c26.002,30.081,42.491,68.598,44.752,110.833H380v20h49.729C427.49,297.354,411.054,337.05,382.708,368.566z" />
                                    <path
                                        d="M345,214.999h-25.824c-0.166-0.414-0.334-0.824-0.505-1.231l18.298-18.297c1.875-1.875,2.929-4.419,2.929-7.071 c0-2.652-1.054-5.195-2.929-7.071l-28.301-28.301c-1.876-1.875-4.419-2.929-7.071-2.929c-2.652,0-5.196,1.054-7.071,2.929 l-18.297,18.298c-0.407-0.171-0.817-0.339-1.231-0.505V145c0-5.522-4.478-10-10-10h-40c-5.523,0-10,4.478-10,10v25.821 c-0.413,0.165-0.824,0.334-1.231,0.505l-18.297-18.298c-1.875-1.875-4.419-2.929-7.071-2.929c-2.652,0-5.196,1.054-7.071,2.929 l-28.3,28.301c-3.905,3.906-3.905,10.238,0,14.143l18.298,18.297c-0.171,0.408-0.339,0.818-0.505,1.231H145 c-5.523,0-10,4.478-10,10v40c0,5.522,4.477,10,10,10h25.823c0.165,0.413,0.334,0.823,0.505,1.231l-18.298,18.297 c-1.878,1.878-2.931,4.425-2.929,7.08c0.002,2.655,1.06,5.2,2.941,7.075l28.3,28.2c3.9,3.887,10.211,3.888,14.114,0.002 l18.314-18.234c0.41,0.175,0.821,0.346,1.23,0.513V345c0,5.522,4.477,10,10,10h40c5.522,0,10-4.478,10.001-10v-25.823 c0.414-0.166,0.824-0.334,1.231-0.505l18.297,18.298c1.876,1.875,4.419,2.929,7.071,2.929c0.003,0,0.006,0,0.009,0 c2.655-0.002,5.2-1.06,7.075-2.941l28.2-28.301c3.887-3.901,3.889-10.212,0.002-14.114l-18.219-18.298 c0.174-0.412,0.344-0.827,0.512-1.246H345c5.522,0,10-4.478,10-10v-40C355,219.477,350.522,214.999,345,214.999z M335,255.002 h-22.901c-4.401,0-8.286,2.878-9.567,7.089c-1.28,4.209-2.862,8.047-4.703,11.406c-2.13,3.889-1.445,8.717,1.685,11.86 l16.172,16.241l-14.099,14.148l-16.216-16.217c-3.142-3.141-7.979-3.833-11.876-1.699c-3.359,1.841-7.197,3.423-11.406,4.703 c-4.211,1.281-7.089,5.166-7.089,9.567V335h-19.999v-22.9c0-4.424-2.906-8.322-7.146-9.584 c-3.742-1.114-7.508-2.675-11.513-4.774c-3.867-2.027-8.603-1.309-11.696,1.772l-16.242,16.172l-14.148-14.099l16.216-16.216 c3.14-3.142,3.833-7.978,1.7-11.874c-1.842-3.362-3.424-7.2-4.705-11.409c-1.282-4.21-5.166-7.088-9.567-7.088H155v-20h22.899 c4.401,0,8.285-2.878,9.567-7.088c1.281-4.209,2.864-8.047,4.705-11.409c2.133-3.896,1.441-8.732-1.7-11.874L174.242,188.4 l14.158-14.158l16.229,16.229c3.142,3.141,7.98,3.833,11.876,1.699c3.359-1.841,7.197-3.423,11.406-4.703 c4.211-1.281,7.089-5.166,7.089-9.567V155h20v22.9c0,4.401,2.878,8.286,7.089,9.567c4.209,1.28,8.047,2.862,11.406,4.703 c3.897,2.134,8.734,1.443,11.876-1.699l16.229-16.229l14.158,14.16l-16.229,16.229c-3.141,3.142-3.834,7.98-1.699,11.876 c1.841,3.359,3.423,7.197,4.703,11.406c1.281,4.211,5.166,7.089,9.567,7.089H335V255.002z" />
                                    <path
                                        d="M245,210c-19.299,0-35,15.701-35,35s15.701,35,35,35s35-15.701,35-35S264.299,210,245,210z M245,260 c-8.271,0-15-6.729-15-15s6.729-15,15-15s15,6.729,15,15S253.271,260,245,260z" />
                                </g>
                            </g>
                        </g>
                    </g>

                </svg>
                <span>Management &#10060;</span>

            </a>

            <div id="Management"
                class="collapse @if (request()->segment(3) == 'email-management' ||
                        request()->segment(3) == 'logs-staff' ||
                        request()->segment(3) == 'marketing-templates-e4u' ||
                        request()->segment(3) == 'marketing-templates-agents' ||
                        request()->segment(3) == 'post-office' ||
                        request()->segment(2) == 'All-user' ||
                        request()->segment(3) == 'set-fees' ||
                        request()->segment(3) == 'manage-user' ||
                        request()->segment(3) == 'memberships' ||
                        request()->segment(3) == 'legbox-report' ||
                        request()->segment(3) == 'punterbox-reports' ||
                        request()->segment(3) == 'tours' ||
                        request()->segment(3) == 'manage-staff') ||
                    request()->segment(3) == 'competitor-database') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">

                    {{-- statistics --}}
                    <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                        data-target="#statisticsMenu" aria-expanded="false" aria-controls="statisticsMenu">
                        <img width="16" height="17"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span>Statistics</span>

                    </a>

                    <div id="statisticsMenu" class="collapse pl-3" style="margin-left: 10px;">
                        <a class="collapse-item" href="{{ route('admin.tours') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'tours' ? 'color: #e5365a;' : '' }}">Tours</span>
                        </a>
                        <a class="collapse-item" href="{{ route('admin.profile') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'profile' ? 'color: #e5365a;' : '' }}">Profile</span>
                        </a>
                    </div>


                    {{-- <a class="collapse-item" href="#">
                <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png')}}">
                <span>Dashboard</span></a> --}}
                    {{-- <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png')}}">
                <span>Dashboard - Search</span></a> --}}

                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span>CMS</span></a>
                    <a class="collapse-item" href="{{ route('admin.email-management') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'email-management' ? 'color: #e5365a;' : '' }}">Email
                            Management</span>
                    </a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span>Email Templates</span></a>
                    <a class="collapse-item" href="{{ route('admin.logs-staff') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span style="{{ request()->segment(3) == 'logs-staff' ? 'color: #e5365a;' : '' }}">Logs -
                            Staff</span></a>
                    <a class="collapse-item" href="{{ route('admin.marketing-templates-e4u') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'marketing-templates-e4u' ? 'color: #e5365a;' : '' }}">Marketing
                            Templates - E4U</span></a>
                    <a class="collapse-item" href="{{ route('admin.marketing-templates-agents') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'marketing-templates-agents' ? 'color: #e5365a;' : '' }}">Marketing
                            Templates - Agents</span></a>
                    <a class="collapse-item" href="{{ route('admin.post-office') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span style="{{ request()->segment(3) == 'post-office' ? 'color: #e5365a;' : '' }}">Post
                            Office</span></a>
                    <a class="collapse-item" href="{{ route('admin.management.allUser') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span style="{{ request()->segment(2) == 'All-user' ? 'color: #e5365a;' : '' }}">Set
                            Security & Access Levels</span>

                    </a>
                    <a class="collapse-item" href="{{ route('admin.set-fees') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span style="{{ request()->segment(3) == 'set-fees' ? 'color: #e5365a;' : '' }}">Set Fees &
                            Variables - Users</span>
                    </a>
                    {{-- <a class="collapse-item" href="{{ route('admin.manage-user') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span style="{{ request()->segment(3) == 'manage-user' ? 'color: #e5365a;' : '' }}">Manage Staff</span></a>
 --}}

                    {{-- Manage People --}}
                    <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                        data-target="#managePeopleMenu" aria-expanded="false" aria-controls="managePeopleMenu">
                        <img width="16" height="17"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span>Manage People</span>

                    </a>

                    <div id="managePeopleMenu" class="collapse pl-3" style="margin-left: 10px;">
                        <a class="collapse-item" href="{{ route('admin.staff') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'tours' ? 'color: #e5365a;' : '' }}">Staff</span>
                        </a>
                        <a class="collapse-item" href="{{ route('admin.agent') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'agent' ? 'color: #e5365a;' : '' }}">Agent</span>
                        </a>
                    </div>


                    <a class="collapse-item" href="{{ route('admin.memberships') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'memberships' ? 'color: #e5365a;' : '' }}">Memberships</span></a>



                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span>Agent Registrations</span></a>
                    <a class="collapse-item" href="{{ route('admin.competitor-database') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'competitor-database' ? 'color: #e5365a;' : '' }}">Competitor
                            Database</span></a>
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span>Website Management &#10060;</span></a>


                </div>
            </div>
        </li>
    @endif
</ul>
<!-- End of Sidebar -->
