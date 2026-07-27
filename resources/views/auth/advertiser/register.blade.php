@extends('layouts.web')
<style>
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th {
        padding: 0.55rem;
    }

    .table tbody td {
        color: #192A3E;
        font-family: 'Poppins';
        font-weight: normal;
        font-size: 16px;
    }

    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border: 1px solid #dee2e6;
        text-align: justify;
    }


    .table th {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6 !important;
    }

    .table td:first-child {
        font-weight: bold;
    }

    p {
        text-align: justify !important;
    }

    #RegisterEscort li {
        padding-left: 20px;
    }

    #RegisterMassage li {
        padding-left: 20px;
    }
</style>
@section('content')
    <section
        class="section_bg_color padding_ninty_top_ninty_px padding_bottom_eight_px angle_bg_image advertiser-registration">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 adverti_reg_page_padingto_bt-new">
                    <div class="common-reg-info">
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
                                <h1> Advertiser Registration</h1>
                            </div>
                            <h2>Registration with us is free</h2>
                            <p>There are no Fees when you create an Account. Fees only apply when you
                                post a Profile or Tour
                                where you are charged according to the number of days and the Membership Type you select.
                                See also <span><a href="{{ url('help-for-escorts') }}"
                                        class="termsandconditions_text_color">Help for Escorts</a></span>
                                and <span><a href="{{ url('help-for-massage-centres') }}"
                                        class="termsandconditions_text_color">Help for Massage Centres</a></span>
                                for more information on Package benefits, Profiles & Tours, Fees and your obligations.
                            </p>
                        </div>
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
                                <h3>Important Information</h3>
                            </div>
                            <div class="a-info">
                                <span>1</span>
                                <p>
                                    Victorian Advertisers can voluntarily provide their SWA exception number or license
                                    number,
                                    like for
                                    example, SWA20188XE. The license number will be displayed on any Profile you List.
                                </p>
                            </div>
                            <div class="a-info">
                                <span>2</span>
                                <p>
                                    Massage Centres in Queensland must have their business telephone number registered with
                                    the Prostitution Licensing Authority (Queensland) and display the number on any Profile
                                    it Lists.
                                </p>
                            </div>
                            <div class="a-info">
                                <span>3</span>
                                <p>
                                    Click <a href="https://www.esafety.gov.au/parents/resources/online-safety-book"
                                        target="_blank" class="termsandconditions_text_color">here to read</a> the eSafety
                                    Commissioner's Online Safety Guide before registering as a Member.
                                </p>
                            </div>
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
                                <p class="mb-0 small">Fill in your details and start saving.</p>
                            </div>
                        </div>
                        <hr>
                        <form id="escort_registration" action="{{ route('advertiser.register') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="name">Name / Business Name</label>
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
                                        <input type="txt" class="form-control" id="name"
                                            aria-describedby="emailHelp" name="name" required placeholder="Name"
                                            data-parsley-errors-container="#name-errors"
                                            data-parsley-required-message="Your name is required"
                                            value="{{ old('name') }}">
                                        <div class="termsandconditions_text_color">
                                            @error('name')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="name-errors"></div>
                                </div>
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
                                        <input type="tel" maxlength="10" class="form-control" id="mobileno"
                                            aria-describedby="emailHelp" name="phone" data-parsley-maxlength="10"
                                            required placeholder="Mobile Number"
                                            data-parsley-required-message="Your mobile number is required"
                                            value="{{ old('phone') }}" data-parsley-type="digits"
                                            data-parsley-errors-container="#phone-errors"
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
                                            aria-describedby="emailHelp" name="email" value="{{ old('email') }}"
                                            required autocomplete="email" placeholder="Email Address"
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
                                            data-parsley-errors-container="#location-errors">
                                            <option value="">Select your Home State (if not already identified)
                                            </option>
                                            @foreach (config('escorts.profile.states') as $key => $state)
                                                <option style="font-weight: 500;" value="{{ $key }}"
                                                    {{ isset(request()->ipinfo->country_name) && request()->ipinfo->country_name != null && request()->ipinfo->region == $state['stateName'] ? request()->ipinfo->region : '' }}>
                                                    {{ $state['stateName'] }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="location-errors"></div>
                                </div>

                                <div class="form-group position-relative custom--password col-lg-6 col-sm-12">
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
                                            placeholder="Be mindful of what you have used in other websites"
                                            name="password" required autocomplete="new-password"
                                            data-parsley-errors-container="#password-error"
                                            data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                                            data-parsley-required-message="@lang('errors/validation/required.password')"
                                            data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                                        <span class="input-group-text custom--eye" id="togglePassword"
                                            style="cursor: pointer;">
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

                                <div class="form-group position-relative custom--password col-lg-6 col-sm-12">
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
                                            data-parsley-equalto-message="Confirm password should be the same password"
                                            required autocomplete="new-password"
                                            data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                                        <span class="input-group-text custom--eye" id="toggleConfirmPassword"
                                            style="cursor: pointer;">
                                            <i class="fa fa-eye" id="confirmEyeIcon"></i>
                                        </span>
                                    </div>

                                    <!-- Parsley yahan error generate kare -->
                                    <div id="cpassword-error"></div>
                                    <div class="termsandconditions_text_color">
                                        <!-- error sms here -->
                                    </div>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="conformPassword">Referred by Agent (Agent ID)</label>
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
                                        <input type="txt" class="form-control" id="agent_id" name="agent_id"
                                            placeholder="Enter Agent ID" data-parsley-errors-container="#agent_id-errors">

                                        <div class="termsandconditions_text_color">
                                            @error('agent_id')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="agent_id-errors"></div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="ec-box">
                                        <span>
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

                                        <div class="form-check-inline ">

                                            <input class="form-check-input" required type="radio" name="type"
                                                id="inlineRadio1" data-parsley-errors-container="#type-error"
                                                value="3"{{ old('type') == 3 ? ' checked' : null }}>
                                            <label class="form-check-label" for="inlineRadio1">I am an Escort</label>
                                        </div>
                                    </div>
                                    <div id="type-error"></div>

                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="mc-box">
                                        <span>
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" id="Layer_1"
                                                data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <defs>
                                                        <style>
                                                            .cls-1 {
                                                                fill: none;
                                                                stroke: #495057;
                                                                stroke-miterlimit: 10;
                                                                stroke-width: 1.91px;
                                                            }
                                                        </style>
                                                    </defs>
                                                    <path class="cls-1"
                                                        d="M16.41,12.13a3.32,3.32,0,0,0-.9-.13H4.67A3.17,3.17,0,0,0,1.5,15.17v.34a3.17,3.17,0,0,0,3.17,3.17h6.38">
                                                    </path>
                                                    <rect class="cls-1" x="3.41" y="6.27" width="13.36" height="5.73"
                                                        rx="2.86"></rect>
                                                    <rect class="cls-1" x="5.32" y="1.5" width="9.55" height="4.77"
                                                        rx="2.39"></rect>
                                                    <path class="cls-1"
                                                        d="M20.59,16.77H22.5a0,0,0,0,1,0,0v1.91a3.82,3.82,0,0,1-3.82,3.82H16.77a0,0,0,0,1,0,0V20.59A3.82,3.82,0,0,1,20.59,16.77Z">
                                                    </path>
                                                    <path class="cls-1"
                                                        d="M19,17.13a3.81,3.81,0,0,0-.89-4l-1.35-1.35-.36.36-1,1a3.79,3.79,0,0,0-.89,4">
                                                    </path>
                                                    <path class="cls-1"
                                                        d="M14.86,16.77h1.91a0,0,0,0,1,0,0v1.91A3.82,3.82,0,0,1,13,22.5H11a0,0,0,0,1,0,0V20.59A3.82,3.82,0,0,1,14.86,16.77Z"
                                                        transform="translate(-5.73 33.55) rotate(-90)"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <div class="form-check-inline mc_box">
                                            <input class="form-check-input" type="radio" name="type"
                                                id="inlineRadio2"
                                                value="4"{{ old('type') == 4 ? ' checked' : null }}>
                                            <label class="form-check-label" for="inlineRadio2">We are a Massage
                                                Centre</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="termsandconditions_text_color">
                                    <!-- error sms here -->
                                    @error('type')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-sm-12 tnc-info">
                                    <div class="form-check-inline">
                                        <input type="checkbox" data-parsley-errors-container=".check-tc"
                                            class="form-check-input" id="termsandconditions" required
                                            data-parsley-required-message="@lang('errors/validation/required.checkbox')">
                                        <label class="form-check-label " for="termsandconditions">I have read and agree to
                                            the
                                            <a href="terms-conditions" class="termsandconditions_text_color"
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
                                    <button type="submit" id="submit_button" class="btn site_btn_primary w-100">
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
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul
                                            class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0 register_ul">
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                lowercase character
                                            </li>
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                number
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul
                                            class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0 register_ul">
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                uppercase character
                                            </li>
                                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1
                                                special character
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx register_ul">
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
                                along the way. You will always know what the Fees are before you commit to Listing your
                                Profile. You can also create a Profile and archive it until you are ready to List it.
                                Create as many Profiles as you like. We recommend you create at least one Profile for each
                                Location ready for when you Tour.</p>

                            <p class="custome_span_color">Go to <a href="{{ url('help-for-escorts') }}"
                                    class="termsandconditions_text_color">help for Escorts</a> for details on
                                Membership Packages associated with each Membership Type.</p>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Type</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>Platinum<br>Gold<br>Silver</td>
                                            <td>
                                                <p>Platinum Membership always ranks at the top of the Escort Listing Page,
                                                    followed by Gold, Silver and then Free.</p>
                                                <p><b>List View:</b> Your Thumbnail photo is 142px x 200px. Location, age,
                                                    hourly rates, review
                                                    rating, available to, Services hourly rate summary, video availability,
                                                    arrival and departure dates, and your 'Who I am' are included in the
                                                    display.
                                                    Add to Shortlist, add to Legbox, membership Type, and your Media
                                                    Verification status are also included.</p>
                                                <p><b>Grid View:</b> Your Thumbnail photo is 200px x 281px. Location, age,
                                                    hourly rate,
                                                    services, gender, available to, and review rating are included in the
                                                    display.
                                                    Add to Shortlist, add to Legbox and your Media Verification status are
                                                    also included.</p>
                                                <p><b>Profile Page:</b> A comprehensive and informative summary about you.
                                                    Your Thumbnail is
                                                    420px x 600px together with 6 additional photos and a video player. All
                                                    photos and the video
                                                    can pop up.</p>
                                            </td>
                                        </tr>

                                        <td>Free</td>
                                        <td>
                                            <p>Free Membership ranks behind Silver</p>
                                            <p>Escort Listing Page: You will appear after paid listings in all Search Page
                                                results and Profile shortlist displays.</p>
                                            <p><b>Grid View:</b> Your Thumbnail photo, Stage Name, Verification status,
                                                Location,
                                                age, hourly rate, services, gender, orientation and view rating are included
                                                in the display.</p>
                                            <p><b>List View:</b> Your Thumbnail photo, Stage Name, Verification status,
                                                rates,
                                                review rating, available to, My Playbox status, start and finish dates and
                                                your 'Who I am' are displayed.</p>
                                            <p><b>Profile Page:</b> A comprehensive and informative summary about you.
                                                Displayed is your
                                                Thumbnail and default galery images, video, availability, Rates, My
                                                Playmates, About Me,
                                                Statistics, Who Am I, My Service, Deposit details, together with policies,
                                                legal statements, Reviews and tips.</p>
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
                            </div>

                            <p>If you upgrade your Membership Type you will not lose any remaining days you have paid
                                for. They will be applied automatically if you do not continue at the higher Membership
                                Type.</p>

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
                                accommodation and travel. For more information go to <span class=""><a
                                        href="{{ url('help-for-escorts') }}" class="termsandconditions_text_color">Help
                                        for Escorts</a></span>
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
                            <p>Escorts4U has partnered with a leading supplier of adult products which you can order online.
                                They
                                will be delivered to your door or by post deparding on your Location. For more information
                                about ordering products
                                go to <span class=""><a href="{{ url('terms-conditions') }}"
                                        class="termsandconditions_text_color">Part G Concierge Services
                                        Products</a></span>.</p>
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
                                        href="{{ url('help-for-escorts') }}" class="termsandconditions_text_color">Help
                                        for Escorts</a></span>
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
                            <p>We have many sources you can access for help and information. See <span class=""><a
                                        href="{{ url('help-for-escorts') }}" class="termsandconditions_text_color">help
                                        for Escorts</a></span>
                                and <span class=""><a href="{{ url('faqs') }}"
                                        class="termsandconditions_text_color">FAQs</a></span>,
                                or if you still can not find the answer, <span class=""><a
                                        href="{{ url('contact-us') }}" class="termsandconditions_text_color">contact
                                        us</a></span> directly, or your Agent if you appoint one.</p>
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
                                <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Reset
                                        Password</strong></h4>
                                <h5 class="text-center custom_modal_text">We will send you a reset password link to your
                                    email.</h5>
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
                            <button type="submit" class="btn main_bg_color site_btn_primary" id="sendSubmit">Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


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
                                            <li>You can update your personal information any time by either going to My
                                                Account and
                                                making your changes, or by updating your information, where it applies, in
                                                the Profile
                                                Creator. When you update your personal information in the Profile Creator,
                                                you will
                                                have the option to update your Account Information or not.</li>
                                            <li>Where you alter your information in the Profile Creator and you opt not to
                                                update your
                                                Account, the information you inserted into the Profile Creator, and which is
                                                different to
                                                your Account, will be saved to that Profile only.</li>
                                            <li>Your Notifications and Features can also be changed in My Account. Please
                                                take a look
                                                as these affect the way your Console operates and how you access a number of
                                                services.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table>

                                <tr>
                                    <td style="padding: 30px; text-align: justify;">
                                        <h4>Hello Dolly,</h4>
                                        <p>
                                            Thank you for selecting E4U to advertise your companionship. The team at E4U is
                                            here to
                                            help you. Here is some important information you need to know:
                                        </p>
                                        <ol style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                            <li>Before you can advertise on our website you need to complete some more of
                                                your
                                                details, as a once off, which will help you create and manage your Profiles
                                                and
                                                Tours. <br>These include :
                                                <ul
                                                    style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                    <li>Completing your personal information, such as About Me and Profile
                                                        and Tour
                                                        Options.</li>
                                                    <li>Setting your Notifications & Features.</li>
                                                    <li>Uploading and verifying your Media, such as photos and video, and
                                                        selecting
                                                        which uploads will act as your default Media, Banner image and Pin
                                                        Up.</li>
                                                    <li>Uploading your My Playbox content, if you intend to use that
                                                        service.</li>
                                                </ul>
                                                If you forget to complete any of the above, you can edit your account
                                                anytime, or in
                                                some instances, you will be asked if you want to update your Account when
                                                you make
                                                a change (Profile Creator).
                                            </li>


                                            <li>Our support staff are available to help you between 8:00am and 6:00pm WST
                                                Monday
                                                to Friday. You can email us, text us, call us, or log a Support Ticket (our
                                                preference).</li>
                                            <li>Support Agents are available to assist you with any queries you may have
                                                about the
                                                website and services. You can request to have a Support Agent assigned to
                                                you any
                                                time by following the link.</li>
                                            <li>Please remember your Member ID: [insert number created from registration],
                                                which you
                                                will need when communicating with us or your Support Agent, and especially
                                                when you
                                                are using the Playmates feature. We use your Member ID for all
                                                communications
                                                across the website (hashtags are not used in this website).</li>
                                            <li>From time to time we will come back to you and remind you of any important
                                                information
                                                you have not completed.</li>
                                        </ol>

                                        <h4 style="margin-top: 25px;">Heads Up!</h4>
                                        <p>
                                            We have designed a unique Profile creator that enables you to complete many
                                            functions to
                                            make your experience a pleasant and enjoyable one. Some of those features
                                            include:
                                        </p>
                                        <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                            <li>Pre-loaded data when creating a Profile</li>
                                            <li>BRB</li>
                                            <li>Suspend Listed Profile</li>
                                            <li>Extend Listing</li>
                                            <li>Bump Up your Listing</li>
                                            <li>Upgrade your Profile Membership Type</li>
                                            <li>Pin Up</li>
                                        </ul>
                                        <p>You can create as many Profiles as you want. We recommend you create at least one
                                            Profile for each State in Australia you would visit. You can do that by
                                            duplicating
                                            Profiles.
                                            Create the first one, and then duplicate it for as many times as you want. By
                                            creating
                                            at least
                                            one Profile for each State, or Location as we call them, you can then create a
                                            Tour
                                            across
                                            Australia for a minimum of two Locations, but with as many Profiles in each
                                            Location as
                                            you
                                            want.</p>

                                        <form action="">

                                            <input type="checkbox" name="registration" id="registration">
                                            <label for="registration">Do you want to complete your Registration now?
                                                (Recommended,
                                                only takes a few minutes)</label>
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
    {{-- <button type="button" data-target="#RegisterMassage" data-toggle="modal">Click Me</button> --}}
    {{-- agar tum niche wale modal ko dekhana chate ho to upar wale button ko uncomment karo --}}
    {{-- for Massage --}}
    <div class="modal fade upload-modal" id="RegisterMassage" tabindex="-1" role="dialog"
        aria-labelledby="RegisterMassageLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- Header -->


                <div class="modal-header">

                    <h5 class="modal-title text-white"><img src="{{ asset('assets/app/img/welcome.png') }}"
                            class="custompopicon">
                        Welcome to Escorts4U!! <span>Member ID: M20346</span></h5>
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
                                            <li>You can update your business information any time by either going to My
                                                Account and
                                                making your changes, or by updating your information, where it applies, in
                                                the Profile
                                                Creator. When you update your business information in the Profile Creator,
                                                you will
                                                have the option to update your Account Information or not.</li>
                                            <li>Where you alter business information in the Profile Creator and you opt not
                                                to update
                                                your Account, the information you inserted into the Profile Creator, and
                                                which is different
                                                to your Account, will be saved to that Profile only.</li>
                                            <li>Before you can add a new Masseur to your Profile, you must first add them to
                                                your
                                                Masseur list together with the personal information and photos.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table>

                                <tr>
                                    <td style="padding: 30px; text-align: justify;">
                                        <h4>Hello Healing Hands,</h4>
                                        <p>
                                            Thank you for selecting E4U to advertise your companionship. The team at E4U is
                                            here to
                                            help you. Here is some important information you need to know:
                                        </p>
                                        <ol style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                            <li>Before you can advertise on our website you need to complete some more of
                                                your
                                                details, as a once off, which will help you create and manage your Profile
                                                and Masseur
                                                Profiles. <br>These include :
                                                <ul
                                                    style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                    <li>Completing your business information, such as About Us.</li>
                                                    <li>Setting your Notifications & Features..</li>
                                                    <li>Uploading and verifying your Media, such as photos and video, and
                                                        selecting
                                                        which uploads will act as your default Media.</li>
                                                    <li>Uploading the Masseur's media.</li>
                                                </ul>
                                                If you forget to complete any of the above, you can edit your account
                                                anytime, or in
                                                some instances, you will be asked if you want to update your Account when
                                                you make
                                                a change (Profile Creator).
                                            </li>


                                            <li>Our support staff are available to help you between 8:00am and 6:00pm WST
                                                Monday
                                                to Friday. You can email us, text us, call us, or log a Support Ticket (our
                                                preference).</li>
                                            <li>Support Agents are available to assist you with any queries you may have
                                                about the
                                                website and services. You can request to have a Support Agent assigned to
                                                you any
                                                time by following the link.</li>
                                            <li>Your Member ID is: [insert number created from registration], which you will
                                                need when
                                                communicating with us or your Support Agent (if you have appointed one). We
                                                use your
                                                Member ID for all communications across the website (hashtags are not used
                                                in this
                                                website).</li>
                                            <li>From time to time we will come back to you and remind you of any important
                                                information you have not completed.</li>
                                        </ol>

                                        <form action="">

                                            <input type="checkbox" name="registration" id="registration">
                                            <label for="registration">Do you want to complete your Registration now?
                                                (Recommended, only takes a few
                                                minutes)</label>
                                        </form>

                                        <h4 style="margin-top: 25px;">Heads Up!</h4>
                                        <p>
                                            We have designed a unique Profile creator that enables you to complete many
                                            functions to
                                            make your experience a pleasant and enjoyable one. Some of those features
                                            include:
                                        </p>
                                        <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                            <li>Pre-loaded data when creating a Profile</li>
                                            <li>BRB</li>
                                            <li>Suspend Listed Profile</li>
                                            <li>Extend Listing</li>
                                            <li>Bump Up your Listing</li>
                                            <li>Pin Up</li>
                                        </ul>
                                        <p>You can create as many Profiles as you want, especially if you have more than one
                                            Massage
                                            Centre. You can do that by duplicating Profiles. Create the first one, and then
                                            duplicate it
                                            for as many times as you want.</p>


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
            $('#escort_registration').parsley();

            var RegistrationForm = $("#escort_registration");

            RegistrationForm.submit(function(e) {

                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData($("#escort_registration")[0]);
                var token = $('input[name="_token"]').attr('value');
                swal_waiting_popup({
                    'title': 'Your registration is currently being processed.'
                });
                $('#agent_id-errors').html('');
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
                        console.log(data);
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
                                        Swal.close();
                                        console.log(data);

                                        if (data.error == true) {
                                            //console.log(data);
                                            if (data.type == 3) {
                                                window.location.href =
                                                    "{{ route('escort.dashboard') }}";
                                            }
                                            if (data.type == 4) {
                                                window.location.href =
                                                    "{{ route('center.dashboard') }}";
                                            }

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
                                                errorsHtml += '<li>' +
                                                    value +
                                                    '</li>'; //showing only the first error.
                                            });

                                        errorsHtml += '</ul></li>';
                                        $('#senderror').html(errorsHtml);
                                    }
                                });

                            });
                        }
                    },
                    error: function(data) {
                        Swal.close();
                        console.log("error: b", data.responseJSON.errors);

                        var errorsHtml = '';
                        $.each(data.responseJSON.errors, function(key, value) {

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
                            if (key === "agent_id") {
                                $('#agent_id-errors').html(
                                    '<div class="alert alert-danger">' + data
                                    .responseJSON.errors.agent_id + '</div>');
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
