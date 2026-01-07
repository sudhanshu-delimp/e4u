<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-0" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " class="mb-3 e4u_logo" alt="">
    </a>
    <span style="color:#FF3C5F;" class="font-weight-normal pl-3">Escort Console</span>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->

    </br>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('escort.dashboard') }}">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="#C2CFE0" />
            </svg>
            <span id="dash"
                style="{{ $_SERVER['REQUEST_URI'] == '/escort-dashboard' ? 'color: #e5365a;' : '' }}">Dashboard</span>


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

                    <span style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload my
                        avatar</span></a>

            </div>
        </div>
    </li>


    <li
        style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; margin-top: 10px;margin-bottom: 15px;">
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration"
            aria-expanded="false" aria-controls="Administration">
            <img src="{{ asset('assets/dashboard/img/menu-icon/administration.png') }}">
            <span>Administration</span>
        </a>
        <div id="Administration" class="collapse @if (in_array(request()->segment(3), ['create-tour', 'list-tour', 'archive-myplaybox', 'archive-view-photos', 'archive-view-videos', 'add-listing', 'listings', 'current', 'past'])) show @endif"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">


            <div class="py-0 collapse-inner rounded mb-2">
               
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listingMenu"
                    aria-expanded="false" aria-controls="listingMenu">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/list-one.png') }}" />
                    <span>Listings</span>
                </a>

                <div id="listingMenu"
                    class="collapse  
                        @if (request()->segment(3) == 'add-listing' || (request()->segment(3) == 'listings' && in_array(request()->segment(3), ['current', 'past']))) show @endif">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item" href="{{ route('escort.account.add-listing') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/add-exot.png') }}" />
                            <span class="{{ request()->segment(3) == 'add-listing' ? 'menu-active' : '' }}">New</span>
                        </a>

                        <a class="collapse-item" href="{{ route('escort.dashboard.listings', 'current') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}" />
                            <span
                                class="{{ request()->segment(3) == 'listings' && request()->segment(3) == 'current' ? 'menu-active' : '' }}">Current</span>
                        </a>

                        <a class="collapse-item" href="{{ route('escort.dashboard.listings', 'past') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/clipboard.png') }}" />
                            <span
                                class="{{ request()->segment(3) == 'listings' && request()->segment(3) == 'past' ? 'menu-active' : '' }}">Past</span>
                        </a>

                    </div>
                </div>
                


               
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profileMenu"
                    aria-expanded="false" aria-controls="profileMenu">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                    <span>Profiles</span>
                </a>

                <div id="profileMenu" class="collapse @if (request()->segment(2) == 'create-profile' || request()->segment(2) == 'profile' || (request()->segment(2) == 'list' && in_array(request()->segment(3), ['current', 'listed', 'past', 'archive']))) show @endif">

                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('escort.profile') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                            <span
                                class="{{ request()->segment(2) == 'create-profile' ? 'menu-active' : '' }}">New</span>
                        </a>
                        <a class="collapse-item" href="{{ route('escort.list', 'current') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                            <span
                                class="{{ request()->segment(2) == 'list' && request()->segment(3) == 'current' ? 'menu-active' : '' }}">Listed</span>
                        </a>
                        <a class="collapse-item" href="{{ route('escort.list', 'past') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/list-archive.png') }}">
                            <span
                                class="{{ request()->segment(2) == 'list' && request()->segment(3) == 'past' ? 'menu-active' : '' }}">Archive</span>
                        </a>
                    </div>
                </div>

                

               
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tourMenu"
                    aria-expanded="false" aria-controls="tourMenu">
                    <img class="big" src="{{ asset('assets/dashboard/img/menu-icon/travel-agency.png') }}">
                    <span>Tours</span>
                </a>

                <div id="tourMenu" class="collapse @if (request()->segment(2) == 'create-tour' || (request()->segment(2) == 'list-tour' && in_array(request()->segment(3), ['current', 'past']))) show @endif">

                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ url('escort-dashboard/create-tour') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                            <span class="{{ request()->segment(2) == 'create-tour' ? 'menu-active' : '' }}">New</span>
                        </a>

                        <a class="collapse-item" href="{{ url('escort-dashboard/list-tour/current') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                            <span
                                class="{{ request()->segment(2) == 'list-tour' && request()->segment(3) == 'current' ? 'menu-active' : '' }}">Current</span>
                        </a>

                        <a class="collapse-item" href="{{ url('escort-dashboard/list-tour/past') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/clipboard.png') }}">
                            <span
                                class="{{ request()->segment(2) == 'list-tour' && request()->segment(3) == 'past' ? 'menu-active' : '' }}">Archive</span>
                        </a>

                    </div>
                </div>
               
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pmedia"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <img class="cstm-excort" src="{{ asset('assets/dashboard/img/menu-icon/media-exort.png') }}">
                    <span>Media</span>
                </a>
                <div id="pmedia" class="collapse  @if (request()->segment(2) == 'archive-view-photos' || request()->segment(2) == 'archive-view-videos') show @endif;">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('escort.archive-view-photos') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/photo-camera.png') }}">
                            <span
                                class="{{ request()->segment(2) == 'archive-view-photos' ? 'menu-active' : '' }}">Photos</span>
                        </a>
                        <a class="collapse-item" href="{{ route('escort.archive-view-videos') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/clapperboard.png') }}">
                            <span
                                class="{{ request()->segment(2) == 'archive-view-videos' ? 'menu-active' : '' }}">Videos</span>
                        </a>
                    </div>
                </div>
               
                <a class="nav-link collapsed" href="{{ route('escort.archive-myplaybox', ['from' => 'sidebar']) }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Icon_MyPlaybox-light.png') }}" />
                    <span class="{{ request()->routeIs('escort.archive-myplaybox') ? 'active-text' : '' }}">
                        My Playbox
                    </span>
                </a>
            </div>
        </div>
    </li> --}}


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

                    <a class="collapse-item {{ request()->segment(2) == 'add-listing' ? 'menu-active' : '' }}"
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
                @if (in_array(request()->segment(2), ['create-tour', 'list-tour'])) show @endif"
                    data-parent="#ProfileManagement">

                    <a class="collapse-item {{ request()->segment(2) == 'create-tour' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/create-tour') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                        <span>New</span>
                    </a>

                    <a class="collapse-item {{ request()->is('escort-dashboard/list-tour/current') ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/list-tour/current') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                        <span>Current</span>
                    </a>

                    <a class="collapse-item {{ request()->is('escort-dashboard/list-tour/past') ? 'menu-active' : '' }}"
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
                    href="{{ route('escort.archive-myplaybox', ['from' => 'sidebar']) }}">
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
                    'credit-my-account',
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
                    'professional-products',
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
                    'listings',
                    'listing',
                    'media',
                    'profiles',
                    'tours',
                    'ticket-list',
                    'submit_ticket',
                ]) || in_array(request()->segment(1), ['submit_ticket']) || in_array(request()->segment(3), ['uploads', 'guidelines'])) show @endif"
            data-parent="#accordionSidebar">

            <div class="collapse-inner">

                {{-- ===== ANALYTICS ===== --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#ManagementAnalytics">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                    <span>Analytics</span>
                </a>

                <div id="ManagementAnalytics"
                    class="collapse
                    @if (in_array(request()->segment(2), ['profiles-tours', 'social-media', 'feedback', 'criticalinformation'])) show @endif"
                    data-parent="#Management">

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
                    <a class="collapse-item {{ request()->segment(2) == 'feedback' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/feedback') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/feedback-22.png') }}">
                        <span>Feedback</span>
                    </a>
                    <a class="collapse-item {{ request()->segment(2) == 'criticalinformation' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/criticalinformation') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/important-file-22.png') }}">
                        <span>Critical Information</span>
                    </a>
                </div>

                {{-- ===== BOOKKEEPING ===== --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                    data-target="#ManagementBookkeeping">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/bookshelf.png') }}">
                    <span>Bookkeeping</span>
                </a>

                <div id="ManagementBookkeeping"
                    class="collapse
                    @if (in_array(request()->segment(2), ['bank_account', 'credit-my-account', 'transaction-summary'])) show @endif"
                    data-parent="#Management">

                    <a class="collapse-item {{ request()->segment(2) == 'bank_account' ? 'menu-active' : '' }}"
                        href="{{ route('escort.bank_account') }}">
                        <img src="{{ asset('assets/app/img/sales-performance.png') }}">
                        <span>Bank Account</span>
                    </a>
                    <a class="collapse-item {{ request()->segment(2) == 'credit-my-account' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/credit-my-account') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/credit-card-plus.png') }}">
                        <span>Add Credit</span>
                    </a>
                    <a class="collapse-item {{ request()->segment(2) == 'transaction-summary' ? 'menu-active' : '' }}"
                        href="{{ url('escort-dashboard/transaction-summary') }}">
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
                             ])) show @endif"
                    data-parent="#Management">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'escort-agency-request' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/escort-agency-request') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png') }}">
                            <span>Agent Request</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'send-notifications' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/send-notifications') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">
                            <span>Notifications</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'my-legbox-viewers' ? 'menu-active' : '' }}"
                            href="{{ route('escort.dashboard.my-legbox-viewers', ['from' => 'sidebar']) }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/legbox.png') }}">
                            <span>Legbox Viewer</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'agent-messages' ? 'menu-active' : '' }}"
                            href="{{ route('escort.dashboard.agent-messages') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png') }}">
                            <span>Messages</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'view-reviews' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/view-reviews') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png') }}">
                            <span>My Reviews</span>
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
                            'professional-products',
                            'travel',
                            'visa-migration',
                        ])) show @endif"
                    data-parent="#Management">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'accommodation' ? 'menu-active' : '' }}"
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

                        <a class="collapse-item {{ request()->segment(2) == 'professional-products' ? 'menu-active' : '' }}"
                            href="{{ url('escort-dashboard/professional-products') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}" />
                            <span>Products</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'travel' ? 'menu-active' : '' }}"
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

                <div id="ManagementhowIsItDone"
                    class="collapse
                    @if (in_array(request()->segment(2), ['editmyaccount', 'my-information', 'listing', 'media', 'profiles', 'tours'])) show @endif"
                    data-parent="#Management">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item {{ request()->segment(2) == 'editmyaccount' ? 'menu-active' : '' }}"
                            href="{{ route('escort.editmyaccount') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/icons-account.png') }}" />
                            <span>Edit My Account</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'my-information' ? 'menu-active' : '' }}"
                            href="{{ route('escort.my-information') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/information-24.png') }}" />
                            <span>My Information</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'listing' ? 'menu-active' : '' }}"
                            href="{{ route('escort.listing') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/listing-24.png') }}" />
                            <span>Listings</span>
                        </a>

                        <a class="collapse-item {{ request()->segment(2) == 'media' ? 'menu-active' : '' }}"
                            href="{{ route('escort.media') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/media-24.png') }}" />
                            <span>Media</span>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ManagementInfluencer">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/influencer.png') }}">
                    <span>Influencer</span>
                </a>

                <div id="ManagementInfluencer"
                    class="collapse
                    @if (in_array(request()->segment(3), ['uploads', 'guidelines'])) show @endif"
                    data-parent="#Management">

                     <!-- Forms -->
                        <a class="collapse-item" href="{{ route('escort.uploads') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/form.png') }}">
                            <span style="{{ request()->segment(3) == 'uploads' ? 'color: #e5365a;' : '' }}">Uploads</span>
                        </a>

                        <!-- Guidelines -->
                        <a class="collapse-item" href="{{ route('escort.guidelines') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'guidelines' ? 'color: #e5365a;' : '' }}">Guidelines</span>
                        </a>
                </div>

                {{-- ===== NUM ===== --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ManagementNUM">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png') }}">
                    <span>NUM</span>
                </a>

                <div id="ManagementNUM"
                    class="collapse
                    @if (in_array(request()->segment(2), ['num-dashboard', 'add-report', 'my-reports', 'num-tips'])) show @endif"
                    data-parent="#Management">

                    <a class="collapse-item {{ request()->segment(2) == 'num-dashboard' ? 'menu-active' : '' }}"
                        href="{{ route('escort.numdashboard') }}">
                        <img src="{{ asset('assets/img/dashboard-24.png') }}" />
                        <span>Dashboard</span>
                    </a>
                    <a class="collapse-item {{ request()->segment(2) == 'add-report' ? 'menu-active' : '' }}"
                        href="{{ route('escort.add-report') }}">
                        <img src="{{ asset('assets/img/report-24.png') }}" />
                        <span>Add Report</span>
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
                        <img src="{{ asset('assets/app/img/right-30.png') }}">
                        <span>Submit Ticket</span>
                    </a>
                    <a class="collapse-item {{ request()->segment(2) == 'ticket-list' ? 'menu-active' : '' }}"
                        href="{{ route('support-ticket.list') }}">
                        <img src="{{ asset('assets/app/img/view-48.png') }}">
                        <span>View & Reply</span>
                    </a>
                </div>

            </div>
        </div>
    </li>
</ul>
<!-- end sidebar -->
