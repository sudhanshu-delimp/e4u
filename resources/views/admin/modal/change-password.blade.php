@php
    $open_pop_up = false;
    $password_updated_date = '';
    $password_expiry_days = '';
    $submit_url = '';
@endphp

<div class="modal upload-modal fade" id="change_Password_users" tabindex="-1" role="dialog"
    aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordLabel">
                    <img src="{{ asset('assets/dashboard/img/reset-password.png') }}" alt=""
                        class="custompopicon">
                    Change Password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>

            <form  name="change_Password_form" id="change_Password_form">
                @csrf
                <div class="modal-body">
                    <div class="form-group toogle_eye_form_wrap">
                         <input type="hidden" id="user_id" name="user_id"/>
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="modal_new_password" class="form-control"
                            placeholder="Enter new password">
                        <span class="text-danger error-new_password"></span>
                        
                        <span class="toogle-eye-password" toggle="#modal_new_password"><i class="fa fa-eye"></i></span>

                        <div id="password-strength" style="margin-top:6px;">
                            <div id="strength-bar"
                                style="height:6px; background:#ddd; border-radius:4px; overflow:hidden;">
                                <div id="strength-fill" style="height:100%; width:0%; background:red; transition:0.3s;">
                                </div>
                            </div>
                            <small id="strength-text" style="font-size:12px; color:#555;"></small>
                        </div>

                    </div>
                    <div class="form-group toogle_eye_form_wrap">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation"
                            id="modal_new_password_confirmation" class="form-control"
                            placeholder="Re-enter new password">
                        <span class="text-danger error-new_password_confirmation"></span>
                        <span class="toogle-eye-password" toggle="#modal_new_password_confirmation"><i
                                class="fa fa-eye"></i></span>
                    </div>
                </div>

                <div class="modal-footer justify-content-end pt-0">

                    <button type="button" id="updatePassword" class="btn-success-modal">Update Password</button>
                </div>
            </form>
            <div class="mt-3" id="divErros"></div>
        </div>
    </div>
</div>
@push('script')

<script>
    $(document).ready(function() {

        var passwordStrengthLevel = 0;
        var passwordsMatch = false;

        $('#password-strength').css('display', 'none');
        $(document).on('click', '.update_password', function() {
            $('#updatePassword').prop('disabled', false).text('Update');
            let id = $(this).data('id');
            $("#user_id").val(id);
            $('#change_Password_users').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#change_Password_users').modal('show');
        });

        $(document).on('click', '#updatePassword', function(e) {
            e.preventDefault();
            $(".error-new_password, .error-new_password_confirmation").text("");
            var modal_new_password = $("#modal_new_password").val();
            var modal_new_password_confirmation = $("#modal_new_password_confirmation").val();
            var myform = false;
            $('#updatePassword').prop('disabled', true).text('Updating...');

            let formData = $('#change_Password_form').serialize();
                $("#divErros").html('');

                $.ajax({
                    url: `{{ route('admin.update.password') }}`, // your update route
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#change_Password_users').modal('hide');
                         $('#change_Password_form')[0].reset();
                        //$("#divErros").html('<span class="text-success">' + response.message +'</span>');
                         swal_success_popup(response.message);
                       
                    },
                    error: function(xhr) {
                       $('#updatePassword').prop('disabled', false).text('Update');
                        if (xhr.status === 422) {
                            $("#divErros").html('');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('.error-' + field).text(messages[0]);
                            });

                        } else {
                           // $("#divErros").html('<span class="text-danger">' + xhr.responseJSON.message + '</span>');
                           $('#change_Password_form')[0].reset();
                            $('#change_Password_users').modal('hide');
                            swal_error_popup(xhr.responseJSON.message);
                        }
                    }
                });

        });


        document.querySelectorAll('.toogle-eye-password').forEach(function(el) {
            el.addEventListener('click', function() {
                var selector = this.getAttribute('toggle');
                var root = this.closest('.modal, body'); // search inside modal first
                var input = root.querySelector(selector);

                if (!input) {
                    console.error("Invalid selector:", selector);
                    return;
                }

                var icon = this.querySelector('i');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                }
            });
        });


        $(document).on("input", "#modal_new_password", function() {

            $('#password-strength').css('display', 'block');
            let password = $(this).val();
            passwordStrengthLevel = 0;

            $("#modal_new_password").css("border", "1px solid #ced4da");


            if (password.length >= 8) passwordStrengthLevel++;
            if (/[a-z]/.test(password)) passwordStrengthLevel++;
            if (/[A-Z]/.test(password)) passwordStrengthLevel++;
            if (/[0-9]/.test(password)) passwordStrengthLevel++;
            if (/[^A-Za-z0-9]/.test(password)) passwordStrengthLevel++;
            if (password.length >= 12) passwordStrengthLevel++;

            let strengthText = $("#strength-text");
            let strengthFill = $("#strength-fill");

            switch (passwordStrengthLevel) {
                case 0:
                    strengthFill.css({
                        "width": "0%",
                        "background": "red"
                    });
                    strengthText.text("Enter a password");
                    break;

                case 1:
                    strengthFill.css({
                        "width": "20%",
                        "background": "#ff4d4d"
                    });
                    strengthText.text("Very Weak");
                    break;

                case 2:
                    strengthFill.css({
                        "width": "35%",
                        "background": "#ff884d"
                    });
                    strengthText.text("Weak");
                    break;

                case 3:
                    strengthFill.css({
                        "width": "55%",
                        "background": "#ffcc00"
                    });
                    strengthText.text("Medium");
                    break;

                case 4:
                    strengthFill.css({
                        "width": "70%",
                        "background": "#9acd32"
                    });
                    strengthText.text("Strong");
                    break;

                case 5:
                    strengthFill.css({
                        "width": "90%",
                        "background": "#4caf50"
                    });
                    strengthText.text("Very Strong");
                    break;

                case 6:
                    strengthFill.css({
                        "width": "100%",
                        "background": "#2e7d32"
                    });
                    strengthText.text("Excellent");
                    break;
            }
        });

        $(document).on("input", "#modal_new_password_confirmation", function() {
            let current_password = $("#modal_new_password_confirmation").val();
            if (current_password.length === 0) {
                $("#modal_new_password_confirmation").css("border", "1px solid #dc3545");
            } else {
                $("#modal_new_password_confirmation").css("border", "1px solid #ced4da");
            }
        });

        $(document).on("input", "#modal_new_password, #modal_new_password_confirmation", function() {

            let pass = $("#modal_new_password").val();
            let cpass = $("#modal_new_password_confirmation").val();
            let input = $("#modal_new_password_confirmation");


            if (cpass.length === 0) {
                input.css("border", "1px solid #dc3545");
                passwordsMatch = false;
                return;
            }

            if (pass === cpass) {
                input.css("border", "1px solid #28a745");
                passwordsMatch = true;
            } else {
                input.css("border", "1px solid #dc3545");
                passwordsMatch = false;
            }
        });


    });
</script>
@endpush