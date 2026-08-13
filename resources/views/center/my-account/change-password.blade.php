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
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="common-grid">

                            <div class="common-card">
                                <!-- Change Password Form -->
                                <form class="" id="userProfile" action="{{ route('center.update.password') }}"
                                    method="POST" autocomplete="off" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="form-group cp-field">
                                                <label for="current_password">Current Password</label>
                                                <div class="cp-input-wrap">
                                                    <input type="password" name="password" id="current_password"
                                                        autocomplete="current-password"
                                                        placeholder="{{ config('constants.current_password_placeholder') }}"
                                                        data-parsley-required-message="Current password is required"
                                                        required>
                                                    <button type="button" class="cp-eye-btn toggle-password"
                                                        toggle="#current_password">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div id="formerror"></div>
                                                <p class="cp-hint">
                                                    <small><i>{{ config('constants.current_password_notify') }}</i></small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">

                                            <div class="form-group cp-field">
                                                <label for="new_password">New Password</label>
                                                <div class="cp-input-wrap">
                                                    <input type="password" class="" name="new_password"
                                                        id="new_password" placeholder="New password" required
                                                        autocomplete="new-password"
                                                        data-parsley-required-message="New password is required"
                                                        data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                                                        data-parsley-pattern-message="Password must be 8+ characters, include uppercase, lowercase, number, and special character.">
                                                    <button type="button" class="cp-eye-btn toggle-password"
                                                        toggle="#new_password">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                                <p class="cp-hint">
                                                    <small><i>Must be a minimum of 8 characters long</i></small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group cp-field">
                                                <label for="confirm_password">Confirm Password</label>
                                                <div class="cp-input-wrap">
                                                    <input type="password" class="" name="password_confirmation"
                                                        id="confirm_password" placeholder="Confirm password" required
                                                        autocomplete="confirm-password" data-parsley-equalto="#new_password"
                                                        data-parsley-equalto-message="Confirm password must match.">
                                                    <button type="button" class="cp-eye-btn toggle-password"
                                                        toggle="#confirm_password">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="common-footer">
                                        <input type="submit" value="Save Password" class="common-save-btn">
                                    </div>
                                </form>
                            </div>
                            <div class="common-card">
                                <!-- Password Expiry Settings -->
                                <form class="" id="passwordExpiry"
                                    action="{{ route('center.update.password.expiry') }}" method="POST">
                                    @csrf
                                    
                                        <div class="col-md-12">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M3 9H21M7 3V5M17 3V5M6 12H10V16H6V12ZM6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z"
                                                                stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Password Expiry</h2>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="option-list">
                                                    <div class="form-radio">
                                                        <input class="" name="password_expiry_days" type="radio"
                                                            value="never" id="Never"
                                                            @if ($user->account_setting && $user->account_setting->password_expiry_days == 'never') {{ 'checked' }} @endif>
                                                        <label class="form-check-label" for="Never">Never</label>
                                                    </div>
                                                    <div class="form-radio">
                                                        <input class="" name="password_expiry_days" type="radio"
                                                            value="30" id="Day_30"
                                                            @if ($user->account_setting && $user->account_setting->password_expiry_days == '30') {{ 'checked' }} @endif>
                                                        <label class="form-check-label" for="Day_30">Renew every 30
                                                            days</label>
                                                    </div>
                                                    <div class="form-radio">
                                                        <input class="" name="password_expiry_days" type="radio"
                                                            value="60" id="Day_60"
                                                            @if ($user->account_setting && $user->account_setting->password_expiry_days == '60') {{ 'checked' }} @endif>
                                                        <label class="form-check-label" for="Day_60">Renew every 60
                                                            days</label>
                                                    </div>
                                                    <div class="form-radio">
                                                        <input class="" name="password_expiry_days" type="radio"
                                                            value="90" id="Day_90"
                                                            @if ($user->account_setting && $user->account_setting->password_expiry_days == '90') {{ 'checked' }} @endif>
                                                        <label class="form-check-label" for="Day_90">Renew every 90
                                                            days</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p> <i>Default expiry is 30 days unless changed.</i></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-4">


                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                                            stroke-linejoin="round" />

                                                        <path d="M10 21h4" stroke="currentColor" stroke-width="1.8"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Notification</h2>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="radio-options">
                                                    <div class="form-check m-0">
                                                        <input class="form-check-input" name="is_text_notificaion_on"
                                                            type="checkbox" id="Text_Us" value="1"
                                                            @if ($user->account_setting && $user->account_setting->is_text_notificaion_on == '1') {{ 'checked' }} @endif>
                                                        <label class="form-check-label" for="Text_Us">Text</label>
                                                    </div>
                                                    <div class="form-check m-0">
                                                        <input class="form-check-input" name="is_email_notificaion_on"
                                                            type="checkbox" id="Email_Us" value="1"
                                                            @if ($user->account_setting && $user->account_setting->is_email_notificaion_on == '1') {{ 'checked' }} @endif>
                                                        <label class="form-check-label" for="Email_Us">Email</label>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p> <i>You will be notified 24 hours before password expiry.</i></p>
                                            </div>
                                        </div>
                                        <div class="common-footer">
                                            <input type="submit" value="Save" class="common-save-btn">
                                        </div>
                            
                                </form>
                            </div>
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
                                
                                showAlert('success', '',data.message);
                                // Reload page after 3 seconds to reflect changes
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            } else {
                                showAlert('error', 'Error', data.message);
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
                            
                            showAlert('error', 'Error', errorMsg);
                            // Show validation errors (e.g., Laravel validation)
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                let errorsHtml = '<ul>';
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorsHtml += '<li>' + value + '</li>';
                                });
                                errorsHtml += '</ul>';
                                showAlert('error', 'Error', errorsHtml);
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
                            if (data.status === true) {
                                showAlert('success', 'Success', data.message);
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
                                    showAlert('error', 'Error', errorMsg);
                                    

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
