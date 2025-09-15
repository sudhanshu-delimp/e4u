@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
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
  /* Blink effect */
  @keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
  }
  #pinDisplay.empty::after {
    content: "Enter PIN";
    color: #999;
    font-size: 16px;
    animation: blink 1s infinite;
  }
 
 </style>
@endsection
@section('content')
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
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
                         <button type="button" class="create-tour-sec dctour" data-toggle="modal"  id="commission-modal" data-target="#commission-report">Add New Account</button>
                      </div>
                   </div>
                </div>
             
                <div class="row">
                    <div class="col-md-12 mt-2">
                       <div id="" class="table-responsive-xl">
                          <div id="bankAccountTable_wrapper" class="dataTables_wrapper no-footer">
                             <div class="datatable-topbar">
                                <div id="bankAccountTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="Search by Account Number" aria-controls="bankAccountTable"></label><button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button></div>
                                <div class="dataTables_length" id="bankAccountTable_length">
                                   <label>
                                      Show 
                                      <select name="bankAccountTable_length" aria-controls="bankAccountTable" class="">
                                         <option value="10">10</option>
                                         <option value="25">25</option>
                                         <option value="50">50</option>
                                         <option value="100">100</option>
                                      </select>
                                      entries
                                   </label>
                                </div>
                             </div>
                             <div id="bankAccountTable_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                             <table class="table dataTable no-footer" id="bankAccountTable" role="grid" aria-describedby="bankAccountTable_info" style="width: 1434px;">
                                <thead class="table-bg">
                                   <tr role="row">
                                      <th scope="col" class="sorting" tabindex="0" aria-controls="bankAccountTable" rowspan="1" colspan="1" aria-label="Bank: activate to sort column ascending" style="width: 170px;">Bank</th>
                                      <th scope="col" class="sorting_asc" tabindex="0" aria-controls="bankAccountTable" rowspan="1" colspan="1" style="width: 255px;" aria-sort="ascending" aria-label="Account Name: activate to sort column descending">Account Name</th>
                                      <th scope="col" class="sorting" tabindex="0" aria-controls="bankAccountTable" rowspan="1" colspan="1" style="width: 202px;" aria-label="BSB: activate to sort column ascending">BSB</th>
                                      <th scope="col" class="sorting" tabindex="0" aria-controls="bankAccountTable" rowspan="1" colspan="1" style="width: 259px;" aria-label="Account Number: activate to sort column ascending">Account Number</th>
                                      <th scope="col" class="sorting" tabindex="0" aria-controls="bankAccountTable" rowspan="1" colspan="1" style="width: 235px;" aria-label="Account Status: activate to sort column ascending">Account Status</th>
                                      <th scope="col" class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 79px;" aria-label="Action">Action</th>
                                   </tr>
                                </thead>
                                <tbody>
                                   <tr role="row" class="odd">
                                      <td>AMP Bank</td>
                                      <td class="sorting_1">2134564321345321234</td>
                                      <td>123453213453234</td>
                                      <td>234543245321345</td>
                                      <td>Primary Account</td>
                                      <td>
                                         <div class="dropdown no-arrow text-center">
                                            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> 
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                               <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start editModal" href="#" data-id="22" data-bank_name="AMP Bank" data-bsb="123453213453234" data-ac_number="234543245321345" data-state="1" data-url="bank_account/22" data-toggle="modal" data-target="#commission-report" data-ac_name="2134564321345321234" id="edit_22"> <i class="fa fa-pen "></i> Edit</a> 
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start delete_bankModal" href="#" data-id="22" data-target="#delete_bnak"> <i class="fa fa-trash "></i> Delete </a>
                                               <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start eftClientOption" href="#" data-bank="AMP Bank">
                                            <i class="fa fa-credit-card"></i> EFT Client
                                            </a>
                                            </div>
                                         </div>
                                      </td>
                                   </tr>
                                   <tr role="row" class="even">
                                      <td>Adelaide Bank</td>
                                      <td class="sorting_1">12345678789</td>
                                      <td>2342343223</td>
                                      <td>234242234324234430</td>
                                      <td>Secondary Account</td>
                                      <td>
                                         <div class="dropdown no-arrow text-center">
                                            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> 
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                               <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start editModal" href="#" data-id="18" data-bank_name="Adelaide Bank" data-bsb="2342343223" data-ac_number="234242234324234433" data-state="2" data-url="bank_account/18" data-toggle="modal" data-target="#commission-report" data-ac_name="12345678789" id="edit_18"> <i class="fa fa-pen "></i> Edit</a> 
                                               <div class="dropdown-divider"></div>
                                               <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start delete_bankModal" href="#" data-id="18" data-target="#delete_bnak"> <i class="fa fa-trash "></i> Delete </a>
                                            </div>
                                         </div>
                                      </td>
                                   </tr>
                                </tbody>
                             </table>
                             <div class="dataTables_info" id="bankAccountTable_info" role="status" aria-live="polite">Showing 1 to 2 of 2 entries</div>
                             <div class="dataTables_paginate paging_simple_numbers" id="bankAccountTable_paginate"><a class="paginate_button previous disabled" aria-controls="bankAccountTable" data-dt-idx="0" tabindex="0" id="bankAccountTable_previous">Previous</a><span><a class="paginate_button current" aria-controls="bankAccountTable" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="bankAccountTable" data-dt-idx="2" tabindex="0" id="bankAccountTable_next">Next</a></div>
                          </div>
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
                         <form id="escort_bank" method="post" action="#">
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
                                     <button type="button" class="btn-success-modal float-right" data-toggle="modal"  data-target="#AddNewAccountConfirm">Save</button>
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
             
             <!-- Set PIN Modal -->
<div class="modal fade upload-modal" id="SetPinModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header text-center justify-content-start">
          <h5 class="modal-title">
            <img src="/assets/dashboard/img/key-30.png" class="custompopicon mr-0" alt="cross"> 
            Set your PIN (4 digits)
          </h5>
        </div>
        <div class="modal-body text-center p-0">
          <!-- PIN Display -->
          <div id="pinDisplay" class="pin-display mb-3"></div>
  
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
            <button type="button" class="btn-cancel-modal mr-3" id="clearBtn">Clear</button>
            <button type="button" class="btn-success-modal" id="savePinBtn">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- PIN Reset Confirmation Modal -->
  <div class="modal fade upload-modal" id="PinResetConfirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <img src="/assets/dashboard/img/reset-30.png" class="custompopicon" alt="cross">
          <h5 class="modal-title">PIN Reset</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">
              <img src="{{ asset('assets/app/img/newcross.png')}}">
            </span>
          </button>
        </div>
        <div class="modal-body">
          <p id="pinResetMsg" class="mb-0 font-weight-bold text-center"></p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn-success-modal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>  
              
              <!-- PIN Reset Confirmation Modal -->
<div class="modal fade upload-modal" id="PinResetConfirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><img src="/assets/dashboard/img/reset-30.png" class="custompopicon" alt="cross"> PIN Reset</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"></span>
          </button>
        </div>
        <div class="modal-body">
          <p id="pinResetMsg" class="mb-0 font-weight-bold text-center"></p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="create-tour-sec" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- PIN Reset Confirmation Modal -->
<div class="modal fade" id="PinResetConfirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <i class="fas fa-lock text-danger mr-2"></i>
          <h5 class="modal-title">PIN Reset</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"></span>
          </button>
        </div>
        <div class="modal-body text-center">
          <p id="pinResetMsg" class="mb-0 font-weight-bold"></p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn-success-modal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- PIN Reset Confirmation Modal -->
<div class="modal fade" id="PinResetConfirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <img src="/assets/dashboard/img/face-lock.png" style="width:30px; margin-right:8px;" alt="icon">
          <h5 class="modal-title">PIN Reset</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"></span>
          </button>
        </div>
        <div class="modal-body text-center">
          <p id="pinResetMsg" class="font-weight-bold mb-0"></p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn-success-modal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>  

             {{-- end modal --}}
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $('#AddNewAccountConfirm').on('show.bs.modal', function () {
    $('#commission-report').modal('hide');
});
    </script>
        <script>
            $(document).ready(function(){
              let pin = '';
            
              function updateDisplay() {
                if(pin.length === 0){
                  $('#pinDisplay').addClass('empty').text('');
                } else {
                  $('#pinDisplay').removeClass('empty').text(pin);
                }
              }
            
              // keypad input
              $(document).on('click', '.input_value', function(){
                if(pin.length < 4){ 
                  pin += $(this).text(); 
                  updateDisplay();
                }
              });
            
              // clear buttons
              $('#clear, #clearBtn').click(function(){ 
                pin = ''; 
                updateDisplay();
              });
            
              // Save PIN
              $('#savePinBtn').click(function(){
                if(pin.length === 4){
                  // पहले SetPinModal बंद करो
                  $('#SetPinModal').modal('hide');
            
                  // modal बंद होने के बाद confirm popup दिखाओ
                  $('#SetPinModal').on('hidden.bs.modal', function () {
                    $('#pinResetMsg').text(`Your PIN Number has been reset to: ${pin}. Do not disclose your PIN to anyone else.`);
                    $('#PinResetConfirm').modal('show');
                    $(this).off('hidden.bs.modal'); // एक बार ही trigger होगा
                  });
            
                  // reset
                  pin = '';
                  updateDisplay();
                } else {
                  alert('Enter 4 digits to set PIN');
                }
              });
            
              // init
              updateDisplay();
            });
            </script>       
            <script>
                $(document).ready(function(){
                  let pin = '';
                  let eftTrigger = false; // track EFT flow
                
                  function updateDisplay() {
                    if(pin.length === 0){
                      $('#pinDisplay').addClass('empty').text('');
                    } else {
                      $('#pinDisplay').removeClass('empty').text(pin);
                    }
                  }
                
                  // ✅ EFT Client option click
                  $(document).on('click', '.eftClientOption', function(e){
                    e.preventDefault();
                    eftTrigger = true; // mark EFT flow
                    pin = '';
                    updateDisplay();
                    $('#SetPinModal').modal('show'); // open PIN modal
                  });
                
                  // keypad input
                  $(document).on('click', '.input_value', function(){
                    if(pin.length < 4){ 
                      pin += $(this).text(); 
                      updateDisplay();
                    }
                  });
                
                  // clear
                  $('#clear, #clearBtn').click(function(){ 
                    pin = ''; 
                    updateDisplay();
                  });
                
                  // Save PIN
                  $('#savePinBtn').click(function(){
                    if(pin.length === 4){
                      $('#SetPinModal').modal('hide');
                
                      $('#SetPinModal').on('hidden.bs.modal', function () {
                        if(eftTrigger){
                          $('#EFTInstructions').modal('show');
                          eftTrigger = false;
                        } else {
                          // ✅ Normal Change PIN flow
                          $('#pinResetMsg').text(`Your PIN Number has been reset to: ${pin}. Do not disclose your PIN to anyone else.`);
                          $('#PinResetConfirm').modal('show');
                        }
                        $(this).off('hidden.bs.modal');
                      });
                
                      pin = '';
                      updateDisplay();
                    } else {
                      alert('Enter 4 digits to set PIN');
                    }
                  });
                
                  updateDisplay();
                });
                </script>
                   <script>
                     $(document).ready(function(){
                     
                         // -------------------
                         // Variables
                         // -------------------
                         let correctPIN = "1234"; // default, backend से fetch करना चाहिए
                         let pin = "";
                         let eftTrigger = false;
                         let payIdTrigger = false;
                     
                         // -------------------
                         // Helpers
                         // -------------------
                         function updateDisplay() {
                             if(pin.length === 0){
                                 $('#pinDisplay').addClass('empty').text('');
                             } else {
                                 $('#pinDisplay').removeClass('empty').text(pin);
                             }
                         }
                     
                         function resetPinEntry(){
                             pin = '';
                             updateDisplay();
                         }
                     
                         // -------------------
                         // Keypad Input
                         // -------------------
                         $(document).on('click', '.input_value', function(){
                             if(pin.length < 4){
                                 pin += $(this).text();
                                 updateDisplay();
                             }
                         });
                     
                         // Clear buttons
                         $('#clear, #clearBtn').click(function(){
                             resetPinEntry();
                         });
                     
                         // -------------------
                         // EFT Client Trigger
                         // -------------------
                         $(document).on('click', '.eftClientOption', function(e){
                             e.preventDefault();
                             eftTrigger = true;
                             resetPinEntry();
                             $('#SetPinModal').modal('show');
                         });
                     
                         // -------------------
                         // PayID Trigger (PIN protected)
                         // -------------------
                         $(document).on('click', '#payid', function(e){
                             e.preventDefault();
                             payIdTrigger = true;
                             resetPinEntry();
                             $('#SetPinModal').modal('show');
                         });
                     
                         // -------------------
                         // Save / Verify PIN
                         // -------------------
                         $('#savePinBtn').click(function(){
                     
                             if(pin.length === 4){
                     
                                 // EFT & PayID verification check
                                 if(eftTrigger || payIdTrigger){
                                     if(pin !== correctPIN){
                                         alert("❌ Incorrect PIN, please try again.");
                                         resetPinEntry();
                                         return;
                                     }
                                 }
                     
                                 $('#SetPinModal').modal('hide');
                     
                                 $('#SetPinModal').on('hidden.bs.modal', function () {
                                     if(eftTrigger){
                                         $('#EFTInstructions').modal('show');
                                         eftTrigger = false;
                                     } 
                                     else if(payIdTrigger){
                                         $('#AddPayId').modal('show');
                                         payIdTrigger = false;
                                     } 
                                     else {
                                         // Normal Change PIN flow → पहले OTP
                                         $('#sendOtp_modal').modal('show');
                     
                                         // जब OTP verify होगा तब ही PIN reset होगा
                                         $('#sendOtpSubmit').off('click').on('click', function(e){
                                             e.preventDefault();
                                             let otp = $('#otp').val();
                                             if(otp.length === 4){ 
                                                 $('#sendOtp_modal').modal('hide');
                                                 $('#pinResetMsg').text(
                                                     `Your PIN Number has been reset to: ${pin}. Do not disclose your PIN to anyone else.`
                                                 );
                                                 $('#PinResetConfirm').modal('show');
                                                 correctPIN = pin; // ✅ backend call से save करना होगा
                                                 resetPinEntry();
                                             } else {
                                                 alert("Enter valid 4-digit OTP");
                                             }
                                         });
                                     }
                                     $(this).off('hidden.bs.modal');
                                 });
                     
                             } else {
                                 alert('Enter 4 digits to set PIN');
                             }
                         });
                     
                         // -------------------
                         // Add New Account → OTP flow
                         // -------------------
                         $('#commission-report .btn-success-modal').click(function(e){
                             e.preventDefault();
                             $('#commission-report').modal('hide');
                             $('#sendOtp_modal').modal('show');
                     
                             $('#sendOtpSubmit').off('click').on('click', function(ev){
                                 ev.preventDefault();
                                 let otp = $('#otp').val();
                                 if(otp.length === 4){
                                     $('#sendOtp_modal').modal('hide');
                                     $('#AddNewAccountConfirm').modal('show');
                                 } else {
                                     alert("Enter valid 4-digit OTP");
                                 }
                             });
                         });
                     
                         // -------------------
                         // Init
                         // -------------------
                         updateDisplay();
                     
                     });
                     </script>              
@endpush
