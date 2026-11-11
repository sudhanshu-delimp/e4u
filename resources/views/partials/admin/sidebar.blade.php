@php
$securityLevel = isset(auth()->user()->staff_detail->security_level)
? auth()->user()->staff_detail->security_level
: 0;
$sidebar = staffPageAccessPermission($securityLevel, 'sidebar');

$ocLavel = 'Management';
if ($securityLevel == 2) {
$ocLavel = 'Management';
} elseif ($securityLevel == 3) {
$ocLavel = 'Admin';
} elseif ($securityLevel == 4) {
$ocLavel = 'Developer';
}
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    
        @if (auth()->user() && auth()->user()->type == 1)

        <a class="sidebar-brand text-left pb-1" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/escorts4u-logo.svg') }}" class="e4u_logo" alt="">
        </a>
    <span class="console_heading">OC ({{ $ocLavel }})</span>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
        <svg width="64px" height="64px" viewBox="-7.2 -7.2 38.40 38.40" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-7.2" y="-7.2" width="38.40" height="38.40" rx="19.2" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="none"></rect> <path d="M15.024 22C16.2771 22 17.3524 21.9342 18.2508 21.7345C19.1607 21.5323 19.9494 21.1798 20.5646 20.5646C21.1798 19.9494 21.5323 19.1607 21.7345 18.2508C21.9342 17.3524 22 16.2771 22 15.024V12C22 10.8954 21.1046 10 20 10H12C10.8954 10 10 10.8954 10 12V20C10 21.1046 10.8954 22 12 22H15.024Z" fill="#0c223d"></path> <path d="M2 15.024C2 16.2771 2.06584 17.3524 2.26552 18.2508C2.46772 19.1607 2.82021 19.9494 3.43543 20.5646C4.05065 21.1798 4.83933 21.5323 5.74915 21.7345C5.83628 21.7538 5.92385 21.772 6.01178 21.789C7.09629 21.9985 8 21.0806 8 19.976L8 12C8 10.8954 7.10457 10 6 10H4C2.89543 10 2 10.8954 2 12V15.024Z" fill="#0c223d"></path> <path d="M8.97597 2C7.72284 2 6.64759 2.06584 5.74912 2.26552C4.8393 2.46772 4.05062 2.82021 3.4354 3.43543C2.82018 4.05065 2.46769 4.83933 2.26549 5.74915C2.24889 5.82386 2.23327 5.89881 2.2186 5.97398C2.00422 7.07267 2.9389 8 4.0583 8H19.976C21.0806 8 21.9985 7.09629 21.789 6.01178C21.772 5.92385 21.7538 5.83628 21.7345 5.74915C21.5322 4.83933 21.1798 4.05065 20.5645 3.43543C19.9493 2.82021 19.1606 2.46772 18.2508 2.26552C17.3523 2.06584 16.2771 2 15.024 2H8.97597Z" fill="#0c223d"></path> </g></svg>    
        <span>Dashboard</span>
        </a>
    </li>
     <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Monitoring"
            aria-expanded="false" aria-controls="collapseMonitoring">
           <svg width="64px" height="64px" viewBox="-9.84 -9.84 43.68 43.68" id="meteor-icon-kit__solid-analytics" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-9.84" y="-9.84" width="43.68" height="43.68" rx="21.84" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 13C4.65685 13 6 14.3431 6 16V21C6 22.6569 4.65685 24 3 24C1.34315 24 0 22.6569 0 21V16C0 14.3431 1.34315 13 3 13zM11 0C12.6569 0 14 1.34315 14 3V21C14 22.6569 12.6569 24 11 24C9.3431 24 8 22.6569 8 21V3C8 1.34315 9.3431 0 11 0zM19 7C20.6569 7 22 8.34315 22 10V21C22 22.6569 20.6569 24 19 24C17.3431 24 16 22.6569 16 21V10C16 8.34315 17.3431 7 19 7z" fill="#0c223d"></path></g></svg>
            <span>Global Monitoring </span>
        </a>
        <div id="Monitoring" class="collapse @if (request()->is('*global-monitoring*') ||
                    request()->is('*users-online*') ||
                    request()->is('*escort-listings*') ||
                    request()->is('*massage-centre-listings*') ||
                    request()->is('*visitors*') ||
                    request()->is('*pinup-listings*')) show @endif">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('admin.escort-listings') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}">
                    <span style="{{ request()->is('*escort-listings*') ? 'color: #FF3C5F;' : '' }}">Escort
                        Listings</span>
                </a>

                <a class="collapse-item" href="{{ route('admin.massage-centre-listings') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png') }}">
                    <span style="{{ request()->is('*massage-centre-listings*') ? 'color: #FF3C5F;' : '' }}">Massage
                        Centre Listings</span>
                </a>
                <a class="collapse-item" href="{{ route('admin.pin-up-listings') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                    <span style="{{ request()->is('*pinup-listings*') ? 'color: #FF3C5F;' : '' }}">Pin Up
                        Listings</span>
                </a>
                <a class="collapse-item" href="{{ route('admin.logged-in-users') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/login-user.png') }}">
                    <span style="{{ request()->is('*users-online*') ? 'color: #FF3C5F;' : '' }}"> Users
                        Online</span>
                </a>
                <a class="collapse-item" href="{{ route('admin.visitors') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                    <span style="{{ request()->is('*visitors*') ? 'color: #FF3C5F;' : '' }}">Visitors</span>
                </a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->
    <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration"
            aria-expanded="false" aria-controls="Administration">
           <svg fill="#0c223d" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-142.37 -142.37 759.31 759.31" xml:space="preserve" stroke="#0c223d"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-142.37" y="-142.37" width="759.31" height="759.31" rx="379.655" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M255.204,102.3c-0.606-11.321-12.176-9.395-23.465-9.395C240.078,95.126,247.967,98.216,255.204,102.3z"></path> <path d="M134.524,73.928c-43.825,0-63.997,55.471-28.963,83.37c11.943-31.89,35.718-54.788,66.886-63.826 C163.921,81.685,150.146,73.928,134.524,73.928z"></path> <path d="M43.987,148.617c1.786,5.731,4.1,11.229,6.849,16.438L36.44,179.459c-3.866,3.866-3.866,10.141,0,14.015l25.375,25.383 c1.848,1.848,4.38,2.888,7.019,2.888c2.61,0,5.125-1.04,7.005-2.888l14.38-14.404c2.158,1.142,4.55,1.842,6.785,2.827 c0-0.164-0.016-0.334-0.016-0.498c0-11.771,1.352-22.875,3.759-33.302c-17.362-11.174-28.947-30.57-28.947-52.715 c0-34.592,28.139-62.739,62.723-62.739c23.418,0,43.637,13.037,54.43,32.084c11.523-1.429,22.347-1.429,35.376,1.033 c-1.676-5.07-3.648-10.032-6.118-14.683l14.396-14.411c1.878-1.856,2.918-4.38,2.918-7.004c0-2.625-1.04-5.148-2.918-7.004 l-25.361-25.367c-1.94-1.941-4.472-2.904-7.003-2.904c-2.532,0-5.063,0.963-6.989,2.904l-14.442,14.411 c-5.217-2.764-10.699-5.078-16.444-6.825V9.9c0-5.466-4.411-9.9-9.893-9.9h-35.888c-5.451,0-9.909,4.434-9.909,9.9v20.359 c-5.73,1.747-11.213,4.061-16.446,6.825L75.839,22.689c-1.942-1.941-4.473-2.904-7.005-2.904c-2.531,0-5.077,0.963-7.003,2.896 L36.44,48.048c-1.848,1.864-2.888,4.379-2.888,7.012c0,2.632,1.04,5.148,2.888,7.004l14.396,14.403 c-2.75,5.218-5.063,10.708-6.817,16.438H23.675c-5.482,0-9.909,4.441-9.909,9.915v35.889c0,5.458,4.427,9.908,9.909,9.908H43.987z"></path> <path d="M354.871,340.654c15.872-8.705,26.773-25.367,26.773-44.703c0-28.217-22.967-51.168-51.184-51.168 c-9.923,0-19.118,2.966-26.975,7.873c-4.705,18.728-12.113,36.642-21.803,52.202C309.152,310.022,334.357,322.531,354.871,340.654z "></path> <path d="M460.782,276.588c0-5.909-4.799-10.693-10.685-10.693H428.14c-1.896-6.189-4.411-12.121-7.393-17.75l15.544-15.544 c2.02-2.004,3.137-4.721,3.137-7.555c0-2.835-1.118-5.553-3.137-7.563l-27.363-27.371c-2.08-2.09-4.829-3.138-7.561-3.138 c-2.734,0-5.467,1.048-7.547,3.138l-15.576,15.552c-5.623-2.982-11.539-5.481-17.751-7.369v-21.958 c0-5.901-4.768-10.685-10.669-10.685H311.11c-2.594,0-4.877,1.04-6.739,2.578c3.26,11.895,5.046,24.793,5.046,38.552 c0,8.735-0.682,17.604-1.956,26.423c7.205-2.656,14.876-4.324,22.999-4.324c36.99,0,67.086,30.089,67.086,67.07 c0,23.637-12.345,44.353-30.872,56.303c13.48,14.784,24.195,32.324,31.168,51.976c1.148,0.396,2.344,0.684,3.54,0.684 c2.733,0,5.467-1.04,7.563-3.13l27.379-27.371c2.004-2.004,3.106-4.721,3.106-7.555s-1.102-5.551-3.106-7.563l-15.576-15.552 c2.982-5.621,5.497-11.555,7.393-17.75h21.957c2.826,0,5.575-1.118,7.563-3.138c2.004-1.996,3.138-4.72,3.138-7.555 L460.782,276.588z"></path> <path d="M376.038,413.906c-16.602-48.848-60.471-82.445-111.113-87.018c-16.958,17.958-37.954,29.351-61.731,29.351 c-23.759,0-44.771-11.392-61.713-29.351c-50.672,4.573-94.543,38.17-111.145,87.026l-9.177,27.013 c-2.625,7.773-1.368,16.338,3.416,23.007c4.783,6.671,12.486,10.631,20.685,10.631h315.853c8.215,0,15.918-3.96,20.702-10.631 c4.767-6.669,6.041-15.234,3.4-23.007L376.038,413.906z"></path> <path d="M120.842,206.782c0,60.589,36.883,125.603,82.352,125.603c45.487,0,82.368-65.014,82.368-125.603 C285.563,81.188,120.842,80.939,120.842,206.782z"></path> </g> </g></svg>
            <span>Administration</span>
        </a>

        <div id="Administration" class="collapse @if (in_array(request()->segment(3), [
                    'publicpages',
                    'consoles',
                    'email-service-request',
                    'mobile-sim-request',
                    'product-order-history',
                    'visa-migration-request',
                    'manage-email',
                    'code-of-conduct',
                    'data-breach-plan',
                    'discipline-and-termination',
                    'fitness-for-work',
                    'grievance',
                    'manage-sim',
                    'health-and-safety',
                    'information-use',
                    'leave',
                    'personal-telephone-use',
                    'position-descriptions',
                    'global',
                    'social-media',
                    'smoking',
                    'abbreviations',
                    'classification-laws',
                    'local-laws',
                    'pricing-summary',
                    'agents',
                    'viewer',
                    'escort',
                    'shareholders',
                    'centres',
                    'agents-guidelines',
                    'viewers-guidelines',
                    'escorts-guidelines',
                    'massage-centres-guidelines',
                    'operator-guidelines',
                    'shareholders-guidelines',
                    'reports',
                    'send-reports',
                    'alert',
                    'blog',
                    'credit',
                    'media-verification',
                    'agent-requests',
                    'num',
                    'punterbox',
                    'communication',
                    'transaction-summary',
                    'advertiser-cancellations',
                    'advertiser-suspensions',
                    'e4u-suspensions',
                    'registrations-reports',
                    'advertiser-reports',
                    'advertiser-reviews',
                    'financial-report',
                    'process-payment',
                    'summary',
                ]) || request()->routeIs('administration.*') || in_array(request()->segment(2), ['support_tickets', 'submit_ticket', 'reference-lookup'])) show @endif"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">

            <div class="py-0 collapse-inner rounded mb-2">

                {{-- Analytics --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
                    aria-expanded="false" aria-controls="Analytics">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                    <span>Analytics</span>
                </a>

                <div id="Analytics"
                    class="collapse 
                        @if (request()->segment(3) == 'publicpages' || request()->segment(3) == 'consoles') show @endif;"
                    data-parent="#Administration">

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

                        <a class="collapse-item" href="{{ route('admin.visa.migration.index') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'visa-migration-request' ? 'color: #FF3C5F;' : '' }}">Visa
                                Request</span>
                        </a>
                    </div>
                </div>
                {{-- end Concierge --}}



                {{-- Community --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
                    aria-expanded="false" aria-controls="Community">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                    <span>Community</span>
                </a>
                <div id="Community" class="collapse @if (request()->segment(3) == 'abbreviations' ||
                            request()->segment(3) == 'classification-laws' ||
                            request()->segment(3) == 'local-laws' ||
                            request()->segment(3) == 'pricing-summary') show @endif;"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('admin.abbreviations') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/app/img/Abrieviations.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'abbreviations' ? 'color: #FF3C5F;' : '' }}">Abbreviations</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.classification-laws') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/law.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'classification-laws' ? 'color: #FF3C5F;' : '' }}">Classification
                                Laws</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.local-laws') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/app/img/gavel.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'local-laws' ? 'color: #FF3C5F;' : '' }}">Local
                                Laws</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.pricing-summary') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/pricing-summary.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'pricing-summary' ? 'color: #FF3C5F;' : '' }}">Pricing
                                Summary</span>
                        </a>
                    </div>
                </div>
                {{-- Community --}}


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




                {{-- E4U Policies --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#E4UPolicies"
                    aria-expanded="false" aria-controls="E4UPolicies">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/policy.png') }}">
                    <span>E4U Policies</span>
                </a>
                <div id="E4UPolicies" class="collapse @if (request()->segment(3) == 'code-of-conduct' ||
                            request()->segment(3) == 'data-breach-plan' ||
                            request()->segment(3) == 'discipline-and-termination' ||
                            request()->segment(3) == 'fitness-for-work' ||
                            request()->segment(3) == 'grievance' ||
                            request()->segment(3) == 'health-and-safety' ||
                            request()->segment(3) == 'information-use' ||
                            request()->segment(3) == 'leave' ||
                            request()->segment(3) == 'personal-telephone-use' ||
                            request()->segment(3) == 'position-descriptions' ||
                            request()->segment(3) == 'smoking' ||
                            request()->segment(3) == 'social-media') show @endif;"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('admin.code-of-conduct') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'code-of-conduct' ? 'color: #FF3C5F;' : '' }}">Code
                                of Conduct</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.data-breach-plan') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'data-breach-plan' ? 'color: #FF3C5F;' : '' }}">Data
                                Breach Plan</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.discipline-and-termination') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'discipline-and-termination' ? 'color: #FF3C5F;' : '' }}">Discipline
                                & Termination</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.fitness-for-work') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'fitness-for-work' ? 'color: #FF3C5F;' : '' }}">Fitness
                                for Work</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.grievance') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'grievance' ? 'color: #FF3C5F;' : '' }}">Grievance</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.health-and-safety') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'health-and-safety' ? 'color: #FF3C5F;' : '' }}">Health
                                & Safety</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.information-use') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'information-use' ? 'color: #FF3C5F;' : '' }}">Information
                                Use</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.leave') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'leave' ? 'color: #FF3C5F;' : '' }}">Leave</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.personal-telephone-use') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'personal-telephone-use' ? 'color: #FF3C5F;' : '' }}">Personal
                                Telephone Use</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.position-descriptions') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'position-descriptions' ? 'color: #FF3C5F;' : '' }}">Position
                                Descriptions</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.social-media') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'social-media' ? 'color: #FF3C5F;' : '' }}">Social
                                Media</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.smoking') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'smoking' ? 'color: #FF3C5F;' : '' }}">Smoking</span>
                        </a>

                    </div>
                </div>
                {{-- E4U Policies --}}









                {{-- Guidelines --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Guidelines"
                    aria-expanded="false" aria-controls="Guidelines">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/guideline.png') }}">
                    <span>Guidelines</span>
                </a>
                <div id="Guidelines" class="collapse @if (request()->segment(3) == 'agents-guidelines' ||
                            request()->segment(3) == 'escorts-guidelines' ||
                            request()->segment(3) == 'massage-centres-guidelines' ||
                            request()->segment(3) == 'operator-guidelines' ||
                            request()->segment(3) == 'shareholders-guidelines' ||
                            request()->segment(3) == 'viewers-guidelines') show @endif;"
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
                                style="{{ request()->segment(3) == 'massage-centres-guidelines' ? 'color: #FF3C5F;' : '' }}">Massage
                                Centres</span>
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
                            request()->segment(3) == 'centres') show @endif;"
                    data-parent="#Administration">

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
                        <a href="{{ route('admin.shareholders.notifications.index') }}" class="collapse-item">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/profit.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'shareholders' ? 'color: #FF3C5F;' : '' }}">Shareholders</span>
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
                    data-parent="#Administration">
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

                <a class="nav-link" href="#" data-toggle="collapse" data-target="#Publications"
                    aria-expanded="false" aria-controls="Publications">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/publication.png') }}">
                    <span>Publications</span>
                </a>
                <!-- <div id="Publications" class="collapse @if (request()->segment(3) == 'alerts' || request()->segment(3) == 'blog' || request()->segment(2) == 'feedback') show @endif;" data-parent="#Administration"> -->
                <div id="Publications" class="collapse @if (request()->segment(3) == 'alert' || request()->segment(3) == 'blog') show @endif;"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="nav-link collapsed" href="{{ route('admin.publications.alert.index') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/alert.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'alert' ? 'color: #FF3C5F;' : '' }}">Alerts</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('admin.publications.blog.index') }}">
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
                            request()->is('*advertiser-cancellations*') ||
                            request()->is('*advertiser-suspensions*') ||
                            request()->is('*e4u-suspensions*') ||
                            request()->is('*registrations-reports*') ||
                            request()->is('*advertiser-reports*') ||
                            request()->is('*punterbox*') ||
                            request()->is('*communication*') ||
                            request()->is('*media-verification*') ||
                            request()->is('*product-order-history*') ||
                            request()->is('*advertiser-reviews*')) show @endif;"
                    data-parent="#Administration">
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
                        <a class="nav-link collapsed" href="{{ route('admin.agent-requests') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/agent-request.png') }}">
                            <span style="{{ request()->is('*agent-requests*') ? 'color: #FF3C5F;' : '' }}">Agent
                                Requests</span>
                        </a>

                        <a class="nav-link collapsed" href="{{ route('admin.reports.communication.index') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/communication.png') }}">
                            <span
                                style="{{ request()->is('*communication*') ? 'color: #FF3C5F;' : '' }}">communications</span>
                        </a>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#Listings" aria-expanded="false" aria-controls="Listings">
                            <svg viewBox="0 -4.5 31 31" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>list</title>
                                    <desc>Created with Sketch Beta.</desc>
                                    <defs> </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                        <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-206.000000, -626.000000)" fill="#c2cfe0">
                                            <path d="M235,643 L216,643 C214.896,643 214,643.896 214,645 C214,646.104 214.896,647 216,647 L235,647 C236.104,647 237,646.104 237,645 C237,643.896 236.104,643 235,643 L235,643 Z M235,635 L216,635 C214.896,635 214,635.896 214,637 C214,638.104 214.896,639 216,639 L235,639 C236.104,639 237,638.104 237,637 C237,635.896 236.104,635 235,635 L235,635 Z M216,631 L235,631 C236.104,631 237,630.104 237,629 C237,627.896 236.104,627 235,627 L216,627 C214.896,627 214,627.896 214,629 C214,630.104 214.896,631 216,631 L216,631 Z M209,642 C207.343,642 206,643.343 206,645 C206,646.657 207.343,648 209,648 C210.657,648 212,646.657 212,645 C212,643.343 210.657,642 209,642 L209,642 Z M209,634 C207.343,634 206,635.343 206,637 C206,638.657 207.343,640 209,640 C210.657,640 212,638.657 212,637 C212,635.343 210.657,634 209,634 L209,634 Z M209,626 C207.343,626 206,627.343 206,629 C206,630.657 207.343,632 209,632 C210.657,632 212,630.657 212,629 C212,627.343 210.657,626 209,626 L209,626 Z" id="list" sketch:type="MSShapeGroup"> </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <span>Listing Status</span>
                        </a>

                        <div id="Listings" class=" collapse  @if (in_array(request()->segment(3), ['advertiser-cancellations', 'e4u-suspensions', 'advertiser-suspensions'])) show @endif"
                            data-parent="#Reports">
                            <div class="py-0 collapse-inner rounded mb-2">

                                <a class="nav-link collapse-item"
                                    href="{{ route('admin.advertiser-cancellations') }}">
                                    <svg fill="#c2cfe0" viewBox="-7.68 -7.68 111.36 111.36" xmlns="http://www.w3.org/2000/svg" stroke="#c2cfe0" stroke-width="0.0009600000000000001">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title></title>
                                            <g>
                                                <path d="M48,0A48,48,0,1,0,96,48,48.0512,48.0512,0,0,0,48,0Zm0,84A36,36,0,1,1,84,48,36.0393,36.0393,0,0,1,48,84Z"></path>
                                                <path d="M64.2422,31.7578a5.9979,5.9979,0,0,0-8.4844,0L48,39.5156l-7.7578-7.7578a5.9994,5.9994,0,0,0-8.4844,8.4844L39.5156,48l-7.7578,7.7578a5.9994,5.9994,0,1,0,8.4844,8.4844L48,56.4844l7.7578,7.7578a5.9994,5.9994,0,0,0,8.4844-8.4844L56.4844,48l7.7578-7.7578A5.9979,5.9979,0,0,0,64.2422,31.7578Z"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    <span
                                        style="{{ request()->is('*advertiser-cancellations*') ? 'color: #FF3C5F;' : '' }}">Cancellations</span>
                                </a>
                                <a class="nav-link collapse-item"
                                    href="{{ route('admin.advertiser-suspensions') }}">
                                    <svg fill="#c2cfe0" viewBox="-71.68 -71.68 655.36 655.36" xmlns="http://www.w3.org/2000/svg" stroke="#c2cfe0" stroke-width="0.00512">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M256 8C119.034 8 8 119.033 8 256s111.034 248 248 248 248-111.034 248-248S392.967 8 256 8zm130.108 117.892c65.448 65.448 70 165.481 20.677 235.637L150.47 105.216c70.204-49.356 170.226-44.735 235.638 20.676zM125.892 386.108c-65.448-65.448-70-165.481-20.677-235.637L361.53 406.784c-70.203 49.356-170.226 44.736-235.638-20.676z"></path>
                                        </g>
                                    </svg>
                                    <span
                                        style="{{ request()->is('*advertiser-suspensions*') || request()->is('*e4u-suspensions*') ? 'color: #FF3C5F;' : '' }}">Suspensions</span>
                                </a>

                            </div>
                        </div>
                        <a class="nav-link collapsed" href="{{ route('admin.media-verification') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/image-verify.png') }}">
                            <span
                                style="{{ request()->is('*media-verification*') ? 'color: #FF3C5F;' : '' }}">Media
                                Verification</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('admin.num') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png') }}">
                            <span style="{{ request()->is('*num*') ? 'color: #FF3C5F;' : '' }}">NUM</span>
                        </a>

                        <a class="nav-link " href="{{ route('admin.escort.orders') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'product-order-history' ? 'color: #FF3C5F;' : '' }}">Product
                                Orders</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('admin.punterbox') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/punterbox.png') }}">
                            <span
                                style="{{ request()->is('*punterbox*') ? 'color: #FF3C5F;' : '' }}">Punterbox</span>
                        </a>
                        <a class="nav-link collapsed" href="{{ route('admin.registrations-reports') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/registration-reports.png') }}">
                            <span
                                style="{{ request()->is('*registrations-reports*') ? 'color: #FF3C5F;' : '' }}">Registrations</span>
                        </a>
                        {{-- end --}}

                        <a class="nav-link collapsed" href="{{ route('admin.payment.transaction_summary') }}">
                            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                                src="{{ asset('assets/dashboard/img/menu-icon/transaction-summary.png') }}">
                            <span
                                style="{{ request()->is('*transaction-summary*') ? 'color: #FF3C5F;' : '' }}">Transactions</span>
                        </a>
                    </div>
                    {{-- Suspensions --}}

                </div>


                <a class="nav-link" href="{{ route('admin.reference-lookup') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/lookup.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'reference-lookup' ? 'color: #FF3C5F;' : '' }}">Reference
                        Lookup</span>
                </a>



                {{-- Support Services --}}
                <a class="nav-link  collapsed"
                    href="#" data-toggle="collapse" data-target="#supportServices" aria-expanded="false"
                    aria-controls="supportServices">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/support-services.png') }}">
                    <span>Support Services</span>
                </a>

                <div id="supportServices" class=" collapse @if (request()->routeIs('administration.support-services.*')) show @endif"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item show" href="{{ route('administration.support-services.financial_report') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/financials.png') }}">
                            <span
                                style="{{ request()->routeIs('administration.support-services.financial_report') ? 'color: #FF3C5F;' : '' }}">Financial
                                Report
                            </span>
                        </a>
                        <a class="collapse-item show" href="{{ route('administration.support-services.process_payment') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/payment.png') }}">
                            <span
                                style="{{ request()->routeIs('administration.support-services.process_payment') ? 'color: #FF3C5F;' : '' }}">Process
                                Payment
                            </span>
                        </a>
                        <a class="collapse-item show" href="{{ route('administration.support-services.summary') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/pricing-summary.png') }}">
                            <span
                                style="{{ request()->routeIs('administration.support-services.summary') ? 'color: #FF3C5F;' : '' }}">Summary
                            </span>
                        </a>

                    </div>
                </div>
                {{-- end --}}

                <a class="nav-link  {{ in_array(request()->segment(2), ['support_tickets', 'submit_ticket']) ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#SupportTickets">
                    <img src="{{ asset('assets/app/img/ticket.png') }}">
                    <span>Support Tickets </span>
                </a>

                <div id="SupportTickets"
                    class="collapse
                        @if (in_array(request()->segment(2), ['support_tickets']) || request()->segment(2) == 'submit_ticket') show @endif"
                    data-parent="#Administration">

                    <a class="collapse-item {{ request()->segment(2) == 'submit_ticket' ? 'menu-active' : '' }}"
                        href="{{ route('support-ticket.create.admin') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/submit-ticket.png') }}">
                        <span>Submit Ticket</span>
                    </a>
                    <a class="collapse-item {{ request()->segment(2) == 'support_tickets' ? 'menu-active' : '' }}"
                        href="{{ route('admin.support-ticket.list') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reply.png') }}">
                        <span>View & Reply</span>
                    </a>
                </div>


            </div>
        </div>
    </li>

    @if (isset($sidebar['management']['yesNo']) && $sidebar['management']['yesNo'] == 'yes')
     <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->
    <li class="nav-item">
        <a class="nav-link {{ request()->segment(2) == 'feedback' ? '' : 'collapsed' }}" href="#"
            data-toggle="collapse" data-target="#Management" aria-expanded="false"
            aria-controls="Management">
            <svg fill="#000000" height="64px" width="64px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-89.1 -89.1 475.20 475.20" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-89.1" y="-89.1" width="475.20" height="475.20" rx="237.6" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="m112.632,185.074l6.88-3.972c2.804-1.619 3.765-5.205 2.146-8.01l-13.036-22.579c-1.086-1.881-3.057-2.933-5.083-2.933-0.995,0-2.003,0.253-2.926,0.787l-6.88,3.972c-0.945,0.545-1.947,0.794-2.923,0.794-3.063,0-5.872-2.449-5.872-5.872v-7.944c0-3.238-2.625-5.864-5.864-5.864h-26.073c-3.238,0-5.864,2.625-5.864,5.864v7.944c0,3.423-2.81,5.872-5.872,5.872-0.976,0-1.978-0.249-2.923-0.794l-6.88-3.972c-0.923-0.533-1.932-0.786-2.926-0.787-2.027,0-3.997,1.052-5.083,2.933l-13.036,22.579c-1.619,2.805-0.658,6.391 2.146,8.01l6.88,3.972c3.909,2.257 3.909,7.899 0,10.156l-6.88,3.972c-2.805,1.619-3.765,5.205-2.146,8.01l13.036,22.579c1.086,1.881 3.057,2.933 5.083,2.933 0.995,0 2.003-0.254 2.926-0.787l6.88-3.972c0.945-0.545 1.947-0.794 2.923-0.794 3.063,0 5.872,2.449 5.872,5.872v7.944c0,3.238 2.625,5.864 5.864,5.864h26.072c3.238,0 5.864-2.625 5.864-5.864v-7.944c0-3.423 2.81-5.872 5.872-5.872 0.976,0 1.978,0.249 2.923,0.794l6.88,3.972c0.923,0.533 1.932,0.787 2.926,0.787 2.027,0 3.997-1.052 5.083-2.933l13.036-22.579c1.619-2.805 0.658-6.391-2.146-8.01l-6.88-3.972c-3.908-2.257-3.908-7.9 0.001-10.156zm-46.594,22.474c-9.608,0-17.396-7.789-17.396-17.396 0-9.608 7.789-17.396 17.396-17.396s17.396,7.789 17.396,17.396c0,9.607-7.789,17.396-17.396,17.396z"></path> <path d="m108.109,23.659c-3.146-3.144-8.243-3.144-11.389,0-3.145,3.146-3.145,8.244 0,11.389l14.39,14.389c-52.889,2.619-95.701,44.162-100.334,96.506l1.19-2.062c3.406-5.9 9.756-9.565 16.57-9.564 0.144,0 0.287,0.013 0.431,0.017 9.074-37.721 41.965-66.251 81.815-68.729l-14.062,14.061c-3.145,3.145-3.145,8.244 0,11.389 1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358l28.004-28.004c1.51-1.511 2.358-3.559 2.358-5.694 0-2.136-0.848-4.184-2.358-5.694l-28.003-28.004z"></path> <path d="m209.868,64.857c17.881,0 32.428-14.547 32.428-32.428 0-17.882-14.547-32.429-32.428-32.429-17.881,0-32.428,14.547-32.428,32.428 0,17.881 14.547,32.429 32.428,32.429z"></path> <path d="m273.039,152.276v-44.58c0-12.34-7.93-23.283-19.657-27.124l-.054-.018-17.152-2.84c-1.46-0.449-3.02,0.324-3.545,1.764l-19.462,53.399c-1.123,3.081-5.48,3.081-6.602,0l-19.462-53.399c-0.424-1.163-1.522-1.892-2.698-1.892-0.279,0-17.999,2.964-17.999,2.964-11.823,3.94-19.723,14.9-19.723,27.294v44.432c0,6.659 5.398,12.056 12.056,12.056h102.241c6.66-2.84217e-14 12.057-5.398 12.057-12.056z"></path> <path d="m287.37,162.933c-0.673,9.215-8.233,14.858-17.45,15.526-7.062,40.425-41.207,71.64-82.979,74.237l14.061-14.061c3.145-3.146 3.145-8.244 0-11.389-3.146-3.144-8.243-3.144-11.389,0l-28.003,28.004c-3.145,3.146-3.145,8.244 0,11.389l28.003,28.003c1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358c3.145-3.145 3.145-8.244 0-11.389l-14.389-14.389c56.028-2.774 100.758-49.227 100.758-105.931z"></path> <path d="m216.936,77.105c-0.747-0.814-1.84-1.224-2.946-1.224h-8.245c-1.105,0-2.198,0.41-2.946,1.224-1.157,1.261-1.325,3.082-0.504,4.505l4.407,6.644-2.063,17.405 4.063,10.808c0.396,1.087 1.933,1.087 2.33,0l4.063-10.808-2.063-17.405 4.407-6.644c0.822-1.423 0.654-3.244-0.503-4.505z"></path> </g> </g></svg>
            <span>Management</span>
        </a>

        <!-- Parent: Management -->

        <div id="Management" class="collapse @if (in_array(request()->segment(3), [
                        'email-management',
                        'sim-management',
                        'escorts-templates',
                        'centres-templates',
                        'e4u-templates',
                        'agent-templates',
                        'operator-templates',
                        'shareholder-templates',
                        'viewer-templates',
                        'set-fees',
                        'fee-discount',
                        'manage-user',
                        'memberships','report-credit',
                        'product',
                        'sim',
                        'legbox-report',
                        'agents-monthly-report',
                        'punterbox-reports',
                        'notebox',
                        'tours',
                        'staff',
                        'competitor-database',
                        'monthly-fee-reports',
                        'commission-summary',
                        'operator-manage',
                        'staff-manage',
                        'profile',
                        'agent',
                        'manage-suppliers',
                        'manage-influencers',
                        'manage-shareholders',
                        '-dashboard',
                        'dashboard','seo','messages',
                        'All-user',
                        'email-templates',
                        'annual-report',
                        'directors',
                        'portfolio',
                        'registrations',
                        'e4u-revenue',
                        'minutes',
                        'annual-profit-and-loss',
                        'balance-sheet',
                        'constitution',
                        'newsletter',
                        'shareholder-notices',
                        'email',
                        'subsidiaries-balance-sheet',
                        'subsidiaries-annual-profit-and-loss',
                        'updates',
                        'staff',
                        'credits',
                        'revenue',
                        'influencer',
                        'application',
                        'revision',
                        'security',
                        'shareholder',
                        'share-value',
                        'operator-staff',
                        'concierge-payments',
                        'agent-data',
                        'fees',
                        'operator'
                    ]) ||
                        request()->segment(2) == 'feedback' ||
                        in_array(request()->segment(4), [
                            'legal',
                            'community',
                            'other',
                            'about',
                            'concierge',
                            'global-notifications',
                            'agents-notifications',
                            'escorts-notifications',
                            'centres-notifications',
                            'shareholders-notifications',
                            'viewers-notifications',
                            'monthly-report',
                            'monthly-fee-reports'
                        ]) || request()->routeIs('management.*'))) show @endif"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">

            <div class="py-0 collapse-inner rounded mb-2">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <svg width="15" height="15" viewBox="0 0 18 19" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                            fill="#c2cfe0" />
                    </svg>
                    <span
                        style="{{ request()->segment(3) == 'dashboard' ? 'color: #FF3C5F;' : '' }}">Dashboard</span>
                </a>



                <a class="nav-link {{ request()->segment(3) == 'fees' ? '' : 'collapsed' }}" href="#"
                    data-toggle="collapse" data-target="#manageAgentMenu" aria-expanded="true"
                    aria-controls="manageAgentMenu">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                    <span>Agents</span>
                </a>
                <div id="manageAgentMenu" class="collapse @if (in_array(request()->segment(4), ['monthly-report', 'data-list'])) show @endif"
                    data-parent="#Management">


                    <a class="collapse-item" href="{{ route('admin.dashboard.agent.data-list') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                        <span
                            style="{{ request()->segment(4) == 'data-list' ? 'color: #FF3C5F;' : '' }}">Data
                            List (Centres)</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.agents-monthly-report') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                        <span
                            style="{{ request()->segment(4) == 'monthly-report' ? 'color: #FF3C5F;' : '' }}">Monthly
                            Report</span>
                    </a>

                </div>

                <!-- CMS Templates -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CMSMenu"
                    aria-expanded="false">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/cms.png') }}">
                    <span>CMS Templates</span>
                </a>

                <div id="CMSMenu" class="collapse @if (in_array(request()->segment(3), [
                                'escorts-templates',
                                'e4u-templates',
                                'agent-templates',
                                'operator-templates',
                                'shareholder-templates',
                                'viewer-templates',
                                'centres-templates',
                            ]) ||
                                in_array(request()->segment(4), [
                                    'legal',
                                    'community',
                                    'other',
                                    'about',
                                    'concierge',
                                    'global-notifications',
                                    'agents-notifications',
                                    'escorts-notifications',
                                    'centres-notifications',
                                    'shareholders-notifications',
                                    'viewers-notifications',
                                ])) show @endif"
                    data-parent="#Management">


                    <!-- Footer -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#Footer" aria-expanded="false" aria-controls="Footer">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/footer.png') }}">
                        <span>Footer</span>
                    </a>
                    <div id="Footer" class="collapse @if (in_array(request()->segment(4), ['other', 'legal', 'community'])) show @endif"
                        data-parent="#CMSMenu">

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

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#Header" aria-expanded="false" aria-controls="Header">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/header.png') }}">
                        <span>Header</span>
                    </a>
                    <div id="Header" class="collapse @if (in_array(request()->segment(4), ['about', 'concierge'])) show @endif"
                        data-parent="#CMSMenu">

                        <div class="py-0 collapse-inner rounded mb-2">
                            {{-- Legal --}}
                            <a href="" class="collapse-item">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/information.png') }}">
                                <span
                                    style="{{ request()->segment(4) == 'about' ? 'color: #FF3C5F;' : '' }}">About</span>
                            </a>
                            {{-- Community --}}

                            <a href="" class="collapse-item">
                                <img
                                    src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
                                <span
                                    style="{{ request()->segment(4) == 'concierge' ? 'color: #FF3C5F;' : '' }}">Concierge</span>
                            </a>


                        </div>
                    </div>
                    <!-- end -->



                    <!-- Notification -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#OMnotification" aria-expanded="false" aria-controls="OMnotification">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/global-notification.png') }}">
                        <span>Notifications<!----></span>
                    </a>
                    <div id="OMnotification" class="collapse @if (in_array(request()->segment(4), [
                                    'global-notifications',
                                    'agents-notifications',
                                    'escorts-notifications',
                                    'centres-notifications',
                                    'shareholders-notifications',
                                    'viewers-notifications',
                                ])) show @endif"
                        data-parent="#CMSMenu">

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
                                    style="{{ request()->segment(4) == 'centres-notifications' ? 'color: #FF3C5F;' : '' }}">Massage
                                    Centres</span>
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

                    <div id="CMSEmailMenu" class="collapse @if (in_array(request()->segment(3), [
                                    'escorts-templates',
                                    'e4u-templates',
                                    'agent-templates',
                                    'operator-templates',
                                    'shareholder-templates',
                                    'viewer-templates',
                                    'centres-templates',
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
                        <img src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'email-management' ? 'color: #FF3C5F;' : '' }}">Email
                            Management</span>
                    </a>


                    <a class="collapse-item" href="{{ route('sim-management') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'sim-management' ? 'color: #FF3C5F;' : '' }}">SIM
                            Management</span>
                    </a>
                </div>
                {{-- end --}}



                {{-- logs --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#logs"
                    aria-expanded="false" aria-controls="Website">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/log.png') }}">
                    <span>logs </span>
                </a>
                <div id="logs" class="collapse @if (in_array(request()->segment(3), ['application', 'revision', 'security'])) show @endif"
                    data-parent="#Management">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('admin.application') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/applog.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'application' ? 'color: #FF3C5F;' : '' }}">Application</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.revision') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/revision.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'revision' ? 'color: #FF3C5F;' : '' }}">Revision</span>
                        </a>

                        <a class="collapse-item" href="{{ route('admin.security') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/security.png') }}">
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
                <div id="managePeopleMenu" class="collapse @if (in_array(request()->segment(3), [
                                'staff',
                                'manage-suppliers',
                                'manage-influencers',
                                'operator-manage',
                                'manage-shareholders',
                                'agent',
                                'staff-manage',
                                'operator-staff',
                            ])) show @endif"
                    data-parent="#Management">
                    <a class="collapse-item" href="{{ route('admin.agent') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/manage-agents.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'agent' ? 'color: #FF3C5F;' : '' }}">Agents</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.staff') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/e4u-staff.png') }}">
                        <span style="{{ request()->segment(3) == 'staff' ? 'color: #FF3C5F;' : '' }}">
                            E4U Staff</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.manage-influencers') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/influencer-marketing.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'manage-influencers' ? 'color: #FF3C5F;' : '' }}">
                            Influencer</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.operator-manage') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/manage-operator.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'operator-manage' ? 'color: #FF3C5F;' : '' }}">
                            Operator</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.operator.staff') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/operator-staff.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'operator-staff' ? 'color: #FF3C5F;' : '' }}">
                            Operator Staff</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.manage-shareholders') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/shareholder.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'manage-shareholders' ? 'color: #FF3C5F;' : '' }}">
                            Shareholders</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.manage-suppliers') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/vendor.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'manage-suppliers' ? 'color: #FF3C5F;' : '' }}">
                            Suppliers</span>
                    </a>
                </div>

                <a class="nav-link" href="{{ route('admin.messages') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png') }}">
                    <span
                        style="{{ request()->segment(3) == 'messages' ? 'color: #FF3C5F;' : '' }}">Messages</span>
                </a>


                <!-- Operator -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#operatorMenu" aria-expanded="false" aria-controls="operatorMenu">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/operator.png') }}">
                    <span>Operator</span>
                </a>
                <div id="operatorMenu" class="collapse @if (in_array(request()->segment(4), ['monthly-fee-reports', 'commission-summary'])) show @endif"
                    data-parent="#Management">

                    <a class="collapse-item" href="{{ route('admin.commission-summary') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/fee-summary.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'commission-summary' ? 'color: #FF3C5F;' : '' }}">Fees
                            Summary</span>
                    </a>
                    <a class="collapse-item" href="{{ route('admin.monthly-fee-reports') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                        <span
                            style="{{ request()->segment(4) == 'monthly-fee-reports' ? 'color: #FF3C5F;' : '' }}">Monthly
                            Fee Reports</span>
                    </a>
                </div>


                <!-- Reporting -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#ReportingMenu" aria-expanded="false" aria-controls="ReportingMenu">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                    <span>Reporting</span>
                </a>
                <div id="ReportingMenu" class="collapse @if (request()->routeIs('management.reporting.*')) show @endif"
                    data-parent="#Management">

                    <a class="collapse-item" href="{{ route('management.reporting.concierge_payments') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/reconciliation.png') }}"
                            alt="">
                        <span
                            style="{{ request()->routeIs('management.reporting.concierge_payments') ? 'color: #FF3C5F;' : '' }}">Concierge
                            Payments</span>
                    </a>
                    <a class="collapse-item" href="{{ route('management.reporting.credit') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                        <span
                            style="{{ request()->routeIs('management.reporting.credit') ? 'color: #FF3C5F;' : '' }}">Credit</span>
                    </a>
                    <a class="collapse-item" href="{{ route('management.reporting.revenue') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/revenue-2.png') }}">
                        <span
                            style="{{ request()->routeIs('management.reporting.revenue') ? 'color: #FF3C5F;' : '' }}">Revenue</span>
                    </a>

                </div>
                <!-- Reports -->
                <a class="nav-link collapsed " href="#" data-toggle="collapse"
                    data-target="#ReportsMenu" aria-expanded="false" aria-controls="ReportsMenu">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                    <span>Reports</span>
                </a>


                <div id="ReportsMenu"
                    class="collapse @if (in_array(request()->segment(3), ['influencer', 'notebox'])) show @endif @if (request()->segment(2) == 'feedback') show @endif"
                    data-parent="#Management">



                    <a class="collapse-item" href="{{ route('admin.feedback') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'feedback' ? 'color: #FF3C5F;' : '' }}">Feedback
                        </span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.influencer') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/influencer.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'influencer' ? 'color: #FF3C5F;' : '' }}">Influencer</span>
                    </a>

                    <a class="collapse-item" href="{{ route('admin.notebox') }}">
                        <img src="{{ asset('assets/dashboard/img/MyNotebox.png') }}" style="filter: brightness(0) saturate(100%) invert(99%) sepia(5%) saturate(0%) hue-rotate(101deg) brightness(110%) contrast(100%);">

                        <span
                            style="{{ request()->segment(3) == 'notebox' ? 'color: #FF3C5F;' : '' }}">Notebox</span>
                    </a>

                </div>

                <a class="nav-link" href="{{ route('admin.seo') }}">
                    <svg height="15px" width="15px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#c2cfe0">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css">
                                .st0 {
                                    fill: #c2cfe0;
                                }
                            </style>
                            <g>
                                <path class="st0" d="M435.244,391.19c32.805-41.18,52.518-93.432,52.503-150.118c0.015-66.486-27.029-126.93-70.608-170.464 C373.593,27.021,313.149-0.016,246.667,0C180.181-0.016,119.742,27.021,76.2,70.608C32.616,114.142,5.576,174.586,5.591,241.072 C5.576,307.55,32.616,367.994,76.2,411.536c43.542,43.587,103.982,70.624,170.468,70.608c50.948,0.016,98.312-15.91,137.281-42.94 L456.756,512l49.653-49.653L435.244,391.19z M378.508,372.916c-33.826,33.773-80.267,54.591-131.841,54.606 c-51.574-0.015-98.015-20.833-131.845-54.606c-33.784-33.834-54.595-80.271-54.61-131.844 c0.015-51.574,20.826-98.011,54.61-131.844c33.83-33.78,80.271-54.591,131.845-54.606c51.574,0.015,98.014,20.826,131.841,54.606 c33.791,33.833,54.602,80.271,54.617,131.844C433.11,292.646,412.299,339.082,378.508,372.916z"></path>
                                <path class="st0" d="M155.926,235.105l-5.696-0.792c-14.558-2.058-19.782-7.117-19.782-14.555c0-8.389,6.012-14.402,16.932-14.402 c9.018,0,17.088,2.691,25.794,8.39c0.789,0.473,1.582,0.313,2.214-0.48l7.597-11.704c0.633-0.953,0.473-1.585-0.32-2.218 c-8.542-6.484-21.359-10.76-34.809-10.76c-22.156,0-36.398,12.977-36.398,32.44c0,17.877,11.712,27.852,32.44,30.694l5.696,0.792 c14.875,2.058,19.622,7.125,19.622,14.875c0,9.022-7.437,15.507-20.255,15.507c-12.024,0-22.312-5.852-29.273-11.392 c-0.632-0.632-1.581-0.632-2.214,0.16l-9.811,11.392c-0.632,0.792-0.316,1.737,0.316,2.378 c8.386,7.909,23.733,14.234,39.561,14.234c26.739,0,40.509-14.234,40.509-33.384C188.049,247.762,176.652,237.956,155.926,235.105z "></path>
                                <path class="st0" d="M275.566,190.322h-67.408c-0.949,0-1.581,0.632-1.581,1.585v104.435c0,0.953,0.632,1.585,1.581,1.585h67.408 c0.953,0,1.585-0.632,1.585-1.585v-13.602c0-0.952-0.632-1.585-1.585-1.585h-49.368l-0.949-0.953V252.99l0.949-0.952h41.614 c0.953,0,1.586-0.633,1.586-1.586v-13.609c0-0.945-0.633-1.577-1.586-1.577h-41.614l-0.949-0.953v-26.266l0.949-0.945h49.368 c0.953,0,1.585-0.64,1.585-1.585v-13.61C277.151,190.954,276.519,190.322,275.566,190.322z"></path>
                                <path class="st0" d="M334.448,188.584c-18.514,0-32.439,8.863-37.975,25.954c-2.218,6.645-2.85,12.658-2.85,29.589 c0,16.932,0.632,22.944,2.85,29.589c5.536,17.092,19.462,25.947,37.975,25.947c18.677,0,32.591-8.855,38.139-25.947 c2.21-6.645,2.85-12.657,2.85-29.589c0-16.932-0.64-22.944-2.85-29.589C367.039,197.447,353.124,188.584,334.448,188.584z M354.542,268.81c-3.003,8.702-9.327,14.082-20.095,14.082c-10.6,0-16.932-5.38-19.938-14.082 c-1.265-3.955-1.898-9.495-1.898-24.682c0-15.355,0.633-20.734,1.898-24.69c3.007-8.702,9.339-14.082,19.938-14.082 c10.768,0,17.092,5.38,20.095,14.082c1.265,3.955,1.904,9.335,1.904,24.69C356.447,259.315,355.807,264.854,354.542,268.81z"></path>
                            </g>
                        </g>
                    </svg>
                    <span
                        style="{{ request()->segment(3) == 'seo' ? 'color: #FF3C5F;' : '' }}">SEO</span>
                </a>

                <!-- Settings -->
                <a class="nav-link  collapsed" href="#" data-toggle="collapse"
                    data-target="#SettingsMenu" aria-expanded="false" aria-controls="SettingsMenu">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/settings.png') }}">
                    <span>Settings</span>
                </a>
                <div id="SettingsMenu" class="collapse @if (in_array(request()->segment(3), ['All-user', 'set-fees', 'fee-discount'])) show @endif"
                    data-parent="#Management">


                    <a class="collapse-item" href="{{ route('fee-discount') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/fee.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'fee-discount' ? 'color: #FF3C5F;' : '' }}">Fee
                            Discounts</span>
                    </a>


                    <a class="collapse-item" href="{{ route('admin.set-fees') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/fee.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'set-fees' ? 'color: #FF3C5F;' : '' }}">Fees
                            & Variables</span>
                    </a>


                    <a class="collapse-item" href="{{ route('admin.management.allUser') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/security-and-access.png') }}">
                        <span
                            style="{{ request()->segment(3) == 'All-user' ? 'color: #FF3C5F;' : '' }}">Security
                            & Access</span>
                    </a>

                </div>

                {{-- Shareholders --}}
                <a class="nav-link  collapsed" href="#" data-toggle="collapse"
                    data-target="#ShareholdersMenu" aria-expanded="false"
                    aria-controls="ShareholdersMenu">
                    <img src="{{ asset('assets//dashboard/img/menu-icon/profit.png') }}">
                    <span>Shareholders</span>
                </a>
                <div id="ShareholdersMenu" class="collapse @if (in_array(request()->segment(3), [
                                'annual-report',
                                'directors',
                                'portfolio',
                                'annual-profit-and-loss',
                                'balance-sheet',
                                'constitution',
                                'minutes',
                                'newsletter',
                                'shareholder-notices',
                                'registrations',
                                'e4u-revenue',
                                'subsidiaries-balance-sheet',
                                'subsidiaries-annual-profit-and-loss',
                                'updates',
                                'shareholder',
                                'share-value',
                            ])) show @endif"
                    data-parent="#Management">

                    <!--  Blackbox Tech Pty Ltd -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#Blackbox" aria-expanded="false" aria-controls="Blackbox">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/box.png') }}">
                        <span>Blackbox Tech...</span>
                    </a>
                    <div id="Blackbox" class="collapse @if (in_array(request()->segment(3), ['annual-report', 'directors', 'portfolio'])) show @endif"
                        data-parent="#ShareholdersMenu">

                        <div class="py-0 collapse-inner rounded mb-2">

                            {{-- Annual Report  --}}
                            <a class="collapse-item" href="{{ route('admin.annual-report') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'annual-report' ? 'color: #FF3C5F;' : '' }}">Annual
                                    Report</span>
                            </a>
                            {{-- end --}}

                            {{-- Directors  --}}
                            <a class="collapse-item" href="{{ route('admin.directors') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/directors.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'directors' ? 'color: #FF3C5F;' : '' }}">Directors</span>
                            </a>
                            {{-- end --}}

                            {{-- Portfolio  --}}
                            <a class="collapse-item" href="{{ route('admin.portfolio') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/portfolio.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'portfolio' ? 'color: #FF3C5F;' : '' }}">Portfolio</span>
                            </a>
                            {{-- end --}}

                        </div>
                    </div>
                    <!-- end -->


                    <!--  Communications -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#SHCommunications" aria-expanded="false"
                        aria-controls="SHCommunications">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/communication.png') }}">
                        <span>Communications</span>
                    </a>
                    <div id="SHCommunications"
                        class="collapse @if (in_array(request()->segment(3), ['newsletter', 'shareholder-notices'])) show @endif"
                        data-parent="#ShareholdersMenu">

                        <div class="py-0 collapse-inner rounded mb-2">
                            <a class="collapse-item" href="{{ route('admin.newsletter') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/newsletter.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'newsletter' ? 'color: #FF3C5F;' : '' }}">Newsletter</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.shareholder-notices') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/share-notice.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'shareholder-notices' ? 'color: #FF3C5F;' : '' }}">Shareholder
                                    Notices</span>
                            </a>


                        </div>
                    </div>
                    <!-- end -->


                    <!--  E4U Information -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#E4UInformation" aria-expanded="false"
                        aria-controls="E4UInformation">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/information.png') }}">
                        <span>E4U Information</span>
                    </a>
                    <div id="E4UInformation"
                        class="collapse @if (in_array(request()->segment(3), ['registrations', 'e4u-revenue'])) show @endif"
                        data-parent="#ShareholdersMenu">

                        <div class="py-0 collapse-inner rounded mb-2">
                            <a class="collapse-item" href="{{ route('admin.registrations') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'registrations' ? 'color: #FF3C5F;' : '' }}">Registrations</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.e4u-revenue') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/revenue-2.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'e4u-revenue' ? 'color: #FF3C5F;' : '' }}">Revenue</span>
                            </a>


                        </div>
                    </div>
                    <!-- end -->


                    <!--  Shareholder Documents -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ShareholderDocuments" aria-expanded="false"
                        aria-controls="ShareholderDocuments">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/shareholders-docs.png') }}">
                        <span>Shareholder Docs</span>
                    </a>
                    <div id="ShareholderDocuments"
                        class="collapse @if (in_array(request()->segment(3), ['annual-profit-and-loss', 'balance-sheet', 'constitution', 'minutes', 'updates'])) show @endif"
                        data-parent="#ShareholdersMenu">

                        <div class="py-0 collapse-inner rounded mb-2">

                            <a class="collapse-item" href="{{ route('admin.annual-profit-and-loss') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'annual-profit-and-loss' ? 'color: #FF3C5F;' : '' }}">Annual
                                    Profit & Loss</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.balance-sheet') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/balance-sheet.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'balance-sheet' ? 'color: #FF3C5F;' : '' }}">Balance
                                    Sheet</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.constitution') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/constitution.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'constitution' ? 'color: #FF3C5F;' : '' }}">Constitution</span>
                            </a>


                            <a class="collapse-item" href="{{ route('admin.minutes') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/share-time.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'minutes' ? 'color: #FF3C5F;' : '' }}">Shareholder
                                    Minutes</span>
                            </a>

                            <a class="collapse-item" href="{{ route('admin.updates') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/share-upload.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'updates' ? 'color: #FF3C5F;' : '' }}">Shareholder
                                    Updates</span>
                            </a>
                        </div>
                    </div>
                    <!-- end -->


                    <!--  Share Register -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ShareRegister" aria-expanded="false" aria-controls="ShareRegister">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/share-reg.png') }}">
                        <span>Share Register</span>
                    </a>
                    <div id="ShareRegister" class="collapse @if (in_array(request()->segment(3), ['shareholder', 'share-value'])) show @endif"
                        data-parent="#ShareholdersMenu">

                        <div class="py-0 collapse-inner rounded mb-2">
                            <a class="collapse-item" href="{{ route('admin.shareholder') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/shareholder.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'shareholder' ? 'color: #FF3C5F;' : '' }}">Shareholders</span>
                            </a>
                            <a class="collapse-item" href="{{ route('admin.share-value') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/share-value.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'share-value' ? 'color: #FF3C5F;' : '' }}">Share
                                    Value</span>
                            </a>
                        </div>
                    </div>
                    <!-- end -->


                    <!--  Subsidiaries -->

                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#Subsidiaries" aria-expanded="false" aria-controls="Subsidiaries">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/subsidiaries.png') }}">
                        <span>Subsidiaries</span>
                    </a>
                    <div id="Subsidiaries" class="collapse @if (in_array(request()->segment(3), ['subsidiaries-balance-sheet', 'subsidiaries-annual-profit-and-loss'])) show @endif"
                        data-parent="#ShareholdersMenu">

                        <div class="py-0 collapse-inner rounded mb-2">

                            <a class="collapse-item"
                                href="{{ route('admin.subsidiaries-annual-profit-and-loss') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'subsidiaries-annual-profit-and-loss' ? 'color: #FF3C5F;' : '' }}">Annual
                                    Profit & Loss</span>
                            </a>

                            <a class="collapse-item"
                                href="{{ route('admin.subsidiaries-balance-sheet') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/balance-sheet.png') }}">
                                <span
                                    style="{{ request()->segment(3) == 'subsidiaries-balance-sheet' ? 'color: #FF3C5F;' : '' }}">Balance
                                    Sheet</span>
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
                <div id="statisticsMenu" class="collapse @if (request()->routeIs('management.statistics.*')) show @endif "
                    data-parent="#Management">

                    <a class="collapse-item" href="{{ route('management.statistics.email') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                        <span
                            style="{{ request()->routeIs('management.statistics.email') ? 'color: #FF3C5F;' : '' }}">Email</span>
                    </a>
                    <a class="collapse-item" href="{{ route('management.statistics.membership') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/membership.png') }}">
                        <span style="{{ request()->routeIs('management.statistics.membership') ? 'color: #FF3C5F;' : '' }}">
                            Memberships</span>
                    </a>
                    <a class="collapse-item" href="{{ route('management.statistics.product') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/pro-pro.png') }}">
                        <span
                            style="{{ request()->routeIs('management.statistics.product') ? 'color: #FF3C5F;' : '' }}">Product</span>
                    </a>
                    <a class="collapse-item" href="{{ route('management.statistics.profile') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                        <span
                            style="{{ request()->routeIs('management.statistics.profile') ? 'color: #FF3C5F;' : '' }}">Profile</span>
                    </a>
                    <a class="collapse-item" href="{{ route('management.statistics.sim') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/sim-manage.png') }}">
                        <span
                            style="{{ request()->routeIs('management.statistics.sim') ? 'color: #FF3C5F;' : '' }}">SIM</span>
                    </a>
                    <a class="collapse-item" href="{{ route('management.statistics.tour') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/tour-summary.png') }}">
                        <span
                            style="{{ request()->routeIs('management.statistics.tour') ? 'color: #FF3C5F;' : '' }}">Tours</span>
                    </a>
                </div>


            </div>
        </div>
    </li>
    @endif

     <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount"
            aria-expanded="false" aria-controls="collapseTwo">
            <svg fill="#0c223d" width="64px" height="64px" viewBox="-7.2 -7.2 38.40 38.40" xmlns="http://www.w3.org/2000/svg" stroke="#0c223d"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-7.2" y="-7.2" width="38.40" height="38.40" rx="19.2" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>Account Settings</title><path d="M9.6,3.32a3.86,3.86,0,1,0,3.86,3.85A3.85,3.85,0,0,0,9.6,3.32M16.35,11a.26.26,0,0,0-.25.21l-.18,1.27a4.63,4.63,0,0,0-.82.45l-1.2-.48a.3.3,0,0,0-.3.13l-1,1.66a.24.24,0,0,0,.06.31l1,.79a3.94,3.94,0,0,0,0,1l-1,.79a.23.23,0,0,0-.06.3l1,1.67c.06.13.19.13.3.13l1.2-.49a3.85,3.85,0,0,0,.82.46l.18,1.27a.24.24,0,0,0,.25.2h1.93a.24.24,0,0,0,.23-.2l.18-1.27a5,5,0,0,0,.81-.46l1.19.49c.12,0,.25,0,.32-.13l1-1.67a.23.23,0,0,0-.06-.3l-1-.79a4,4,0,0,0,0-.49,2.67,2.67,0,0,0,0-.48l1-.79a.25.25,0,0,0,.06-.31l-1-1.66c-.06-.13-.19-.13-.31-.13L19.5,13a4.07,4.07,0,0,0-.82-.45l-.18-1.27a.23.23,0,0,0-.22-.21H16.46M9.71,13C5.45,13,2,14.7,2,16.83v1.92h9.33a6.65,6.65,0,0,1,0-5.69A13.56,13.56,0,0,0,9.71,13m7.6,1.43a1.45,1.45,0,1,1,0,2.89,1.45,1.45,0,0,1,0-2.89Z"></path></g></svg>
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
                    <span style="{{ request()->segment(2) == 'update-account' ? 'color: #FF3C5F;' : '' }}">My account</span></a>
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
    <li style="padding-bottom: 50px;">
        
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

        let toggleIconbtn = document.querySelector(".toggle-icon");
        let sidebar = document.querySelector(".db-custom-sidebar");
        toggleIconbtn.addEventListener("click", function(){
            sidebar.classList.toggle("toggled");        
            this.classList.toggle("fa-toggle-off");
            this.classList.toggle("fa-toggle-on");
        });
    });
  
</script>
<!-- End of Sidebar -->