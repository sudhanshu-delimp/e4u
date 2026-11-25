 @php 
 $hideNavBar = false;
 if(session()->has('parent_agent_id') && session('switch_for') == 'agent_to_massage' && session('is_impersonated') === true){
    $hideNavBar = true;
 }
 @endphp
<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar"
    id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-1" href="{{ route('home') }}">
        <img src="{{ asset('assets/images/escorts4u-logo.svg') }}" class="mb-3 e4u_logo" alt="">
    </a>
    <span class="console_heading">Massage Centre Console</span>
    <!-- Divider -->
   

    {{-- My Account --}}
    <li class="nav-item {{$hideNavBar ? ' d-none': ' '}}" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="false" aria-controls="collapseTwo">

             <svg fill="#0c223d" width="64px" height="64px" viewBox="-7.2 -7.2 38.40 38.40" xmlns="http://www.w3.org/2000/svg" stroke="#0c223d"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-7.2" y="-7.2" width="38.40" height="38.40" rx="19.2" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>Account Settings</title><path d="M9.6,3.32a3.86,3.86,0,1,0,3.86,3.85A3.85,3.85,0,0,0,9.6,3.32M16.35,11a.26.26,0,0,0-.25.21l-.18,1.27a4.63,4.63,0,0,0-.82.45l-1.2-.48a.3.3,0,0,0-.3.13l-1,1.66a.24.24,0,0,0,.06.31l1,.79a3.94,3.94,0,0,0,0,1l-1,.79a.23.23,0,0,0-.06.3l1,1.67c.06.13.19.13.3.13l1.2-.49a3.85,3.85,0,0,0,.82.46l.18,1.27a.24.24,0,0,0,.25.2h1.93a.24.24,0,0,0,.23-.2l.18-1.27a5,5,0,0,0,.81-.46l1.19.49c.12,0,.25,0,.32-.13l1-1.67a.23.23,0,0,0-.06-.3l-1-.79a4,4,0,0,0,0-.49,2.67,2.67,0,0,0,0-.48l1-.79a.25.25,0,0,0,.06-.31l-1-1.66c-.06-.13-.19-.13-.31-.13L19.5,13a4.07,4.07,0,0,0-.82-.45l-.18-1.27a.23.23,0,0,0-.22-.21H16.46M9.71,13C5.45,13,2,14.7,2,16.83v1.92h9.33a6.65,6.65,0,0,1,0-5.69A13.56,13.56,0,0,0,9.71,13m7.6,1.43a1.45,1.45,0,1,1,0,2.89,1.45,1.45,0,0,1,0-2.89Z"></path></g></svg>
            <span>Our Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if (request()->segment(2) == 'update-account' ||
                request()->segment(2) == 'profile-informations' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'notifications-and-features' ||
                request()->segment(2) == 'upload-my-avatar') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('center.account.edit') }}">

                    <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                    <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">Edit Our
                        Account</span></a>
                <a class="collapse-item" href="{{ route('center.profile.information') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">

                    <span style="{{ request()->segment(2) == 'profile-informations' ? 'color: #e5365a;' : '' }}">Profile
                        information</span></a>
                <a class="collapse-item {{ canManage() ? '': 'd-none'}}" href="{{ route('center.change.password') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                    <span style="{{ request()->segment(2) == 'change-password' ? 'color: #e5365a;' : '' }}">Change
                        password</span></a>

                <a class="collapse-item" href="{{ route('centre.notifications-and-features') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                    <span
                        style="{{ request()->segment(2) == 'notifications-and-features' ? 'color: #e5365a;' : '' }}">Notifications
                        & Features</span></a>
                <a class="collapse-item {{ canManage() ? '': 'd-none'}}" href="{{ route('center.profile.avatar') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                    <span style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload my
                        avatar</span></a>

            </div>
        </div>
    </li>
    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    <li class="nav-item">

        {{-- Profile Management --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ProfileManagement">
                       <svg fill="#000000" height="64px" width="64px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-89.1 -89.1 475.20 475.20" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-89.1" y="-89.1" width="475.20" height="475.20" rx="237.6" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="m112.632,185.074l6.88-3.972c2.804-1.619 3.765-5.205 2.146-8.01l-13.036-22.579c-1.086-1.881-3.057-2.933-5.083-2.933-0.995,0-2.003,0.253-2.926,0.787l-6.88,3.972c-0.945,0.545-1.947,0.794-2.923,0.794-3.063,0-5.872-2.449-5.872-5.872v-7.944c0-3.238-2.625-5.864-5.864-5.864h-26.073c-3.238,0-5.864,2.625-5.864,5.864v7.944c0,3.423-2.81,5.872-5.872,5.872-0.976,0-1.978-0.249-2.923-0.794l-6.88-3.972c-0.923-0.533-1.932-0.786-2.926-0.787-2.027,0-3.997,1.052-5.083,2.933l-13.036,22.579c-1.619,2.805-0.658,6.391 2.146,8.01l6.88,3.972c3.909,2.257 3.909,7.899 0,10.156l-6.88,3.972c-2.805,1.619-3.765,5.205-2.146,8.01l13.036,22.579c1.086,1.881 3.057,2.933 5.083,2.933 0.995,0 2.003-0.254 2.926-0.787l6.88-3.972c0.945-0.545 1.947-0.794 2.923-0.794 3.063,0 5.872,2.449 5.872,5.872v7.944c0,3.238 2.625,5.864 5.864,5.864h26.072c3.238,0 5.864-2.625 5.864-5.864v-7.944c0-3.423 2.81-5.872 5.872-5.872 0.976,0 1.978,0.249 2.923,0.794l6.88,3.972c0.923,0.533 1.932,0.787 2.926,0.787 2.027,0 3.997-1.052 5.083-2.933l13.036-22.579c1.619-2.805 0.658-6.391-2.146-8.01l-6.88-3.972c-3.908-2.257-3.908-7.9 0.001-10.156zm-46.594,22.474c-9.608,0-17.396-7.789-17.396-17.396 0-9.608 7.789-17.396 17.396-17.396s17.396,7.789 17.396,17.396c0,9.607-7.789,17.396-17.396,17.396z"></path> <path d="m108.109,23.659c-3.146-3.144-8.243-3.144-11.389,0-3.145,3.146-3.145,8.244 0,11.389l14.39,14.389c-52.889,2.619-95.701,44.162-100.334,96.506l1.19-2.062c3.406-5.9 9.756-9.565 16.57-9.564 0.144,0 0.287,0.013 0.431,0.017 9.074-37.721 41.965-66.251 81.815-68.729l-14.062,14.061c-3.145,3.145-3.145,8.244 0,11.389 1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358l28.004-28.004c1.51-1.511 2.358-3.559 2.358-5.694 0-2.136-0.848-4.184-2.358-5.694l-28.003-28.004z"></path> <path d="m209.868,64.857c17.881,0 32.428-14.547 32.428-32.428 0-17.882-14.547-32.429-32.428-32.429-17.881,0-32.428,14.547-32.428,32.428 0,17.881 14.547,32.429 32.428,32.429z"></path> <path d="m273.039,152.276v-44.58c0-12.34-7.93-23.283-19.657-27.124l-.054-.018-17.152-2.84c-1.46-0.449-3.02,0.324-3.545,1.764l-19.462,53.399c-1.123,3.081-5.48,3.081-6.602,0l-19.462-53.399c-0.424-1.163-1.522-1.892-2.698-1.892-0.279,0-17.999,2.964-17.999,2.964-11.823,3.94-19.723,14.9-19.723,27.294v44.432c0,6.659 5.398,12.056 12.056,12.056h102.241c6.66-2.84217e-14 12.057-5.398 12.057-12.056z"></path> <path d="m287.37,162.933c-0.673,9.215-8.233,14.858-17.45,15.526-7.062,40.425-41.207,71.64-82.979,74.237l14.061-14.061c3.145-3.146 3.145-8.244 0-11.389-3.146-3.144-8.243-3.144-11.389,0l-28.003,28.004c-3.145,3.146-3.145,8.244 0,11.389l28.003,28.003c1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358c3.145-3.145 3.145-8.244 0-11.389l-14.389-14.389c56.028-2.774 100.758-49.227 100.758-105.931z"></path> <path d="m216.936,77.105c-0.747-0.814-1.84-1.224-2.946-1.224h-8.245c-1.105,0-2.198,0.41-2.946,1.224-1.157,1.261-1.325,3.082-0.504,4.505l4.407,6.644-2.063,17.405 4.063,10.808c0.396,1.087 1.933,1.087 2.33,0l4.063-10.808-2.063-17.405 4.407-6.644c0.822-1.423 0.654-3.244-0.503-4.505z"></path> </g> </g></svg>
            <span>Manage Profile</span>
        </a>

        <div id="ProfileManagement" class="collapse
                @if (in_array(request()->segment(3), ['add-listing', 'current', 'past', 'new-listing', 'videos']) ||
                        in_array(request()->segment(2), ['create-profile', 'list', 'archive-view-photos', 'create-new-masseur','archives-listing','update-masseur','update-profile'])) show @endif"
            data-parent="#accordionSidebar">

            <div class="collapse-inner">

                {{-- Listings --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ProfileListings">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/pachive.png') }}">

                    <span>Listings</span>
                </a>
                <div id="ProfileListings"
                    class="collapse 
                    @if (in_array(request()->segment(3), ['add-listing', 'current', 'past'])) show @endif"
                    data-parent="#ProfileManagement">

                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item {{ request()->segment(3) == 'add-listing' ? 'menu-active' : '' }} {{ canManage() ? '': 'd-none'}}"
                            href="{{ route('center.add-listing') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png') }}">
                            <span>New</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(3) == 'current' ? 'menu-active' : '' }}"
                            href="{{ route('center.current') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                            <span>Current</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(3) == 'past' ? 'menu-active' : '' }}"
                            href="{{ route('center.past') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png') }}">
                            <span>Past</span>
                        </a>
                    </div>
                </div>
                {{-- end --}}

                {{-- Profile --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ManageProfile">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/add-profile-centre.png') }}">
                    <span>Profiles</span>
                </a>

                <div id="ManageProfile"
                    class="collapse
                    @if (in_array(request()->segment(2), ['create-profile', 'list','update-profile'])) show @endif"
                    data-parent="#ProfileManagement">

                    <div class="py-0 collapse-inner rounded mb-2">

                      {{--   <a class="collapse-item {{ canManage() ? '': 'd-none'}}" {{ request()->segment(2) == 'create-profile' ? 'menu-active' : '' }}"
                            href="{{ route('center.profile') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png') }}">
                            <span>New Profile</span>
                        </a>
                    --}}

                        <a class="collapse-item {{ in_array(request()->segment(2), ['list', 'profile','update-profile']) ? 'menu-active' : '' }}"
                            href="{{ route('center.list') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                            <span>Our Profiles </span>
                        </a>

                    </div>
                </div>


                {{-- Masseurs --}}
                <a class="nav-link collapsed  href="#" data-toggle="collapse" data-target="#CenterMasseurs">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/masseur-profile.png') }}">
                    <span>Masseurs </span>
                </a>

                <div id="CenterMasseurs" class="collapse"
                    
                    @if (in_array(request()->segment(2), ['create-new-masseur','archives-listing','update-masseur'] )) show @endif"
                    data-parent="#ProfileManagement">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ canManage() ? '': 'd-none'}} {{ request()->segment(2) == 'create-new-masseur' ? 'menu-active' : '' }}"
                            href="{{ route('center.create-new-masseur') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png') }}">
                            <span>New</span>
                        </a>

                        <a class="collapse-item {{ (request()->segment(2) == 'archives-listing' || request()->segment(2) == 'update-masseur') ? 'menu-active' : '' }}"
                            href="{{ route('center.archives-listing') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png') }}">
                            <span>Manage</span>
                        </a>

                    </div>
                </div>

                {{-- Media Centre --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CenterMedia">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/media-centre.png') }}">
                    <span>Media</span>
                </a>

                <div id="CenterMedia"
                    class="collapse
                   @if (request()->segment(2) == 'archive-view-photos' || request()->segment(3) == 'videos') show @endif"
                    data-parent="#ProfileManagement">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'archive-view-photos' ? 'menu-active' : '' }}"
                            href="{{ route('cen.archive-view-photos') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/photo.png') }}">
                            <span>Photos</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(3) == 'videos' ? 'menu-active' : '' }}"
                            href="{{ route('center.videos') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/video.png') }}">
                            <span>Videos</span>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </li>
   
    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    <li class="nav-item {{ canManage() ? '': 'd-none'}}">

        {{-- Administration --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminTab">
            <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
            <span>Administration</span>
        </a>
        <div id="AdminTab" class="collapse
                @if (in_array(request()->segment(3), []) ||
                        in_array(request()->segment(2), [
                            'profiles',
                            'social-media',
                            'feedback',
                            'bookkeeping',
                            'agent-request',
                            'agent-messages',
                            'legbox-notification',
                            'viewer-notes',
                            'legbox-viewers',
                            'Community',
                            'help',
                            'laws',
                            'pricing',
                            'accommodation',
                            'email-hosting',
                            'mobile-read-sim',
                            'professional-products',
                            'travel',
                            'visa',
                            'editmyaccount',
                            'profile-information',
                            'listings',
                            'profiles-centre',
                            'media_centre',
                            'profiles-masseurs',
                            'media-masseurs',
                            'num-dashboard',
                            'add-report',
                            'my-reports',
                            'num-tips',
                            'ticket-list','masseurs'
                        ]) ||
                        in_array(request()->segment(1), ['submit_ticket'])) show @endif"
            data-parent="#accordionSidebar">

            <div class="collapse-inner">
                {{-- Analytics --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CenterAnalytics">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                    <span>Analytics</span>
                </a>

                <div id="CenterAnalytics"
                    class="collapse
                        @if (in_array(request()->segment(2), ['feedback', 'profiles', 'social-media', 'masseurs'])) show @endif"
                    data-parent="#AdminTab">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'feedback' ? 'menu-active' : '' }}"
                            href="{{ route('feedback') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/feedback-22.png') }}">
                            <span>Feedback</span>
                        </a>
                        
                         <a class="collapse-item {{ request()->segment(2) == 'masseurs' ? 'menu-active' : '' }}"
                            href="{{ route('masseurs') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/profiles.png') }}">
                            <span>Masseurs</span>
                        </a>
                        
                        <a class="collapse-item {{ request()->segment(2) == 'profiles' ? 'menu-active' : '' }}"
                            href="{{ route('profiles') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                            <span>Profiles</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'social-media' ? 'menu-active' : '' }}"
                            href="{{ route('social-media') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span>Social Media</span>
                        </a>

                    </div>
                </div>
                {{-- Bookkeeping --}}
                {{-- <a class="nav-link collapsed {{ request()->routeIs('center.bookkeeping') ? 'menu-active' : '' }}"
                    href="{{ route('center.bookkeeping') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/bookshelf.png') }}">
                    <span>
                        Bookkeeping
                    </span>
                </a> --}}

                  <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#ManagementBookkeeping">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/bookshelf.png') }}">
                    <span>Bookkeeping</span>
                </a>
 
                <div id="ManagementBookkeeping"
                    class="collapse
                    @if (in_array(request()->segment(2), ['bookkeeping'])) show @endif"
                    data-parent="#AdminTab">
 
                    <a class="collapse-item {{ request()->routeIs('center.bookkeeping') ? 'menu-active' : '' }}"
                    href="{{ route('center.bookkeeping') }}">
                        <img src="{{ asset('assets/app/img/sales-performance.png') }}">
                        <span>Bank Account</span>
                    </a>
                    {{-- <a class="collapse-item {{ request()->segment(2) == 'credit-my-account' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/credit-my-account') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/credit-card-plus.png') }}">
                        <span>Add Credit</span>
                    </a>
                    <a class="collapse-item {{ request()->segment(2) == 'transaction-summary' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/transaction-summary') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/credit-card-settings.png') }}">
                        <span>Transaction Summary</span></a> --}}
                </div>

                {{-- Communication --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#CenterCommunication">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/ccone.png') }}">
                    <span>Communication</span>
                </a>

                <div id="CenterCommunication"
                    class="collapse
                        @if (in_array(request()->segment(2), [
                                'agent-request',
                                'agent-messages',
                                'legbox-notification',
                                'viewer-notes',
                                'legbox-viewers',
                            ])) show @endif"
                    data-parent="#AdminTab">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'agent-request' ? 'menu-active' : '' }}"
                            href="{{ route('agent-request') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png') }}">
                            <span>Agent Request</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'legbox-notification' ? 'menu-active' : '' }}"
                            href="{{ route('centrer.legbox.notification.index') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">
                            <span>Legbox Notification</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'legbox-viewers' ? 'menu-active' : '' }}"
                            href="{{ route('legbox-viewers') }}">

                            <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png') }}" alt="">
                            <span>Legbox Viewers</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'agent-messages' ? 'menu-active' : '' }}"
                            href="{{ route('agent-messages') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png') }}">
                            <span>Messages</span>
                        </a>

                    </div>
                </div>


                {{-- Community --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CenterCommunity">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                    <span>Community</span>
                </a>

                <div id="CenterCommunity"
                    class="collapse
                        @if (in_array(request()->segment(2), ['Community', 'help', 'laws', 'pricing'])) show @endif"
                    data-parent="#AdminTab">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'Community' ? 'menu-active' : '' }}"
                            href="{{ route('center.abbreviations') }}">
                            <img src="{{ asset('assets/app/img/Abrieviations.png') }}">
                            <span>Abbreviations</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'help' ? 'menu-active' : '' }}"
                            href="{{ route('center.dashboard.Community.help') }}">
                            <img src="{{ asset('assets/app/img/helptips.png') }}">
                            <span>Help &amp; Tips</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'laws' ? 'menu-active' : '' }}"
                            href="{{ route('center.dashboard.Community.laws') }}">
                            <img src="{{ asset('assets/app/img/gavel.png') }}">
                            <span>Local Laws</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'pricing' ? 'menu-active' : '' }}"
                            href="{{ route('center.dashboard.Community.pricing') }}">
                            <img src="{{ asset('assets/app/img/dollar.png') }}">
                            <span>Pricing Summary</span>
                        </a>

                    </div>
                </div>


                {{-- Concierge --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CenterConcierge">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/concigre.png') }}">
                    <span>Concierge</span>
                </a>

                <div id="CenterConcierge"
                    class="collapse
                        @if (in_array(request()->segment(2), [
                                'accommodation',
                                'email-hosting',
                                'mobile-read-sim',
                                'professional-products',
                                'travel',
                                'visa',
                            ])) show @endif"
                    data-parent="#AdminTab">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'accommodation' ? 'menu-active' : '' }}"
                            href="{{ route('center.accommodation') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/acomdation.png') }}">
                            <span>Accommodation</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'email-hosting' ? 'menu-active' : '' }}"
                            href="{{ route('center.email-hosting') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png') }}">
                            <span>Email Account</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'mobile-read-sim' ? 'menu-active' : '' }}"
                            href="{{ route('center.mobile-read-sim') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/mobile-read.png') }}">
                            <span>Mobile SIM</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'professional-products' ? 'menu-active' : '' }}"
                            href="{{ route('center.professional-products') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/pro-pro.png') }}">
                            <span>Products</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'travel' ? 'menu-active' : '' }}"
                            href="{{ route('center.travel') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/visa-mig.png') }}">
                            <span>Travel</span>
                        </a>

                       {{--  <a class="collapse-item {{ request()->segment(2) == 'visa' ? 'menu-active' : '' }}"
                            href="{{ route('center.visa') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/visa.png') }}">
                            <span>Visa &amp; Migration</span>
                        </a> --}}

                    </div>
                </div>


                {{-- How is it Done --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#CenterHowIsItDone">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/how-quest.png') }}">
                    <span>How is it Done</span>
                </a>

                <div id="CenterHowIsItDone"
                    class="collapse
                        @if (in_array(request()->segment(2), [
                                'editmyaccount',
                                'profile-information',
                                'listings',
                                'profiles-centre',
                                'media_centre',
                                'profiles-masseurs',
                                'media-masseurs',
                            ])) show @endif"
                    data-parent="#AdminTab">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'editmyaccount' ? 'menu-active' : '' }}"
                            href="{{ route('center.editmyaccount') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/icons-account.png') }}">
                            <span>Edit My Account</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'profile-information' ? 'menu-active' : '' }}"
                            href="{{ route('center.profile-information') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/information-24.png') }}">
                            <span>Profile Information</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'listings' ? 'menu-active' : '' }}"
                            href="{{ route('center.listings') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/listing-24.png') }}">
                            <span>Listings</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'profiles-centre' ? 'menu-active' : '' }}"
                            href="{{ route('center.profiles-centre') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/center-24.png') }}">
                            <span>Profiles Centre</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'media_centre' ? 'menu-active' : '' }}"
                            href="{{ route('center.media-centre') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/media-24.png') }}">
                            <span>Media Centre</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'profiles-masseurs' ? 'menu-active' : '' }}"
                            href="{{ route('center.profiles-masseurs') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/wooden-massage-table-24.png') }}">
                            <span>Profiles Masseurs</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'media-masseurs' ? 'menu-active' : '' }}"
                            href="{{ route('center.media-masseurs') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/masseur-24.png') }}">
                            <span>Media Masseurs</span>
                        </a>

                    </div>
                </div>


                {{-- NUM --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CenterNUM">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png') }}">
                    <span>NUM</span>
                </a>

                <div id="CenterNUM"
                    class="collapse
                        @if (in_array(request()->segment(2), ['num-dashboard', 'add-report', 'my-reports', 'num-tips'])) show @endif"
                    data-parent="#AdminTab">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'num-dashboard' ? 'menu-active' : '' }}"
                            href="{{ route('center.numdashboard') }}">
                            <img src="{{ asset('assets/img/dashboard-24.png') }}">
                            <span>Dashboard</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'add-report' ? 'menu-active' : '' }}"
                            href="{{ route('center.add-report') }}">
                            <img src="{{ asset('assets/img/report-24.png') }}">
                            <span>Add Report</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'my-reports' ? 'menu-active' : '' }}"
                            href="{{ route('center.my-reports') }}">
                            <img src="{{ asset('assets/img/8report-24.png') }}">
                            <span>My Reports</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'num-tips' ? 'menu-active' : '' }}"
                            href="{{ route('center.num-tips') }}">
                            <img src="{{ asset('assets/app/img/tips.png') }}">
                            <span>NUM (Tips)</span>
                        </a>

                    </div>
                </div>



                {{-- suppot --}}

                {{-- Support Tickets --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SupportTickets">
                    <img src="{{ asset('assets/app/img/ticket.png') }}">
                    <span>Support Tickets</span>
                </a>

                <div id="SupportTickets"
                    class="collapse
                        @if (in_array(request()->segment(2), ['ticket-list']) || request()->segment(1) == 'submit_ticket') show @endif"
                    data-parent="#AdminTab">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(1) == 'submit_ticket' ? 'menu-active' : '' }}"
                            href="{{ url('submit_ticket') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/submit-ticket.png') }}">
                            <span>Submit</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'ticket-list' ? 'menu-active' : '' }}"
                            href="{{ route('support-ticket.list') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/reply.png') }}">
                            <span>View & Reply</span>
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </li>

</ul>
<!-- End of Sidebar -->
