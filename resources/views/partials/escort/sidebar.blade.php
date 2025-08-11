<style>
    .sidebar {
        height: auto;
    }
</style>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-0" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " class="mb-3" alt="">
    </a>
    <span style="color:#FF3C5F;" class="font-weight-normal pl-3">Escort  Console</span>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->

    </br>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('escort.dashboard')}}">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="#C2CFE0" />
            </svg>
           <span id="dash" style="{{  $_SERVER['REQUEST_URI'] == '/escort-dashboard' ? 'color: #e5365a;' : ''}}">Dashboard</span>


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
        <div id="collapseTwo" class="collapse @if(request()->segment(2) == 'profile-information' || request()->segment(2) == 'update-account' || request()->segment(2) == 'my-play-mates' || request()->segment(2) == 'profile-informations' || request()->segment(2) == 'change-password' || request()->segment(2) == 'notifications-features' || request()->segment(2) == 'upload-my-avatar') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('escort.account.edit')}}">

                    <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                    <span style="{{request()->segment(2) == 'update-account' ? 'color: #e5365a;' : ''}}">Edit my account</span></a>
                    <a class="collapse-item" href="{{ route('escort.profile.information')}}">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">

                    <span style="{{request()->segment(2) == 'profile-information' ? 'color: #e5365a;' : ''}}">My information</span></a>
                <a class="collapse-item" href="{{ route('escort.change.password')}}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                    <span style="{{request()->segment(2) == 'change-password' ? 'color: #e5365a;' : ''}}">Change password</span></a>
                <a class="collapse-item" href="{{route('escort.profile.notifications')}}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                    <span style="{{request()->segment(2) == 'notifications-features' ? 'color: #e5365a;' : ''}}">Notifications & Features</span></a>
                <a class="collapse-item" href="{{route('escort.profile.avatar')}}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                    <span style="{{request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : ''}}">Upload my avatar</span></a>

            </div>
        </div>
    </li>
{{-- LISTINGS SECTION --}}
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listingMenu"
       aria-expanded="true" aria-controls="listingMenu">
        <img src="{{ asset('assets/dashboard/img/menu-icon/list-one.png') }}"/>
        <span>Listings</span>
    </a>

    <div id="listingMenu" class="collapse  
        @if(request()->segment(2) == 'add-listing' || 
            (request()->segment(2) == 'listings' && in_array(request()->segment(3), ['current', 'past'])))
        show @endif"
        aria-labelledby="headingListing" data-parent="#accordionSidebar">

        <div class="py-0 collapse-inner rounded mb-2">

            <a class="collapse-item" href="{{ route('escort.account.add-listing') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/add-exot.png') }}"/>
                <span class="{{ request()->segment(2) == 'add-listing' ? 'menu-active' : '' }}">New</span>
            </a>

            <a class="collapse-item" href="{{ route('escort.dashboard.listings', 'current') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}"/>
                <span class="{{ request()->segment(2) == 'listings' && request()->segment(3) == 'current' ? 'menu-active' : '' }}">Current</span>
            </a>

            <a class="collapse-item" href="{{ route('escort.dashboard.listings', 'past') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/clipboard.png') }}"/>
                <span class="{{ request()->segment(2) == 'listings' && request()->segment(3) == 'past' ? 'menu-active' : '' }}">Past</span>
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

    <div id="profileMenu"
         class="collapse @if(
             request()->segment(2) == 'create-profile' ||
             request()->segment(2) == 'profile' ||
             (request()->segment(2) == 'list' && in_array(request()->segment(3), ['current', 'listed', 'past', 'archive']))
         ) show @endif"
         aria-labelledby="headingProfile" data-parent="#accordionSidebar">

        <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('escort.profile') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                <span class="{{ request()->segment(2) == 'create-profile' ? 'menu-active' : '' }}">New</span>
            </a>
            <a class="collapse-item" href="{{ route('escort.list', 'current') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                <span class="{{ request()->segment(2) == 'list' && request()->segment(3) == 'current' ? 'menu-active' : '' }}">Listed</span>
            </a>
            <a class="collapse-item" href="{{ route('escort.list', 'past') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/list-archive.png') }}">
                <span class="{{ request()->segment(2) == 'list' && request()->segment(3) == 'past' ? 'menu-active' : '' }}">Archive</span>
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

    <div id="tourMenu"
         class="collapse @if(
             request()->segment(2) == 'create-tour' || 
             (request()->segment(2) == 'list-tour' && in_array(request()->segment(3), ['current', 'past']))
         ) show @endif"
         aria-labelledby="headingTour" data-parent="#accordionSidebar">

        <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ url('escort-dashboard/create-tour') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                <span class="{{ request()->segment(2) == 'create-tour' ? 'menu-active' : '' }}">New</span>
            </a>

            <a class="collapse-item" href="{{ url('escort-dashboard/list-tour/current') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                <span class="{{ request()->segment(2) == 'list-tour' && request()->segment(3) == 'current' ? 'menu-active' : '' }}">Current</span>
            </a>

            <a class="collapse-item" href="{{ url('escort-dashboard/list-tour/past') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/clipboard.png') }}">
                <span class="{{ request()->segment(2) == 'list-tour' && request()->segment(3) == 'past' ? 'menu-active' : '' }}">Past</span>
            </a>
            
        </div>
    </div>
</li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pmedia"
           aria-expanded="true" aria-controls="collapseTwo">
            <img class="cstm-excort" src="{{ asset('assets/dashboard/img/menu-icon/media-exort.png')}}">
            <span>Media</span>
        </a>
        <div id="pmedia" class="collapse  @if(request()->segment(2) == 'archive-medias' || request()->segment(2) == 'archive-view-photos' || request()->segment(2) == 'archive-view-videos' || request()->segment(2) == 'pricarchive-myplayboxing') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                                {{-- <a class="collapse-item" href="{{ route('escort.archives') }}"> --}}
                {{--<a class="collapse-item" href="{{ url('escort-dashboard/archive-medias') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png')}}">
                    <span style=
                          @if( request()->segment(2) == 'archive-medias') "color: #e5365a;" @endif
                >View Media</span>
                </a>--}}
                <a class="collapse-item" href="{{route('escort.archive-view-photos')}}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/photo-camera.png')}}">
                    <span style=
                          @if( request()->segment(2) == 'archive-view-photos') "color: #e5365a;" @endif
                >Photos</span>
                </a>
                <a class="collapse-item" href="{{route('escort.archive-view-videos')}}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/clapperboard.png')}}">
                    <span style=
                          @if( request()->segment(2) == 'archive-view-videos') "color: #e5365a;" @endif
                >Videos</span>
                </a>
                <a class="collapse-item" href="{{ route('escort.archive-myplaybox') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/play-25.png') }}"/>
                    <span style="@if(request()->segment(2) == 'pricarchive-myplayboxing') color: #e5365a; @endif">
                        My Playbox
                    </span>
                </a>
            </div>
        </div>
    </li>


    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; /*padding:20px 0;*/"></li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/chart.png') }}">
            </img>
             <span>Analytics</span>
        </a>
        <div id="Analytics" class="collapse @if(request()->segment(2) == 'profiles-tours' || request()->segment(2) == 'social-media') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{url('escort-dashboard/profiles-tours')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/bed.png') }}">
            </img><span style="{{request()->segment(2) == 'profiles-tours' ? 'color: #e5365a;' : ''}}">Profiles & Tours</span>
            </a>
            <a class="collapse-item" href="{{url('escort-dashboard/social-media')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/at.png') }}">
            </img><span style="{{request()->segment(2) == 'social-media' ? 'color: #e5365a;' : ''}}">Social Media</span>
            </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Bookkeeping"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/bookshelf.png') }}">
            </img>
             <span>Bookkeeping</span>
        </a>
        <div id="Bookkeeping" class="collapse  @if(request()->segment(2) == 'bank_account' || request()->segment(2) == 'credit-my-account' || request()->segment(2) == 'revenue-manager' || request()->segment(2) == 'my-bank-account' || request()->segment(2) == 'transaction-summary' || request()->segment(2) == 'transaction-history') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('escort.bank_account')}}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                         src="{{asset('assets/app/img/sales-performance.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'bank_account' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Bank Account</span>
                </a>
                <a class="collapse-item" href="{{url('escort-dashboard/credit-my-account')}}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                         src="{{asset('assets/dashboard/img/menu-icon/credit-card-plus.png') }}">
                    </img><span style="{{request()->segment(2) == 'credit-my-account' ? 'color: #e5365a;' : ''}}">Add Credit</span>
                </a>
                
                <a class="collapse-item" href="{{url('escort-dashboard/revenue-manager')}}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                         src="{{asset('assets/dashboard/img/menu-icon/piggy-bank.png') }}">
                    </img><span style="{{request()->segment(2) == 'revenue-manager' ? 'color: #e5365a;' : ''}}">Revenue Manager</span>
                </a>
                <a class="collapse-item" href="{{url('escort-dashboard/transaction-summary')}}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                         src="{{asset('assets/dashboard/img/menu-icon/credit-card-settings.png') }}">
                    </img><span style="{{request()->segment(2) == 'transaction-summary' ? 'color: #e5365a;' : ''}}">Transaction summary</span>
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
             <img src="{{ asset('assets/dashboard/img/menu-icon/ccone.png')}}">
             <span>Communication</span>
        </a>
        <div id="communication" class="collapse @if(request()->segment(2) == 'escort-agency-request' || request()->segment(2) == 'send-notofications' || request()->segment(2) == 'my-legbox-viewers' || request()->segment(2) == 'viewers-messages'  || request()->segment(2) == 'agent-messages' || request()->segment(2) == 'viewer-notes' || request()->segment(2) == 'viewer-messaging') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{url('escort-dashboard/escort-agency-request')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png')}}">
                <span style="{{request()->segment(2) == 'escort-agency-request' ? 'color: #e5365a;' : ''}}">Agent Request</span>
            </a>
             <a class="collapse-item" href="{{url('escort-dashboard/send-notofications')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png')}}">
                <span style="{{request()->segment(2) == 'send-notofications' ? 'color: #e5365a;' : ''}}">Legbox notifications</span>
            </a>
            <a class="collapse-item" href="{{ route('escort.dashboard.my-legbox-viewers')}}">
               <img src="{{ asset('assets/dashboard/img/menu-icon/legbox.png')}}">
               <span style="{{request()->segment(2) == 'my-legbox-viewers' ? 'color: #e5365a;' : ''}}">Legbox Viewer</span>
           </a>
           <a class="collapse-item" href="{{ route('escort.dashboard.agent-messages')}}">
              <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png')}}">
              <span style="{{request()->segment(2) == 'agent-messages' ? 'color: #e5365a;' : ''}}">Messages</span>
          </a>

            {{--<a class="collapse-item" href="{{url('escort-dashboard/viewer-notes')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccfour.png')}}">
                <span style="{{request()->segment(2) == 'viewer-notes' ? 'color: #e5365a;' : ''}}">Viewer Notes</span>
            </a>
            <a class="collapse-item" href="{{ route('escort.viewer-messaging') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{request()->segment(2) == 'viewer-messaging' ? 'color: #e5365a;' : ''}}">Viewer Messaging</span>
            </a>--}}
            </div>
        </div>
    </li>

         <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/com.png') }}">
            </img>
             <span>Community</span>
        </a>

        <div id="Community" class="collapse @if(request()->segment(2) == 'Community' || request()->segment(2) == 'help' || request()->segment(2) == 'laws' || request()->segment(2) == 'pricing' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('escort.dashboard.Community.abbreviations') }}">
                <img src="{{ asset('assets/app/img/Abrieviations.png')}}">
                <span style="{{request()->segment(2) == 'Community' ? 'color: #e5365a;' : ''}}">Abbreviations</span>
            </a>
             <a class="collapse-item" href="{{ route('escort.dashboard.Community.help') }}">
                <img src="{{ asset('assets/app/img/helptips.png')}}">
                <span style="{{request()->segment(2) == 'help' ? 'color: #e5365a;' : ''}}">Help & Tips</span>
            </a>

            <a class="collapse-item" href="{{ route('escort.dashboard.Community.laws') }}">
                <img src="{{ asset('assets/app/img/gavel.png')}}">
                <span style="{{request()->segment(2) == 'laws' ? 'color: #e5365a;' : 'laws'}}">Local Laws</span>
            </a>

            <a class="collapse-item" href="{{ route('escort.dashboard.Community.pricing') }}">
                <img src="{{ asset('assets/app/img/dollar.png')}}">
                <span style="{{request()->segment(2) == 'pricing' ? 'color: #e5365a;' : 'pricing'}}">Pricing Summary</span>
            </a>
            </div>
        </div>

    </li>

     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/package-variant-closed.png') }}">
            </img>
             <span >Concierge</span>
        </a>
        <div id="Concierge" class="collapse  @if(request()->segment(2) == 'accommodation' || request()->segment(2) == 'email-hosting' || request()->segment(2) == 'mobile-read-sim' || request()->segment(2) == 'professional-products' || request()->segment(2) == 'travel' || request()->segment(2) == 'visa-migration') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{url('escort-dashboard/accommodation')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/bed.png') }}">
            </img><span style="{{request()->segment(2) == 'accommodation' ? 'color: #e5365a;' : ''}}">Accommodation</span>
            </a>
            <a class="collapse-item" href="{{url('escort-dashboard/email-hosting')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/at.png') }}">
            </img><span style="{{request()->segment(2) == 'email-hosting' ? 'color: #e5365a;' : ''}}">Email Account</span>
            </a>
            <a class="collapse-item" href="{{url('escort-dashboard/mobile-read-sim')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/cellphone-text.png') }}">
            </img><span style="{{request()->segment(2) == 'mobile-read-sim' ? 'color: #e5365a;' : ''}}">Mobile SIM</span>
            </a>
            <a class="collapse-item" href="{{url('escort-dashboard/professional-products')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/cart-variant.png') }}">
            </img><span style="{{request()->segment(2) == 'professional-products' ? 'color: #e5365a;' : ''}}">Products</span>
            </a>
            <a class="collapse-item" href="{{url('escort-dashboard/travel')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/wallet-travel.png') }}">
            </img><span style="{{request()->segment(2) == 'travel' ? 'color: #e5365a;' : ''}}">Travel</span>
            </a>
            <a class="collapse-item" href="{{url('escort-dashboard/visa-migration')}}">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/Migration.png') }}">
            </img><span  style="{{request()->segment(2) == 'visa-migration' ? 'color: #e5365a;' : ''}}">Visa & Education</span>
            </a>
            </div>
        </div>
    </li>
<?php
/*  //hidden for Wayne 20240715
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reviews"
            aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/pachive.png')}}">
             <span style="{{request()->segment(2) == 'social' ? 'color: #e5365a;' : ''}}">Reviews</span>
        </a>
        <div id="reviews" class="collapse  @if(request()->segment(2) == 'view-reviews' || request()->segment(2) == 'reccomendations') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{url('escort-dashboard/view-reviews')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png')}}">
                <span style="{{request()->segment(2) == 'view-reviews' ? 'color: #e5365a;' : ''}}">View Reviews</span>
            </a>
             <a class="collapse-item" href="{{url('escort-dashboard/reccomendations')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewtwo.png')}}">
                <span style="{{request()->segment(2) == 'reccomendations' ? 'color: #e5365a;' : ''}}">Recommendations</span>
            </a>

            </div>
        </div>
    </li>
*/
?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ugly" aria-expanded="true" aria-controls="collapseten">
            <img src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png')}}">
            <span >NUM</span>
        </a>
            <div id="ugly" class=" collapse  @if(request()->segment(2) == 'numdashboard' || request()->segment(2) == 'add-report' || request()->segment(2) == 'my-reports' || request()->segment(2) == 'num-tips' ) show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar">
                <div class="py-0 collapse-inner rounded mb-2">

                    <a id="myAnchor" class="collapse-item show" href="{{ route('escort.numdashboard') }}">
                        <img src="{{ asset('assets/img/dashboard-24.png')}}">
                        <span style="{{ request()->segment(2) == 'numdashboard' ? 'color: #e5365a;' : ''}}">dashboard</span>
                    </a>

                    <a id="myAnchor" class="collapse-item show" href="{{ route('escort.add-report') }}">
                        <img src="{{ asset('assets/img/report-24.png')}}">
                        <span style="{{ request()->segment(2) == 'add-report' ? 'color: #e5365a;' : ''}}">Add Report</span>
                    </a>

                    <a id="myAnchor" class="collapse-item show" href="{{ route('escort.my-reports') }}">
                        <img src="{{ asset('assets/img/8report-24.png')}}">
                        <span style="{{ request()->segment(2) == 'my-reports' ? 'color: #e5365a;' : ''}}">My Reports</span>
                    </a>

                    <a id="myAnchor" class="collapse-item show" href="{{ route('escort.num-tips') }}">
                        <img src="{{ asset('assets/app/img/tips.png')}}">
                        <span style="{{ request()->segment(2) == 'num-tips' ? 'color: #e5365a;' : ''}}">NUM (Tips)</span>
                    </a>

                </div>
            </div>
        </li>
    <!-- Divider -->

    <!-- Nav Item - Pages Collapse Menu -->

    <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Escorts"
            aria-expanded="true" aria-controls="collapseTwo">
            <svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14 10.7207C11.3 10.7207 6 12.0207 6 14.7207V16.7207H22V14.7207C22 12.0207 16.7 10.7207 14 10.7207ZM14 8.7207C15.0609 8.7207 16.0783 8.29928 16.8284 7.54913C17.5786 6.79899 18 5.78157 18 4.7207C18 3.65984 17.5786 2.64242 16.8284 1.89228C16.0783 1.14213 15.0609 0.720703 14 0.720703C12.9391 0.720703 11.9217 1.14213 11.1716 1.89228C10.4214 2.64242 10 3.65984 10 4.7207C10 5.78157 10.4214 6.79899 11.1716 7.54913C11.9217 8.29928 12.9391 8.7207 14 8.7207ZM4 11.7207L3.4 11.2207C1.4 9.3207 0 8.1207 0 6.6207C0 5.4207 1 4.4207 2.2 4.4207C2.9 4.4207 3.6 4.7207 4 5.2207C4.4 4.7207 5.1 4.4207 5.8 4.4207C7 4.4207 8 5.3207 8 6.6207C8 8.1207 6.6 9.3207 4.6 11.2207L4 11.7207Z"
                    fill="#C2CFE0" />
            </svg>

            <span>My Escorts</span>
        </a>
        <div id="Escorts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="#">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>

                    List of escorts</a>
                <a class="collapse-item" href="#">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.00023 3.7208H12.0002L15.2902 0.420798C15.3832 0.32707 15.4938 0.252676 15.6156 0.201907C15.7375 0.151138 15.8682 0.125 16.0002 0.125C16.1322 0.125 16.2629 0.151138 16.3848 0.201907C16.5067 0.252676 16.6173 0.32707 16.7102 0.420798L19.2902 3.0108C19.4765 3.19816 19.581 3.45161 19.581 3.7158C19.581 3.97998 19.4765 4.23344 19.2902 4.4208L17.0002 6.7208H9.00023V8.7208C9.00023 8.98602 8.89487 9.24037 8.70733 9.42791C8.5198 9.61544 8.26544 9.7208 8.00023 9.7208C7.73501 9.7208 7.48066 9.61544 7.29312 9.42791C7.10558 9.24037 7.00023 8.98602 7.00023 8.7208V5.7208C7.00023 5.19037 7.21094 4.68166 7.58601 4.30658C7.96109 3.93151 8.46979 3.7208 9.00023 3.7208ZM3.00023 8.7208V12.7208L0.710226 15.0108C0.523975 15.1982 0.419434 15.4516 0.419434 15.7158C0.419434 15.98 0.523975 16.2334 0.710226 16.4208L3.29023 19.0108C3.38319 19.1045 3.49379 19.1789 3.61565 19.2297C3.73751 19.2805 3.86821 19.3066 4.00023 19.3066C4.13224 19.3066 4.26294 19.2805 4.3848 19.2297C4.50666 19.1789 4.61726 19.1045 4.71023 19.0108L9.00023 14.7208H13.0002C13.2654 14.7208 13.5198 14.6154 13.7073 14.4279C13.8949 14.2404 14.0002 13.986 14.0002 13.7208V12.7208H15.0002C15.2654 12.7208 15.5198 12.6154 15.7073 12.4279C15.8949 12.2404 16.0002 11.986 16.0002 11.7208V10.7208H17.0002C17.2654 10.7208 17.5198 10.6154 17.7073 10.4279C17.8949 10.2404 18.0002 9.98602 18.0002 9.7208V8.7208H11.0002V9.7208C11.0002 10.2512 10.7895 10.7599 10.4144 11.135C10.0394 11.5101 9.53066 11.7208 9.00023 11.7208H7.00023C6.46979 11.7208 5.96109 11.5101 5.58601 11.135C5.21094 10.7599 5.00023 10.2512 5.00023 9.7208V6.7208L3.00023 8.7208Z"
                            fill="#C2CFE0" />
                    </svg>

                    Agent request</a>
                <a class="collapse-item" href="#">
                    <svg width="16" height="21" viewBox="0 0 16 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 3.7207V2.7207C12 2.19027 11.7893 1.68156 11.4142 1.30649C11.0391 0.931417 10.5304 0.720703 10 0.720703H6C5.46957 0.720703 4.96086 0.931417 4.58579 1.30649C4.21071 1.68156 4 2.19027 4 2.7207V3.7207C2.93913 3.7207 1.92172 4.14213 1.17157 4.89228C0.421427 5.64242 0 6.65984 0 7.7207V18.7207C0 19.2511 0.210714 19.7598 0.585786 20.1349C0.960859 20.51 1.46957 20.7207 2 20.7207H14C14.5304 20.7207 15.0391 20.51 15.4142 20.1349C15.7893 19.7598 16 19.2511 16 18.7207V7.7207C16 6.65984 15.5786 5.64242 14.8284 4.89228C14.0783 4.14213 13.0609 3.7207 12 3.7207ZM6 2.7207H10V3.7207H6V2.7207ZM8 7.7207L10 9.7207L8 11.7207L6 9.7207L8 7.7207ZM14 18.7207H2V14.7207H4V16.7207H5V14.7207H14V18.7207ZM14 13.7207H2V7.7207C2 7.19027 2.21071 6.68156 2.58579 6.30649C2.96086 5.93142 3.46957 5.7207 4 5.7207H12C12.5304 5.7207 13.0391 5.93142 13.4142 6.30649C13.7893 6.68156 14 7.19027 14 7.7207V13.7207Z"
                            fill="#C2CFE0" />
                    </svg>

                    Tour</a>
                <a class="collapse-item" href="#">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.5 8.3507C13.31 5.5607 12.18 2.8407 10.06 0.720703C7.92 2.8607 6.74 5.5807 6.5 8.3507C7.79 9.0307 8.97 9.9107 10 10.9807C11.03 9.9207 12.21 9.0407 13.5 8.3507ZM10 14.1707C7.85 10.8907 4.18 8.7207 0 8.7207C0 18.7207 9.32 20.6107 10 20.7207C10.68 20.6007 20 18.7207 20 8.7207C15.82 8.7207 12.15 10.8907 10 14.1707Z"
                            fill="#C2CFE0" />
                    </svg>

                    Massage Escort</a>
            </div>
        </div>
    </li>-->




<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets" aria-expanded="true" aria-controls="collapseten">
             <img src="{{ asset('assets/app/img/ticket.png')}}">
             <span >Submit Ticket</span>
        </a>
        <div id="tickets" class=" collapse  @if(request()->segment(2) == 'ticket-list' || request()->segment(1) == 'submit_ticket') show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
             <a class="collapse-item show" href="{{ url('submit_ticket') }}">
                <img src="{{ asset('assets/app/img/right-30.png')}}">
                <span style="{{request()->segment(1) == 'submit_ticket'  ? 'color: #e5365a;' : ''}}">Submit</span>
            </a>

            <a class="collapse-item"  href="{{ route('support-ticket.list')}}">
                <img src="{{ asset('assets/app/img/view-48.png')}}">
                <span style="{{request()->segment(2) == 'ticket-list'  ? 'color: #e5365a;' : ''}}">View & reply</span>
            </a>

            {{--<a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/to-do.png')}}">
                <span style="">Notification indicator <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; on Menu Bar</span>
            </a>--}}

            </div>
        </div>
    </li>





<!--     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ugly"
            aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/Vector.png')}}">
             <span>Ugly Mugs Register</span>
        </a>
        <div id="ugly" class=" collapse  @if(request()->segment(2) == 'report') show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('escort.report') }}">
                <img src="{{ asset('assets/app/img/icons-bug.png')}}">
                <span style="{{ request()->segment(2) == 'report' || request()->segment(2) == 'report' ? 'color: #e5365a;' : ''}}">Report</span>
            </a>
            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/app/img/icons-list.png')}}">
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
