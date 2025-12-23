<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar"
    id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-0" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3 e4u_logo" alt="">
    </a>
    <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-4">Massage Centre Console</span>
    <!-- Divider -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href=" {{ route('center.dashboard') }}">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="white" />
            </svg>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->

    <!-- Heading -->

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- My Account --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="false" aria-controls="collapseTwo">
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                    fill="#C2CFE0"></path>
            </svg>

            <span>My Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if (request()->segment(2) == 'update-account' ||
                request()->segment(2) == 'profile-informations' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'notifications-and-features' ||
                request()->segment(2) == 'upload-my-avatar') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('center.account.edit') }}">

                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                    <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">Edit Our
                        Account</span></a>
                <a class="collapse-item" href="{{ route('center.profile.information') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">

                    <span style="{{ request()->segment(2) == 'profile-informations' ? 'color: #e5365a;' : '' }}">Profile
                        information</span></a>
                <a class="collapse-item" href="{{ route('center.change.password') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                    <span style="{{ request()->segment(2) == 'change-password' ? 'color: #e5365a;' : '' }}">Change
                        password</span></a>

                <a class="collapse-item" href="{{ route('centre.notifications-and-features') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                    <span
                        style="{{ request()->segment(2) == 'notifications-and-features' ? 'color: #e5365a;' : '' }}">Notifications
                        & Features</span></a>
                <a class="collapse-item" href="{{ route('center.profile.avatar') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                    <span style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload my
                        avatar</span></a>

                {{-- <a class="collapse-item" href="{{ route('escort.profile.information')}}">
                            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">

                        <span style="{{request()->segment(2) == 'profile-informations' ? 'color: #e5365a;' : ''}}">Profile information</span></a>
                    <a class="collapse-item" href="{{ route('escort.change.password')}}">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                        <span style="{{request()->segment(2) == 'change-password' ? 'color: #e5365a;' : ''}}">Change password</span></a>
                    <a class="collapse-item" href="{{route('escort.profile.notifications')}}">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                        <span style="{{request()->segment(2) == 'notifications-features' ? 'color: #e5365a;' : ''}}">Notifications & Features</span></a>
                    <a class="collapse-item" href="{{route('escort.profile.avatar')}}">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                        <span style="{{request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : ''}}">Upload my avatar</span></a> --}}


            </div>
        </div>
    </li>
    {{-- devider --}}
    <li
        style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; margin-top: 10px;margin-bottom: 15px;">
    </li>


    <li class="nav-item">

        {{-- Profile Management --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ProfileManagement">
            <img src="{{ asset('assets/dashboard/img/menu-icon/administration.png') }}">
            <span>Profile Management</span>
        </a>

        <div id="ProfileManagement" class="collapse
                @if (in_array(request()->segment(3), ['add-listing', 'current', 'past', 'new-listing', 'archives-listing', 'videos']) ||
                        in_array(request()->segment(2), ['create-profile', 'list', 'archive-view-photos'])) show @endif"
            data-parent="#accordionSidebar">

            <div class="collapse-inner">

                {{-- Listings --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ManagementListings">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/pachive.png') }}">

                    <span>Listings</span>
                </a>
                <div id="ManagementListings"
                    class="collapse 
                    @if (in_array(request()->segment(3), ['add-listing', 'current', 'past'])) show @endif"
                    data-parent="#ProfileManagement">

                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item {{ request()->segment(3) == 'add-listing' ? 'menu-active' : '' }}"
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#ManagementProfile">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/add-profile-centre.png') }}">
                    <span>Profile</span>
                </a>

                <div id="ManagementProfile"
                    class="collapse
                    @if (in_array(request()->segment(2), ['create-profile', 'list'])) show @endif"
                    data-parent="#ProfileManagement">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'create-profile' ? 'menu-active' : '' }}"
                            href="{{ route('center.profile') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png') }}">
                            <span>New Profile</span>
                        </a>

                        <a class="collapse-item {{ in_array(request()->segment(2), ['list', 'profile']) ? 'menu-active' : '' }}"
                            href="{{ route('center.list') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                            <span>Our Profiles</span>
                        </a>

                    </div>
                </div>


                {{-- Masseurs --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CenterMasseurs">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/masseur-profile.png') }}">
                    <span>Masseurs</span>
                </a>

                <div id="CenterMasseurs"
                    class="collapse
                    @if (in_array(request()->segment(3), ['new-listing', 'archives-listing'])) show @endif"
                    data-parent="#ProfileManagement">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(3) == 'new-listing' ? 'menu-active' : '' }}"
                            href="{{ route('center.new-listing') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png') }}">
                            <span>New</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(3) == 'archives-listing' ? 'menu-active' : '' }}"
                            href="{{ route('center.archives-listing') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png') }}">
                            <span>Archives</span>
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
    {{-- Listings --}}





   {{-- devider --}}
    <li
        style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; margin-top: 10px;margin-bottom: 15px;">
    </li>

    <li class="nav-item">

        {{-- Administration --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration">
            <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
            <span>Administration</span>
        </a>

        <div id="Administration" class="collapse
                @if (in_array(request()->segment(3), ['add-listing', 'current', 'past', 'new-listing', 'archives-listing', 'videos']) ||
                        in_array(request()->segment(2), [
                            'create-profile',
                            'list',
                            'archive-view-photos',
                            'profiles-tours',
                            'social-media',
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
                            'media-centre',
                            'profiles-masseurs',
                            'media-masseurs',
                            'num-dashboard',
                            'add-report',
                            'my-reports',
                            'num-tips',
                            'ticket-list',
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
                        @if (in_array(request()->segment(2), ['profiles-tours', 'social-media'])) show @endif"
                    data-parent="#Administration">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'profiles-tours' ? 'menu-active' : '' }}"
                            href="{{ route('profiles-tours') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/bed.png') }}">
                            <span>Profiles &amp; Tours</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'social-media' ? 'menu-active' : '' }}"
                            href="{{ route('social-media') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span>Social Media</span>
                        </a>

                    </div>
                </div>
                {{-- Bookkeeping --}}
                <a class="nav-link collapsed {{ request()->routeIs('center.bookkeeping') ? 'menu-active' : '' }}"
                    href="{{ route('center.bookkeeping') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/bookshelf.png') }}">
                   <span>
                        Bookkeeping
                    </span>
                </a>

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
                    data-parent="#Administration">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'agent-request' ? 'menu-active' : '' }}"
                            href="{{ route('agent-request') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png') }}">
                            <span>Agent Request</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'legbox-notification' ? 'menu-active' : '' }}"
                            href="{{ route('legbox-notification') }}">
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
                    data-parent="#Administration">

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
                    data-parent="#Administration">

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

                        <a class="collapse-item {{ request()->segment(2) == 'visa' ? 'menu-active' : '' }}"
                            href="{{ route('center.visa') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/visa.png') }}">
                            <span>Visa &amp; Migration</span>
                        </a>

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
                                'media-centre',
                                'profiles-masseurs',
                                'media-masseurs',
                            ])) show @endif"
                    data-parent="#Administration">

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

                        <a class="collapse-item {{ request()->segment(2) == 'media-centre' ? 'menu-active' : '' }}"
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
                    data-parent="#Administration">

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
                    data-parent="#Administration">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(1) == 'submit_ticket' ? 'menu-active' : '' }}"
                            href="{{ url('submit_ticket') }}">
                            <img src="{{ asset('assets/app/img/right-30.png') }}">
                            <span>Submit</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'ticket-list' ? 'menu-active' : '' }}"
                            href="{{ route('support-ticket.list') }}">
                            <img src="{{ asset('assets/app/img/view-48.png') }}">
                            <span>View & Reply</span>
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </li>

</ul>
<!-- End of Sidebar -->
