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
                    &#10060;</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.global-monitoring') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/globe.png') }}">
                <span>Global Monitoring &#10060;</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.accounting-reports') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/book.png') }}">
                <span>Accounting Reports &#10060;</span>
            </a>
            {{-- <div id="accounting-reports" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="" class="collapse">
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
        </div> --}}
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('new') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/alert.png') }}">
                <span>Alerts &#10060;</span>
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
                <span>Billing (Support Services) </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                <span>Concierge Services &#10060;</span>
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
                <span>logs &#10060;</span>
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
                <span>Support &#10060;</span>
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
                <span>Support Tickets &#10060;</span>
            </a>
        </li>
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

        <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.global-monitoring') }}">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/globe.png') }}">
        <span>Global Monitoring</span>
        </a>
         <div id="global-monitoring" class="collapse @if (request()->segment(3) == 'advertisers') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('admin.contact-database.advertisers') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/advertise.png') }}">
                <span style="{{ request()->segment(3) == 'advertisers' ? 'color: #e5365a;' : '' }}">Advertisers</span>
                </a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/pachive.png') }}">
                <span>Staff</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/view.png') }}">
                <span>Viewers</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                <span>Agent</span></a>
                <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/login.png') }}">
                <span>Attempts</span></a>
            </div>
        </div> -->
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Monitoring"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Global Monitoring &#10060;</span>
            </a>
            <div id="Monitoring" class="collapse @if (request()->is('*global-monitoring*') ||
                    request()->is('*logged-in-users*') ||
                    request()->is('*escort-listings*') ||
                    request()->is('*massage-centre-listings*') ||
                    request()->is('*visitors*')) show @endif"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('admin.global-monitoring') }}">

                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/globe.png') }}">
                        <span style="{{ request()->is('*global-monitoring*') ? 'color: #e5365a;' : '' }}">Global
                            Monitoring</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.logged-in-users') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/login-user.png') }}">
                        <span style="{{ request()->is('*logged-in-users*') ? 'color: #e5365a;' : '' }}">Logged in
                            Users</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.escort-listings') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}">
                        <span style="{{ request()->is('*escort-listings*') ? 'color: #e5365a;' : '' }}">Escort
                            Listings</span>
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
                </div>
            </div>
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
        {{--<li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('new') }}">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/alert.png') }}">
        <span>Alerts</span>
        </a>
         <div id="collapsenew" class=" collapse @if (request()->segment(3) == 'new') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
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
        </div>
    </li> --}}
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
            <a class="nav-link collapsed" href="{{ route('email-service-request') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                <span>Concierge Services &#10060;</span>
            </a>
            <!--  <div id="Concierge" class="collapse @if (request()->segment(3) == 'email-service-request' ||
                    request()->segment(3) == 'mobile-sim-request' ||
                    request()->segment(3) == 'product-request' ||
                    request()->segment(3) == 'visa-migration-request') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('email-service-request') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                <span style="{{ request()->segment(3) == 'email-service-request' ? 'color: #e5365a;' : '' }}">Email Service Request</span>
                </a>
                <a class="collapse-item" href="{{ route('mobile-sim-request') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                <span style="{{ request()->segment(3) == 'mobile-sim-request' ? 'color: #e5365a;' : '' }}">Mobile SIM Request</span>
                </a>
                <a class="collapse-item" href="{{ route('product-request') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                <span style="{{ request()->segment(3) == 'product-request' ? 'color: #e5365a;' : '' }}">Product Request</span>
                </a>
                <a class="collapse-item" href="{{ route('visa-migration-request') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                <span style="{{ request()->segment(3) == 'visa-migration-request' ? 'color: #e5365a;' : '' }}">Visa Migration Request</span>
                </a>
            </div>
        </div> -->
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
            <a class="nav-link" href="{{ route('admin.database') }}">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/database.png') }}">
                <span>Database &#10060;</span>
            </a>
        {{-- database
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
        --}}
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reportings"
                aria-expanded="false" aria-controls="collapseTwo">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                    src="{{ asset('assets/dashboard/img/menu-icon/online.png') }}">
                <span>Reportings &#10060;</span>
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
        {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reporting')}}">
        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/online.png')}}">
        <span>Reportings</span>
        </a>
         database
        <div id="Reporting" class="collapse @if (request()->segment(3) == 'email-request' || request()->segment(3) == 'mobile-request' || request()->segment(3) == 'admin-product-request' || request()->segment(3) == 'punterbox-report') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
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
    </li> --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support"
                aria-expanded="true" aria-controls="collapseTwo">
                <img src="{{ asset('assets/dashboard/img/menu-icon/support.png') }}">
                <span>Support &#10060;</span>
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
            <a class="nav-link" href="{{ route('admin.support-tickets') }}">
                <a class="nav-link" href="{{ route('admin.support-ticket.list') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                    <span>Support Tickets &#10060;</span>
                </a>
        </li>
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
                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                        fill="#C2CFE0"></path>
                </svg>
                <span>Management  &#10060;</span>
            </a>

            <div id="Management" class="collapse @if (request()->segment(3) == 'email-management' ||
                    request()->segment(3) == 'logs-staff' ||
                    request()->segment(3) == 'marketing-templates-e4u' ||
                    request()->segment(3) == 'marketing-templates-agents' ||
                    request()->segment(3) == 'post-office' ||
                    request()->segment(2) == 'All-user' ||
                    request()->segment(3) == 'set-fees' ||
                    request()->segment(3) == 'manage-user' ||
                    request()->segment(3) == 'legbox-report' ||
                    request()->segment(3) == 'punterbox-reports' ||
                    request()->segment(3) == 'manage-staff') ||
                    request()->segment(3) == 'competitor-database') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
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
                    <a class="collapse-item" href="{{ route('admin.manage-user') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span style="{{ request()->segment(3) == 'manage-user' ? 'color: #e5365a;' : '' }}">Manage Staff</span></a>
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
                        <span>Website Management</span></a>
                </div>
            </div>
        </li>
    @endif
</ul>
<!-- End of Sidebar -->
