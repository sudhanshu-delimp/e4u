<!-- suspend profile modal start here -->
<div class="modal fade upload-modal modal-form-suspend" id="suspend_profile" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form id="suspend_form">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">
                            <img src="{{ asset('assets/app/img/deactivate.png') }}" class="custompopicon"
                                alt="cross"> Suspend Listing
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img id="modal_close"
                                    src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> Profile:</label>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                id="suspendProfileId" name="suspend_profile_id"
                                                data-parsley-errors-container="#profile-errors" required
                                                data-parsley-required-message="Select Profile">
                                                <option value="">Select Profile</option>
                                            </select>
                                            <span id="profile-errors"></span>
                                        </div>
                                        {{-- <div class="col-sm-1"></div> --}}
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> Period:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <input type="text" id="suspendStartDate" required
                                                        class="form-control form-control-sm removebox_shdow js_datepicker"
                                                        name="start_date" data-parsley-type=""
                                                        data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
                                                </div>
                                                <div class="col-sm-1">
                                                    <span>to:</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" id="suspendEndDate" required
                                                        class="form-control form-control-sm removebox_shdow js_datepicker"
                                                        name="end_date" data-parsley-type=""
                                                        data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="">Credit:</label>
                                        <div class="col-sm-4">
                                            <div class="input-group input-group-sm" style="padding-right: 25px;">
                                                <span class="input-group-text"
                                                    style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                                <span class="form-control" id='creditCalculationLive'
                                                    style="background-color: #e9ecef; border: 1px solid #ced4da;">0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="background-color: #0C223D" class="mt-4">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <p class="mb-1"><b>Notes:</b></p>
                                            <ol class="pl-4 text-justify">

                                                <li> To suspend a Listing, select the Profile and suspension period,
                                                    then click Suspend. You will be credited with the Fees according to
                                                    the suspension period.</li>
                                                <li> Once your Profile is suspended, it cannot be reinstated for the
                                                    suspended period.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: end; display: block;">
                        <button type="submit" class="btn-success-modal" id="save_brb" disabled>Proceed to Suspend Listing</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end suspend profile modal -->
@prepend('script')
<script>
        let suspendProfileObject = $('#suspendProfileId');
        let suspendStartDateObject = $('#suspendStartDate');
        let suspendEndDateObject = $('#suspendEndDate');
        let suspendFrom = $(".modal-form-suspend");
        let suspendFromButton = suspendFrom.find('.modal-footer button[type="submit"]');
        let creditAmount = suspendFrom.find('#creditCalculationLive');
        
    $(document).ready(function() {
        /* start handle suspend modal start and end date calendars */
        
        suspendFromButton.prop('disabled', true);

        suspendStartDateObject.datepicker('setDate', +1);
        suspendStartDateObject.datepicker('option', 'minDate', +1);

        suspendEndDateObject.datepicker('option', 'minDate', +1);

        suspendStartDateObject.datepicker('option', 'onSelect', function() {
            suspendEndDateObject.datepicker('option', 'minDate', $(this).val());
            suspendEndDateObject.datepicker('option', 'setDate', $(this).val());
            calculateCredit();
        });

        suspendEndDateObject.datepicker('option', 'onSelect', function() {
            suspendStartDateObject.datepicker('option', 'maxDate', $(this).val());
            calculateCredit();
        });

        suspendProfileObject.on('change', function() {
            let selectedOption = $(this).find(':selected');
            let listingMembership = selectedOption.data('membership');
            let listingStartDate = selectedOption.data('start');
            let listingEndDate = selectedOption.data('end');
            let profileId = selectedOption.val();

            let minDate = new Date();
            minDate.setDate(minDate.getDate() + 1);
            let option_start_Date = $.datepicker.parseDate('dd-mm-yy', listingStartDate);
            (minDate < option_start_Date) ? suspendStartDateObject.datepicker('setDate', option_start_Date) : suspendStartDateObject.datepicker('setDate', +1);
            (minDate < option_start_Date) ? suspendStartDateObject.datepicker('option', 'minDate', option_start_Date) : suspendStartDateObject.datepicker('option', 'minDate', +1);
            (minDate < option_start_Date) ? suspendEndDateObject.datepicker('option', 'minDate', option_start_Date) : suspendEndDateObject.datepicker('option', 'minDate', +1);
            
            suspendStartDateObject.datepicker('option', 'maxDate', listingEndDate);
            suspendEndDateObject.datepicker('setDate', null);
            suspendEndDateObject.datepicker('option', 'maxDate', listingEndDate);
            creditAmount.html('0.00');
            suspendFromButton.prop('disabled', true);
        });

        function calculateCredit() {
            let selectedOption = suspendProfileObject.find(':selected');
            if (suspendEndDateObject.val() && suspendStartDateObject.val()) {
                $.ajax({
                    url: "{{ route('suspend.calculate.credit.live') }}",
                    method: 'POST',
                    data: {
                        start_date: suspendStartDateObject.val(),
                        end_date: suspendEndDateObject.val(),
                        profile_id: selectedOption.val(),
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        suspendFromButton.prop('disabled', true);
                        creditAmount.html('0.00');
                    },
                    success: function(response) {
                        console.log(`response ${response.refund_amount}`);
                        if (response.success) {
                            creditAmount.html(response.refund_amount);
                            $("#suspend_form").find('button[type=submit]').removeAttr('disabled');
                            suspendFromButton.prop('disabled', false);
                        } else {
                            $("#suspend_form").find('button[type=submit]').attr('disabled',
                                'disabled');
                            Swal.fire({
                                icon: "error",
                                text: response.message
                            });
                        }
                    }
                });
            }
        }

        /* end handle suspend modal start and end date calendars */
    });

     $("#suspend_form").on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = "{{ route('escort.profile.suspend') }}";
        var data = new FormData(form[0]);

        $.ajax({
            method: 'POST',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                showLoadingPopup();
                $("#suspend_form").find('button[type=submit]').attr('disabled', 'disabled');
            },
            success: function(response, textStatus, xhr) {
                Swal.close();
                if (response.success) {
                    displaySwal(xhr);
                    // set suspend icon to profile 
                    $('#suspend_profile').modal('hide');
                    table.draw();
                } else {
                    Swal.fire({
                        icon: "error",
                        text: data.response.message
                    });
                }
                $("#suspend_form").find('button[type=submit]').removeAttr('disabled');
            },
            error: function(xhr, status, error){
                displaySwal(xhr);
            },
            complete: function(){
                $("#suspend_form").find('button[type=submit]').removeAttr('disabled');
            }

        });
    });
</script>
@endprepend