@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

    <style>
        .toggle-password {
            position: absolute;
            top: 28px;
            right: 15px;
            cursor: pointer;
            z-index: 2;
            color: #6c757d;
        }

        form.v-form-design label {
            font-weight: 400;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec">

        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1"> Change password</h1>
                <span class="helpNoteLink collapsed" data-toggle="collapse" data-target="#notes"
                    aria-expanded="false"><b>Help?</b></span>
            </div>
            <div class="col-md-12 my-3">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to change your Password and to set up your Password
                                preferences.
                            </li>
                            <li>
                                Your Password, unless you change the settings, will by default expire every
                                30 days. You will be notified before the expiry date.
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="col-md-12">
                    <div id="globalAlert" class="alert d-none rounded " role="alert"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="common-grid">
                    <div class="common-card">
                        <form autocomplete="off" id="userProfile" action="{{ route('escort.update.password') }}"
                            method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <!-- Current Password -->
                                <div class="col-md-12">
                                    <div class="form-group cp-field">
                                        <label for="current_password">
                                            Current password
                                        </label>
                                        <div class="cp-input-wrap">
                                            <input type="password" name="password" autocomplete="current-password"
                                                id="current_password"
                                                placeholder="{{ config('constants.current_password_placeholder') }}"
                                                data-parsley-required-message="Current password is required" required>
                                            <button type="button" class="cp-eye-btn toggle-password"
                                                toggle="#current_password">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                        <p class="cp-hint">
                                            <i>{{ config('constants.current_password_notify') }}</i>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group cp-field">
                                        <label for="new_password">
                                            New password
                                        </label>
                                        <div class="cp-input-wrap">
                                            <input type="password" name="new_password" id="new_password"
                                                placeholder="New password" required autocomplete="new-password"
                                                data-parsley-required-message="New password is required"
                                                data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                                                data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                                            <button type="button" class="cp-eye-btn toggle-password"
                                                toggle="#new_password">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                        <p class="cp-hint">
                                            <i>Must be a minimum of eight (8) characters long</i>
                                        </p>
                                    </div>
                                </div>
                                <!-- Confirm password -->
                                <div class="col-md-12">
                                    <div class="form-group cp-field">
                                        <label for="current_password">
                                           Confirm password
                                        </label>
                                        <div class="cp-input-wrap">
                                            <input type="password" placeholder="Confirm password" id="confirm_password"
                                                name="password_confirmation" data-parsley-equalto="#confirm_password"
                                                data-parsley-equalto-message="Confirm password should be the same password"
                                                required autocomplete="confirm-password"
                                                data-parsley-required-message="Confirm password is required">
                                            <button type="button" class="cp-eye-btn toggle-password"
                                                toggle="#confirm_password">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="common-footer">
                                <input type="submit" value="Save Password" class="common-save-btn" name="submit">
                            </div>
                        </form>

                    </div>
                     <div class="common-card">
                    <form id="passwordExpiry" action="{{ route('escort.update.password.expiry') }}" method="POST">
                       
                            <div class="col-md-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
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

                                <div class="option-list">

                                    <div class="form-radio">
                                        <input class="" name="password_expiry_days" type="radio" value="never"
                                            id="Never" @if ($user->account_setting && $user->account_setting->password_expiry_days == 'never') {{ 'checked' }} @endif>
                                        <label class="form-check-label" for="Never">Never</label>
                                    </div>
                                    <div class="form-radio">
                                        <input class="" name="password_expiry_days" type="radio" value="30"
                                            id="days_30" @if ($user->account_setting && $user->account_setting->password_expiry_days == '30') {{ 'checked' }} @endif>
                                        <label class="form-check-label" for="days_30">Renew every 30 days</label>
                                    </div>
                                    <div class="form-radio">
                                        <input class="" name="password_expiry_days" type="radio" value="60"
                                            id="days_60" @if ($user->account_setting && $user->account_setting->password_expiry_days == '60') {{ 'checked' }} @endif>
                                        <label class="form-check-label" for="days_60">Renew every 60 days</label>
                                    </div>
                                    <div class="form-radio">
                                        <input class="" name="password_expiry_days" type="radio" value="90"
                                            id="days_90" @if ($user->account_setting && $user->account_setting->password_expiry_days == '90') {{ 'checked' }} @endif>
                                        <label class="form-check-label" for="days_90">Renew every 90 days</label>
                                    </div>
                                </div>

                                <div class="card-note">
                                    <span class="note-icon">i</span>
                                    <p><i>Unless you set your preferred Password Expiry, by default your password will
                                            renew every30 days.</i></p>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mt-4">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" stroke="currentColor"
                                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />

                                            <path d="M10 21h4" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>Notification</h2>
                                    </div>
                                </div>

                                <div class="radio-options">
                                    <div class="form-check m-0">
                                        <input class="form-check-input" name="is_text_notificaion_on" type="checkbox"
                                            id="Text" value="1"
                                            @if ($user->account_setting && $user->account_setting->is_text_notificaion_on == '1') {{ 'checked' }} @endif>
                                        <label class="form-check-label" for="Text">Text</label>
                                    </div>
                                    <div class="form-check m-0">
                                        <input class="form-check-input" name="is_email_notificaion_on" type="checkbox"
                                            id="Emails" value="1"
                                            @if ($user->account_setting && $user->account_setting->is_email_notificaion_on == '1') {{ 'checked' }} @endif>
                                        <label class="form-check-label" for="Emails">Email</label>
                                    </div>
                                </div>


                                <div class="pt-1">
                                    <i id="emailHelp"></i>
                                </div>

                                <div class="card-note">
                                    <span class="note-icon">i</span>
                                    <p><i>If you select to be notified of your impending password expiry by Text or
                                            Email, you will receive a notification 24 hours prior to expiry date.</i></p>
                                </div>
                            </div>
                        



                        <div class="common-footer">
                            <input type="submit" value="Save" class="common-save-btn" name="submit">
                        </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

    <script>
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
    <script type="text/javascript">
        $('#userProfile').parsley({

        });

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
                        if (data.status == true) {
                            $('input[type=password]').each(function() {
                                $(this).val('');
                            });
                            showAlert('success','', data.message);
                            //swal_success_popup(data.message);
                            // Reload page after 3 seconds to reflect changes
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            // Show error using the message from server
                            showAlert('error', 'Error', data.message || 'Something went wrong.');
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
                        showAlert('error', 'Error', errorMsg || 'Something went wrong.');
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
                        if (data.status == true) {
                            $('input[type=password]').each(function() {
                                $(this).val('');
                            });
                            showAlert('success','', data.message);
                            // swal_success_popup(data.message);
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            showAlert('error', 'Error', data.message || 'Something went wrong.');
                        }
                    },
                    error: function(data) {
                        let errorsHtml = '<ul>';
                        $.each(data.responseJSON.errors, function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul>';
                        showAlert('error', 'Error', errorsHtml || 'Something went wrong.');
                    }
                });
            }
        });
    </script>
@endpush
