
@php
use Carbon\Carbon;

$open_pop_up = false;
$password_updated_date = "";
$password_expiry_days = "";
$submit_url = "";

if (auth()->check()) 
{
   
            $user = auth()->user();
   
            // First login check (assuming user first time come)

            if($user->type==5)
            $open_pop_up = $user?->account_setting?->is_first_login === "1";
            
            if($user->type==1)
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

            if( $user->type==6)
            $submit_url  = 'staff.update-password';

            if( $user->type==1)
            $submit_url  = 'admin.change.password';
    
}
@endphp





@if($open_pop_up)
<div class="modal fade" id="change_Password_Modal" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" id="changePasswordLabel" style="color:white">
                    {{-- <i class="fa fa-key fa-lg fa-fw" style="color: white;"></i> --}}
                    <img src="{{asset('assets/dashboard/img/reset-password.png')}}" alt="" class="custompopicon">
                    Change Password  
                </h5>


               
                <button type="button" class="close expiry-password-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
             
                

            </div>

            <form method="POST" name="change_Password_Modal" action="{{ route($submit_url) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group toogle_eye_form_wrap">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="modal_current_password" id="modal_current_password" class="form-control"
                            placeholder="Enter current password">
                             <span class="text-danger error-current_password"></span>
                              <span class="toogle-eye-password" toggle="#modal_current_password">
                                <i class="fa fa-eye"></i>
                            </span>
                    </div>
                    <div class="form-group toogle_eye_form_wrap">
                        <label for="new_password">New Password</label>
                        <input type="password" name="modal_new_password" id="modal_new_password" class="form-control"
                            placeholder="Enter new password">
                             <span class="text-danger error-new_password"></span>
                             <span class="toogle-eye-password" toggle="#modal_new_password"><i class="fa fa-eye"></i></span>

                                <div id="password-strength" style="margin-top:6px;">
                                    <div id="strength-bar" style="height:6px; background:#ddd; border-radius:4px; overflow:hidden;">
                                        <div id="strength-fill" style="height:100%; width:0%; background:red; transition:0.3s;"></div>
                                    </div>
                                    <small id="strength-text" style="font-size:12px; color:#555;"></small>
                                </div>

                    </div>
                    <div class="form-group toogle_eye_form_wrap">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" name="modal_new_password_confirmation" id="modal_new_password_confirmation"
                            class="form-control" placeholder="Re-enter new password">
                             <span class="text-danger error-new_password_confirmation"></span>
                             <span class="toogle-eye-password" toggle="#modal_new_password_confirmation"><i class="fa fa-eye"></i></span>
                    </div>
                </div>

                <div class="modal-footer">
                   
                    <button type="submit" class="btn-success-modal">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@section('script')
@if($open_pop_up)
<script>
    $(document).ready(function() {

        var passwordStrengthLevel = 0;
        var passwordsMatch = false;
        var user_id = "{{ auth()->user()->id }}";

        $('#password-strength').css('display', 'none');

    
        let closedUntil = localStorage.getItem("popup_closed_until_" + user_id);
        closedUntil = closedUntil ? parseInt(closedUntil) : null;
        console.log('closedUntil',closedUntil);

        $(document).on("click", ".expiry-password-close", function () {
            let expire = new Date();
            expire.setHours(expire.getHours() + 168);  
            //expire.setMinutes(expire.getMinutes() + 1);
           localStorage.setItem("popup_closed_until_" + user_id, expire.getTime());
            
        });
        if (!closedUntil || Date.now() > closedUntil) {
        $("#change_Password_Modal").modal({backdrop: 'static',keyboard: false});
        }


        

        $(document).on('submit', 'form[name="change_Password_Modal"]', function(e) 
        {
            e.preventDefault(); 
            let form = $(this);
            let formData = new FormData(this);

            var modal_current_password = $("#modal_current_password").val();
            var modal_new_password = $("#modal_new_password").val();
            var modal_new_password_confirmation = $("#modal_new_password_confirmation").val();
            

            var myform = false;

            if (modal_current_password.length === 0) {
                $("#modal_current_password").css("border", "1px solid #dc3545");
                myform = false;
            }
            else{
                myform = true;
            }

            if (modal_new_password.length === 0) {
                $("#modal_new_password").css("border", "1px solid #dc3545");
                myform = false;
            }
            else {
                myform = true;
            }

            if (modal_new_password_confirmation.length === 0) {
                $("#modal_new_password_confirmation").css("border", "1px solid #dc3545");
                myform = false;
            }
            else{
                myform = true;
            }

            
            if (passwordStrengthLevel < 3) {
                $("#modal_new_password").css("border", "1px solid #dc3545");
                myform = false;
            }
            else {
            myform = true;
            }

            if (!passwordsMatch) {
                $("#modal_new_password_confirmation_val").css("border", "1px solid #dc3545");
                myform = false;
            }
            else {
            myform = true;
            }

            console.log('myform',myform);

            if(!myform)
            return false;    


            formData.append("current_password", formData.get("modal_current_password"));
            formData.append("new_password", formData.get("modal_new_password"));
            formData.append("new_password_confirmation", formData.get("modal_new_password_confirmation"));

        
            formData.delete("modal_current_password");
            formData.delete("modal_new_password");
            formData.delete("modal_new_password_confirmation");


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


        document.querySelectorAll('.toogle-eye-password').forEach(function(el) {
            el.addEventListener('click', function() {
                var selector = this.getAttribute('toggle');
                var root = this.closest('.modal, body');  // search inside modal first
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


        $(document).on("input", "#modal_new_password", function () {

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
                    strengthFill.css({ "width": "0%", "background": "red" });
                    strengthText.text("Enter a password");
                    break;

                case 1:
                    strengthFill.css({ "width": "20%", "background": "#ff4d4d" });
                    strengthText.text("Very Weak");
                    break;

                case 2:
                    strengthFill.css({ "width": "35%", "background": "#ff884d" });
                    strengthText.text("Weak");
                    break;

                case 3:
                    strengthFill.css({ "width": "55%", "background": "#ffcc00" });
                    strengthText.text("Medium");
                    break;

                case 4:
                    strengthFill.css({ "width": "70%", "background": "#9acd32" }); 
                    strengthText.text("Strong");
                    break;

                case 5:
                    strengthFill.css({ "width": "90%", "background": "#4caf50" }); 
                    strengthText.text("Very Strong");
                    break;

                case 6:
                    strengthFill.css({ "width": "100%", "background": "#2e7d32" }); 
                    strengthText.text("Excellent");
                    break;
            }
        });

        $(document).on("input", "#modal_current_password", function () {
            let current_password  = $("#modal_current_password").val();
            if (current_password.length === 0) {
            $("#modal_current_password").css("border", "1px solid #dc3545");
            }
            else{
            $("#modal_current_password").css("border", "1px solid #ced4da");
            }
        })

        $(document).on("input", "#modal_new_password_confirmation", function () {
            let current_password  = $("#modal_new_password_confirmation").val();
            if (current_password.length === 0) {
            $("#modal_new_password_confirmation").css("border", "1px solid #dc3545");
            }
            else{
            $("#modal_new_password_confirmation").css("border", "1px solid #ced4da");
            }
        })

        $(document).on("input", "#modal_new_password, #modal_new_password_confirmation", function () {

            let pass  = $("#modal_new_password").val();
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
@endif
@endsection