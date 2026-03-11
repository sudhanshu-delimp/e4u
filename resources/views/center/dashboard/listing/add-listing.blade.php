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

.eachListing:first-child .removeCross{
    display:none;
}

.customModal{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.4);
z-index:9999;
}

.summary-container{
background:#f6f7f9;
width:70%;
padding:20px;
border-radius:6px;

/* perfect center */
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
}

.summary-header{
background: var(--blue--text);
color:white;
padding:15px 20px;
font-size:20px;
display:flex;
justify-content:space-between;
align-items:center;
}

.member-id{
font-size:14px;
}

.summary-table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

.summary-table th{
background: var(--blue--text);
color:white;
padding:12px;
border:1px solid #cfd6e0;
font-weight:500;
text-align: center;
}

.summary-table td{
padding:12px;
border:1px solid #cfd6e0;
text-align:center;
background:#fff;
}

.total-row td{
background:#f4f6f9;
font-weight:600;
}

.pay-area{
text-align:right;
margin-top:25px;
}

.close-btn{
background:#FF3C5F;
border:none;
padding:10px 20px;
border-radius:4px;
margin-right:10px;
cursor:pointer;
}

.close-btn:hover{
background:#FF3C5F;
}

.pay-btn{
background:#0f2745;
color:#fff;
border:none;
padding:10px 25px;
border-radius:5px;
cursor:pointer;
}

.pay-btn:hover{
background:#16385f;
}
   
.member-id .pr-2 i {
    color:#fff !important;
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
                        <button type="button" class="save_profile_btn" id="escort-form-submit-btn" disabled="true">Proceed to Payment</button>
                    </div>
                </form>

            </div>
            
        </div>
    </div>
    
</div>


<!-- Payment Summary Modal -->
<div id="summaryModal" class="customModal">

        <div class="summary-container">
        <div class="summary-header">
        <span>Summary</span>
        <span class="member-id"> <span class="pr-2 "><i class="fa fa-user"></i></span> Member ID: E20118</span>
        </div>

        <table class="summary-table" >
                    <thead>
                        <tr>
                        <th>Listing</th>
                        <th>Stage Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Days</th>
                        <th>Rate</th>
                        <th>Full Fee</th>
                        <th>Discount</th>
                        <th>Discounted Fee</th>
                        </tr>
                    </thead>
                    <tbody id="summaryBody"></tbody>
        </table>

        <div class="pay-area">
        <button class="close-btn">Close</button>
        <button class="pay-btn">Pay</button>
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
let profileCount = {{ count($profiles) }};

$(document).ready(function () {
    
    if(profileCount === 0){

        Swal.fire({
            icon: 'warning',
            title: 'Listings',
            text: 'You have no profile. Please create a profile first.',
            confirmButtonText: 'OK'
        }).then((result) => {

            if(result.isConfirmed){
                window.location.href = "{{ url('center-dashboard/create-profile') }}";
            }

        });

    }


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

        updateProfileOptions();  
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
         updateProfileOptions();  

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
         toggleRemoveButton();

    });

    
    $(document).on("click", ".removeCross", function () {
        if ($(".eachListing").length > 1) {
            $(this).closest(".eachListing").remove();
            updateProfileOptions();  
        }

    });

     toggleRemoveButton();
    checkAllRows();
    checkDateOverlap();

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

function updateProfileOptions() {

    let selectedProfiles = [];

    $('select[name="massage_id[]"]').each(function () {
        let val = $(this).val();
        if (val) {
            selectedProfiles.push(val);
        }
    });

    $('select[name="massage_id[]"]').each(function () {

        let current = $(this).val();

        $(this).find('option').each(function () {

            let optionVal = $(this).val();

            if (optionVal !== "" && selectedProfiles.includes(optionVal) && optionVal !== current) {
                $(this).hide();
            } else {
                $(this).show();
            }

        });

    });
}

function toggleRemoveButton() {
    $(".eachListing .removeCross").show();
    $(".eachListing:first .removeCross").hide();
   
}

$(".js_datepicker").datepicker({
    dateFormat: "yy-mm-dd",
    minDate: 0
});

///////// Proceed To Payment //////////////////////

$(".save_profile_btn").click(function(){

let html = '';
let total = 0;
let i = 1;

$(".eachListing").each(function(){

let profile = $(this).find('select[name="massage_id[]"] option:selected').text();
let start = $(this).find('.profile_start').val();
let end = $(this).find('.profile_end').val();

let startDate = new Date(start);
let endDate = new Date(end);

let days = Math.ceil((endDate - startDate) / (1000*60*60*24)) + 1;

let rate = 10; // testing
let fullFee = rate * days;
let discount = 0;
let finalFee = fullFee - discount;

total += finalFee;

html += `
<tr>
<td>${i}</td>
<td>${profile}</td>
<td>${start}</td>
<td>${end}</td>
<td>${days}</td>
<td>$ ${rate.toFixed(2)}</td>
<td>$ ${fullFee.toFixed(2)}</td>
<td>$ ${discount.toFixed(2)}</td>
<td>$ ${finalFee.toFixed(2)}</td>
</tr>
`;

i++;

});

html += `
<tr>
<td colspan="7"></td>
<td><strong>Total Fees</strong></td>
<td><strong>$ ${total.toFixed(2)}</strong></td>
</tr>
`;

$("#summaryBody").html(html);
$("#summaryModal").css("display","flex").hide().fadeIn();
});

$(document).on("click",".close-btn",function(){
$("#summaryModal").hide();
});

</script>
@endpush