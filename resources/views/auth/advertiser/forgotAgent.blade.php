@extends('layouts.web')
@section('content')
<style>
    .toggle-password {
        position: absolute;
        right: 20px;
        top: 40px;
    }
</style>
<div class="container">
    <section class="login_page_pt_pb_of_outer_section">
        <div class="row text-center" style="position: relative;top: 2.5rem;">
            <div class="col-md-12">
                <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png')}}" alt="logo" style="max-width:150px; width:100%"></a>
            </div>
        </div>
        <section class="innersection_padding_from_all_side box_shdow_of_login_form forgot_pass">
            <div class="row align-items-center">
                <div class="col-md-12 order-md-0 order-sm-1 order-1">

                    <h4 class="welcome_sub_login_heading text-center pt-4 pb-3"><strong>Forgot Password</strong></h4>
                    <form id="resetPasswordAdmin" action="#" method="post">
                        @csrf
                        <input type="hidden" name="cusotm_token" value="{{$token}}">
                        <div class="form-group label_margin_zero_for_login form-group position-relative">
                            <label for="new_password">{{ __('Password') }}</label>
                            <input type="password" id="new_password" class="form-control" placeholder="Create new password" name="password" required autocomplete="new-password" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                            <span class="toggle-password" toggle="#new_password">
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
                            <input type="password" class="form-control" id="conformPassword" placeholder="Confirm your password" name="password_confirmation" data-parsley-equalto="#new_password" data-parsley-equalto-message="Confirm password should be the same password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                            <span class="toggle-password" toggle="#conformPassword">
                                <i class="fa fa-eye"></i>
                            </span>
                            <div class="termsandconditions_text_color">
                                <!-- error sms here -->
                            </div>
                        </div>

                        <div class="row login-bottom-des">

                            <div class="col-md-12">
                                <button type="submit" class="btn site_btn_primary">Update Password </button>
                                <h6>Or</h6>
                                <a href="{{ route('agent.login')}}">
                                    <h5>Login</h5>
                                </a>
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
                <a href="{{route('agent.login')}}" class="btn main_bg_color site_btn_primary">Click Hear To Login</a>
            </div>
        </div>
    </div>
</div>






@endsection
@section('script')

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script>
    $(function() {
        $('#resetPasswordAdmin').parsley({

        });

        /////////////////
        $("body").on("submit", "#resetPasswordAdmin", function(e) {
            e.preventDefault();
            var form = $(this);
            // var url = form.attr('action');
            var url = "{{ route('web.reset.password.viewer')}}";
            var data = new FormData($('#resetPasswordAdmin')[0]);

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

                        $("#resetPassword_modal").modal('show');
                        $("#hid").html("Password Change Successfully.");

                        // $(".comman_msg").text(data.email);

                    }
                },
                error: function(data) {

                    console.log("error: "); //, data.responseJSON.errors);

                }
            });

        });
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