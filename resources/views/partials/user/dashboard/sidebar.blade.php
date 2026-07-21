<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sidebaar-custom db-custom-sidebar"
    id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
      <img src="{{ asset('assets/app/img/logo.svg') }} " alt="">
      </a> -->
    <a class="sidebar-brand text-left pb-1" href="{{ route('home') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3 e4u_logo" alt=""><br>

    </a>
    <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-2">Viewer Console</span>
    <!-- Divider -->
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="white" />
            </svg>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount"
            aria-expanded="true" aria-controls="myaccount">
            <img src="{{ asset('assets/dashboard/img/menu-icon/my-account.png') }}" alt="">

            <span>My Account</span>
        </a>
        <div id="myaccount" class="collapse @if (request()->segment(2) == 'update-account' ||
                request()->segment(2) == 'change-features' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'notifications-features' ||
                request()->segment(2) == 'upload-my-avatar') show @endif;" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('user.account.edit') }}">

                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                    <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">Edit my
                        account</span>
                </a>
                <a class="collapse-item" href="{{ route('user.change.password') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                    <span style="{{ request()->segment(2) == 'change-password' ? 'color: #e5365a;' : '' }}">Change
                        password</span>
                </a>
                <a class="collapse-item" href="{{ route('change-features') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/change-feature.png') }}">

                    <span style="{{ request()->segment(2) == 'change-features' ? 'color: #e5365a;' : '' }}">Change
                        features</span>
                </a>

                <a class="collapse-item" href="{{ route('user.profile.notifications') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                    <span
                        style="{{ request()->segment(2) == 'notifications-features' ? 'color: #e5365a;' : '' }}">Notifications</span>
                </a>

                <a class="collapse-item" href="{{ route('user.profile.avatar') }}">
                    <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                    <span style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : '' }}">Upload my
                        avatar</span>
                </a>


            </div>
        </div>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo"
            aria-expanded="true">
            <img class="mr-2 pl-1 cstm--icon"
                src="{{ asset('assets/dashboard/img/menu-icon/Icon_MyLegbox-light.png') }}">
            <span>My Legbox</span>
        </a>
        <div id="collapseTwo" class=" collapse  @if (request()->segment(2) == 'escort-list' || request()->segment(2) == 'massage' || request()->segment(2) == 'my-legbox-notes') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2"> --}}
    {{-- <a class="collapse-item" href="{{ route('user.legbox.escort-list') }}">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3"
                        style="{{ request()->segment(2) == 'my-legbox-list' ? 'color: #e5365a;' : '' }} ">Escort
                        List</span>
                </a>
                <a class="collapse-item" href="{{ route('user.massage.legbox.list') }}">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3"
                        style="{{ request()->segment(2) == 'massage-legbox-list' ? 'color: #e5365a;' : '' }} ">Massage
                        List</span>
                </a> --}}
    {{-- <a class="collapse-item" href="{{ route('user.legbox.escort-list') }}">
                  <img src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png')}}">
                  <span style="{{request()->segment(2) == 'escort-list' ? 'color: #e5365a;' : ''}} ">Escort List</span>
               </a>
               <a class="collapse-item" href="{{ route('user.massage.legbox.list') }}">
                  <img src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png')}}">
                  <span style="{{request()->segment(2) == 'massage' ? 'color: #e5365a;' : ''}} ">Massage List</span>
               </a>
                <a class="collapse-item" href="{{ route('user.notes') }}">
                    <svg width="19" height="22" viewBox="0 0 19 22" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 5.7207V3.7207H2V2.7207C2 1.6207 2.9 0.720703 4 0.720703H10V7.7207L12.5 6.2207L15 7.7207V0.720703H16C17 0.720703 18 1.7207 18 2.7207V12.5207C17.1 12.0207 16.1 11.7207 15 11.7207C11.7 11.7207 9 14.4207 9 17.7207C9 18.8207 9.3 19.8207 9.8 20.7207H4C2.9 20.7207 2 19.7207 2 18.7207V17.7207H0V15.7207H2V11.7207H0V9.7207H2V5.7207H0ZM2 3.7207V5.7207H4V3.7207H2ZM2 17.7207H4V15.7207H2V17.7207ZM2 11.7207H4V9.7207H2V11.7207ZM14 13.7207V16.7207H11V18.7207H14V21.7207H16V18.7207H19V16.7207H16V13.7207H14Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3"
                        style="{{ request()->segment(2) == 'my-legbox-notes' ? 'color: #e5365a;' : '' }}">Legbox</span>
                </a>
            </div>
        </div>
    </li> --}}

   

   {{-- devider --}}
    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:10px 30px 15px 15px;">
    </li>
    {{-- end --}}
    

   
    {{-- <li class="nav-item">
      <a class="nav-link" href="#">
         <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 12.7207V4.7207H17V2.7207H7V4.7207H8V12.7207L6 14.7207V16.7207H11.2V22.7207H12.8V16.7207H18V14.7207L16 12.7207Z" fill="#C2CFE0"/>
         </svg>
         <span>My pin-up Escort</span>
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFive" aria-controls="collapseFive" aria-expanded="true">
         <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 14.7207C12.33 14.7207 7 16.0507 7 18.7207V20.7207H23V18.7207C23 16.0507 17.67 14.7207 15 14.7207ZM6 10.7207V7.7207H4V10.7207H1V12.7207H4V15.7207H6V12.7207H9V10.7207H6ZM15 12.7207C16.0609 12.7207 17.0783 12.2993 17.8284 11.5491C18.5786 10.799 19 9.78157 19 8.7207C19 7.65984 18.5786 6.64242 17.8284 5.89228C17.0783 5.14213 16.0609 4.7207 15 4.7207C13.9391 4.7207 12.9217 5.14213 12.1716 5.89228C11.4214 6.64242 11 7.65984 11 8.7207C11 9.78157 11.4214 10.799 12.1716 11.5491C12.9217 12.2993 13.9391 12.7207 15 12.7207Z" fill="#C2CFE0"/>
         </svg>
         <span>Reviews</span>
      </a>
      <div id="collapseFive" class="; collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
         <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="#">
               <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18 14.7207H10.5L12.5 12.7207H18V14.7207ZM6 14.7207V12.2207L12.88 5.3607C13.07 5.1707 13.39 5.1707 13.59 5.3607L15.35 7.1307C15.55 7.3307 15.55 7.6407 15.35 7.8407L8.47 14.7207H6ZM20 2.7207H4C3.46957 2.7207 2.96086 2.93142 2.58579 3.30649C2.21071 3.68156 2 4.19027 2 4.7207V22.7207L6 18.7207H20C20.5304 18.7207 21.0391 18.51 21.4142 18.1349C21.7893 17.7598 22 17.2511 22 16.7207V4.7207C22 3.6107 21.1 2.7207 20 2.7207Z" fill="#C2CFE0"/>
               </svg>
               <span class="pl-3">Add new reivew</span>
            </a>
            <a class="collapse-item" href="#">
               <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20 2.7207H4C2.89 2.7207 2 3.6107 2 4.7207V16.7207C2 17.8307 2.9 18.7207 4 18.7207H8V21.7207C8 22.2707 8.45 22.7207 9 22.7207H9.5C9.75 22.7207 10 22.6207 10.2 22.4307L13.9 18.7207H20C21.1 18.7207 22 17.8207 22 16.7207V4.7207C22 3.6107 21.1 2.7207 20 2.7207ZM9.08 15.7207H7V13.6307L13.17 7.4407L15.24 9.5207L9.08 15.7207ZM16.84 7.9207L15.83 8.9307L13.76 6.9007L14.77 5.8807C14.97 5.6707 15.31 5.6607 15.55 5.8807L16.84 7.1307C17.05 7.3407 17.06 7.6807 16.84 7.9207Z" fill="#C2CFE0"/>
               </svg>
               <span class="pl-3">View & Edit Reviews</span>
            </a>
         </div>
      </div>
   </li> --}}




    {{-- Management --}}
    <li class="nav-item">
        {{-- Management --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management">
            <img src="{{ asset('assets/dashboard/img/menu-icon/administration.png') }}">
            <span>Management</span>
        </a>
        <div id="Management" class="collapse  @if (in_array(request()->segment(2), ['advertiser-list', 'calculate-reckoner','edit-my-reports']) ||
                in_array(request()->segment(3), [
                    'escort',
                    'massage','list','new','my-report','dashboard','add-report'                ])) show @endif"
            data-parent="#accordionSidebar">
            <div class="collapse-inner">

                {{-- My Legbox --}}
                <a class="nav-link  collapsed @if (isset(auth()->user()->viewer_settings) && auth()->user()->viewer_settings->features_enable_my_legbox != '1') inactive_li @endif" href="#" data-toggle="collapse" data-target="#MyAdvertisers">
                    <img class="mr-2 pl-1 cstm--icon"
                src="{{ asset('assets/dashboard/img/menu-icon/Icon_MyLegbox-light.png') }}">
                    <span>My Legbox</span>
                </a>
                <div id="MyAdvertisers" class="collapse @if (request()->segment(3) == 'escort' ||
                        request()->segment(3) == 'massage') show @endif;"
                    data-parent="#Management">
                    <div class="py-2 collapse-inner rounded">

                        <a class="collapse-item" href="{{ route('user.my-legbox', ['escort']) }}">
                            <img class="mr-2 pl-1 cstm--icon"
                                src="{{ asset('assets/dashboard/img/menu-icon/escort-listing.png') }}">
                            <span
                                style="{{ request()->is('user-dashboard/my-legbox/escort') ? 'color: #e5365a;' : '' }} ">Escorts</span>
                        </a>
                        <a class="collapse-item" href="{{ route('user.my-legbox', ['massage']) }}">
                            <img class="mr-2 pl-1 cstm--icon"
                                src="{{ asset('assets/dashboard/img/menu-icon/mc-listings.png') }}">
                            <span
                                style="{{ request()->is('user-dashboard/my-legbox/massage') ? 'color: #e5365a;' : '' }} ">Massage
                                Centres</span>
                        </a>
                        {{-- <a class="collapse-item" href="{{ route('user.notes')}}">
                            <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 5.7207V3.7207H2V2.7207C2 1.6207 2.9 0.720703 4 0.720703H10V7.7207L12.5 6.2207L15 7.7207V0.720703H16C17 0.720703 18 1.7207 18 2.7207V12.5207C17.1 12.0207 16.1 11.7207 15 11.7207C11.7 11.7207 9 14.4207 9 17.7207C9 18.8207 9.3 19.8207 9.8 20.7207H4C2.9 20.7207 2 19.7207 2 18.7207V17.7207H0V15.7207H2V11.7207H0V9.7207H2V5.7207H0ZM2 3.7207V5.7207H4V3.7207H2ZM2 17.7207H4V15.7207H2V17.7207ZM2 11.7207H4V9.7207H2V11.7207ZM14 13.7207V16.7207H11V18.7207H14V21.7207H16V18.7207H19V16.7207H16V13.7207H14Z" fill="#C2CFE0"/>
                            </svg>
                            <span style="{{request()->segment(3) == 'my-legbox-notes' ? 'color: #e5365a;' : ''}}">Notes</span>
                            </a> --}}

                    </div>
                </div>
                {{-- end --}}

                {{-- fee --}}
                <a class="nav-link disabled-link collapsed @if (isset(auth()->user()->viewer_settings) && auth()->user()->viewer_settings->features_enable_my_notebox != '1') inactive_li @endif" href="#" data-toggle="collapse" data-target="#Fees">
                    <img class="mr-2 pl-1 cstm--icon" src="{{ asset('assets/dashboard/img/MyNotebox.png') }}"
                style="filter: brightness(0) saturate(100%) invert(99%) sepia(5%) saturate(0%) hue-rotate(101deg) brightness(110%) contrast(100%);">
                    <span>Notebox</span>
                </a>
                {{-- <div id="Fees" class="collapse @if (request()->segment(3) == 'list' ||
                        request()->segment(3) == 'new') show @endif;"
                    data-parent="#Management">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item" href="{{ route('user.list') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/notebox.png') }}">
                            <span style="{{ request()->segment(3) == 'list' ? 'color: #e5365a;' : '' }}">My Noteboxes</span>
                        </a>

                        <a class="collapse-item" href="{{ route('user.new') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/add-note.png') }}">
                            <span style="{{ request()->segment(3) == 'new' ? 'color: #e5365a;' : '' }}">Add Notebox</span>
                        </a>

                    </div>
                </div> --}}
                {{-- end --}}
                {{-- Punterbox --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Punterbox">
                   <img class="mr-2 pl-1 cstm--icon "
                src="{{ asset('assets/dashboard/img/boxicon/icon_punterbox-2.png') }}">
                    <span>Punterbox</span>
                </a>

                <div id="Punterbox" class=" collapse  @if (request()->segment(3) == 'my-report' ||
                        request()->is('user-dashboard/edit-my-reports/*') ||
                         request()->segment(3) == 'dashboard' ||
                        request()->segment(3) == 'add-report') show @endif;"
                    data-parent="#Management">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item show" href="{{ route('user.add-report') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/add-report.png') }}">
                            <span style="{{ request()->segment(3) == 'add-report' ? 'color: #e5365a;' : '' }}">Add
                                Report</span>
                        </a>
                        <a class="collapse-item show" href="{{ route('user.punterbox.dashboard') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/my-dashboard.png') }}">
                            <span style="{{ request()->segment(3) == 'dashboard' ? 'color: #e5365a;' : '' }}">Dashboard</span>
                        </a>
                        <a class="collapse-item" href="{{ route('user.my-report') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/my-report.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'my-report' || request()->is('user-dashboard/edit-my-reports/*') ? 'color: #e5365a;' : '' }}">My
                                Report</span>
                        </a>

                    </div>
                </div>
                {{-- end --}}
            </div>
        </div>
    </li>

    {{-- end --}}

    {{-- devider --}}
    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:10px 30px 15px 15px;">
    </li>
    {{-- end --}}

    {{-- Administration --}}
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration">
            <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
            <span>Administration</span>
        </a>
        <div id="Administration" class="collapse  
        @if (in_array(request()->segment(2), [
                'communication',
                'view-reviews',
                'viewer-messages',
                'guidelines',
                'forms',
                'abbreviations',
                'Community',
                'guide',
                'laws',
                'ticket-list','submitticket','view-and-reply-ticket','profile'
            ]) || in_array(request()->segment(1), [])) show @endif"
            data-parent="#accordionSidebar">
            <div class="collapse-inner">

               

                {{-- Communication --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Communication"
                    aria-expanded="false" aria-controls="Communication">
                    <img width="16" height="17"
                        src="{{ asset('assets/dashboard/img/menu-icon/communication.png') }}">
                    <span>Communication</span>
                </a>

                <div id="Communication" class="collapse @if (in_array(request()->segment(2), ['communication', 'view-reviews','viewer-messages'])) show @endif"
                    data-parent="#Administration">

                    <div class="py-0 collapse-inner rounded mb-2">


                        <!-- Forms -->
                        <a class="collapse-item  @if (isset(auth()->user()->viewer_settings) &&
                                auth()->user()->viewer_settings->features_direct_chatting_with_escorts != '1') inactive_li @endif"
                            href="{{ route('user.view-reviews') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/reviewone.png') }}">
                            <span style="{{ request()->segment(2) == 'view-reviews' ? 'color: #e5365a;' : '' }}">My
                                Reviews</span>
                        </a>
                        <a class="collapse-item disabled-link @if (isset(auth()->user()->viewer_settings) &&
                                auth()->user()->viewer_settings->features_direct_chatting_with_escorts != '1') inactive_li @endif"
                            href="{{ route('user.viewer-messages') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'viewer-messages' ? 'color: #e5365a;' : '' }}">Messages</span>
                        </a>
                    </div>
                </div>
                {{-- end --}}

                {{-- Community --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                    <span>Community</span>
                </a>
                <div id="Community" class="collapse @if (request()->segment(2) == 'abbreviations' ||
                request()->segment(2) == 'Community' ||
                request()->segment(2) == 'guide' ||
                request()->segment(2) == 'laws') show @endif;"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('user.abbreviations') }}">
                            <img src="{{ asset('assets/app/img/Abrieviations.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'abbreviations' ? 'color: #e5365a;' : '' }}">Abbreviations</span>
                        </a>
                        <a class="collapse-item" href="{{ route('user.help') }}">
                            <img src="{{ asset('assets/app/img/helptips.png') }}">
                            <span style="{{ request()->segment(2) == 'Community' ? 'color: #e5365a;' : '' }}">Help &
                                Tips</span>
                        </a>
                        <a class="collapse-item" href="{{ route('user.guide') }}">
                            <img src="{{ asset('assets/app/img/blackboard.png') }}">
                            <span style="{{ request()->segment(2) == 'guide' ? 'color: #e5365a;' : '' }}">Guide to seeing
                                Escorts</span>
                        </a>


                        <a class="collapse-item" href="{{ route('user.laws') }}">
                            <img src="{{ asset('assets/app/img/gavel.png') }}">
                            <span style="{{ request()->segment(2) == 'laws' ? 'color: #e5365a;' : '' }}">Local Laws</span>
                        </a>
                    </div>
                </div>
                {{-- end --}}




                {{-- Support tickets --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets"
                    aria-expanded="true" aria-controls="collapseten">
                    <img src="{{ asset('assets/app/img/ticket.png') }}">
                    <span>Support tickets</span>
                </a>
                <div id="tickets" class=" collapse @if (request()->segment(2) == 'submitticket' ||
                request()->segment(3) == 'profile' ||
                request()->segment(2) == 'view-and-reply-ticket') show @endif;"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item show" href="{{ url('user-dashboard/submitticket') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/submit-ticket.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'submitticket' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Submit</span>
                        </a>

                        <a class="collapse-item" href="{{ route('user.view-and-reply-ticket') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/reply.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'view-and-reply-ticket' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">View
                                & reply</span>
                        </a>

                    </div>
                </div>
                {{-- end --}}
            </div>
        </div>
    </li>






    
    {{-- <li class="nav-item v-last-setting v-divider">
        <a class="nav-link py-0" href="#">
            <span class="v-icon">...</span>
            <span class="v-text">Settings</span>
        </a>
    </li> --}}
</ul>
<!-- End of Sidebar -->
