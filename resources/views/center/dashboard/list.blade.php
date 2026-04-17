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
                                                data-target="#add_brb" id="btn_add_brb">Add Closed</button>
                                          <button style="padding: 10px;" class="btn btn-primary" data-toggle="modal"
                                                data-target="#suspend_profile" id="btn_suspend_profile">Suspend Profile</button>
                                          <button style="padding: 10px;" class="btn btn-custom-success" data-toggle="modal" data-target="#extend_profile" id="btn_extend_profile"> Extend Profile  </button>
                                          <button style="padding: 10px;" class="btn btn-bump-up" data-toggle="modal" data-target="#bumpup_profile" id="btn_bumpup_profile"> Bump Up  </button>
                                                
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
                                    <th scope="col">ID</th>
                                    <th scope="col">Profile Name</th>
                                    <th scope="col">Business Name</th>
                                    <th scope="col">Business No</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
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


@endsection

@push('script')
<!-- file upload plugin start here -->



<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
let expanded = false;
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



$(document).on('click', '.massage_action', async function () {

      let current_id = $(this).attr('id');
      var mess = "";
      let rowId = $(this).data('row-id');
      let action = "";

      if(!current_id || !rowId )
      return false;

       mess =   'Do you want to activate this Profile?';
       action = current_id;

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
               table.draw();
               setTimeout(function() {
                  window.location.href = "../center-dashboard/listing/current";
               }, 1000);

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
$(document).ready(function () {

    let suspendStartDateObject = $('#suspendStartDate');
    let suspendEndDateObject   = $('#suspendEndDate');
    let suspendProfileObject = $('#suspendProfileId');

    
    suspendStartDateObject.datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 1,
        onSelect: function () {
            suspendEndDateObject.datepicker('option', 'minDate', $(this).val());
            suspendEndDateObject.datepicker('setDate', $(this).val());
            calculateCredit();
        }
    });

    suspendEndDateObject.datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: 1,
        onSelect: function () {
            suspendStartDateObject.datepicker('option', 'maxDate', $(this).val());
            calculateCredit();
        }
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


     function calculateCredit() {
                let selectedOption = suspendProfileObject.find(':selected');
                if(suspendEndDateObject.val() && suspendStartDateObject.val()){
                    $.ajax({
                    url: "{{ route('center.massage-suspend-credit') }}",
                    method: 'POST',
                    data: {
                        start_date: suspendStartDateObject.val(),
                        end_date: suspendEndDateObject.val(),
                        profile_id: selectedOption.val(),
                        _token: '{{ csrf_token() }}'
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


    
    //suspendStartDateObject.datepicker('setDate', +1);
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
                     table.draw();
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
   switch(membership){
         case 'Platinum':{
            $membershipField.val(1);
         }break;
         case 'Gold':{
            $membershipField.val(2);
         }break;
         case 'Silver':{
            $membershipField.val(3);
         }break;
         case 'Free':{
            $membershipField.val(4);
         }
   }
   if (previousEndDateValue) {
         extendStartDateObject.val(getDateAfter(previousEndDateValue,1));
         extendEndDateObject.val(getDateAfter(previousEndDateValue,2));
         extendEndDateObject.datepicker('option', 'minDate', extendStartDateObject.val());
   } else {
         extendEndDateObject.datepicker('option', 'minDate', null);
         extendEndDateObject.val('');
   }
});

</script>


@endpush