@extends('layouts.web')
@section('content')

<div class="container">
      <section class="login_page_pt_pb_of_outer_section">
         <section class="innersection_padding_from_all_side box_shdow_of_login_form">
            <div class="row align-items-center">
               <div class="col-md-6 order-md-0 order-sm-1 order-1">
                  <div class="welcone_login_page_heading">
                     <h1 class="text-uppercase v">WELCOME TO E4U </h1>
                  </div>
                  <h4 class="welcome_sub_login_heading"><strong>VIEWER LOGIN  </strong></h4>

                  <form id="loginFormViewer" action="{{ route('login')}}" method="post">
                      @csrf
                        <input type="hidden" name="type" value="0">

                        @if( request()->get('legboxId') != null)
                        <input type="hidden" name="escort_id" value="{{ request()->get('legboxId')}}">
                        <input type="hidden" name="path" value="{{ request()->get('path') }}">
                        @else
                        <input type="hidden" name="massage_id" value="{{ request()->get('MclegboxId') }}">
                        <input type="hidden" name="path" value="{{ request()->get('path') }}">
                        @endif
                        <div class="form-group label_margin_zero_for_login">
                           <label for="exampleInputmobilenumber">Email</label>
                           <input type="email" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" data-parsley-required-message="Your Email is required" value="{{ old('email') }}">
                           <div class="termsandconditions_text_color">
                               @error('email')

                                       {{ $message }}
                               @enderror
                           </div>
                        </div>
                        <div class="form-group label_margin_zero_for_login position-relative custom--password login--eye">
                            <label for="exampleInputPassword1">{{ __('Password') }}</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder=""
                                    name="password" required autocomplete="new-password"
                                    data-parsley-required-message="@lang('errors/validation/required.password')"
                                    data-parsley-pattern-message="@lang('errors/validation/valid.password')">

                                <span class="input-group-text custom--eye" id="togglePassword" style="cursor: pointer;">
                                    <i class="fa fa-eye" id="passwordEyeIcon"></i>
                                </span>
                            </div>

                            <div class="termsandconditions_text_color">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div id="formerror">
                        </div>
                       <!--<div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                           <label class="form-check-label" for="inlineRadio1">I am an Escort</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                           <label class="form-check-label" for="inlineRadio2">I am an Agent</label>
                       </div>-->

                        <div class="row login-bottom-des">
                           <div class="col-md-7 align-self-center">
                               <a href="#" id="forgotpassword"> Forgot Password?</a>
                               {{-- <form id="sendMailform" method="post" action="{{ route('web.sendMail')}}"> --}}
                                {{-- {{ route('viewer.forgot')}} --}}
                                    {{-- <button type="button" id="forgotpassword"> Forgot Password?</button>
                                </form> --}}
                           </div>
                           <div class="col-md-5 align-self-center text-left text-md-right">
                                <button type="submit" id="submit_button" class="btn site_btn_primary">Login</button>
                           </div>
                       </div>
                       <p class="mb-0 mynote"><b>Note:</b> Login is undertaken with 2FA authentification</p>
                    </form>
               </div>
               <div class="col-md-6 order-md-1 order-sm-0 order-0 mb-2">
                  <img src="{{ asset('assets/app/img/login-profile/viver-login.png')}}" class="img-fluid">
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
                                        <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png') }} " class="img-fluid" alt="logo"></a>
                                    </div>
                                </div>
                          <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Reset Password</strong></h4>
                                <p class="text-center pb-2">We’ll send you a reset password link on your email.</p>
                                <input type="txt" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" data-parsley-required-message="Your Email is required" value="{{ old('email') }}">
                                <div class="termsandconditions_text_color">
                                    @error('email')

                                            {{ $message }}
                                    @enderror
                                    <input type="hidden" name="url" value="{{ route('viewer.forgot')}}">
                                </div>
                             </div>
                        </div>
                        <div class="modal-footer forgot_pass pt-0 pb-4">
                            <button type="submit" class="btn main_bg_color site_btn_primary" id="sendSubmit">Send</button>
                            <p class="pt-2">Not received your code? <a href="#" class="termsandconditions_text_color">Resend Code</a></p>
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

        
         @include('modal.two-step-verification')
    </div>






@endsection
@section('script')

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

<script>

    $(function() {
        $('#loginFormViewer').parsley({

        });
    });
    $(function() {
        $('#forgotPasswordSend').parsley({

        });
    });

</script>

<script>
    document.getElementById('email').focus();
</script>
<script>

    $(document).ready(function() {


        $("body").on("click","#forgotpassword",function(e){

            e.preventDefault();
            $("#comman_modal").modal('show');
            // $('#comman_modal').on('hidden.bs.modal', function () {
               // var mailForm = $("#forgotPasswordSend");
            //    $("#sendSubmit").on("click",function(e)){
            //     e.preventDefault();
            //     var mailForm = $("#forgotPasswordSend");

            //    })
                    $("body").on("submit","#forgotPasswordSend",function(e){
                    e.preventDefault();
                    var form = $(this);
                    // var url = form.attr('action');
                    var url = "{{ route('web.sendMail.viewer')}}";
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
                                    $("#hid").html("Account Recovery");
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
            // });

        });



        //{{--
        //    var loginFormee = $("#loginForm2211");

        //    loginFormee.submit(function(e) {

        //        e.preventDefault();
        //        var form = $(this);
        //        var url = form.attr('action');
        //        var formData = new FormData($("#loginFormee")[0]);
        //        console.log(formData);
        //        var token = $('input[name="_token"]').attr('value');

        //        $.ajax({
        //            url: url,
        //            type: 'POST',
        //            data: formData,
        //            dataType: "JSON",
        //            contentType: false,
        //            processData: false,
        //            headers: {
        //                'X-CSRF-Token': token
        //            },
        //            success: function(data) {
        //                 window.location.href ="{{ route('find.all') }}";
        //                 console.log("data - "+data);
        //            },
        //            error: function(data) {

        //                console.log("error: ", data.responseJSON.errors);


        //                $.each(data.responseJSON.errors, function(key, value) {
        //                  errorsHtml = '<div class="alert alert-danger"><ul>';
        //                  errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
        //                });

        //                errorsHtml += '</ul></di>';
        //                $('#formerror').html(errorsHtml);
        //            }
        //        });
        //    });--}}



    

    var loginFormViewer = $("#loginFormViewer");

    loginFormViewer.submit(function(e) {
      swal_waiting_popup({}); 
      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      var formData = new FormData($("#loginFormViewer")[0]);
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
                $('#formerror').html('');
                 Swal.close();
                if(data.escort_id != null) {

                }
                var path = null;
                if(data.path != null) {
                   var path = data.path;
                }
                var show_id = null;
                if(data.show_id != null) {
                   var show_id = data.show_id;
                }
                console.log('path=='+ path);
                var ph = data.phone;
                $("#phoneId").attr('value',ph);
                if(data.error == 1) 
                {
                    $('body').on("click","#resendOtpSubmit",function(){
                        $("#loginFormViewer").submit();
                        $('#senderror').html("<p class='text-center text-success mt-4'> Your verification code has been resend to your nominated preference. "+data.phone+"</p>");
                    });


                    setTimeout(() => {
                    $("#sendOtp_modal").modal({backdrop: 'static', keyboard: false});
                    }, 300); 

                    $("body").on("submit","#SendOtp",function(e){
                        e.preventDefault();
                        var form = $(this);
                        $('#sendOtpSubmit').attr('disabled', true);
                        $('.wait-loader').css({'display':'block'});
                        console.log(ph);
                        var url = "{{ route('web.checkOTP')}}";
                        var data = new FormData($('#SendOtp')[0]);
                        var phone = data.phone;
                        // var escort_id = data.escort_id;
                        //data.append("phone",phone );
                        //data.append("escort_id",escort_id );
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
                           success: function(data) 
                           {
                                if(data.error == true) 
                                {
                                        if(path != null && path == '/massage-centres-list') {
                                            window.location.href = "{{ route('find.massage.centre') }}";
                                        } else if(path == '/all-escorts-list'){

                                            window.location.href = "{{ route('find.all') }}";
                                        } else if(path == 'center-profile'){
                                            var my_url = "{{ route('center.profile.description',':show_id')}}";
                                            my_url = my_url.replace(':show_id', show_id);
                                            window.location.href = my_url;
                                        } else if(path == 'escort-profile'){
                                            var my_url = "{{ route('profile.description',':show_id')}}";
                                            my_url = my_url.replace(':show_id', show_id);
                                            window.location.href = my_url;
                                        } else {
                                            window.location.href = "{{ route('find.all') }}";
                                        }

                                }
                           },
                           error: function(data) {
                                 $('#sendOtpSubmit').attr('disabled', false);
                                 $('.wait-loader').css({'display':'none'});
                                //console.log("error otp: ", data.responseJSON.errors);
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
               Swal.close();
               $.each(data.responseJSON.errors, function(key, value) {
                errorsHtml = '<div class="alert alert-danger"><ul>';
                errorsHtml += '<li>' + value + '</li>'; 
               });

               errorsHtml += '</ul></di>';
               $('#formerror').html(errorsHtml);
         }
      });
    });

});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const type = input.getAttribute("type") === "password" ? "text" : "password";
            input.setAttribute("type", type);
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }

        // Password field
        const togglePassword = document.getElementById("togglePassword");
        if (togglePassword) {
            togglePassword.addEventListener("click", function () {
                togglePasswordVisibility("exampleInputPassword1", "passwordEyeIcon");
            });
        }

        // Confirm Password field
        const toggleConfirm = document.getElementById("toggleConfirmPassword");
        if (toggleConfirm) {
            toggleConfirm.addEventListener("click", function () {
                togglePasswordVisibility("conformPassword", "confirmEyeIcon");
            });
        }
    });


       

</script>

@endsection
