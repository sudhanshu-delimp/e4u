
@php
use Carbon\Carbon;

$open_pop_up = false;
$password_updated_date = "";
$password_expiry_days = "";
$submit_url = "";

if (auth()->check()) {
    $user = auth()->user(); 

    // First login check (assuming user first time come)
    $open_pop_up = $user?->account_setting?->is_first_login === "1";

    $password_updated_date = $user?->account_setting?->password_updated_date;
    $password_expiry_days = $user?->account_setting?->password_expiry_days;

    if ($open_pop_up === false  && $password_updated_date && ($password_expiry_days!='never'))
    {
        $updatedDate = Carbon::parse($password_updated_date); 
        $expiryDate = $updatedDate->copy()->addDays($password_expiry_days); 
        if (Carbon::now()->greaterThan($expiryDate)) {
            $open_pop_up = true;
            
        }
    }

   if( $user->type==5)
    $submit_url  = 'agent.update-password';

    if( $user->type==3)
    $submit_url  = 'escort.update-password';

    if( $user->type==4)
    $submit_url  = 'center.update-password';

    if( $user->type=='0')
    $submit_url  = 'update-password';
}
@endphp






<div class="modal fade" id="change_Password_Modal" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" id="changePasswordLabel" style="color:white">
                    <i class="fa fa-key fa-lg fa-fw" style="color: white;"></i>
                  
                    Change Password 
                </h5>
                
            </div>

            <form method="POST" name="change_Password_Modal" action="{{ route($submit_url) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control"
                            placeholder="Enter current password">
                             <span class="text-danger error-current_password"></span>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control"
                            placeholder="Enter new password">
                             <span class="text-danger error-new_password"></span>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="form-control" placeholder="Re-enter new password">
                             <span class="text-danger error-new_password_confirmation"></span>
                    </div>
                </div>

                <div class="modal-footer">
                   
                    <button type="submit" class="btn-success-modal">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>


@if($open_pop_up)
<script>
    $(document).ready(function() {
    $("#change_Password_Modal").modal({backdrop: 'static',keyboard: false});
     $(document).on('submit', 'form[name="change_Password_Modal"]', function(e) 
      {
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         $('span.text-danger').text('');
         var submitUrl = {!! json_encode(route($submit_url)) !!};
         swal_waiting_popup({'title':'Updating Password'});
         $.ajax({
               url: submitUrl,
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     Swal.close();
                     $('span.text-danger').text('');
                     $('#change_Password_Modal').modal('hide');
                     swal_success_popup(response.message);
               },
               error: function(xhr) {
                  
                     Swal.close();
                     console.log(xhr);
                     if (xhr.status === 422) {
                     $('span.text-danger').text('');
                     let errors = xhr.responseJSON.errors;
                     $.each(errors, function(field, messages) {
                     $('.error-' + field).text(messages[0]); 
                     });
                     } else {
                     swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                     }
               }
         });
      });
    });
</script>
@endif