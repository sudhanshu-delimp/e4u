<div class="container-fluid banner_width">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div href="#" class="tip mb-2 pinup-summary-img">
                <img 
                src="{{ !empty($user->defaultPinupImage)?asset($user->defaultPinupImage->path):asset('assets/app/img/home/home-demo.png') }}">
                <span class="memmber_info"><i class="fa fa-user"></i> Member ID: {{$escort->user->member_id}}</span>
            </div>
        </div>
        <div class="col-md-6">

            <div class="row go-to-index">
                <div class="col-md-6 ml-auto d-block">
                    <div class="mycont custom-cross-back pl-5">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="" alt="cross"></a>
                    </div>
                </div>
            </div>
            <div class="pin-up-content pl-5">
                <h1 class="home_heading_first mb-0 pin-head-custom">{{$escort->name}} <span>
                        <div class="pin-age">Age: <span>{{$escort->age}}</span></div>
                    </span>
                    <div class="custom-video-wraper">
                        <div class="video--icon">
                            <a href="#"><img
                                    src="/assets/app/img/video_play.svg" class=""
                                    alt="logo">
                                <span class="custom-icon-hover-tooltip">I have Video</span>
                            </a>
                        </div>
                    </div>
                </h1>
                <div class="row v-path">
                    <div class="col-md-4">
                        <h3 class="mb-0">{{$escort->city->name}}</h3>
                    </div>
                    <div class="col-md-8 align-self-center">
                        <ul
                            class="d-flex list-unstyled pl-0 mb-0 justify-content-end mr-5  meet-with custom-meet-pin">
                            <li>Meet with:</li>
                            <li class="{{!empty($escort->available_to) && in_array(1 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/woman-avatar-big.png') }}"
                                        class="" alt="logo">
                                    <span class="custom-icon-hover-tooltip">Female</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(2 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/male-user.png') }}"
                                        class="" alt="logo">
                                    <span class="custom-icon-hover-tooltip">Male</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(3 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/transgender-big.png') }}"
                                        class="" alt="logo">
                                    <span class="custom-icon-hover-tooltip">Transgender</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(4 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/couple.png') }}" class=""
                                        alt="logo">
                                    <span class="custom-icon-hover-tooltip">Couples</span>
                                </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(5 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/icon_disabled.png') }}" class=""
                                    alt="logo">
                                <span class="custom-icon-hover-tooltip">Disabled</span>
                            </a></li>
                            <li class="{{!empty($escort->available_to) && in_array(6 , $escort->available_to)?'':'d-none'}}"><a href="#"><img src="{{ asset('assets/app/img/icon_groups.png') }}" class=""
                                    alt="logo">
                                <span class="custom-icon-hover-tooltip">Groups/Parties</span>
                            </a></li>
                        </ul>
                    </div>
                </div>
                @php
                    $about = html_entity_decode(strip_tags($escort->about));
                @endphp
                <p class="pin-description text-justify">{{ $about }}</p>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="media align-items-center">
                            <img src="{{ asset('assets/app/img/handwithhart.png') }}" alt="John Doe"
                                class="mr-3 rounded-circle" style="width:40px;">
                            <div class="media-body">
                                <h4>Massage</h4>
                                <p class="mb-0">{{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','=','1 Hour')->first()->pivot->massage_price : '' }} / hr</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="media align-items-center">
                            <img src="{{ asset('assets/app/img/areodownimg.png') }}" alt="John Doe"
                                class="mr-3 rounded-circle" style="width:40px;">
                            <div class="media-body">
                                <h4>Incalls</h4>
                                <p class="mb-0">{{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','=','1 Hour')->first()->pivot->incall_price : ''}} / hr</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="media align-items-center">
                            <img src="{{ asset('assets/app/img/aeroupimg.png') }} " alt="John Doe"
                                class="mr-3 rounded-circle" style="width:40px;">
                            <div class="media-body">
                                <h4>Outcalls</h4>
                                <p class="mb-0">{{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','1 Hour')->first()->pivot->outcall_price : ''}} / hr</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row social-and-view custom-pin-social-row">
                    <div class="col-md-6 align-self-center">
                        @if(!empty($user->social_links))
                        <ul class="d-flex list-unstyled pl-0 mb-0 custom--socialpin">
                            @if(!empty($user->social_links['facebook']))
                                <li><a href="{{$user->social_links['facebook']}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            @endif
                            @if(!empty($user->social_links['insta']))
                                <li><a href="{{$user->social_links['insta']}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            @endif
                            @if(!empty($user->social_links['twitter']))
                                <li><a href="{{$user->social_links['twitter']}}" target="_blank"><img src="{{ asset('assets/app/img/twitter-x.png') }}" class="twitter-x-logo" alt="logo"></a></li>
                            @endif
                        </ul>
                        @endif
                    </div>
                    <div class="custom-playbox"><a href="/playbox"><img
                                src="{{ asset('assets/app/img/Icon_MyPlaybox-light.png') }}" class="playbox-logo"
                                alt="logo">
                            <span class="custom-icon-hover-tooltip">My Playbox</span>
                        </a></div>
                    <div class="col-md-6 align-self-center">
                        <a href="{{ route('profile.description', $escort->id) }}" class="btn">View Profile</a>
                    </div>
                </div>
                @if($escort->address)
                <div class="row v-locat">
                    <div class="col-md-12">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>{{$escort->address}}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>