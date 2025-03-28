@extends('layouts.web')
@section('content')
<section class="section_bg_color padding_ninty_top_ninty_px padding_bottom_eight_px angle_bg_image viewer-registration">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 adverti_reg_page_padingto_bt-new">
                <div class="reg_info viewer-registration">
                    <h2>Registration - Viewer</h2>
                    <div class="pl-4 pt-2 pb-5">
                        <h1 class="text-uppercase">viewer Registration</h1>
                        <h2>Registration with us is free</h2>
                        <p>You do not have to register to view a Profile or Tour however, if you register you will recieve the following benefits:</p>
                        <div class="">
                            <ul class="pl-4">
                                <li>Flag a Profile and produce a short list of your preferred Advertisers</li>
                                <li>View at any time your favourite Profiles (Legbox)</li>
                                <li>Receive Alerts when your favourite Escort is visiting your Location</li>
                                <li>Have a discreet conversation with an Advertiser (provided they have enabled that feature)</li>
                                <li>Write a review about your experience with an Advertiser</li>
                                <li>Complete a private Note (Notebox) about your experience with an Advertiser (from your Dashboard)</li>
                            </ul>
                        </div>
                        <p>See also <span class="text_decoration_for_a"><a href="{{ url('help-for-viewers') }}" class="termsandconditions_text_color">Help for Viewers</a></span> for more information on Membership benefits and your obligations.</p>
                    </div>
                </div>
            </div>
            <div class="reg_box_form_style col-lg-5 col-md-5">
                <div class="regstractionform">
                    <h4>Register Now - No Fees Ever!</h4>
                    <form id="register_form" action="{{ route('register') }}" method="POST" >
                        @csrf
                        @method('POST')
                        <input type="hidden" name="escort_id" value="{{ request()->get('legboxId')}}">
                        <div class="form-group">
                          <label for="mobileno">Mobile Number</label>
                          <input type="txt" data-parsley-maxlength="10" required class="form-control" name="phone" id="mobileno" aria-describedby="emailHelp" placeholder="Mobile Number" data-parsley-required-message="Your mobile number is required" value="{{ old('phone') }}" data-parsley-type="digits" data-parsley-type-message="Enter only mobile numbers">
                          <span id="phone-errors"></span>
                          <div class="termsandconditions_text_color">
                              @error('phone')
                              <strong>{{ $message }}</strong>
                              @enderror
                          </div>
                       </div>

                       {{-- <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Email Address" name="email">
                       </div> --}}
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
                            <option value="{{$name->id}}" {{ request()->ipinfo->country_name != null && request()->ipinfo->region == $name->name ? request()->ipinfo->region : '' }}>{{$name->name}}</option>
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
                        <div class="form-check pt-2 pb-1" style="margin-left: 3px;">
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
<section class="padding_one_thiry_top padding_ninty_btm_ninty_px" text-color="white">
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
                        <div class="mt-3">
                            <b>Changes to this Guide</b><br>
                            <span>This Guide was last updated on 02-2024.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="set">
                <a> Anonymity - it is up to you <i class="fa fa-angle-down"></i></a>
                <div class="content">
                    <div class="accodien_manage_padding_content">
                        <p>You determine how much information you want to disclose in your personal Account
                            information. The only mandatory information we require is your:</p>
                        <ul class="font_size_forteenpx" style="color:#686a6c;">
                           <li>Mobile number (for SMS 2FA verification), and notifications if you have your mobile
                               number selected for that purpose</li>
                           <li>Email address (for notifications - when enabled)</li>
                           <li>Your Location (city)</li>
                        </ul>
                        <span class="text_decoration_for_a custome_span_color">
                            To have access to the Viewer benefits, you will need to disclose some additional
                            information in your Account settings. That does not include your name. We never request
                            your name to be disclosed.
                        </span>

                        <div class="mt-3">
                            <b>Changes to this Guide</b><br>
                            <span>This Guide was last updated on 02-2024.</span>
                        </div>
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
                        <p>We have many sources you can access for help and information. See <span class="text_decoration_for_a"><a class="termsandconditions_text_color" href="{{ url('help-for-viewers')}}"> help for viewers</a></span> and <span class="text_decoration_for_a"><a class="termsandconditions_text_color"href="{{ url('faqs')}}">FAQs</a></span>, or if you still can not find the answer, <span class="text_decoration_for_a"><a class="termsandconditions_text_color" href="#">contact us</a></span> directly.</p>
                        <p>We also welcome <span class="text_decoration_for_a"><a class="termsandconditions_text_color" href="{{ url('feedback')}}">feedback</a></span> on how we can improve the delivery of our Services.</p>
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
                        <p></p>
                        <table class="table table-borderless table_border_remove">
                          <thead>
                            <tr>
                              <th scope="col" class="accordien_color_table">Features</th>
                              <th scope="col" class="accordien_color_table">Registered</th>
                              <th scope="col" class="accordien_color_table">Unregistered</th>
                              <th scope="col" class="accordien_color_table">Comments</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><span class="accordien_color_table">Viewing</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td><span class="accordien_color_table">View all the Advertisers on the Website</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Chatting</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Participate in direct chatting with Advertisers (provided they have enabled this feature)</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Dashboard -Personalised</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Select the widgets you want to appear on your dashboard</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Dashboard - Pinup</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Select your favorite Escort as your dashboard pinup</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Favorites</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td><span class="accordien_color_table">Flag your favorite Escorts while searching and then view your shortlist</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Legbox</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Select your favorite Escorts by adding them to your Legbox. View your Legbox anytime</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Message</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Send a message to an Escort (provided they have enabled this feature)</span></td>
                            </tr>
                             <tr>
                              <td><span class="accordien_color_table">Notes</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Make notes about your experience with an Escort</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Notifications</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Receive A-Alerts from Advertisers when they are visiting your location</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Rating</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Rate your experience with an Escort so you will remember for next time</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Recommendation</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td><span class="accordien_color_table">Share your experiences and publish a recommendation [thumb icon up] or [thumb icon down]</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Reviews</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">&#x2717;</span></td>
                              <td><span class="accordien_color_table">Write a review about your experience with an Escort</span></td>
                            </tr>
                            <tr>
                              <td><span class="accordien_color_table">Security</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td class="text-center"><span class="correct_symbole_font_weight accordien_color_table">✓</span></td>
                              <td><span class="accordien_color_table">Our Website is a secure environment so that we can maintain your anonymity</span></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="sendOtp_modal" style="display: none">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content custome_modal_max_width">
              <form id="SendOtp" method="post" action="" >
                  @csrf
                  <div class="modal-header main_bg_color border-0">
                      <h5 class="modal-title text-white">Send One Time Password</h5>
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
  </div>
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
                          <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Reset Password</strong></h4>
                          <p class="text-center pb-2">We’ll send you a reset password link on your email.</p>
                          <input type="txt" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" data-parsley-required-message="Your Email is required" value="{{ old('email') }}">
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
               $("#phoneId").attr('value',ph);
               if(data.error == 1) {

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
                  $("#sendOtp_modal").modal('show');//
                  $("body").on("submit","#SendOtp",function(e){
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
                        window.location.href = "{{ route('find.all') }}";

                        }

                     },
                     error: function(data) {

                        console.log("error: v", data.responseJSON.errors);
                        var errorsHtml = '';
                        $.each(data.responseJSON.errors, function(key, value) {
                              errorsHtml = '<div class="alert alert-danger"><ul>';
                              errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                        });

                        errorsHtml += '</ul></div>';
                        $('#senderror').html(errorsHtml);
                     }
                  });

                  });
               }
            },
            error: function(data) {

                console.log("error: b", data.responseJSON.errors);


                $.each(data.responseJSON.errors, function(key, value) {
                    console.log("key=", key);
                    if(key === "phone") {
                        $('#phone-errors').html('<div class="alert alert-danger">'+data.responseJSON.errors.phone+'</div>');
                    }
                    if(key === "email") {
                         $('#email-errors').html('<div class="alert alert-danger">'+data.responseJSON.errors.email+'</div>');
                    }

                });







            }
        });
    console.log("Viewer Registration with us");
  });
});
$("body").on("click","#submit_button",function(){
    $('#phone-errors').html('');
    $('#email-errors').html('');
    console.log("working");
});
</script>
@endsection
