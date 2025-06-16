
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
        <a class="nav-link" href="#">
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

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z" fill="#C2CFE0"></path>
            </svg>

            <span>My Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if(request()->segment(2) == 'update-account' || request()->segment(2) == 'profile-informations' || request()->segment(2) == 'change-password' || request()->segment(2) == 'upload-my-avatar') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
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
                    <a class="collapse-item" href="#">
                        <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                        <span style="{{request()->segment(2) == 'notifications-features' ? 'color: #e5365a;' : ''}}">Notifications & Features</span></a>
                <a class="collapse-item" href="{{route('center.profile.avatar')}}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png')}}">

                    <span style="{{request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : ''}}">Upload my avatar</span></a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listing" aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/listing.png')}}">

             <span>Listings</span>
        </a>
        <div id="listing" class="collapse @if(request()->segment(2) == 'profiles-tours' || request()->segment(2) == 'social-media' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="#">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/new-24.png')}}">
            <span style="{{request()->segment(2) == 'profiles-tours' ? 'color: #e5365a;' : ''}}">New</span>
            </a>
            <a class="collapse-item" href="#">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/at.png')}}">
            <span style="{{request()->segment(2) == 'social-media' ? 'color: #e5365a;' : ''}}">Current</span>
            </a>
            <a class="collapse-item" href="#">
                <img width="16" height="17" viewbox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/at.png')}}">
                <span style="{{request()->segment(2) == 'social-media' ? 'color: #e5365a;' : ''}}">Past</span>
                </a>
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pachive" aria-expanded="false" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/profile-archive.png')}}">
             <span >Profiles Centre</span>
        </a>
        <div id="pachive" class=" collapse  @if(request()->segment(2) == 'create-profile' || request()->segment(2) == 'profile' || request()->segment(2) == 'list' || request()->segment(2) == 'view-archives' || request()->segment(2) == 'archive-medias' || request()->segment(2) == 'archive-view-photos') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
            {{-- <a class="collapse-item" href="{{ route('center.profile-info.create-profile')}}"> --}}
            <a class="collapse-item" href="{{ route('center.profile')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png')}}">
                <span style="{{request()->segment(2) == 'create-profile' ? 'color: #e5365a;' : ''}}">New Profile</span>
            </a>
             <a class="collapse-item" href="{{ route('center.list')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png')}}">
                <span style="{{ request()->segment(2) == 'list' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Edit Profile</span>
            </a>

            <a class="collapse-item" href="{{ url('center-dashboard/view-archives') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png')}}">
                <span style="{{request()->segment(2) == 'view-archives' || request()->segment(2) == 'archive-medias' || request()->segment(2) == 'archive-view-photos' ? 'color: #e5365a;' : ''}}">View Archives</span>
            </a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#media-center" aria-expanded="false" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/media.png')}}">
             <span >Media Centre</span>
        </a>
        <div id="media-center" class=" collapse  @if(request()->segment(2) == 'create-profile' || request()->segment(2) == 'profile' || request()->segment(2) == 'list' || request()->segment(2) == 'view-archives' || request()->segment(2) == 'archive-medias' || request()->segment(2) == 'archive-view-photos') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
            {{-- <a class="collapse-item" href="{{ route('center.profile-info.create-profile')}}"> --}}
            <a class="collapse-item" href="{{ route('center.profile')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/photo-24.png')}}">
                <span style="{{request()->segment(2) == 'create-profile' ? 'color: #e5365a;' : ''}}">Photos</span>
            </a>
             <a class="collapse-item" href="{{ route('center.list')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/video-18.png')}}">
                <span style="{{ request()->segment(2) == 'list' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Videos</span>
            </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profiles-masseurs" aria-expanded="false" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/male-user-18.png')}}">
             <span >Profiles Masseurs</span>
        </a>
        <div id="profiles-masseurs" class=" collapse  @if(request()->segment(2) == 'create-profile' || request()->segment(2) == 'profile' || request()->segment(2) == 'list' || request()->segment(2) == 'view-archives' || request()->segment(2) == 'archive-medias' || request()->segment(2) == 'archive-view-photos') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
            {{-- <a class="collapse-item" href="{{ route('center.profile-info.create-profile')}}"> --}}
            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/account-multiple-plus.png')}}">
                <span style="{{request()->segment(2) == 'create-profile' ? 'color: #e5365a;' : ''}}">New</span>
            </a>
             <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png')}}">
                <span style="{{ request()->segment(2) == 'list' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Current</span>
            </a>
            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/viewachi.png')}}">
                <span style="{{ request()->segment(2) == 'list' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Past</span>
            </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#media-masseurs" aria-expanded="false" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/video-gallery-18.png')}}">
             <span >Media Masseurs</span>
        </a>
        <div id="media-masseurs" class=" collapse  @if(request()->segment(2) == 'create-profile' || request()->segment(2) == 'profile' || request()->segment(2) == 'list' || request()->segment(2) == 'view-archives' || request()->segment(2) == 'archive-medias' || request()->segment(2) == 'archive-view-photos') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
            {{-- <a class="collapse-item" href="{{ route('center.profile-info.create-profile')}}"> --}}
            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/photo-24.png')}}">
                <span style="{{request()->segment(2) == 'create-profile' ? 'color: #e5365a;' : ''}}">Photos</span>
            </a>
             <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/video-18.png')}}">
                <span style="{{ request()->segment(2) == 'list' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Videos</span>
            </a>
            </div>
        </div>
    </li>
    <hr style="border-top: 1px solid #C2CFE0;width: 100%;">
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

    <li class="nav-item active">
        <a class="nav-link" href="#">
            <img src="{{ asset('assets/dashboard/img/menu-icon/icons8-ledger-18.png')}}">
            <span>Bookkeeping</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#communication" aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/dashboard/img/menu-icon/ccone.png')}}">
             <span>Communication</span>
        </a>
        <div id="communication" class="collapse @if(request()->segment(2) == 'viewer-notes' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/comtwo.png')}}">
                <span style="">Legbox Notifications</span>
            </a>
             <a class="collapse-item" href="#">
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png')}}">
                <span style="">Send notification</span>
            </a>

            <a class="collapse-item" href="{{ route('viewer-notes')}}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccfour.png')}}">
            <span style="{{request()->segment(2) == 'viewer-notes' ? 'color: #e5365a;' : ''}}">Viewer Messaging</span>
            </a>
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
            <a class="collapse-item" href="{{ route('center.dashboard.Community.abbreviations') }}">
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

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Concierge"
            aria-expanded="true" aria-controls="Concierge">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{ asset('assets/dashboard/img/menu-icon/concigre.png')}}">
            </img>
             <span>Concierge</span>
        </a>

        <div id="Concierge" class="collapse @if(request()->segment(2) == 'accommodation' || request()->segment(2) == 'email-hosting' || request()->segment(2) == 'mobile-read-sim' || request()->segment(2) == 'professional-products' || request()->segment(2) == 'visa' )  show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
                <span style="{{request()->segment(2) == 'mobile-read-sim' ? 'color: #e5365a;' : ''}}">Mobile Read SIM</span>
            </a>

            <a class="collapse-item" href="{{ route('center.professional-products') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/pro-pro.png')}}">
                <span style="{{request()->segment(2) == 'professional-products' ? 'color: #e5365a;' : ''}}">Professional Products</span>
            </a>

            <!-- <a class="collapse-item" href="{{ route('center.travel') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/visa-mig.png')}}">
                <span style="{{request()->segment(2) == 'travel' ? 'color: #e5365a;' : ''}}">Travel</span>
            </a>  -->

            <a class="collapse-item" href="{{ route('center.visa') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/visa.png')}}">
                <span style="{{request()->segment(2) == 'visa' ? 'color: #e5365a;' : ''}}">Visa & Migration</span>
            </a>
            </div>
        </div>

    </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets" aria-expanded="true" aria-controls="collapseten">
             <img src="{{ asset('assets/app/img/ticket.png')}}">
             <span >Support tickets</span>
        </a>

        <div id="tickets" class=" collapse  @if(request()->segment(1) == 'support_tickets' || request()->segment(1) == 'submit_ticket') show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item show" href="{{ url('submit_ticket') }}">
                    <img src="{{ asset('assets/app/img/right-30.png')}}">
                    <span style="{{request()->segment(1) == 'submit_ticket'  ? 'color: #e5365a;' : ''}}">Submit ticket</span>
                </a>

                <a class="collapse-item"  href="{{ route('support-ticket.list')}}">
                    <img src="{{ asset('assets/app/img/view-48.png')}}">
                    <span style="{{request()->segment(2) == 'list'  ? 'color: #e5365a;' : ''}}">View & reply tickets</span>
                </a>
            </div>
        </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masseurs" aria-expanded="true" aria-controls="collapseTwo">
             <img src="{{ asset('assets/app/img/massage-table.png')}}">
             <span>Masseurs Profile</span>
        </a>
        <div id="masseurs" class="collapse ;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/app/img/profile.png')}}">
                <span style="">Add Profile</span>
            </a>
             <a class="collapse-item" href="#">
                <img src="{{ asset('assets/app/img/media.png')}}">
                <span style="">Add Media</span>
            </a>

            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/app/img/summary-list.png')}}">
                <span style="">Profiles Summary</span>
            </a>
            </div>
        </div>
    </li> --}}

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

    <li class="nav-item v-last-setting v-divider">
        <a class="nav-link py-0" href="#">
            <span class="v-icon">...</span>
             <span class="v-text">Settings</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->