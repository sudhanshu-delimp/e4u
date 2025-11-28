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
    
</style>
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
                            <p><b>Agent Details</b> </p>
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
                           <button type="submit" class="btn-success-modal float-right">Save</button>
                           <input type="hidden" name="replace" id="replace">
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>




<div class="modal programmatic" id="delete_bank" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content custome_modal_max_width">
          <div class="modal-header main_bg_color border-0">
             {{-- 
             <h5 class="modal-title" id="exampleModalLabel" style="color:white">Logout</h5>
             --}}
             <span style="color:white"> <img src="{{ asset('assets/dashboard/img/remove-bank-account.png')}}" class="custompopicon"> Delete Bank Account</span>
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
             <h3 class="my-3"><span id="Lname"></span> </h3>
             <h3 class=""><span id="log"></span> </h3>
             <div class="modal-footer">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close" id="close_change">Close</button>
                <button type="button" class="btn-success-modal" id="save_change">Delete</button>
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
            if(is_primary_bank_acc!='1' && state=='2' && !bankId)
            {
                Swal.fire({
                    title: "You don't have any primary bank account.",
                    text: "Do you want save it as primary bank account?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, save it as primary bank account",
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
            else if(is_primary_bank_acc=='1' && state=='1' && !bankId)
            {
                Swal.fire({
                    title: "You already have primary bank account.",
                    text: "Do you want replace it as primary bank account?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, replace it as primary bank account",
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
            else if(is_primary_bank_acc=='1' && state=='2' && !bankId)
            {
                Swal.fire({
                    title: "",
                    text: "Do you want save this bank account as secondary bank account?",
                    icon: "question",
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
            else if(is_primary_bank_acc=='0' && state=='1' && !bankId)
            {
               Swal.fire({
                    title: "",
                    text: "Do you want save this bank account as primary bank account?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, save it as primary bank account",
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

             //////// Updating Conditions //////////////////////
            else if(bankId && is_primary_bank_acc=='0' && state=='1')
            {
               Swal.fire({
                    title: "",
                    text: "Do you want save this bank account as primary bank account?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, save it as primary bank account",
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

            else if(bankId && is_primary_bank_acc=='1' && state=='1')
            {
              Swal.fire({
                    title: "You already have primary bank account.",
                    text: "Do you want replace it as primary bank account?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, replace it as primary bank account",
                    cancelButtonText: "Cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#replace").val('yes'); 
                        $("#state").val(1);  
                       
                        submitForm();
                    } 
                    else if (result.dismiss === Swal.DismissReason.cancel) {
                         Swal.close();  
                    }
                });
            }

            else if(bankId  && state=='2')
            {
              Swal.fire({
                    title: "",
                    text: "Do you want update the bank account details ?",
                    icon: "question",
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
               
        });



        ///////// Data Table ////////////////

        var table = $('#bankAccountTable').DataTable({
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
         console.log('primary_account',json.primary_account)
    });

    ////////// End Datatable /////////////////////



    $(document).on('click', '.editModal', function() {
        let id = $(this).data('id');
        let bank = $(this).data('bank_name');
        let accountName = $(this).data('ac_name');
        let bsb = $(this).data('bsb');
        let accountNumber = $(this).data('ac_number');
        let state = $(this).data('state');

       
        $('#bankId').val(id);
        $('#bank_name').val(bank).change(); 
        $('#account_name').val(accountName);
        $('#bsb').val(bsb);
        $('#account_number').val(accountNumber);
        $('#state').val(state).change();
        $('.btn-success-modal').text('Update Details');

        $('#commission-report').modal({
            backdrop: 'static',
            keyboard: false
        });
    });


    $("#commission-modal").click(function(){

        $('#agent_bank')[0].reset();
        $('.btn-success-modal').text('Save Details');
        $('#bankId').val('');
        $('#commission-report').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#commission-report').modal('show');
        $('#bank_name').attr('disabled',false);
        $("form").attr('autocomplete', 'off');
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
                   swal_success_popup(data.message);
                  
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




















//    $("#agent_bank").parsley({
   
//    });
//    $("#SendBankOtp").parsley({
   
//    });

  
//    $("body").on('click','.editModal',function(){
//         var button = $(event.relatedTarget);
//         console.log(button.data('data-name'));
//         var name = $(this).data('name');
//         var id = $(this).data('id');
//         console.log("hello",name);
//         console.log("id",id);
        
//         $('#bank_name').val($(this).data('name'));
//         // $('#bank_name option[value="'+name+'"]').attr('selected','selected');
//        // $('#bank_name').attr('disabled',true)
//         $("#commission-report").modal('show');   
//    });
    
//    $('body').on ('show.bs.modal', '#commission-report', function(event){
//         button = $(event.relatedTarget);
       
//         //$('.parsley-required').css('list-style-type', 'disc');
//         $("form #agent_bank").attr('autocomplete', 'on');
//         const bank = $(button).data('name');
//         if($(button).data('target') == "#commission-report") {
//             $('#bank_name').attr('disabled',true);
//         } 
        
//         $('#bank_name').val($(button).data('bank_name'));
//         $('#account_name').val($(button).data('ac_name'));
//         $('#account_number').val($(button).data('ac_number'));
//         $('#bsb').val($(button).data('bsb'));
//         $('#state').val($(button).data('state'));
//         $('#bankId').val($(button).data('id'));
//         console.log("target = ", $(button).data('target'));
//         //document.getElementById("bank_name").value = bank;
//     });


    // $('body').on('hidden.bs.modal','#commission-report', function() {
    //     console.log("taasdasd");
    //     $('#agent_bank')[0].reset();
       
    //     $('.parsley-required').html('');
        
    // });
   

    
  

//    $('body').on('hidden.bs.modal','#delete_bank', function() {
//         console.log("delete-bank");
//         // $('#delete_bank').reset();
       
//         // $("#previous").val('');
//         $("#previous input:hidden").val(' ');
        
//     });
//    $(document).on('click','.delete_bankModal', function(e){
//        e.preventDefault();
//        var $this = $(this);
       
//        $("#previous").val($this.attr('href'));
//        console.log($this.attr('href'));
//        $("#Lname").html("<p>Would you like to Delete?</p>");
//        $('#delete_bank').modal('show');
//         // $("#delete_bank").load(target, function() { 
            
//         // });   
//    });


//    $("body").on('click','#save_change',function(e){
//            console.log("url==",$("#previous").val());
//            var url = $("#previous").val();
//            var table = $("#bankAccountTable").DataTable();
//            $.ajax({
//                    method: "POST",
//                    url:url,
//                    contentType: false,
//                    processData: false,
//                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//                    success: function (data) {
//                         console.log(data);
//                         if(data.error == false) {
//                             console.log("sdfjsdhfsjd",data);
//                             table.draw();
//                             $('#delete_bank').modal('hide');
//                             $("#header_msg").html("Delete Profile");
//                             $('.comman_msg').html("Deleted ");
//                             $("#comman_modal").modal('show'); 
                           
//                         }
//                         if(data.error == true) {
//                             table.draw();
//                             $('#delete_bank').modal('hide');
//                             $('.comman_msg').html("Primary Account can not be deleted. ");
//                             $("#header_msg").html("Delete Profile");
//                             $("#comman_modal").modal('show'); 
                           
//                         }
//                     }
           
//            })
//        });




// $(document).on('submit', '#agent_bank', async function(e) {

//     var account_type = $('#state').val(); 



//    if (await isConfirm({'action': 'Suspend','text':' Suspend This Account.'})) { 


//     }

// });
   
    //    $("body").on('submit','#agent_bank',function(e){
    //      e.preventDefault();
    //      console.log("bank id");
    //      var form = $(this);
    //      var url = form.attr('action');
    //      var data = new FormData(form[0]);
    //      $('#account_numberError').text('');
    //      $.ajax({
    //         method: form.attr('method'),
    //         url: url,
    //         data: data,
    //         contentType: false,
    //         processData: false,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //         },
    //         success:function(data)
    //         {
    //              console.log(data);
    //              if(data.error == 0) 
    //              {
    //                 $('.comman_msg').html("Saved");
    //                 $("#comman_modal").modal('show'); 
    //                 $("#sendOtp_modal").modal('hide');
    //                 table.draw();
    //             }
    //             if(data.error == 2) {
    //                 $('.comman_msg').html("Please select primary account");
    //                 $("#comman_modal").modal('show'); 
    //                 $("#sendOtp_modal").modal('hide');
    //                 table.draw();
    //             }
    //             if(data.error == 3) {
    //                 $('.comman_msg').html("Primary account not updated");
    //                 $("#comman_modal").modal('show'); 
    //                 $("#sendOtp_modal").modal('hide');
    //                 table.draw();
    //             }

    //         },
    //         error: function(data){
    //            console.log(data.responseJSON.errors);
    //            console.log(data.responseJSON.errors.account_number);
    //            $('#account_numberError').text(data.responseJSON.errors.account_number);
    //         }
            
    //      })
    //   })





  

</script>
@endpush