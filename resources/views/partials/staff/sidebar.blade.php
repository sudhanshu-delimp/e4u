@php
    $securityLevel = isset(auth()->user()->staff_detail->security_level) ? auth()->user()->staff_detail->security_level: 0;
    $sidebar = staffPageAccessPermission( $securityLevel, 'sidebar'); 
@endphp
<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-3" href="{{ asset('/') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " alt="">
    </a>
    <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-4">Staff Console</span>
    <!-- Divider -->
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('staff.dashboard') }}" id="dashboard">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="white" />
            </svg>
            <span id="dash"
                style="{{ $_SERVER['REQUEST_URI'] == '/staff-dashboard' ? 'color: #e5365a;' : '' }}">Dashboard</span>
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
                    
                    <a class="collapse-item" href="{{ route('staff.escort-listings', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}">
                        <span style="{{ request()->is('*escort-listings*') ? 'color: #e5365a;' : '' }}">Escort
                            Listings</span>
                    </a>

                    <a class="collapse-item" href="{{ route('staff.massage-centre-listings', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png') }}">
                        <span
                            style="{{ request()->is('*massage-centre-listings*') ? 'color: #e5365a;' : '' }}">Massage
                            Centre Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('staff.pin-up-listings', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*pinup-listings*') ? 'color: #e5365a;' : '' }}">Pin Up
                            Listings</span>
                    </a>
                    <a class="collapse-item" href="{{ route('staff.logged-in-users', ['from' => 'sidebar']) }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/login-user.png') }}">
                        <span style="{{ request()->is('*logged-in-users*') ? 'color: #e5365a;' : '' }}">Users Logged
                            In</span>
                    </a>
                    <a class="collapse-item" href="{{ route('staff.visitors') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/visitors.png') }}">
                        <span style="{{ request()->is('*visitors*') ? 'color: #e5365a;' : '' }}">Visitors</span>
                    </a>
                </div>
            </div>
        </li>

       
    <!-- Divider -->
    <!-- Heading -->
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                    fill="#C2CFE0" />
            </svg>
            <span>My Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if (request()->segment(2) == 'update-account' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'notifications-and-features' ||
                request()->segment(2) == 'upload-avatar' ||
                request()->segment(2) == 'bank_account') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded pb-0 mb-0 pt-0">
                <a class="collapse-item" href="{{ route('staff.account.edit') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'update-account' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">
                        Edit my account</span>
                </a>
                <a class="collapse-item" href="{{ route('staff.change.password') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'change-password' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Change
                        password</span>
                </a>
                <a class="collapse-item" href="{{ route('staff.profile.avatar') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'upload-avatar' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Upload
                        my avatar</span>
                </a>
            </div>
        </div>
    </li>
        <li
            style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px;margin-top: 10px;margin-bottom: 15px;">
        </li>
        @if(isset($sidebar['management']['yesNo']) && $sidebar['management']['yesNo'] == 'yes')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management"
                aria-expanded="false" aria-controls="Management">
                <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
                <span>Management</span>
            </a>
        
            <!-- Parent: Management -->
            <div id="Management"
                 class="collapse @if(in_array(request()->segment(3), [
                     'email-management','sim-management','logs-staff',
                     'marketing-templates-e4u','marketing-templates-agents','post-office',
                     'set-fees','manage-user','memberships','legbox-report',
                     'punterbox-reports','tours','staff','competitor-database',
                     'commission-statements','commission-summary','operator-manage',
                     'profile','agent','manage-suppliers'
                 ]) || request()->segment(2) == 'All-user') show @endif"
                 aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        
                <div class="py-0 collapse-inner rounded mb-2">

                     <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                       data-target="#manageAgentMenu" aria-expanded="false" aria-controls="manageAgentMenu">
                        <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                        <span>Agents </span>
                    </a>
                    <div id="manageAgentMenu"
                         class="collapse @if(in_array(request()->segment(3), ['Agent'])) show @endif pl-3"
                         style="margin-left: 10px;">
                        
                        <a class="collapse-item" href="{{ route('staff.agent') }}">
                            <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                            <span style="{{ request()->segment(3) == 'agent' ? 'color: #e5365a;' : '' }}">Manage Agents</span>
                        </a>
                       
                    </div>

                    <!-- Manage People -->
                    <a class="nav-link collapse-item collapsed" href="#" data-toggle="collapse"
                       data-target="#managePeopleMenu" aria-expanded="false" aria-controls="managePeopleMenu">
                        <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                        <span>Manage People</span>
                    </a>
                    <div id="managePeopleMenu"
                         class="collapse @if(in_array(request()->segment(3), ['staff','manage-suppliers'])) show @endif pl-3"
                         style="margin-left: 10px;">
                        <a class="collapse-item" href="{{ route('staff.staff') }}">
                            <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                            <span style="{{ request()->segment(3) == 'staff' ? 'color: #e5365a;' : '' }}">Manage Staff</span>
                        </a>
                       {{-- 
                        <a class="collapse-item" href="{{ route('admin.manage-suppliers') }}">
                            <img width="16" height="17" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                            <span style="{{ request()->segment(3) == 'manage-suppliers' ? 'color: #e5365a;' : '' }}">Manage Suppliers</span>
                        </a> --}}
                    </div>

                </div> 
             
             
                </div>        
        </li>
        @endif
    
</ul>
<!-- End of Sidebar -->
