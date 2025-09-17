@extends('layouts.web')
<style>    
    p{
        text-align: justify !important;
    }
    .reg_info ul li, p {
        text-align: center !important;
    }

</style>
@section('content')
<section class="section_bg_color padding_ninty_top_ninty_px padding_ninty_btm_ninty_px angle_bg_image">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 adverti_reg_page_padingto_bt">
                <div class="reg_info agent-registration">
                    {{-- <h2>Registration - Agent</h2> --}}
                    <div class=" pt-2 pb-5">
                        <h1 class="text-uppercase">Agent Registration</h1>
                        <h2>Lodge your enquiry with us here</h2>
                        <p class="taxt-justify">If you have industry experience or you are well connected to Advertisers, then
                            becoming an Escorts4U Agent may be for you.  Earn additional income as an</br> Agent. We will assist you in every regard to earn.                            
                            Register and we will be in touch to go over what being an Agent can do for you.                        
                            See also <span ><a href="{{ url('help-for-agents')}}" class="termsandconditions_text_color" style="font-size: 16px;">Help for Agent</a></span> and <a href="https://www.agencymanagement.com.au" style="font-size: 16px;" target="_blank" class="termsandconditions_text_color">Agency Management</a> for more information about benefits and your obligations.
                        </p>
                    </div>
                </div>
            </div>
            <div class="reg_box_form_style col-lg-5 col-md-5">
                <div class="regstractionform">
                    <h4>Register Now - Earn Additional Income!</h4>
                    <form id="escort_registration" action="{{ route('agent.register')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Business Name</label>
                            <input  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" data-parsley-required-message="Your Name is required" data-parsley-pattern="/^([a-z ])+([ a-z ])+([ 0-9a-z ]+)$/i">
                            <div class="termsandconditions_text_color">
                                @error('name')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobileno">Mobile Number</label>
                            <input type="txt" data-parsley-maxlength="10" required class="form-control" name="phone" id="mobileno" aria-describedby="emailHelp" placeholder="Mobile Number" data-parsley-required-message="Your mobile number is required" value="{{ old('phone') }}" data-parsley-type="digits" data-parsley-type-message="Enter only mobile numbers">
                            <span id="phone-errors"></span>
                            <div class="termsandconditions_text_color" >
                                @error('phone')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Email') }}</label>
                            <input  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" data-parsley-required-message="@lang('errors/validation/required.email')" data-parsley-type-message="@lang('errors/validation/valid.email')" >
                            <span id="email-errors"></span>
                            <div class="termsandconditions_text_color">
                                @error('email')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="exampleFormControlSelect1">Location<sup>(*)</sup></label>
                           <select class="form-control" id="location_state" name="state_id" required data-parsley-required-message="Select Location">
                           <option value="">Select your Home State (if not already identified)</option>
                            @foreach($state as $name)
                                <option value="{{$name->id}}" {{ isset(request()->ipinfo->country_name) && request()->ipinfo->country_name != null && request()->ipinfo->region == $name->name ? request()->ipinfo->region : '' }}>{{$name->name}}</option>
                            @endforeach
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">{{ __('Password') }}</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Be mindful of what you have used in other websites" name="password" required autocomplete="new-password" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                                @error('password')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label for="conformPassword">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" id="conformPassword" placeholder="Confirm your password" name="password_confirmation" data-parsley-equalto="#exampleInputPassword1" data-parsley-equalto-message="Confirm password should be the same password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                            </div>
                        </div>

                        {{--<div class="form-check form-check-inline">
                            <input class="form-check-input" required type="radio" name="type" id="inlineRadio1" value="3"{{ old('type') == 3 ? ' checked' : null }}>
                            <label class="form-check-label" for="inlineRadio1">I am an Escort</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="4"{{ old('type') == 4 ? ' checked' : null }}>
                            <label class="form-check-label" for="inlineRadio2">I am a Massage Center</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="5"{{ old('type') == 5 ? ' checked' : null }}>
                            <label class="form-check-label" for="inlineRadio2">I am a Agent</label>
                            </div>--}}
                        <input type="hidden" name="type"  value="5">
                        <div class="termsandconditions_text_color">
                            <!-- error sms here -->
                            @error('type')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-check pt-2 pb-1 form-check-inline" style="margin-left: 5px;">
                            <input type="checkbox" data-parsley-errors-container=".check-tc" class="form-check-input" id="termsandconditions" required data-parsley-required-message="@lang('errors/validation/required.checkbox')">
                            <label class="form-check-label" for="termsandconditions">I have read and agree to the <a href="terms-conditions" class="termsandconditions_text_color" style="font-size: 13px;">Terms and Conditions</a></label>
                        </div>
                        <span class="check-tc"></span>
                        <div class="termsandconditions_text_color">
                            <!-- error sms here -->
                        </div>
                        <div class="form-row pt-3">
                            <div class="col">
                               <button type="submit" id="submit_button" class="btn site_btn_primary">Register</button>
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
<section class="padding_two_fifty_two_top padding_bottom_eight_px">
   <div class="container">
   <h1 class="home_heading_first margin_btm_twenty_px page-title">Help for Agents</h1>
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
                           <li><span class="correct_symbole_font_weight">✓</span> At least 1 lowercase character</li>
                           <li><span class="correct_symbole_font_weight">✓</span> At least 1 number</li>
                       </ul>
                     </div>
                     <div class="col-lg-3 col-md-4 col-12">
                       <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0">
                           <li><span class="correct_symbole_font_weight">✓</span> At least 1 uppercase character</li>
                           <li><span class="correct_symbole_font_weight">✓</span> At least 1 special character</li>

                       </ul>
                     </div>
                     <div class="col-lg-3 col-md-4 col-12">
                       <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx">
                           <li><span class="correct_symbole_font_weight">✓</span> 8 characters minimum</li>
                           <li><span class="correct_symbole_font_weight">✓</span> 50 characters maximum</li>
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
                    <li>Step 1. When you land on the Website hover over “Register” located at the top right hand corner and click “Lodge Enquiry”. </li>
                    <li>Step 2. Complete the information fields.</li>
                    <li>Step 3. Click the “Register” button.</li>
                </ul>     
                <p>Someone from our support team will be in touch with you within 24 hours.</p>
                <p><b>Q: Will I get a confirmation of my application to become an Agent?</b></p>
                <ul class="list-unstyled pl-3">
                   <li>Yes you will. Escorts4U will forward to you by email a confirmation that we have received your application. The confirmation will contain a reference number for you to quote if any follow up is required.</li>
                </ul>
                <p><b>Q: How do I get in touch with Escorts4U if I have any queries?</b></p>
                <ul class="list-unstyled pl-3">
                   <li>You can forward an email to our <a href="#" class="termsandconditions_text_color">support team</a> anytime. Please allow us some time to get back to you. We will get back to you within 24 hours, usually sooner.</li>
                </ul>
                <p><b>Q: Do I have to be a registered business to be an Agent?</b></p>
                <ul class="list-unstyled pl-3">
                   <li class="mb-2">Yes. It is up to you as to which form of entity you wish to be, sole trader or an incorporated company. You will need to have an ABN as well.</li>
                   <li>Escorts4U can assist you with putting into place the entity you wish to use. That assistance is only with the putting into place the entity type, we do not provide advice on which type of entity is best suited to you. You need to get your own advice from an accountant in that regard.</li>
                </ul>
                <p><b>Q: Can Escorts4U put me in touch with an accountant?</b></p>
                <ul class="list-unstyled pl-3">
                   <li class="mb-2">Yes we can. We have a list of accounting practices in each State who have an understanding of the Escorts4U business model. Simply <a href="#" class="termsandconditions_text_color">request</a> the details and then choose an accountant that is nearest to you. When you contact the accounting practice, mention you are wanting to make an appointment to discuss becoming an Agent for Escorts4U.</li>
                   <li>Escorts4U has no financial arrangements with any of the accounting practices. We do not pay any commissions to the accounting practices.</li>
                </ul>
                <p><b>Q: Will I have exclusivity to the area I am appointed in?</b></p>
                <ul class="list-unstyled pl-3">
                   <li>No. Your appointment is a non-exclusive appointment within a Location. It is not our practice to appoint more than 3 Agents to each Location. It is our view that 3 Agents is adequate to service all of the Advertisers needs in any Location.</li>
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


 <!-- <div class="modal" id="sendOtp_modal" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <form id="SendOtp" method="post" action="" >
                @csrf
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white"> <img src="{{ asset('assets/app/img/face-lock.png')}}" class="custompopicon"> Send One Time Password</h5>
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

<div class="modal" id="comman_modal" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <form id="forgotPasswordSend" method="post" action="" >
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
                                <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png') }}" class="img-fluid" alt="logo"></a>
                            </div>
                        </div>
                        <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Account Protection</strong></h4>
                        <p class="text-center pb-2">To help keep your account safe, E4U wants to make sure it’s really you trying to register.</p>
                        <input type="txt" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" data-parsley-required-message="Your Email is required"  value="{{ old('email') }}">
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
                    <button type="submit" class="btn main_bg_color site_btn_primary" id="sendSubmit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>


</section>
@endsection
@section('script')
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
      swal_waiting_popup({'title' : 'Your registration is currently being processed.'});
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
                  $("#phoneId").attr('value',ph);

                  if(data.error == 1) 
                  {
                        setTimeout(() => {
                            $("#sendOtp_modal").modal({backdrop: 'static', keyboard: false});
                        }, 300); 

                        $('body').on("click","#resendOtpSubmit",function(){
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
                            $('#senderror').html("<p> Verification code sent to "+data.phone+"</p>");
                            console.log(data);
                            })
                        });

                    
                        $("body").on("submit","#SendOtp",function(e)
                        {
                            e.preventDefault();
                            var form = $(this);

                            console.log(ph);
                            // var url = form.attr('action');
                            var url = "{{ route('web.checkOTP')}}";

                            var data = new FormData($('#SendOtp')[0]);
                            var phone = data.phone;
                            //data.append("phone",phone );
                            console.log("url="+url);
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

                                if(data.error == true) {
                                //console.log(data);
                                window.location.href = "{{ route('agent.dashboard') }}";

                                }

                                },
                                error: function(data) {

                                console.log("error: a", data.responseJSON.errors);
                                var errorsHtml = '<ul><li>';
                                $.each(data.responseJSON.errors, function(key, value) {
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
               error: function(data) {
                Swal.close();
                console.log("error: b", data.responseJSON.errors);
                  var errorsHtml = '<ul><li>';
                   $.each(data.responseJSON.errors, function(key, value) {
                    console.log("key=", key);
                    if(key === "phone") {
                        $('#phone-errors').html('<div class="alert alert-danger">'+data.responseJSON.errors.phone+'</div>');
                    }
                    if(key === "email") {
                         $('#email-errors').html('<div class="alert alert-danger">'+data.responseJSON.errors.email+'</div>');
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

$("body").on("click","#submit_button",function(){
    $('#phone-errors').html('');
    $('#email-errors').html('');
    console.log("working");
});

</script>


@endsection
