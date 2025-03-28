@extends('layouts.webHome')

@section('content')
<section class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly homebanner_bg">
    <div class="container-fluid banner_width">
        <div class="row align-items-center">
            <div class="col-md-5">
                <div href="#" class="tip mb-2">
                <img style="box-shadow: 2px 3px 2px #bdbdbdbd;" class="img-fluid" src="{{ asset('assets/app/img/home/home-demo.png') }}">
                <div class="trikon_style manage_toolkit_font"><img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"> I am your Pin-up Click Me</div>
                </div>
            </div>
            <div class="col-md-7">
                <p class="primery_color normal_heading">AUSTRALIA’S SEXIEST AND MOST ACCESSIBLE ESCORTS</p>
                <h1 class="home_heading_first">ESCORTS4U DIRECTORY OF:</h1>
                <h1 class="home_heading_first">
                    <img src="{{ asset('assets/app/img/home/correctsign.png') }}">
                    Private Escorts
                </h1>
                <h1 class="home_heading_first">
                    <img src="{{ asset('assets/app/img/home/correctsign.png') }}">
                    Massage Centres
                </h1>
                
                <p>The easiest platform to view Escorts and Massage Centres from, without all the fuss. Escorts4U prides itself on integrity, honesty and value.</p>
                <div class="padding">
                    <a class="btn btn_advertiser" style="font-weight:500" href="{{ route('find.all') }}" role="button">View Escorts</a>
                    <a class="btn  btn_become_pin_up" style="font-weight:500" href="become-a-pin-up" role="button">Become a Pin-up</a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly angle_bg_image">
    <div class="container">
        <div class="home_welcome text-center">
            <div class="site_second_heading">
                <h2 class="text-white text-uppercase">Welcome to Escorts4U</h2>
            </div>
            <div class="welcome_msg_sub_heading">
                <p class="text-white text-uppercase normal_heading">It is all about the companionship</p>
            </div>
            <div class="welcome_msg_peraone">
                <p class="text-white">Welcome to the preferred website where private Escorts and erotic Massage Centres advertise their companionship and services to Viewers who are looking for company.</p>
                <p class="text-white">Advertisers set out a detailed and informative Profile or Tour where they propose their time and companionship, enabling Viewers to make direct contact. A Massage Centre has its own unique Profile designed to bring detailed Profile information about their business premises, Masseurs and their services directly to you.</p>
            </div>
            <div class="welcome_msg_peratwo">
                <p class="welcome_text_color">Absolutely no banner advertising, third party marketing or spam!</p>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <div class="padding_ninty_top_ninty_px">
                <div class="text-center">
                    <div class="site_second_heading">
                        <h2 class="text-uppercase our">Our service to you</h2>
                    </div>
                    <div class="our_service_peragraph">
                        <p>In addition to providing advertising services, we also assist with industry information for Advertisers and Viewers, located in the footer, together with our Concierge Services.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h5 class="normal_heading primery_color">Our aim is to provide:</h5>
            <div class="our_aim">
                <ul id="our_aim_list">
                    <li>
                        <img src="{{ asset('assets/app/img/home/high-five.png') }}">
                        <p>A friendly and accessible service for Advertisers and Viewers</p>
                    </li>
                    <li>
                        <img src="{{ asset('assets/app/img/home/accuracy1.png') }}">
                        <p>Viewers with accurate information about the Services on offer</p>
                    </li>
                    <li>
                        <img src="{{ asset('assets/app/img/home/customer-service.png') }}">
                        <p>Good "Support" services for both Advertisers and Viewers</p>
                    </li>
                    <li>
                        <img src="{{ asset('assets/app/img/home/rating.png') }}">
                        <p>Viewers the opportunity to post "Reviews" about their experiences</p>
                    </li>
                    <li>
                        <img src="{{ asset('assets/app/img/home/profits.png') }}">
                        <p>A cost effective service for Advertisers</p>
                    </li>
                    <li>
                        <img src="{{ asset('assets/app/img/home/encrypted.png') }}">
                        <p>Assurance about privacy for both Advertisers and Viewers</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="point_of_diff">
                <h3 class="text-white">What is our point of difference?</h3>
                <div class="point_of_diff_peragrapg">
                    <p class="text-white">It became apparent to us after talking with Advertisers and Viewers that there were a number of concerns about the quality and integrity of the services and offerings websites brought to private escorts and massage centres. Those discussions helped bring about this Website, ensuring also that it complies with the Local Laws. Features such as verified photos, reviews, guides, concierge services, notes and Alerts are designed to make your experience a pleasant one. We also offer a loyalty program.</p>
                </div>
            </div>
        </div>
    </div>
    
</div>

<section class="one-stop-bg">
    <div class="container-fluid">
    <div class="row">
         <div class="col-md-12">
            <div class="one_stop_shop">
                <div class="text-center">
                    <div class="site_second_heading pb-4 ">
                        <h2 class="text-uppercase color-white">A one stop shop we provide</h2>
                    </div>
                </div>
            </div>
        </div>   
    </div>
     <div class="row justify-content-center">
        <div class="col-md-12 shop-box-col">
            <div class="shop-box">
                <div class="text-center">
                    <div class="shops_border lign-items-center">
                        <img src="{{ asset('assets/app/img/home/live-booking.png') }}">
                        <p>Live booking services for accommodation and travel </p>
                    </div>
                </div>
            </div>
            <div class="shop-box">
                <div class="text-center">
                    <div class="shops_border my-auto">
                        <img src="{{ asset('assets/app/img/home/product-delivery.png') }}">
                        <p>Product delivery</p>
                    </div>
                </div>
            </div>
            <div class="shop-box">
                <div class="text-center">
                    <div class="shops_border">
                        <img src="{{ asset('assets/app/img/home/telecommunication.png') }}">
                        <p>Telecommunication services - Mobile SIM & Email account</p>
                    </div>
                </div>
            </div>
            <div class="shop-box">
                <div class="text-center">
                    <div class="shops_border">
                        <img src="{{ asset('assets/app/img/home/visa1.png') }}">
                        <p>Visa and migration advice</p>
                    </div>
                </div>
            </div>
            <div class="shop-box">
                <div class="text-center">
                    <div class="shops_border">
                        <img src="{{ asset('assets/app/img/home/extensive.png') }}">
                        <p>An extensive range of new features for Advertisers and Viewers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="home_reg_bg">
    <div class="padding_ninty_top_ninty_px padding_btm_ninty_pxonly">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="register-img">
                        <img src="{{ asset('assets/app/img/shutterstock_338759729.png') }}">
                    </div>
                </div>
                <div class="col-md-7 d-flex flex-column justify-content-center">
                    <div class="normal_heading pt-5">
                        <p class="primery-color">NOT A MEMBER YET?</p>
                    </div>
                    <div class="site_second_heading">
                        <h2 class="primery-color" style="line-height: 30px;">REGISTER NOW!</h2>
                    </div>
                    <div class="reg_now_pera">
                        <p class="primery-color  pt-3">There are no fees when your create an Account. Fees only apply when you post a Profile or Tour where you are charged according to the number of days and the Membership type you select. See also <a href = "help-for-advertisers" class="termsandconditions_text_color" >Help for Advertisers</a></p>
                    </div></br>
                    <div class="padding">
                        <a class="btn btn_advertiser"  style="border: 1px solid;" href="{{ route('advertiser.register') }}" role="button">I am an Advertiser</a>
                        <a class="btn btn_viewer" style="border: 1px solid;" href="{{ route('register') }}" role="button">I am a Viewer</a>
                        <a class="btn  btn_viewer" style="color:red;border: 1px solid;" href="{{ route('agent.register')}}" role="button">I am an Agent</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
