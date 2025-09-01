@extends('layouts.web')
<style>
    .table2 {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }
    .table2 th {
        padding: 0.55rem;
    }
    .table2 tbody td {
        color: #192A3E;
        font-family: 'Poppins';
        font-weight: normal;
        font-size: 16px;
    }
    .table2 td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    .table2 thead {
        border-bottom: 2px solid #000000;
    }
    .table2 th {
        padding: 0.75rem;
        vertical-align: top;
        border-top: none;
    }
    .table2 td:first-child {
        font-weight: bold;
    }
</style>
@section('content')
    <section
        class="section_bg_color padding_ninty_top_ninty_px padding_bottom_eight_px angle_bg_image advertiser-registration">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 adverti_reg_page_padingto_bt-new">
                    <div class="reg_info advertiser-registration">
                        {{-- <h2>Registration - Escort</h2> --}}
                        <div class="pt-2 pb-5">
                            <h1 class="text-uppercase">Advertiser Registration</h1>
                            <h2>Registration with us is free</h2>
                            <p class="text-justify">There are no Fees when you create an Account. Fees only apply when you post a Profile or Tour
                                where you are charged according to the number of days and the Membership Type you select.
                                See also <span><a href="{{ url('help-for-advertisers')}}"
                                                                                class="termsandconditions_text_color">Help for Advertisers</a></span>
                                and <span><a href="{{ url('help-for-massage-centres')}}"
                                                                           class="termsandconditions_text_color">Help for Massage Centres</a></span>
                                for more information on Package benefits, Profiles & Tours, Fees and your obligations.</p>
                        </div>
                        <h4>Alert:</h4>
                        <ol class="pl-4 text-justify">
                            <li>Victorian Advertisers can voluntarily provide their SWA exception number or license number, like for
                                example, SWA20188XE. The license number will be displayed on any Profile you publish.
                            </li>
                            <li>Massage Centres in Queensland must have their business telephone number registered with
                                the Prostitution Licensing Authority (Queensland) and display the number on any Profile
                                it publishes.
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="reg_box_form_style col-lg-5 col-md-5">
                    <div class="regstractionform">
                        <h4>Register Now, No Fees for the first 14 days Advertising!</h4>
                        <form id="escort_registration" action="{{ route('advertiser.register')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="mobileno">Mobile Number</label>
                                <input type="txt" class="form-control" id="mobileno" aria-describedby="emailHelp"
                                       name="phone" data-parsley-maxlength="10" required placeholder="Mobile Number"
                                       data-parsley-required-message="Your mobile number is required"
                                       value="{{ old('phone') }}" data-parsley-type="digits"
                                       data-parsley-type-message="Enter only mobile numbers">
                                <span id="phone-errors"></span>
                                <div class="termsandconditions_text_color">
                                    @error('phone')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required
                                       autocomplete="email" placeholder="Email Address"
                                       data-parsley-required-message="@lang('errors/validation/required.email')"
                                       data-parsley-type-message="@lang('errors/validation/valid.email')">
                                <span id="email-errors"></span>
                                <div class="termsandconditions_text_color">
                                    @error('email')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            {{-- {{ dd( request()->ipinfo)}} --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Location<sup>(*)</sup></label>
                                <select class="form-control loc-sec" id="location_state" name="state_id" required
                                        data-parsley-required-message="Select Location">
                                    <option value="">Select your Home State (if not already identified)</option>
                                    @foreach(config('escorts.profile.states') as $key => $state)
                                        <option style="font-weight: 500;"
                                                value="{{$key}}" {{ request()->ipinfo->country_name != null && request()->ipinfo->region == $state['stateName'] ? request()->ipinfo->region : '' }}> {{$state['stateName']}} </option>
                                    @endforeach
                                    {{-- @foreach($state as $name)
                                       <option value="{{$name->id}}">{{$name->name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="form-group position-relative custom--password">
                                <label for="exampleInputPassword1">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Be mindful of what you have used in other websites" name="password"
                                        required autocomplete="new-password"
                                        data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                                        data-parsley-required-message="@lang('errors/validation/required.password')"
                                        data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                                    <span class="input-group-text custom--eye" id="togglePassword" style="cursor: pointer;">
                                        <i class="fa fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                                <div class="termsandconditions_text_color">
                                    @error('password')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group position-relative custom--password">
                                <label for="conformPassword">{{ __('Confirm Password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="conformPassword"
                                        placeholder="Confirm your password" name="password_confirmation"
                                        data-parsley-equalto="#exampleInputPassword1"
                                        data-parsley-equalto-message="Confirm password should be the same password"
                                        required autocomplete="new-password"
                                        data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                                    <span class="input-group-text custom--eye" id="toggleConfirmPassword" style="cursor: pointer;">
                                        <i class="fa fa-eye" id="confirmEyeIcon"></i>
                                    </span>
                                </div>
                                <div class="termsandconditions_text_color">
                                    <!-- error sms here -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="conformPassword">Referred by Agent (Agent ID)</label>
                                <input type="txt" class="form-control" id="agent_id" name="agent_id" placeholder="Enter Agent ID">
                                <div class="termsandconditions_text_color">
                                    <!-- error sms here -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 pr-0 pl-2">
                                    <div class="form-check form-check-inline pb-0">
                                        <input class="form-check-input" required type="radio" name="type"
                                               id="inlineRadio1" value="3"{{ old('type') == 3 ? ' checked' : null }}>
                                        <label class="form-check-label" for="inlineRadio1">I am an Escort</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 pr-0">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="inlineRadio2"
                                               value="4"{{ old('type') == 4 ? ' checked' : null }}>
                                        <label class="form-check-label" for="inlineRadio2">I am a Massage Centre</label>
                                    </div>
                                </div>
                            </div>
                        <!--<div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="5"{{ old('type') == 4 ? ' checked' : null }}>
                     <label class="form-check-label" for="inlineRadio2">I am a Agent</label>
                 </div>-->

                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                                @error('type')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-check form-check-inline pb-0" style="margin-left: 4px;">
                                <input type="checkbox" data-parsley-errors-container=".check-tc"
                                       class="form-check-input" id="termsandconditions" required
                                       data-parsley-required-message="@lang('errors/validation/required.checkbox')">
                                <label class="form-check-label " for="termsandconditions">I have read and agree to the
                                    <a href="terms-conditions" class="termsandconditions_text_color"
                                       style="font-size: 13px;">Terms and Conditions</a></label>
                            </div>
                            <span class="check-tc"></span>
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                            </div>
                            <div class="form-row pt-3">
                                <div class="col">
                                    <button type="submit" id="submit_button" class="btn site_btn_primary">Register
                                    </button>
                                </div>
                                <div class="col geo-font">
                                    <label class="form-check-label"><sup>(*)</sup>Geolocation in use.</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="padding_one_thiry_top padding_bottom_eight_px">
        <div class="container">


            <div class="accordion-container">
                <div class="set">
                    <a class="active">
                        Password Requirements
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content" style="display: block;">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-12">
                                        <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0">
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                lowercase character
                                            </li>
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                number
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12">
                                        <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0">
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                uppercase character
                                            </li>
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                special character
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-12">
                                        <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx">
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> 8 characters
                                                minimum
                                            </li>
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> 50 characters
                                                maximum
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Profile Options
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>Create a Profile with a few simple steps. Our Profile creator will calculate the Fee
                                along the way. You will always know what the Fees are before you commit to posting your
                                Profile. You can also create a Profile and archive it until you are ready to post it.
                                Create as many Profiles as you like.</p>
                            <span class=" custome_span_color">Go to <a
                                    href="{{ url('help-for-advertisers')}}" class="termsandconditions_text_color">help for Advertisers</a> for details on Membership Packages associated with each Membership Type.</span>
                            <table class="table2">
                                <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col" style="border-left: 2px solid #000000;">Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>Platinum</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Platinum Membership always ranks at the top of the Escort Home Page.
                                        <p><b>List View:</b> Your Thumbnail photo is 142px x 200px. Rates, review
                                            rating,
                                            available to, verification and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b> Your Thumbnail photo is 200px x 281px. Hourly rate,
                                            services,
                                            gender, orientation and view rating are included in the display.</p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            Thumbnail is 420px x 600px together with 6 additional photos
                                            and a video player 640px x 360px. All photos and the video
                                            can pop up.
                                        </p>
                                    </td>
                                </tr>

                                <tr>

                                    <td>Gold</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Gold Membership ranks behind Platinum and before Silver.
                                        <p><b>List View:</b> Your Thumbnail photo is 112px x 157px. Rates, review
                                            rating,
                                            available to, verification and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b> Your Thumbnail photo is 163px x 229px. Hourly rate,
                                            services,
                                            gender, orientation and view rating are included in the display.
                                        </p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            Thumbnail is 420px x 600px together with 6 additional photos
                                            and a video player 640px x 360px. All photos and the video
                                            can pop up
                                        </p>
                                    </td>
                                </tr>


                                <tr>

                                    <td>Silver</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Silver Membership ranks behind Gold and before Free.
                                        <p><b>List View:</b> Your Thumbnail photo is 102px x 144px. Review rating,
                                            available to, verification and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b> Your Thumbnail photo is 136px x 191px. Hourly rate,
                                            services,
                                            gender, orientation and view rating are included in the display.
                                        </p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            Thumbnail is 420px x 600px together with 6 additional photos
                                            and a video player 640px x 360px. All photos and the video can
                                            pop up.
                                        </p>
                                    </td>
                                </tr>


                                <tr>

                                    <td>Free</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Free Membership ranks behind Silver
                                        <p>Escort Home Page: You will appear after paid listings in all Search Page
                                            results and Profile shortlist displays.</p>
                                        <p><b>List View:</b> Your Thumbnail is displayed as a silhouette 79px x 116px.
                                            Available to and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b>Your Thumbnail is displayed as a silhouette 100px x 145px.
                                            Hourly rate and services are included in the display.
                                        </p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            thumbnail photo is 420px x 600px together with 6 additional
                                            photos 100px x 100px. No video is available. All photos can
                                            pop up.</p>
                                        <p>If you receive over a certain number of Profile views or telephone number
                                            clicks during the free 14 day period you will be informed and notified to
                                            upgrade to a paying Membership Type.</p>
                                        <p>We do this to provide for the fairest distribution of leads between our Free
                                            Members. If you do not elect to become a paying Member, your Profile will be
                                            suspended. You will still be able to log onto your Account at any time to
                                            upgrade your Membership Type.</p>

                                    </td>
                                </tr>
                                </tbody>
                            </table>


                            <div class="mt-3">
                                <b>Changes to this Guide</b><br>
                                <span>This Guide was last updated on 02-2024.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Accommodation & Travel Services
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>Escorts4U has partnered with a leading provider of online booking services for
                                accommodation and travel. For more information go to <span
                                    class=""><a href="{{ url('help-for-advertisers')}}"
                                                                     class="termsandconditions_text_color">Help for Advertisers</a></span>
                                and select "Travel & Accommodation".</p>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Products
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>Escorts4U has partnered with the Condom Man where you can order products online and they
                                will be delivered to your door. For more information about ordering products
                                go to <span
                                    class=""><a href="#" class="termsandconditions_text_color">Products</a></span>. (This service is only available to Perth Escorts).</p>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Visa and Migration Advice
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>Escorts4U has partnered with an experienced advisor in this complex area. For more
                                information about these services go to <span class=""><a
                                        href="{{ url('help-for-advertisers')}}" class="termsandconditions_text_color">Help for Advertisers</a></span>
                                and select "Visa applications & banking". Our partner can also provide advice on
                                education placements. You can submit an enquiry with our partner.</p>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Any Question?
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>We have many sources you can access for help and information. See <span
                                    class=""><a href="{{ url('help-for-advertisers')}}"
                                                                     class="termsandconditions_text_color">help for Advertisers</a></span>
                                and <span class=""><a href="{{ url('faqs')}}"
                                                                           class="termsandconditions_text_color">FAQs</a></span>,
                                or if you still can not find the answer, <span class=""><a
                                        href="{{ url('contact-us')}}"
                                        class="termsandconditions_text_color">contact us</a></span> directly.</p>
                        </div>
                    </div>
                </div>
                <!-- changes policy -->
                <div class="set">
                    <a>Changes to this Policy

                    <i class="fa fa-angle-down"></i>
                    </a>
                    
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <p>
                                                We may change or modify these Terms and Conditions in the future. We
                                                will note the date that revisions were last made at the bottom of this
                                                page. Any revision will take effect upon its posting. It is your
                                                responsibility to check the <a href="{{ url('terms-conditions')}}">Terms
                                                    and Conditions</a> from time to time to review the most current
                                                version.
                                            </p>
                                            <p>
                                                Escorts4U archives all previous versions of the Terms and Conditions
                                            </p>
                                            <p><b>This policy was last updated 04-06-2025</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="modal" id="sendOtp_modal" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <form id="SendOtp" method="post" action="">
                        @csrf
                        <div class="modal-header main_bg_color border-0">
                            <h5 class="modal-title text-white"><img src="{{ asset('assets/app/img/face-lock.png')}}" class="custompopicon"> Send One Time Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                      <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                      </span>
                            </button>
                        </div>
                        <div class="modal-body forgot_pass pb-1">
                            <div class="form-group label_margin_zero_for_login">
                                <div class="row text-center" style="">
                                    <div class="col-md-12">
                                        <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png') }}"
                                                         class="img-fluid" alt="logo"></a>
                                    </div>
                                </div>
                                <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Account
                                        Protection</strong></h4>
                                <p class="text-center pb-2">To help keep your account safe, E4U wants to make sure it’s
                                    really you trying to register.</p>
                                <input type="password" maxlength="4" required class="form-control" name="otp" id="otp"
                                       aria-describedby="emailHelp" placeholder="Enter One Time Password"
                                       data-parsley-required-message="One Time Password is required">

                                <div class="termsandconditions_text_color">
                                    @error('opt')

                                    {{ $message }}
                                    @enderror

                                </div>
                                <input type="hidden" name="phone" id="phoneId" value="">
                            </div>
                            <div id="senderror">
                            </div>

                        </div>
                        <div class="modal-footer forgot_pass pt-0 pb-4">
                            <button type="submit" class="btn main_bg_color site_btn_primary" id="sendOtpSubmit">Send
                            </button>
                            <p class="pt-2">Not received your code? <a href="#" id="resendOtpSubmit"
                                                                       class="termsandconditions_text_color">Resend
                                    Code</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="comman_modal" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <form id="forgotPasswordSend" method="post" action="">
                        @csrf
                        <div class="modal-header main_bg_color border-0">
                            <h5 class="modal-title text-white">Reset Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                      <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                      </span>
                            </button>
                        </div>
                        <div class="modal-body forgot_pass pb-1">
                            <div class="form-group label_margin_zero_for_login">
                                <div class="row text-center" style="">
                                    <div class="col-md-12">
                                        <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png') }}"
                                                         class="img-fluid" alt="logo"></a>
                                    </div>
                                </div>
                                <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Reset
                                        Password</strong></h4>
                                <p class="text-center pb-2">We’ll send you a reset password link on your email.</p>
                                <input type="txt" required class="form-control" name="email" id="email"
                                       aria-describedby="emailHelp" placeholder="Email Address"
                                       data-parsley-required-message="Your Email is required"
                                       value="{{ old('email') }}">
                                <div class="termsandconditions_text_color">
                                    @error('email')

                                    {{ $message }}
                                    @enderror
                                    <input type="hidden" name="url" value="{{ route('escort.forgot')}}">
                                </div>
                                <div id="errorNew"></div>
                            </div>
                        </div>
                        <div class="modal-footer forgot_pass pt-0 pb-4">
                            <button type="submit" class="btn main_bg_color site_btn_primary" id="sendSubmit">Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

    <script>

        $(function () {
            $('#escort_registration').parsley();

            var RegistrationForm = $("#escort_registration");

            RegistrationForm.submit(function (e) {

                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData($("#escort_registration")[0]);
                var token = $('input[name="_token"]').attr('value');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-Token': token
                    },
                    success: function (data) {

                        console.log(data);
                        var ph = data.phone;
                        $("#phoneId").attr('value', ph);
                        if (data.error == 1) {
                            $('body').on("click", "#resendOtpSubmit", function () {
                                var token = $('input[name="_token"]').attr('value');
                                $.post({
                                    type: 'POST',
                                    url: "{{ route('web.resend.otp') }}",
                                    headers: {
                                        'X-CSRF-Token': token
                                    },
                                    data: {
                                        phone: data.phone,
                                    },
                                }).done(function (data) {
                                    $('#senderror').html("<p> Verification code sent to " + data.phone + "</p>");
                                    console.log(data);
                                })
                            });


                            $("#sendOtp_modal").modal('show');//
                            $("body").on("submit", "#SendOtp", function (e) {
                                e.preventDefault();
                                var form = $(this);

                                console.log(ph);
                                // var url = form.attr('action');
                                var url = "{{ route('web.checkOTP')}}";

                                var data = new FormData($('#SendOtp')[0]);
                                var phone = data.phone;
                                //data.append("phone",phone );
                                console.log("url=" + url);
                                var token = $('input[name="_token"]').attr('value');

                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: data,
                                    dataType: "JSON",
                                    contentType: false,
                                    processData: false,
                                    headers: {
                                        'X-CSRF-Token': token
                                    },
                                    success: function (data) {
                                        console.log(data);

                                        if (data.error == true) {
                                            //console.log(data);
                                            if (data.type == 3) {
                                                window.location.href = "{{ route('escort.dashboard') }}";
                                            }
                                            if (data.type == 4) {
                                                window.location.href = "{{ route('center.dashboard') }}";
                                            }

                                        }

                                    },
                                    error: function (data) {

                                        console.log("error: a", data.responseJSON.errors);
                                        var errorsHtml = '<ul><li>';
                                        $.each(data.responseJSON.errors, function (key, value) {
                                            errorsHtml = '<div class="alert alert-danger"><ul>';
                                            errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                                        });

                                        errorsHtml += '</ul></li>';
                                        $('#senderror').html(errorsHtml);
                                    }
                                });

                            });
                        }
                    },
                    error: function (data) {

                        console.log("error: b", data.responseJSON.errors);

                        var errorsHtml = '';
                        $.each(data.responseJSON.errors, function (key, value) {

                            if (key === "phone") {
                                $('#phone-errors').html('<div class="alert alert-danger">' + data.responseJSON.errors.phone + '</div>');
                            }
                            if (key === "email") {
                                $('#email-errors').html('<div class="alert alert-danger">' + data.responseJSON.errors.email + '</div>');
                            }
                            // errorsHtml = '<div class="alert alert-danger"><ul>';
                            // errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                        });

                        errorsHtml += '</ul></div>';
                        $('#formaterror').html(errorsHtml);

                        // $('#exampleInputEmail1').attr('data-parsley-error-message', data.responseJSON.errors.email).trigger('parsley-error');
                        console.log(data.responseJSON.errors.phone);
                        console.log(data.responseJSON.errors.email);
                    }
                });
                console.log("Registration with us");
            });

            //var token = $('input[name="_token"]').attr('value');

            //   $.post({
            //       type: 'POST',
            //       url: "{{ route('web.state.name') }}",
            //       headers: {
            //                   'X-CSRF-Token': token
            //               },
            //   }).done(function (data) {
            //       if(data.error == true) {
            //           console.log(data.stateName);
            //           $("#location_state").val(data.stateName);
            //       } else {

            //       }
            //   });
        });
        $("body").on("click", "#submit_button", function () {
            $('#phone-errors').html('');
            $('#email-errors').html('');
            console.log("working");
        });
    </script>
    <script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordField = document.getElementById("exampleInputPassword1");
        const eyeIcon = document.getElementById("eyeIcon");
        const isPassword = passwordField.type === "password";

        passwordField.type = isPassword ? "text" : "password";
        eyeIcon.classList.toggle("fa-eye");
        eyeIcon.classList.toggle("fa-eye-slash");
    });

    document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
        const confirmPasswordField = document.getElementById("conformPassword");
        const confirmEyeIcon = document.getElementById("confirmEyeIcon");
        const isPassword = confirmPasswordField.type === "password";

        confirmPasswordField.type = isPassword ? "text" : "password";
        confirmEyeIcon.classList.toggle("fa-eye");
        confirmEyeIcon.classList.toggle("fa-eye-slash");
    });
</script>
@endsection
