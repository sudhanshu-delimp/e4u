
<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-0" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt="">
    </a>
     <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-4">Massage Centre Console</span>
    <!-- Divider -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href=" {{ route('center.dashboard')}}">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z" fill="#C2CFE0"></path>
            </svg>

            <span>My Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if(request()->segment(2) == 'update-account' || request()->segment(2) == 'profile-informations' || request()->segment(2) == 'change-password' || request()->segment(2) == 'notifications-and-features' || request()->segment(2) == 'upload-my-avatar') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('center.account.edit')}}">

                    <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                    <span style="{{request()->segment(2) == 'update-account' ? 'color: #e5365a;' : ''}}">Edit my account</span></a>
                   <a class="collapse-item" href="{{ route('center.profile.information')}}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">

                    <span style="{{request()->segment(2) == 'profile-informations' ? 'color: #e5365a;' : ''}}">Profile information</span></a>
                <a class="collapse-item" href="{{ route('center.change.password')}}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png')}}">

                    <span style="{{request()->segment(2) == 'change-password' ? 'color: #e5365a;' : ''}}">Change password</span></a>

                    <a class="collapse-item" href="{{ route('centre.notifications-and-features') }}">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                        <span style="{{request()->segment(2) == 'notifications-and-features' ? 'color: #e5365a;' : ''}}">Notifications & Features</span></a>
                <a class="collapse-item" href="{{route('center.profile.avatar')}}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png')}}">

                    <span style="{{request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : ''}}">Upload my avatar</span></a>

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
    {{-- Listings --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listings" aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/pachive.png')}}">

             <span>Listings</span>
        </a>
        <div id="listings" class="collapse @if(request()->segment(3) == 'add-listing' || request()->segment(3) == 'current'  || request()->segment(3) == 'past' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('center.add-listing') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png')}}">
            <span style="{{request()->segment(3) == 'add-listing' ? 'color: #e5365a;' : ''}}">New</span>
            </a>
            <a class="collapse-item" href="{{ route('center.current') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png')}}">
            <span style="{{request()->segment(3) == 'current' ? 'color: #e5365a;' : ''}}">Current</span>
            </a>
            <a class="collapse-item" href="{{ route('center.past') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png')}}">
            <span style="{{request()->segment(3) == 'past' ? 'color: #e5365a;' : ''}}">Past</span>
            </a>
            </div>
        </div>
    </li>

    {{-- Profile Management --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pachive" aria-expanded="false" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/add-profile-centre.png')}}">
             <span >Profile Management</span>
        </a>
        <div id="pachive" class=" collapse  @if(request()->segment(2) == 'create-profile' || request()->segment(2) == 'profile' || request()->segment(2) == 'list' || request()->segment(2) == 'view-archives' || request()->segment(2) == 'archive-medias' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
            {{-- <a class="collapse-item" href="{{ route('center.profile-info.create-profile')}}"> --}}
            <a class="collapse-item" href="{{ route('center.profile')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png')}}">
                <span style="{{request()->segment(2) == 'create-profile' ? 'color: #e5365a;' : ''}}">New Profile</span>
            </a>
             <a class="collapse-item" href="{{ route('center.list')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png')}}">
                <span style="{{ request()->segment(2) == 'list' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Our Profiles</span>
            </a>

            {{-- <a class="collapse-item" href="{{ url('center-dashboard/view-archives') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png')}}">
                <span style="{{request()->segment(2) == 'view-archives' || request()->segment(2) == 'archive-medias' || request()->segment(2) == 'archive-view-photos' ? 'color: #e5365a;' : ''}}">View Archives</span>
            </a> --}}

            </div>
        </div>
    </li>
    
    {{-- Media Centre --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mediaCentre" aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/media-centre.png')}}">

             <span>Media</span>
        </a>
        <div id="mediaCentre" class="collapse @if(request()->segment(2) == 'archive-view-photos' || request()->segment(3) == 'videos' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('cen.archive-view-photos') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/photo.png')}}">
            <span style="{{request()->segment(2) == 'archive-view-photos' ? 'color: #e5365a;' : ''}}">Photos</span>
            </a>
            <a class="collapse-item" href="{{ route('center.videos') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/video.png')}}">
            <span style="{{request()->segment(3) == 'videos' ? 'color: #e5365a;' : ''}}">Videos</span>
            </a>
            </div>
        </div>
    </li>

     {{-- Masseurs --}}
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profilesMasseurs" aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/masseur-profile.png')}}">

             <span>Masseurs</span>
        </a>
        
        <div id="profilesMasseurs" class="collapse @if(request()->segment(3) == 'add-profile' || request()->segment(3) == 'current-profile' || request()->segment(3) == 'past-profile' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('center.add-profile') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png')}}">
            <span style="{{request()->segment(3) == 'add-profile' ? 'color: #e5365a;' : ''}}">Profiles</span>
            </a>
            <a class="collapse-item" href="{{ route('center.current-profile') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png')}}">
            <span style="{{request()->segment(3) == 'current-profile' ? 'color: #e5365a;' : ''}}">Media</span>
            </a>
            {{-- <a class="collapse-item" href="{{ route('center.past-profile') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png')}}">
            <span style="{{request()->segment(3) == 'past-profile' ? 'color: #e5365a;' : ''}}">Past</span>
            </a> --}}
            </div>
        </div>
    </li>
    
    {{-- Media Masseurs --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mediaMasseurs" aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/media-masseur.png')}}">

             <span>Media Masseurs</span>
        </a>
        <div id="mediaMasseurs" class="collapse @if(request()->segment(3) == 'masseurs-photos' || request()->segment(3) == 'masseurs-videos' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('center.masseurs-photos') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/photo.png')}}">
            <span style="{{request()->segment(3) == 'masseurs-photos' ? 'color: #e5365a;' : ''}}">Photos</span>
            </a>
            <a class="collapse-item" href="{{ route('center.masseurs-videos') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/video.png')}}">
            <span style="{{request()->segment(3) == 'masseurs-videos' ? 'color: #e5365a;' : ''}}">Videos</span>
            </a>
            </div>
        </div>
    </li> --}}
    {{-- devider --}}
    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; /*padding:20px 0;*/"></li>
    {{-- Analytics --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics" aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/chart.png')}}">

             <span>Analytics</span>
        </a>
        <div id="Analytics" class="collapse @if(request()->segment(2) == 'profiles-tours' || request()->segment(2) == 'social-media' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('profiles-tours')}}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/bed.png')}}">
            <span style="{{request()->segment(2) == 'profiles-tours' ? 'color: #e5365a;' : ''}}">Profiles &amp; Tours</span>
            </a>
            <a class="collapse-item" href="{{ route('social-media')}}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/at.png')}}">
            <span style="{{request()->segment(2) == 'social-media' ? 'color: #e5365a;' : ''}}">Social Media</span>
            </a>
            </div>
        </div>
    </li>
    {{-- Bookkeeping --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('center.bookkeeping') }}">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/bookshelf.png')}}">

             <span>Bookkeeping</span>
        </a>
    </li>
    {{-- Communication --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#communication" aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/ccone.png')}}">
             <span>Communication</span>
        </a>
        <div id="communication" class="collapse @if(request()->segment(2) == 'agent-request' || request()->segment(2) == 'agent-messages' || request()->segment(2) == 'legbox-notification' || request()->segment(2) == 'viewer-notes' || request()->segment(2) == 'legbox-viewers') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('agent-request')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png')}}">
                <span style="{{request()->segment(2) == 'agent-request' ? 'color: #e5365a;' : ''}}">Agent Request</span>
            </a>
             <a class="collapse-item" href="{{ route('legbox-notification')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png')}}">
                <span style="{{request()->segment(2) == 'legbox-notification' ? 'color: #e5365a;' : ''}}">Legbox notification</span>
            </a>

            {{-- <a class="collapse-item" href="{{ route('viewer-notes')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccfour.png')}}">
            <span style="{{request()->segment(2) == 'viewer-notes' ? 'color: #e5365a;' : ''}}">Viewer Messaging</span>
            </a> --}}
            <a class="collapse-item" href="{{ route('agent-messages')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png')}}">
            <span style="{{request()->segment(2) == 'agent-messages' ? 'color: #e5365a;' : ''}}">Messages</span>
            </a>

            <a class="collapse-item" href="{{ route('legbox-viewers')}}">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 32 32" xml:space="preserve" fill="#C2CFE0"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"><style type="text/css"> .stone_een{fill:#C2CFE0;} .st0{fill:#C2CFE0;} </style><path class="stone_een" d="M4.042,12.706l0.59-4.13c0.041-0.284,0.126-0.57,0.233-0.851l0.005,0.014C5.351,6.705,6.387,6,7.579,6 h2.05C11.582,7.77,14.163,8.859,17,8.859S22.418,7.77,24.371,6h2.027c1.493,0,2.759,1.098,2.97,2.576l0.59,4.13 c-4.551-1.12-8.798-1.671-12.958-1.671C12.84,11.034,8.593,11.586,4.042,12.706L4.042,12.706z M17,7.859 c-2.488,0-4.759-0.914-6.509-2.418C12.24,3.928,14.506,3,17,3s4.76,0.928,6.509,2.441C21.759,6.944,19.488,7.859,17,7.859z M16,6h2 V5h-2V6z M3.052,12.564l0.59-4.13C3.73,7.82,3.97,7.262,4.303,6.773C3.694,6.135,2.753,5.819,1.756,6.108 C0.951,6.34,0.315,6.992,0.095,7.8c-0.375,1.379,0.4,2.63,1.57,3.046c0.34,0.694,0.813,1.303,1.371,1.824L3.052,12.564z M20,19h4v-3 h-4V19z M31,14.773v5.455c0,0.457-0.31,0.856-0.753,0.969C25.573,22.387,21.24,22.966,17,22.966c-4.24,0-8.573-0.579-13.247-1.769 C3.31,21.084,3,20.685,3,20.227v-5.455c0-0.457,0.31-0.856,0.753-0.969c0.081-0.021,0.159-0.037,0.24-0.058 c0.001,0,0.007,0.002,0.007,0.002v-0.003c4.579-1.148,8.836-1.71,13-1.71s8.421,0.562,13,1.71v0.003 c0.003,0.001,0.015,0.001,0.022,0.002c0.075,0.019,0.149,0.035,0.225,0.054C30.69,13.917,31,14.316,31,14.773z M15,16 c0-0.552-0.448-1-1-1h-4c-0.552,0-1,0.448-1,1v3c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1V16z M25,16c0-0.552-0.448-1-1-1h-4 c-0.552,0-1,0.448-1,1v3c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1V16z M10,19h4v-3h-4V19z M4.738,22.462 c0.075,0.465,0.141,0.931,0.233,1.393l0.547,2.734C5.798,27.991,7.029,29,8.46,29h17.081c1.43,0,2.661-1.009,2.942-2.412 l0.547-2.734c0.092-0.462,0.158-0.928,0.233-1.393c-4.289,1.007-8.315,1.504-12.262,1.504C13.053,23.966,9.027,23.469,4.738,22.462z "/></g></svg>
                <span style="{{request()->segment(2) == 'legbox-viewers' ? 'color: #e5365a;' : ''}}; padding-left:15px;">Legbox Viewers</span>
            </a>
            </div>
        </div>
    </li>
    {{-- dd(route('center.dashboard.Community.help')) --}}
    {{-- Community --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/com.png') }}">
            </img>
             <span>Community</span>
        </a>

        <div id="Community" class="collapse @if(request()->segment(2) == 'Community' || request()->segment(2) == 'help' || request()->segment(2) == 'laws' || request()->segment(2) == 'pricing' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('center.abbreviations') }}">
                <img src="{{ asset('assets/app/img/Abrieviations.png')}}">
                <span style="{{request()->segment(2) == 'Community' ? 'color: #e5365a;' : ''}}">Abbreviations</span>
            </a>
            
             <a class="collapse-item" href="{{ route('center.dashboard.Community.help') }}">
                <img src="{{ asset('assets/app/img/helptips.png')}}">
                <span style="{{request()->segment(2) == 'help' ? 'color: #e5365a;' : ''}}">Help & Tips</span>
            </a>

            <a class="collapse-item" href="{{ route('center.dashboard.Community.laws') }}">
                <img src="{{ asset('assets/app/img/gavel.png')}}">
                <span style="{{request()->segment(2) == 'laws' ? 'color: #e5365a;' : ''}}">Local Laws</span>
            </a>

            <a class="collapse-item" href="{{ route('center.dashboard.Community.pricing') }}">
                <img src="{{ asset('assets/app/img/dollar.png')}}">
                <span style="{{request()->segment(2) == 'pricing' ? 'color: #e5365a;' : ''}}">Pricing Summary</span>
            </a>
            </div>
        </div>

    </li>
    {{-- Concierge --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge"
            aria-expanded="true" aria-controls="Concierge">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/concigre.png')}}">
            </img>
            <span>Concierge</span>
        </a>

        <div id="Concierge" class="collapse @if(request()->segment(2) == 'accommodation' || request()->segment(2) == 'email-hosting' || request()->segment(2) == 'mobile-read-sim' || request()->segment(2) == 'professional-products' || request()->segment(2) == 'visa' || request()->segment(2) == 'travel')  show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('center.accommodation') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/acomdation.png')}}">
                <span style="{{request()->segment(2) == 'accommodation' ? 'color: #e5365a;' : ''}}">Accommodation</span>
            </a>
            <a class="collapse-item" href="{{ route('center.email-hosting') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/emailhosting.png')}}">
                <span style="{{request()->segment(2) == 'email-hosting' ? 'color: #e5365a;' : ''}}">Email Hosting</span>
            </a>

            <a class="collapse-item" href="{{ route('center.mobile-read-sim') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/mobile-read.png')}}">
                <span style="{{request()->segment(2) == 'mobile-read-sim' ? 'color: #e5365a;' : ''}}">Mobile SIM</span>
            </a>

            <a class="collapse-item" href="{{ route('center.professional-products') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/pro-pro.png')}}">
                <span style="{{request()->segment(2) == 'professional-products' ? 'color: #e5365a;' : ''}}">Professional Products</span>
            </a>

            <a class="collapse-item" href="{{ route('center.travel') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/visa-mig.png')}}">
                <span style="{{request()->segment(2) == 'travel' ? 'color: #e5365a;' : ''}}">Travel</span>
            </a>  

            <a class="collapse-item" href="{{ route('center.visa') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/visa.png')}}">
                <span style="{{request()->segment(2) == 'visa' ? 'color: #e5365a;' : ''}}">Visa & Migration</span>
            </a>
            </div>
        </div>

    </li>
    {{-- How is it Done --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masseurs" aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/how-quest.png')}}">
             <span>How is it Done</span>
        </a>
        <div id="masseurs" class="collapse @if(request()->segment(2) == 'editmyaccount' || request()->segment(2) == 'profile-information' || request()->segment(2) == 'listings' || request()->segment(2) == 'profiles-centre' || request()->segment(2) == 'media-centre' || request()->segment(2) == 'profiles-masseurs' || request()->segment(2) == 'media-masseurs')  show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('center.editmyaccount') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/icons-account.png')}}">
                <span style="{{request()->segment(2) == 'editmyaccount' ? 'color: #e5365a;' : ''}}">Edit My Account</span>
            </a>
             <a class="collapse-item" href="{{ route('center.profile-information') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/information-24.png')}}">
                <span style="{{request()->segment(2) == 'profile-information' ? 'color: #e5365a;' : ''}}">Profile Information</span>
            </a>

            <a class="collapse-item" href="{{ route('center.listings') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/listing-24.png')}}">
                <span style="{{request()->segment(2) == 'listings' ? 'color: #e5365a;' : ''}}">Listings</span>
            </a>
            <a class="collapse-item" href="{{ route('center.profiles-centre') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/center-24.png')}}">
                <span style="{{request()->segment(2) == 'profiles-centre' ? 'color: #e5365a;' : ''}}">Profiles Centre</span>
            </a>
            <a class="collapse-item" href="{{ route('center.media-centre') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/media-24.png')}}">
                <span style="{{request()->segment(2) == 'media-centre' ? 'color: #e5365a;' : ''}}">Media Centre</span>
            </a>
            <a class="collapse-item" href="{{ route('center.profiles-masseurs') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/wooden-massage-table-24.png')}}">
                <span style="{{request()->segment(2) == 'profiles-masseurs' ? 'color: #e5365a;' : ''}}">Profiles Masseurs</span>
            </a>
            <a class="collapse-item" href="{{ route('center.media-masseurs') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/masseur-24.png')}}">
                <span style="{{request()->segment(2) == 'media-masseurs' ? 'color: #e5365a;' : ''}}">Media Masseurs</span>
            </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ugly" aria-expanded="true" aria-controls="collapseten">
            <img src="{{ asset('assets/dashboard/img/menu-icon/list-one_NUM-Blue.png')}}">
            <span >NUM</span>
        </a>
            <div id="ugly" class=" collapse  @if(request()->segment(2) == 'numdashboard' || request()->segment(2) == 'add-report' || request()->segment(2) == 'my-reports' || request()->segment(2) == 'num-tips' ) show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar">
                <div class="py-0 collapse-inner rounded mb-2">

                    <a id="myAnchor" class="collapse-item show" href="{{ route('center.numdashboard') }}">
                        <img src="{{ asset('assets/img/dashboard-24.png')}}">
                        <span style="{{ request()->segment(2) == 'numdashboard' ? 'color: #e5365a;' : ''}}">dashboard</span>
                    </a>

                    <a id="myAnchor" class="collapse-item show" href="{{ route('center.add-report') }}">
                        <img src="{{ asset('assets/img/report-24.png')}}">
                        <span style="{{ request()->segment(2) == 'add-report' ? 'color: #e5365a;' : ''}}">Add Report</span>
                    </a>

                    <a id="myAnchor" class="collapse-item show" href="{{ route('center.my-reports') }}">
                        <img src="{{ asset('assets/img/8report-24.png')}}">
                        <span style="{{ request()->segment(2) == 'my-reports' ? 'color: #e5365a;' : ''}}">My Reports</span>
                    </a>

                    <a id="myAnchor" class="collapse-item show" href="{{ route('center.num-tips') }}">
                        <img src="{{ asset('assets/app/img/tips.png')}}">
                        <span style="{{ request()->segment(2) == 'num-tips' ? 'color: #e5365a;' : ''}}">NUM (Tips)</span>
                    </a>
                </div>
            </div>
        </li>

    {{-- Reviews --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reviews"
            aria-expanded="true" aria-controls="collapseTwo">
                <img src="{{ asset('assets/dashboard/img/menu-icon/pachive.png')}}">
                <span style="{{request()->segment(2) == 'social' ? 'color: #e5365a;' : ''}}">Reviews</span>
        </a>
        <div id="reviews" class="collapse  @if(request()->segment(2) == 'view-reviews' || request()->segment(2) == 'reccomendations') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{route('center.view-reviews')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png')}}">
                <span style="{{request()->segment(2) == 'view-reviews' ? 'color: #e5365a;' : ''}}">View Reviews</span>
            </a>
                <a class="collapse-item" href="{{route('center.reccomendations')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/reviewtwo.png')}}">
                <span style="{{request()->segment(2) == 'reccomendations' ? 'color: #e5365a;' : ''}}">Reccomendations</span>
            </a>

            </div>
        </div>
    </li> --}}
    {{-- Support tickets --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets" aria-expanded="true" aria-controls="collapseten">
             <img src="{{ asset('assets/app/img/ticket.png')}}">
             <span >Support tickets</span>
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

                {{--                <a class="collapse-item" href="#">--}}
                {{--                    <img src="{{ asset('assets/dashboard/img/menu-icon/to-do.png')}}">--}}
                {{--                    <span style="">Notification indicator <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; on Menu Bar</span>--}}
                {{--                </a>--}}

            </div>
        </div>
    </li>
    {{-- Ugly Mugs Register --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ugly" aria-expanded="true" aria-controls="collapseten">
             <img src="{{ asset('assets/dashboard/img/menu-icon/Vector.png')}}">
             <span >Ugly Mugs Register</span>
        </a>
        <div id="ugly" class=" collapse  @if(request()->segment(2) == 'report' || request()->segment(2) == 'lookup' || request()->segment(2) == 'request-notification' ) show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
             <a class="collapse-item show" href="{{route('center.report')}}">
                <img src="{{ asset('assets/app/img/icons-bug.png')}}">
                <span style="{{ request()->segment(2) == 'report' ? 'color: #e5365a;' : ''}}">Make Report</span>
            </a>

            <a class="collapse-item" href="{{ url('center-dashboard/lookup') }}">
                <img src="{{ asset('assets/app/img/icons-list.png')}}">
                <span style="{{ request()->segment(2) == 'lookup' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Lookup</span>
            </a>

            <a class="collapse-item" href="{{ url('center-dashboard/request-notification') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png')}}">
                <span style="{{ request()->segment(2) == 'request-notification' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Request Notification</span>
            </a>

            </div>
        </div>
    </li> --}}

    {{-- <li class="nav-item v-last-setting v-divider">
        <a class="nav-link py-0" href="#">
            <span class="v-icon">...</span>
             <span class="v-text">Settings</span>
        </a>
    </li> --}}
</ul>
<!-- End of Sidebar -->