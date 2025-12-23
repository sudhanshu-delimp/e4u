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
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Archives</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol>
                           <li>Use these help pages for explanations and guidance on managing all of your Masseur
                              Profiles.</li>
                           <li>You can upload four photos for each Masseur. Designate one as the Masseur’s
                              Thumbnail.</li>
                           <li>Activate up to eight Masseur Profiles at any one time to appear the Massage Centre
                              Profile.</li>
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

                              <div class="col-md-12 col-sm-12">
                                 <div class="bothsearch-form d-flex align-items-center justify-content-end" style="gap: 10px;">
                                    <div class="total_listing">
                                       <div><span>Current Active : </span></div>
                                       <div><span id="totalViewerLegboxList">1</span></div>
                                    </div>
                                    
                                 </div>
                              </div>
                           </div>
                           <div class="table-responsive-xl">
                              <table class="table mb-3" id="massage-profile">
                                 <thead class="table-bg">
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Stage Name</th>
                                    <th scope="col">Available</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                       <tr>
                                          <td>004</td>
                                          <td>25-09-2025</td>
                                          <td>Marianne Smith</td>
                                          <td>0438 028 728</td>
                                          <td>info@condomma.com.au</td>
                                          <td>Two Lips</td>
                                          <td>Mon, Tue, Wed, Thu, Fri</td>
                                          <td>Active</td>
                                          <td class="text-center">
                                             <div class="dropdown no-arrow">
                                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                     <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                 </a>
                                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                   <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#viewMasseur">  <i class="fa fa-eye "></i> View Profile</a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#editMasseur" data-toggle="modal"> <i class="fa fa-pen"></i> Edit profile </a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-circle"></i> Activate</a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-ban"></i> Deactivate</a>
                                                   
                                                </div>
                                             </div>
                                         </td>
                                       </tr>
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
   var table = $("#massage-profile").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Profile Name"
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10,
         columns: [
            { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'created', name: 'created', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'mobile', name: 'mobile', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'email', name: 'email', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'stage_name', name: 'stage_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'available', name: 'available', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'status', name: 'status', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
            ],

});

 </script>


@endpush