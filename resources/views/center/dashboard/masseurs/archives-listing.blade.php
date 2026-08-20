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
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">      
      <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">             
            <div class="col-lg-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="custom-heading-wrapper">
                        <h1 class="h1">Manage Masseurs</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true">
                            <b>Help?</b></span>
                    </div>
                    @if (request('from') == 'dashboard')
                        <div class="back-to-dashboard">
                            <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                     <ol>
                           <li>Activate and deactivate Masseurs. The status must be Active to include the Masseur in the Default Listing.</li>
                           <li>Edit a Masseur's details here.</li>
                           <li>You can have up to eight Masseur Profiles at any one time appearing in a Centre Profile. You can also designate which Masseur Profiles are Default Listings in your Centre Profile.</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         {{-- start content --}}

            
         <div class="row">
            <div class="col-md-12">
               <div class="panel with-nav-tabs panel-warning">
                  <div class="panel-body">
                     <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab3warning">
                           <div class="row pb-3">

                           <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-10">

                                 <div class="mb-2 d-flex align-items-center justify-content-between flex-wrap gap-10">
                                       <div class="total_listing">
                                          <div><span>Current Active : </span></div>
                                          <div><span class="current_active">fetching...</span></div>
                                       </div>
                                       
                                 </div>
                                
                                
                                    <div class="text-center small d-flex justify-content-end align-items-center gap-10 flex-wrap">
                                          <a  href="./create-new-masseur" id="new_task" name="submit" class="btn btn-sm btn-primary shadow-none create-tour-sec">Add Masseure</a>
                                    </div>
                            </div>
                           </div>


                           <div class="table-responsive-xl">


                              <table class="table mb-3" id="masseurs_list">
                                 <thead class="table-bg">
                                    <tr>
                                  
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Stage Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Nationality</th>
                                    <th scope="col">Ethnicity</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Default Listing</th>
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
   

var table = $("#masseurs_list").DataTable({
      info: true,
      paging: true,
      lengthChange: true,
      searching: true,
      bStateSave: false,
      order: [[1, 'desc']],
      pageLength: {{$datatable_entries }},
      lengthMenu: [{{ config('app.paginate_range') }}],    

    ajax: {
        url: "{{ route('center.all-masseur-list') }}",
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        dataSrc: function(json){
            $(".current_active").text(json.total_active);
            return json.data;
        }
    },

    columns: [
            { data: 'member_id', name: 'member_id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'stage_name', name: 'stage_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'mobile', name: 'mobile', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'nationality', name: 'nationality', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'ethnicity', name: 'ethnicity', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'created_at', name: 'created_at', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'default_profile', name: 'default_profile', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'status', name: 'status', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
    ],


});


$(document).on('click', '.masseur_action', async function () {

      let current_id = $(this).attr('id');
      var mess = "";
      let rowId = $(this).data('row-id');
      let action = "";

      if(!current_id || !rowId )
      return false;

      if(current_id=='row_deactive')
      {
          mess =   'Are you sure you want to deactivate this Profile?' 
          action = current_id;
      }
     
      else if(current_id=='row_active')
      {
         mess =   'Do you want to activate this Profile?';
         action = current_id;
      }
       

      else if(current_id=='row_default')
      {
         mess =   'Do you want to add this Profile as the default Listing on the Masseur tab in the Centre Profile creator?' 
         action = current_id;
      }

      else if(current_id=='row_undefault')
      {
         mess =   'Do you want to remove this Profile as the default Listing from the Masseur tab on the Centre Profile creator?' 
         action = current_id;
      }


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
               url: "{{ route('center.action-messure-profile') }}",
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




 </script>


@endpush