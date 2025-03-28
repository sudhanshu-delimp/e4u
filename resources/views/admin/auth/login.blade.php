@extends('layouts.web')
@section('content')
<section class="section_bg_color padding_ninty_top_ninty_px padding_ninty_btm_ninty_px">

<div class="container">
      <section class="login_page_pt_pb_of_outer_section">
         <section class="innersection_padding_from_all_side box_shdow_of_login_form">
            <div class="row align-items-center">
               <div class="col-md-6 order-md-0 order-sm-1 order-1">
                  <div class="welcone_login_page_heading">
                     <h1 class="text-uppercase">WELCOME TO</h1>
                  </div>

                  <h4 class="welcome_sub_login_heading text-uppercase"><strong>Admin LOGIN</strong></h4>
                  <form id="admin_login" action="{{ route('admin.login')}}" method="post">
                    @csrf
                    <input type="hidden" name="type_admin" value="1">
                    <input type="hidden" name="type_staff" value="2">
                        <div class="form-group label_margin_zero_for_login">
                           <label for="email">Email Address</label>

                           <input type="email" value="{{ old('email') }}" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" data-parsley-required-message="Email is required">
                           <div class="termsandconditions_text_color">
                               @error('email')
                                {{ $message }}
                                @enderror
                           </div>
                        </div>
                        <div class="form-group label_margin_zero_for_login">
                           <label for="exampleInputPassword1">{{ __('Password') }}</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please Enter Your Password" name="password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                                @error('password')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div id="formerror">
                        </div>
                       <div class="row login-bottom-des">
                           <div class="col-md-7 align-self-center">
                            <a href="#" id="forgotpassword"> Forgot Password?</a>
                           </div>
                           <div class="col-md-5 align-self-center text-left text-md-right">
                                <button type="submit" id="submit_button" class="btn site_btn_primary">Login</button>       
                           </div>
                       </div>
                        <p class="mb-0 mynote mt-4"><b>Note:</b> Login is undertaken with 2FA authentification</p>
                  </form>
               </div>
               <div class="col-md-6 order-md-1 order-sm-0 order-0 mb-2">
                  <img src="{{ asset('assets/app/img/admin-login.jpg')}}" class="img-fluid">
               </div>
            </div>
         </section>
      </section>
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
                          <input type="hidden" name="url" value="{{ route('admin.forgot')}}">
                       </div>
                    </div>
                 </div>
                 <div class="modal-footer forgot_pass pt-0 pb-4">
                       <button type="submit" class="btn main_bg_color site_btn_primary" id="sendSubmit">Send</button>
                 </div>

              </form>
           </div>
        </div>
     </div>
     <div class="modal" id="recovery_modal" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content custome_modal_max_width">
              <div class="modal-header main_bg_color border-0">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">
                 <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                 </span>
                 </button>
              </div>
              <div class="modal-body pb-5 pt-5">
                 <div class="row text-center" style="">
                    <div class="col-md-12">
                       <a href="#"><img src="{{ asset('assets/app/img/tick.png')}}" class="img-fluid" alt="logo"></a>
                    </div>
                 </div>
                 <h4 class="welcome_sub_login_heading text-center pt-4 pb-2" id="hid"><strong></strong></h4>
                 <p class="text-center text-capitalize mb-0" id="comman_str"></p>
                 <p class="comman_msg text-center font-weight-bold"></p>
             </div>
             <!-- <div class="modal-footer" style="justify-content: center;">
                 <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
             </div> -->
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
                          <p class="text-center pb-2">To help keep your account safe, E4U wants to make sure it’s really you trying to sign in.</p>
                          
                          <input type="password" maxlength="4" required class="form-control" name="otp" id="otp" aria-describedby="emailHelp" placeholder="Enter One Time Password" data-parsley-required-message="Otp is required">

                          <div class="termsandconditions_text_color">
                              @error('opt')

                                      {{ $message }}
                              @enderror
                              
                          </div>
                          <input type="hidden" name="phone" id="phoneId" value="">
                      </div>
                      <div id="senderror"></div>
                  </div>
                  <div class="modal-footer forgot_pass pt-0 pb-4">
                  <button type="submit" class="btn main_bg_color site_btn_primary" id="sendOtpSubmit">Send</button>
                      <p class="pt-2">Not received your code? <a href="#" id="resendOtpSubmit" class="termsandconditions_text_color">Resend Code</a></p>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

{{-- <!--     <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <!-- <div class="reg_info">
                    <h1 class="text-uppercase">Admin Login saif</h1>
                </div> -->
            <!-- </div> -->
         <!--    <div class="reg_box_form_style col-lg-5 col-md-5">
                <div class="regstractionform">
                    <form id="admin-login" action="{{ route('admin.login')}}" method="post">
                      
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" value="{{ old('email') }}" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" data-parsley-required-message="Email is required">
                            <div class="termsandconditions_text_color">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">{{ __('Password') }}</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please Enter Your Password" name="password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                                @error('password')
                                {{ $message }}
                                @enderror
                            <!-- </div>
                        </div>
                        <button type="submit" id="submit_button" class="btn site_btn_primary">Login</button>
                    </form>

                </div>
            </div> -->
       <!--  </div>
    </div> -->  --}}
</section>
                    
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script>
    $(function() {
        $('#admin_login').parsley({
    
        });
    });
    
    $(function() {
        $('#forgotPasswordSend').parsley({

        });
    });

</script>
<script>

$(document).ready(function() {
   $("body").on("click","#forgotpassword",function(e){
            
         e.preventDefault();
         $("#comman_modal").modal('show');

         $("body").on("submit","#forgotPasswordSend",function(e){
         e.preventDefault();
         var form = $(this);
         // var url = form.attr('action');
         var url = "{{ route('web.sendMail.admin')}}";
         var data = new FormData($('#forgotPasswordSend')[0]);
         
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
                        $('#sendSubmit').prop('disabled', true);
                        $('#sendSubmit').html('<div class="spinner-border"></div>');
                        $("#comman_modal").modal('hide');
                        $("#hid").html("Reset Password");
                        $("#comman_str").html("We sent a reset password link to </br>");
                        $(".comman_msg").text(data.email);
                        $("#recovery_modal").modal('show');
                     }
                     if(data.error == false) { 
                        $("#errorNew ul").remove();
                        $("#errorNew").append("<ul class='parsley-errors-list filled'><li class='parsley-required'>User does not exist</li></ul>");
                        $('#sendSubmit').prop('disabled', false);
                        $('#sendSubmit').html('Save');
                     }
                  },
                  error: function(data) {

                     console.log("error: ", data.responseJSON.errors);
                     
                  }
               });  
         
      });
          
            
   });
   var loginFormViewer = $("#admin_login");

    loginFormViewer.submit(function(e) {
   
      e.preventDefault();
      

      var form = $(this);
      var url = form.attr('action');
      var formData = new FormData($("#admin_login")[0]);
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
               
                console.log(data);
                var ph = data.phone;
                $("#phoneId").attr('value',ph);
                if(data.error == 1) {
                  $('body').on("click","#resendOtpSubmit",function(){
                        $("#admin_login").submit();
                        $('#senderror').html("<p> Verification code sent to "+data.phone+"</p>");
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
                              window.location.href = "{{ route('admin.index') }}";
                              }
                           },
                           error: function(data) {

                              console.log("error v: ", data.responseJSON.errors);
                              $.each(data.responseJSON.errors, function(key, value) {
                              errorsHtml = '<div class="alert alert-danger"><ul>';
                              errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                              });

                              errorsHtml += '</ul></di>';
                              $('#senderror').html(errorsHtml);
                           }
                        });  
               
                  });
                } 
                
         },
         error: function(data) {

               console.log("error w: ", data.responseJSON.errors);
            

               $.each(data.responseJSON.errors, function(key, value) {
                errorsHtml = '<div class="alert alert-danger"><ul>';
                errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
               });

               errorsHtml += '</ul></di>';
               $('#formerror').html(errorsHtml);
         }
      });
    });
});
</script>
@endsection