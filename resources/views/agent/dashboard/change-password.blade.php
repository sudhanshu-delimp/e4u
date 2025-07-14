@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec">
   <!--middle content start here-->
      {{-- Page Heading   --}}
      <div class="row">
         <div class="custom-heading-wrapper col-lg-12">
            <h1 class="h1">Change password</h1>
            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
         </div>
         <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
               <div class="card-body">
                  <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                  <ol>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      {{-- end --}}
   <div class="row">
      <div class="col-md-12 mb-5">
         <form class="v-form-design" id="userProfile" action="{{ route('agent.update.password')}}" method="POST">
            <div class="row">
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="current_password">Current Password</label>
                           <input type="password" class="form-control" name="password" placeholder="Current Password" data-parsley-required-message="Current password is required" required>
                           <div id="formerror"></div>
                           <small id="emailHelp" class="form-text text-muted">Case sensitive</small>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="new_password">New Password</label>
                           <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" aria-describedby="emailHelp" required autocomplete="new-password" data-parsley-required-message="Current password is required" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                           <div class="termsandconditions_text_color">
                              <!-- error sms here -->
                           </div>
                           <small id="emailHelp" class="form-text text-muted">MUST be a minimum of Eight (8) characters long</small>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="confirm_password">Confirm Password</label>
                           <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" aria-describedby="emailHelp" name="password_confirmation" data-parsley-equalto="#new_password" data-parsley-equalto-message="Confirm password should be the same password" required autocomplete="new-password" data-parsley-required-message="Confirm password is required">
                           <div class="termsandconditions_text_color">
                              <!-- error sms here -->
                           </div>
                        </div>
                     </div>
                     <input type="submit" value="Save Password" class="btn btn-primary shadow-none mt-2 mb-4 ml-3" name="submit">  
                     </form> 
                     <form class="v-form-design" id="passwordExpiry" action="{{ route('agent.update.password.expiry')}}" method="POST">          
                        <div class="col-md-12">
                           <div class="form-group mb-0">
                              <label for="confirm_password">Password Expiry </label>
                           </div>
                           <div class="form-radio">
                              <input class="" name="password_expiry_days"  type="radio" value="0" {{ $user->passwordSecurity->password_expiry_days == 0 ? ' checked' : null }} >
                              <label class="form-check-label" for="flexCheckDefault">Never</label>
                           </div>
                           <div class="form-radio">
                              <input class="" name="password_expiry_days"  type="radio" {{ $user->passwordSecurity->password_expiry_days == 30 ? ' checked' : null }} value="30" >
                              <label class="form-check-label" for="flexCheckDefault">Renew every 30 days</label>
                           </div>
                           <div class="form-radio">
                              <input class="" name="password_expiry_days" {{ $user->passwordSecurity->password_expiry_days == 60 ? 'checked' : null }} type="radio" value="60" >
                              <label class="form-check-label" for="flexCheckDefault">Renew every 60 days</label>
                           </div>
                           <div class="form-radio">
                              <input class="" name="password_expiry_days" type="radio" {{ $user->passwordSecurity->password_expiry_days == 90 ? ' checked' : null }} value="90" >
                              <label class="form-check-label" for="flexCheckDefault">Renew every 90 days</label>
                           </div>
                           <small id="emailHelp" class="form-text text-muted">Unless you set your preferred Password Expiry, by default your password will renew every 30 days.</small>
                        </div>
                        <div class="col-md-12 mt-3">
                           <div class="form-group mb-0">
                              <label for="confirm_password">Notification</label>
                           </div>
                           <div class="form-check">
                              <input class="form-check-input" name="password_notification[]" type="checkbox" id="flexCheckDefault" value="1" @if(isset($user->passwordSecurity->password_notification) && in_array(1,$user->passwordSecurity->password_notification)) checked @endif>
                              <label class="form-check-label" for="flexCheckDefault">Text</label>
                           </div>
                           <div class="form-check">
                              <input class="form-check-input" name="password_notification[]" type="checkbox" id="flexCheckDefault" value="2" @if(isset($user->passwordSecurity->password_notification) && in_array(2,$user->passwordSecurity->password_notification)) checked  @endif>
                              <label class="form-check-label" for="flexCheckDefault">Email</label>
                           </div>
                           <small id="emailHelp" class="form-text text-muted">If you select to be notified of your impending password expiry by Text or Email, you will receive a notification 24 hours prior to expiry date.</small>
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary shadow-none mt-4 mb-4 ml-3" name="submit">
                     </form>
                  </div>
               </div>
            </div>
            
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
<script type="text/javascript">
   $('#userProfile').parsley({
   
   });
   
   
   
   $('#userProfile').on('submit', function(e) {
      e.preventDefault();
   
      var form = $(this);
   
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
                 if (data.error == true) {
                   var msg = "Saved";
                   $('.comman_msg').text(msg);
                   //$("#my_account_modal").show();
                   $("#comman_modal").modal('show');
                   $("#userProfile").trigger("reset");
                   //location.reload();
   
                 } else {
                   // $('.comman_msg').html("Please enter your correct current password");
                   // $("#comman_modal").modal('show');
                   errorsHtml = '<ul class="parsley-errors-list filled">';
                   errorsHtml += '<li class="parsley-required">Invalid current Password</li>'; //showing only the first error.
                   errorsHtml += '</ul></di>';
                   $('#formerror').html(errorsHtml);
   
                 }
               },
   
           });
       }
   });
   $('#passwordExpiry').on('submit', function(e) {
       e.preventDefault();
   
       var form = $(this);
   
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
                 if (data.error == true) {
                   var msg = "Saved";
                   $('.comman_msg').text(msg);
                   //$("#my_account_modal").show();
                   $("#comman_modal").modal('show');
                   $("#userProfile").trigger("reset");
                   //location.reload();
   
                 } else {
                   // $('.comman_msg').html("Please enter your correct current password");
                   // $("#comman_modal").modal('show');
                   errorsHtml = '<ul class="parsley-errors-list filled">';
                   errorsHtml += '<li class="parsley-required">Invalid current Password</li>'; //showing only the first error.
                   errorsHtml += '</ul></di>';
                   $('#formerror').html(errorsHtml);
   
                 }
               },
   
           });
       }
   });
   
   
   
   
   
</script>
@endpush