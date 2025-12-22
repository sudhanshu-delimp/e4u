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
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                    fill="#C2CFE0" />
            </svg>

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

                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                    <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">Edit my
                        account</span></a>
                <a class="collapse-item" href="{{ route('escort.profile.information') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">

                    <span style="{{ request()->segment(2) == 'profile-information' ? 'color: #e5365a;' : '' }}">My
                        information</span></a>
                <a class="collapse-item" href="{{ route('escort.change.password') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                    <span style="{{ request()->segment(2) == 'change-password' ? 'color: #e5365a;' : '' }}">Change
                        password</span></a>
                <a class="collapse-item" href="{{ route('escort.profile.notifications') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                    <span
                        style="{{ request()->segment(2) == 'notifications-features' ? 'color: #e5365a;' : '' }}">Notifications
                        & Features</span></a>
                <a class="collapse-item" href="{{ route('escort.profile.avatar') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                    <span style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload my
                        avatar</span></a>

            </div>
        </div>
    </li>
    {{-- LISTINGS SECTION --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listingMenu"
            aria-expanded="true" aria-controls="listingMenu">
            <img src="{{ asset('assets/dashboard/img/menu-icon/list-one.png') }}" />
            <span>Listings</span>
        </a>

        <div id="listingMenu" class="collapse  
        @if (request()->segment(2) == 'add-listing' ||
                (request()->segment(2) == 'listings' && in_array(request()->segment(3), ['current', 'past']))) show @endif"
            aria-labelledby="headingListing" data-parent="#accordionSidebar">

            <div class="py-0 collapse-inner rounded mb-2">

                <a class="collapse-item" href="{{ route('escort.account.add-listing') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/add-exot.png') }}" />
                    <span class="{{ request()->segment(2) == 'add-listing' ? 'menu-active' : '' }}">New</span>
                </a>

                <a class="collapse-item" href="{{ route('escort.dashboard.listings', 'current') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}" />
                    <span
                        class="{{ request()->segment(2) == 'listings' && request()->segment(3) == 'current' ? 'menu-active' : '' }}">Current</span>
                </a>

                <a class="collapse-item" href="{{ route('escort.dashboard.listings', 'past') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/clipboard.png') }}" />
                    <span
                        class="{{ request()->segment(2) == 'listings' && request()->segment(3) == 'past' ? 'menu-active' : '' }}">Past</span>
                </a>

            </div>
        </div>
    </li>

    {{-- PROFILES SECTION --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profileMenu"
            aria-expanded="true" aria-controls="profileMenu">
            <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
            <span>Profiles</span>
        </a>

        <div id="profileMenu" class="collapse @if (request()->segment(2) == 'create-profile' ||
                request()->segment(2) == 'profile' ||
                (request()->segment(2) == 'list' && in_array(request()->segment(3), ['current', 'listed', 'past', 'archive']))) show @endif"
            aria-labelledby="headingProfile" data-parent="#accordionSidebar">

            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('escort.profile') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                    <span class="{{ request()->segment(2) == 'create-profile' ? 'menu-active' : '' }}">New</span>
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
    </li>

    {{-- TOURS SECTION --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tourMenu"
            aria-expanded="true" aria-controls="tourMenu">
            <img class="big" src="{{ asset('assets/dashboard/img/menu-icon/travel-agency.png') }}">
            <span>Tours</span>
        </a>

        <div id="tourMenu" class="collapse @if (request()->segment(2) == 'create-tour' ||
                (request()->segment(2) == 'list-tour' && in_array(request()->segment(3), ['current', 'past']))) show @endif"
            aria-labelledby="headingTour" data-parent="#accordionSidebar">

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
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pmedia"
            aria-expanded="true" aria-controls="collapseTwo">
            <img class="cstm-excort" src="{{ asset('assets/dashboard/img/menu-icon/media-exort.png') }}">
            <span>Media</span>
        </a>
        <div id="pmedia" class="collapse  @if (request()->segment(2) == 'archive-medias' ||
                request()->segment(2) == 'archive-view-photos' ||
                request()->segment(2) == 'archive-view-videos') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('escort.archive-view-photos') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/photo-camera.png') }}">
                    <span style=@if (request()->segment(2) == 'archive-view-photos') "color: #e5365a;" @endif>Photos</span>
                </a>
                <a class="collapse-item" href="{{ route('escort.archive-view-videos') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/clapperboard.png') }}">
                    <span style=@if (request()->segment(2) == 'archive-view-videos') "color: #e5365a;" @endif>Videos</span>
                </a>
                {{-- <a class="collapse-item" href="{{ route('escort.archive-myplaybox') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/play-25.png') }}"/>
                    <span style="@if (request()->segment(2) == 'pricarchive-myplayboxing') color: #e5365a; @endif">
                        My Playbox
                    </span>
                </a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('escort.archive-myplaybox', ['from' => 'sidebar']) }}">
            <img src="{{ asset('assets/dashboard/img/menu-icon/Icon_MyPlaybox-light.png') }}" />
            <span class="{{ request()->routeIs('escort.archive-myplaybox') ? 'active-text' : '' }}">
                My Playbox
            </span>
        </a>
    </li>

    <li
        style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; margin-top: 10px;margin-bottom: 15px;">
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
            </img>
            <span>Analytics</span>
        </a>
        <div id="Analytics" class="collapse @if (request()->segment(2) == 'profiles-tours' ||
                request()->segment(2) == 'social-media' ||
                request()->segment(2) == 'feedback' ||
                request()->segment(2) == 'criticalinformation') show @endif"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ url('escort-dashboard/profiles-tours') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/bed.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'profiles-tours' ? 'color: #e5365a;' : '' }}">Profiles &
                        Tours</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/social-media') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                    </img><span style="{{ request()->segment(2) == 'social-media' ? 'color: #e5365a;' : '' }}">Social
                        Media</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/feedback') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/feedback-22.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'feedback' ? 'color: #e5365a;' : '' }}">Feedback</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/criticalinformation') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/important-file-22.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'criticalinformation' ? 'color: #e5365a;' : '' }}">Critical
                        Information</span>
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Bookkeeping"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/bookshelf.png') }}">
            </img>
            <span>Bookkeeping</span>
        </a>
        <div id="Bookkeeping" class="collapse  @if (request()->segment(2) == 'bank_account' ||
                request()->segment(2) == 'credit-my-account' ||
                request()->segment(2) == 'revenue-manager' ||
                request()->segment(2) == 'my-bank-account' ||
                request()->segment(2) == 'transaction-summary' ||
                request()->segment(2) == 'transaction-history') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('escort.bank_account') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/app/img/sales-performance.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'bank_account' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Bank
                        Account</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/credit-my-account') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/credit-card-plus.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'credit-my-account' ? 'color: #e5365a;' : '' }}">Add
                        Credit</span>
                </a>


                <a class="collapse-item" href="{{ url('escort-dashboard/transaction-summary') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/credit-card-settings.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'transaction-summary' ? 'color: #e5365a;' : '' }}">Transaction
                        summary</span>
                </a>
                {{-- <a class="collapse-item" href="{{url('escort-dashboard/transaction-history')}}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                         src="{{asset('assets/dashboard/img/menu-icon/credit-card-refresh.png') }}">
                    </img><span style="{{request()->segment(2) == 'transaction-history' ? 'color: #e5365a;' : ''}}">Transaction History</span>
                </a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#communication"
            aria-expanded="true" aria-controls="collapseTwo">
            <img src="{{ asset('assets/dashboard/img/menu-icon/ccone.png') }}">
            <span>Communication</span>
        </a>
        <div id="communication" class="collapse @if (request()->segment(2) == 'escort-agency-request' ||
                request()->segment(2) == 'send-notofications' ||
                request()->segment(2) == 'my-legbox-viewers' ||
                request()->segment(2) == 'viewers-messages' ||
                request()->segment(2) == 'agent-messages' ||
                request()->segment(2) == 'viewer-notes' ||
                request()->segment(2) == 'viewer-messaging' ||
                request()->segment(2) == 'view-reviews') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ url('escort-dashboard/escort-agency-request') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'escort-agency-request' ? 'color: #e5365a;' : '' }}">Agent
                        Request</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/send-notofications') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'send-notofications' ? 'color: #e5365a;' : '' }}">Notifications</span>
                </a>
                <a class="collapse-item"
                    href="{{ route('escort.dashboard.my-legbox-viewers', ['from' => 'sidebar']) }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/legbox.png') }}">
                    <span style="{{ request()->segment(2) == 'my-legbox-viewers' ? 'color: #e5365a;' : '' }}">Legbox
                        Viewer</span>
                </a>
                <a class="collapse-item" href="{{ route('escort.dashboard.agent-messages') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'agent-messages' ? 'color: #e5365a;' : '' }}">Messages</span>
                </a>

                <a class="collapse-item" href="{{ url('escort-dashboard/view-reviews') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png') }}">
                    <span style="{{ request()->segment(2) == 'view-reviews' ? 'color: #e5365a;' : '' }}">My
                        Reviews</span>
                </a>

                {{-- <a class="collapse-item" href="{{url('escort-dashboard/viewer-notes')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccfour.png')}}">
                <span style="{{request()->segment(2) == 'viewer-notes' ? 'color: #e5365a;' : ''}}">Viewer Notes</span>
            </a>
            <a class="collapse-item" href="{{ route('escort.viewer-messaging') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{request()->segment(2) == 'viewer-messaging' ? 'color: #e5365a;' : ''}}">Viewer Messaging</span>
            </a> --}}
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
            </img>
            <span>Community</span>
        </a>

        <div id="Community" class="collapse @if (request()->segment(2) == 'Community' ||
                request()->segment(2) == 'help' ||
                request()->segment(2) == 'laws' ||
                request()->segment(2) == 'pricing') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('escort.dashboard.Community.abbreviations') }}">
                    <img src="{{ asset('assets/app/img/Abrieviations.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'Community' ? 'color: #e5365a;' : '' }}">Abbreviations</span>
                </a>
                <a class="collapse-item" href="{{ route('escort.dashboard.Community.help') }}">
                    <img src="{{ asset('assets/app/img/helptips.png') }}">
                    <span style="{{ request()->segment(2) == 'help' ? 'color: #e5365a;' : '' }}">Help & Tips</span>
                </a>

                <a class="collapse-item" href="{{ route('escort.dashboard.Community.laws') }}">
                    <img src="{{ asset('assets/app/img/gavel.png') }}">
                    <span style="{{ request()->segment(2) == 'laws' ? 'color: #e5365a;' : 'laws' }}">Local
                        Laws</span>
                </a>

                <a class="collapse-item" href="{{ route('escort.dashboard.Community.pricing') }}">
                    <img src="{{ asset('assets/app/img/dollar.png') }}">
                    <span style="{{ request()->segment(2) == 'pricing' ? 'color: #e5365a;' : 'pricing' }}">Pricing
                        Summary</span>
                </a>
            </div>
        </div>

    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
            </img>
            <span>Concierge</span>
        </a>
        <div id="Concierge" class="collapse  @if (request()->segment(2) == 'accommodation' ||
                request()->segment(2) == 'email-hosting' ||
                request()->segment(2) == 'mobile-read-sim' ||
                request()->segment(2) == 'professional-products' ||
                request()->segment(2) == 'travel' ||
                request()->segment(2) == 'visa-migration') show @endif"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ url('escort-dashboard/accommodation') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/bed.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'accommodation' ? 'color: #e5365a;' : '' }}">Accommodation</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/email-hosting') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                    </img><span style="{{ request()->segment(2) == 'email-hosting' ? 'color: #e5365a;' : '' }}">Email
                        Account</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/mobile-read-sim') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'mobile-read-sim' ? 'color: #e5365a;' : '' }}">Mobile
                        SIM</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/professional-products') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'professional-products' ? 'color: #e5365a;' : '' }}">Products</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/travel') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/wallet-travel.png') }}">
                    </img><span
                        style="{{ request()->segment(2) == 'travel' ? 'color: #e5365a;' : '' }}">Travel</span>
                </a>
                <a class="collapse-item" href="{{ url('escort-dashboard/visa-migration') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Migration.png') }}">
                    </img><span style="{{ request()->segment(2) == 'visa-migration' ? 'color: #e5365a;' : '' }}">Visa
                        & Education</span>
                </a>
            </div>
        </div>
    </li>

    {{-- How is it Done --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masseurs"
            aria-expanded="true" aria-controls="collapseTwo">
            <img src="{{ asset('assets/dashboard/img/menu-icon/how-quest.png') }}">
            <span>How is it Done</span>
        </a>
        <div id="masseurs" class="collapse @if (request()->segment(2) == 'editmyaccount' ||
                request()->segment(2) == 'my-information' ||
                request()->segment(2) == 'listings' ||
                request()->segment(2) == 'media' ||
                request()->segment(2) == 'profiles' ||
                request()->segment(2) == 'tours') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('escort.editmyaccount') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/icons-account.png') }}">
                    <span style="{{ request()->segment(2) == 'editmyaccount' ? 'color: #e5365a;' : '' }}">Edit My
                        Account</span>
                </a>
                <a class="collapse-item" href="{{ route('escort.my-information') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/information-24.png') }}">
                    <span style="{{ request()->segment(2) == 'my-information' ? 'color: #e5365a;' : '' }}">My
                        Information</span>
                </a>

                <a class="collapse-item" href="{{ route('escort.listings') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/listing-24.png') }}">
                    <span style="{{ request()->segment(2) == 'listings' ? 'color: #e5365a;' : '' }}">Listings</span>
                </a>

                <a class="collapse-item" href="{{ route('escort.media') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/media-24.png') }}">
                    <span style="{{ request()->segment(2) == 'media' ? 'color: #e5365a;' : '' }}">Media</span>
                </a>
                <a class="collapse-item" href="{{ route('escort.profiles') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/add-administrator-24.png') }}">
                    <span style="{{ request()->segment(2) == 'profiles' ? 'color: #e5365a;' : '' }}">Profiles</span>
                </a>
                <a class="collapse-item" href="{{ route('escort.tours') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/tour-24.png') }}">
                    <span style="{{ request()->segment(2) == 'tours' ? 'color: #e5365a;' : '' }}">Tours</span>
                </a>
            </div>
        </div>
    </li>

    {{-- //hidden for Wayne 20240715 --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reviews"
            aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/pachive.png')}}">
             <span style="{{request()->segment(2) == 'social' ? 'color: #e5365a;' : ''}}">My Reviews</span>
        </a>
        <div id="reviews" class="collapse  @if (request()->segment(2) == 'view-reviews' || request()->segment(2) == 'reccomendations') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{url('escort-dashboard/view-reviews')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png')}}">
                <span style="{{request()->segment(2) == 'view-reviews' ? 'color: #e5365a;' : ''}}">List</span>
            </a>
             <a class="collapse-item" href="{{url('escort-dashboard/reccomendations')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewtwo.png')}}">
                <span style="{{request()->segment(2) == 'reccomendations' ? 'color: #e5365a;' : ''}}">Recommendations</span>
            </a> 

            </div>
        </div>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ugly"
            aria-expanded="true" aria-controls="collapseten">
            <img src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png') }}">
            <span>NUM</span>
        </a>
        <div id="ugly" class=" collapse  @if (request()->segment(2) == 'num-dashboard' ||
                request()->segment(2) == 'add-report' ||
                request()->segment(2) == 'my-reports' ||
                request()->segment(2) == 'num-tips') show @endif;"
            aria-labelledby="headingten" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">

                <a id="myAnchor" class="collapse-item show" href="{{ route('escort.numdashboard') }}">
                    <img src="{{ asset('assets/img/dashboard-24.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'num-dashboard' ? 'color: #e5365a;' : '' }}">dashboard</span>
                </a>

                <a id="myAnchor" class="collapse-item show" href="{{ route('escort.add-report') }}">
                    <img src="{{ asset('assets/img/report-24.png') }}">
                    <span style="{{ request()->segment(2) == 'add-report' ? 'color: #e5365a;' : '' }}">Add
                        Report</span>
                </a>

                <a id="myAnchor" class="collapse-item show" href="{{ route('escort.my-reports') }}">
                    <img src="{{ asset('assets/img/8report-24.png') }}">
                    <span style="{{ request()->segment(2) == 'my-reports' ? 'color: #e5365a;' : '' }}">My
                        Reports</span>
                </a>

                <a id="myAnchor" class="collapse-item show" href="{{ route('escort.num-tips') }}">
                    <img src="{{ asset('assets/app/img/tips.png') }}">
                    <span style="{{ request()->segment(2) == 'num-tips' ? 'color: #e5365a;' : '' }}">Screening
                        Tips</span>
                </a>

            </div>
        </div>
    </li>




    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets"
            aria-expanded="true" aria-controls="collapseten">
            <img src="{{ asset('assets/app/img/ticket.png') }}">
            <span>Support Tickets</span>
        </a>
        <div id="tickets" class=" collapse  @if (request()->segment(2) == 'ticket-list' || request()->segment(1) == 'submit_ticket') show @endif;"
            aria-labelledby="headingten" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item show" href="{{ url('submit_ticket') }}">
                    <img src="{{ asset('assets/app/img/right-30.png') }}">
                    <span
                        style="{{ request()->segment(1) == 'submit_ticket' ? 'color: #e5365a;' : '' }}">Submit</span>
                </a>

                <a class="collapse-item" href="{{ route('support-ticket.list') }}">
                    <img src="{{ asset('assets/app/img/view-48.png') }}">
                    <span style="{{ request()->segment(2) == 'ticket-list' ? 'color: #e5365a;' : '' }}">View &
                        reply</span>
                </a>

                {{-- <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/to-do.png')}}">
                <span style="">Notification indicator <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; on Menu Bar</span>
            </a> --}}

            </div>
        </div>
    </li>





    <!--     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ugly"
            aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/Vector.png') }}">
             <span>Ugly Mugs Register</span>
        </a>
        <div id="ugly" class=" collapse  @if (request()->segment(2) == 'report') show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('escort.report') }}">
                <img src="{{ asset('assets/app/img/icons-bug.png') }}">
                <span style="{{ request()->segment(2) == 'report' || request()->segment(2) == 'report' ? 'color: #e5365a;' : '' }}">Report</span>
            </a>
            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/app/img/icons-list.png') }}">
                <span style="">Lookup</span>
            </a>
            </div>
        </div>
    </li> -->

    <!-- Heading -->

    <!--
    <li class="nav-item v-last-setting v-divider">
        <a class="nav-link py-0" href="#">
            <span class="v-icon">...</span>
             <span class="v-text">Settings</span>
        </a>
    </li>
-->







</ul>
<!-- End of Sidebar
escort.archives
-->
