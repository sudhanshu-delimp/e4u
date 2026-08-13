@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
            align-items: center;
        }

        .swal-footer {
            display: flex;
            justify-content: center;
            /* horizontally center */
            align-items: center;
            /* vertically center */
            padding: 20px;
            /* optional spacing */
        }

        .swal-button-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swal-button--ok {
            /* background-color: #3085d6; */
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .swal-button:not([disabled]):hover {
            background-color: #ff3c5f;
        }


        .toggle-password {
            position: absolute;
            top: 28px;
            right: 15px;
            cursor: pointer;
            z-index: 2;
            color: #6c757d;
        }

        form.v-form-design label {
            font-weight: 500;
        }
    </style>
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec">
                <!--middle content start here-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Change password </h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="mb-4 col-md-12">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>

                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- ALERT MESSAGE -->
                    <div class="col-md-12 mb-3">
                        <div id="profileAlert" class="alert d-none rounded" role="alert"></div>
                    </div>
                        <div class="col-md-12">
                            <div id="globalAlert" class="alert d-none rounded w-100" role="alert"></div>
                        </div>
                    <div class="col-md-12 mb-5">
                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success text-left">
                                {{ session('success') }}
                            </div>
                        @endif


                        <div class="common-grid">

                            <div class="common-card">
                                <form id="userProfile" action="{{ route('admin.update.password') }}" method="POST"
                                    autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group cp-field">
                                                <label for="current_password">Current password</label>
                                                <div class="cp-input-wrap">
                                                    <input type="password" value="{{ old('password') }}"
                                                        autocomplete="current-password" name="current_password"
                                                        id="passwordN"
                                                        placeholder="{{ config('constants.current_password_placeholder') }}"
                                                        data-parsley-required-message="Current password is required"
                                                        required>
                                                    <button type="button" class="cp-eye-btn toggle-password"
                                                        toggle="#passwordN">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                <p class="cp-hint">
                                                    <small><i>{{ config('constants.current_password_notify') }}</i></small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group cp-field">
                                                <label for="new_password">New password</label>
                                                <div class="cp-input-wrap">
                                                    <input type="password" required value="{{ old('new_password') }}"
                                                        name="new_password" id="new_password" placeholder="New password"
                                                        aria-describedby="emailHelp" required autocomplete="new-password"
                                                        data-parsley-required-message="Password is required"
                                                        data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&amp;*?])[A-Za-z\d#$@!%&amp;*?]{8,30}$/"
                                                        data-parsley-pattern-message="Password must be of at least 8 character, must contain both upper-case and lower-case character, at least one number and special character">
                                                    <button type="button" class="cp-eye-btn toggle-password"
                                                        toggle="#new_password">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="termsandconditions_text_color">
                                                    @error('new_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <p class="cp-hint">
                                                    <small><i>Must be a minimum of eight (8) characters
                                                            long</i></small>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Confirm Password -->
                                        <div class="col-md-12">
                                            <div class="form-group cp-field">
                                                <label for="confirm_password">Confirm password</label>
                                                <div class="cp-input-wrap">
                                                    <input type="password" placeholder="Confirm password"
                                                        id="confirm_password" name="new_password_confirmation"
                                                        data-parsley-equalto="#new_password"
                                                        data-parsley-equalto-message="Confirm password should be the same password"
                                                        required autocomplete="confirm-password"
                                                        data-parsley-required-message="Confirm password is required">
                                                    <button type="button" class="cp-eye-btn toggle-password"
                                                        toggle="#confirm_password">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="termsandconditions_text_color"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="common-footer">
                                    <input type="submit" value="Save Password" class="common-save-btn"
                                        name="submit"></div>
                                </form>
                            </div>




                            <div class="common-card">
                                <form id="passwordExpiry" action="{{ route('admin.update.password.expiry') }}"
                                    method="POST">
                                    <div class="col-md-12 p-0 mt-4">
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
                                                <label class="form-check-label" for="Day_30">Renew every 30 days</label>
                                            </div>
                                            <div class="form-radio">
                                                <input class="" name="password_expiry_days" type="radio"
                                                    value="60" id="Day_60"
                                                    @if ($user->account_setting && $user->account_setting->password_expiry_days == '60') {{ 'checked' }} @endif>
                                                <label class="form-check-label" for="Day_60">Renew every 60 days</label>
                                            </div>
                                            <div class="form-radio">
                                                <input class="" name="password_expiry_days" type="radio"
                                                    value="90" id="Day_90"
                                                    @if ($user->account_setting && $user->account_setting->password_expiry_days == '90') {{ 'checked' }} @endif>
                                                <label class="form-check-label" for="Day_90">Renew every 90 days</label>
                                            </div>
                                            <div class="card-note">
                                                <span class="note-icon">i</span>
                                                <p> <i>Unless you set your preferred Password Expiry, by default
                                                        your password will renew every 30 days.</i></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 p-0 mt-4">
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
                                        <div class="card-note">
                                            <span class="note-icon">i</span>
                                            <p> <i>If you select to be notified of your impending password
                                                    expiry by
                                                    Text or Email, you will receive a notification 24 hours prior to expiry
                                                    date.</i></p>
                                        </div>

                                    </div>
                                    <div class="common-footer">
                                        <button type="submit" class="common-save-btn" name="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--middle content end here-->
            </div>
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade upload-modal" id="success_popup" tabindex="-1" aria-labelledby="confirmPopupLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/unblock.png') }}" alt="resolved" class="custompopicon">
                        <span class="success-modal-title">Password</span>
                    </h5>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"
                        style="background: none; border: none;">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h6 class="popu_heading_style mt-2">
                        <span class="Lname success-modal-text resMsg"> </span>
                    </h6>
                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn-success-modal" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
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
        var notes = $('#notes');

        function showGlobalAlert(message, type = 'success') {
            const alertBox = $('#globalAlert');
            $('html, body').animate({
                scrollTop: notes.offset()
                    .top // Get the top offset of the target div
            }, 500);
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
                            showGlobalAlert(data.message, "success");
                            // Reload page after 3 seconds to reflect changes
                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            // Show error using the message from server
                            showGlobalAlert(data.message, "danger");
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
                        showGlobalAlert(errorMsg, "danger");

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
                        console.log(data.message, 'data');
                        if (data.status === true) {
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
                                showGlobalAlert(errorMsg, "danger");
                            } catch (e) {
                                // Not JSON, keep the generic message
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
