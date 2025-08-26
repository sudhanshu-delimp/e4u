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
               <h1 class="h1">Profiles</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol>
                           <li>Use these help pages for explanations and guidance on managing all of your Masseur
                              Profiles.</li>
                           <li>You can upload four photos for each Masseur. Designate one as the Masseur's
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
                                 <div class="bothsearch-form d-flex align-items-center justify-content-between" style="gap: 10px;">
                                    <div class="total_listing">
                                       <div><span>Current Active : </span></div>
                                       <div><span id="totalViewerLegboxList">1</span></div>
                                    </div>
                                    <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#addMasseur">Add Masseur</button>
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





<!-- Add New Masseur member popupform -->
<div class="modal fade upload-modal" id="addMasseur" tabindex="-1" role="dialog" aria-labelledby="addMasseurLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="addMasseur"> 
               <img src="{{ asset('assets/dashboard/img/add-massaure.png')}}" class="custompopicon"> Add Masseur
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">

                   <!-- Personal Info -->
                   <div class="col-6 mb-3">
                       <label for="masseurName" class="mb-1">Name</label>
                       <input type="text" id="masseurName" class="form-control rounded-0" placeholder="Enter Name" required>
                   </div>
                   <div class="col-6 mb-3">
                       <label for="masseurMobile" class="mb-1">Mobile</label>
                       <input type="text" id="masseurMobile" class="form-control rounded-0" placeholder="Enter Mobile" required>
                   </div>
                   <div class="col-6 mb-3">
                       <label for="masseurEmail" class="mb-1">Email</label>
                       <input type="email" id="masseurEmail" class="form-control rounded-0" placeholder="Enter Email" required>
                   </div>

                   <!-- Profile Info -->
                   <div class="col-6 mb-3">
                       <label for="stageName" class="mb-1">Stage Name</label>
                       <input type="text" id="stageName" class="form-control rounded-0" placeholder="Enter Stage Name" required>
                   </div>

                   <!-- Availability -->
                   <div class="col-6 mb-3">
                       <label for="availableDays" class="mb-1">Available Days</label>
                       <select id="availableDays" class="form-control rounded-0" required>
                           <option value="">Select Days</option>
                           <option>Monday</option>
                           <option>Tuesday</option>
                           <option>Wednesday</option>
                           <option>Thursday</option>
                           <option>Friday</option>
                           <option>Saturday</option>
                           <option>Sunday</option>
                       </select>
                   </div>
                   <div class="col-6 mb-3">
                       <label for="availableTime" class="mb-1">Available Time</label>
                       <select id="availableTime" class="form-control rounded-0" required>
                           <option value="">Select Time</option>
                           <option>Morning (8am - 12pm)</option>
                           <option>Afternoon (12pm - 4pm)</option>
                           <option>Evening (4pm - 8pm)</option>
                           <option>Night (8pm - 12am)</option>
                       </select>
                   </div>

                   <div class="col-6 mb-3">
                       <label for="massageRate" class="mb-1">Massage Rate</label>
                       <input type="text" id="massageRate" class="form-control rounded-0" placeholder="Enter Rate" required>
                   </div>
                   <div class="col-6 mb-3">
                       <label for="vaccine" class="mb-1">Vaccine</label>
                       <input type="text" id="vaccine" class="form-control rounded-0" placeholder="Enter Vaccine">
                   </div>
                   <div class="col-6 mb-3">
                       <label for="nationality" class="mb-1">Nationality</label>
                       <input type="text" id="nationality" class="form-control rounded-0" placeholder="Enter Nationality">
                   </div>
                   <div class="col-6 mb-3">
                       <label for="ethnicity" class="mb-1">Ethnicity</label>
                       <input type="text" id="ethnicity" class="form-control rounded-0" placeholder="Enter Ethnicity">
                   </div>
                   <div class="col-6 mb-3">
                       <label for="age" class="mb-1">Age</label>
                       <input type="number" id="age" class="form-control rounded-0" placeholder="Enter Age">
                   </div>

                   <!-- Commentary -->
                   <div class="col-12 mb-3">
                       <label for="commentary" class="mb-1">Commentary</label>
                       <textarea id="commentary" class="form-control rounded-0" placeholder="Commentary (max 300 words)" rows="3"></textarea>
                   </div>

               </div>

               <div class="modal-footer p-0 pl-2 pb-4">
                   <button type="submit" class="btn-success-modal mr-2">Save</button>
                   <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
               </div>
           </form>
        </div>
      </div>
   </div>
</div>
<!-- end -->

<!-- Edit Masseur popupform -->
<div class="modal fade upload-modal" id="editMasseur" tabindex="-1" role="dialog" aria-labelledby="editMasseurLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="editMasseurLabel"> 
               <img src="{{ asset('assets/dashboard/img/add-massaure.png')}}" class="custompopicon"> 
               Update Masseur 
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>

         <div class="modal-body">
            <form>
               <div class="row">
                  <div class="col-6 mb-3">
                     <label for="editName" class="mb-1">Name</label>
                     <input type="text" id="editName" class="form-control rounded-0" placeholder="Enter Name" value="John Doe" required>
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editMobile" class="mb-1">Mobile</label>
                     <input type="text" id="editMobile" class="form-control rounded-0" placeholder="Enter Mobile" value="0412345678" required>
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editEmail" class="mb-1">Email</label>
                     <input type="email" id="editEmail" class="form-control rounded-0" placeholder="Enter Email" value="john@example.com" required>
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editStageName" class="mb-1">Stage Name</label>
                     <input type="text" id="editStageName" class="form-control rounded-0" placeholder="Enter Stage Name" value="RelaxMaster">
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editAvailableDays" class="mb-1">Available Days</label>
                     <select id="editAvailableDays" class="form-control rounded-0" required>
                        <option>Select Days</option>
                        <option selected>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                        <option>Saturday</option>
                        <option>Sunday</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editAvailableTime" class="mb-1">Available Time</label>
                     <select id="editAvailableTime" class="form-control rounded-0" required>
                        <option>Select Time</option>
                        <option selected>Morning (8am - 12pm)</option>
                        <option>Afternoon (12pm - 4pm)</option>
                        <option>Evening (4pm - 8pm)</option>
                        <option>Night (8pm - 12am)</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editRate" class="mb-1">Massage Rate</label>
                     <input type="text" id="editRate" class="form-control rounded-0" placeholder="Enter Rate" value="$120/hr">
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editVaccine" class="mb-1">Vaccine</label>
                     <input type="text" id="editVaccine" class="form-control rounded-0" placeholder="Enter Vaccine" value="Yes">
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editNationality" class="mb-1">Nationality</label>
                     <input type="text" id="editNationality" class="form-control rounded-0" placeholder="Enter Nationality" value="Australian">
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editEthnicity" class="mb-1">Ethnicity</label>
                     <input type="text" id="editEthnicity" class="form-control rounded-0" placeholder="Enter Ethnicity" value="Caucasian">
                  </div>
                  <div class="col-6 mb-3">
                     <label for="editAge" class="mb-1">Age</label>
                     <input type="number" id="editAge" class="form-control rounded-0" placeholder="Enter Age" value="32">
                  </div>

                  <!-- Commentary -->
                  <div class="col-12 mb-3">
                     <label for="editCommentary" class="mb-1">Commentary</label>
                     <textarea id="editCommentary" class="form-control rounded-0" placeholder="Commentary (max 300 words)" rows="3">Specialized in deep tissue massage and relaxation techniques.</textarea>
                  </div>
               </div>

               <div class="modal-footer p-0 pl-2 pb-4">
                  <button type="submit" class="btn-success-modal mr-2">Update</button>
                  <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
{{-- end --}}

{{-- view Masseur modal popup --}}

<!-- View Masseur popupform -->
<div class="modal fade upload-modal" id="viewMasseur" tabindex="-1" role="dialog" aria-labelledby="viewMasseurLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title" id="viewMasseurLabel">
               <img src="{{asset('assets/dashboard/img/add-massaure.png')}}" style="width:40px; margin-right:10px;" alt="View Masseur">
               View Masseur
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>

         <!-- Body -->
         <div class="modal-body pb-0 custom-merchant-modal">
            <div class="row">
               <div class="col-12">
                  
                  <div class="card mb-3 p-3">
                     <!-- Avatar + Name -->
                     <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/img/default_user.png')}}" alt="Avatar" class="rounded-circle mr-3" width="60" height="60">
                        <h6 class="mb-0">RelaxMaster (John Doe)</h6>
                     </div>

                     <!-- Masseur Profile -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Masseur Profile</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Name</th><td>John Doe</td></tr>
                        <tr><th>Stage Name</th><td>RelaxMaster</td></tr>
                        <tr><th>Mobile</th><td>0412345678</td></tr>
                        <tr><th>Email</th><td>john@example.com</td></tr>
                     </table>

                     <!-- Availability -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Availability</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Available Days</th><td>Monday, Wednesday, Friday</td></tr>
                        <tr><th>Available Time</th><td>Morning (8am - 12pm)</td></tr>
                     </table>

                     <!-- Other Details -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
                     <table class="table table-bordered mb-3">
                        <tr><th>Massage Rate</th><td>$120/hr</td></tr>
                        <tr><th>Vaccine</th><td>Yes</td></tr>
                        <tr><th>Nationality</th><td>Australian</td></tr>
                        <tr><th>Ethnicity</th><td>Caucasian</td></tr>
                        <tr><th>Age</th><td>32</td></tr>
                     </table>

                     <!-- Commentary -->
                     <h6 class="border-bottom pb-1 text-blue-primary">Commentary</h6>
                     <p class="mb-3">
                        Specialized in deep tissue massage and relaxation techniques. 
                        More than 10 years of experience in spa and wellness therapies.
                     </p>
                     

                     <!-- Footer Buttons -->
                     <div class="d-flex justify-content-end mb-2">
                        <button class="btn-success-modal d-block mr-2" onclick="window.print();">
                           <i class="fa fa-print text-white"></i> Print
                        </button>
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">
                           Close
                        </button>
                     </div>
                  </div>

               </div>
            </div>
         </div>

      </div>
   </div>
</div>



@endsection

@push('script')
<!-- file upload plugin start here -->



<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   var table = $("#massage-profile").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Name..."
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10
});

 </script>


@endpush