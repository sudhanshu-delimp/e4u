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

<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 ">
   <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Add New Listing</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4" id="profile_and_tour_options">
            <div class="collapse" id="notes">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                      <ol>
                          <li>Please note we use 2FA verification process to enable you to make payment.</li>
                          <li>Your verification code will be sent to your nominated preference.</li>
                          <li>Please check the purchase summary before you authorise payment.</li>
                      </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- 3 step bar --}}
        <div class="col-lg-12">
            <div class="progressbar">
                <div class="step active">
                    <div class="circle">✔</div>
                    <p class="step-title">1. Listings</p>
                </div>
                <div class="step">
                    <div class="circle"></div>
                    <p class="step-title">2. Payment</p>
                </div>
                <div class="step">
                    <div class="circle"></div>
                    <p class="step-title">3. Completion</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="listing-container">

                <form id="socials_link" action="#" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!-- Header -->
                    <div class="listing-header" style="text-align:right; margin-bottom:15px;">
                        <button type="button" class="nex_sterp_btn" id="add_listing" disabled>Add Listing</button>
                    </div>
            
                    <!-- Listings Area -->
                    <div class="listing_area">
                        <div class="eachListing">
                            <span class="removeCross" title="Click to remove">
                                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}">
                            </span>
            
                            <div class="listing-row">
                                <!-- Choose Profile -->
                                <div class="listing-field">
                                    <label>Choose Profile:</label>
                                    <select name="massage_id[]" required>
                                        <option value="">Select One</option>
                                        @foreach($profiles as $profile)
                                            <option value="{{$profile->id}}">{{$profile->profile_name}}</option>
                                        @endforeach 
                                    </select>
                                </div>
            
                               
                                <div class="listing-field">
                                    <label>Start Date:</label>
                                    <input type="text" name="start_date[]" class="profile_start js_datepicker" onkeydown="return false" required>
                                    <span class="start-date-error date-error" style="color:red; font-size:12px;"></span>
                                
                                </div>
            
                              
                                <div class="listing-field">
                                    <label>End Date:</label>
                                    <input type="text" name="end_date[]" class="profile_end js_datepicker" onkeydown="return false" required>
                                    <span class="end-date-error date-error" style="color:red; font-size:12px;"></span>
                                </div>
            
                                
                            </div>
                        </div>
                    </div>
            
                    <!-- Footer -->
                    <div class="listing-footer" style="text-align:right; margin-top:20px;">
                        <button type="submit" class="save_profile_btn" id="escort-form-submit-btn" disabled="true">Proceed to Payment</button>
                    </div>
                </form>

            </div>
            
        </div>
    </div>
    
</div>

@endsection

@push('script')
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>


<script type="text/javascript">

$(document).ready(function () {

    function checkAllRows() 
    {
            let valid = true;
            $(".eachListing").each(function () {

                let profile = $(this).find('select[name="massage_id[]"]').val();
                let start = $(this).find('.profile_start').val();
                let end = $(this).find('.profile_end').val();
                let error = $(this).find('.date-error').text();

                if (!profile || !start || !end || error !== '') {
                    valid = false;
                    is_form_valid  = false;
                }

            });

            $("#add_listing").prop("disabled", !valid);
    }

    
    $(document).on('change', '.profile_start, .profile_end, select[name="massage_id[]"]', function () 
    {

        var is_form_valid = true;
        let row = $(this).closest('.eachListing');
        let start = row.find('.profile_start').val();
        let end = row.find('.profile_end').val();

        let startError = row.find('.start-date-error');
        let endError = row.find('.end-date-error');

         startError.text('');
         endError.text('');

        // Validate End Date > Start Date
        if (start && end) {

            let startDate = new Date(start);
            let endDate = new Date(end);

            if (endDate <= startDate) {

                endError.text("End date must be greater than Start date");
                row.find('.profile_end').val('');
                $("#add_listing").prop("disabled", true);
                is_form_valid  = false;
                return;
            }
        }


        let prevRow = row.prev('.eachListing');
        if (prevRow.length) {

            let prevEnd = prevRow.find('.profile_end').val();

            if (prevEnd && start) {

                let prevEndDate = new Date(prevEnd);
                let startDate = new Date(start);

                if (startDate <= prevEndDate) {

                    startError.text("Start date must be greater than previous listing End date");
                    row.find('.profile_start').val('');
                    $("#add_listing").prop("disabled", true);
                    is_form_valid  = false;
                    return;
                }
            }
        }

        checkAllRows();
        checkDateOverlap();

    });

 
    $("#add_listing").click(function () {

        let lastRow = $(".eachListing").last();
        let lastEndDate = lastRow.find(".profile_end").val();
        let newRow = lastRow.clone();
        newRow.find("select").val('');
        newRow.find("input").val('');
        newRow.find(".date-error").text('');
        newRow.find(".js_datepicker").removeClass("hasDatepicker").removeAttr("id");

        $(".eachListing").last().after(newRow);

        let minStartDate = 0;

        if (lastEndDate) {
            let nextDay = new Date(lastEndDate);
            nextDay.setDate(nextDay.getDate() + 1);
            minStartDate = nextDay;
        }

        // start date picker
        newRow.find(".profile_start").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: minStartDate
        });

        // end date picker
        newRow.find(".profile_end").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: minStartDate
        });

        $("#add_listing").prop("disabled", true);

    });

    
    $(document).on("click", ".removeCross", function () {
        if ($(".eachListing").length > 1) {
            $(this).closest(".eachListing").remove();
        }

    });

});


function checkDateOverlap() {

    let rows = [];
    let overlap = false;
    let incomplete = false;

    $(".eachListing").each(function () {

        let profile = $(this).find("select[name='massage_id[]']").val();
        let start = $(this).find(".profile_start").val();
        let end = $(this).find(".profile_end").val();

        if (!profile || !start || !end) {
            incomplete = true;
        }

        rows.push({
            profile: profile,
            start: start ? new Date(start) : null,
            end: end ? new Date(end) : null
        });

    });

    // check overlap
    for (let i = 0; i < rows.length; i++) {

        for (let j = i + 1; j < rows.length; j++) {

            if (
                rows[i].profile &&
                rows[j].profile &&
                rows[i].profile === rows[j].profile &&
                rows[i].start &&
                rows[i].end &&
                rows[j].start &&
                rows[j].end
            ) {

                if (
                    rows[i].start <= rows[j].end &&
                    rows[j].start <= rows[i].end
                ) {
                    overlap = true;
                }

            }

        }

    }

    if (overlap || incomplete) {
        $("#escort-form-submit-btn").prop("disabled", true);
    } else {
        $("#escort-form-submit-btn").prop("disabled", false);
    }

}
$(".js_datepicker").datepicker({
    dateFormat: "yy-mm-dd",
    minDate: 0
});
</script>
@endpush