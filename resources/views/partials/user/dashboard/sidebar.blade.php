<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sidebaar-custom db-custom-sidebar"
    id="accordionSidebar">
    
    <a class="sidebar-brand text-left pb-1" href="{{ route('home') }}">
        <img src="{{ asset('assets/images/escorts4u-logo.svg') }}" class="e4u_logo" alt=""><br>

    </a>
    
    <span class="console_heading">Viewer Console</span>
    <!-- Divider -->
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
            <svg width="64px" height="64px" viewBox="-7.2 -7.2 38.40 38.40" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-7.2" y="-7.2" width="38.40" height="38.40" rx="19.2" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="none"></rect> <path d="M15.024 22C16.2771 22 17.3524 21.9342 18.2508 21.7345C19.1607 21.5323 19.9494 21.1798 20.5646 20.5646C21.1798 19.9494 21.5323 19.1607 21.7345 18.2508C21.9342 17.3524 22 16.2771 22 15.024V12C22 10.8954 21.1046 10 20 10H12C10.8954 10 10 10.8954 10 12V20C10 21.1046 10.8954 22 12 22H15.024Z" fill="#0c223d"></path> <path d="M2 15.024C2 16.2771 2.06584 17.3524 2.26552 18.2508C2.46772 19.1607 2.82021 19.9494 3.43543 20.5646C4.05065 21.1798 4.83933 21.5323 5.74915 21.7345C5.83628 21.7538 5.92385 21.772 6.01178 21.789C7.09629 21.9985 8 21.0806 8 19.976L8 12C8 10.8954 7.10457 10 6 10H4C2.89543 10 2 10.8954 2 12V15.024Z" fill="#0c223d"></path> <path d="M8.97597 2C7.72284 2 6.64759 2.06584 5.74912 2.26552C4.8393 2.46772 4.05062 2.82021 3.4354 3.43543C2.82018 4.05065 2.46769 4.83933 2.26549 5.74915C2.24889 5.82386 2.23327 5.89881 2.2186 5.97398C2.00422 7.07267 2.9389 8 4.0583 8H19.976C21.0806 8 21.9985 7.09629 21.789 6.01178C21.772 5.92385 21.7538 5.83628 21.7345 5.74915C21.5322 4.83933 21.1798 4.05065 20.5645 3.43543C19.9493 2.82021 19.1606 2.46772 18.2508 2.26552C17.3523 2.06584 16.2771 2 15.024 2H8.97597Z" fill="#0c223d"></path> </g></svg>    
            
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount"
            aria-expanded="true" aria-controls="myaccount">
            <svg fill="#0c223d" width="64px" height="64px" viewBox="-7.2 -7.2 38.40 38.40" xmlns="http://www.w3.org/2000/svg" stroke="#0c223d"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-7.2" y="-7.2" width="38.40" height="38.40" rx="19.2" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>Account Settings</title><path d="M9.6,3.32a3.86,3.86,0,1,0,3.86,3.85A3.85,3.85,0,0,0,9.6,3.32M16.35,11a.26.26,0,0,0-.25.21l-.18,1.27a4.63,4.63,0,0,0-.82.45l-1.2-.48a.3.3,0,0,0-.3.13l-1,1.66a.24.24,0,0,0,.06.31l1,.79a3.94,3.94,0,0,0,0,1l-1,.79a.23.23,0,0,0-.06.3l1,1.67c.06.13.19.13.3.13l1.2-.49a3.85,3.85,0,0,0,.82.46l.18,1.27a.24.24,0,0,0,.25.2h1.93a.24.24,0,0,0,.23-.2l.18-1.27a5,5,0,0,0,.81-.46l1.19.49c.12,0,.25,0,.32-.13l1-1.67a.23.23,0,0,0-.06-.3l-1-.79a4,4,0,0,0,0-.49,2.67,2.67,0,0,0,0-.48l1-.79a.25.25,0,0,0,.06-.31l-1-1.66c-.06-.13-.19-.13-.31-.13L19.5,13a4.07,4.07,0,0,0-.82-.45l-.18-1.27a.23.23,0,0,0-.22-.21H16.46M9.71,13C5.45,13,2,14.7,2,16.83v1.92h9.33a6.65,6.65,0,0,1,0-5.69A13.56,13.56,0,0,0,9.71,13m7.6,1.43a1.45,1.45,0,1,1,0,2.89,1.45,1.45,0,0,1,0-2.89Z"></path></g></svg>

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

                    <span style="{{ request()->segment(2) == 'update-account' ? 'color: #e5365a;' : '' }}">My
                        Account</span>
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

   

   
    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->
    

   
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
            <svg fill="#000000" height="64px" width="64px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-89.1 -89.1 475.20 475.20" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-89.1" y="-89.1" width="475.20" height="475.20" rx="237.6" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="m112.632,185.074l6.88-3.972c2.804-1.619 3.765-5.205 2.146-8.01l-13.036-22.579c-1.086-1.881-3.057-2.933-5.083-2.933-0.995,0-2.003,0.253-2.926,0.787l-6.88,3.972c-0.945,0.545-1.947,0.794-2.923,0.794-3.063,0-5.872-2.449-5.872-5.872v-7.944c0-3.238-2.625-5.864-5.864-5.864h-26.073c-3.238,0-5.864,2.625-5.864,5.864v7.944c0,3.423-2.81,5.872-5.872,5.872-0.976,0-1.978-0.249-2.923-0.794l-6.88-3.972c-0.923-0.533-1.932-0.786-2.926-0.787-2.027,0-3.997,1.052-5.083,2.933l-13.036,22.579c-1.619,2.805-0.658,6.391 2.146,8.01l6.88,3.972c3.909,2.257 3.909,7.899 0,10.156l-6.88,3.972c-2.805,1.619-3.765,5.205-2.146,8.01l13.036,22.579c1.086,1.881 3.057,2.933 5.083,2.933 0.995,0 2.003-0.254 2.926-0.787l6.88-3.972c0.945-0.545 1.947-0.794 2.923-0.794 3.063,0 5.872,2.449 5.872,5.872v7.944c0,3.238 2.625,5.864 5.864,5.864h26.072c3.238,0 5.864-2.625 5.864-5.864v-7.944c0-3.423 2.81-5.872 5.872-5.872 0.976,0 1.978,0.249 2.923,0.794l6.88,3.972c0.923,0.533 1.932,0.787 2.926,0.787 2.027,0 3.997-1.052 5.083-2.933l13.036-22.579c1.619-2.805 0.658-6.391-2.146-8.01l-6.88-3.972c-3.908-2.257-3.908-7.9 0.001-10.156zm-46.594,22.474c-9.608,0-17.396-7.789-17.396-17.396 0-9.608 7.789-17.396 17.396-17.396s17.396,7.789 17.396,17.396c0,9.607-7.789,17.396-17.396,17.396z"></path> <path d="m108.109,23.659c-3.146-3.144-8.243-3.144-11.389,0-3.145,3.146-3.145,8.244 0,11.389l14.39,14.389c-52.889,2.619-95.701,44.162-100.334,96.506l1.19-2.062c3.406-5.9 9.756-9.565 16.57-9.564 0.144,0 0.287,0.013 0.431,0.017 9.074-37.721 41.965-66.251 81.815-68.729l-14.062,14.061c-3.145,3.145-3.145,8.244 0,11.389 1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358l28.004-28.004c1.51-1.511 2.358-3.559 2.358-5.694 0-2.136-0.848-4.184-2.358-5.694l-28.003-28.004z"></path> <path d="m209.868,64.857c17.881,0 32.428-14.547 32.428-32.428 0-17.882-14.547-32.429-32.428-32.429-17.881,0-32.428,14.547-32.428,32.428 0,17.881 14.547,32.429 32.428,32.429z"></path> <path d="m273.039,152.276v-44.58c0-12.34-7.93-23.283-19.657-27.124l-.054-.018-17.152-2.84c-1.46-0.449-3.02,0.324-3.545,1.764l-19.462,53.399c-1.123,3.081-5.48,3.081-6.602,0l-19.462-53.399c-0.424-1.163-1.522-1.892-2.698-1.892-0.279,0-17.999,2.964-17.999,2.964-11.823,3.94-19.723,14.9-19.723,27.294v44.432c0,6.659 5.398,12.056 12.056,12.056h102.241c6.66-2.84217e-14 12.057-5.398 12.057-12.056z"></path> <path d="m287.37,162.933c-0.673,9.215-8.233,14.858-17.45,15.526-7.062,40.425-41.207,71.64-82.979,74.237l14.061-14.061c3.145-3.146 3.145-8.244 0-11.389-3.146-3.144-8.243-3.144-11.389,0l-28.003,28.004c-3.145,3.146-3.145,8.244 0,11.389l28.003,28.003c1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358c3.145-3.145 3.145-8.244 0-11.389l-14.389-14.389c56.028-2.774 100.758-49.227 100.758-105.931z"></path> <path d="m216.936,77.105c-0.747-0.814-1.84-1.224-2.946-1.224h-8.245c-1.105,0-2.198,0.41-2.946,1.224-1.157,1.261-1.325,3.082-0.504,4.505l4.407,6.644-2.063,17.405 4.063,10.808c0.396,1.087 1.933,1.087 2.33,0l4.063-10.808-2.063-17.405 4.407-6.644c0.822-1.423 0.654-3.244-0.503-4.505z"></path> </g> </g></svg>

            <span>Management</span>
        </a>
        <div id="Management" class="collapse  @if (in_array(request()->segment(2), ['advertiser-list', 'calculate-reckoner','edit-my-reports']) ||
                in_array(request()->segment(3), [
                    'escort',
                    'massage','list','new','my-report','dashboard','add-report']) ||
        request()->is('user-dashboard/notebox/edit/*')) show @endif"
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
                <a class="nav-link collapsed @if (isset(auth()->user()->viewer_settings) && auth()->user()->viewer_settings->features_enable_my_notebox != '1') inactive_li @endif" href="#" data-toggle="collapse" data-target="#Fees">
                    <img class="mr-2 pl-1 cstm--icon" src="{{ asset('assets/dashboard/img/MyNotebox.png') }}"
                style="filter: brightness(0) saturate(100%) invert(99%) sepia(5%) saturate(0%) hue-rotate(101deg) brightness(110%) contrast(100%);">
                    <span>Notebox</span>
                </a>
                <div id="Fees" class="collapse @if (request()->segment(3) == 'list' ||
                        request()->segment(3) == 'new' ||
                        request()->is('user-dashboard/notebox/edit/*')) show @endif;"
                    data-parent="#Management">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item" href="{{ route('user.list') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/notebox.png') }}">
                            <span style="{{ request()->segment(3) == 'list' ||  request()->is('user-dashboard/notebox/edit/*') ? 'color: #e5365a;' : '' }}">My Noteboxes</span>
                        </a>

                        <a class="collapse-item" href="{{ route('user.notebox.new') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/add-note.png') }}">
                            <span style="{{ request()->segment(3) == 'new' ? 'color: #e5365a;' : '' }}">Add Notebox</span>
                        </a>

                    </div>
                </div> 
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
                                Reports</span>
                        </a>

                    </div>
                </div>
                {{-- end --}}
            </div>
        </div>
    </li>

    
    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    {{-- Administration --}}
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration">
            <svg fill="#0c223d" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-142.37 -142.37 759.31 759.31" xml:space="preserve" stroke="#0c223d"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-142.37" y="-142.37" width="759.31" height="759.31" rx="379.655" fill="#eff0f6" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M255.204,102.3c-0.606-11.321-12.176-9.395-23.465-9.395C240.078,95.126,247.967,98.216,255.204,102.3z"></path> <path d="M134.524,73.928c-43.825,0-63.997,55.471-28.963,83.37c11.943-31.89,35.718-54.788,66.886-63.826 C163.921,81.685,150.146,73.928,134.524,73.928z"></path> <path d="M43.987,148.617c1.786,5.731,4.1,11.229,6.849,16.438L36.44,179.459c-3.866,3.866-3.866,10.141,0,14.015l25.375,25.383 c1.848,1.848,4.38,2.888,7.019,2.888c2.61,0,5.125-1.04,7.005-2.888l14.38-14.404c2.158,1.142,4.55,1.842,6.785,2.827 c0-0.164-0.016-0.334-0.016-0.498c0-11.771,1.352-22.875,3.759-33.302c-17.362-11.174-28.947-30.57-28.947-52.715 c0-34.592,28.139-62.739,62.723-62.739c23.418,0,43.637,13.037,54.43,32.084c11.523-1.429,22.347-1.429,35.376,1.033 c-1.676-5.07-3.648-10.032-6.118-14.683l14.396-14.411c1.878-1.856,2.918-4.38,2.918-7.004c0-2.625-1.04-5.148-2.918-7.004 l-25.361-25.367c-1.94-1.941-4.472-2.904-7.003-2.904c-2.532,0-5.063,0.963-6.989,2.904l-14.442,14.411 c-5.217-2.764-10.699-5.078-16.444-6.825V9.9c0-5.466-4.411-9.9-9.893-9.9h-35.888c-5.451,0-9.909,4.434-9.909,9.9v20.359 c-5.73,1.747-11.213,4.061-16.446,6.825L75.839,22.689c-1.942-1.941-4.473-2.904-7.005-2.904c-2.531,0-5.077,0.963-7.003,2.896 L36.44,48.048c-1.848,1.864-2.888,4.379-2.888,7.012c0,2.632,1.04,5.148,2.888,7.004l14.396,14.403 c-2.75,5.218-5.063,10.708-6.817,16.438H23.675c-5.482,0-9.909,4.441-9.909,9.915v35.889c0,5.458,4.427,9.908,9.909,9.908H43.987z"></path> <path d="M354.871,340.654c15.872-8.705,26.773-25.367,26.773-44.703c0-28.217-22.967-51.168-51.184-51.168 c-9.923,0-19.118,2.966-26.975,7.873c-4.705,18.728-12.113,36.642-21.803,52.202C309.152,310.022,334.357,322.531,354.871,340.654z "></path> <path d="M460.782,276.588c0-5.909-4.799-10.693-10.685-10.693H428.14c-1.896-6.189-4.411-12.121-7.393-17.75l15.544-15.544 c2.02-2.004,3.137-4.721,3.137-7.555c0-2.835-1.118-5.553-3.137-7.563l-27.363-27.371c-2.08-2.09-4.829-3.138-7.561-3.138 c-2.734,0-5.467,1.048-7.547,3.138l-15.576,15.552c-5.623-2.982-11.539-5.481-17.751-7.369v-21.958 c0-5.901-4.768-10.685-10.669-10.685H311.11c-2.594,0-4.877,1.04-6.739,2.578c3.26,11.895,5.046,24.793,5.046,38.552 c0,8.735-0.682,17.604-1.956,26.423c7.205-2.656,14.876-4.324,22.999-4.324c36.99,0,67.086,30.089,67.086,67.07 c0,23.637-12.345,44.353-30.872,56.303c13.48,14.784,24.195,32.324,31.168,51.976c1.148,0.396,2.344,0.684,3.54,0.684 c2.733,0,5.467-1.04,7.563-3.13l27.379-27.371c2.004-2.004,3.106-4.721,3.106-7.555s-1.102-5.551-3.106-7.563l-15.576-15.552 c2.982-5.621,5.497-11.555,7.393-17.75h21.957c2.826,0,5.575-1.118,7.563-3.138c2.004-1.996,3.138-4.72,3.138-7.555 L460.782,276.588z"></path> <path d="M376.038,413.906c-16.602-48.848-60.471-82.445-111.113-87.018c-16.958,17.958-37.954,29.351-61.731,29.351 c-23.759,0-44.771-11.392-61.713-29.351c-50.672,4.573-94.543,38.17-111.145,87.026l-9.177,27.013 c-2.625,7.773-1.368,16.338,3.416,23.007c4.783,6.671,12.486,10.631,20.685,10.631h315.853c8.215,0,15.918-3.96,20.702-10.631 c4.767-6.669,6.041-15.234,3.4-23.007L376.038,413.906z"></path> <path d="M120.842,206.782c0,60.589,36.883,125.603,82.352,125.603c45.487,0,82.368-65.014,82.368-125.603 C285.563,81.188,120.842,80.939,120.842,206.782z"></path> </g> </g></svg>

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
                        <a class="collapse-item @if (isset(auth()->user()->viewer_settings) &&
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
