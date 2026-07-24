<div class="modal fade upload-modal {{ isset($action) ? 'on-form-action' : '' }}" id="sendOtp_modal" style="display: none" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form id="SendOtp" method="POST"
                action="{{ isset($action) ? route('validate.opt.notification', Auth::user()->id) : '#' }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/app/img/face-lock.png') }}" class="custompopicon"
                            alt="face-lock verification"> 2FA Verification
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body forgot_pass pb-1">
                    <div class="form-group label_margin_zero_for_login">
                        <div class="row text-center" style="">
                            <div class="col-md-12">
                                <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png') }}"
                                        class="img-fluid" alt="logo"></a>
                            </div>
                        </div>
                        <h4 class="welcome_sub_login_heading text-center my-3"><strong>Account Protection</strong>
                        </h4>



                        <div class="d-flex flex-column align-items-center gap-3">
                            <div class="d-flex gap-2 mb-4">
                                <input type="text" maxlength="1"
                                    class="form-control otp-input text-center first_input" autofocus />
                                <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                                <input type="text" maxlength="1" class="form-control otp-input text-center ml-1" />
                            </div>
                            <input type="hidden" maxlength="6" required class="form-control w-75" name="otp"
                                id="otp">
                            <input type="hidden" value="0" name="change_pin_active" id="change_pin_active">
                            @if (isset($inPaymentMode))
                            <input type="hidden" value="1" name="in_payment_mode" id="in_payment_mode">
                            @endif

                            @if (isset($inPinMode))
                            <input type="hidden" value="1" name="in_pin_mode" id="in_pin_mode">
                            @endif

                            <img src="{{ asset('assets/app/img/circle-loader.gif') }}" class="wait-loader"
                                style="width: 60px;margin-bottom:18px;display:none;" alt="face-lock verification">
                            <button type="submit" class="otp-verify-btn" id="sendOtpSubmit">Verify</button>
                        </div>

                        <div class="termsandconditions_text_color">
                            @error('opt')
                            @enderror

                        </div>
                        <input type="hidden" name="phone" id="phoneId" value="">

                    </div>
                    <div id="senderror" class="text-center">
                    </div>
                    <div class="modal-footer forgot_pass p-0 justify-content-center">
                        <p id="otpTimerMsg" class="pt-2 text-muted" style="color:#ff3c5f !important"></p>
                        <p id="resendLine" class="pt-2" style="display: none;">
                            Not received your verification code?
                            <a href="#" id="resendOtpSubmit" class="termsandconditions_text_color">Resend Code</a>
                        </p>
                    </div>
                    <div class="common_otp_note">
                        <p class="mb-2"><b>Notes:</b></p>
                        <ol class="fa_notes">
                            <li>To help keep your account safe, E4U wants to make sure it is really you trying to sign
                                in.</li>
                            <li>Your six digit authentification code has been sent to your mobile/email
                                address.</li>
                        </ol>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




@push('script')
<script>
    const otpInputs = document.querySelectorAll(".otp-input");
    const hiddenOtp = document.getElementById("otp");

    window.OTP_RESEND_SECONDS = `{{ config('common.otp_resend_seconds') }}`;


    let otpSubmitted = false;
    let timer;

    let sendOtpForm = $("#SendOtp");

    sendOtpForm.on('submit', function(e) {
        e.preventDefault();
        submitButton = sendOtpForm.find(":submit"),
            $.ajax({
                url: sendOtpForm.attr('action'),
                method: sendOtpForm.attr('method'),
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: sendOtpForm.serialize(),
                beforeSend: function() {
                    submitButton.attr({
                        disabled: true
                    });
                    Swal.fire({
                        title: 'Verifying OTP',
                        text: 'Please wait while we verify your OTP. Do not refresh or close this page.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response, textStatus, xhr) {
                    Swal.close();
                    submitButton.removeAttr('disabled');
                    let option = getStatusOption(xhr);
                    Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then((result) => {
                        if ($("#in_payment_mode").length > 0) {
                            // $("#process-payment-modal").modal({
                            //     backdrop: 'static',
                            //     keyboard: false,
                            //     show: true
                            // });
                            sendOtpForm.find('input[type="text"]').val('');
                            processPaymentForm();
                        }

                        if (sendOtpForm.find("#in_pin_mode").length > 0) {
                            $("#SetPinModal").modal('show');
                        }
                    });
                    sendOtpForm.find('.otp-input').val('');
                    sendOtpForm.closest('.modal').modal('hide');
                },
                error: function(xhr) {
                    Swal.close();
                    let option = getStatusOption(xhr);
                    Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    });
                    submitButton.removeAttr('disabled');
                }
            });
    });

    function updateHiddenOtp() {
        let otp = "";
        otpInputs.forEach(input => otp += input.value);
        hiddenOtp.value = otp;

        if (otp.length === 6 && !otpSubmitted) {
            otpSubmitted = true;
            if ($(".on-form-action").length > 0) {
                sendOtpForm.submit();
            } else {
                document.getElementById("sendOtpSubmit").click();
            }
        } else if (otp.length < 6) {
            otpSubmitted = false;
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

    document.addEventListener("DOMContentLoaded", function() {

        const timerEl = document.getElementById("otpTimerMsg");
        const resendEl = document.getElementById("resendLine");


        $('#sendOtp_modal').one('shown.bs.modal', function() {

            seconds = parseInt(OTP_RESEND_SECONDS);
            startOtpTimer();
            focusFirstOtpInput()
        });


        function startOtpTimer() {
            resendEl.style.display = "none";
            timerEl.style.display = "block";

            $('#sendOtp_modal').one('shown.bs.modal', function() {
                const otpInputs = document.querySelectorAll(".otp-input");
                if (otpInputs.length > 0) {
                    otpInputs[0].focus();
                }
            });

            timer = setInterval(function() {
                const min = String(Math.floor(seconds / 60)).padStart(2, '0');
                const sec = String(seconds % 60).padStart(2, '0');
                timerEl.innerHTML =
                    `<i class="fa fa fa-exclamation-circle" style="color:#ff3c5f; font-size:20px;"></i> Please wait  <span style="color:#097969; font-size:18px;"> ${min}:${sec} seconds </span>  before requesting another OTP.`;

                if (seconds <= 0) {
                    clearInterval(timer);
                    timerEl.style.display = "none";
                    resendEl.style.display = "block";
                }
                seconds--;
            }, 1000);
        }

        //startOtpTimer();

        document.getElementById("resendOtpSubmit").addEventListener("click", function(e) {
            e.preventDefault();
            $('#resendLine').css({
                'display': 'none'
            });
            seconds = `{{ config('common.otp_resend_seconds') }}`;
            startOtpTimer();
            focusFirstOtpInput();
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
                !["Backspace", "Tab", "ArrowLeft", "ArrowRight", "Delete"].includes(e.key) &&
                !/^[0-9]$/.test(e.key)
            ) {
                e.preventDefault();
            }
        });
    });

    function focusFirstOtpInput() {
        const otpInputs = document.querySelectorAll(".otp-input");
        if (otpInputs.length > 0) {
            otpInputs.forEach(input => input.value = "");
            otpInputs[0].focus();
        }
    }
</script>


@endpush