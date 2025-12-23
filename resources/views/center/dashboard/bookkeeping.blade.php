@extends('layouts.center') 
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

.payer-lable {
    
    display: inline-block;
    width: 25%;
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


   .shake {
      animation: shake 0.3s;
      border: 2px solid red;
      color: red;
   }
    .otp-error {
      border: 1px solid red !important;
      box-shadow: 0 0 0 0.15rem rgba(255, 0, 0, 0.25);
   }
 
   #otpError{
      color:red;
      font-size: 13px;
   }

   @keyframes shake {
      0% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      50% { transform: translateX(5px); }
      75% { transform: translateX(-5px); }
      100% { transform: translateX(0); }
   }
   .wrong_pin_hide_details{
      filter: blur(3px);
   }
   .parsley-errors-list{
      padding-left: 0px !important;
   }

</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 wrong_pin_hide_details">
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
                  <li>To display your Bank Account details, enter your PIN number.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <div class="row mb-2">
      <div class="col-lg-12 col-md-12 col-sm-12">

         <div class="bothsearch-form d-flex gap-20">
            <button type="button" class="create-tour-sec dctour" data-toggle="modal"  data-target="#payid">PayID</button>
            <button type="button" class="create-tour-sec dctour" id="change_pin_modal">Change PIN</button>
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
                     <th scope="col" >Action</th>
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
            <h5 class="modal-title"><img src="/assets/dashboard/img/add-new-account.png" class="custompopicon" alt="cross"> <span class="commission_report_title">Add New Account</span> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 escort-tour">
            <form id="massage_bank" method="post" action="{{ route('massage.save.bank.details')}}">
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
                        <button type="submit" class="btn-success-modal float-right save_button">Save</button>
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
                  <span id="otpError" class="d-none"></span>
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
               <input type="hidden" value="0" name="change_pin_active" id="change_pin_active">
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
         <div class="modal-body text-center">
            <input type="hidden" id="previous" name="url">
            <input type="hidden" id="label" name="label">
            <input type="hidden" id="trigger-element">
            <h5 class="mb-2 mt-3"><span id="Lname"></span> </h5>
            <h3 class="mb-4 mt-2"><span id="log"></span> </h3>
            <div class="modal-footer justify-content-center">
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
      <div class="modal-dialog modal-dialog-centered"  role="document">
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

{{-- enter pin modal to see your bank details --}}
<div class="modal fade upload-modal" id="EnterPinModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-dialog-centered"  style="max-width: 500px;" role="document">
     <div class="modal-content">
      <div class="modal-header justify-content-center text-center">
         <!-- Title -->
         <h5 class=""><b>Enter your PIN</b> <br><small>(4 digits)</small></h5>
      </div>
 
       <div class="modal-body text-center p-0" >
         <!-- PIN Display -->
         <div class="overflow-hidden">
            <div id="pinDisplay" class="pin-display mb-3">
            Numbers appear as typed
            </div>
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
             <button class="key" id="pinok">OK</button>
           </div>
         </div>
 
         <!-- Footer Buttons -->
         {{-- <div class="d-flex justify-content-center mb-3">
           <button type="button" class="btn-cancel-modal mr-3">Clear</button>
           <button type="button" class="btn-success-modal">Confirm</button>
         </div> --}}
 
       </div>
     </div>
   </div>
 </div>
 
{{-- end modal --}}

{{-- instruction payer  modal to see your bank details --}}
<div class="modal fade upload-modal" id="InstructionPayerModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;" role="document">
     <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title"><img src="/assets/dashboard/img/add-new-account.png" class="custompopicon" alt="cross"> Instructions for Payer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="http://127.0.0.1:8000/assets/app/img/newcross.png" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
      {{-- <div class="modal-header justify-content-between ">
         <!-- Title -->
         <h5 class=""><b>Instructions for Payer </b></h5>
      </div> --}}
 
       <div class="modal-body">
         <ol class="text-left">
            <li class="pl-3">EFT your payment to this bank account:
               <ul class="text-left list-unstyled instruction-list">
                  <li><span class="payer-lable">BSB: </span> <span class="font-weight-bold primary_bsb"> 123 445</span></li>
                  <li><span class="payer-lable">A/C Number: </span> <span class="font-weight-bold primary_acc_no"> 123-1235</span></li>
               </ul>
            </li>
            <li class="pl-3">Please email your payment receipt to:
               <ul class="text-left list-unstyled ">
                  <li><a href="#">Escort email</a></li>
               </ul>
            </li>
         </ol>
         <!-- PIN Display -->
         {{-- <div id="pinDisplay" class="pin-display mb-3">
           [numbers appear as typed]
         </div> --}}
 
         <!-- Keypad -->
         <div class="pin-keypad mx-auto mb-3">
           
         </div>
 
         <!-- Footer Buttons -->
         <div class="d-flex justify-content-center mb-3">
            {{-- <button type="button" class="btn-cancel-modal mr-3">Close</button> --}}
            <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
         </div>
 
       </div>
     </div>
   </div>
 </div>
 
{{-- end modal --}}

{{-- eft modal popup start here --}}

 <div class="modal fade upload-modal show" id="viewEftBankdetails" tabindex="-1" role="dialog"
        aria-labelledby="editStaffnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStaffnewTitle"><img
                            src="{{ asset('assets/dashboard/img/add-new-account.png') }}" class="custompopicon">Bank Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-content" id="modalViewStaffContent">
 
                        <div class="col-12 my-2">
                            <h6 class="border-bottom pb-1 text-blue-primary">Bank Details</h6>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="40%">Bank</th>
                                        <td width="60%" class="eftBankName">123</td>
                                    </tr>
                                    <tr>
                                        <th width="40%">Account Name</th>
                                        <td width="60%" class="eftAccountName">Shiv</td>
                                    </tr>
                                    <tr>
                                        <th width="40%">BSB</th>
                                        <td width="60%" class="eftBSBName">255642561</td>
                                    </tr>
                                    <tr>
                                        <th>Account Number</th>
                                        <td class="eftAccountNumber"> Xyz</td>
                                    </tr>
                                    <tr>
                                        <th>Account Status</th>
                                        <td class="eftAccountStatus">444444444444</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <div class="modal-footer justify-content-center p-0">
                            <button type="button" class="btn-success-modal" data-dismiss="modal">Ok</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

{{-- eft modal popup end here --}}

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
         <div id="pinDisplaySet" class="pin-display mb-3">
           Nnumbers appear as typed
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
 
         <!-- Footer Buttons -->
         {{-- <div class="d-flex justify-content-center mb-3">
           <button type="button" class="btn-cancel-modal mr-3 clear_at_once">Clear</button>
           <button type="button" class="btn-success-modal save_new_pin">Save</button>
         </div> --}}
 
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
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function(){

      $('#EnterPinModal').modal('show');

      let fClick = true;
      let fClick2 = true;
      var isClickEft = false;
      var eftAccountId = 0;

      // For pinDisplay
      $('.input_value').click(function () {
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
      $('.input_value_pin').click(function () {
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

      $('#clear').click(function(){
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

      $('#clearSetPin').click(function(){
         let el2 = $('#pinDisplaySet');
         let text2 = el2.text();

         if (text2.length > 0) {
            el2.text(text2.slice(0, -1));
         }
      });

      $('.clear_at_once').click(function(){
         let el2 = $('#pinDisplaySet');
         let text2 = el2.text('');
      });

      $("#ok").click(function(){
         const pinDisplay = $('#pinDisplaySet');
         const textEl = document.getElementById("pinDisplaySet");
         let pin = pinDisplay.text().trim();
         let url = "{{ route('massage.update.bank.pin') }}";
         
         updateBankPinByAjax(url, pin);
      });

      function sendGlobalAjaxRequest(params,formData) 
      {
         url = params.url;
         actionMethod = params.method;
         var token = $('input[name="_token"]').attr('value');

         $.ajax({
            url: url,
            type: actionMethod,
            data: formData,
            dataType: "JSON",
            headers: {
               'X-CSRF-Token': token
            },
            success: function(data) {
               console.log('data jiten ');
               console.log(data, data.eft_bank);
               if(data.error == false && data.type == 'eft'){
                  $('.eftBankName').text(data.eft_bank.bank_name);
                  $('.eftAccountName').text(data.eft_bank.account_name);
                  $('.eftBSBName').text(data.eft_bank.bsb);
                  $('.eftAccountNumber').text(data.eft_bank.account_number);
                  $('.eftAccountStatus').text(data.eft_bank.state == 1 ? 'Primary Account' : 'Secondary Account');

                  $("#viewEftBankdetails").modal('show');
               }
               
            },
            error: function(data) {

               console.log("error otp: ", data.responseJSON.errors);
               
            }
         });   
      }
         
      $("#pinok").click(function () {
         const pinDisplay = $('#pinDisplay');
         const textEl = document.getElementById("pinDisplay");
         let pin = pinDisplay.text().trim();

         let existingPin = "{{ auth()->user()->user_bank_pin }}";

         if (pin === existingPin) {
            $('#EnterPinModal').modal('hide');
            if(isClickEft == true){
                // show eft bank details
                $('#InstructionPayerModal').modal('hide');
                let eftBankAccountId =  eftAccountId;
                
                var params = {
                     'url': "{{ route('massage.get.eft.bank.details') }}",
                     'method': 'POST',
                };

                var data = {
                    'bank_id': eftBankAccountId,
                    'type': 'eft',
                };

                sendGlobalAjaxRequest(params,data);

            }else{
                $('#InstructionPayerModal').modal('show');
            }
            
            pinDisplay.text('');
            $(".container-fluid").removeClass("wrong_pin_hide_details");
         } 
         else {
            const storedPin = localStorage.getItem('original_pin') || pin;
            
            $(".container-fluid").addClass("wrong_pin_hide_details");
            textEl.classList.add("shake");
            pinDisplay.text('Enter your correct PIN');

            setTimeout(() => {
                  textEl.classList.remove("shake");
                  pinDisplay.text(pin); // ✅ restore original PIN
            }, 300);
         }
      });

      $(document).on('click','.eftClientOption', function () {
        $('#EnterPinModal').modal('show');
         eftAccountId = $(this).data('id');
        isClickEft =  true;
      });

   })
</script>
<script>
   $("#massage_bank").parsley({

   });
   $("#SendBankOtp").parsley({

   });

   $("#commission-modal").click(function() {
      $("#commission-report").modal('show');
      $('#bank_name').attr('disabled', false);
      $("form").attr('autocomplete', 'off');
   })

   $(function() {
      var is_primary_bank_acc = 0;
      var primary_bank_acc_id = 0;
      var previous_state = 0;

      var primary_bank_ac_no = '';
      var primary_bank_bsb = '';
      var isBankAccountChanged = false;

      $(document).on('click', '#commission-modal', function() {
         $(".commission_report_title").text('Add New Bank Account');
         $(".save_button").text('Save');
         $("#bankId").val('');
         isBankAccountChanged = false;
      });

      $(document).on('click', '.editModal', function() {
         let id = $(this).data('id');
         let bank = $(this).data('bank_name');
         let accountName = $(this).data('ac_name');
         let bsb = ($(this).data('bsb'));
         // let bsb = ($(this).data('bsb')).replaceAll('-', '');
         let accountNumber = $(this).data('ac_number');
         let state = $(this).data('state');
         previous_state  = state;
         isBankAccountChanged = true;
         
         $('#bankId').val(id);
         $('#bank_name').val(bank).change(); 
         $('#account_name').val(accountName);
         $('#bsb').val(bsb);
         $('#account_number').val(accountNumber);
         $('#state').val(state).change();
         $('.modal_form').text('Update Details');

         $(".commission_report_title").text('Edit Bank Account');
         $(".save_button").text('Update');

         $('#commission-report').modal({
            backdrop: 'static',
            keyboard: false
         });
      });

      $('body').on('hidden.bs.modal', '#commission-report', function() {
         $('#massage_bank')[0].reset();

         $('.parsley-required').html('');

      });

      var table = $('#bankAccountTable').DataTable({
         language: {
            search: "_INPUT_",
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
                     searchPlaceholder: "Search by Account Number"
                },
         ajax: {
            url: "{{ route('massage.bankDetail.dataTable') }}",
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

      table.on('xhr.dt', function () {
         var json = table.ajax.json();
         is_primary_bank_acc = json.primary_account;
         primary_bank_acc_id = json.primary_bank_acc_id;

         primary_bank_ac_no = json.primary_bank_ac_no != 0 ? json.primary_bank_ac_no : 'N/A';
         primary_bank_bsb = json.primary_bank_bsb != 0 ? json.primary_bank_bsb : 'N/A';

            $('.primary_acc_no').text(primary_bank_ac_no);
            $('.primary_bsb').text(primary_bank_bsb);
      });

      $("body").on('submit', '#massage_bank', function(e) {
         e.preventDefault();

         let isValid = true;
         $("#replace").val(''); 
         var state  = ($("#state").val()).toString();
         var bankId  = $("#bankId").val();
         var form = $(this);
         var url = form.attr('action');
         var data = new FormData(form[0]);
         $('#account_numberError').text('');

         is_primary_bank_acc = is_primary_bank_acc.toString();
         

         //////// Saving Conditions //////////////////////
         if(bankId == '')
         {
               if((is_primary_bank_acc != '1' || is_primary_bank_acc != 1) && state == '2')
               {
                  Swal.fire({
                     title: "You don't have a Primary bank account.",
                     text: "Do you want to save it as Primary bank account?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, save it as Primary bank account",
                     cancelButtonText: "No, save it as Secondary bank account",
                  }).then((result) => {
                     if (result.isConfirmed) {
                           $("#state").val(1); 
                           //submitForm();
                           submitFormByAjax(form, url, data, table)
                           return true;
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           $("#state").val(2); 
                           //submitForm();

                     }
                  });
               } 
               else if((is_primary_bank_acc == '1' || is_primary_bank_acc == 1) && state == '1')
               {
                  Swal.fire({
                     title: "You already have Primary bank account.",
                     text: "Do you want to replace it as Primary bank account?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, replace it as Primary bank account",
                     cancelButtonText: "No, save it as Secondary account",
                  }).then((result) => {
                     if (result.isConfirmed) {
                           $("#replace").val('yes'); 
                           $("#state").val(1);  
                           submitFormByAjax(form, url, data, table)
                           return true;
                     
                           //submitForm();
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           $("#replace").val('no'); 
                           $("#state").val(2); 
                           //submitForm();
                           submitFormByAjax(form, url, data, table)
                           return true;
                     }
                  });
               }
               else if((is_primary_bank_acc == '1' || is_primary_bank_acc == 1) && state == '2')
               {
                  Swal.fire({
                     title: "",
                     text: "Do you want to save this bank account as Secondary bank account?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, save it as Secondary bank account",
                     cancelButtonText: "Cancel",
                  }).then((result) => {
                     if (result.isConfirmed) {
                           $("#state").val(2);  
                           submitFormByAjax(form, url, data, table)
                           return true;
                           //submitForm();
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           Swal.close(); 
                     }
                  });
               }
               else if(is_primary_bank_acc=='0' && state=='1')
               {
               Swal.fire({
                     title: "",
                     text: "Do you want to save this bank account as Primary bank account?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, save it as Primary bank account",
                     cancelButtonText: "Cancel",
                  }).then((result) => {
                     if (result.isConfirmed) {
                           $("#state").val(1);  
                           //submitForm();
                           submitFormByAjax(form, url, data, table)
                           return true;
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           Swal.close(); 
                     }
                  });  
               }
         }
         else
         {
               
               ////// Save at its normally ///////////
               if(previous_state==state)
               {

                  Swal.fire({
                     title: "",
                     text: "Do you want update the bank account details ?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, update the bank account details",
                     cancelButtonText: "Cancel",
                  }).then((result) => {
                     if (result.isConfirmed) { 
                           //submitForm();
                           submitFormByAjax(form, url, data, table)
                           return true;
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           Swal.close(); 
                     }
                  });
               }
               

               //////// Updating as primary account //////////////////////
               else if( (previous_state!=state) &&  is_primary_bank_acc=='0' && previous_state=='2' && state=='1')
               {
               Swal.fire({
                     title: "",
                     text: "Do you want to save this bank account as Primary bank account?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, save it as Primary bank account",
                     cancelButtonText: "Cancel",
                  }).then((result) => {
                     if (result.isConfirmed) {
                           //submitForm();
                           submitFormByAjax(form, url, data, table)
                           return true;
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           Swal.close(); 
                     }
                  });  
               }

               else if( (previous_state!=state) &&  is_primary_bank_acc=='1' && previous_state=='2' && state=='1')
               {
               Swal.fire({
                     title: "",
                     text: "Do you want to save this bank account as Primary bank account?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, save it as Primary bank account",
                     cancelButtonText: "Cancel",
                  }).then((result) => {
                     if (result.isConfirmed) {
                           $("#replace").val('yes');    
                           //submitForm();
                           submitFormByAjax(form, url, data, table)
                           return true;
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           Swal.close(); 
                     }
                  });  
               }

               //////// Updating as Secondry account //////////////////////
               else if( (previous_state!=state) &&  is_primary_bank_acc=='1' && previous_state=='1' && state=='2')
               {
               Swal.fire({
                     title: "This account is your Primary account.",
                     text: "Do you want to replace it as Secondry bank account?",
                     iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                     customClass: {
                           icon: 'my-custom-icon'
                     },
                     showCancelButton: true,
                     confirmButtonText: "Yes, replace it as Secondry bank account",
                     cancelButtonText: "Cancel",
                  }).then((result) => {
                     if (result.isConfirmed) {
                           $("#replace").val('yes');                 
                           //submitForm();
                           submitFormByAjax(form, url, data, table)
                           return true;
                     } 
                     else if (result.dismiss === Swal.DismissReason.cancel) {
                           Swal.close();  
                     }
                  });
               }
         }  
         
      })

      function submitFormByAjax(form, url, data, table) 
      {
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
               
               if (data.error == false) {
                  // if(data.id != null) {
                  $("#otp").val('');
                  $("#sendOtp_modal").modal('show'); //
                  $("#commission-report").modal('hide');
                  
               } else {
                  
               }

            },
            error: function(data) {
               console.log(data.responseJSON.errors);
               console.log(data.responseJSON.errors.account_number);
               $('#account_numberError').text(data.responseJSON.errors.account_number);
            }

         })
      }

      $(document).on('click', "#change_pin_modal", function(e){
         
         $("#sendOtp_modal").modal('show');
         $("#change_pin_active").val('1');
         // data-toggle="modal"  data-target="#SetPinModal"
      });

      function sendOtpPin(params) 
      {
         var url = "{{ route('massage.checkOTP')}}";
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
               
               
            },
            error: function(data) {

               console.log("error otp: ", data.responseJSON.errors);
               
            }
         });   
      }

      

    function showOtpError() {
         $('#otp').addClass('otp-error').focus();
         $('#otpError').removeClass('d-none');
         $('#otpError').html('One time password is required.');
      }  
 
      $('#otp').on('input', function () {
         $('#otpError').html('');
         $(this).removeClass('otp-error');
          if (!$('#otp').val().trim()) {
            showOtpError();
            return false;
         }
      });

      $("body").on("click", "#sendOtpSubmit", function(e) {
        e.preventDefault();

        if (!$('#otp').val().trim()) {
            showOtpError();
            return false;
         }

         let form = $("#SendBankOtp")[0];
         let data = new FormData(form);
         
         var url = "{{ route('massage.checkOTP')}}";

         var phone = data.phone;
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
               

                if(data.changePin == '1' || data.changePin == '0'){
                    if(data.changePin == '1'){
                        $('#sendOtp_modal').modal('hide');
                        $("#SetPinModal").modal('show');
                        $('#otp').val('');
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Invalid OTP",
                            text: "The OTP you entered is incorrect. Please try again.",
                        });
                        $('#otp').val('');
                    }
                    $("#change_pin_active").val('0');
                }

               if(isBankAccountChanged && data.error != 3){
                  $("#modal-title").text('Bank Account Update Confirmation');
                  $('.comman_msg').html('<h5>Your bank account details have been successfully updated.</h5>');
                  $("#comman_modal").modal('show');
                  
                  $("#sendOtp_modal").modal('hide');

               }else{
                  let bankState = data.bank_data.state == 1 ? 'Primary' : 'Secondary';
                  let account_number = data.bank_data.account_number;
                  

                  $("#modal-title").text('New Bank Account added Confirmation');
                  if (data.error == 0) {
                     let textMsg = `<p class="text-left p-2">
                        Bank Account `+account_number+` has been added to your list
                        of Bank Accounts as a `+bankState+` account.</br></br>
                        You can edit the details by clicking the 'Action' link.</br></br>
                        The default PIN is 1234 which you can reset by clicking the
                        Change PIN button.
                     </p>`;
                     $('.comman_msg').html(textMsg);
                     $("#comman_modal").modal('show');
                     
                     $("#sendOtp_modal").modal('hide');
                     
                     //table.draw();
                  }
                  if (data.error == 2) {
                     $('.comman_msg').html("Please select primary account");
                     $("#comman_modal").modal('show');
                     $("#sendOtp_modal").modal('hide');
                     //table.draw();
                  }
                  if (data.error == 3) {
                     $('.comman_msg').html("You can't update the primary account.");
                     $("#comman_modal").modal('show');
                     $("#sendOtp_modal").modal('hide');
                     //table.draw();
                  }
               }

               table.draw();
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

   });

   

   function updateBankPinByAjax(url, data) 
   {
         $.ajax({
            method: "POST",
            url: url,
            data: {'user_bank_pin': data},
            dataType: "JSON",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
               if (data.error == false) {
                  $("#SetPinModal").modal('hide');
                  $("#modal-title").text("Pin Update Confirmation");
                  let textMsg = `<h5 class="text-center">
                                 `+data.message+`
                              </h5>`;
                  $('.comman_msg').html(textMsg);
                  setTimeout(() => {
                    $("#comman_modal").modal('show');
                  }, 200);
                  
                  
                  
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
   }

   $('body').on('hidden.bs.modal', '#delete_bank', function() {
      $("#previous input:hidden").val(' ');

   });
   $(document).on('click', '.delete_bankModal', function(e) {
      e.preventDefault();
      var $this = $(this);

      $("#previous").val($this.attr('href'));
      console.log($this.attr('href'));
      $("#Lname").html("Are you sure you want to delete this bank account?");
      $('#delete_bank').modal('show');
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
            if (data.error == false) {
               table.draw();
               $('#delete_bank').modal('hide');
               $("#header_msg").html("Delete Profile");
               $('.comman_msg').html("The bank account has been successfully deleted.");
               $("#comman_modal").modal('show');
               $("#modal-title").text('Delete Bank Account Confirmation');

            }
            if (data.error == true) {
               table.draw();
               $('#delete_bank').modal('hide');
               $('.comman_msg').html("Primary Account can not be deleted. ");
               $("#header_msg").html("Delete Profile");
               $("#comman_modal").modal('show');
               $("#modal-title").text('Delete Bank Account Confirmation');

            }
         }

      })
   });
</script>
@endpush