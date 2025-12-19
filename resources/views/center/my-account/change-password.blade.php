@extends('layouts.center')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">

    <style>
        .swal-button {
            background-color: #242a2c;
        }

        .toggle-password {
            position: absolute;
            top: 28px;
            right: 15px;
            cursor: pointer;
            z-index: 2;
            color: #6c757d;
        }
    </style>
@stop

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec">
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Change Password</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                <ol>
                                    <li>Use this feature to change your Password and to set up your Password preferences.
                                    </li>
                                    <li>Your Password, unless you change the settings, will by default expire every 30 days.
                                        You will be notified before the expiry date.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                      <!-- Page Heading -->
                    <div class="col-md-12">
                                <div id="globalAlert" class="alert d-none rounded " role="alert"></div>
                    </div>

                    <div class="col-md-6 mb-5">
                        <!-- Change Password Form -->
                        <form class="v-form-design" id="userProfile" action="{{ route('center.update.password') }}"
                            method="POST" novalidate>
                            @csrf
                            <div class="form-group position-relative">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" name="password" id="current_password"
                                    placeholder="Current password"
                                    data-parsley-required-message="Current password is required" required>
                                <span class="toggle-password" toggle="#current_password">
                                    <i class="fa fa-eye"></i>
                                </span>
                                <div id="formerror"></div>
                                <div class="pt-1">
                                    <small><i>Case sensitive</i></small>
                                </div>
                            </div>

                            <div class="form-group position-relative">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                    placeholder="New password" required autocomplete="new-password"
                                    data-parsley-required-message="Password is required"
                                    data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                                    data-parsley-pattern-message="Password must be 8+ characters, include uppercase, lowercase, number, and special character.">
                                <span class="toggle-password" toggle="#new_password">
                                    <i class="fa fa-eye"></i>
                                </span>
                                <div class="pt-1">
                                    <small><i>Must be a minimum of 8 characters long</i></small>
                                </div>
                            </div>

                            <div class="form-group position-relative">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="confirm_password" placeholder="Confirm password" required
                                    autocomplete="new-password" data-parsley-equalto="#new_password"
                                    data-parsley-equalto-message="Confirm password must match.">
                                <span class="toggle-password" toggle="#confirm_password">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>

                            <input type="submit" value="Save Password" class="btn btn-primary shadow-none mt-3">
                        </form>

                        <hr class="my-4">

                        <!-- Password Expiry Settings -->
                        <form class="v-form-design" id="passwordExpiry"
                            action="{{ route('center.update.password.expiry') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Password Expiry</label>
                                <div class="form-radio">
                                    <input class="" name="password_expiry_days" type="radio" value="never"
                                        @if ($user->account_setting && $user->account_setting->password_expiry_days == 'never') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckDefault">Never</label>
                                </div>
                                <div class="form-radio">
                                    <input class="" name="password_expiry_days" type="radio" value="30"
                                        @if ($user->account_setting && $user->account_setting->password_expiry_days == '30') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckDefault">Renew every 30 days</label>
                                </div>
                                <div class="form-radio">
                                    <input class="" name="password_expiry_days" type="radio" value="60"
                                        @if ($user->account_setting && $user->account_setting->password_expiry_days == '60') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckDefault">Renew every 60 days</label>
                                </div>
                                <div class="form-radio">
                                    <input class="" name="password_expiry_days" type="radio" value="90"
                                        @if ($user->account_setting && $user->account_setting->password_expiry_days == '90') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckDefault">Renew every 90 days</label>
                                </div>

                                <div class="pt-1">
                                    <i>Default expiry is 30 days unless changed.</i>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <label>Notification</label>
                                <div class="form-check m-0">
                                    <input class="form-check-input" name="is_text_notificaion_on" type="checkbox"
                                        id="flexCheckDefault" value="1"
                                        @if ($user->account_setting && $user->account_setting->is_text_notificaion_on == '1') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckDefault">Text</label>
                                </div>
                                <div class="form-check m-0">
                                    <input class="form-check-input" name="is_email_notificaion_on" type="checkbox"
                                        id="flexCheckDefault" value="1"
                                        @if ($user->account_setting && $user->account_setting->is_email_notificaion_on == '1') {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="flexCheckDefault">Email</label>
                                </div>

                                <div class="pt-1">
                                    <i>You will be notified 24 hours before password expiry.</i>
                                </div>
                            </div>

                            <input type="submit" value="Save" class="btn btn-primary shadow-none mt-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span></span>
                </div>
            </div>
        </footer>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

    <script>
        $('#userProfile').parsley();


        function showGlobalAlert(message, type = 'success') {
            const alertBox = $('#globalAlert');
            alertBox
                .removeClass('d-none alert-success alert-danger')
                .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
                .html(message);

            setTimeout(() => {
                alertBox.addClass('d-none');
            }, 4000); // hide after 4 seconds
        }

        $('#userProfile').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $("#modal-title").text('Change Password');

            if (form.parsley().isValid()) {
                var url = form.attr('action');
                var data = new FormData(form[0]);

                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data, 'data');

                        if (data.status == true) {
                            $('input[type=password]').each(function() {
                                $(this).val('');
                            });
                            showGlobalAlert(data.message, "success");
                            // Reload page after 3 seconds to reflect changes
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            // Show error using the message from server
                            showGlobalAlert(data.message, "error");
                        }
                    },
                    error: function(xhr) {
                        var errorMsg = "Something went wrong.";
                        // If the server sent a JSON response with a message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            // Try to parse manual JSON if server responded as plain text
                            try {
                                var res = JSON.parse(xhr.responseText);
                                if (res.message) {
                                    errorMsg = res.message;
                                }
                            } catch (e) {
                                // Not JSON, keep the generic message
                            }
                        }
                        showGlobalAlert(errorMsg, "error");
                        // Show validation errors (e.g., Laravel validation)
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errorsHtml = '<ul>';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorsHtml += '<li>' + value + '</li>';
                            });
                            errorsHtml += '</ul>';
                            showGlobalAlert(errorsHtml, "danger");
                        }
                    }
                });
            }
        });


        $('#passwordExpiry').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $("#modal-title").text('Password Expiry');

            if (form.parsley().isValid()) {
                var url = form.attr('action');
                var data = new FormData(form[0]);

                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        //  console.log(data.message, 'data');
                        if (data.status === true) {
                            //swal_success_popup(data.message);
                            showGlobalAlert(data.message, "success");
                            $("#resetPasswordDate").modal('hide');
                            $('#passwordExpiryText').html(data.data.text);
                        }
                    },
                    error: function(xhr) {
                        var errorMsg = "Something went wrong.";
                        // If the server sent a JSON response with a message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            // Try to parse manual JSON if server responded as plain text
                            try {
                                var res = JSON.parse(xhr.responseText);
                                if (res.message) {
                                    errorMsg = res.message;
                                }
                                showGlobalAlert(errorMsg, "error");
                                
                            } catch (e) {
                                // Not JSON, keep the generic message
                            }
                        }

                    }
                });
            }
        });
    </script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(el) {
            el.addEventListener('click', function() {
                var input = document.querySelector(this.getAttribute('toggle'));
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
@endpush
