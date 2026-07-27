@extends('layouts.web')

<style>
    p {
        text-align: justify !important;
    }

    table tr td,
    th {
        text-align: justify;
    }
    .table-bordered{
        border: 1px solid #dee2e6;
    }
    .table thead th {
    border-top: 1px solid #dee2e6 !important;
}

</style>
@section('content')
    <section class="section_bg_color padding_ninty_top_ninty_px padding_bottom_eight_px angle_bg_image viewer-registration">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 adverti_reg_page_padingto_bt-new">
                    <div class="reg_info viewer-registration common-reg-info">
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
                                <h1> Viewer Registration</h1>
                            </div>
                            <h2>Registration with us is anonymous and free</h2>
                            <p>You do not have to register with us to view an Advertiser's Profile however, if you
                                do register you will recieve the following benefits:</p>
                            <div class="inner-div-2">
                                 <div class="heading-2">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#FCB329">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <line x1="11.9999" y1="8.27274" x2="11.9999" y2="13.7273" stroke="#FCB329"
                                                stroke-width="1.81818" stroke-linecap="round" stroke-linejoin="round"></line>
                                            <path d="M12 17.3636L12 17.3719" stroke="#FCB329" stroke-width="1.81818"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path
                                                d="M21.7677 18.4635L13.6512 4.89384C12.9383 3.70205 11.0617 3.70205 10.3488 4.89385L2.23231 18.4635C1.54868 19.6065 2.45582 21 3.88347 21H20.1165C21.5442 21 22.4513 19.6065 21.7677 18.4635Z"
                                                stroke="#FCB329" stroke-width="1.81818" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                <h3>Benefits</h3>
                            </div>

                                <div class="a-info">
                                    <span>1</span>
                                    <p>
                                        Flag a Profile and produce a Shortlist of your preferred Advertisers (per session)
                                    </p>
                                </div>

                                <div class="a-info">
                                    <span>2</span>
                                    <p>
                                        After logging on, view your favourite Profiles (My Legbox)
                                    </p>
                                </div>

                                <div class="a-info">
                                    <span>3</span>
                                    <p>
                                        Receive Alerts when your favourite Escort is visiting your Location
                                    </p>
                                </div>

                                <div class="a-info">
                                    <span>4</span>
                                    <p>
                                        Have a discreet conversation with an Advertiser (provided they have enabled the feature)
                                    </p>
                                </div>

                                <div class="a-info">
                                    <span>5</span>
                                    <p>
                                        Write a review about your experience with an Advertiser
                                    </p>
                                </div>

                                <div class="a-info">
                                    <span>6</span>
                                    <p>
                                        Complete a private Note (My Notebox) about your experience with an Advertiser (from your Dashboard)
                                    </p>
                                </div>
                            </div>
                            <p>See also <span><a href="{{ url('help-for-viewers') }}"
                                        class="termsandconditions_text_color">Help for Viewers</a></span> for more
                                information on Membership benefits and your obligations.</p>
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
                                <p class="mb-0 small">No Fees Ever!</p>
                            </div>
                        </div>
                        <hr>
                        <form id="register_form" action="{{ route('register') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row">
                            <input type="hidden" name="escort_id" value="{{ request()->get('legboxId') }}">
                            <div class="form-group col-lg-6 col-sm-12">
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

                                    <input type="tel" autocomplete="off"
                                    oninput="this.value = this.value.replace(/\D/g,'');" maxlength="10"
                                    data-parsley-maxlength="10" required class="form-control" name="phone" id="mobileno"
                                    aria-describedby="emailHelp" placeholder="Mobile Number"
                                    data-parsley-required-message="Your mobile number is required"
                                    data-parsley-errors-container="#phone-errors"
                                    value="{{ old('phone') }}" data-parsley-type="digits"
                                    data-parsley-type-message="Enter only mobile numbers">
                                    
                                    <div class="termsandconditions_text_color">
                                        @error('phone')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    </div>
                                   
                                    <div id="phone-errors"></div> 
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
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
                                            data-parsley-required-message="Select Location" data-parsley-errors-container="#location-errors">
                                            <option value="">Select your Home State (if not already identified)</option>
                                            @foreach ($state as $name)
                                                <option value="{{ $name->id }}"
                                                    {{ isset(request()->ipinfo->country_name) && request()->ipinfo->country_name != null && request()->ipinfo->region == $name->name ? request()->ipinfo->region : '' }}>
                                                    {{ $name->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                    <div id="location-errors"></div>

                            </div>

                            <div class="form-group position-relative custom--password col-sm-12">
                                <label for="exampleInputPassword1">{{ __('Password') }}</label>
                                <div class="input-group custom-fields">
                                    <span class="input-group-text">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                                                        stroke="#495057" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Be mindful of what you have used in other websites" name="password"
                                        required autocomplete="new-password"
                                        data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                                        data-parsley-required-message="@lang('errors/validation/required.password')"
                                        data-parsley-pattern-message="@lang('errors/validation/valid.password')"
                                        data-parsley-errors-container="#password-error">
                                    <span class="input-group-text custom--eye" id="togglePassword" style="cursor: pointer;">
                                        <i class="fa fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                                 <div id="password-error"></div>
                                <div class="termsandconditions_text_color">
                                    @error('password')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group position-relative custom--password col-sm-12">
                                <label for="conformPassword">{{ __('Confirm Password') }}</label>
                                <div class="input-group custom-fields">
                                    <span class="input-group-text">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                                                        stroke="#495057" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    <input type="password" class="form-control" id="conformPassword"
                                        placeholder="Confirm your password" name="password_confirmation"
                                        data-parsley-equalto="#exampleInputPassword1"
                                         data-parsley-errors-container="#cpassword-error"
                                        data-parsley-equalto-message="Confirm password should be the same password" required
                                        autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                                    <span class="input-group-text custom--eye" id="toggleConfirmPassword"
                                        style="cursor: pointer;">
                                        <i class="fa fa-eye" id="confirmEyeIcon"></i>
                                    </span>
                                </div>
                                <div id="cpassword-error"></div>
                                <div class="termsandconditions_text_color">
                                    <!-- error sms here -->
                                </div>
                            </div>
                            <div class="col-sm-12 tnc-info">
                                    <div class="form-check-inline">

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
                            </div>
                            <!-- common note--->                          
                            <x-reg-note />
                            <!-- common note end--->    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding_one_thiry_top padding_ninty_btm_ninty_px padding_bottom_eight_px" text-color="white">
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
                            {{-- <div class="mt-3">
                            <b>Changes to this Guide</b><br>
                            <span>This Guide was last updated on 02-2024.</span>
                        </div> --}}
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a> Anonymity - it is up to you <i class="fa fa-angle-down"></i></a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>You determine how much information you want to disclose in your personal Account
                                information. The only mandatory information we require is your:</p>
                            <ul class="font_size_forteenpx text-justify" style="color:#686a6c;">
                                <li>Mobile number (for SMS 2FA verification), and notifications if you have your mobile
                                    number selected for that purpose</li>
                                <li>Email address (for notifications - when enabled)</li>
                                <li>Your Location (city)</li>
                            </ul>
                            <span class="text_decoration_for_a custome_span_color text-justify">
                                To have access to the Viewer benefits, you will need to disclose some additional
                                information in your Account settings. That does not include your name. We never request
                                your name to be disclosed.
                            </span>

                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Any Questions?
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>We have many sources you can access for help and information. See <span><a
                                        class="termsandconditions_text_color" href="{{ url('help-for-viewers') }}"> help
                                        for Viewers</a></span> and <span><a
                                        class="termsandconditions_text_color"href="{{ url('faqs') }}">FAQs</a></span>,
                                or if you still can not find the answer, <span><a class="termsandconditions_text_color"
                                        href="{{ url('contact-us') }}">contact us</a></span> directly.</p>
                            <p>We also welcome <span><a class="termsandconditions_text_color"
                                        href="{{ url('feedback') }}">feedback</a></span> on how we can improve the
                                delivery of our Services.</p>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Member Benefits
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content table-responsive">
                            <table class="table table-bordered text-justify">
                                <thead>
                                    <tr>
                                        <th scope="col" class="accordien_color_table"><b>Features</b></th>
                                        <th scope="col" class="accordien_color_table"><b>Registered</b></th>
                                        <th scope="col" class="accordien_color_table"><b>Unregistered</b></th>
                                        <th scope="col" class="accordien_color_table"><b>Comments</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="accordien_color_table">Viewing</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td><span class="accordien_color_table">You determine the default settings on what you would like to 
                                            appear on the Escort Listing page when you log on.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">Dashboard</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                                        <td><span class="accordien_color_table">A customised array of features at your finger tips.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">Shortlist</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td><span class="accordien_color_table">Flag your favorite Escorts while searching
                                                and then view your Shortlist.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">My Legbox</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span>
                                        </td>
                                        <td><span class="accordien_color_table">Select your favorite Escorts by adding them
                                                to your Legbox. View your Legbox anytime to see the Escort's Location.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">Messaging</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span>
                                        </td>
                                        <td><span class="accordien_color_table">Send a message to an Escort (provided they
                                                have enabled the feature).</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">My Notes</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span>
                                        </td>
                                        <td><span class="accordien_color_table">Make notes about your experience with an
                                                Escort.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">Notifications</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span>
                                        </td>
                                        <td><span class="accordien_color_table">Receive A-Alerts from Advertisers when they
                                                are visiting your Location.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">Rating</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span>
                                        </td>
                                        <td><span class="accordien_color_table">Rate your experience with an Escort so you
                                                will remember for next time.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">My Playbox</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                                        <td><span class="accordien_color_table">Have direct access to an Escort's Playbox.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">Reviews</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span>
                                        </td>
                                        <td><span class="accordien_color_table">Write a review about your experience with
                                                an Escort.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="accordien_color_table">Security</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                                        <td class="text-center"><span
                                                class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                                        <td><span class="accordien_color_table">Our Website is a secure environment so that
                                                we can maintain your anonymity.  Select the level of security you want to apply.</span></td>
                                    </tr>
                                </tbody>
                            </table>
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

        @include('modal.two-step-verification')


        <div class="modal upload-modal fade" id="comman_modal" style="display: none">
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
                                <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Reset Password</strong>
                                </h4>
                                <p class="text-center pb-2">We’ll send you a reset password link on your email.</p>
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
                            <button type="submit" class="btn-success-modal"
                                id="sendSubmit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Welcome Modal on Viewer registration --}}

    {{-- <button type="button" data-target="#RegisterEscort" data-toggle="modal">Click Me</button> --}}
    {{-- agar tum niche wale modal ko dekhana chate ho to upar wale button ko uncomment karo --}}
    {{-- for Escort --}}
    <div class="modal fade upload-modal" id="RegisterEscort" tabindex="-1" role="dialog"
        aria-labelledby="RegisterEscortLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- Header -->


                <div class="modal-header">

                    <h5 class="modal-title text-white"><img src="{{ asset('assets/app/img/welcome.png') }}"
                            class="custompopicon">
                        Welcome to Escorts4U! <span>Member ID: E20346</span></h5>
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                    </a>
                </div>
                <!-- Body -->
                <div class="modal-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="accordion-container">
                                <div class="set">
                                    <a class="active">
                                        Notes
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="content">
                                        <ol>
                                            <li>You can update your personal information any time by going to My Account and
                                                making
                                                your changes.</li>
                                            <li>Your features and Notifications can be accessed in My Account. Please take a
                                                look as
                                                these affect the way your Console operates and how you access a number of
                                                services.
                                                These settings also determined how you can view the Listings. Many of the
                                                services are
                                                enabled by default.</li>
                                            <li>If you do not log in when you visit the Website, then none of your
                                                preference settings
                                                will be applied and you will not have access to any of the services afforded
                                                to a Viewer.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table>

                                <tr>
                                    <td style="padding: 30px; text-align: justify;">
                                        <h4>Hello Sam,</h4>
                                        <p>
                                            Thank you for selecting E4U as your preferred Website for locating
                                            companionship. The
                                            team at E4U is here to help you. Here is some important information you need to
                                            know:
                                        </p>
                                        <ol style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                            <li>Before you can access any of the services on our Website you need to
                                                complete some
                                                more of your details, as a once off, These include :
                                                <ul
                                                    style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                    <li>Completing your personal information, such as About Me.</li>
                                                    <li>Setting your Notifications & Features.</li>
                                                    <li>Uploading your avatar (optional, not made public).</li>
                                                </ul>
                                                If you do not complete your settings, that may have an effect on how the
                                                Website
                                                delivers the services to you.
                                            </li>


                                            <li>Our support staff are available to help you between 8:00am and 6:00pm WST
                                                Monday
                                                to Friday. You can email us, text us, call us, or log a Support Ticket (our
                                                preference).</li>
                                            <li>Please remember your Member ID: [insert number created from registration],
                                                which you
                                                will need when communicating with us, especially when you raise a reportable
                                                incident
                                                via text or email. We use your Member ID for all communications across the
                                                Website
                                                (hashtags are not used in this Website).</li>
                                            <li>From time to time we will come back to you and remind you of any important
                                                information
                                                you have not completed.</li>
                                        </ol>

                                        <h4 style="margin-top: 25px;">Heads Up!</h4>
                                        <p>
                                            We have designed a unique Search filter for Users that enables you to undertake
                                            a wide
                                            range of searching options to make your experience a pleasant and enjoyable one.
                                            There
                                            are also some new world first services available to you as well. Some of those
                                            features
                                            include:
                                        </p>
                                        <ul
                                            style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                            <li>Add to Shortlist. A session based favorites list.</li>
                                            <li>Service Tags. Select from a wide range of services offered by Advertisers.
                                            </li>
                                            <li>Playmates. Escorts can list their Playmates for you to check out.</li>
                                            <li>Media Verification. At last a system that delivers a genuine listing of
                                                verified Media for
                                                Advertisers.</li>
                                            <li>My Legbox. When logged in, add your favorite Advertiser to your Legbox list
                                                as a
                                                permanent record. Enjoy many services with this feature.</li>
                                            <li>Tour notifications. Get a notification from your Legbox Escorts when they
                                                are coming
                                                to your city.</li>
                                            <li>My Notebox. Keep a diary of your favorite Advertisers.</li>
                                        </ul>
                                        <p>And a Profile system that delivers relevant information for you. Out Website has
                                            two Profile
                                            types, one for the Escorts and one for Massage Centres (a world first). Some
                                            great features
                                            in the Profiles include:</p>
                                        <ul>
                                            <li>Escort Profile:
                                                <ul
                                                    style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                    <li>Availability dates. When the Escort arrives and departs from your
                                                        city.</li>
                                                    <li>Tour departure. When visiting your city, how many days left before
                                                        they depart.</li>
                                                    <li>Playmates. Details of other Escorts who will join you.</li>
                                                    <li>A sophisticated Media display for photos and video.</li>
                                                    <li>My Playbox. A pay-per-play or subscription service for content.</li>
                                                    <li>Messaging. Encrypted messaging service.</li>
                                                    <li>Total service rate. If there are any extra costs for extra services,
                                                        they are
                                                        displayed.</li>
                                                    <li>A user friendly display of all of the Escort’s details.</li>
                                                </ul>
                                            </li>
                                            <li>Massage Centre:
                                                <ul
                                                    style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                    <li>Detailed information about the business, opening times, the address,
                                                        access,
                                                        services available, and Google maps to help you get there.</li>
                                                    <li>Separate and individual Masseur Profiles for each of the Masseurs
                                                        working at the
                                                        Centre.
                                                    </li>
                                                    <li>Detailed information about each Masseur, including when they are
                                                        available,
                                                        photos, age, charges and services offered.</li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <form action="">

                                            <input type="checkbox" name="registration" id="registration">
                                            <label for="registration">Do you want to complete your Registration now?
                                                (Recommended, only takes a couple
                                                of minutes)</label>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer pt-0" style="justify-content: center;">
                    <button type="submit" class="btn-success-modal" data-dismiss="modal">Got it</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        $(function() {
            $('#register_form').parsley({

            });
            var viewerRegistrationForm = $("#register_form");

            viewerRegistrationForm.submit(function(e) {

                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData($("#register_form")[0]);
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
                        Swal.close();
                        var ph = data.phone;
                        $("#phoneId").attr('value', ph);
                        if (data.error == 1) {

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
                                swal_waiting_popup({
                                    'title': 'Validating your OTP.'
                                });
                                e.preventDefault();
                                var form = $(this);

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
                                        Swal.close();
                                        if (data.error == true) {
                                            window.location.href ="{{ route('user.dashboard') }}";
                                            // window.location.href =
                                            //     "{{ route('find.all') }}";

                                        }

                                    },
                                    error: function(data) {
                                        Swal.close();
                                        console.log("error: v", data
                                            .responseJSON.errors);
                                        var errorsHtml = '';
                                        $.each(data.responseJSON.errors,
                                            function(key, value) {
                                                errorsHtml =
                                                    '<div class="alert alert-danger"><ul>';
                                                errorsHtml += '<li>' +
                                                    value +
                                                    '</li>'; //showing only the first error.
                                            });

                                        errorsHtml += '</ul></div>';
                                        $('#senderror').html(errorsHtml);
                                    }
                                });

                            });
                        }
                    },
                    error: function(data) {
                        Swal.close();
                        console.log("error: b", data.responseJSON.errors);
                        Swal.close();
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

                        });
                    }
                });
                console.log("Viewer Registration with us");
            });
        });
        $("body").on("click", "#submit_button", function() {
            $('#phone-errors').html('');
            $('#email-errors').html('');
            console.log("working");
        });
    </script>
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
@endsection
