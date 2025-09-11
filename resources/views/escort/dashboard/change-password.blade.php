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
            <span class="helpNoteLink collapsed" data-toggle="collapse" data-target="#notes" aria-expanded="false"><b>Help?</b></span>
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
            <div class="col-md-12">
                <form class="v-form-design" id="userProfile" action="{{ route('escort.update.password')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
    
                    <!-- Current Password -->
                    <div class="col-md-12">
                        <div class="form-group position-relative">
                            <label for="current_password">Current password</label>
                            <input type="password" class="form-control" name="password" id="current_password" placeholder="Current password" data-parsley-required-message="Current password is required" required>
                            <span class="toggle-password" toggle="#current_password">
                                <i class="fa fa-eye"></i>
                            </span>
                            <small class="form-text text-muted">Case sensitive</small>
                        </div>
                    </div>
    
                    <!-- New Password -->
                    <div class="col-md-12">
                        <div class="form-group position-relative">
                            <label for="new_password">New password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password" required autocomplete="new-password"
                                data-parsley-required-message="Current password is required"
                                data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                                data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                            <span class="toggle-password" toggle="#new_password">
                                <i class="fa fa-eye"></i>
                            </span>
                            <div class="termsandconditions_text_color"></div>
                            <small class="form-text text-muted">MUST be a minimum of eight (8) characters long</small>
                        </div>
                    </div>
    
                    <!-- Confirm Password -->
                    <div class="col-md-12">
                        <div class="form-group position-relative">
                            <label for="confirm_password">Confirm password</label>
                            <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" name="password_confirmation"
                                data-parsley-equalto="#new_password"
                                data-parsley-equalto-message="Confirm password should be the same password"
                                required autocomplete="new-password"
                                data-parsley-required-message="Confirm password is required">
                            <span class="toggle-password" toggle="#confirm_password">
                                <i class="fa fa-eye"></i>
                            </span>
                            <div class="termsandconditions_text_color"></div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
        <input type="submit" value="Save Password" class="btn btn-primary shadow-none" name="submit">
    </form>
             </div>


             <form class="v-form-design" id="passwordExpiry" action="{{ route('escort.update.password.expiry')}}" method="POST">          
              <div class="col-md-12 p-0 mt-4">
                <div class="form-group mb-0">
                    <label for="confirm_password">Password Expiry </label>
                </div>
                <div class="form-radio">
                    <input class="" name="password_expiry_days"  type="radio" value="never" @if($user->account_setting && $user->account_setting->password_expiry_days=='never') {{  'checked'  }}  @endif>
                    <label class="form-check-label" for="flexCheckDefault">Never</label>
                </div>
                <div class="form-radio">
                    <input class="" name="password_expiry_days"  type="radio" value="30"  @if($user->account_setting && $user->account_setting->password_expiry_days=='30') {{  'checked'  }}  @endif >
                    <label class="form-check-label" for="flexCheckDefault">Renew every 30 days</label>
                </div>
                <div class="form-radio">
                    <input class="" name="password_expiry_days" type="radio" value="60"  @if($user->account_setting && $user->account_setting->password_expiry_days=='60') {{  'checked'  }}  @endif  >
                    <label class="form-check-label" for="flexCheckDefault">Renew every 60 days</label>
                </div>
                <div class="form-radio">
                    <input class="" name="password_expiry_days"  type="radio" value="90" @if($user->account_setting && $user->account_setting->password_expiry_days=='90') {{  'checked'  }}  @endif  >
                    <label class="form-check-label" for="flexCheckDefault">Renew every 90 days</label>
                </div>
                <small id="emailHelp" class="form-text text-muted">Unless you set your preferred Password Expiry, by default your password will renew every30 days.</small>
              </div>
              <div class="col-md-12 p-0 mt-4">
                <div class="form-group mb-0">
                    <label for="confirm_password">Notification</label>
                </div>
                <div class="form-check m-0">
                    <input class="form-check-input" name="is_text_notificaion_on" type="checkbox" id="flexCheckDefault" value="1" @if($user->account_setting && $user->account_setting->is_text_notificaion_on=='1') {{  'checked'  }}  @endif>
                    <label class="form-check-label" for="flexCheckDefault">Text</label>
                </div>
                <div class="form-check m-0">
                    <input class="form-check-input" name="is_email_notificaion_on" type="checkbox" id="flexCheckDefault" value="1" @if($user->account_setting && $user->account_setting->is_email_notificaion_on=='1') {{  'checked'  }}  @endif>
                    <label class="form-check-label" for="flexCheckDefault">Email</label>
                </div>
                <small id="emailHelp" class="form-text text-muted">If you select to be notified of your impending password expiry by Text or Email, you will receive a notification 24 hours prior to expiry date.</small>
              </div>
              <input type="submit" value="Save" class="btn btn-primary shadow-none mt-4" name="submit">
          </form>


        </div>
    </div>


    <!--middle content end here-->
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
               success: function(data) 
               {
                     if (data.error != true) {
                        $('input[type=password]').each(function() {
                        $(this).val('');
                        });

                        swal_success_popup(data.message);
                        setTimeout(function () {
                           location.reload();
                        }, 3000); 
                     } 
                     else {
                     swal_error_popup(data.message);
                     }
               },
                error: function(data) {
                    let errorsHtml = '<ul>';
                    $.each(data.responseJSON.errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul>';
                    showGlobalAlert(errorsHtml, "danger");
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
               success: function(data) 
               {
                     if (data.error != true) {
                        $('input[type=password]').each(function() {
                        $(this).val('');
                        });

                        swal_success_popup(data.message);
                        setTimeout(function () {
                           location.reload();
                        }, 3000); 
                     } 
                     else {
                     swal_error_popup(data.message);
                     }
               },
                error: function(data) {
                    let errorsHtml = '<ul>';
                    $.each(data.responseJSON.errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul>';
                    showGlobalAlert(errorsHtml, "danger");
                }
            });
        }
    });

    // old
    // $(document).ready(function(){
    //     $("#passwordN").click(function(){
    //       $('#formerror').hide();
    //     })
    // })


    // $('#userProfile').on('submit', function(e) {
    //     e.preventDefault();
    //     var form = $(this);
    //     if (form.parsley().isValid()) {

    //         var url = form.attr('action');
    //         var data = new FormData(form[0]);
    //         $.ajax({
    //             method: form.attr('method'),
    //             url: url,
    //             data: data,
    //             contentType: false,
    //             processData: false,
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function(data) {
    //                 $("#modal-title").text('Change Password');
    //                 if (data.error == true) {
    //                     var msg = "Saved";
    //                     $('.comman_msg').text(msg);
    //                     //$("#my_account_modal").show();
    //                     $("#comman_modal").modal('show');
    //                     //location.reload();
    //                      $(form)[0].reset();

    //                 } else {
    //                     // $('.comman_msg').html("Please enter your correct current password");
    //                     // $("#comman_modal").modal('show');

    //                     errorsHtml = '<ul class="parsley-errors-list filled">';
    //                     errorsHtml +=
    //                     '<li class="parsley-required">Invalid current Password</li>'; //showing only the first error.

    //                     errorsHtml += '</ul></di>';
    //                     $('#formerror').html(errorsHtml);

    //                 }
    //             },
    //             error: function(data) {

    //                 console.log("error: ", data.responseJSON.errors);


    //                 $.each(data.responseJSON.errors, function(key, value) {
    //                     errorsHtml = '<div class="alert alert-danger"><ul>';
    //                     errorsHtml += '<li>' + value +
    //                     '</li>'; //showing only the first error.
    //                 });

    //                 errorsHtml += '</ul></di>';
    //                 $('#formerror').html(errorsHtml);
    //             }

    //         });
    //     }
    // });
    // $('#passwordExpiry').on('submit', function(e) {
    //     e.preventDefault();

    //     var form = $(this);
    //     $("#modal-title").text('');
    //     if (form.parsley().isValid()) {

    //         var url = form.attr('action');
    //         var data = new FormData(form[0]);
    //         $.ajax({
    //             method: form.attr('method'),
    //             url: url,
    //             data: data,
    //             contentType: false,
    //             processData: false,
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function(data) {
    //                $("#modal-title").text('Password Expiry');
    //                 if (data.error == true) {
    //                     var msg = "Saved";
    //                     $('.comman_msg').text(msg);
    //                     //$("#my_account_modal").show();
    //                     $("#comman_modal").modal('show');
    //                    // location.reload();

    //                 } else {
    //                     // $('.comman_msg').html("Please enter your correct current password");
    //                     //             $("#comman_modal").modal('show');

    //                     errorsHtml = '<ul class="parsley-errors-list filled">';
    //                     errorsHtml +=
    //                     '<li class="parsley-required">Invalid current Password</li>'; //showing only the first error.


    //                     errorsHtml += '</ul></di>';
    //                     $('#formerror').html(errorsHtml);

    //                 }
    //             },
    //             error: function(data) {

    //                 console.log("error: ", data.responseJSON.errors);


    //                 $.each(data.responseJSON.errors, function(key, value) {
    //                     errorsHtml = '<div class="alert alert-danger"><ul>';
    //                     errorsHtml += '<li>' + value +
    //                     '</li>'; //showing only the first error.
    //                 });

    //                 errorsHtml += '</ul></di>';
    //                 $('#formerror').html(errorsHtml);
    //             }

    //         });
    //     }
    // });

    // $('#comman_modal').on('hidden.bs.modal', function() {
    //     $("#modal-title").text('');
    // });
</script>



@endpush