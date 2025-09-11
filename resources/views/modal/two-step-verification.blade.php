
<div class="modal" id="sendOtp_modal" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <form id="SendOtp" method="post" action="" >
                        @csrf
                        <div class="modal-header main_bg_color border-0">
                            <h5 class="modal-title text-white">
                                <img src="{{ asset('assets/app/img/face-lock.png') }}" style="width:40px;" alt="face-lock verification">  2FA Verification</h5>
                             <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"> -->
                            </span>
                            </button>
                        </div>

                          <div class="modal-body forgot_pass pb-1">
                            <div class="form-group label_margin_zero_for_login">
                                <div class="row text-center" style="">
                                    <div class="col-md-12">
                                        <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png') }}" class="img-fluid" alt="logo"></a>
                                    </div>
                                </div>
                                <h4 class="welcome_sub_login_heading text-center pt-4 pb-2"><strong>Account Protection</strong></h4>
                                <ol class="pb-2 pl-3 text-justify">
                                    <li>To help keep your account safe, E4U wants to make sure it is really you trying to
                                        log in.</li>
                                    <li>We have sent you your verification code according to your preference, please
                                        insert your verification code.</li>
                                </ol>
                               
                                    <!-- <div class="d-flex align-items-center justify-content-between gap-10">
                                        <input type="password" maxlength="6" required class="form-control w-75" name="otp" id="otp" aria-describedby="emailHelp" placeholder="Enter One Time Password" data-parsley-required-message="One Time Password is required">
                                        <button type="submit" class="otp-verify-btn w-25" id="sendOtpSubmit">Verify</button>
                                    </div> -->

                                    <div class="d-flex flex-column align-items-center gap-3">
                                        <div class="d-flex gap-2 mb-4">
                                            <input type="text" maxlength="1" class="form-control otp-input text-center" />
                                            <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                            <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                            <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                            <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                            <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                        </div>

                                        <!-- hidden field to store final OTP -->
                                        <input type="hidden" maxlength="6" required class="form-control w-75" name="otp" id="otp">
                                        

                                        <img src="http://e4u.local/assets/app/img/circle-loader.gif" class="wait-loader" style="width: 60px;margin-bottom:18px;display:none;" alt="face-lock verification">
                                        <button type="submit" class="otp-verify-btn w-25" id="sendOtpSubmit">Verify</button>
                                    </div>



                                {{-- <input type="password" maxlength="4" required class="form-control" name="otp" id="otp" aria-describedby="emailHelp" placeholder="Enter One Time Password" data-parsley-required-message="One Time Password is required"> --}}

                                <div class="termsandconditions_text_color">
                                    @error('opt')

                                            {{ $message }}
                                    @enderror

                                </div>
                                <input type="hidden" name="phone" id="phoneId" value="">

                            </div>
                            <div id="senderror" class="text-center">
                            </div>
                        </div>

                        
                        <div class="modal-footer forgot_pass pt-0 pb-4">

                                    <p id="otpTimerMsg" class="pt-2 text-muted" style="color:brown !important"></p>
                                    <p id="resendLine" class="pt-2" style="display: none;">
                                        Not received your verification code?
                                        <a href="#" id="resendOtpSubmit" class="termsandconditions_text_color">Resend Code</a>
                                    </p>

                                    
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>





<script>
const otpInputs = document.querySelectorAll(".otp-input");
const hiddenOtp = document.getElementById("otp");

function updateHiddenOtp() {
    let otp = "";
    otpInputs.forEach(input => otp += input.value);
    hiddenOtp.value = otp;

    if (otp.length === 6) {
        document.getElementById("sendOtpSubmit").click();
    }
}

otpInputs.forEach((input, index) => {
    input.addEventListener("input", () => {
        if (input.value.length === 1 && index < otpInputs.length - 1) {
            otpInputs[index + 1].focus(); 
        }
        updateHiddenOtp(); 
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !input.value && index > 0) {
            otpInputs[index - 1].focus(); 
        }
        setTimeout(updateHiddenOtp, 10); 
    });
});  

document.addEventListener("DOMContentLoaded", function () {
    const timerEl = document.getElementById("otpTimerMsg");
    const resendEl = document.getElementById("resendLine");

    let seconds = 120; 

    function startOtpTimer() {
        resendEl.style.display = "none";
        timerEl.style.display = "block";

        const timer = setInterval(function () {
            const min = String(Math.floor(seconds / 60)).padStart(2, '0');
            const sec = String(seconds % 60).padStart(2, '0');
            timerEl.innerHTML = `If you have not received the OTP, please wait  <span style="color:#097969; font-size:18px;"> ${min}:${sec} sec </span> to resend it`;

            if (seconds <= 0) {
                clearInterval(timer);
                timerEl.style.display = "none";
                resendEl.style.display = "block";
            }
            seconds--;
        }, 1000);
    }

    startOtpTimer();

    document.getElementById("resendOtpSubmit").addEventListener("click", function (e) {
        e.preventDefault();
        $('#resendLine').css({'display':'none'});
        seconds = 120;
        startOtpTimer();
    });
});


otpInputs.forEach((input, index) => {
    input.addEventListener("input", () => {
       
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value.length === 1 && index < otpInputs.length - 1) {
            otpInputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if (
            ![ "Backspace", "Tab", "ArrowLeft", "ArrowRight", "Delete" ].includes(e.key) &&
            !/^[0-9]$/.test(e.key)
        ) {
            e.preventDefault();
        }
    });
});
</script>