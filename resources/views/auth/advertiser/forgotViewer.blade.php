@extends('layouts.web')
@section('content')
<style>
.toggle-password {
position: absolute;
right: 20px;
top: 40px;
}

.modal-content {
box-shadow: 0 20px 25px -5px rgb(0 0 0 / 14%);
}
.modal-dialog {
    max-width: 650px !important;
}
</style>
<div class="container">
      <section class="login_page_pt_pb_of_outer_section">
        <div class="row text-center" style="position: relative;top: 2.5rem;">
               <div class="col-md-12">
                   <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png')}}" style="max-width:150px; width:100%" alt="logo"></a>
               </div>
           </div>
         <section class="innersection_padding_from_all_side box_shdow_of_login_form forgot_pass">
            <div class="row align-items-center">
               <div class="col-md-12 order-md-0 order-sm-1 order-1">
                  
                  <h4 class="welcome_sub_login_heading text-center pt-4 pb-3"><strong>Forgot Password</strong></h4>
                  @if(isset($error))
                        <div class="alert alert-danger text-center">
                            {{ $error }}
                        </div>
                    @endif
                  <form id="resetPassword" action="#" method="post">
                     @csrf
                        @if(isset($token))
                            <input type="hidden" name="cusotm_token" value="{{$token}}">
                        @endif 
                        {{-- <div class="form-group label_margin_zero_for_login">
                           
                           <input type="text" required class="form-control" name="password" placeholder="Create new password">
                           
                        </div>

                         <div class="form-group label_margin_zero_for_login ">
                           
                           <input type="text" required class="form-control" name="password" placeholder="Create new password">
                           
                        </div> --}}
                        <div class="form-group label_margin_zero_for_login position-relative">
                           <label for="exampleInputPassword1">{{ __('Password') }}</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Create new password" name="password" required autocomplete="new-password" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                           <span class="toggle-password" toggle="#exampleInputPassword1">
                                <i class="fa fa-eye"></i>
                        </span>
                           <div class="termsandconditions_text_color">
                               <!-- error sms here -->
                               @error('password')
                               <strong>{{ $message }}</strong>
                               @enderror
                           </div>
                       </div>
                       <div class="form-group label_margin_zero_for_login position-relative">
                           <label for="conformPassword">{{ __('Confirm Password') }}</label>
                           <input type="password" class="form-control" id="conformPassword" placeholder="Confirm your password" name="password_confirmation" data-parsley-equalto="#exampleInputPassword1" data-parsley-equalto-message="Confirm password should be the same password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                           <span class="toggle-password" toggle="#conformPassword">
                                <i class="fa fa-eye"></i>
                            </span>
                           <div class="termsandconditions_text_color">
                               <!-- error sms here -->
                           </div>
                       </div>
                       
                       <div class="row login-bottom-des">
                          
                           <div class="col-md-12">
                                <button type="submit" class="btn site_btn_primary" id="updatePasswordBtn">Update Password </button> 
                                <h6>Or</h6>
                                <a href="{{ route('viewer.login')}}"><h5>Login</h5></a>
                           </div>
                       </div>
                       
                     </form>
               </div>
              
            </div>
         </section>
      </section>
</div>
    <div class="modal" id="resetPassword_modal" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white"> <img src="{{asset('assets/dashboard/img/save-setting.png')}}" class="custompopicon" alt="logo">Password Updated</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                    <div class="modal-body">
                        <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;" id="hid"></h1>
                        <span id="comman_str"></span>
                        <span class="comman_msg"></span>
                        
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <a href="{{route('advertiser.login')}}" class="btn main_bg_color site_btn_primary">Click Hear To Login</a>
                    </div>
                </div>
            </div>
        </div>
      

<div class="modal fade upload-modal" id="userNotFoundModal" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <input type="hidden" id="status_data_id" value="334">
                    <input type="hidden" id="status_data_value" value="7">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{asset('assets/dashboard/img/alert.png')}}" alt="resolved" class="custompopicon">
                        <span>Password Reset Link Expired</span>
                    </h5>
                    <input type="hidden" id="status_data_id" name="status_data_id" value="">
                    <input type="hidden" id="status_data_value" name="status_data_value" value="">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style mt-2">
                        Your password reset link is invalid or has expired. Please request a new one.
                    </h5>

                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Ok</button>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('script')

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

<script>

   $(function() {
      $('#resetPassword').parsley({

      });

      /////////////////
      $("body").on("submit","#resetPassword",function(e){
            e.preventDefault();
            var form = $(this);
            // var url = form.attr('action');
            var url = "{{ route('web.reset.password.viewer')}}";
            var data = new FormData($('#resetPassword')[0]);
            
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
                beforeSend: function () {
                    $('#updatePasswordBtn').prop('disabled', true);
                    $('#updatePasswordBtn').html('Updating...');
                },
                success: function(data) {
                    if (data.error == true) {
                        $("#resetPassword_modal").modal('show');
                        $("#hid").html("Changed password successfully.");
                        $('#updatePasswordBtn').prop('disabled', false);
                        $('#updatePasswordBtn').html('Update Password');

                        // $(".comman_msg").text(data.email);
                    }
                    else {
                        $('#userNotFoundModal').modal('show');
                    }
                },
                error: function(data) {

                    console.log("error: ", data.responseJSON.errors);
                    
                }
            });  
                    
        });
   });
   $('#userNotFoundModal').off('hidden.bs.modal').on('hidden.bs.modal', function () {
      window.location.href = "{{ route('home') }}";
    });
    document.querySelectorAll('.toggle-password').forEach(function(el) {
        el.addEventListener('click', function() {
            var selector = this.getAttribute('toggle');
            var input = document.querySelector(selector);
            if (!input) {
                console.error("Invalid selector:", selector);
                return;
            }
            var icon = this.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });

</script>
@endsection