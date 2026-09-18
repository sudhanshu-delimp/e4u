<style type="text/css">
    /* Target your SetPinModal only */
    #SetPinModal .modal-dialog {
        max-width: 450px !important;
        margin: auto;
    }



    #SetPinModal .modal-content {
        border-radius: 10px;
    }

    /* PIN display box */
    .pin-display {
        font-size: 18px;
        font-weight: bold;
        border-bottom: 1px solid #000;
        padding: 8px;
        min-height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Keypad styling */
    .pin-keypad {
        display: inline-block;
    }

    .keypad-row {
        display: flex;
        justify-content: center;
        margin-bottom: 8px;
    }

    .key {
        width: 100px;
        height: 60px;
        margin: 0 5px;
        font-size: 20px;
        font-weight: bold;
        border: 1px solid #000;
        background: #fff;
        cursor: pointer;
        color: #0c223d;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .key:hover {
        background: #0c223d;
        color: #fff;
    }
</style>
<div class="modal fade upload-modal" id="SetPinModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center justify-content-start">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/key-30.png')}}" class="custompopicon mr-0" alt="cross">
                    Set your PIN (4 digits)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>

            <div class="modal-body text-center p-0">
                <!-- PIN Display -->
                <div id="pinDisplaySet" class="pin-display mb-3" data-placeholder="Numbers appear as typed">
                    <span style="color: #aaa">Numbers appear as typed</span>
                </div>

                <!-- Keypad -->
                <div class="pin-keypad mx-auto mb-3">
                    <div class="keypad-row">
                        <button class="key input_value_pin">1</button>
                        <button class="key input_value_pin">2</button>
                        <button class="key input_value_pin">3</button>
                    </div>
                    <div class="keypad-row">
                        <button class="key input_value_pin">4</button>
                        <button class="key input_value_pin">5</button>
                        <button class="key input_value_pin">6</button>
                    </div>
                    <div class="keypad-row">
                        <button class="key input_value_pin">7</button>
                        <button class="key input_value_pin">8</button>
                        <button class="key input_value_pin">9</button>
                    </div>
                    <div class="keypad-row">
                        <button class="key" id="clearSetPin">⌫</button>
                        <button class="key input_value_pin">0</button>
                        <button class="key" id="ok">OK</button>
                    </div>
                </div>
                @if(!empty($mode) && $mode=='pinSetup')
                <div class="d-flex justify-content-center mb-3">
                    <button type="button" class="btn-cancel-modal mr-3" id="allClearSetPin">Clear</button>
                    <button type="button" class="btn-success-modal" id="okSave">Save</button>
                </div>
                @else
                <input type="hidden" name="action">
                @endif
            </div>
        </div>
    </div>
</div>
@prepend('script')
<script>
    let fClick = true;
    let fClick2 = true;
    let isEftClient = false;
    var eftAccountId = 0;
    let isPayIDClicked = false;
    let inMode = `{{!empty($mode) ? $mode : ''}}`;

    // For pinDisplay
    $('.input_value').click(function() {
        const inputValue = $(this).text();
        const el = $('#pinDisplay');

        // Clear default text on first click
        if (fClick) {
            el.text('');
            fClick = false;
        }

        let text = el.text();

        // Prevent more than 4 digits
        if (text.length >= 4) return;

        el.text(text + inputValue);
    });

    // For pinDisplaySet
    $('.input_value_pin').click(function() {
        const inputValue = $(this).text();
        const el2 = $('#pinDisplaySet');

        // Clear default text on first click
        if (fClick2) {
            el2.text('');
            fClick2 = false;
        }

        let text2 = el2.text();

        // Prevent more than 4 digits
        if (text2.length >= 4) return;

        el2.text(text2 + inputValue);
    });

    $('#clear').click(function() {
        let el = $('#pinDisplay');
        let el2 = $('#pinDisplaySet');
        let text = el.text();
        let text2 = el2.text();
        if (text.length > 0) {
            el.text(text.slice(0, -1));
        }

        if (text2.length > 0) {
            el2.text(text2.slice(0, -1));
        }
    });

    $('#clearSetPin').click(function() {
        let el2 = $('#pinDisplaySet');
        let text2 = el2.text();

        if (text2.length > 0) {
            el2.text(text2.slice(0, -1));
        }
    });
    $('#allClearSetPin').click(function() {
        $('#pinDisplaySet').text('');
    });


    $('.clear_at_once').click(function() {
        let el2 = $('#pinDisplaySet');
        let text2 = el2.text('');
    });

    $("#ok, #okSave").click(function() {
        const pinDisplay = $('#pinDisplaySet');
        const textEl = document.getElementById("pinDisplaySet");
        let pin = pinDisplay.text().trim();
        if (inMode == 'pinSetup') {
            updateBankPinByAjax(pin);
        } else if (inMode == 'pinAuth') {
            validateBankPin(pin);
        }
    });

    function updateBankPinByAjax(pin) {
        $.ajax({
            method: "POST",
            url: `{{route('web.update.bank.pin')}}`,
            data: {
                'user_bank_pin': pin
            },
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                if (data.error == false) {
                    $("#SetPinModal").modal('hide');
                    $("#modal-title").text("Pin Update Confirmation");
                    let textMsg = `<h5 class="text-center">
                                 ` + data.message + `
                              </h5>`;
                    $('.comman_msg').html(textMsg);
                    setTimeout(() => {
                        $("#comman_modal").modal('show');
                    }, 200);
                }
            },
            error: function(data) {
                console.log(data.responseJSON.errors);
                console.log(data.responseJSON.errors.account_number);
                $('#account_numberError').text(data.responseJSON.errors.account_number);
            }

        })
    }

    function validateBankPin(pin) {
        $.ajax({
            method: "POST",
            url: `{{route('web.validate.bank.pin')}}`,
            data: {
                pin
            },
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            beforeSend: function() {
                showLoadingPopup('Processing Payment', 'Do not refresh or close this page.');
            },
            success: function(response, textStatus, xhr) {
                Swal.close();
                displaySwal(xhr).then((result) => {
                    if (result.isConfirmed) {
                        let nextAction = $("#SetPinModal").find('input[name="action"]').val();
                        window[nextAction]();
                    }
                });
            },
            error: function(xhr) {
                Swal.close();
                displaySwal(xhr);
            }

        })
    }
</script>
@endprepend