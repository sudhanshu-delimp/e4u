@extends('layouts.web')
@section('content')
<section class="section_bg_color padding_ninty_top_ninty_px padding_ninty_btm_ninty_px angle_bg_image">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <div class="reg_info">
                    <h1 class="text-uppercase ">viewer Registration</h1>
                    <h2> Registration with us is free</h2>
                    <p>You do not have to register to view a Profile or Tour however, if you register you will recieve the following benefits:</p>
                    <div class="register_list_style">
                        <ul>
                            <li>Flag a Profile</li>
                            <li>View your favourite Profiles list (Legbox)</li>
                            <li>Receive Alerts when your favourite Escort is visiting your Location</li>
                            <li>Have a descreet conversation with an Escort (provided they have enabled this feature)</li>
                            <li> Write an Escort review</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="reg_box_form_style col-lg-5 col-md-5">
                <div class="regstractionform">
                    <h4>Register now - no Fees ever!</h4>
                    <form id="register_formxxxxaaa" action="{{ route('register') }}" method="POST" >
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
                            <input  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="We never display your email address" data-parsley-required-message="@lang('errors/validation/required.email')" data-parsley-type-message="@lang('errors/validation/valid.email')">
                            <div class="termsandconditions_text_color">
                                @error('email')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{ __('Password') }}</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Make sure you select something unique" name="password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                                @error('password')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="conformPassword">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" id="conformPassword" placeholder="Confirm Password" name="password_confirmation" data-parsley-equalto="#exampleInputPassword1" data-parsley-equalto-message="Password do not match" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" data-parsley-errors-container=".check-tc" class="form-check-input" id="termsandconditions" required data-parsley-required-message="@lang('errors/validation/required.checkbox')">
                            <label class="form-check-label" for="termsandconditions">I have read and agree to the <a href="#" class="termsandconditions_text_color">Terms and Conditions</a></label>
                        </div>
                        <span class="check-tc"></span>
                        <div class="termsandconditions_text_color">
                            <!-- error sms here -->
                        </div>
                        <button type="submit" id="submit_button" class="btn site_btn_primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="padding_ninty_top_ninty_px padding_ninty_btm_ninty_px" text-color="white">
    <div class="container">
        <div class="accordion-container">
            <div class="set">
                <a>
                Password Requirements
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content">
                    <div class="accodien_manage_padding_content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                    </div>
                </div>
            </div>
            <div class="set">
                <a> Anonumity - it is up to you <i class="fa fa-angle-down"></i></a>
                <div class="content">
                    <div class="accodien_manage_padding_content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                    </div>
                </div>
            </div>
            <div class="set">
                <a>
                Member Benefits
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content">
                    <div class="accodien_manage_padding_content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script>
    $(function() {
        $('#register_form').parsley({

        });
    });
</script>
@endsection
