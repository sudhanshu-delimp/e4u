@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        /* color: red; */
        list-style: none;
    }
.swal2-popup {
    width: auto !important;
    padding: 18px !important;
}
.swal2-cancel{
    background-color: #ff3c5f !important;
}
#bankAccountTable tbody td {
    text-align: center;
    vertical-align: middle;
}
.dataTables_wrapper .dataTables_filter label input {
    width: 38% !important;
}
    
    
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content end here-->
    
    <div class="row">
        {{-- Page Heading   --}}
        <div class="custom-heading-wrapper col-lg-12">
           <h1 class="h1">Bank Account</h1>
           <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
        </div>
        <div class="col-md-12 mb-4">
           <div class="card collapse" id="notes" style="">
              <div class="card-body">
                 <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                 <ol>
                    <li>
                        All Commission paid to you under the Agent Agreement will be paid into your nominated Bank Account.
                    </li>
                    <!-- <li>
                        You can add new your Bank Account details by clicking the 'Add New' button. SMS 2FA authentification is applied for any changes to your Bank Account details.
                    </li> -->

                    <li>
                        You can add new your Bank Account details by clicking the 'Add New' button.
                    </li>
                    
                    <li>Any queries regarding payments to your Bank Account can be raised by logging a <a href="{{ route('support-ticket.form_create') }}" class="termsandconditions_text_color custom_links_design">Support Ticket</a> with E4U.
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
                            <p class="banner-sub-heading">Agent Details</p>
                            <ul class="mb-2">
                                <li><b style="color: #5D6D7E;">Name :</b>{{$user->business_name}}</li>
                                <li><b style="color: #5D6D7E;">Contact :</b>{{$user->contact_person}}</li>
                                <li><b style="color: #5D6D7E;">ABN :</b>{{$user->abn}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="bothsearch-form">
                        <button type="button" class="create-tour-sec dctour" data-toggle="modal"  id="commission-modal" data-target="#commission-report2">Add New</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div id="table-sec" class="table-responsive-xl">
                        <table class="table" id="bankAccountTable">
                            <thead class="table-bg">
                                <tr>
                                    <th class="text-center" scope="col">Bank</th>
                                    <th class="text-center" scope="col">Account Name</th>
                                    <th class="text-center" scope="col">BSB</th>
                                    <th class="text-center" scope="col">Account Number</th>
                                    <th class="text-center" scope="col">State</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
               <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/add-new-account.png')}}" class="custompopicon"> Add Bank Account</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
               </button>
         </div>
         
         <div class="modal-body pb-0 agent-tour">
            <form id="agent_bank" method="post" action="{{ route('agent.save.bank.details')}}">
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
                        title: "You don't have any Primary bank account.",
                        text: "Do you want save it as Primary bank account?",
                        iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                        customClass: {
                            icon: 'my-custom-icon'
                        },
                        showCancelButton: true,
                        confirmButtonText: "Yes, save it as Primary bank account",
                        cancelButtonText: "No, save it as secondary bank account",
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
                        text: "Do you want replace it as Primary bank account?",
                        iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                        customClass: {
                            icon: 'my-custom-icon'
                        },
                        showCancelButton: true,
                        confirmButtonText: "Yes, replace it as Primary bank account",
                        cancelButtonText: "No, save it as secondary account",
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
                        text: "Do you want save this bank account as secondary bank account?",
                        iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                        customClass: {
                            icon: 'my-custom-icon'
                        },
                        showCancelButton: true,
                        confirmButtonText: "Yes, save it as secondary bank account",
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
                        text: "Do you want save this bank account as Primary bank account?",
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
                        text: "Do you want save this bank account as Primary bank account?",
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
                        text: "Do you want save this bank account as Primary bank account?",
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
                        text: "Do you want replace it as secondry bank account?",
                        iconHtml: '<i class="fa-solid fa-circle-exclamation"></i>',
                        customClass: {
                            icon: 'my-custom-icon'
                        },
                        showCancelButton: true,
                        confirmButtonText: "Yes, replace it as secondry bank account",
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
            url: "{{ route('agent.bankDetail.dataTable') }}",
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
            { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
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
        let id = $(this).data('id');
        let bank = $(this).data('bank_name');
        let accountName = $(this).data('ac_name');
        let bsb = $(this).data('bsb');
        let accountNumber = $(this).data('ac_number');
        let state = $(this).data('state');
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
                imageUrl: "{{ asset('assets/dashboard/img/remove-bank-account.png')}}",
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
        url: "{{ route('agent.delete-agent-bank') }}",
        data: { id: id }, 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            Swal.close();
            table.draw();

            if (data.status) {
                openMessageBox(data.message, 'Delete Bank Account');
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


function openMessageBox(message,header)
{
    $('.comman_msg').html(message);
    $("#comman_modal .custompopicon").attr("src", "{{ asset('assets/dashboard/img/remove-bank-account.png') }}");
    $("#comman_modal #modal-title").text(header);
    $("#comman_modal").modal('show'); 
}



</script>
@endpush