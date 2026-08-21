<!-- Sidebar -->
@php
    $hideNavBar = false;
    if (
        session()->has('parent_agent_id') &&
        session('switch_for') == 'agent_to_massage' &&
        session('is_impersonated') === true
    ) {
        $hideNavBar = false;
    }
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-1" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " class="mb-3 e4u_logo" alt="">
    </a>
    <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-2">Escort Console</span>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->


    <li class="nav-item active">
        <a class="nav-link" href="{{ route('escort.dashboard') }}">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="#C2CFE0" />
            </svg>
            <span id="dash"
                style="{{ $_SERVER['REQUEST_URI'] == '/escort-dashboard' || $_SERVER['REQUEST_URI'] == '/escort-dashboard/activity-summary' ? 'color: #e5365a;' : '' }}">Dashboard</span>


        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <img src="{{ asset('assets/dashboard/img/menu-icon/my-account.png') }}" alt="">

            <span>My Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if (request()->segment(2) == 'profile-information' ||
                request()->segment(2) == 'update-account' ||
                request()->segment(2) == 'my-play-mates' ||
                request()->segment(2) == 'profile-informations' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'notifications-features' ||
                request()->segment(2) == 'upload-my-avatar') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">

                @if ($hideNavBar)
                    <a class="collapse-item" href="{{ route('escort.profile.information') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">

                        <span style="{{ request()->segment(2) == 'profile-information' ? 'color: #e5365a;' : '' }}">My
                            information</span></a>
                @else
                    <a class="collapse-item" href="{{ route('escort.account.edit') }}">

                        <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                        <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">Edit my
                            account</span></a>
                    <a class="collapse-item" href="{{ route('escort.profile.information') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">

                        <span style="{{ request()->segment(2) == 'profile-information' ? 'color: #e5365a;' : '' }}">My
                            information</span></a>
                    <a class="collapse-item" href="{{ route('escort.change.password') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                        <span style="{{ request()->segment(2) == 'change-password' ? 'color: #e5365a;' : '' }}">Change
                            password</span></a>
                    <a class="collapse-item" href="{{ route('escort.profile.notifications') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                        <span
                            style="{{ request()->segment(2) == 'notifications-features' ? 'color: #e5365a;' : '' }}">Notifications
                            & Features</span></a>
                    <a class="collapse-item" href="{{ route('escort.profile.avatar') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                        <span style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload
                            my
                            avatar</span></a>
                @endif

            </div>
        </div>
    </li>


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
        @if (in_array(request()->segment(2), [
                'add-listing',
                'listings',
                'profile',
                'list',
                'create-tour',
                'current-tour',
                'past-tour',
                'list-tour',
                'create-profile',
                'archive-view-photos',
                'archive-view-videos',
                'pricarchive-myplayboxing',
            ])) show @endif"
            data-parent="#accordionSidebar">

            <div class="collapse-inner">

                {{-- ===== LISTINGS ===== --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminListings">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/list-one.png') }}">
                    <span>Listings</span>
                </a>

                <div id="AdminListings" class="collapse
                @if (in_array(request()->segment(2), ['add-listing', 'listings'])) show @endif"
                    data-parent="#ProfileManagement">

                    <a class="collapse-item {{ request()->is('escort-dashboard/listings/add') ? 'menu-active' : '' }}"
                        href="{{ route('escort.account.add-listing') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/add-exot.png') }}">
                        <span>New</span>
                    </a>

                    <a class="collapse-item {{ request()->is('escort-dashboard/listings/current') ? 'menu-active' : '' }}"
                        href="{{ route('escort.dashboard.listings', 'current') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                        <span>Current</span>
                    </a>

                    <a class="collapse-item {{ request()->is('escort-dashboard/listings/past') ? 'menu-active' : '' }}"
                        href="{{ route('escort.dashboard.listings', 'past') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/clipboard.png') }}">
                        <span>Past</span>
                    </a>
                </div>

                {{-- ===== PROFILES ===== --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminProfiles">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                    <span>Profiles</span>
                </a>

                <div id="AdminProfiles" class="collapse
                @if (in_array(request()->segment(2), ['profile', 'list', 'create-profile'])) show @endif"
                    data-parent="#ProfileManagement">

                    <a class="collapse-item {{ request()->segment(2) == 'create-profile' ? 'menu-active' : '' }}"
                        href="{{ route('escort.profile') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                        <span>New</span>
                    </a>

                    <a class="collapse-item {{ request()->is('escort-dashboard/list/current') ? 'menu-active' : '' }}"
                        href="{{ route('escort.list', 'current') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                        <span>Listed</span>
                    </a>

                    <a class="collapse-item {{ request()->is('escort-dashboard/list/past') ? 'menu-active' : '' }}"
                        href="{{ route('escort.list', 'past') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/list-archive.png') }}">
                        <span>Archive</span>
                    </a>
                </div>

                {{-- ===== TOURS ===== --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminTours">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/travel-agency.png') }}">
                    <span>Tours</span>
                </a>

                <div id="AdminTours" class="collapse
                @if (in_array(request()->segment(2), ['create-tour', 'current-tour', 'past-tour', 'list-tour'])) show @endif"
                    data-parent="#ProfileManagement">

                    <a class="collapse-item {{ request()->segment(2) == 'create-tour' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/create-tour') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                        <span>New</span>
                    </a>
                    <a class="collapse-item {{ request()->is('escort-dashboard/list-tour/current') || request()->segment(2) == 'current-tour' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/list-tour/current') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                        <span>Current</span>
                    </a>

                    <a class="collapse-item {{ request()->is('escort-dashboard/list-tour/past') || request()->segment(2) == 'past-tour' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/list-tour/past') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/clipboard.png') }}">
                        <span>Past</span>
                    </a>
                </div>

                {{-- ===== MEDIA ===== --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminMedia">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/media-exort.png') }}">
                    <span>Media</span>
                </a>

                <div id="AdminMedia" class="collapse
                @if (in_array(request()->segment(2), ['archive-view-photos', 'archive-view-videos'])) show @endif"
                    data-parent="#ProfileManagement">

                    <a class="collapse-item {{ request()->segment(2) == 'archive-view-photos' ? 'menu-active' : '' }}"
                        href="{{ route('escort.archive-view-photos') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/photo-camera.png') }}">
                        <span>Photos</span>
                    </a>

                    <a class="collapse-item {{ request()->segment(2) == 'archive-view-videos' ? 'menu-active' : '' }}"
                        href="{{ route('escort.archive-view-videos') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/clapperboard.png') }}">
                        <span>Videos</span>
                    </a>
                </div>

                {{-- ===== MY PLAYBOX ===== --}}
                <a class="nav-link collapsed {{ request()->segment(2) == 'pricarchive-myplayboxing' ? 'menu-active' : '' }}"
                    href="{{ route('escort.archive-myplaybox') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Icon_MyPlaybox-light.png') }}">
                    <span>My Playbox</span>
                </a>

            </div>
        </div>
    </li>


    <li
        style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; margin-top: 10px;margin-bottom: 15px;">
    </li>



    {{-- Administration --}}
    @if (!$hideNavBar)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management">
                <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
                <span>Administration</span>
            </a>


            <div id="Management" class="collapse
            @if (in_array(request()->segment(2), [
                    'profiles-tours',
                    'social-media',
                    'feedback',
                    'criticalinformation',
                    'bank_account',
                    'my-wallet',
                    'transaction-summary',
                    'escort-agency-request',
                    'send-notifications',
                    'my-legbox-viewers',
                    'viewers-messages',
                    'agent-messages',
                    'viewer-notes',
                    'viewer-messaging',
                    'view-reviews',
                    'accommodation',
                    'email-hosting',
                    'mobile-read-sim',
                    'travel',
                    'visa-migration',
                    'Community',
                    'help',
                    'laws',
                    'pricing',
                    'num-dashboard',
                    'add-report',
                    'my-reports',
                    'num-tips',
                    'editmyaccount',
                    'my-information',
                    'media',
                    'profiles',
                    'tours',
                    'ticket-list',
                    'submit_ticket',
                    'order-history',
                    'concierge',
                    'legbox-notification',
                ]) ||
                    in_array(request()->segment(1), ['submit_ticket']) ||
                    in_array(request()->segment(3), ['uploads', 'guidelines', 'listings', 'products'])) show @endif"
                data-parent="#accordionSidebar">

                <div class="collapse-inner">

                    {{-- ===== ANALYTICS ===== --}}
                    <a class="nav-link collapsed disabled-link" href="#" data-toggle="collapse"
                        data-target="#ManagementAnalytics">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                        <span>Analytics</span>
                    </a>

                    {{-- <div id="ManagementAnalytics"
                        class="collapse
                     @if (in_array(request()->segment(2), ['profiles-tours', 'social-media', 'feedback', 'criticalinformation'])) show @endif"
                        data-parent="#Management">

                        <a class="collapse-item {{ request()->segment(2) == 'criticalinformation' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/criticalinformation') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/important-file-22.png') }}">
                            <span>Critical Information</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'feedback' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/feedback') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/feedback-22.png') }}">
                            <span>Feedback</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'profiles-tours' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/profiles-tours') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/bed.png') }}">
                            <span>Profiles & Tours</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'social-media' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/social-media') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                            <span>Social Media</span>
                        </a>
                    </div> --}}

                    {{-- ===== BOOKKEEPING ===== --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ManagementBookkeeping">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/bookshelf.png') }}">
                        <span>Bookkeeping</span>
                    </a>



                    <div id="ManagementBookkeeping"
                        class="collapse
                    @if (in_array(request()->segment(2), ['bank_account', 'my-wallet', 'transaction-summary', 'order-history'])) show @endif"
                        data-parent="#Management">
                        <a class="collapse-item {{ request()->segment(2) == 'bank_account' ? 'menu-active' : '' }}"
                            href="{{ route('escort.bank_account') }}">
                            <img src="{{ asset('assets/app/img/sales-performance.png') }}">
                            <span>Bank Account</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'my-wallet' ? 'menu-active' : '' }}"
                            href="{{ route('escort.my_wallet') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/credit-card-plus.png') }}">
                            <span>My Wallet</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'order-history' ? 'menu-active' : '' }}"
                            href="{{ route('bookkeeping.product.orders') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/order-confirmation.png') }}" />
                            <span>Orders</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'transaction-summary' ? 'menu-active' : '' }}"
                            href="{{ route('escort.payment.transaction_summary') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/credit-card-settings.png') }}">
                            <span>Transaction Summary</span></a>
                    </div>

                    {{-- Communication --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ManagementCommunication">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/ccone.png') }}" />
                        <span>Communication</span>
                    </a>

                    <div id="ManagementCommunication"
                        class="collapse 
                         @if (in_array(request()->segment(2), [
                                 'escort-agency-request',
                                 'send-notifications',
                                 'my-legbox-viewers',
                                 'viewers-messages',
                                 'agent-messages',
                                 'viewer-notes',
                                 'viewer-messaging',
                                 'view-reviews',
                                 'legbox-notification',
                             ])) show @endif"
                        data-parent="#Management">

                        <div class="py-0 collapse-inner rounded mb-2">

                            <a class="collapse-item {{ request()->segment(2) == 'escort-agency-request' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/escort-agency-request') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png') }}">
                                <span>Agent Request</span>
                            </a>


                            <a class="collapse-item {{ request()->segment(2) == 'legbox-notification' ? 'menu-active' : '' }}"
                                href="{{ route('escort.legbox.notification.index') }}">
                                <svg fill="#c2cfe0" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                    viewBox="0 0 284.67 284.67" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <g>
                                                <path
                                                    d="M257.856,52.12c0-8.568,0.611-19.584-1.225-28.152c-3.672-14.688-7.344-14.688-18.972-18.972 C221.135-1.125,196.043,0.1,178.295,0.1c-16.523,0-34.271-0.612-50.796,1.836c-12.852,2.448-22.032,3.06-25.704,15.3 c-1.836,6.732,0.612,21.42,0.612,28.152c0.612,14.688-3.06,36.72,1.224,50.184c5.508,17.136,25.092,13.464,41.616,14.076 c1.224,0,1.836,0.612,2.448,1.836c3.06,0.612,4.896,3.06,4.896,6.732c0,11.628-3.06,23.256-9.18,33.659 c18.36-2.447,34.884-12.239,45.288-27.539c1.224-1.224,2.448-2.448,3.672-3.06c0.612-4.284,4.284-7.956,9.792-7.956 c16.524,0.612,45.288,6.732,53.856-11.628C262.751,90.675,258.467,65.583,257.856,52.12z M191.148,81.496 c-4.284,3.672-8.568,3.06-11.628,1.224c-1.225,0.612-1.837,0.612-3.061,0c-15.912-3.06-59.364-24.48-42.228-46.512 c12.24-15.912,30.6-0.612,42.84,14.076c7.344-14.688,18.972-29.376,33.66-22.032C233.375,39.879,200.94,72.928,191.148,81.496z">
                                                </path>
                                                <path
                                                    d="M165.444,167.787c-4.284,1.836-9.181,3.061-14.076,3.674c2.448,20.807,2.448,41.615,3.06,62.424 c0,3.059-3.06,6.119-6.119,5.508c-17.137-0.613-34.272-0.613-50.796-0.613c-14.076,0-28.152,0.613-42.84,1.225 c-3.06,0-5.508-3.061-5.508-5.508c-2.448-36.721-7.344-80.172,0-116.28c3.672-18.36,22.644-15.3,37.944-12.852 c-0.612-4.896-0.612-9.792-0.612-14.076c-1.224,0-2.448,0-3.672,0c-3.06,0-6.12,0-8.568,0.612 c-3.672,0.612-6.732-0.612-8.568-4.284c-1.224-3.06,0-7.344,3.06-8.568c4.896-2.448,11.016-4.896,17.136-4.284 c0-5.508-0.612-11.016-0.612-16.524c-18.36,2.448-44.064-0.612-52.02,18.36c-6.12,17.136-2.448,45.9-3.672,64.26 c-1.224,21.419-1.836,42.839-2.448,64.259c-0.612,20.197-4.284,44.064-0.612,64.262c3.672,21.42,34.884,14.074,52.632,14.074 c5.508,0,11.628,0,17.748,0c17.136,0.613,34.884,1.838,49.572-1.223c12.24-2.449,15.912-0.613,18.973-14.688 c2.448-8.568,0-20.197,0-29.377C165.444,214.3,165.444,191.044,165.444,167.787z M97.512,273.052 c-7.956-0.613-15.912-9.182-11.016-17.137c1.224-1.225,2.448-2.447,3.672-3.061c0.612-0.611,0.612-1.223,1.224-1.836 c1.836-1.836,3.672-2.447,6.12-2.447c4.896,0,10.404,4.283,11.628,9.18C111.587,265.707,105.468,273.052,97.512,273.052z">
                                                </path>
                                                <path
                                                    d="M58.344,128.62c-3.672,8.568-0.612,24.479-0.612,33.659c0,22.033,0.612,44.064,2.448,66.098 c27.54-1.838,55.08-3.061,82.62-1.225c0.612-18.361,1.224-36.721,3.671-55.08c-7.344,1.225-14.688,1.225-22.644,0.611 c-9.18-0.611-14.076-11.016-7.344-17.748c10.404-11.016,16.524-21.419,21.42-35.496c-15.3,4.896-35.496,10.404-45.9-2.448 c-1.224-1.224-1.836-3.06-2.448-4.896C76.092,114.543,65.688,111.483,58.344,128.62z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span>Legbox Notification</span>
                            </a>
                            <a class="collapse-item {{ request()->segment(2) == 'my-legbox-viewers' ? 'menu-active' : '' }}"
                                href="{{ route('escort.dashboard.my-legbox-viewers') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/legbox.png') }}">
                                <span>Legbox Viewers</span>
                            </a>

                            <a class="collapse-item disabled-link {{ request()->segment(2) == 'agent-messages' ? 'menu-active' : '' }}"
                                href="{{ route('escort.dashboard.agent-messages') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png') }}">
                                <span>Messages</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(2) == 'view-reviews' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/view-reviews') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png') }}">
                                <span>My Reviews</span>
                            </a>


                            <a class="collapse-item {{ request()->segment(2) == 'send-notifications' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/send-notifications') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">
                                <span>Notifications</span>
                            </a>


                        </div>
                    </div>
                    {{-- end Communication --}}

                    {{-- ===== COMMUNITY ===== --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ManagementCommunity">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                        <span>Community</span>
                    </a>

                    <div id="ManagementCommunity"
                        class="collapse
                    @if (in_array(request()->segment(2), ['Community', 'help', 'laws', 'pricing'])) show @endif"
                        data-parent="#Management">

                        <a class="collapse-item {{ request()->segment(2) == 'Community' ? 'menu-active' : '' }}"
                            href="{{ route('escort.dashboard.Community.abbreviations') }}">
                            <img src="{{ asset('assets/app/img/Abrieviations.png') }}">
                            <spna>Abbreviations</spna>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'help' ? 'menu-active' : '' }}"
                            href="{{ route('escort.dashboard.Community.help') }}">
                            <img src="{{ asset('assets/app/img/helptips.png') }}">
                            <span> Help</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'laws' ? 'menu-active' : '' }}"
                            href="{{ route('escort.dashboard.Community.laws') }}">
                            <img src="{{ asset('assets/app/img/gavel.png') }}">
                            <span>Local Laws</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'pricing' ? 'menu-active' : '' }}"
                            href="{{ route('escort.dashboard.Community.pricing') }}">
                            <img src="{{ asset('assets/app/img/dollar.png') }}">
                            <span>Pricing</span>
                        </a>
                    </div>

                    {{-- Concierge --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ManagementConcierge">

                        <img src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}" />
                        <span>Concierge</span>
                    </a>

                    <div id="ManagementConcierge"
                        class="collapse
                    @if (in_array(request()->segment(2), [
                            'accommodation',
                            'email-hosting',
                            'mobile-read-sim',
                            'travel',
                            'visa-migration',
                        ]) || in_array(request()->segment(3), ['products', 'view-cart'])) show @endif"
                        data-parent="#Management">

                        <div class="py-0 collapse-inner rounded mb-2">

                            <a class="collapse-item disabled-link  {{ request()->segment(2) == 'accommodation' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/accommodation') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/bed.png') }}" />
                                <span>Accommodation</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(2) == 'email-hosting' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/email-hosting') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}" />
                                <span>Email Account</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(2) == 'mobile-read-sim' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/mobile-read-sim') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}" />
                                <span>Mobile SIM</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(3) == 'products' || request()->segment(3) == 'view-cart' ? 'menu-active' : '' }}"
                                href="{{ route('escort.products') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/product.png') }}" />
                                <span>Products</span>
                            </a>


                            <a class="collapse-item disabled-link {{ request()->segment(2) == 'travel' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/travel') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/wallet-travel.png') }}" />
                                <span>Travel</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(2) == 'visa-migration' ? 'menu-active' : '' }}"
                                href="{{ url('escort-dashboard/visa-migration') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}" />
                                <span>Visa &amp; Education</span>
                            </a>

                        </div>
                    </div>
                    {{-- end Concierge --}}
                    {{-- How is it Done --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ManagementhowIsItDone">

                        <img src="{{ asset('assets/dashboard/img/menu-icon/how-quest.png') }}" />
                        <span>How is it Done</span>
                    </a>

                    <div id="ManagementhowIsItDone" class="collapse @if (in_array(request()->segment(2), ['editmyaccount', 'my-information', 'media', 'profiles', 'tours']) ||
                            request()->segment(3) == 'listings') show @endif"
                        data-parent="#Management">

                        <div class="py-0 collapse-inner rounded mb-2">

                            <a class="collapse-item {{ request()->segment(2) == 'editmyaccount' ? 'menu-active' : '' }}"
                                href="{{ route('escort.editmyaccount') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/icons-account.png') }}" />
                                <span>Edit My Account</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(3) == 'listings' ? 'menu-active' : '' }}"
                                href="{{ route('escort.listings') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/listing-24.png') }}" />
                                <span>Listings</span>
                            </a>
                            <a class="collapse-item {{ request()->segment(2) == 'media' ? 'menu-active' : '' }}"
                                href="{{ route('escort.media') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/media-24.png') }}" />
                                <span>Media</span>
                            </a>


                            <a class="collapse-item {{ request()->segment(2) == 'my-information' ? 'menu-active' : '' }}"
                                href="{{ route('escort.my-information') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/information-24.png') }}" />
                                <span>My Information</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(2) == 'profiles' ? 'menu-active' : '' }}"
                                href="{{ route('escort.profiles') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/add-administrator-24.png') }}" />
                                <span>Profiles</span>
                            </a>

                            <a class="collapse-item {{ request()->segment(2) == 'tours' ? 'menu-active' : '' }}"
                                href="{{ route('escort.tours') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/tour-24.png') }}" />
                                <span>Tours</span>
                            </a>

                        </div>
                    </div>
                    {{-- end How is it Done --}}


                    {{-- ===== Influencer ===== --}}
                    <a class="nav-link collapsed disabled-link" href="#" data-toggle="collapse"
                        data-target="#ManagementInfluencer">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/influencer.png') }}">
                        <span>Influencer</span>
                    </a>

                    {{-- <div id="ManagementInfluencer"
                        class="collapse
                        @if (in_array(request()->segment(3), ['uploads', 'guidelines'])) show @endif"
                        data-parent="#Management">

                        <a class="collapse-item" href="{{ route('escort.guidelines') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'guidelines' ? 'color: #e5365a;' : '' }}">Guidelines</span>
                        </a>
                        <a class="collapse-item" href="{{ route('escort.uploads') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/uploads.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'uploads' ? 'color: #e5365a;' : '' }}">Uploads</span>
                        </a>

                    </div> --}}

                    {{-- ===== NUM ===== --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ManagementNUM">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png') }}">
                        <span>NUM</span>
                    </a>

                    <div id="ManagementNUM"
                        class="collapse
                    @if (in_array(request()->segment(2), ['num-dashboard', 'add-report', 'my-reports', 'num-tips'])) show @endif"
                        data-parent="#Management">

                        <a class="collapse-item {{ request()->segment(2) == 'add-report' ? 'menu-active' : '' }}"
                            href="{{ route('escort.add-report') }}">
                            <img src="{{ asset('assets/img/report-24.png') }}" />
                            <span>Add Report</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'num-dashboard' ? 'menu-active' : '' }}"
                            href="{{ route('escort.numdashboard') }}">
                            <img src="{{ asset('assets/img/dashboard-24.png') }}" />
                            <span>Dashboard</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'my-reports' ? 'menu-active' : '' }}"
                            href="{{ route('escort.my-reports') }}">
                            <img src="{{ asset('assets/img/8report-24.png') }}" />
                            <span>My Reports</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'num-tips' ? 'menu-active' : '' }}"
                            href="{{ route('escort.num-tips') }}">
                            <img src="{{ asset('assets/app/img/tips.png') }}" />
                            <span>Screening Tips</span>
                        </a>
                    </div>

                    {{-- ===== SUPPORT TICKETS ===== --}}
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#ManagementTickets">
                        <img src="{{ asset('assets/app/img/ticket.png') }}">
                        <span>Support Tickets</span>
                    </a>

                    <div id="ManagementTickets"
                        class="collapse
                       @if (in_array(request()->segment(2), ['ticket-list']) || request()->segment(1) == 'submit_ticket') show @endif"
                        data-parent="#Management">

                        <a class="collapse-item {{ request()->segment(1) == 'submit_ticket' ? 'menu-active' : '' }}"
                            href="{{ url('submit_ticket') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/submit-ticket.png') }}">
                            <span>Submit Ticket</span>
                        </a>
                        <a class="collapse-item {{ request()->segment(2) == 'ticket-list' ? 'menu-active' : '' }}"
                            href="{{ route('support-ticket.list') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/reply.png') }}">
                            <span>View & Reply</span>
                        </a>
                    </div>

                </div>
            </div>
        </li>
    @endif
</ul>
<!-- end sidebar -->
