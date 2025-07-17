@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   #cke_1_contents {
   height: 150px !important;
   }
</style>
@stop
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
               <div class="custom-heading-wrapper col-md-12">
                  <h1 class="h1">Agent Notifications</h1>
                  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>                  
               </div>
               <div class="col-md-12 mb-4">
                  <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                           <li>You can create a Notification, published at the top of the Agent’s Dashboard.</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>  
            <div class="row">
               <div class="col-md-12">
                  <div class="row pb-3">
                     <div class="col-lg-4 col-md-6 col-sm-6">
                        <form class="search-form-bg navbar-search">
                           <div class="input-group">
                              <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                 <button class="btn-right-icon" type="button">
                                 <i class="fas fa-search fa-sm"></i>
                                 </button>
                              </div>
                           </div>   
                        </form>
                     </div>
                     <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="bothsearch-form" style="gap: 10px;">
                           <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#createNotification" style="color:var(--peach)">New Notification</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="panel with-nav-tabs panel-warning">
                     <div class="panel-body">
                        <div class="tab-content">
                           <div class="tab-pane fade in active show" id="tab1warning">
                              <div class="table-responsive-xl">
                                 <table class="table">
                                    <thead class="table-bg">
                                       <tr>
                                          <th scope="col">Ref
                                          </th>
                                          <th scope="col">Start</th>
                                         
                                          <th scope="col">Finish</th>
                                          <th scope="col">Type</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody class="table-content">
                                       <tr class="row-color">
                                          <td class="theme-color">Maintenance</td>
                                          <td class="theme-color">08-06-2025</td>
                                          <td class="theme-color">09-06-2025</td>
                                          <td class="theme-color">Adhoc</td>
                                          <td class="theme-color">Published</td>
                                         
                                          <td class="theme-color">
                                             <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-fw fa-times"></i> Removed  </a>
                                                   <div class="dropdown-divider"></div>
                                                   
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" > <i class="fa fa-eye"></i> View </a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" > <i class="fa fa-fw fa-print" ></i> Print </a>
                                                   
                                                </div>
                                             </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <nav aria-label="Page navigation example">
                                    <ul class="pagination float-right pt-4">
                                       <li class="page-item">
                                          <a class="page-link" href="#" aria-label="Previous">
                                          <span aria-hidden="true">«</span>
                                          <span class="sr-only">Previous</span>
                                          </a>
                                       </li>
                                       <li class="page-item"><a class="page-link" href="#">1</a></li>
                                       <li class="page-item"><a class="page-link" href="#">2</a></li>
                                       <li class="page-item"><a class="page-link" href="#">3</a></li>
                                       <li class="page-item">
                                          <a class="page-link" href="#" aria-label="Next">
                                          <span aria-hidden="true">»</span>
                                          <span class="sr-only">Next</span>
                                          </a>
                                       </li>
                                    </ul>
                                 </nav>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<div class="modal fade upload-modal" id="createNotification" tabindex="-1" role="dialog" aria-labelledby="createNotification" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="createNotification">  <img src="{{ asset('assets/dashboard/img/create-notification.png') }}" style="width:25px"> Create Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
         <form>
               <div class="row">

                  <!-- Auto-generated Date (readonly) -->
                  <div class="col-12 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Date (Auto-generated)" readonly value="<?php echo date('Y-m-d'); ?>">
                  </div>

                  <!-- Heading Field -->
                  <div class="col-12 mb-3">
                     <input type="text" class="form-control rounded-0  fw-bold" placeholder="Heading">
                  </div>

                  <!-- Start Date -->
                  <div class="col-12 mb-3">
                  <input type="text" onfocus="(this.type='date')" placeholder="Start Date" class="form-control rounded-0" />

                  </div>

                  <!-- Finish Date -->
                  <div class="col-12 mb-3">
                  <input type="text" onfocus="(this.type='date')" placeholder="Finish Date" class="form-control rounded-0" />

                  </div>

                  <!-- Title -->
                     <div class="col-12 mb-3">
                        <select id="type" class="form-control" onchange="toggleFields()">
                           <option value="">-- Select Type --</option>
                           <option value="adhoc">Adhoc</option>
                           <option value="scheduled">Scheduled</option>
                           <option value="notice">Notice</option>
                        </select>
                     </div>
                     <div class="col-12">   
                        <!-- Adhoc Section -->
                        <div id="adhocSection" class="section form-group" style="display: none;">
                              <textarea id="adhocContent" class="form-control" placeholder="Type your content here..."></textarea>
                        </div>

                        <!-- Scheduled Section -->
                        <div id="scheduledSection" class="section" style="display: none;">
                              <div class="form-group">
                                 <input type="text" id="startDate"  onfocus="(this.type='date')" placeholder="Start Date" class="form-control rounded-0">
                              </div>
                              <div class="form-group">
                                 <input type="text" id="endDate"  onfocus="(this.type='date')" placeholder="End Date" class="form-control rounded-0">
                              </div>
                              <div class="form-group">
                                 <select id="duration" class="form-control">
                                    <option value="">-- Select Duration --</option>
                                    <option value="weeks">Weeks</option>
                                    <option value="months">Months</option>
                                    <option value="years">Years</option>
                                    <option value="forever">Forever</option>
                                 </select>
                              </div>
                        </div>

                        <!-- Notice Section -->
                        <div id="noticeSection" class="section form-group" style="display: none;">
                              <input type="text" id="memberId" class="form-control" placeholder="Member Id e.g. 123456">
                        </div> 
                  </div>
                  <!-- content -->
                  <div class="col-12 mb-3">
                     <textarea id="content" class="form-control" placeholder="up to 250 characters..."></textarea>
   
                  </div>
   
               </div>
            </form>

         </div>
         <div class="modal-footer pr-3">
            <button type="button" class="btn btn-primary">Save</button>
         </div>
      </div>
   </div>
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
   CKEDITOR.replace('editor1', {
      fullPage: true,
      extraPlugins: 'docprops',
      // Disable content filtering because if you use full page mode, you probably
      // want to  freely enter any HTML content in source mode without any limitations.
      allowedContent: true,
      height: 320
   });
</script>
<script>
   function toggleFields() {
       const type = document.getElementById("type").value;

       // Hide all sections
       document.querySelectorAll('.section').forEach(sec => sec.style.display = 'none');

       // Show the selected section
       if (type === "adhoc") {
           document.getElementById("adhocSection").style.display = "block";
       } else if (type === "scheduled") {
           document.getElementById("scheduledSection").style.display = "block";
       } else if (type === "notice") {
           document.getElementById("noticeSection").style.display = "block";
       }
   }
</script>
@endsection