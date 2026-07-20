@extends('layouts.web')
<style>
    p {
        text-align: justify !important;
    }

    .reg_info ul li,
    p {
        /* text-align: center !important; */
    }
</style>
@section('content')
    <section class="section_bg_color padding_ninty_top_ninty_px padding_ninty_btm_ninty_px angle_bg_image  padding_bottom_eight_px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 adverti_reg_page_padingto_bt-new">
                    <div class="reg_info agent-registration common-reg-info">                         
                        <div class="inner_div">
                            <div class="heading">
                                <svg width="45px" height="45px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9ZM12 20.5C13.784 20.5 15.4397 19.9504 16.8069 19.0112C17.4108 18.5964 17.6688 17.8062 17.3178 17.1632C16.59 15.8303 15.0902 15 11.9999 15C8.90969 15 7.40997 15.8302 6.68214 17.1632C6.33105 17.8062 6.5891 18.5963 7.19296 19.0111C8.56018 19.9503 10.2159 20.5 12 20.5Z"
                                            fill="#ff3c5f"></path>
                                    </g>
                                </svg>
                                <h1> Agent Registration</h1>
                            </div>
                            <h2>Lodge your enquiry with us here</h2>
                            <p>If you have industry experience or you are well connected to Advertisers,
                                then
                                becoming an Escorts4U Agent may be for you. Earn additional income as an Agent. We will
                                assist you in every regard to earn.
                                Register and we will be in touch to go over what being an Agent can do for you.
                                See also <span><a href="{{ url('help-for-agents') }}" class="termsandconditions_text_color"
                                        style="font-size: 16px;">Help for Agent</a></span> and <a
                                    href="https://www.agencymanagement.com.au" style="font-size: 16px;" target="_blank"
                                    class="termsandconditions_text_color">Agency Management</a> for more information about
                                benefits and your obligations.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="reg_box_form_style col-lg-7 col-md-12 col-sm-12">
                    <div class="regstractionform common-reg-form">
                        <div class="heading-3">
                            <svg width="55px" height="55px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15 9C15 10.6569 13.6569 12 12 12C10.3431 12 9 10.6569 9 9C9 7.34315 10.3431 6 12 6C13.6569 6 15 7.34315 15 9ZM12 20.5C13.784 20.5 15.4397 19.9504 16.8069 19.0112C17.4108 18.5964 17.6688 17.8062 17.3178 17.1632C16.59 15.8303 15.0902 15 11.9999 15C8.90969 15 7.40997 15.8302 6.68214 17.1632C6.33105 17.8062 6.5891 18.5963 7.19296 19.0111C8.56018 19.9503 10.2159 20.5 12 20.5Z"
                                        fill="#0c223d"></path>
                                </g>
                            </svg>
                            <div>
                                <h3>Register Now</h3>
                                <p class="mb-0 small">Earn Additional Income!</p>
                            </div>
                        </div>
                        <hr>
                        <form id="escort_registration" action="{{ route('agent.register') }}" method="post">
                            @csrf
                            <div class="row">
                                    <div class="form-group col-lg-6 col-sm-12 ">
                                        <label for="exampleInputEmail1">Business Name</label>
                                        <div class="input-group custom-fields">
                                            <span class="input-group-text">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M15 7C15 8.65685 13.6569 10 12 10C10.3431 10 9 8.65685 9 7C9 5.34315 10.3431 4 12 4C13.6569 4 15 5.34315 15 7Z"
                                                            stroke="#495057" stroke-width="2"></path>
                                                        <path
                                                            d="M5 19.5C5 15.9101 7.91015 13 11.5 13H12.5C16.0899 13 19 15.9101 19 19.5V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V19.5Z"
                                                            stroke="#495057" stroke-width="2"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="name" value="{{ old('name') }}" required
                                                autocomplete="name" placeholder="Name"
                                                
                                                data-parsley-errors-container="#name-errors"
                                                data-parsley-required-message="Your Name is required"
                                                data-parsley-pattern="/^[a-z0-9\s\-\(\)]+$/i">
                                                <div class="termsandconditions_text_color">
                                                    @error('name')
                                                        <strong>{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                
                                        </div>
                                    <div id="name-errors"></div>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 ">
                                        <label for="mobileno">Mobile Number</label>
                                        <div class="input-group custom-fields">
                                            <span class="input-group-text">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M3 6.5C3 14.5081 9.49187 21 17.5 21C18.166 21 18.8216 20.9551 19.4637 20.8682C20.3747 20.7448 21 19.9292 21 19.01V16.4415C21 15.5807 20.4491 14.8164 19.6325 14.5442L16.4841 13.4947C15.6836 13.2279 14.8252 13.699 14.6206 14.5177C14.3475 15.6102 12.987 15.987 12.1907 15.1907L8.80926 11.8093C8.01301 11.013 8.38984 9.65254 9.48229 9.37943C10.301 9.17476 10.7721 8.31644 10.5053 7.51586L9.45585 4.36754C9.18362 3.55086 8.41934 3 7.55848 3H4.99004C4.0708 3 3.25518 3.62533 3.13185 4.53627C3.0449 5.17845 3 5.83398 3 6.5Z"
                                                            stroke="#495057" stroke-width="2" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <input type="tel" maxlength="10" data-parsley-maxlength="10" required
                                                class="form-control" name="phone" id="mobileno" aria-describedby="emailHelp"
                                                placeholder="Mobile Number"
                                                data-parsley-required-message="Your mobile number is required"
                                                
                                                data-parsley-errors-container="#phone-errors"
                                                value="{{ old('phone') }}" data-parsley-type="digits"
                                                data-parsley-type-message="Enter only mobile numbers" autocomplete="off"
                                                oninput="this.value = this.value.replace(/\D/g,'');">
                                            
                                                <div class="termsandconditions_text_color">
                                                    @error('phone')
                                                        <strong>{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div id="phone-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="exampleInputEmail1">{{ __('Email') }}</label>
                                        <div class="input-group custom-fields">
                                            <span class="input-group-text">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7"
                                                            stroke="#495057" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <rect x="3" y="5" width="18" height="14" rx="2"
                                                            stroke="#495057" stroke-width="2" stroke-linecap="round"></rect>
                                                    </g>
                                                </svg>
                                            </span>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required
                                                autocomplete="email" placeholder="Email Address"
                                                 data-parsley-errors-container="#email-errors"
                                                data-parsley-required-message="@lang('errors/validation/required.email')"
                                                data-parsley-type-message="@lang('errors/validation/valid.email')">
                                           
                                            <div class="termsandconditions_text_color">
                                                @error('email')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div id="email-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="exampleFormControlSelect1">Location<sup>(1)</sup></label>
                                        <div class="input-group custom-fields">
                                            <span class="input-group-text">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M5.7 15C4.03377 15.6353 3 16.5205 3 17.4997C3 19.4329 7.02944 21 12 21C16.9706 21 21 19.4329 21 17.4997C21 16.5205 19.9662 15.6353 18.3 15M12 9H12.01M18 9C18 13.0637 13.5 15 12 18C10.5 15 6 13.0637 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9ZM13 9C13 9.55228 12.5523 10 12 10C11.4477 10 11 9.55228 11 9C11 8.44772 11.4477 8 12 8C12.5523 8 13 8.44772 13 9Z"
                                                            stroke="#495057" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </span>
                                            <select class="form-control loc-sec" id="location_state" name="state_id" required
                                                data-parsley-required-message="Select Location"
                                                data-parsley-errors-container="#location-errors">>
                                                <option value="">Select your Home State (if not already identified)</option>
                                                @foreach (config('escorts.profile.states') as $key => $state)
                                                    <option value="{{ $key }}"
                                                        {{ isset(request()->ipinfo->country_name) && request()->ipinfo->country_name != null && request()->ipinfo->region == $state['stateName'] ? request()->ipinfo->region : '' }}>
                                                        {{ $state['stateName'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="location-errors"></div>
                                    </div>
                                    <input type="hidden" name="type" value="5">
                                    <div class="termsandconditions_text_color">
                                        @error('type')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 tnc-info">
                                        
                                        <div class="form-check-inline" style="margin-left: 5px;">
                                            <input type="checkbox" data-parsley-errors-container=".check-tc" class="form-check-input"
                                                id="termsandconditions" required data-parsley-required-message="@lang('errors/validation/required.checkbox')">
                                            <label class="form-check-label" for="termsandconditions">I have read and agree to the <a
                                                    href="terms-conditions" class="termsandconditions_text_color"
                                                    style="font-size: 13px;">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span class="check-tc"></span>
                                    </div>
                                    <div class="termsandconditions_text_color">
                                        <!-- error sms here -->
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" id="submit_button"
                                            class="btn site_btn_primary w-100">
                                            Register
                                        </button>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="common_form_note">
                                            <p><b>Notes:</b>
                                            <ol>
                                                <li>Geolocation in use.</li>
                                                <li>Management of your Account is optimised in a browser or tablet. There are
                                                    limitations on a Mobile device.</li>
                                            </ol>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                        <div class="common_form_note">
                                            <p>
                                                Any personal information submitted to this Website will be handled in accordance
                                                with
                                                E4U's <a class="termsandconditions_text_color" href="{{ 'privacy-policy' }}"
                                                    target="_blank">Privacy Policy</a> and
                                                <a href="{{ 'privacy-collection-notice' }}"
                                                    class="termsandconditions_text_color" target="_blank">Privacy Collection
                                                    Notice</a>, both
                                                available on the Website.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="padding_one_thiry_top padding_bottom_eight_px" style="margin-top: 120px">
        <div class="container">
            {{-- <h1 class="home_heading_first margin_btm_twenty_px page-title">Help for Agents</h1> --}}
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
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul
                                            class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0 register_ul">
                                            <li><span class="correct_symbole_font_weight">✓</span> At least 1 lowercase
                                                character</li>
                                            <li><span class="correct_symbole_font_weight">✓</span> At least 1 number</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul
                                            class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0 register_ul">
                                            <li><span class="correct_symbole_font_weight">✓</span> At least 1 uppercase
                                                character</li>
                                            <li><span class="correct_symbole_font_weight">✓</span> At least 1 special
                                                character</li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx register_ul">
                                            <li><span class="correct_symbole_font_weight">✓</span> 8 characters minimum
                                            </li>
                                            <li><span class="correct_symbole_font_weight">✓</span> 50 characters maximum
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
                        Applying to become an Agent
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content text-justify">
                            <p><b>Q: How do I apply to become an Agent?</b></p>
                            <ul style="list-style:none;" class="mb-1 pl-3">
                                <li>Step 1. Complete the Registration form.</li>
                                <li>Step 2. Once you have submitted the the Registration form, someone from our office will
                                    be in touch with you to explain the role in detail.</li>
                                <li>Step 3. If you appear to be suitable for the role, a more formal process will begin.
                                </li>
                            </ul>
                            <p><b>Q: Will I get a confirmation of my application to become an Agent?</b></p>
                            <ul class="list-unstyled pl-3">
                                <li>Yes you will. Escorts4U will forward to you by email a confirmation that we have
                                    received your application. The confirmation will contain
                                    a reference number for you to quote if any follow up is required.</li>
                            </ul>
                            <p><b>Q: How do I get in touch with Escorts4U if I have any queries?</b></p>
                            <ul class="list-unstyled pl-3">
                                <li>You can contact our <a href="{{ url('contact-us') }}"
                                        class="termsandconditions_text_color">support team</a> anytime. Please allow us
                                    some time to get back to you. We will get back to you within 24 hours, usually sooner.
                                </li>
                            </ul>
                            <p><b>Q: Do I have to be a registered business to be an Agent?</b></p>
                            <ul class="list-unstyled pl-3">
                                <li class="mb-2">Yes. It is up to you as to which form of entity you wish to be, sole
                                    trader or an incorporated company. You will need to have an ABN as well.</li>
                                <li>Escorts4U can assist you with putting into place the entity you wish to use. That
                                    assistance is only with the putting into place the entity type, we do not provide advice
                                    on which type of entity is best suited to you. You need to get your own advice from an
                                    accountant in that regard.</li>
                            </ul>
                            <p><b>Q: Can Escorts4U put me in touch with an accountant?</b></p>
                            <ul class="list-unstyled pl-3">
                                <li class="mb-2">Yes we can. We have a list of accounting practices in each State who
                                    have an understanding of the Escorts4U business model. Simply request the details and
                                    then choose an accountant that is nearest to you. When you contact the accounting
                                    practice, mention you are wanting to make an appointment to discuss becoming an Agent
                                    for Escorts4U.</li>
                                <li>Escorts4U has no financial arrangements with any of the accounting practices. We do not
                                    pay any commissions to the accounting practices.</li>
                            </ul>
                            <p><b>Q: Will I have exclusivity to the area I am appointed in?</b></p>
                            <ul class="list-unstyled pl-3">
                                <li>No. Your appointment is a non-exclusive appointment within a Location. It is not our
                                    practice to appoint more than 3 Agents to each Location. It is our view that 3 Agents is
                                    adequate to service all of the Advertisers needs in any Location.</li>
                            </ul>
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
                                            <!-- level 1 list -->
                                            <p>
                                                We may change or modify these Terms and Conditions in the future. We
                                                will note the date that revisions were last made at the bottom of this
                                                page. Any revision will take effect upon its posting. It is your
                                                responsibility to check the <a href="{{ url('terms-conditions') }}">Terms
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


        <!-- <div class="modal fade upload-modal" id="sendOtp_modal" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="SendOtp" method="post" action="" >
                    @csrf
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title text-white"> <img src="{{ asset('assets/app/img/face-lock.png') }}" class="custompopicon"> Send One Time Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                        </button>
                    </div>
                    <div class="modal-body forgot_pass pb-1">
                        <div class="form-group label_margin_zero_for_login">
                             <div class="row text-center" style="">
                                   <div class="col-md-12">
                                      <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png') }}" class="img-fluid" alt="logo"></a>
                                   </div>
                             </div>
                             <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Account Protection</strong></h4>
                              <p class="text-center pb-2">To help keep your account safe, E4U wants to make sure it’s really you trying to register.</p>
                               <input type="password" maxlength="4" required class="form-control" name="otp" id="otp" aria-describedby="emailHelp" placeholder="Enter One Time Password" data-parsley-required-message="One Time Password is required">

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
                        <button type="submit" class="btn main_bg_color site_btn_primary" id="sendOtpSubmit">Send</button>
                        <p class="pt-2">Not received your code? <a href="#" id="resendOtpSubmit" class="termsandconditions_text_color">Resend Code</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

        @include('modal.two-step-verification')

        <div class="modal fade upload-modal" id="comman_modal" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="forgotPasswordSend" method="post" action="">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <img src="{{ asset('assets/app/img/newcross.png') }}"
                                        class="img-fluid img_resize_in_smscreen">
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
                                <input type="txt" required class="form-control" name="email" id="email"
                                    aria-describedby="emailHelp" placeholder="Email Address"
                                    data-parsley-required-message="Your Email is required" value="{{ old('email') }}">
                                <div class="termsandconditions_text_color">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                    <input type="hidden" name="url" value="{{ route('escort.forgot') }}">
                                </div>
                                <div id="errorNew"></div>
                            </div>
                        </div>
                        <div class="modal-footer forgot_pass pt-0 pb-4">
                            <button type="submit" class="btn main_bg_color site_btn_primary"
                                id="sendSubmit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </section>
@endsection
@section('script')
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            const passwordField = document.getElementById("exampleInputPassword1");
            const eyeIcon = document.getElementById("eyeIcon");
            const isPassword = passwordField.type === "password";

            passwordField.type = isPassword ? "text" : "password";
            eyeIcon.classList.toggle("fa-eye");
            eyeIcon.classList.toggle("fa-eye-slash");
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
            const confirmPasswordField = document.getElementById("conformPassword");
            const confirmEyeIcon = document.getElementById("confirmEyeIcon");
            const isPassword = confirmPasswordField.type === "password";

            confirmPasswordField.type = isPassword ? "text" : "password";
            confirmEyeIcon.classList.toggle("fa-eye");
            confirmEyeIcon.classList.toggle("fa-eye-slash");
        });
    </script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        $(function() {



            $('#escort_registration').parsley({

            });
            var AgentRegistrationForm = $("#escort_registration");

            AgentRegistrationForm.submit(function(e) {


                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData($("#escort_registration")[0]);
                var token = $('input[name="_token"]').attr('value');
                swal_waiting_popup({
                    'title': 'Your registration is currently being processed.'
                });
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
                    success: function(data) {
                        console.log(data);
                        var ph = data.phone;
                        $("#phoneId").attr('value', ph);

                        if (data.error == 1 && data.status === 'Pending') {
                            sessionStorage.setItem('agent_pending_status',
                                'Your account has been successfully created but is currently inactive.\n \nYou will receive an email notification once it has been activated.'
                                );
                            window.location.href = "{{ route('agent.login') }}";
                            return false;
                        } else if(data.error == 1 && data.status != 'Pending') {
                            Swal.close();
                            setTimeout(() => {
                                $("#sendOtp_modal").modal({
                                    backdrop: 'static',
                                    keyboard: false
                                });
                            }, 300);

                            $('body').on("click", "#resendOtpSubmit", function() {
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
                                }).done(function(data) {
                                    $('#senderror').html(
                                        "<p> Verification code sent to " +
                                        data.phone + "</p>");
                                    console.log(data);
                                })
                            });


                            $("body").on("submit", "#SendOtp", function(e) {
                                e.preventDefault();
                                var form = $(this);
                                swal_waiting_popup({
                                    'title': 'Validating your OTP.'
                                });
                                console.log(ph);
                                // var url = form.attr('action');
                                var url = "{{ route('web.checkOTP') }}";

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
                                    success: function(data) {
                                        console.log(data);

                                        if (data.error == true) {
                                            //console.log(data);
                                            window.location.href =
                                                "{{ route('agent.dashboard') }}";

                                        }

                                    },
                                    error: function(data) {
                                        Swal.close();
                                        console.log("error: a", data
                                            .responseJSON.errors);
                                        var errorsHtml = '<ul><li>';
                                        $.each(data.responseJSON.errors,
                                            function(key, value) {
                                                errorsHtml =
                                                    '<div class="alert alert-danger"><ul>';
                                                errorsHtml +=
                                                    '<li>' + value +
                                                    '</li>'; //showing only the first error.
                                            });

                                        errorsHtml += '</ul></li>';
                                        $('#senderror').html(
                                        errorsHtml);
                                    }
                                });

                            });
                        }
                    },
                    error: function(data) {
                        Swal.close();
                        console.log("error: b", data.responseJSON.errors);
                        var errorsHtml = '<ul><li>';
                        $.each(data.responseJSON.errors, function(key, value) {
                            console.log("key=", key);
                            if (key === "phone") {
                                $('#phone-errors').html(
                                    '<div class="alert alert-danger">' + data
                                    .responseJSON.errors.phone + '</div>');
                            }
                            if (key === "email") {
                                $('#email-errors').html(
                                    '<div class="alert alert-danger">' + data
                                    .responseJSON.errors.email + '</div>');
                            }
                            //  errorsHtml = '<div class="alert alert-danger"><ul>';
                            //  errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                        });

                        errorsHtml += '</ul></li>';

                        //$('#senderror').html(errorsHtml);
                    }
                });

            });
        });

        $("body").on("click", "#submit_button", function() {
            $('#phone-errors').html('');
            $('#email-errors').html('');
            console.log("working");
        });
    </script>
@endsection
