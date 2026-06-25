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


    </div>
    <!-- Progress Bar -->
        <div class="row">
            <div class="col-lg-12">
                <div class="custom_progress_wrapper">
                    <div class="custom_pro_container">
                        <div class="progress_line" id="custom_progress"></div>

                        <div class="custom_step">
                            <div class="circle active current">1</div>
                            <div class="label active">Listings</div>
                        </div>

                        <div class="custom_step">
                            <div class="circle">2</div>
                            <div class="label">Payment</div>
                        </div>

                        <div class="custom_step">
                            <div class="circle">3</div>
                            <div class="label">Completion</div>
                        </div>
                    </div>

                       <button style="display: none;" id="prev" disabled>Prev</button>
                       <button style="display: none;" id="next">Next</button> 
                </div>
            </div>
        </div>
        {{-- end --}}
    <div class="row">
        <div class="col-md-12">
            <div class="listing-container">

                <form id="socials_link" action="#" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!-- Header -->
                    <div class="listing-header d-flex justify-content-between gap-20 align-items-center mb-3">
                        <h6 class="my-3" style="font-weight: 600; color:#0c223d;">Please wait while geolocation completes before you create a New Listing.</h6>
                        
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
                        <button type="button" class="save_profile_btn" id="escort-form-submit-btn" disabled="true">Proceed to Checkout</button>
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
        <span>Transaction Summary</span>
        <span class="member-id"> <span class="pr-2 "><i class="fa fa-user"></i></span> Member ID: {{auth()->user()->member_id}}</span>
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


        <form name="purchase_listing" id="purchase_listing" method="post">
            <div class="pay-area">
                <input type="hidden" name="no_of_days" id="no_of_days">
                <input type="hidden" name="total_discount" id="total_discount">
                <input type="hidden" name="total_fee" id="total_fee">
                <input type="hidden" name="listing_start_date" id="listing_start_date">
                <input type="hidden" name="listing_end_date" id="listing_end_date">
                <input type="hidden" name="membership_id" id="membership_id">
                <input type="hidden" name="massage_profile_id" id="massage_profile_id">
                <input type="hidden" name="rate" id="rate">
                <input type="hidden" name="total_rate" id="total_rate">
                <input type="hidden" name="discountRate" id="discountRate">
                <input type="hidden" name="applied_discount" id="applied_discount">
                
                
              
                
                <button type="button" class="close-btn">Close</button>
                <button type="button" class="pay-btn">Checkout</button>
            </div>
        </form>


     </div>
</div>



@endsection


@include('center.dashboard.modal.payment_form')
@include('modal.two-step-verification',['action'=>true,'inPaymentMode'=>true])

@push('script')
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>

<script src="{{ asset('js/escort/progress_bar.js') }}"></script>

<script type="text/javascript">
let profileCount = {{ count($profiles) }};
let live_profiles = {{ count($live_profiles) }};
var plandata = {}; 
var updatedPlanSummary = {};
const secretKey = "{{ config('app.aes_key') }}";
const iv = "{{ config('app.aes_iv_string') }}";




$(document).ready(function () {



    //////////// check if one profile is Live ///////////////
    if(live_profiles > 0){

        Swal.fire({
            icon: 'warning',
            title: 'Listings',
            text: 'You already have a Profile Listed.  To change the Profile, cancel the Listed Profile, then List a new Profile.',
            confirmButtonText: 'OK'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "{{ url('center-dashboard/list') }}";
            }

        });
    }
    

     //////////// check if no profile is exist ///////////////
     if(profileCount === 0){
        Swal.fire({
            icon: 'warning',
            title: 'Listings',
            text: 'You don’t have any Profiles yet.please create a Profile first, then list the Profiles.',
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

function clear_prev_listing()
{


    $('#rate').val('');
    $('#total_rate').val('');
    $('#no_of_days').val('');
    $('#total_discount').val('');
    $('#total_fee').val('finalFee');
    $('#listing_start_date').val('');
    $('#listing_end_date').val('');
    $('#membership_id').val('');
    $('#massage_profile_id').val('');

    
}

function formatDateToDDMMYYYY(dateStr) {

    const [year, month, day] = dateStr.split('-');
    return `${day}-${month}-${year}`;
}


function formatIndianNumber(value) {
    if (!value) return '';

    value = value.toString().replace(/,/g, '');

    if (isNaN(value)) return value;

    let parts = value.split('.');
    let integerPart = parts[0];
    let decimalPart = parts[1] ? '.' + parts[1] : '';

   
    let lastThree = integerPart.slice(-3);
    let otherNumbers = integerPart.slice(0, -3);

    if (otherNumbers !== '') {
        lastThree = ',' + lastThree;
    }

    let formatted =
        otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

    return formatted + decimalPart;
}

function parseDate(dateStr) {
let [day, month, year] = dateStr.split('-');
return new Date(year, month - 1, day);
}



$(".save_profile_btn").click(function(){

    clear_prev_listing();

    let html = '';
    let total = 0;

    let row = $(".eachListing"); 

    let profile = row.find('select[name="massage_id[]"] option:selected').text();
    let profile_val = row.find('select[name="massage_id[]"] option:selected').val();
    let start = row.find('.profile_start').val();
    let end = row.find('.profile_end').val();

     console.log(start+'=========='+end);

    // safety check
    if (!start || !end) {
        alert("Please select start and end date");
        return;
    }

  
    let startDate = parseDate(start);
    let endDate = parseDate(end);

   

    let days = Math.ceil((endDate - startDate) / (1000*60*60*24)) + 1;
    let membership_id = 5;

     let formData = {
            days: days,
            membership_id: 5,
            _token: $('meta[name="csrf-token"]').attr('content'),
        };

     $.ajax({
            url: "{{route('center.add-listing')}}",
            type: "POST",
            data: formData,
            success: function (response) {

               plandata = {
                membershipName: response.membership_name,
                normalRate: response.normalRate,
                days: response.days,
                total_discount:response.total_discount,
                total_rate:response.total_rate,
                discountRate : response.discountRate,
                applied_discount : response.applied_discount
            };

            console.log('plandata',plandata);


            let rate = plandata.normalRate;
            let fullFee = plandata.normalRate * days;
            let discount = plandata.total_discount;
            let finalFee = fullFee - discount;
            let total_rate = plandata.total_rate;
            let discountRate = plandata.discountRate;
            let applied_discount = plandata.applied_discount;
            total = finalFee;
           

            $('#rate').val(rate);
            $('#total_rate').val(total_rate);
            $('#no_of_days').val(days);
            $('#total_discount').val(discount);
            $('#total_fee').val(finalFee);
            $('#listing_start_date').val(formatDateToDDMMYYYY(start));
            $('#listing_end_date').val(formatDateToDDMMYYYY(end));
            $('#membership_id').val(membership_id);
            $('#massage_profile_id').val(profile_val);
            $('#discountRate').val(discountRate);
            $('#applied_discount').val(applied_discount);

            html += `
            <tr>
                <td>1</td>
                <td>${profile}</td>
                <td>${formatDateToDDMMYYYY(start)}</td>
                <td>${formatDateToDDMMYYYY(end)}</td>
                <td>${days}</td>
                <td>$ ${rate}</td>
                <td>$ ${formatIndianNumber(fullFee.toFixed(2))}</td>
                <td>$ ${formatIndianNumber(discount.toFixed(2))}</td>
                <td>$ ${formatIndianNumber(finalFee.toFixed(2))}</td>
            </tr>
            `;

          
            html += `
            <tr>
                <td colspan="7"></td>
                <td><strong>Total Fees</strong></td>
                <td><strong>$ ${formatIndianNumber(total.toFixed(2))}</strong></td>
            </tr>`;

            $("#summaryBody").html(html);
            $("#summaryModal").css("display","flex").hide().fadeIn();
            $('#next').trigger('click');

            },
            error: function (xhr) {
                console.log(xhr.responseJSON || xhr);
                alert("Validation Error");
            }
        });

});


// ########## Listing Payment ################ //
$(document).on("click",".pay-btn",async function(e){
e.preventDefault();

    let no_of_days = $("#no_of_days").val();
    let total_fee = $("#total_fee").val();
    let listing_start_date = $("#listing_start_date").val();
    let listing_end_date = $("#listing_end_date").val();
    let membership_id = $("#membership_id").val();
    let massage_centre_id = $("#massage_centre_id").val();

    if (!no_of_days || !total_fee || !listing_start_date || !listing_end_date || !membership_id || !massage_profile_id) {
        return;
    }

    $("#summaryModal").hide();
    $('#adjustment-form').append(`<input type="hidden" name="action_type" value="listing">`);

    if (await isConfirm({'action': 'Proceed','text': ''})) {

        // plandata.action_type = $('[name="action_type"]').val();
        // console.log('plandata',plandata);
        // swal_waiting_popup({'title': 'Processing.'});
        // let response = await make_order_summury(plandata);
        // console.log("updatedPlanSummary=>>>>>>> :", updatedPlanSummary); // updatedPlanSummary is Gobal varaible
        // Swal.close();
        // if (Object.keys(updatedPlanSummary?.data?.pay_data || {}).length > 0 && parseFloat(updatedPlanSummary.data.pay_data.total_amount) > 0){
        // $("#process-payment-modal").modal({backdrop: 'static',keyboard: false,show: true});
        // }
    
       // return false;
       

        // console.log('process-payment-modal');
        // return false;
          
        swal_waiting_popup({'title': 'Processing.'});
        let formData = $("#purchase_listing").serialize();

         $.ajax({
                    url: "{{route('center.listing-payment')}}",
                    method: 'POST',
                    data: formData,
                    success:  function(response) 
                    {
                        Swal.close();
                        plandata.checkout_number = response.data.checkout_number? response.data.checkout_number: '';
                        plandata.action_type = $('[name="action_type"]').val();
                        console.log('plandata=>>>>>>',plandata);
                        swal_waiting_popup({'title': 'Processing.'});

                        let response_data  =  make_order_summury(plandata).done(function(summaryResponse) {
                        console.log("updatedPlanSummary=>>>>>>> :", updatedPlanSummary); // updatedPlanSummary is Gobal varaible
                        Swal.close();
                        if (Object.keys(updatedPlanSummary?.data?.pay_data || {}).length > 0 && parseFloat(updatedPlanSummary.data.pay_data.total_amount) > 0){
                        $("#process-payment-modal").modal({backdrop: 'static',keyboard: false,show: true});
                        }
                        }).fail(function(err) {
                            console.error('Summary Function Error:', err);
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Summary error!' });
                        });


                      

                        // Swal.close();
                        // let redirect = {'time': 2000, 'url' : 'payment-completed'}
                        // $('#next').trigger('click');
                        // swal_success_popup(response.message,redirect);
                    },
                    error: function(xhr) {
                        Swal.close();
                        console.log(xhr);
                        if (xhr.status === 422) {
                           swal_error_popup('Error occured while adding listing.');
                        } else {
                            swal_error_popup(xhr.responseJSON.message ||'Something went wrong.');
                        }
                }
        });

    }
    else
    {
        $('#prev').trigger('click');
    }
});
// ########## End Listing Payment ################ //


$(document).on("click",".close-btn",function(e){
e.preventDefault();
$('#prev').trigger('click');
$("#summaryModal").hide();
});

</script>

@include('center.dashboard.payment_functions')
@endpush