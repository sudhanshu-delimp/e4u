
   <nav class="navbar navbar-expand-lg navbar-light main_bg_color custom--header">
      <div class="container-fluid manage_header_padding">
         <a class="navbar-brand" href="{{ route('home') }}">
         <img src="{{ asset('assets/app/img/logo.png') }}" width="172" height="61" class="d-inline-block align-top" alt="">
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto border_right">
               <li class="nav-item">
                  <a class="nav-link" href="">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Find Escort</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Find Massage Center
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="#">demo</a>
                  </div>
               </li>
            </ul>
            <div class="nav_center_line">|</div>
            <ul class="navbar-nav mx-auto">
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  About
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="#">demo</a>
                  </div>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Concierge
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="#">demo</a>
                  </div>
               </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">

               <ul class="navbar-nav">
                 @guest
                   @if (Route::has('login'))

                      . <li class="nav-item">
                           <a class="nav-link" href="{{ route('advertiser.login') }}">{{ __('Login') }}</a>
                       </li>
                   @endif

                   @if (Route::has('register'))
                      . <li class="nav-item">
                           <a class="nav-link" href="{{ route('advertiser.register') }}">{{ __('Register') }}</a>
                       </li>
                       @endif
                   @else
                   <li class="nav-item dropdown dropdown_menu_left_align">
                     <a class="nav-link" href="#" id="userprofileimg" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="{{ asset('assets/app/img/profileimg.jpg') }}" class="img-fluid loged_in_profile_img">
                     </a>
                     <div class="dropdown-menu" aria-labelledby="userprofileimg">
                        <a class="dropdown-item" href="agentdashboard"><img src="{{ asset('assets/app/img/woman-avatar.svg') }}">dashboard</a>

                        <a class="dropdown-item" href="{{ route('advertiser.logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                         <img src="{{ asset('assets/app/img/woman-avatar.svg') }}">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                     </div>
                     </li>
                     @endguest
                  <!--<li class="nav-item">
                     <a class="header_login_btn" href="#" data-toggle="modal" data-target="#my">Log in</a>
                  </li>
                  <li class="nav-item">
                     <a class="header_reg_btn" href="#">Register</a>
                 </li>-->
               </ul>
               <!-- <a class="btn" href="#" role="button">Link</a> -->
            </form>
         </div>
      </div>
   </nav>
