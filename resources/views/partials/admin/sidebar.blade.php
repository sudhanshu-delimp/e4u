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

    @if (auth()->user() && auth()->user()->type == 1)
        <a class="sidebar-brand text-left" href="{{ route('home') }}">
            <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3 e4u_logo" alt=""><br>
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
                <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
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
                        <img src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}">
                        <span style="{{ request()->is('*escort-listings*') ? 'color: #FF3C5F;' : '' }}">Escort
                            Listings</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.massage-centre-listings', ['from' => 'sidebar']) }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png') }}">
                        <span style="{{ request()->is('*massage-centre-listings*') ? 'color: #FF3C5F;' : '' }}">Massage
                            Centre Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.pin-up-listings', ['from' => 'sidebar']) }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*pinup-listings*') ? 'color: #FF3C5F;' : '' }}">Pin Up
                            Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.logged-in-users', ['from' => 'sidebar']) }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/login-user.png') }}">
                        <span style="{{ request()->is('*logged-in-users*') ? 'color: #FF3C5F;' : '' }}">Users Logged
                            In</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.visitors') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*visitors*') ? 'color: #FF3C5F;' : '' }}">Visitors</span>
                    </a>
                </div>
            </div>
        </li>


        <li
            style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px;margin-top: 10px;margin-bottom: 15px;">
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration"
                aria-expanded="false" aria-controls="Administration">
                <img src="{{ asset('assets/dashboard/img/menu-icon/administration.png') }}">
                <span>Administration</span>
            </a>

            <div id="Administration" class="collapse @if (in_array(request()->segment(3), [
                    'publicpages',
                    'consoles',
                    'email-service-request',
                    'mobile-sim-request',
                    'product-request',
                    'visa-migration-request',
                    'manage-email',
                    'manage-sim',
                    'global',
                    'agents',
                    'viewer',
                    'escort','shareholders',
                    'centres',
                    'agents-guidelines',
                    'viewers-guidelines',
                    'escorts-guidelines',
                    'massage-centres-guidelines',
                    'operator-guidelines',
                    'shareholders-guidelines',
                    'reports',
                    'send-reports',
                    'alerts',
                    'blog',
                    'credit',
                    'agent-requests',
                    'num','punterbox','communications',
                    'transaction-summary',
                    'advertiser-suspensions',
                    'registrations-reports',
                    'advertiser-reports',
                    'advertiser-reviews',                    
                ]) || in_array(request()->segment(2), ['support_tickets'])) show @endif"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">

                <div class="py-0 collapse-inner rounded mb-2">

                    {{-- Analytics --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#Analytics" aria-expanded="false" aria-controls="Analytics">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                        <span>Analytics</span>
                    </a>

                    <div id="Analytics" class="collapse 
                        @if (request()->segment(3) == 'publicpages' || request()->segment(3) == 'consoles') show @endif;" data-parent="#Administration">
                        
                        <div class="py-0 collapse-inner rounded mb-2">

                            <a class="collapse-item" href="{{ route('consoles') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/console.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'consoles' ? 'color: #FF3C5F;' : '' }}">Consoles</span>
                            </a>
                            <a class="collapse-item" href="{{ route('publicpages') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/advertiser.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'publicpages' ? 'color: #FF3C5F;' : '' }}">Public
                                    Pages</span>
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
                        data-parent="#Administration">
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
                        aria-expanded="false" aria-controls="Database">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/admin-database.png') }}">
                        <span>Database</span>
                    </a>
                    <div id="Database" class="collapse @if (request()->segment(3) == 'manage-email' || request()->segment(3) == 'manage-sim') show @endif;"
                        data-parent="#Administration">
                        <div class="py-0 collapse-inner rounded mb-2">
                            <a class="collapse-item" href="{{ route('manage-email') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'manage-email' ? 'color: #FF3C5F;' : '' }}">Manage
                                    Emails</span>
                            </a>

                            <a class="collapse-item" href="{{ route('manage-sim') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/add-sim-list.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'manage-sim' ? 'color: #FF3C5F;' : '' }}">Manage
                                    SIMs</span>
                            </a>
                        </div>
                    </div>
                    {{-- Database --}}

                    {{-- Guidelines --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Guidelines"
                        aria-expanded="false" aria-controls="Guidelines">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/guideline.png') }}">
                        <span>Guidelines</span>
                    </a>
                    <div id="Guidelines" class="collapse @if (request()->segment(3) == 'agents-guidelines' || request()->segment(3) == 'escorts-guidelines' || request()->segment(3) == 'massage-centres-guidelines' || request()->segment(3) == 'operator-guidelines' || request()->segment(3) == 'shareholders-guidelines' || request()->segment(3) == 'viewers-guidelines') show @endif;"
                        data-parent="#Administration">
                        <div class="py-0 collapse-inner rounded mb-2">
                            <a class="collapse-item" href="{{ route('admin.agents-guidelines') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'agents-guidelines' ? 'color: #FF3C5F;' : '' }}">Agents</span>
                            </a>

                             <a class="collapse-item" href="{{ route('admin.escorts-guidelines') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'escorts-guidelines' ? 'color: #FF3C5F;' : '' }}">Escorts</span>
                            </a>

                             <a class="collapse-item" href="{{ route('admin.massage-centres-guidelines') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'massage-centres-guidelines' ? 'color: #FF3C5F;' : '' }}">Massage Centres</span>
                            </a>

                             <a class="collapse-item" href="{{ route('admin.operator-guidelines') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'operator-guidelines' ? 'color: #FF3C5F;' : '' }}">Operator</span>
                            </a>

                             <a class="collapse-item" href="{{ route('admin.shareholders-guidelines') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'shareholders-guidelines' ? 'color: #FF3C5F;' : '' }}">Shareholders</span>
                            </a>

                             <a class="collapse-item" href="{{ route('admin.viewers-guidelines') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'viewers-guidelines' ? 'color: #FF3C5F;' : '' }}">Viewers</span>
                            </a>
                        </div>
                    </div>
                    {{-- Guidelines --}}


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
                            request()->segment(3) == 'escort' ||
                             request()->segment(3) == 'shareholders' ||
                            request()->segment(3) == 'centres') show @endif;" data-parent="#Administration">

                        <div class="py-0 collapse-inner rounded mb-2">
                            {{-- global --}}
                            <a href="{{ route('admin.global.notification.index') }}" class="collapse-item">
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
                            {{-- centres --}}
                            <a href="{{ route('admin.centres.notifications.index') }}" class="collapse-item">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/c-notification.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'centres' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Centres</span>
                            </a>

                            {{-- escorts --}}

                            

                            <a href="{{ route('admin.escort.notifications.index') }}" class="collapse-item">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/e-notification.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'escort' || request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Escorts</span>
                            </a>

                            {{-- Shareholders --}}
                            <a href="{{ route('admin.shareholders') }}" class="collapse-item">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/profit.png') }}">
                                <span style="{{ request()->segment(3) == 'shareholders' ? 'color: #FF3C5F;' : '' }}">Shareholders</span>
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
                    <div id="PostOffice" class=" collapse  @if (request()->segment(3) == 'reports' || request()->segment(3) == 'send-reports') show @endif;" data-parent="#Administration">
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
                        aria-expanded="false" aria-controls="Publications">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/publication.png') }}">
                        <span>Publications</span>
                    </a>
                    <div id="Publications" class="collapse @if (request()->segment(3) == 'alerts' || request()->segment(3) == 'blog') show @endif;" data-parent="#Administration">
                        <div class="py-0 collapse-inner rounded mb-2">
                            <a class="nav-link collapsed" href="{{ route('admin.alerts') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/alert.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'alerts' ? 'color: #FF3C5F;' : '' }}">Alerts</span>
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
                                <span
                                    style="{{ request()->segment(3) == 'blog' ? 'color: #FF3C5F;' : '' }}">Blog</span>
                            </a>
                        </div>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reports"
                        aria-expanded="false" aria-controls="Reports">
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
                            request()->is('*punterbox*') ||
                            request()->is('*communications*') ||
                            request()->is('*advertiser-reviews*')) show @endif;" data-parent="#Administration">
                        <div class="py-0 collapse-inner rounded mb-2">


                            <a class="nav-link collapsed" href="{{ route('admin.advertiser-reports') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/advertiser-reports.png') }}">
                                <span
                                    style="{{ request()->is('*advertiser-reports*') ? 'color: #FF3C5F;' : '' }}">Advertiser
                                    Reports</span>
                            </a>
                            <a class="nav-link collapsed" href="{{ route('admin.advertiser-reviews') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/add-reviews.png') }}">
                                <span
                                    style="{{ request()->is('*advertiser-reviews*') ? 'color: #FF3C5F;' : '' }}">Advertiser
                                    Reviews</span>
                            </a>
                            <a class="nav-link collapsed"
                                href="{{ route('admin.agent-requests', ['from' => 'sidebar']) }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/agent-request.png') }}">
                                <span style="{{ request()->is('*agent-requests*') ? 'color: #FF3C5F;' : '' }}">Agent
                                    Requests</span>
                            </a>
                           
                            <a class="nav-link collapsed" href="{{ route('admin.communications') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/communication.png') }}">
                                <span style="{{ request()->is('*communications*') ? 'color: #FF3C5F;' : '' }}">communications</span>
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
                             <a class="nav-link collapsed" href="{{ route('admin.punterbox') }}">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/punterbox.png') }}">
                                <span style="{{ request()->is('*punterbox*') ? 'color: #FF3C5F;' : '' }}">Punterbox</span>
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
                                    style="{{ request()->is('*transaction-summary*') ? 'color: #FF3C5F;' : '' }}">Transactions</span>
                            </a>
                        </div>
                    </div>

                    <a class="nav-link collapsed {{ request()->routeIs('admin.support-ticket.list', ['from' => 'sidebar']) ? 'menu-active' : '' }}" href="{{ route('admin.support-ticket.list') }}">
                        
                        <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                        <span>Support Tickets </span>
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
                        'escorts-templates','centres-templates',
                        'e4u-templates',
                        'agent-templates',
                        'operator-templates',
                        'shareholder-templates',
                        'viewer-templates',
                        'set-fees',
                        'manage-user',
                        'memberships','product',
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
                        'annual-report','directors','portfolio','registrations','e4u-revenue',
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
                        'credits',
                        'revenue','influencer',
                        'application',
                        'revision',
                        'security','shareholder','share-value'
                    ]) || in_array(request()->segment(4), ['legal','community','other','about','concierge','global-notifications','agents-notifications','escorts-notifications','centres-notifications','shareholders-notifications','viewers-notifications'])) show @endif"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#manageAgentMenu" aria-expanded="false" aria-controls="manageAgentMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                            <span>Agents </span>
                        </a>
                        <div id="manageAgentMenu"
                            class="collapse @if (in_array(request()->segment(3), ['agent', 'agents-monthly-report'])) show @endif" data-parent="#Management">

                            <a class="collapse-item" href="{{ route('admin.agent') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/manage-agents.png') }}">
                                <span style="{{ request()->segment(3) == 'agent' ? 'color: #FF3C5F;' : '' }}">Manage
                                    Agents</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.agents-monthly-report') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'agents-monthly-report' ? 'color: #FF3C5F;' : '' }}">Monthly
                                    Report</span>
                            </a>

                        </div>

                       <!-- CMS Templates -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#CMSMenu" aria-expanded="false">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/cms.png') }}">
                            <span>CMS Templates</span>
                        </a>

                        <div id="CMSMenu"
                           class="collapse @if (in_array(request()->segment(3), [
                                'escorts-templates',
                                'e4u-templates',
                                'agent-templates',
                                'operator-templates',
                                'shareholder-templates',
                                'viewer-templates','centres-templates'
                            ]) || in_array(request()->segment(4), ['legal','community','other','about','concierge',
                             'global-notifications','agents-notifications','escorts-notifications','centres-notifications','shareholders-notifications','viewers-notifications'
                            ])) show @endif"
                            data-parent="#Management">

                           
                            <!-- Footer -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Footer"
                                aria-expanded="false" aria-controls="Footer">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/footer.png') }}">
                                <span>Footer</span>
                            </a>
                            <div id="Footer" class="collapse @if (in_array(request()->segment(4), ['other','legal','community'])) show @endif" data-parent="#CMSMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
                                    {{-- Community --}}

                                    <a href="" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'community' ? 'color: #FF3C5F;' : '' }}">Community</span>
                                    </a>
                                    {{-- Legal --}}
                                    <a href="" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/legal.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'legal' ? 'color: #FF3C5F;' : '' }}">Legal</span>
                                    </a>
                                    
                                    {{-- Other --}}

                                    <a href="" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/others.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'other' ? 'color: #FF3C5F;' : '' }}">Other</span>
                                    </a>


                                </div>
                            </div>
                            <!-- end -->  

                            <!-- Header -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Header"
                                aria-expanded="false" aria-controls="Header">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/header.png') }}">
                                <span>Header</span>
                            </a>
                            <div id="Header" class="collapse @if (in_array(request()->segment(4), ['about','concierge'])) show @endif" data-parent="#CMSMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
                                    {{-- Legal --}}
                                    <a href="" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/information.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'about' ? 'color: #FF3C5F;' : '' }}">About</span>
                                    </a>
                                    {{-- Community --}}

                                    <a href="" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'concierge' ? 'color: #FF3C5F;' : '' }}">Concierge</span>
                                    </a>
                                    

                                </div>
                            </div>
                            <!-- end -->  


                            
                            <!-- Notification -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#OMnotification"
                                aria-expanded="false" aria-controls="OMnotification">
                                <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                    src="{{ asset('assets/dashboard/img/menu-icon/global-notification.png') }}">
                                <span>Notifications<!----></span>
                            </a>
                            <div id="OMnotification" class="collapse @if (in_array(request()->segment(4), ['global-notifications','agents-notifications','escorts-notifications','centres-notifications','shareholders-notifications','viewers-notifications'])) show @endif" data-parent="#CMSMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
                                    {{-- global --}}
                                    <a href="{{ route('admin.global-notifications') }}" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/g-notification.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'global-notifications' ? 'color: #FF3C5F;' : '' }}">Global</span>
                                    </a>
                                    {{-- agents --}}

                                    <a href="{{ route('admin.agents-notifications') }}" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/agent.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'agents-notifications' ? 'color: #FF3C5F;' : '' }}">Agents</span>
                                    </a>

                                    {{-- escorts --}}

                                    <a href="{{ route('admin.escorts-notifications') }}" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/e-notification.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'escorts-notifications' ? 'color: #FF3C5F;' : '' }}">Escorts</span>
                                    </a>

                                    {{-- centres --}}

                                    <a href="{{ route('admin.centres-notifications') }}" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/c-notification.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'centres-notifications' ? 'color: #FF3C5F;' : '' }}">Massage Centres</span>
                                    </a>

                                    {{-- Shareholders --}}
                                    
                                    <a href="{{ route('admin.shareholders-notifications') }}" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/profit.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'shareholders-notifications' ? 'color: #FF3C5F;' : '' }}">Shareholders</span>
                                    </a>

                                    {{-- viewers --}}
                                    <a href="{{ route('admin.viewers-notifications') }}" class="collapse-item">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/v-notification.png') }}">
                                        <span
                                            style="{{ request()->segment(4) == 'viewers-notifications' ? 'color: #FF3C5F;' : '' }}">Viewers</span>
                                    </a>

                                    


                                </div>
                            </div>
                            <!-- end -->    

                             <!-- Email -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                                data-target="#CMSEmailMenu" aria-expanded="false">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/email-manage.png') }}">
                                    <span>System Email</span>
                                </a>

                            <div id="CMSEmailMenu"
                                class="collapse @if (in_array(request()->segment(3), [
                                    'escorts-templates',
                                    'e4u-templates',
                                    'agent-templates',
                                    'operator-templates',
                                    'shareholder-templates',
                                    'viewer-templates','centres-templates'
                                ])) show @endif"
                                    data-parent="#CMSMenu">
                                

                                <a class="collapse-item" href="{{ route('admin.e4u-templates') }}">
                                    <img width="16" height="17"
                                        src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'e4u-templates' ? 'color: #FF3C5F;' : '' }}">E4U</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.agent-templates') }}">
                                    <img width="16" height="17"
                                        src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'agent-templates' ? 'color: #FF3C5F;' : '' }}">Agents</span>
                                </a>
                                
                                <a class="collapse-item" href="{{ route('admin.escorts-templates') }}">
                                    <img width="16" height="17"
                                        src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'escorts-templates' ? 'color: #FF3C5F;' : '' }}">Escorts</span>
                                </a>
                                
                                <a class="collapse-item" href="{{ route('admin.centres-templates') }}">
                                    <img width="16" height="17"
                                        src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'centres-templates' ? 'color: #FF3C5F;' : '' }}">Centres</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.operator-templates') }}">
                                    <img width="16" height="17"
                                        src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'operator-templates' ? 'color: #FF3C5F;' : '' }}">Operator</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.shareholder-templates') }}">
                                    <img width="16" height="17"
                                        src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'shareholder-templates' ? 'color: #FF3C5F;' : '' }}">Shareholders</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.viewer-templates') }}">
                                    <img width="16" height="17"
                                        src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'viewer-templates' ? 'color: #FF3C5F;' : '' }}">Viewers</span>
                                </a>

                            </div>


                        </div>
                        {{-- end --}}
                        
                        <!-- Concierge -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#ConciergeMenu" aria-expanded="false" aria-controls="ConciergeMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                            <span>Concierge</span>
                        </a>
                        <div id="ConciergeMenu" class="collapse @if (in_array(request()->segment(3), ['email-management', 'sim-management'])) show @endif"
                            data-parent="#Management">
                            <a class="collapse-item" href="{{ route('admin.email-management') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'email-management' ? 'color: #FF3C5F;' : '' }}">Email
                                    Management</span>
                            </a>

                            <a class="collapse-item" href="{{ route('sim-management') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'sim-management' ? 'color: #FF3C5F;' : '' }}">SIM
                                    Management</span>
                            </a>
                        </div>
                        {{-- end --}}

                        {{-- logs --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#logs" aria-expanded="false" aria-controls="Website">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                            <span>logs </span>
                        </a>
                        <div id="logs" class="collapse @if (in_array(request()->segment(3), ['application', 'revision', 'security'])) show @endif" data-parent="#Management">
                            <div class="py-0 collapse-inner rounded mb-2">
                                <a class="collapse-item" href="{{ route('admin.application') }}">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'application' ? 'color: #FF3C5F;' : '' }}">Application</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.revision') }}">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'revision' ? 'color: #FF3C5F;' : '' }}">Revision</span>
                                </a>

                                <a class="collapse-item" href="{{ route('admin.security') }}">
                                    <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                    <span
                                        style="{{ request()->segment(3) == 'security' ? 'color: #FF3C5F;' : '' }}">Security</span>
                                </a>
                            </div>
                        </div>
                        {{-- end --}}
                        <!-- Manage People -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#managePeopleMenu" aria-expanded="false" aria-controls="managePeopleMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                            <span>Manage People</span>
                        </a>
                        <div id="managePeopleMenu"
                            class="collapse @if (in_array(request()->segment(3), ['staff', 'manage-suppliers'])) show @endif"
                            data-parent="#Management">
                            <a class="collapse-item" href="{{ route('admin.staff') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span style="{{ request()->segment(3) == 'staff' ? 'color: #FF3C5F;' : '' }}">
                                    Staff</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.manage-suppliers') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'manage-suppliers' ? 'color: #FF3C5F;' : '' }}">
                                    Suppliers</span>
                            </a>
                        </div>

                        
                    

                        <!-- Operator -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#operatorMenu" aria-expanded="false" aria-controls="operatorMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/operator.png') }}">
                            <span>Operator</span>
                        </a>
                        <div id="operatorMenu" class="collapse @if (in_array(request()->segment(3), ['monthly-fee-reports', 'commission-summary', 'operator-manage'])) show @endif"  data-parent="#Management">
                            <a class="collapse-item" href="{{ route('admin.monthly-fee-reports') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'monthly-fee-reports' ? 'color: #FF3C5F;' : '' }}">Monthly
                                    Fee Reports</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.commission-summary') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'commission-summary' ? 'color: #FF3C5F;' : '' }}">Fees
                                    Summary</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.operator-manage') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'operator-manage' ? 'color: #FF3C5F;' : '' }}">Manage
                                    Operator</span>
                            </a>
                        </div>


                        <!-- Reporting -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#ReportingMenu" aria-expanded="false" aria-controls="ReportingMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                            <span>Reporting</span>
                        </a>
                        <div id="ReportingMenu" class="collapse @if (in_array(request()->segment(3), ['credits', 'revenue'])) show @endif"
                            data-parent="#Management">


                            <a class="collapse-item" href="{{ route('admin.revenue') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/revenue-2.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'revenue' ? 'color: #FF3C5F;' : '' }}">Revenue</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.credits') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/income.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'credits' ? 'color: #FF3C5F;' : '' }}">Credits</span>
                            </a>

                        </div>
                        <!-- Reports -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#ReportsMenu" aria-expanded="false" aria-controls="ReportsMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                            <span>Reports</span>
                        </a>
                        <div id="ReportsMenu" class="collapse @if (in_array(request()->segment(3), ['influencer'])) show @endif"
                            data-parent="#Management">


                            <a class="collapse-item" href="{{ route('admin.influencer') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/influencer.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'influencer' ? 'color: #FF3C5F;' : '' }}">Influencer</span>
                            </a>

                        </div>
                        <!-- Settings -->
                        <a class="nav-link  collapsed" href="#" data-toggle="collapse"
                            data-target="#SettingsMenu" aria-expanded="false" aria-controls="SettingsMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/statistic.png') }}">
                            <span>Settings</span>
                        </a>
                        <div id="SettingsMenu" class="collapse @if (in_array(request()->segment(3), ['All-user', 'set-fees'])) show @endif"
                            data-parent="#Management">


                            <a class="collapse-item" href="{{ route('admin.set-fees') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span style="{{ request()->segment(3) == 'set-fees' ? 'color: #FF3C5F;' : '' }}">Fees
                                    & Variables</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.management.allUser') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'All-user' ? 'color: #FF3C5F;' : '' }}">Security
                                    & Access</span>
                            </a>

                        </div>

                        {{-- Shareholders --}}
                        <a class="nav-link  collapsed" href="#" data-toggle="collapse"
                            data-target="#ShareholdersMenu" aria-expanded="false" aria-controls="ShareholdersMenu">
                            <img src="{{ asset('assets//dashboard/img/menu-icon/profit.png') }}">
                            <span>Shareholders</span>
                        </a>
                        <div id="ShareholdersMenu"
                            class="collapse @if (in_array(request()->segment(3), [
                                    'annual-report','directors','portfolio',
                                    'annual-profit-and-loss',
                                    'balance-sheet',
                                    'constitution',
                                    'minutes',
                                    'newsletter',
                                    'shareholder-notices','registrations','e4u-revenue',
                                    'subsidiaries-balance-sheet',
                                    'subsidiaries-annual-profit-and-loss',
                                    'updates','shareholder','share-value'
                                ])) show @endif" data-parent="#Management">

                            <!--  Blackbox Tech Pty Ltd -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Blackbox"
                                aria-expanded="false" aria-controls="Blackbox">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span>Blackbox Tech</span>
                            </a>
                            <div id="Blackbox" class="collapse @if (in_array(request()->segment(3), ['annual-report','directors','portfolio'])) show @endif" data-parent="#ShareholdersMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
                                    
                                    {{-- Annual Report  --}}
                                     <a class="collapse-item" href="{{ route('admin.annual-report') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'annual-report' ? 'color: #FF3C5F;' : '' }}">Annual
                                            Report</span>
                                    </a>
                                    {{-- end --}}

                                    {{-- Directors  --}}
                                     <a class="collapse-item" href="{{ route('admin.directors') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'directors' ? 'color: #FF3C5F;' : '' }}">Directors</span>
                                    </a>
                                    {{-- end --}}

                                    {{-- Portfolio  --}}
                                     <a class="collapse-item" href="{{ route('admin.portfolio') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'portfolio' ? 'color: #FF3C5F;' : '' }}">Portfolio</span>
                                    </a>
                                    {{-- end --}}

                                </div>
                            </div>
                            <!-- end --> 


                            <!--  Communications -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SHCommunications"
                                aria-expanded="false" aria-controls="SHCommunications">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span>Communications</span>
                            </a>
                            <div id="SHCommunications" class="collapse @if (in_array(request()->segment(3), ['newsletter','shareholder-notices'])) show @endif" data-parent="#ShareholdersMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
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
     

                                </div>
                            </div>
                            <!-- end --> 


                            <!--  E4U Information -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#E4UInformation"
                                aria-expanded="false" aria-controls="E4UInformation">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span>E4U Information</span>
                            </a>
                            <div id="E4UInformation" class="collapse @if (in_array(request()->segment(3), ['registrations','e4u-revenue'])) show @endif" data-parent="#ShareholdersMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
                                     <a class="collapse-item" href="{{ route('admin.registrations') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'registrations' ? 'color: #FF3C5F;' : '' }}">Registrations</span>
                                    </a>

                                    <a class="collapse-item" href="{{ route('admin.e4u-revenue') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'e4u-revenue' ? 'color: #FF3C5F;' : '' }}">Revenue</span>
                                    </a>
     

                                </div>
                            </div>
                            <!-- end --> 


                            <!--  Shareholder Documents -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ShareholderDocuments"
                                aria-expanded="false" aria-controls="ShareholderDocuments">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span>Shareholder Documents</span>
                            </a>
                            <div id="ShareholderDocuments" class="collapse @if (in_array(request()->segment(3), ['annual-profit-and-loss','balance-sheet','constitution','minutes','updates'])) show @endif" data-parent="#ShareholdersMenu">

                                <div class="py-0 collapse-inner rounded mb-2">

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
                                            style="{{ request()->segment(3) == 'minutes' ? 'color: #FF3C5F;' : '' }}">Shareholder Minutes</span>
                                    </a>

                                    <a class="collapse-item" href="{{ route('admin.updates') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'updates' ? 'color: #FF3C5F;' : '' }}">Shareholder Updates</span>
                                    </a>
                                </div>
                            </div>
                            <!-- end --> 


                            <!--  Share Register -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ShareRegister"
                                aria-expanded="false" aria-controls="ShareRegister">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span>Share Register</span>
                            </a>
                            <div id="ShareRegister" class="collapse @if (in_array(request()->segment(3), ['shareholder','share-value'])) show @endif" data-parent="#ShareholdersMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
                                    <a class="collapse-item" href="{{ route('admin.shareholder') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'shareholder' ? 'color: #FF3C5F;' : '' }}">Shareholders</span>
                                    </a>
                                    <a class="collapse-item" href="{{ route('admin.share-value') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'share-value' ? 'color: #FF3C5F;' : '' }}">Share Value</span>
                                    </a>
                                </div>
                            </div>
                            <!-- end --> 


                            <!--  Subsidiaries -->

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Subsidiaries"
                                aria-expanded="false" aria-controls="Subsidiaries">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span>Subsidiaries</span>
                            </a>
                            <div id="Subsidiaries" class="collapse @if (in_array(request()->segment(3), ['subsidiaries-balance-sheet','subsidiaries-annual-profit-and-loss'])) show @endif" data-parent="#ShareholdersMenu">

                                <div class="py-0 collapse-inner rounded mb-2">
                                    
                                    <a class="collapse-item"
                                        href="{{ route('admin.subsidiaries-annual-profit-and-loss') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'subsidiaries-annual-profit-and-loss' ? 'color: #FF3C5F;' : '' }}">Annual Profit & Loss</span>
                                    </a>

                                    <a class="collapse-item" href="{{ route('admin.subsidiaries-balance-sheet') }}">
                                        <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                        <span
                                            style="{{ request()->segment(3) == 'subsidiaries-balance-sheet' ? 'color: #FF3C5F;' : '' }}">Balance Sheet</span>
                                    </a>
                                    
                                </div>
                            </div>
                            <!-- end --> 

                            


                        </div>
                        {{-- end --}}

                        <!-- Statistics -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#statisticsMenu" aria-expanded="false" aria-controls="statisticsMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/statistic.png') }}">
                            <span>Statistics</span>
                        </a>
                        <div id="statisticsMenu" class="collapse @if (in_array(request()->segment(3), ['tours', 'profile','product', 'memberships'])) show @endif " data-parent="#Management">
                            <a class="collapse-item" href="{{ route('admin.memberships') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'memberships' ? 'color: #FF3C5F;' : '' }}">Memberships</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.product') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'product' ? 'color: #FF3C5F;' : '' }}">Product</span>
                            </a>
                             <a class="collapse-item" href="{{ route('admin.profile') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'profile' ? 'color: #FF3C5F;' : '' }}">Profile</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.tours') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
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
                <img src="{{ asset('assets/dashboard/img/menu-icon/my-account.png') }}" alt="">
                <span>My Account </span>
            </a>
            <div id="myaccount" class="collapse @if (request()->segment(2) == 'update-account' ||
                    request()->segment(2) == 'profile-informations' ||
                    request()->segment(2) == 'change-password' ||
                    request()->segment(2) == 'upload-my-avatar') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('admin.account.edit') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                        <span style="{{ request()->segment(2) == 'update-account' ? 'color: #FF3C5F;' : '' }}">Edit
                            my account</span></a>
                    <a class="collapse-item" href="{{ route('admin.change.password') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'change-password' ? 'color: #FF3C5F;' : '' }}">Change
                            password</span></a>
                    <a class="collapse-item" href="{{ route('admin.profile.avatar') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
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
