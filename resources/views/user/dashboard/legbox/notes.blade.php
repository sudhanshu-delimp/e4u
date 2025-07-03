@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   .help-icon {
      font-size: 1.2rem;
      cursor: pointer;
      margin-left: 8px;
    }
    .action-icons i {
      cursor: pointer;
      margin-right: 10px;
    }
    .total_listing {
    font-size: 14px;
}
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5">
         <!--middle content start here-->
         <div class="row">
            <div class="col-md-12">
               <div class="v-main-heading h3" style="display: inline-block;">
                  <h1 class="p-0 m-0">My Legbox Viewers</h1>
               </div>
               <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
            <div class="col-md-12 my-2">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol>
                        <li>This list includes only your favourite Massage Centres.</li>
                        <li>Use the Notebox to record your experience. <a href="{{ route('user.new') }}" class="custom_links_design">Add Notebox</a></li>
                        <li>Notifications do not apply to Massage Centres.</li>
                      </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row my-2">
            <!-- My Legbox -->
            <div class="col-md-12 mb-4">
               <div class="mb-3 d-flex align-items-center justify-content-end flex-wrap gap-10">
                  <div class="total_listing">
                     <div><span>Total Viewers Legbox : </span></div>
                     <div><span>03</span></div>
                  </div>
               </div>
               <div class="table-responsive">
                  <table id="noteTable" class="table table-bordered display" width="100%">
                     <thead class="bg-first">
                       <tr>
                         <th>ID</th>
                         <th>Location</th>
                         <th>Business Name</th>
                         <th>Open Now</th>
                         <th>Rating</th>
                         <th>Contact Enabled</th>
                         <th>Contact Method</th>
                         <th>Communication</th>
                         <th>Actions</th>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         <td>M60587</td>
                         <td>WA</td>
                         <td>Lin’s Massage</td>
                         <td>Yes</td>
                         <td>Good</td>
                         <td>Yes</td>
                         <td>Text</td>
                         <td>0438 028 728</td>
                         <td>
                           <div class="dropdown no-arrow">
                              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                              </a>
                              <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item" href="#">Disable Contact</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">Rate this Massage Centre</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">Remove Permanently</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">View Profile</a>
                              </div>
                           </div>
                         </td>
                       </tr>
                       <tr>
                         <td>M60485</td>
                         <td>WA</td>
                         <td>Beauty Massage</td>
                         <td>Yes</td>
                         <td>Very Good</td>
                         <td>No</td>
                         <td>Disabled</td>
                         <td>-</td>
                         <td>
                           <div class="dropdown no-arrow">
                              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                              </a>
                              <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item" href="#">Disable Contact</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">Rate this Massage Centre</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">Remove Permanently</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">View Profile</a>
                              </div>
                           </div>
                         </td>
                       </tr>
                       <tr>
                         <td>M60789</td>
                         <td>WA</td>
                         <td>Sweet Care</td>
                         <td>Yes</td>
                         <td>Great</td>
                         <td>Yes</td>
                         <td>Email</td>
                         <td>viewer@gmail.com</td>
                         <td>
                           <div class="dropdown no-arrow">
                              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                              </a>
                              <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item" href="#">Disable Contact</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">Rate this Massage Centre</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">Remove Permanently</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#">View Profile</a>
                              </div>
                           </div>
                         </td>
                       </tr>
                     </tbody>
                   </table>
               </div>
            </div>
         </div>
         <!--middle content end here-->
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
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('#noteTable').DataTable({
           responsive: true,
           language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by ID or Profile Name...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           paging: true
       });
   });
 </script>
   
<script>
   $(function () {
     $('[data-toggle="tooltip"]').tooltip()
   })
 </script>
@endpush