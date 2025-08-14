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
</style>
@stop

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec">
         <div class="row">
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Change Password</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>

            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                  <div class="card-body">
                     <p class="mb-2 font-weight-bold" style="font-size: 18px;">Notes:</p>
                     <ol>
                        <li>Use this feature to change your Password and to set up your Password preferences.</li>
                        <li>Your Password, unless you change the settings, will by default expire every 30 days. You will be notified before the expiry date.</li>
                     </ol>
                  </div>
               </div>
            </div>

            <div class="col-md-6 mb-5">
               <!-- Change Password Form -->
               <form class="v-form-design" id="userProfile" action="{{ route('center.update.password') }}" method="POST" novalidate>
                  @csrf
                  <div class="form-group position-relative">
                     <label for="current_password">Current Password</label>
                     <input type="password" class="form-control" name="password" id="current_password" placeholder="Current password"
                        data-parsley-required-message="Current password is required" required>
                        <span class="toggle-password" toggle="#current_password">
                          <i class="fa fa-eye"></i>
                      </span>
                     <div id="formerror"></div>
                     <small class="form-text text-muted">Case sensitive</small>
                  </div>

                  <div class="form-group position-relative">
                     <label for="new_password">New Password</label>
                     <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password"
                        required autocomplete="new-password"
                        data-parsley-required-message="Password is required"
                        data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/"
                        data-parsley-pattern-message="Password must be 8+ characters, include uppercase, lowercase, number, and special character.">
                        <span class="toggle-password" toggle="#new_password">
                          <i class="fa fa-eye"></i>
                      </span>
                     <small class="form-text text-muted">Must be a minimum of 8 characters long</small>
                  </div>

                  <div class="form-group position-relative">
                     <label for="confirm_password">Confirm Password</label>
                     <input type="password" class="form-control" name="password_confirmation" id="confirm_password"
                        placeholder="Confirm password" required autocomplete="new-password"
                        data-parsley-equalto="#new_password"
                        data-parsley-equalto-message="Confirm password must match.">
                        <span class="toggle-password" toggle="#confirm_password">
                          <i class="fa fa-eye"></i>
                      </span>
                  </div>

                  <input type="submit" value="Save Password" class="btn btn-primary shadow-none mt-3">
               </form>

               <hr class="my-4">

               <!-- Password Expiry Settings -->
               <form class="v-form-design" id="passwordExpiry" action="{{ route('center.update.password.expiry') }}" method="POST">
                  @csrf
                  <div class="form-group">
                     <label>Password Expiry</label>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="password_expiry_days" value="0"
                           {{ $user->passwordSecurity->password_expiry_days == 0 ? 'checked' : '' }}>
                        <label class="form-check-label">Never</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="password_expiry_days" value="30"
                           {{ $user->passwordSecurity->password_expiry_days == 30 ? 'checked' : '' }}>
                        <label class="form-check-label">Renew every 30 days</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="password_expiry_days" value="60"
                           {{ $user->passwordSecurity->password_expiry_days == 60 ? 'checked' : '' }}>
                        <label class="form-check-label">Renew every 60 days</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="password_expiry_days" value="90"
                           {{ $user->passwordSecurity->password_expiry_days == 90 ? 'checked' : '' }}>
                        <label class="form-check-label">Renew every 90 days</label>
                     </div>
                     <small class="form-text text-muted">Default expiry is 30 days unless changed.</small>
                  </div>

                  <div class="form-group mt-4">
                     <label>Notification</label>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="password_notification[]" value="1"
                           {{ isset($user->passwordSecurity->password_notification) && in_array(1, $user->passwordSecurity->password_notification) ? 'checked' : '' }}>
                        <label class="form-check-label">Text</label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="password_notification[]" value="2"
                           {{ isset($user->passwordSecurity->password_notification) && in_array(2, $user->passwordSecurity->password_notification) ? 'checked' : '' }}>
                        <label class="form-check-label">Email</label>
                     </div>
                     <small class="form-text text-muted">You will be notified 24 hours before password expiry.</small>
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

$('#userProfile').on('submit', function(e) {
   e.preventDefault();
   var form = $(this);
   if (form.parsley().isValid()) {
      $.ajax({
         method: form.attr('method'),
         url: form.attr('action'),
         data: new FormData(form[0]),
         contentType: false,
         processData: false,
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         success: function(data) {
            if (data.error == true) {
               $('.comman_msg').text("Saved");
               $("#comman_modal").modal('show');
               $('input[type=password]').val('');
            } else {
               $('#formerror').html('<ul class="parsley-errors-list filled"><li class="parsley-required">Invalid current Password</li></ul>');
            }
         }
      });
   }
});

$('#passwordExpiry').on('submit', function(e) {
   e.preventDefault();
   var form = $(this);
   $.ajax({
      method: form.attr('method'),
      url: form.attr('action'),
      data: new FormData(form[0]),
      contentType: false,
      processData: false,
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      success: function(data) {
         if (data.error == true) {
            $('.comman_msg').text("Saved");
            $("#comman_modal").modal('show');
         } else {
            $('#formerror').html('<ul class="parsley-errors-list filled"><li class="parsley-required">Something went wrong. Try again.</li></ul>');
         }
      }
   });
});
</script>

<script>
  document.querySelectorAll('.toggle-password').forEach(function (el) {
      el.addEventListener('click', function () {
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
