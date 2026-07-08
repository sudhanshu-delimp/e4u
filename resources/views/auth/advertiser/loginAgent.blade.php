@extends('layouts.web')
@section('style')
<style>
   .otp-verify-btn{
          padding: 20px 20px 23px !important;
   }
   #email-error{
      color: red;
      font-size: 14px;
      padding: 10px;
   }
   .swal2-title {
      font-size: 18px !important;
   }
</style>
@endsection

@section('content')

<div class="container">
         <section class="common_login_page">
            <div class="row">
               <div class="col-md-6 order-md-0 order-sm-1 order-1">
                  <div class="welcone_login_page_heading">
                     <h1>WELCOME TO E4U</h1>
                  </div>
                  <h2 class="welcome_sub_login_heading">AGENT LOGIN</h2>
                  <form id="escort_login" action="{{ route('advertiser.login')}}" method="post">
                      @csrf
                        <input type="hidden" name="type" value="5">
                        <div class="form-group label_margin_zero_for_login">
                           <label for="exampleInputmobilenumber">Mobile Number</label>

                            <div class="input-group custom-fields">                                
                                <span class="input-group-text ">
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
                                 <input type="text" required class="form-control" name="phone" id="mobileno" aria-describedby="emailHelp" placeholder="Mobile Number"  data-parsley-errors-container="#phone-errors" data-parsley-required-message="Phone Number is required" value="{{ old('phone') }}">
                                 <div class="termsandconditions_text_color">
                                    
                                 </div>
                              </div>
                              <div id="phone-errors"></div>
                        </div>   
                        <div class="form-group label_margin_zero_for_login" style="position: relative;">
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
                                 <input type="password" class="form-control" placeholder="Please Enter Your Password" id="exampleInputPassword1" placeholder=""
                                    name="password" required autocomplete="new-password"
                                    data-parsley-required-message="@lang('errors/validation/required.password')"
                                    data-parsley-pattern-message="@lang('errors/validation/valid.password')" data-parsley-errors-container="#password-errors">

                                 {{-- Eye icon --}}
                                 <span toggle="#exampleInputPassword1" class="toggle-password" style="
                                    position: absolute;
                                    top:10px;
                                    right: 15px;
                                    cursor: pointer;">
                                    <i class="fa fa-eye" id="toggleEyeIcon"></i>
                                 </span>

                                 <div class="termsandconditions_text_color">
                                    @error('password')
                                          {{ $message }}
                                    @enderror
                                    @error('phone')
                                          {{ $message }}
                                    @enderror
                                 </div>
                              </div>
                              <div id="password-errors"></div>
                        </div>

                        <div id="formerror">
                        </div>
                        <div class="row login-bottom-des">
                           <div class="col-md-7 align-self-center">
                               {{-- <a href="{{ route('agent.forgot')}}"> Forgot Password?</a> --}}
                              <a href="#" id="forgotpassword"> Forgot Password?</a>
                           </div>
                           <div class="col-md-5 align-self-center text-left text-md-right">
                                <button type="submit" id="submit_button" class="btn site_btn_primary">Login</button>
                           </div>
                       </div>
                       
                       <div class="common_login_note">
                           {{-- login note from component --}}
                           <x-login-notes />
                       </div>
                     </form>
               </div>
               <div class="col-md-6 order-md-1 order-sm-0 order-0 mb-2 common_login_img">
                  <img src="{{ asset('assets/app/img/login-profile/agent-login.png')}}" class="img-fluid">
               </div>
            </div>
         </section>
      <div class="modal upload-modal fade" id="comman_modal" style="display: none">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <input type="hidden" value="0" id="forgot_password">
               <form id="forgotPasswordSend" method="post" action="" >
                  @csrf
                  <div class="modal-header">
                     <h5 class="modal-title"> <img src="{{asset('assets/app/img/2fa.png')}}" class="custompopicon" alt="logo">Reset Password</h5>
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
                        <p class="text-center pb-2">We will send you a reset password link to your email.</p>
                        <input type="txt" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" data-parsley-required-message="Your Email is required" value="{{ old('email') }}">
                        <div id="email-error"></div>
                        <div class="termsandconditions_text_color">
                           @error('email')

                                    {{ $message }}
                           @enderror
                           <input type="hidden" name="url" value="{{ route('agent.forgot')}}">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer forgot_pass pt-0 pb-4">
                        <button type="submit" class="btn main_bg_color site_btn_primary" id="sendSubmit">Send</button>
                        <!-- <p class="pt-2">Not received your code? <a href="#" class="termsandconditions_text_color">Resend Code</a></p> -->
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="modal upload-modal fade" id="recovery_modal" style="display: none">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title "> <img src="{{asset('assets/img/account-recovery.png')}}" class="custompopicon" alt="Account Recovery">Account Recovery</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                  </button>
               </div>

               <div class="modal-body pt-5">
                  <div class="row text-center" style="">
                     <div class="col-md-12">
                        <a href="#"><img src="{{ asset('assets/app/img/tick.png')}}" class="img-fluid" alt="logo"></a>
                     </div>
                  </div>
                  
                   <div class="col-12 my-2 text-center">
                        <h5 id="task_desc" class="popu_heading_style">Your password has been reset. We have sent a password link to your nominated email account:</h5>           
                        <p class="comman_msg text-center font-weight-bold"></p>
                     </div>
              </div>
              <div class="modal-footer" class="justify-contant-center pt-0">
                  <button type="submit" class="btn-success-modal" data-dismiss="modal" id="close">Ok</button>
              </div>
            </div>
         </div>
      </div>


      

      @include('modal.two-step-verification')


   </div>






@endsection
@push('script')

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

<script>

   $(function() {
      $('#escort_login').parsley({

      });
   });
   $(function() {
      $('#forgotPasswordSend').parsley({

      });
   });

   document.getElementById('mobileno').focus();

   $(document).ready(function() {
      $("body").on("click","#forgotpassword",function(e){
         e.preventDefault();
         $("#comman_modal").modal('show');
            $("body").on("submit","#forgotPasswordSend",function(e){
               e.preventDefault();
               $('#forgot_password').val('1');
               send2FAotp($('#email').val());
            });
         // });

         $("body").on("click", "#sendOtpSubmit", function(e) {
            e.preventDefault();
            let form = $("#SendOtp")[0];
            let data = new FormData(form);
            var url = "{{ route('web.checkOTP')}}";
            data.append('forget_password' , $('#forgot_password').val());
            data.append('email' , $('#email').val());
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
               beforeSend: function () {
                  $('#sendOtpSubmit').prop('disabled', true);
                  $('#sendOtpSubmit').html('Verifying...');
               }, 
               success: function(data) {
                  if(data.error ==  false){
                     var form = $(this);
                     var url = "{{ route('web.sendMail.agent')}}";
                     var data = new FormData($('#forgotPasswordSend')[0]);
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
                              beforeSend: function () {
                                 $('#sendSubmit').prop('disabled', true);
                                 $('#sendSubmit').html('<div class="spinner-border spinner-border-sm"></div> Sending...');
                              },
                              success: function(data) {
                                 if(data.error == true) {
                                    $("#comman_modal").modal('hide');
                                    $(".comman_msg").text(data.email);
                                    $("#recovery_modal").modal('show');
                                    $('#sendSubmit').prop('disabled', false);
                                    $('#sendSubmit').html('Send');
                                    $('#email').val('');
                                    $('#sendOtp_modal').modal('hide');
                                    $('#sendOtpSubmit').prop('disabled', false);
                                    $('#sendOtpSubmit').html('Verify');
                                    $('#otp').val('');
                                 }
                                 if(data.error == false) { 
                                    $("#errorNew ul").remove();
                                    $("#errorNew").append("<ul class='parsley-errors-list filled'><li class='parsley-required'>User does not exist</li></ul>");
                                    $('#sendSubmit').prop('disabled', false);
                                    $('#sendSubmit').html('Send');
                                 }
                              },
                              error: function(data) {
                                 console.log("error: ", data.responseJSON.errors);
                              }
                        }); 
                  }else if (data.error === true && !('type' in data)) {
                        $('.otp-input').val('');
                        $('.first_input').val('').focus().select();
                        $("#senderror").html('');
                        $("#senderror").append(
                           "<ul class='parsley-errors-list filled'>" +
                              "<li class='parsley-required'>Your have entered invalid OTP.</li>" +
                           "</ul>"
                        );

                        $('#otp').val('');
                        $('#sendOtpSubmit').prop('disabled', false);
                        $('#sendOtpSubmit').html('Verify');
                  }else{
                  window.location.href = "{{ route('agent.dashboard') }}";
                  }
               },
               error: function(data) {
   
                  console.log("error otp: ", data.responseJSON.errors);
                  $.each(data.responseJSON.errors, function(key, value) {
                     errorsHtml = '<div class="alert alert-danger"><ul>';
                     errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                  });
                  $('#sendOtpSubmit').prop('disabled', false);
                        $('#sendOtpSubmit').html('Verify');
                  errorsHtml += '</ul></di>';
                  $('#senderror').html(errorsHtml);
                  $('.otp-input').val('');
                  $('.first_input').val('').focus().select();
               }
            });
         });        
      });
            // use for change pin and resend otp
      
      $(document).off('click' , '#resendOtpSubmit');
      $(document).on('click' , '#resendOtpSubmit' , function(){
         send2FAotp($('#email').val());
      });

      var loginForm = $("#escort_login");

      loginForm.submit(function(e) {
      
         e.preventDefault();
         
         swal_waiting_popup({});
         var form = $(this);
         var url = form.attr('action');
         var formData = new FormData($("#escort_login")[0]);
         console.log(formData);
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
                  Swal.close();
                  $('#formerror').html('');
                  var ph = data.phone;
                  $("#phoneId").attr('value',ph);
                  if(data.error == 1) {
                     $('body').on("click","#resendOtpSubmit",function(){
                        $("#escort_login").submit();
                        /* $('#senderror').html("<p class='text-center text-success'> Your verification code has been resent to your nominated preference. "+data.phone+"</p>"); */
                        var message = "{{ config('common.resend_2fa_verification_code_msg') }}";
                        $('#senderror').html("<p class='text-center text-success'>" + message + "</p>");
                     });
                     
                     setTimeout(() => {
                     $("#sendOtp_modal").modal({backdrop: 'static', keyboard: false});
                     }, 300); 


                     $("body").on("submit","#SendOtp",function(e){
                           e.preventDefault();
                           var form = $(this);
                           
                           console.log(ph);
                           $('#sendOtpSubmit').attr('disabled', true);
                           $('.wait-loader').css({'display':'block'});
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
                                 $('#sendOtpSubmit').attr('disabled', false);
                                 $('.wait-loader').css({'display':'none'});
                                 console.log("error otp: ", data.responseJSON.errors);
                                 $.each(data.responseJSON.errors, function(key, value) {
                                 errorsHtml = '<div class="alert alert-danger"><ul>';
                                 errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                                 });

                                 errorsHtml += '</ul></di>';
                                 $('#senderror').html(errorsHtml);
                                 $('.otp-input').val('');
                                 $('.first_input').val('').focus().select();
                              }
                           });  
                  
                     });


                  }
            },
            error: function(data) {

                  Swal.close();
                  console.log("error: ", data.responseJSON.errors);
                  $.each(data.responseJSON.errors, function(key, value) {
                  errorsHtml = '<div class="alert alert-danger" style="text-transform:none !important;"><ul>';
                  errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                  });

                  errorsHtml += '</ul></di>';
                  $('#formerror').html(errorsHtml);
            }
         });
      });


      $('#sendOtp_modal').off('hidden.bs.modal').on('hidden.bs.modal', function () {
         $('#forgot_password').val(0);
         $("#senderror").html('');
      });
   });

    document.addEventListener("DOMContentLoaded", function () {
        const toggleIcon = document.querySelector(".toggle-password");
        const passwordInput = document.querySelector("#exampleInputPassword1");
        const eyeIcon = document.querySelector("#toggleEyeIcon");

        toggleIcon.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            eyeIcon.classList.toggle("fa-eye");
            eyeIcon.classList.toggle("fa-eye-slash");
        });
    });
    
   let agent_pending_status = sessionStorage.getItem('agent_pending_status');
   if (agent_pending_status) {
         let formattedMessage = agent_pending_status.replace(/\n/g, '<br>');
         swal_success_popup(formattedMessage);
            sessionStorage.removeItem('agent_pending_status');
   }

    function send2FAotp(email)
      {
         $('#email-error').html('');
         var token = $('input[name="_token"]').attr('value');
         $.ajax({
            url: "{{route('send-otp-for-pin-change')}}",
            type: 'POST',
            data: {email:email},
            dataType: "JSON",
           
            headers: {
               'X-CSRF-Token': token
            },
            success: function(data) {
               if(data.status == true){
                  $('#sendOtp_modal').modal('show');
                  $('#comman_modal').modal('hide');
               }else{
                  $('#email-error').html(data.message);
               }
            },
            error: function(data) {
 
               console.log("error otp: ", data.responseJSON.errors);
               
            }
         });
      }

</script>
@endpush
