<nav class="navbar navbar-expand-lg navbar-light main_bg_color">
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
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Find Escort</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>6]) }}"><img src="{{asset('assets/app/img/woman-avatar.svg')}}">Female</a>
                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>1]) }}"><img src="{{asset('assets/app/img/male-user.svg')}}">Male</a>
                        <a class="dropdown-item saptate_by_border" href="{{ route('find.all',['gender'=>2]) }}"><img src="{{asset('assets/app/img/couple.svg')}}">Couples</a>
                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>3]) }}"><img src="{{asset('assets/app/img/Vector.svg')}}">Transgender</a>
                        <a class="dropdown-item" href="{{ route('find.all',['gender'=>4]) }}"><img src="{{asset('assets/app/img/male-user.svg')}}">Cross Dresser</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Find Massage Center
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/woman-avatar.svg')}}">Escorts4U</a>
                        <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/male-user.svg')}}">Agents</a>
                        <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/spa.svg')}}">Massage Centres</a>
                        <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/MyPlaybox.jpg')}}">My Playbox</a>
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

                            <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/woman-avatar.svg')}}">Accommodation</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/male-user.svg')}}">Email Hosting</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/cellphone-text.svg')}}">Mobile SIM</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/oil 1.svg')}}">Products</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/wallet-travel.svg')}}">Travel</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('assets/app/img/symbols 1.svg')}}">Visa &amp; Migration</a>

                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        {{--@if (Route::has('login'))

                        <li class="nav-item">
                            <a class="nav-link header_login_btn" href="#" data-toggle="modal" data-target="#global-login-modal">{{ __('Login') }}</a>
                        </li>
                        @endif --}}
                        @if (Route::has('register'))


                        <li class="nav-item dropdown">
                            <a class="nav-link header_login_btn dropdown-toggle" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}">Login </a>

                                <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                                    <a class="dropdown-item" href="{{ route('advertiser.login') }}">Advertiser</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#global-login-modal">Viewer</a>
                                    <a class="dropdown-item" href="{{ route('advertiser.login') }}">Agent </a>
                                </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle header_reg_btn" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}">{{ __('Register') }} </a>

                                <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                                    <a class="dropdown-item" href="{{ route('advertiser.register') }}">I am an Advertiser</a>
                                    <a class="dropdown-item" href="{{ route('register') }}">I am a Viewer</a>
                                    <a class="dropdown-item" href="{{ route('agent.register')}}">Become an Agent </a>
                                </div>
                        </li>

                        @endif
                    @else
                        <li class="nav-item dropdown dropdown_menu_left_align">
                            <a class="nav-link" href="#" id="userprofileimg" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('assets/app/img/profileimg.jpg') }}" class="img-fluid loged_in_profile_img">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userprofileimg">
                                <a class="dropdown-item" href="{{ route('dashboard') }}"><img src="{{ asset('assets/app/img/woman-avatar.svg') }}">dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <img src="{{ asset('assets/app/img/woman-avatar.svg') }}">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
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
            <!-- <a class="btn" href="#" role="button">Link</a> -->
        </div>
    </div>
</nav>
