<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sidebaar-custom" id="accordionSidebar">
   <!-- Sidebar - Brand -->
   <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
      <img src="{{ asset('assets/app/img/logo.svg') }} " alt="">
      </a> -->
   <a class="sidebar-brand text-left pb-3" href="{{route('home')}}">
   <img src="{{ asset('assets/app/img/logo.svg') }}" class=" " alt=""><br>

   </a>
   <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-4">Viewer Console</span>
   <!-- Divider -->
   <!-- Nav Item - Dashboard -->
   <li class="nav-item active">
      <a class="nav-link" href="{{ route('user.dashboard')}}">
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
          <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                  d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                  fill="#C2CFE0" />
          </svg>

          <span>My Account</span>
      </a>
      <div id="myaccount" class="collapse @if(request()->segment(2) == 'update-account' || request()->segment(2) == 'change-features' || request()->segment(2) == 'change-password' || request()->segment(2) == 'notifications-features' || request()->segment(2) == 'upload-my-avatar') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="py-0 collapse-inner rounded mb-2">
               <a class="collapse-item" href="{{ route('user.account.edit')}}">

                  <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/account-edit.png') }}">

                  <span style="{{request()->segment(2) == 'update-account' ? 'color: #e5365a;' : ''}}">Edit my account</span>
               </a>
               <a class="collapse-item" href="{{ route('user.change.password')}}">
                  <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">

                  <span style="{{request()->segment(2) == 'change-password' ? 'color: #e5365a;' : ''}}">Change password</span>
               </a>
               <a class="collapse-item" href="{{ route('change-features')}}">
                  <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/account-network.png') }}">

                  <span style="{{request()->segment(2) == 'change-features' ? 'color: #e5365a;' : ''}}">Change features</span>
               </a>

               <a class="collapse-item" href="#">
                  <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/ccthree.png') }}">

                  <span style="{{request()->segment(2) == 'notifications-features' ? 'color: #e5365a;' : ''}}">Notifications</span>
               </a>

              <a class="collapse-item" href="{{route('user.profile.avatar')}}">
                  <img width="16" height="17" viewBox="0 0 16 17" fill="none" src="{{asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">

                  <span style="{{request()->segment(2) == 'upload-my-avatar' ? 'color: #e5365a;' : ''}}">Upload my avatar</span>
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

        <div id="Community" class="collapse @if(request()->segment(2) == 'abbreviations' || request()->segment(2) == 'Community' || request()->segment(2) == 'guide' || request()->segment(2) == 'laws') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('user.abbreviations') }}">
                <img src="{{ asset('assets/app/img/Abrieviations.png')}}">
                <span style="{{request()->segment(2) == 'abbreviations' ? 'color: #e5365a;' : ''}}">Abbreviations</span>
            </a>
            <a class="collapse-item" href="{{ route('user.help') }}">
                <img src="{{ asset('assets/app/img/helptips.png')}}">
                <span style="{{request()->segment(2) == 'Community' ? 'color: #e5365a;' : ''}}">Help & Tips</span>
            </a>
             <a class="collapse-item" href="{{ route('user.guide') }}">
                <img src="{{ asset('assets/app/img/blackboard.png')}}">
                <span style="{{request()->segment(2) == 'guide' ? 'color: #e5365a;' : ''}}">Guide to seeing Escorts</span>
            </a>


            <a class="collapse-item" href="{{ route('user.laws') }}">
                <img src="{{ asset('assets/app/img/gavel.png')}}">
                <span style="{{request()->segment(2) == 'laws' ? 'color: #e5365a;' : ''}}">Local Laws</span>
            </a>
            </div>
        </div>

    </li>
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cms" aria-expanded="false" aria-controls="collapseTwo">
         <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.83 11.7208C20.6218 11.1383 20.2386 10.6343 19.7329 10.278C19.2271 9.92172 18.6236 9.73047 18.005 9.73047C17.3864 9.73047 16.7829 9.92172 16.2771 10.278C15.7714 10.6343 15.3882 11.1383 15.18 11.7208H8.82C8.6118 11.1383 8.22859 10.6343 7.72287 10.278C7.21715 9.92172 6.61364 9.73047 5.995 9.73047C5.37636 9.73047 4.77285 9.92172 4.26713 10.278C3.76141 10.6343 3.3782 11.1383 3.17 11.7208H1V13.7208H3.17C3.3782 14.3034 3.76141 14.8073 4.26713 15.1636C4.77285 15.5199 5.37636 15.7112 5.995 15.7112C6.61364 15.7112 7.21715 15.5199 7.72287 15.1636C8.22859 14.8073 8.6118 14.3034 8.82 13.7208H15.18C15.3882 14.3034 15.7714 14.8073 16.2771 15.1636C16.7829 15.5199 17.3864 15.7112 18.005 15.7112C18.6236 15.7112 19.2271 15.5199 19.7329 15.1636C20.2386 14.8073 20.6218 14.3034 20.83 13.7208H23V11.7208H20.83ZM6 13.7208C5.80222 13.7208 5.60888 13.6622 5.44443 13.5523C5.27998 13.4424 5.15181 13.2862 5.07612 13.1035C5.00043 12.9208 4.98063 12.7197 5.01921 12.5257C5.0578 12.3318 5.15304 12.1536 5.29289 12.0137C5.43275 11.8739 5.61093 11.7786 5.80491 11.74C5.99889 11.7015 6.19996 11.7213 6.38268 11.7969C6.56541 11.8726 6.72159 12.0008 6.83147 12.1653C6.94135 12.3297 7 12.523 7 12.7208C7 12.986 6.89464 13.2404 6.70711 13.4279C6.51957 13.6155 6.26522 13.7208 6 13.7208ZM18 13.7208C17.8022 13.7208 17.6089 13.6622 17.4444 13.5523C17.28 13.4424 17.1518 13.2862 17.0761 13.1035C17.0004 12.9208 16.9806 12.7197 17.0192 12.5257C17.0578 12.3318 17.153 12.1536 17.2929 12.0137C17.4327 11.8739 17.6109 11.7786 17.8049 11.74C17.9989 11.7015 18.2 11.7213 18.3827 11.7969C18.5654 11.8726 18.7216 12.0008 18.8315 12.1653C18.9414 12.3297 19 12.523 19 12.7208C19 12.986 18.8946 13.2404 18.7071 13.4279C18.5196 13.6155 18.2652 13.7208 18 13.7208Z" fill="#C2CFE0"></path>
         </svg>
         <span>Communication</span>
      </a>
       <div id="cms" class="collapse @if(request()->segment(2) == 'communication') show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('user.advertiser') }}">
                <img src="{{ asset('assets/app/img/Abrieviations.png')}}">
                <span style="{{request()->segment(2) == 'communication' ? 'color: #e5365a;' : ''}}">Advertiser Messaging</span>
            </a>
            </div>
        </div>
   </li>
   <li class="nav-item">
      <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo" aria-expanded="true">
      <img class="mr-2 pl-1 cstm--icon" src="{{asset('assets/dashboard/img/menu-icon/Icon_MyLegbox-light.png')}}">
         <span>My Legbox</span>
      </a>
      <div id="collapseTwo" class=" collapse  @if(request()->segment(2) == 'my-legbox-list' || request()->segment(2) == 'massage-legbox-list' ||request()->segment(3) == 'my-legbox-notes' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
         <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('user.legbox.list') }}">
               <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z" fill="#C2CFE0"/>
               </svg>
               <span class="pl-3" style="{{request()->segment(2) == 'my-legbox-list' ? 'color: #e5365a;' : ''}} ">Escort List</span>
            </a>
            <a class="collapse-item" href="{{ route('user.massage.legbox.list') }}">
               <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z" fill="#C2CFE0"/>
               </svg>
               <span class="pl-3" style="{{request()->segment(2) == 'massage-legbox-list' ? 'color: #e5365a;' : ''}} ">Massage List</span>
            </a>
            <a class="collapse-item" href="{{ route('user.notes')}}">
               <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 5.7207V3.7207H2V2.7207C2 1.6207 2.9 0.720703 4 0.720703H10V7.7207L12.5 6.2207L15 7.7207V0.720703H16C17 0.720703 18 1.7207 18 2.7207V12.5207C17.1 12.0207 16.1 11.7207 15 11.7207C11.7 11.7207 9 14.4207 9 17.7207C9 18.8207 9.3 19.8207 9.8 20.7207H4C2.9 20.7207 2 19.7207 2 18.7207V17.7207H0V15.7207H2V11.7207H0V9.7207H2V5.7207H0ZM2 3.7207V5.7207H4V3.7207H2ZM2 17.7207H4V15.7207H2V17.7207ZM2 11.7207H4V9.7207H2V11.7207ZM14 13.7207V16.7207H11V18.7207H14V21.7207H16V18.7207H19V16.7207H16V13.7207H14Z" fill="#C2CFE0"/>
               </svg>
               <span class="pl-3" style="{{request()->segment(3) == 'my-legbox-notes' ? 'color: #e5365a;' : ''}}">Notes</span>
            </a>
         </div>
      </div>
   </li>
   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ugly" aria-expanded="false" aria-controls="collapseten">
        <img class="mr-2 pl-1 cstm--icon " src="{{asset('assets/dashboard/img/menu-icon/Icon_MyPlaybox-light.png')}}">
             <span>Punterbox</span>
        </a>
        <div id="ugly" class=" collapse  @if(request()->segment(3) == 'report' || request()->segment(3) == 'lookup' ) show @endif;" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-0 collapse-inner rounded mb-2">
             <a class="collapse-item show" href="{{ route('user.report') }}">
                <img src="{{ asset('assets/app/img/icons-bug.png')}}">
                <span class="pl-3" style="{{request()->segment(3) == 'report' ? 'color: #e5365a;' : ''}}">Make Report</span>
            </a>

            <a class="collapse-item" href="{{ route('user.lookup') }}">
                <img src="{{ asset('assets/app/img/icons-list.png')}}">
            <span class="pl-3" style="{{request()->segment(3) == 'lookup' ? 'color: #e5365a;' : ''}}">Look Up</span>
            </a>

            </div>
        </div>
    </li>
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#notebox" aria-expanded="false" aria-controls="notebox">
        <img class="mr-2 pl-1 cstm--icon" src="{{ asset('assets/dashboard/img/menu-icon/Icon_MyNotebox-light.png') }}">
        <span>Notebox</span>
    </a>
    <div id="notebox" class="collapse @if(request()->segment(3) == 'list' || request()->segment(3) == 'new') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="py-0 collapse-inner rounded mb-2">
            <a class="collapse-item" href="{{ route('user.list') }}">
                <img src="{{ asset('assets/app/img/icons-list.png') }}">
                <span class="pl-3" style="{{ request()->segment(3) == 'list' ? 'color: #e5365a;' : '' }}">List</span>
            </a>

            <a class="collapse-item" href="{{ route('user.new') }}">
                <img src="{{ asset('assets/app/img/icons-bug.png') }}">
                <span class="pl-3" style="{{ request()->segment(3) == 'new' ? 'color: #e5365a;' : '' }}">New</span>
            </a>
        </div>
    </div>
</li>
    
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
   </li>--}}
   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets" aria-expanded="true" aria-controls="collapseten">
             <img src="{{ asset('assets/app/img/ticket.png')}}">
             <span >Support tickets</span>
        </a>
        <div id="tickets" class=" collapse  @if(request()->segment(2) == 'submitticket' || request()->segment(3) == 'profile' || request()->segment(3) == 'list') show @endif;" aria-labelledby="headingten" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
             <a class="collapse-item show" href="{{ url('user-dashboard/submitticket') }}">
                <img src="{{ asset('assets/app/img/right-30.png')}}">
                <span style="{{ request()->segment(2) == 'submitticket' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : ''}}">Submit ticket</span>
            </a>

            <a class="collapse-item" href="#">
                <img src="{{ asset('assets/app/img/view-48.png')}}">
                <span style="">View & reply tickets</span>
            </a>

            </div>
        </div>
    </li>
   <li class="nav-item v-last-setting v-divider">
      <a class="nav-link py-0" href="#">
      <span class="v-icon">...</span>
      <span class="v-text">Settings</span>
      </a>
   </li>
</ul>
<!-- End of Sidebar -->
