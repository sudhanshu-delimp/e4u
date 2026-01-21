@extends('layouts.operator')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec opr-console">
   <!--middle content start here-->
   <div class="row">
            <div class="col-md-12 commanAlert"></div>
       </div>
      {{-- Page Heading   --}}
      <div class="row">
         <div class="operator-heading-wrapper col-lg-12">
            <h1 class="h1">Change password</h1>
            <span class="oprhelpNote font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
         </div>
         <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
               <div class="card-body">
                  <p class="notes"><b>Notes:</b> </p>
                  <ol>
                    <li>Use this feature to change your Password and to set up your Password preferences.</li>
                    <li>Your Password, unless you change the settings, will by default expire every 30 days.
                        You will be notified before the expiry date.
                    </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      {{-- end --}}
 

        


<div class="row">
    <div class="col-md-12 mb-5">
      <form class="v-form-design" id="userProfile" action="{{ route('operator.update.password')}}" method="POST">
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
                            <div class="pt-1">
                                <small><i>Case sensitive</i></small>
                            </div>
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
                            <small class="form-text text-muted"></small>
                            <div class="pt-1">
                                <small><i>Must be a minimum of eight (8) characters long</i></small>
                            </div>
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
        <button type="submit" class="opr-common-btn" name="submit">Save Password</button>
         </form>
    

         <form class="v-form-design" id="passwordExpiry" action="{{ route('agent.update.password.expiry')}}" method="POST">          
            <div class="col-md-12 p-0 mt-4">
               <div class="form-group mb-0">
                  <label for="confirm_password">Password Expiry </label>
               </div>
               <div class="form-radio">
                  <input class="" name="password_expiry_days"  type="radio" value="never">
                  <label class="form-check-label" for="flexCheckDefault">Never</label>
               </div>
               <div class="form-radio">
                  <input class="" name="password_expiry_days"  type="radio" value="30" checked>
                  <label class="form-check-label" for="flexCheckDefault">Renew every 30 days</label>
               </div>
               <div class="form-radio">
                  <input class="" name="password_expiry_days" type="radio" value="60" >
                  <label class="form-check-label" for="flexCheckDefault">Renew every 60 days</label>
               </div>
               <div class="form-radio">
                  <input class="" name="password_expiry_days"  type="radio" value="90">
                  <label class="form-check-label" for="flexCheckDefault">Renew every 90 days</label>
               </div>
               <div class="pt-1">
                    <i id="emailHelp">Unless you set your preferred Password Expiry, by default your password will renew every 30 days.</i>
               </div>
               
            </div>
            <div class="col-md-12 p-0 mt-4">
               <div class="form-group mb-0">
                  <label for="confirm_password">Notification</label>
               </div>
               <div class="form-check m-0">
                  <input class="form-check-input" name="is_text_notificaion_on" type="checkbox" id="flexCheckDefault" >
                  <label class="form-check-label" for="flexCheckDefault">Text</label>
               </div>
               <div class="form-check m-0">
                  <input class="form-check-input" name="is_email_notificaion_on" type="checkbox" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">Email</label>
               </div>
               
               <div class="pt-1">
                <i id="emailHelp">If you select to be notified of your impending password expiry by Text or Email, you will receive a notification 24 hours prior to expiry date.
</i>
              </div>
            </div>
             <button type="submit" class="opr-common-btn mt-4" name="submit">Save</button>
         </form>


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
   
   document.querySelectorAll('.toggle-password').forEach(function (el) {
        el.addEventListener('click', function () {
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
   
   
   
   $('#userProfile').on('submit', function(e) {
      e.preventDefault();
   
      var form = $(this);
      
      $("#modal-title").text("Change Password");
      $("#modal-icon").attr("src", "/assets/dashboard/img/change-password.png");
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

                        $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-success" >${response.message}</div>`);
                        setTimeout(function () {
                           location.reload();
                        }, 3000); 
                     } 
                     else {
                      $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-error" >${response.message}</div>`);    
                     }
               },
         });
       }
   });
   $('#passwordExpiry').on('submit', function(e) {
       e.preventDefault();
   
       var form = $(this);
      
      $("#modal-title").text("Renew Password Expiry");
      $("#modal-icon").attr("src", "/assets/dashboard/img/renew.png");
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

                        $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-success" >${data.message}</div>`);
                        setTimeout(function () {
                           location.reload();
                        }, 3000); 
                     } 
                     else {
                     $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-success" >${data.message}</div>`);
                     }
               },
   
           });
       }
   });
   
   
   
   
   
</script>
@endpush