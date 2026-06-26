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

   .multiselect {
  position: relative;
  display: inline-block;
  width: 100%;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  padding: 6px;
  border: 1px solid #ccc;
  cursor: pointer;
}

.overSelect {
  position: absolute;
  left: 0; right: 0; top: 0; bottom: 0;
}

.checkboxes {
  display: none;
  border: 1px solid #ccc;
  background: #fff;
  position: absolute;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  z-index: 99;
}

.checkboxes label {
  display: block;
  padding: 5px 10px;
  cursor: pointer;
}

.checkboxes label:hover {
  background-color: #f1f1f1;
}
.action_buttons {
   margin-bottom:10px;
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
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      
      <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">    
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Our Profiles</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <!-- <ol>
                           <li>Use these help pages for explanations and guidance on managing all of your Masseur
                              Profiles.</li>
                           <li>You can upload four photos for each Masseur. Designate one as the Masseur’s
                              Thumbnail.</li>
                           <li>Activate up to eight Masseur Profiles at any one time to appear the Massage Centre
                              Profile.</li>
                     </ol> -->
                  </div>
               </div>
            </div>
         </div>
         {{-- start content --}}

            
         <div class="row">
            <div class="col-md-12">
               <div class="panel with-nav-tabs panel-warning">
                  <div class="panel-body">

                           @if($active_profile)
                           <div class="action_buttons">
                                <div class="add--list listingActionButtons">
                                    <div class="">
                                          <button class="btn brb-btn" data-toggle="modal"
                                                data-target="#add_brb" id="btn_add_brb">Shop Closed</button>
                                                <button style="padding: 10px;" class="btn btn-custom-success" data-toggle="modal" data-target="#extend_profile" id="btn_extend_profile"> Extend Profile  </button>
                                          
                                          
                                          <button style="padding: 10px;" class="btn btn-bump-up" data-toggle="modal" data-target="#bumpup_profile" id="btn_bumpup_profile"> Bump Up  </button>
                                          <button style="padding: 10px;" class="btn btn-primary" data-toggle="modal"
                                                data-target="#suspend_profile" id="btn_suspend_profile">Suspend Profile</button> 
                                       </div>
                                </div> 
                           </div>  
                            @endif



                     <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab3warning">
                           <div class="row pb-3">

                                 <!-- <div class="col-md-12 col-sm-12">
                                    <div class="bothsearch-form d-flex align-items-center justify-content-end" style="gap: 10px;">
                                       <div class="total_listing">
                                          <div><span>Current Active : </span></div>
                                          <div><span id="totalViewerLegboxList">1</span></div>
                                       </div>
                                       
                                    </div>
                                 </div> -->
                           </div>
                           <div class="table-responsive-xl">


                              <table class="table mb-3" id="massage_list">
                                 <thead class="table-bg">
                                    <tr>
                                    <th>Is Live</th>
                                    <th>ID</th>
                                    <th>Profile Name</th>
                                    <th>Business Name</th>
                                    <th>Business No</th>
                                    <th>Mobile</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                       
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         {{-- end --}}
      </div>
   </div>
   <!-- End of Main Content -->
   <!-- Footer -->
   <footer class="sticky-footer bg-white">
      <div class="container my-auto">
         <div class="copyright text-center my-auto">
            <span> </span>
         </div>
      </div>
   </footer>
   <!-- End of Footer -->
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

    @if($active_profile)
    @include('center.dashboard.modal.listing_action_popup.index')
    @endif

   <!-- Payment Summary Modal -->
   <div id="summaryModal" class="customModal">

         <div class="summary-container">
         <div class="summary-header">
         <span>Transaction Summary</span>
         <span class="member-id"> <span class="pr-2 "><i class="fa fa-user"></i></span> Member ID : {{ auth()->user()->member_id}}</span>
         </div>

         <table class="summary-table" >
                     <thead>
                           <th>Listing</th>
                           <th>Business Name</th>
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
                  <input type="hidden" name="total_fee" id="total_fee">
                   <input type="hidden" name="rate" id="rate">
                    <input type="hidden" name="total_rate" id="total_rate">
                  <input type="hidden" name="listing_start_date" id="listing_start_date">
                  <input type="hidden" name="listing_end_date" id="listing_end_date">
                  <input type="hidden" name="membership_id" id="membership_id">
                  <input type="hidden" name="massage_profile_id" id="massage_profile_id">
                  <button type="button" class="close-btn">Close</button>
                  <button type="button" class="pay-btn">Pay</button>
               </div>
         </form>


      </div>
   </div>
<!-- End Payment Summary Modal -->

<div class="modal fade upload-modal programmatic show" id="iframeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img src="{{ asset('../assets/dashboard/img/info.png') }}" class="custompopicon"> {{auth()->user()->member_id}} :  Profile </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('../assets/app/img/newcross.png') }} " class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">

                		<iframe id="modalFrame" width="100%" height="600px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>



<div class="modal fade upload-modal" id="duplicate-profile-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><img src="/assets/app/img/dublicate-profile.png" class="custompopicon" alt="cross"> Duplicate Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img id="modal_close" src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                     <form id="duplicate_profile_form" data-parsley-validate>
                        <input type="hidden" name="duplicate_profile" value="duplicate" />
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container p-0">
                                        <div class="form-group row">
                                            <label class="col-sm-3" for="">
                                                Profile Name:
                                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                                    data-toggle="tooltip" data-html="true" data-placement="top"
                                                    title="Be consistent when naming your Profiles, like Sydney01, Sydney 02, Perth01, Perth02 etc."
                                                    data-boundary="window">
                                                <span style='color:red'>*</span>
                                            </label>
                                            <div class="col-sm-9">

                                          <input type="text"  class="form-control form-control-sm removebox_shdow" name="new_profile_name" id="new_profile_name">
                                              
                                                <span id="profile_name_errors" class="text-danger"></span>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="text-align: right; display: block;">
                            <input type="hidden" name="duplicate_profile_id" id="duplicate_profile_id">
                            <button type="submit" class="btn-success-modal" id="duplicate_profile">Save</button>
                        </div>
                    </form>                    
                </div>
            </div>
    </div>
</div>


@include('center.dashboard.modal.payment_form')
@include('modal.two-step-verification',['action'=>true,'inPaymentMode'=>true])

@endsection

@push('script')
<!-- file upload plugin start here -->



<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
<script>
let expanded = false;
var is_load_first = 1;
var plandata = {};
const secretKey = "{{ config('app.aes_key') }}";
const iv = "{{ config('app.aes_iv_string') }}";

function showCheckboxes() {
  let checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>



<script>
var table = $("#massage_list").DataTable({
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[0, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10,    

    ajax: {
        url: "{{ route('center.all-massager-list') }}",
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: function (d) {
            d.type = 'player';
            return JSON.stringify(d);
        }
    },

    columns: [
            { data: 'is_live',  name: 'is_live', visible: false },
            { data: 'id', name: 'id', visible: false },
            { data: 'profile_name', name: 'profile_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'business_name', name: 'business_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'business_no', name: 'business_no', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'phone', name: 'phone', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'created_at', name: 'created_at', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'status', name: 'status', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
    ],


});


$(document).on('click', '.duplicate_profile', async function () {

      let current_action = $(this).data('row-action');
      var mess = "";
      let rowId = $(this).data('row-id');
      let action = "";

      if(!current_action || !rowId )
      return false;

       mess =   'Do you want to '+current_action+' this Profile?';
       action = current_action;

      let mess_data = {
         'title' : 'NA',
         'text' : mess,
      }

      let post_data = {
         'action' : action,
         'profile_id':rowId
      }
   
      if(await isConfirm(mess_data))
      {  
         Swal.close();
         $('#duplicate_profile_id').val(rowId);
         $('#duplicate-profile-modal').modal('show');   
      }

})


$("#duplicate_profile_form").on('submit', function(e) 
{
   e.preventDefault();
   var form = $(this);
   var new_profile_name = $("#new_profile_name").val();
   var duplicate_profile_id = $("#duplicate_profile_id").val();

   if (new_profile_name === '') {
      $("#profile_name_errors").text('Profile name is required');
      return false;
   }
   var data = new FormData(form[0]);
   swal_waiting_popup({'title': 'We’re Creating Your Profile.'});
   $.ajax({
         method: 'POST',
          url: "{{ route('center.duplicate-massage-profile') }}",
         data: data,
         contentType: false,
         processData: false,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
            Swal.close();
            if (response.success) {
               Swal.fire({
                     icon: "success",
                     text: response.message
               });

               $("#duplicate_profile_form")[0].reset();
               $('#duplicate-profile-modal').modal('hide');
               table.ajax.reload(null, false);
            } else {
               Swal.fire({
                     icon: "error",
                     text: response.message
               });
            }
         },
         error: function(xhr) {
                  Swal.close();
                  let message = 'Error while duplicating Profile';
                  if (xhr.responseJSON && xhr.responseJSON.message) {
                     message = xhr.responseJSON.message;
                  }
                  swal_error_popup(message);
         }
   });
});



$(document).on('click', '.massage_action', async function () {

      let current_action = $(this).data('row-action');
      var mess = "";
      let rowId = $(this).data('row-id');
      let action = "";

      if(!current_action || !rowId )
      return false;

       mess =   'Do you want to '+current_action+' this Profile?';
       action = current_action;

      let mess_data = {
         'title' : 'NA',
         'text' : mess,
      }

      let post_data = {
         'action' : action,
         'profile_id':rowId
      }
   
      if(await isConfirm(mess_data))
      {
            swal_waiting_popup({
                'title': 'Updating...'
            });

            $.ajax({
               url: "{{ route('center.action-massage-profile') }}",
               type: 'POST',
               data: post_data,
               success: function(response) {
                  Swal.close();
                  if (response.success) {
                    table.ajax.reload(null, false);
                    swal_success_popup(response.message);
                  }
               },

               error: function(xhr) {
                  Swal.close();
                  let message = 'Error while saving profile';
                  if (xhr.responseJSON && xhr.responseJSON.message) {
                     message = xhr.responseJSON.message;
                  }
                  swal_error_popup(message);
               }
         });
      }

})




//////////////  BRB Form Submit ///////////////////
$('#brb_form').parsley({});

$("#brb_form").on('submit', function(e) 
{
   e.preventDefault();
   var form = $(this);
   var profileId = $("#profile_id").val();
   var url = "{{ route('massage.brb.add') }}";
   var data = new FormData(form[0]);
   var selectedProfileName = $('#profile_id option:selected').attr('profile_name');

   $.ajax({
         method: 'POST',
         url: url,
         data: data,
         contentType: false,
         processData: false,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(data) {
            if (data.response.success) {
               Swal.fire({
                     icon: "success",
                     text: data.response.message
               });
               $("#brb_form")[0].reset();
               $('#add_brb').modal('hide');
               table.ajax.reload(null, false);
            } else {
               Swal.fire({
                     icon: "error",
                     text: data.response.message
               });
            }
         },

   });
});


window.Parsley.addValidator('time', {
validateString: function(value) {
      // Regex to validate time in HH:MM format (24-hour)
      return /^([01]\d|2[0-3]):([0-5]\d)$/.test(value);
},
messages: {
      en: 'Please enter a valid time (HH:MM).'
}
});
////////////// End  BRB Form Submit ///////////////////


         /////////// Suspend Profile ////////////////////


       $(document).ready(function() {   

         let suspendProfileObject = $('#suspendProfileId');
         let suspendStartDateObject = $('#suspendStartDate');
         let suspendEndDateObject   = $('#suspendEndDate');

   
         suspendStartDateObject.datepicker('setDate', +1);
         suspendStartDateObject.datepicker('option', 'minDate', +1);
         suspendEndDateObject.datepicker('option', 'minDate', +1);


            suspendStartDateObject.on('change', function () {
               let selectedDate = $(this).val();
               suspendEndDateObject.datepicker('option', 'minDate', selectedDate);
               suspendEndDateObject.datepicker('setDate', selectedDate);
               calculateCredit();
            });

            suspendEndDateObject.on('change', function () {
               let selectedDate = $(this).val();

               suspendStartDateObject.datepicker('option', 'maxDate', selectedDate);

               calculateCredit();
            });


            suspendProfileObject.on('change', function() {
                  let selectedOption = $(this).find(':selected');
                  let listingMembership = selectedOption.data('membership');
                  let listingStartDate = selectedOption.data('start');
                  let listingEndDate = selectedOption.data('end');
                  let profileId = selectedOption.val();

                  suspendStartDateObject.datepicker('setDate', +1);
                  suspendStartDateObject.datepicker('option', 'minDate', +1);
                  suspendStartDateObject.datepicker('option', 'maxDate', listingEndDate);

                  suspendEndDateObject.datepicker('setDate', null);
                  suspendEndDateObject.datepicker('option', 'maxDate', listingEndDate);
                  $("#creditCalculationLive").html('0.00');
            });




            function calculateCredit() 
            {
                  let selectedOption = suspendProfileObject.find(':selected');
                  if(suspendEndDateObject.val() && suspendStartDateObject.val()){
                     $.ajax({
                     url: "{{ route('center.massage-suspend-credit') }}",
                     method: 'POST',
                     data: {
                        start_date: suspendStartDateObject.val(),
                        end_date: suspendEndDateObject.val(),
                        profile_id: selectedOption.val(),
                        
                     },
                     success: function(response) {
                        $("#creditCalculationLive").html('0.00');
                        if(response.success){
                              $("#creditCalculationLive").html(response.refund_amount);
                              $("#suspend_form").find('button[type=submit]').removeAttr('disabled');
                        }
                        else {
                              $("#suspend_form").find('button[type=submit]').attr('disabled','disabled');
                              Swal.fire({
                                 icon: "error",
                                 text: response.message
                              });
                        }
                     }
                  });
                  }
            }


      });


            



$("#suspend_form").on('submit', async function(e) 
{
   e.preventDefault();
   var form = $(this);
   var url = "{{ route('center.suspend-massage-profile') }}";
   var data = new FormData(form[0]);


     let mess_data = {'title' : 'NA','text' : 'Do you want to suspend this Profile?',}
   
      if(await isConfirm(mess_data))
      {
            swal_waiting_popup({
                'title': 'Suspending Profile.'
            });
           

            $.ajax({
               method: 'POST',
               url: url,
               data: data,
               contentType: false,
               processData: false,
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               beforeSend: function(){
                  $("#suspend_form").find('button[type=submit]').attr('disabled','disabled');
               },
               success: function(data) {
                  Swal.close();
                  if (data.response.success) {
                      swal_success_popup(data.response.message);
                     $('#suspend_profile').modal('hide');
                     table.ajax.reload(null, false);
                  } else {
                     swal_error_popup(data.response.message);
                  }
                  $("#suspend_form").find('button[type=submit]').removeAttr('disabled');
               },
            });

      }

});
////////////// End Suspend profile //////////////


///////////// Extend Profile ////////////////////

$(document).on('change','#extendProfileId', function () 
{
   let previousEndDateValue = $(this).find(':selected').data('end'); 
   let membership = $(this).find(':selected').data('membership');

   console.log('previousEndDateValue',previousEndDateValue);
   

   let $membershipField = $('#extendMembership');
   let extendStartDateObject = $('#extendStartDate');
   let extendEndDateObject = $('#extendEndDate');
   let profileId = $(this).val();
   if($.trim(profileId)!=""){
         extendEndDateObject.removeAttr('disabled');
         $("input[name='extend_days']").removeAttr('disabled');
   }
   else{
         extendEndDateObject.attr('disabled','disabled');
         $("input[name='extend_days']").attr('disabled','disabled');
   }
   
   if (previousEndDateValue) {
         extendStartDateObject.val(getDateAfter(previousEndDateValue,1));
         extendEndDateObject.val(getDateAfter(previousEndDateValue,1));
         extendEndDateObject.datepicker('option', 'minDate', extendStartDateObject.val());
   } else {
         extendEndDateObject.datepicker('option', 'minDate', null);
         extendEndDateObject.val('');
   }


     
         $('#extendDay1').attr('disabled',false);
         $('#extendDay1').prop('checked', true);
         is_load_first++;
      

   
      $('#extendMembership').val(membership);
});



// ########### Extend Profile ####################

$('input[name="extend_days"]').on('change', function () {
let days = parseInt($(this).val(), 10);
let previousEndDateValue = $('#extendProfileId').find(':selected').data('end');
let extendEndDateObject = $('#extendEndDate');

if (previousEndDateValue && days) {
      extendEndDateObject.val(getDateAfter(previousEndDateValue,days));
} else {
      extendEndDateObject.val('');
}
});


var getDateAfter = function(dateStr,after=1) {
            let [day, month, year] = dateStr.split('-');
            let date = new Date(year, month - 1, day);
            date.setDate(date.getDate() + after);
            return `${String(date.getDate()).padStart(2, '0')}-${String(date.getMonth() + 1).padStart(2, '0')}-${date.getFullYear()}`;
}


function formatDate(dateStr) {
    let [day, month, year] = dateStr.split('-');
    return `${year}-${month}-${day}`;
}

$(document).on('change', '#extendEndDate, #extendProfileId, .extend-period', function() {
let startDate = $('#extendStartDate').val();
let endDate = $('#extendEndDate').val();
let profile_Id = $('#extendProfileId').find(':selected').val();
let formButton = document.querySelector(".transaction_summury");

if(startDate && profile_Id){
      $.ajax({
      url: "{{ route('center.extend-profile-validate-date-range')}}",
      method: 'POST',
      headers: {
      'Accept': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      data: {startDate,endDate,profile_Id},
      beforeSend:function (){
         formButton.disabled = true;
         console.log(formButton);
      },
      success: function (response) {
         if(response.success){
            $('#extendEndDate').val('');
            Swal.fire({
                  title: 'Listings',
                  text: `${response.message}`,
                  icon: 'warning'
            });
         }
         formButton.disabled = false;

      },
      error: function (xhr, status, error) {
         console.error('Error in location filter:', error);
      }
      });
}
});


$(document).on('click', '.transaction_summury', function(e) {
    e.preventDefault();
    
   
    let profile_data = {
            profile_id : $('#extendProfileId').val(),
            membership : $('#extendMembership').val(),
            start_date : $('#extendStartDate').val(),
            end_date : $('#extendEndDate').val(),
    }

   if (!profile_data.profile_id || !profile_data.membership || !profile_data.start_date || !profile_data.end_date) {
   return;
   }
    
    $('#extend_profile').modal('hide');
    swal_waiting_popup({'title': 'Updating...'});
    $.ajax({
      method: 'POST',
      url: "{{ route('center.get-transaction-summury')}}",
      data: profile_data,
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
     
      success: function(response) 
      {
            $('#summaryBody').html('');
            Swal.close();
            if(response.success) 
            {
                  let resposne_data = response.data;
                  plandata = {
                     'membershipName' : 'Massage Centre',
                     'days' : resposne_data.days,
                     'normalRate' : resposne_data.rate,
                     'total_rate' : resposne_data.full_fee,
                     'total_discount' : resposne_data.discount,
                     'discountRate' : resposne_data.discount_fee,
                     'start_date' : resposne_data.start_date,
                     'end_date' : resposne_data.end_date,

                  }
                  
                  make_form_values(resposne_data);
                  let row = `
                     <tr>
                        <td>${resposne_data.listing}</td>
                        <td>${resposne_data.business_name}</td>
                        <td>${resposne_data.start_date}</td>
                        <td>${resposne_data.end_date}</td>
                        <td>${resposne_data.days}</td>
                        <td><span class="mr-2">$</span>${resposne_data.rate}</td>
                        <td><span class="mr-2">$</span>${resposne_data.full_fee}</td>
                        <td><span class="mr-2">$</span>${resposne_data.discount}</td>
                        <td><span class="mr-2">$</span>${resposne_data.discount_fee}</td>
                     </tr>
                     
                     <tr>
                        <td colspan="7" class="border-0"></td>
                        <td  class="text-center"><b>Total Fees:</b></td>
                        <td class="text-center"><span class="mr-2">$</span> ${resposne_data.discount_fee}</td>
                     </tr>`;

                     

                  $('#summaryBody').append(row);
                  $("#summaryModal").css("display","flex").hide().fadeIn();
         }
         else
         {
            $("#summaryModal").css("display","flex").hide().fadeIn();
         }
       },
   });  
});

$(document).on("click",".close-btn",function(e){
e.preventDefault();
$("#summaryModal").hide();
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

    if (await isConfirm({'action': 'Proceed','text': ''})) {

      let formData = $("#purchase_listing").serialize();
      $('#adjustment-form').append(`<input type="hidden" name="action_type" value="extend">`);
     
         console.log('plandata',plandata);
         //return false;
       

         $.ajax({
                    url: "{{route('center.listing-payment')}}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {

                     Swal.close();
                        // plandata.checkout_number = response.data.checkout_number? response.data.checkout_number: '';
                        // plandata.action_type = $('[name="action_type"]').val();
                        // console.log('plandata=>>>>>>',plandata);
                        // swal_waiting_popup({'title': 'Processing.'});

                        // let response_data  =  make_order_summury(plandata).done(function(summaryResponse) {
                        // console.log("updatedPlanSummary=>>>>>>> :", updatedPlanSummary); // updatedPlanSummary is Gobal varaible
                        // Swal.close();
                        // if (Object.keys(updatedPlanSummary?.data?.pay_data || {}).length > 0 && parseFloat(updatedPlanSummary.data.pay_data.total_amount) > 0){
                        // $('#adjustment-form')[0].reset();
                        // $('#payment-form')[0].reset();
                        // $("#process-payment-modal").modal({backdrop: 'static',keyboard: false,show: true});
                        // }
                        // }).fail(function(err) {
                        //     console.error('Summary Function Error:', err);
                        //     Swal.fire({ icon: 'error', title: 'Error', text: 'Summary error!' });
                        // });

                        table.ajax.reload(null, false);
                        Swal.close();
                        swal_success_popup(response.message);
                        let redirect = {'time': 2000, 'url' : 'listing/current'}
                        swal_success_popup(response.message,redirect);
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
});
// ########## End Listing Payment ################ //


let make_form_values = (frm_values) => {

   $('#no_of_days').val('');
   $('#total_fee').val('');
   $('#listing_start_date').val('');
   $('#listing_end_date').val('');
   $('#membership_id').val('');
   $('#massage_profile_id').val('');
   $('#rate').val('');
   $('#total_rate').val('');

   let days             = frm_values.days;
   let finalFee         = parseFloat(frm_values.discount_fee.replace(/,/g, '')); 
   let start            = frm_values.start_date;
   let end              = frm_values.end_date;
   let membership_id    = frm_values.membership;
   let profile_id       = frm_values.profile_id;
   let rate             = parseFloat(frm_values.rate.replace(/,/g, ''));
   let total_rate       = parseFloat(frm_values.discount_fee.replace(/,/g, '')); 
  
   $('#no_of_days').val(days);
   $('#total_fee').val(finalFee);
   $('#listing_start_date').val(formatDate(start));
   $('#listing_end_date').val(formatDate(end));
   $('#membership_id').val(membership_id);
   $('#massage_profile_id').val(profile_id);
   $('#rate').val(rate);
   $('#total_rate').val(total_rate);

}


// ########### Bumpup Profile #########################
let saveBumpupButton = document.getElementById("saveBumpupButton");
saveBumpupButton.disabled = true;
$(document).on('change','#bumpUpProfileId', function(){
    saveBumpupButton.disabled = !$(this).val().trim();
});

$("#bumpup_profile_form").on('submit', async function(e) 
{
   e.preventDefault();
   var form = $(this);
   var url = "{{ route('center.bumpup_register') }}";
   var data = new FormData(form[0]);

     let mess_data = {'title' : 'NA','text' : 'Do you want to Bump Up this Profile?',}
      if(await isConfirm(mess_data))
      {
            swal_waiting_popup({
                'title': 'Bumping Up Your Profile.'
            });
           

            $.ajax({
               method: 'POST',
               url: url,
               data: data,
               contentType: false,
               processData: false,
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               beforeSend: function(){
                  $("#saveBumpupButton").find('button[type=submit]').attr('disabled','disabled');
               },
               success: function(data) {
                     Swal.close();
                     
                     if (data.success) {
                        table.ajax.reload(null, false);
                        swal_success_popup(data.message);
                        $("#bumpup_profile").modal('hide');
                      
                     
                     }
                     else
                     {
                        swal_error_popup('Error occured while Bumping Up Profile');
                        $("#saveBumpupButton").find('button[type=submit]').removeAttr('disabled');
                     }
                
               },
               error: function(xhr) 
               {
                     Swal.close();
                     $("#saveBumpupButton").find('button[type=submit]').removeAttr('disabled');
                     let response = {};
                     try {
                        response = JSON.parse(xhr.responseText);
                     } catch (e) {}

                     if (xhr.status === 422) 
                     {
                        if (response.message) 
                        {
                              swal_error_popup(response.message);
                        } 
                        else if (response.errors) 
                        {
                              let messages = Object.values(response.errors)
                                 .flat()
                                 .join('<br>');

                              swal_error_popup(messages);
                        }
                        else
                        {
                              swal_error_popup('Validation error occurred.');
                        }
                     } 
                     else 
                     {
                        swal_error_popup(response.message || 'Something went wrong.');
                     }
               }
            });
      }
});

function openModal(url) 
{
    document.getElementById('modalFrame').src = url;
    var modal = new bootstrap.Modal(document.getElementById('iframeModal'));
    modal.show();
}

document.getElementById('iframeModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('modalFrame').src = '';
});

// ########### End Bumpup Profile #########################
       
</script>
@include('center.dashboard.payment_functions')
@endpush