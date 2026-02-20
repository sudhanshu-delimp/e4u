@extends('layouts.operator')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        /* color: red; */
        list-style: none;
    }

#bankAccountTable tbody td {
    vertical-align: middle;
}
.dataTables_wrapper .dataTables_filter label input {
    width: 38% !important;
}
#bankAccountTable .fa-ellipsis{
    transform: rotate(0deg)
}      
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 opr-console">
    <!--middle content end here-->
    
    <div class="row">
        {{-- Page Heading   --}}
        <div class="operator-heading-wrapper col-lg-12">
           <h1 class="h1">Bank Account</h1>
           <span class="oprhelpNote font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
        </div>
        <div class="col-md-12 mb-4">
           <div class="card collapse" id="notes" style="">
              <div class="card-body">
                 <p class="notes"><b>Notes:</b> </p>
                 <ol>
                    <li>
                       All Commission paid to you under the Master Agreement will be paid into your
nominated Bank Account.
                    </li>
                    <li>
                        You can update your Bank Account details by clicking the 'Update' button. SMS 2FA
authentification is applied for any changes to your Bank Account details.
                    </li>
                    <li>Any queries regarding payments to your Bank Account can be raised by logging a <a href="javascript:void(0)" class="termsandconditions_text_color custom_links_design">Support Ticket</a> with E4U.
                    </li>
                 </ol>
              </div>
           </div>
        </div>
     {{-- end --}}
        <div class="col-md-12">
            <div class="row pt-2 pb-2">
                <div class="col-md-12 mb-2">
                    <div class="card Summary">
                        <div class="card-body pb-0">
                            <p class="opr-heading-2">Operator Details</p>
                            <ul class="mb-2">
                                <li>Name: {{auth()->user()?->operator?->name ?? ""}}</li>
                                <li>Contact: {{auth()->user()?->operator?->business_name ?? ""}}</li>
                                <li>ABN: {{auth()->user()?->operator?->abn ?? ""}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="bothsearch-form">
                        <button type="button" class="opr-common-btn" data-toggle="modal"  id="commission-modal" data-target="#commission-report2">Add New</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div id="table-sec" class="table-responsive-xl">
                        <table class="table" id="bankAccountTable">
                            <thead class="opr-table-bg">
                                <tr>
                                    <th scope="col">Bank</th>
                                    <th scope="col">Account Name</th>
                                    <th scope="col">BSB</th>
                                    <th scope="col">Account Number</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="modal fade opr-modal" id="commission-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
             
               <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/add-bank.png') }}" class="custompopicon"> <span id="modleCustomHeading">Add Bank Account</span></h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                   <img src="{{ asset('assets/dashboard/img/operator/close.png')}}" class="opr-close-btn">
                </a>
         </div>
         
         <div class="modal-body pb-0 agent-tour">
           <form id="agent_bank" method="post" action="{{ route('operator.save.bank.details')}}">
               @csrf
               <input type="hidden" name="bankId" value="" id="bankId">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                           <label>Bank</label>
                           <select class="custom-select" name="bank_name" id="bank_name" >
                                <option value="" disabled selected>Select Bank</option>
                                @foreach(config('escorts.profile.agentBankDetails') as $key => $bankName)
                                    <option value="{!!$bankName!!}">{{$bankName}}</option>
                                @endforeach
                              
                           </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <label>Account Name</label>
                           <input type="text" class="form-control" placeholder="Account Name" name="account_name" id="account_name">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <label>BSB</label>
                           <input type="text "  class="form-control" placeholder="BSB" name="bsb" id="bsb" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                           <label>Account Number</label>
                           <input type="text" class="form-control"  placeholder="Account Number" id="account_number" name="account_number" >
                           <div id="account_numberError"></div>
                         
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>State</label>
                        <select class="custom-select" name="state" id="state">
                           <option value="">Select State</option>
                           <option value="1">Primary Account</option>
                           <option value="2">Secondary Account</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                           <button type="submit" class="btn-success-modal float-right modal_form">Save</button>
                           <input type="hidden" name="replace" id="replace">
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade opr-modal" id="sendOtp_modal" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <form id="SendBankOtp" method="post" action="" >
                @csrf
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/2fa.png') }}" class="custompopicon"> 2FA Verification</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                   <img src="{{ asset('assets/dashboard/img/operator/close.png')}}" class="opr-close-btn">
                </a>
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
                               log in.</li>
                            <li>We have sent you your verification code according to your preference, please
                               insert your verification code.</li>
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
                <div class="modal-footer justify-content-center forgot_pass pt-0 pb-4">
                    {{-- <button type="submit" class="btn main_bg_color site_btn_primary" id="sendOtpSubmit">Send</button> --}}
                    <p class="pt-2">Not received your verification code? <a href="#" id="resendOtpSubmit" class="termsandconditions_text_color opr-btn-common">Resend Code</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal programmatic opr-modal" id="delete_bank" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content custome_modal_max_width">
          <div class="modal-header main_bg_color border-0">
             <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/remove-bank_new.png') }}" class="custompopicon"> Delete Bank Account</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                   <img src="{{ asset('assets/dashboard/img/operator/close.png')}}" class="opr-close-btn">
                </a>
             
          </div>
          <div class="modal-body">
             <input type="hidden" id="previous" name="url">
             <input type="hidden" id="label" name="label">
             <input type="hidden" id="trigger-element">
             <h3 class="my-3"><span id="Lname"></span> </h3>
             <h3 class=""><span id="log"></span> </h3>
             <div class="modal-footer">
                <button type="button" class="opr-common-btn" data-dismiss="modal" value="close" id="close_change">Close</button>
                <button type="button" class="opr-common-btn" id="save_change">Delete</button>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
@push('script')

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>

$(function()
{

        var is_primary_bank_acc = 0;
        var primary_bank_acc_id = 0;
        var previous_state = 0;
        $(document).on('submit', '#agent_bank', async function(e) {

            console.log('is_primary_bank_acc',is_primary_bank_acc);
            e.preventDefault();
            let isValid = true;
            $("#replace").val(''); 
            var state  = $("#state").val();
            var bankId  = $("#bankId").val();

            
            $(".error-text").remove();

            function showError(input, message) {
            isValid = false;
            const group = $(input).closest('.form-group');
            group.find('.error-text').remove();
            group.append(`<div class="error-text text-danger mt-1">${message}</div>`);
            }


            if (!$("#bank_name").val()) {
                showError("#bank_name", "Please select bank");
            
            }

            if ($("#account_name").val().trim() === "") {
                showError("#account_name", "Please enter your account name");
            }

            if ($("#bsb").val().trim() === "") {
                showError("#bsb", "Please enter your BSB number");
            } else if (!/^\d+$/.test($("#bsb").val().trim())) {
                showError("#bsb", "Enter only numbers");
            }

            if ($("#account_number").val().trim() === "") {
                showError("#account_number", "Please enter your account number");
            } else if (!/^\d+$/.test($("#account_number").val().trim())) {
                showError("#account_number", "Enter only numbers");
            }

            if ($("#state").val() === "") {
                showError("#state", "Please select state");
            }

            if (!isValid) return false; 

            //////// Saving Conditions //////////////////////
            if(!bankId)
            {
                if(is_primary_bank_acc!='1' && state=='2')
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
                            submitForm();
                        } 
                        else if (result.dismiss === Swal.DismissReason.cancel) {
                            $("#state").val(2); 
                            submitForm();
                        }
                    });
                } 
                else if(is_primary_bank_acc=='1' && state=='1')
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
                        
                            submitForm();
                        } 
                        else if (result.dismiss === Swal.DismissReason.cancel) {
                            $("#replace").val('no'); 
                            $("#state").val(2); 
                            submitForm();
                        }
                    });
                }
                else if(is_primary_bank_acc=='1' && state=='2')
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
                            submitForm();
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
                            submitForm();
                        } 
                        else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.close(); 
                        }
                    });  
                }
            }
            else
            {
                console.log('previous_state',previous_state);
                console.log('is_primary_bank_acc',is_primary_bank_acc);
                console.log('state',state);
                
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
                            submitForm();
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
                            submitForm();
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
                            submitForm();
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
                            submitForm();
                        } 
                        else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.close();  
                        }
                    });
                }
            }    
        });

        ///////// Data Table ////////////////

        var table = $('#bankAccountTable').DataTable({
            "drawCallback": function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                console.log(pageInfo);
              
                if (pageInfo.pages < 1) {
                    $(this).closest('.dataTables_wrapper').find('.dataTables_info').hide();
                    $(this).closest('.dataTables_wrapper').find('.paging_simple_numbers').hide();
                    $(this).closest('.dataTables_wrapper').find('.dataTables_length').hide();
                    $(this).closest('.dataTables_wrapper').find('.dataTables_filter').hide();
                } else {
                    $(this).closest('.dataTables_wrapper').find('.dataTables_info').show();
                    $(this).closest('.dataTables_wrapper').find('.paging_simple_numbers').show();
                    $(this).closest('.dataTables_wrapper').find('.dataTables_length').show();
                    $(this).closest('.dataTables_wrapper').find('.dataTables_filter').show();
                }
            },

        "language": {
         search: "_INPUT_",
        searchPlaceholder: "Search By Account Number",
        "sSearch": 'Search:',
       },
        info: true,
        bLengthChange: true,
        processing: true,
        serverSide: true,
        lengthChange: true,
        order: [1,'asc'],
        searchable:true,
        searching:true,
        bStateSave: true,
    
        ajax: {
            url: "{{ route('operator.bankDetail.dataTable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'bank_name', name: 'bank_name', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'account_name', name: 'account_name', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'bsb', name: 'bsb', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'account_numbers', name: 'account_numbers', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'states', name: 'states', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
        ]
    });  


    table.on('xhr.dt', function () {
        var json = table.ajax.json();
        is_primary_bank_acc = json.primary_account;
        primary_bank_acc_id = json.primary_bank_acc_id;
         console.log('is_primary_bank_acc',is_primary_bank_acc);
         console.log('primary_bank_acc_id',primary_bank_acc_id)
    });

    ////////// End Datatable /////////////////////

    $(document).on('click', '.editModal', function() {
         $(".error-text").remove();
        let id = $(this).data('id');
        let bank = $(this).data('bank_name');
        let accountName = $(this).data('ac_name');
        let bsb = $(this).data('bsb');
        let accountNumber = $(this).data('ac_number');
        let state = $(this).data('state');
        $('#modleCustomHeading').text('Update Bank Account');
        previous_state  = state;
        $('#bankId').val(id);
        $('#bank_name').val(bank).change(); 
        $('#account_name').val(accountName);
        $('#bsb').val(bsb);
        $('#account_number').val(accountNumber);
        $('#state').val(state).change();
        $('.modal_form').text('Update Details');

        $('#commission-report').modal({
            backdrop: 'static',
            keyboard: false
        });
    });


    $("#commission-modal").click(function(){
        $('#agent_bank')[0].reset();
        $('.modal_form').text('Save Details');
        $('#bankId').val('');
        $('#commission-report').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#commission-report').modal('show');
        $('#bank_name').attr('disabled',false);
        $("form").attr('autocomplete', 'off');
   })


   $(document).on('click','.delete_bankModal', function(e){

                e.preventDefault();
                var id = $(this).data('id');
                console.log('id',id);

                Swal.fire({
                title: "Delete Bank Account",
                text: "Do you want to delete this bank account?",
                imageUrl: "{{ asset('assets/dashboard/img/operator/remove-bank_new.png')}}",
                imageWidth: 60,
                imageHeight: 60,
                imageAlt: "Delete bank account",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "Cancel"
                }).then((result) => 
                {
                    if (result.isConfirmed) {
                        deleteAccount(id);
                    } 
                    else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.close(); 
                    }
                 });  
            })
});

function submitForm()
{
         Swal.close();
         var form = $('#agent_bank');
         var url = form.attr('action');
         var data = new FormData(form[0]);
         $('#commission-report').modal('hide');
         $('#agent_bank')[0].reset();
         var table = $("#bankAccountTable").DataTable();
         
        swal_waiting_popup({'title':'Saving Account Details...'});
         $.ajax({
            method: form.attr('method'),
            url: url,
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data)
            {
                Swal.close();
                table.draw();
                if(data.status) 
                {
                    openMessageBox(data.message,'Bank Account');

                }
                else
                {
                  swal_error_popup(data.message);  
                }
            },
            error: function(data){
             Swal.close();   
             swal_error_popup(data.responseJSON.errors)
            }  
      })
}

function deleteAccount(id)
{
    swal_waiting_popup({'title':'Deleting Account...'});
    var table = $("#bankAccountTable").DataTable();
    $.ajax({
        method: 'POST',
        url: "{{ route('operator.delete-operator-bank') }}",
        data: { id: id }, 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            Swal.close();
            table.draw();

            if (data.status) {
                openMessageBox(data.message, 'Delete Bank Account', 'remove-bank_new.png');
            } else {
                swal_error_popup(data.message);
            }
        },
        error: function(xhr) {
            Swal.close();
            swal_error_popup(xhr.responseJSON?.errors || "Error occurred");
        }
    });
}

function openMessageBox(message,header,img = 'add-bank.png')
{
    $('.comman_msg_all').html(message);
    $("#comman_modal_all .custompopicon").attr("src", "{{ asset('assets/dashboard/img/operator') }}/"+img);
    $("#comman_modal_all #modal-title").text(header);
    $("#comman_modal_all").modal('show'); 
}

</script>
@endpush