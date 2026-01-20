
@if(global_notifications())
    @foreach(global_notifications() as $notification)
        <x-global_frontend.global-alert :heading="$notification['heading']" :content="$notification['content'] ?? $notification['template_name']" />
    @endforeach
@endif

@if(notic_alert())
 <x-global_frontend.publications_alert  :content="notic_alert()" />
@endif

<div class="blue-bg-before home--header">
         <nav class="navbar navbar-expand-lg navbar-light blue_and_white_nav_blue_in_small">
         <div class="container-fluid manage_header_padding">
            <a class="navbar-brand header_logo" href="{{ route('home') }}">
            <img src="{{ asset('assets/app/img/logo.png') }}" class="d-inline-block align-top" alt="header_logo home">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse collapse_menu_top_of_the_content" id="navbarSupportedContent">
               <ul class="navbar-nav mx-auto border_right">
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Find Escort</a>
                    <div class="dropdown-menu addMyLocation" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>6]) }}?lat"><img src="{{asset('assets/app/img/woman-avatar.svg')}}">Female</a>
                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>1]) }}?lat"><img src="{{asset('assets/app/img/male-user.svg')}}">Male</a>
                        <a class="dropdown-item saptate_by_border" href="{{ route('find.all',['gender'=>2]) }}?lat"><img src="{{asset('assets/app/img/couple.svg')}}">Couples</a>
                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>3]) }}?lat"><img src="{{asset('assets/app/img/Vector.svg')}}">Transgender</a>
                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>4]) }}?lat"><img src="{{asset('assets/app/img/male-user.svg')}}">Cross Dresser</a>
                        {{-- <li><a href="{{route('find.all', [request()->segment(2),'city'=>$key])}}" class="" id="{{$key}}">{{$city}}</a></li> --}}
                    </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('find.massage.centre') }}">Find Massage Centre</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#myPlayboxModal">
                        <span>My Playbox</span>
                    </a>
                </li>
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Find Massage Center
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/woman-avatar.svg')}}">Escorts4U</a>
                        <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/male-user.svg')}}">Agents</a>
                        <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/spa.svg')}}">Centres</a>
                    </div>
                  </li> -->
               </ul>
               <div class="nav_center_blue_line">|</div>
               <ul class="navbar-nav mx-auto">
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('agents')}}"><img src="{{asset('assets/app/img/male-user.svg')}}">Agents</a>
                            <a class="dropdown-item" href="{{ url('escorts4U')}}"><img src="{{asset('assets/app/img/woman-avatar.svg')}}">Escorts4U</a>
                            <a class="dropdown-item" href="{{ url('e4u-verified')}}"><img src="{{asset('assets/app/img/e4u-verified-shield.png')}}">E4U Verified</a>
                            <a class="dropdown-item" href="{{ url('centres')}}"><img src="{{asset('assets/app/img/spa.svg')}}">Massage Centres</a>
                            <a class="dropdown-item" href="{{ url('playbox')}}"><img src="{{asset('assets/app/img/myplay-box.png')}}">My Playbox</a>
                        </div>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Concierge
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ url('accommodation')}}"><img src="{{asset('assets/app/img/woman-avatar.svg')}}">Accommodation</a>
                            <a class="dropdown-item" href="{{ url('email-hosting')}}"><img src="{{asset('assets/app/img/male-user.svg')}}">Email Hosting</a>
                            <a class="dropdown-item" href="{{ url('mobile-read-sim')}}"><img src="{{asset('assets/app/img/cellphone-text.svg')}}">Mobile SIM</a>
                            <a class="dropdown-item" href="{{ url('professional-product')}}"><img src="{{asset('assets/app/img/oil 1.svg')}}">Products</a>
                            <a class="dropdown-item" href="{{ url('travel')}}"><img src="{{asset('assets/app/img/wallet-travel.svg')}}">Travel</a>
                            <a class="dropdown-item" href="{{ url('visa-migration')}}"><img src="{{asset('assets/app/img/symbols 1.svg')}}">Visa &amp; Migration</a>

                        </div>
                  </li>
               </ul>
               <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))

                        <!--<li class="nav-item">
                            <a class="nav-link header_login_btn" href="#" data-toggle="modal" data-target="#global-login-modal">{{ __('Login') }}</a>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link header_login_btn dropdown-toggle" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}">Log in </a>

                                <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                                    <a class="dropdown-item" href="{{ route('advertiser.login') }}">Advertiser</a>
                                    <a class="dropdown-item" href="{{ route('viewer.login') }}">Viewer</a>
                                    <a class="dropdown-item" href="{{ route('agent.login') }}">Agent</a>


                                </div>
                        </li>
                        @endif
                        @if (Route::has('register'))

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle header_reg_btn" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}" style="border-radius:4px;color:#fff;">{{ __('Register') }} </a>

                                <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                                    <a class="dropdown-item" href="{{ route('advertiser.register') }}">Advertiser</a>
                                    <a class="dropdown-item" href="{{ route('register') }}">Viewer</a>
                                    <a class="dropdown-item" href="{{ route('agent.register')}}">Agent</a>
                                </div>
                        </li>

                        @endif
                    @else
                        <li class="nav-item dropdown dropdown_menu_left_align">
                            <a class="nav-link" href="#" id="userprofileimg" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ !auth()->user()->avatar_img ? asset('assets/app/img/profileimg.jpg') : asset('avatars/'.auth()->user()->avatar_img) }}" class="img-fluid loged_in_profile_img">
                            </a>
                            <div class="dropdown-menu custom--drop-icons" aria-labelledby="userprofileimg">
                                <a class="dropdown-item" href="{{ route('dashboard') }}"><img src="{{ asset('assets/app/img/dashboard.png') }}">dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <img src="{{ asset('assets/app/img/logout-pink.png') }}">
                                    {{ __('Logout') }}
                                </a>
                            </div>


                            <form id="logout-form" action="{{ auth()->user()->type != 1 ? route('advertiser.logout') : route('logout') }}" method="POST" class="">
                                @csrf
                            </form>
                        </li>
                    @endguest
                <!--<li class="nav-item">
                    <a class="header_login_btn" href="#" data-toggle="modal" data-target="#my">Log in</a>
                    </li>
                    <li class="nav-item">
                    <a class="header_reg_btn" href="#">Register</a>
                </li>-->
            </ul>
            </div>
         </div>
      </nav>

      <!-- My Playbox Modal -->
<div class="modal defult-modal fade" id="myPlayboxModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myPlayboxModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
           <!-- Modal body -->
           <div class="modal-body p-0">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin:15px 20px;">
              <img src="{{ asset('assets/app/img/newcross.png') }}" class=" ">
              </button>
              <h3><img src="{{ asset('assets/dashboard/img/menu-icon/Icon_MyPlaybox-light.png') }}" class="custompopicon menu-icon my--play"> My Playbox</h3>
              <div class="modal-sec pb-0">
                <h1 class="popu_heading_style mb-3 mt-3" style="text-align: center;">
                    <span id="Lname " class="my_legbox_title">Full My Playbox content is only available to Viewers. Please Login or Register to access My Playbox.</span>
                    </h1>
                
                    
                </div>
           </div>
           <div class="modal-footer justify-content-center pt-3">
            <a href="{{route('viewer.login')}}" class="btn btn_advertiser btn-cancel-modal border-0">Login</a>
            <a href="{{url('/register')}}" class="btn  btn_become_pin_up btn-success-modal border-0">Register</a>
            
          </div>
        </div>
     </div>
  </div>

</div>




@push('scripts')
    <script>

        navigator.geolocation.getCurrentPosition(async function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            document.querySelectorAll('.addMyLocation a').forEach(function(link) {
                let originalHref = link.getAttribute('href');

                url = originalHref.replace('?lat', '&lat='+latitude+'&lng='+longitude);
                link.setAttribute('href',url);
            });

        });
      
    </script>
@endpush
