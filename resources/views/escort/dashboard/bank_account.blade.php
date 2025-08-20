@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
      /* color: red; */
      list-style: none;
   }
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
    display: flex
;
    align-items: center;
    justify-content: center;
}

.key:hover {
  background: #0c223d;
  color: #fff;
}

/* Buttons */
.btn-secondary, .btn-primary {
  padding: 8px 20px;
  font-size: 16px;
  font-weight: bold;
}

</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->
   <div class="row">
      <div class="col-md-12 custom-heading-wrapper">
         <h1 class="h1">My Bank Account</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>

      </div>

      <div class="col-md-12 mb-4 collapse" id="notes">
         <div class="card">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b> </h3>
               <ol>
                  <li>Use this feature for displaying your Bank Account details for an Electronic
                     Funds Transfer (<b>EFT</b>). By using this feature for an EFT payment, you remove
                     the risk of having your bank account app open.</li>
                  <li>You can set up, update and add additional bank accounts by clicking the 'Add
                     New' button. SMS 2FA authentification is applied for any changes to your Bank
                     Account details, including the initial setup.</li>
                  <li>To display your Bank Account details to a client, select from the Action options
                     ‘EFT Client’, enter your PIN number, and your bank account details will display.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <div class="row mb-2">
      <div class="col-lg-12 col-md-12 col-sm-12">

         <div class="bothsearch-form">
            <button type="button" class="create-tour-sec dctour" data-toggle="modal"  data-target="#payid">PayID</button>
            <button type="button" class="create-tour-sec dctour" data-toggle="modal"  data-target="#SetPinModal">Change PIN</button>
            <button type="button" class="create-tour-sec dctour" data-toggle="modal"  id="commission-modal" data-target="#commission-report2">Add New Account</button>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12 mt-2">
         <div id="" class="table-responsive-xl">
            <table class="table" id="bankAccountTable">
               <thead class="table-bg">
                  <tr>
                     <th scope="col">Bank</th>
                     <th scope="col">Account Name</th>
                     <th scope="col">BSB</th>
                     <th scope="col">Account Number</th>
                     <th scope="col">Account Status</th>
                     <th scope="col" class="text-center">Action</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </div>
</div>
{{-- PayID Change PIN action btn--}}
{{-- <button class="btn-success-modal" data-toggle="modal" data-target="#AddNewAccountConfirm">New Bank Account added </button>
<button class="btn-success-modal" data-toggle="modal" data-target="#AddPayId">PayID </button>
<button class="btn-success-modal" data-toggle="modal" data-target="#EFTInstructions">EFT Instructions </button> --}}

</div>
</div>

<div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title"><img src="/assets/dashboard/img/add-new-account.png" class="custompopicon" alt="cross"> Add New Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 escort-tour">
            <form id="escort_bank" method="post" action="{{ route('escort.save.bank.details')}}">
               @csrf
               <input type="hidden" name="bankId" value="" id="bankId">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Bank</label>
                        <select class="custom-select" name="bank_name" id="bank_name" required data-parsley-required-message="Plese select bank name">
                           <option value="" disabled selected>Select Bank</option>
                           @foreach(config('escorts.profile.escortBankDetails') as $key => $bankName)
                           <option value="{!!$bankName!!}">{{$bankName}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" class="form-control" placeholder="Account Name" name="account_name" id="account_name" required data-parsley-required-message="Please enter your account number">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>BSB</label>
                        <input type="text " required class="form-control" placeholder="BSB" name="bsb" id="bsb" data-parsley-required-message="Please enter your BSB number" data-parsley-type="digits" data-parsley-type-message="Enter only numbers">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" required placeholder="Account Number" id="account_number" name="account_number" data-parsley-required-message="Please enter your account number" data-parsley-type="digits" data-parsley-type-message="Enter only numbers">
                        <div id="account_numberError"></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Account Status</label>
                        <select class="custom-select" name="state" id="state" required data-parsley-required-message="Please select state">
                           <option value="">Select State</option>
                           <option value="1">Primary Account</option>
                           <option value="2">Secondary Account</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                        <button type="submit" class="btn-success-modal float-right">Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal" id="sendOtp_modal" style="display: none">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custome_modal_max_width">
         <form id="SendBankOtp" method="post" action="">
            @csrf
            <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title text-white"><img src="{{ asset('assets/app/img/face-lock.png') }}" style="width:40px;" alt="face-lock verification"> 2FA Verification</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">
                     <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
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
                        log in.
                     </li>
                     <li>We have sent you your verification code according to your preference, please
                        insert your verification code.
                     </li>
                  </ol>
                  <div class="d-flex align-items-center justify-content-between gap-10">
                     <input type="password" maxlength="4" required class="form-control w-75" name="otp" id="otp" aria-describedby="emailHelp" placeholder="Enter One Time Password" data-parsley-required-message="One Time Password is required">
                     <button type="submit" class="otp-verify-btn w-25" id="sendOtpSubmit">Verify</button>
                  </div>
                  {{-- <input type="password" maxlength="4"  required class="form-control" name="otp" id="otp" aria-describedby="emailHelp" placeholder="Enter One Time Password" data-parsley-required-message="One Time Password is required"> --}}
                  <div class="termsandconditions_text_color">
                     @error('opt')
                     {{ $message }}
                     @enderror
                  </div>
                  <input type="hidden" name="phone" id="phoneId" value="">
               </div>
               <div id="senderror"></div>
            </div>
            <div class="modal-footer forgot_pass pt-0 pb-4 justify-content-center">
               {{-- <button type="submit" class="btn main_bg_color site_btn_primary" id="sendOtpSubmit">Send</button> --}}
               <p class="pt-2">Not received your code? <a href="#" id="resendOtpSubmit" class="termsandconditions_text_color">Resend Code</a></p>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal programmatic" id="delete_bank" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content custome_modal_max_width">
         <div class="modal-header main_bg_color border-0">

            <h5 class="modal-title text-white"><img src="/assets/dashboard/img/remove-bank-account.png" class="custompopicon" alt="cross"> Delete Bank Account</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" id="previous" name="url">
            <input type="hidden" id="label" name="label">
            <input type="hidden" id="trigger-element">
            <h3 class="mb-2 mt-3"><span id="Lname"></span> </h3>
            <h3 class="mb-4 mt-2"><span id="log"></span> </h3>
            <div class="modal-footer">
               <button type="button" class="btn-success-modal" data-dismiss="modal" value="close" id="close_change">Close</button>
               <button type="button" class="btn-cancel-modal" id="save_change">Delete</button>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- New Bank Account added  --}}
<div class="modal fade upload-modal" id="AddNewAccountConfirm" tabindex="-1" role="dialog"
         aria-labelledby="escortProfileMissingLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">

            <div class="modal-header">
                  <h5 class="modal-title">
                     <img src="{{ asset('assets/dashboard/img/add-new-account.png') }}" style="width:40px; padding-right:10px;" class="modal_title_img">New Bank Account added
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                              class="img-fluid img_resize_in_smscreen">
                     </span>
                  </button>
            </div>

            <div class="modal-body pb-0 agent-tour">
                  <div class="row">
                     <div class="col-md-12 my-4">
                        <p class="font-weight-bold">We confirm:</p>
                        <ol>
                           <li>Bank Account <span>526985412036</span> has been added to your
                              list of Bank Accounts as a <span>Primary or Secondary</span>
                              account.</li>
                           <li>You can edit the details by clicking the 'Action' link.</li>
                           <li>Your default PIN is <span>1234</span> which you can reset by clicking
                              the Change PIN button.</li>
                        </ol>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12 mb-3">
                        <div class="form-group d-flex align-items-center justify-content-center">
                              <button type="button" class="btn-success-modal " data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
            </div>

         </div>
      </div>
</div>
{{-- End Modal --}}


{{-- PayID for Payer [X] --}}
<div class="modal fade upload-modal" id="AddPayId" tabindex="-1" role="dialog"
         aria-labelledby="escortProfileMissingLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">

            <div class="modal-header">
                  <h5 class="modal-title">
                     <img src="{{ asset('assets/dashboard/img/payer.png') }}" style="width:40px; padding-right:10px;" class="modal_title_img">PayID for Payer 
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                              class="img-fluid img_resize_in_smscreen">
                     </span>
                  </button>
            </div>

            <div class="modal-body pb-0 agent-tour">
                  <div class="row">
                     <div class="col-md-12 my-4">
                        <ol class="pl-3">
                           <li class="pl-3">My PayID number is: <span class="font-weight-bold">1234567890</span></li>                           
                           
                           <li class="pl-3">Account name: <span>XYZ65464</span></li>
                        </ol>
                        <p>Thank you for your payment.</p>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12 mb-3">
                        <div class="form-group d-flex align-items-center justify-content-center">
                              <button type="button" class="btn-success-modal " data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
            </div>

         </div>
      </div>
</div>
{{-- End Modal --}}

{{-- EFT Instructions for Payer [X] --}}
<div class="modal fade upload-modal" id="EFTInstructions" tabindex="-1" role="dialog"
         aria-labelledby="escortProfileMissingLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">

            <div class="modal-header">
                  <h5 class="modal-title">
                     <img src="{{ asset('assets/dashboard/img/payer.png') }}" style="width:40px; padding-right:10px;" class="modal_title_img">EFT Instructions for Payer
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                              class="img-fluid img_resize_in_smscreen">
                     </span>
                  </button>
            </div>

            <div class="modal-body pb-0 agent-tour">
                  <div class="row">
                     <div class="col-md-12 my-4">
                        <ol class="pl-3">
                           <li class="pl-3">EFT your payment to this bank account: </li>                           
                              <p class="pl-3 d-flex justify-content-start"><span class="w-25">BSB:</span> <span class="font-weight-bold">123 445</span></p>
                              <p class="pl-3 d-flex justify-content-start"><span class="w-25">A/c Number:</span> <span class="font-weight-bold">123-1235</span></p>
                           <li class="pl-3">Please email your payment receipt to:</li>
                           <p class="pl-3"><a href="#">Escort email</a></p>
                        </ol>
                        <p>Thank you for your payment.</p>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12 mb-3">
                        <div class="form-group d-flex align-items-center justify-content-center">
                              <button type="button" class="btn-success-modal " data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
            </div>

         </div>
      </div>
</div>
{{-- End Modal --}}

{{-- set pin --}}
<div class="modal fade upload-modal" id="SetPinModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
      <div class="modal-header justify-content-center text-center">
         <!-- Title -->
         <h5 class=""><b>Set your PIN</b> <br><small>(4 digits)</small></h5>
      </div>
 
       <div class="modal-body text-center p-0">
         <!-- PIN Display -->
         <div id="pinDisplay" class="pin-display mb-3">
           [numbers appear as typed]
         </div>
 
         <!-- Keypad -->
         <div class="pin-keypad mx-auto mb-3">
           <div class="keypad-row">
             <button class="key input_value">1</button>
             <button class="key input_value">2</button>
             <button class="key input_value">3</button>
           </div>
           <div class="keypad-row">
             <button class="key input_value">4</button>
             <button class="key input_value">5</button>
             <button class="key input_value">6</button>
           </div>
           <div class="keypad-row">
             <button class="key input_value">7</button>
             <button class="key input_value">8</button>
             <button class="key input_value">9</button>
           </div>
           <div class="keypad-row">
             <button class="key" id="clear">⌫</button>
             <button class="key input_value">0</button>
             <button class="key" id="ok">OK</button>
           </div>
         </div>
 
         <!-- Footer Buttons -->
         <div class="d-flex justify-content-center mb-3">
           <button type="button" class="btn-cancel-modal mr-3">Clear</button>
           <button type="button" class="btn-success-modal">Save</button>
         </div>
 
       </div>
     </div>
   </div>
 </div>
 
{{-- end modal --}}
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function(){
      let fClick = true;
      $('.input_value').click(function(){
         let inputValue = $(this).text();
         if(fClick){
            $('#pinDisplay').empty();
               fClick = false;            
         }
         $('#pinDisplay').append(inputValue);
         
      });
      $('#clear').click(function(){
         $('#pinDisplay').text(' ');
      });
         $("#ok").click(function(){
            alert('Your Pin Set');
            $('#pinDisplay').text(' ');
         });
   })
</script>
<script>
   $("#escort_bank").parsley({

   });
   $("#SendBankOtp").parsley({

   });

   $("#commission-modal").click(function() {
      console.log("hello");
      $("#commission-report").modal('show');
      $('#bank_name').attr('disabled', false);
      $("form").attr('autocomplete', 'off');
   })

   $('body').on('show.bs.modal', '#commission-report', function(event) {
      button = $(event.relatedTarget);

      //$('.parsley-required').css('list-style-type', 'disc');
      $("form #escort_bank").attr('autocomplete', 'on');
      const bank = $(button).data('name');
      if ($(button).data('target') == "#commission-report") {
         $('#bank_name').attr('disabled', true);
      }

      $('#bank_name').val($(button).data('bank_name'));
      $('#account_name').val($(button).data('ac_name'));
      $('#account_number').val($(button).data('ac_number'));
      $('#bsb').val($(button).data('bsb'));
      $('#state').val($(button).data('state'));
      $('#bankId').val($(button).data('id'));
      console.log("target = ", $(button).data('target'));
      //document.getElementById("bank_name").value = bank;
   });
   $('body').on('hidden.bs.modal', '#commission-report', function() {
      console.log("taasdasd");
      $('#escort_bank')[0].reset();

      $('.parsley-required').html('');

   });


   $(document).ready(function() {
      var table = $('#bankAccountTable').DataTable({
         language: {
            search: "_INPUT_",
            searchPlaceholder: "Search by Account Number",
            sSearch: 'Search:'

         },
         info: true,
         bLengthChange: true,
         processing: true,
         serverSide: true,
         lengthChange: true,
         order: [1, 'asc'],
         searchable: false,
         bStateSave: false,
         "language": {
                    "zeroRecords": "There is no record of the search criteria you entered.",
                },
         ajax: {
            url: "{{ route('escort.bankDetail.dataTable') }}",
            data: function(d) {
               d.type = 'player';
            }
         },
         columns: [{
               data: 'bank_name',
               name: 'bank_name',
               searchable: true,
               orderable: true,
               defaultContent: 'NA'
            },
            {
               data: 'account_name',
               name: 'account_name',
               searchable: true,
               orderable: true,
               defaultContent: 'NA'
            },
            {
               data: 'bsb',
               name: 'bsb',
               searchable: true,
               orderable: true,
               defaultContent: 'NA'
            },
            {
               data: 'account_numbers',
               name: 'account_numbers',
               searchable: true,
               orderable: true,
               defaultContent: 'NA'
            },
            {
               data: 'states',
               name: 'states',
               searchable: true,
               orderable: true,
               defaultContent: 'NA'
            },
            {
               data: 'action',
               name: 'edit',
               searchable: false,
               orderable: false,
               defaultContent: 'NA'
            }, // only this no sorting
         ],
         initComplete: function() {
            // Reposition the filter and length
            let filter = $('#bankAccountTable_filter');
            let length = $('#bankAccountTable_length');

            filter.add(length).wrapAll('<div class="datatable-topbar"></div>');
            filter.parent().prepend(filter);

            if ($('#returnToReportBtn').length === 0) {
               $('.dataTables_filter').append(
                  '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
               );
            }
            $('#returnToReportBtn').on('click', function() {
               var table = $('#bankAccountTable').DataTable();
               table.search('').draw();
            });
         }
      });
   });

   $(function() {
      //   $.ajaxSetup({
      //      headers:
      //      { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      //   });
      $("body").on('submit', '#escort_bank', function(e) {
         e.preventDefault();
         console.log("bank id");
         var form = $(this);
         var url = form.attr('action');
         var data = new FormData(form[0]);
         $('#account_numberError').text('');
         $.ajax({
            method: form.attr('method'),
            url: url,
            data: data,
            contentType: false,
            processData: false,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
               console.log(data);
               if (data.error == false) {
                  // if(data.id != null) {
                  $("#otp").val('');
                  $("#sendOtp_modal").modal('show'); //
                  $("#commission-report").modal('hide');
                  $("body").on("submit", "#SendBankOtp", function(e) {
                     e.preventDefault();
                     var form = $(this);


                     // var url = form.attr('action');
                     var url = "{{ route('escort.checkOTP')}}";

                     var data = new FormData($('#SendBankOtp')[0]);
                     var phone = data.phone;
                     //data.append("phone",phone );
                     console.log("url=" + url);
                     var token = $('input[name="_token"]').attr('value');

                     $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        headers: {
                           'X-CSRF-Token': token
                        },
                        success: function(data) {
                           console.log(data);

                           if (data.error == 0) {
                              $('.comman_msg').html("Saved");
                              $("#comman_modal").modal('show');
                              $("#sendOtp_modal").modal('hide');
                              table.draw();
                           }
                           if (data.error == 2) {
                              $('.comman_msg').html("Please select primary account");
                              $("#comman_modal").modal('show');
                              $("#sendOtp_modal").modal('hide');
                              table.draw();
                           }
                           if (data.error == 3) {
                              $('.comman_msg').html("Primary account not updated");
                              $("#comman_modal").modal('show');
                              $("#sendOtp_modal").modal('hide');
                              table.draw();
                           }
                        },
                        error: function(data) {

                           console.log("error otp: ", data.responseJSON.errors);
                           $.each(data.responseJSON.errors, function(key, value) {
                              errorsHtml = '<div class="alert alert-danger"><ul>';
                              errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                           });

                           errorsHtml += '</ul></di>';
                           $('#senderror').html(errorsHtml);
                        }
                     });

                  });
                  //}
                  // $('.comman_msg').html("Saved");
                  // $("#comman_modal").modal('show');

                  //window.location.reload();
               } else {
                  console.log(data);
               }

            },
            error: function(data) {
               console.log(data.responseJSON.errors);
               console.log(data.responseJSON.errors.account_number);
               $('#account_numberError').text(data.responseJSON.errors.account_number);
            }

         })
      })

   });

   $('body').on('hidden.bs.modal', '#delete_bank', function() {
      console.log("delete-bank");
      // $('#delete_bank').reset();

      // $("#previous").val('');
      $("#previous input:hidden").val(' ');

   });
   $(document).on('click', '.delete_bankModal', function(e) {
      e.preventDefault();
      var $this = $(this);

      $("#previous").val($this.attr('href'));
      console.log($this.attr('href'));
      $("#Lname").html("<p>Would you like to Delete?</p>");
      $('#delete_bank').modal('show');
      // $("#delete_bank").load(target, function() {

      // });
   });
   $("body").on('click', '#save_change', function(e) {
      console.log("url==", $("#previous").val());
      var url = $("#previous").val();
      var table = $("#bankAccountTable").DataTable();
      $.ajax({
         method: "POST",
         url: url,
         contentType: false,
         processData: false,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(data) {
            console.log(data);
            if (data.error == false) {
               console.log("sdfjsdhfsjd", data);
               table.draw();
               $('#delete_bank').modal('hide');
               $("#header_msg").html("Delete Profile");
               $('.comman_msg').html("Deleted ");
               $("#comman_modal").modal('show');

            }
            if (data.error == true) {
               table.draw();
               $('#delete_bank').modal('hide');
               $('.comman_msg').html("Primary Account can not be deleted. ");
               $("#header_msg").html("Delete Profile");
               $("#comman_modal").modal('show');

            }
         }

      })
   });
</script>
@endpush