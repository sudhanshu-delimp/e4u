@extends('layouts.admin')
@section('style')
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid">
         <!--middle content-->
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 ">
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding: 0px 0px;">
                  <!-- Page Heading -->
                  
                  
                  <div class="col-md-12 p-0">
                     <div class="v-main-heading">
                           <h1>Manage Staff  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span></h1>
                     </div>
                     <div class=" my-4">
                           <div class="card collapse" id="notes">
                              <div class="card-body">
                                 <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                 <ol>
                                       <li>Create and manage Staff here.</li>
                                       <li>Set the security level for Staff as well as granting access.</li>
                                 </ol>
                              </div>
                           </div>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid --><br>
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">  
                              <div class="tab-pane fade active show" id="tab3warning">
                                 <div class="row pb-3">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
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
                                          <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#addStaffnew">Add New Staff Member</button>
                                       </div>
                                    </div>
                                 </div>                                    
                                 <div class="table-responsive-xl">
                                    <table class="table mb-0">
                                       <thead class="table-bg">
                                       <tr>
                                          <th scope="col">
                                          Staff ID
                                             
                                          </th>
                                          <th scope="col">
                                          Staff Member
                                             
                                          </th>
                                          <th scope="col">
                                          Security Level
                                          </th>
                                          <th scope="col">
                                          Position
                                          </th>
                                          <th scope="col">
                                          Mobile
                                          </th>
                                          <th scope="col">
                                          Email
                                          </th>
                                          <th scope="col">
                                          Total
                                          Logins                                             
                                          </th>
                                          <th scope="col">
                                          Last Login
                                          </th>
                                          
                                          <th scope="col">Action</th>
                                       </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr>
                                             <td width="10%" class="theme-color">S60001</td>
                                             <td class="theme-color">Binny John</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">Managing Director</td>
                                             <td class="theme-color">0438 028 728</td>
                                             <td class="theme-color">Binny@john.com.au </td>
                                             <td class="theme-color">1,999</td>
                                             <td class="theme-color">20-05-2025 09:12 am </td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item view-account-btn" href="#" style="display: flex;align-items: center;justify-content: space-between;" data-id="S60001">View Account  <i class="fa fa-eye text-dark "></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" style="display: flex;align-items: center;justify-content: space-between;">Suspend   <i class="fa fa-ban text-dark"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" style="display: flex;align-items: center;justify-content: space-between;" data-target="#updateStaff" data-toggle="modal">Edit   <i class="fa fa-pen text-dark"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="account-detail-row" id="account-row-S60001" style="display: none;">
                                             <td colspan="10">
                                                <div class="card p-3">
                                                   <!-- Avatar -->
                                                   <div class="d-flex align-items-center mb-3">
                                                      <img src="{{ asset('assets/app/img/ellipse-1.png')}}" alt="Avatar" class="rounded-circle mr-3" width="50" height="50">
                                                      <h6 class="mb-0">Binny John (S60001)</h6>
                                                   </div>
                                          
                                                   <!-- Details Table -->
                                                   <table class="table table-bordered mb-3">
                                                      <tr><th>Business Name</th><td>Binny Pty Ltd</td></tr>
                                                      <tr><th>Mobile</th><td>0438 028 728</td></tr>
                                                      <tr><th>Email</th><td>Binny@john.com.au</td></tr>
                                                      <tr><th>ABN</th><td>12345678901</td></tr>
                                                      <tr><th>Address</th><td>123 King St, Melbourne</td></tr>
                                                   </table>
                                          
                                                   <div class="d-flex justify-content-end">
                                                      <!-- Print Button -->
                                                   <button class="save_profile_btn  d-block bg-second" onclick="printAgent('account-row-S60001')">
                                                      <i class="fa fa-print text-white"></i> Print
                                                   </button>
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
                  <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="timer_section">
                           <p>Server time: <span class="serverTime">{{ getServertime() }}</span></p>
                           <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
                           <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
                        </div>
                  </div>
               </div>
            </div>
            <!--middle content end here-->
            <!--right side bar start from here-->
         </div>
         <!--right side bar end-->
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

<!-- add new staff member popupform -->
<div class="modal fade upload-modal" id="addStaffnew" tabindex="-1" role="dialog" aria-labelledby="addStaffnewLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="addStaffnew">Add New Staff Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
            <div class="row">
               <!-- Section: Personal Details -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
               </div>

               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Full Name" required  name="staff_f_name">
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Address" required  name="staff_address">
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Mobile" required  name="staff_phone">
               </div>
               <div class="col-6 mb-3">
                  <input type="email" class="form-control rounded-0" placeholder="Private Email" required  name="staff_email">
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" required  name="staff_gender">
                  <option>Select Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                  </select>
               </div>

               <!-- Next of Kin Section -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>
               </div>

               <div class="col-6 mb-3">
                  <input type="text" required  name="emr_name" class="form-control rounded-0" placeholder="Name">
               </div>
               <div class="col-6 mb-3">
                  <input type="text" required  name="emr_relation" class="form-control rounded-0" placeholder="Relationship">
               </div>
               <div class="col-6 mb-3">
                  <input type="text" required  name="emr_phone" class="form-control rounded-0" placeholder="Mobile">
               </div>
               <div class="col-6 mb-3">
                  <input type="email"  name="emr_email" class="form-control rounded-0" placeholder="Email (optional)">
               </div>

               <!-- Section: Other Details -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
               </div>

               <div class="col-6 mb-3">
                  <input type="text" required  name="position" class="form-control rounded-0" placeholder="Position">
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" required  name="select_city">
                  <option>Select Location</option>
                  <option>Delhi</option>
                  <option>Mumbai</option>
                  <option>Bangalore</option>
                  <!-- Add more cities as needed -->
                  </select>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" required  name="commenced_date" class="form-control rounded-0" placeholder="Commenced Date (DD/MM/YYYY)" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">

               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" required  name="select_level">
                  <option selected>Security Level - Level 3</option>
                  <option value="Level-1">Level 1</option>
                  <option value="Level-2">Level 2</option>
                  <option value="Level-3" selected>Level 3</option>
                  <option value="Level-4">Level 4</option>
                  </select>
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" name="emp_status" required>
                  <option>Select Employment Status</option>
                  <option value="Full-Time">Full Time</option>
                  <option value="Part-Time">Part Time</option>
                  <option value="Casual">Casual</option>
                  <option value="Contractor">Contractor</option>
                  </select>
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" name="agreement" required>
                  <option>Employment Agreement?</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
               </div>

               <!-- Section: Building Security -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
               </div>

               <div class="col-4 mb-3">
                  <select class="form-control rounded-0" required  name="code">
                  <option>Access Code Provided?</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
               </div>
               <div class="col-4 mb-3">
                  <select class="form-control rounded-0" required name="key">
                  <option>Key Provided?</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
               </div>
               <div class="col-4 mb-3">
                  <select class="form-control rounded-0" required  name="car_parking">
                  <option>Car Park?</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
               </div>

               </div>             
               <div class="modal-footer p-0 pl-2 pb-4">
                  <button type="button" class="btn btn-primary mr-3">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
 <!-- end -->


<!-- add new staff member popupform -->
<div class="modal fade upload-modal" id="updateStaff" tabindex="-1" role="dialog" aria-labelledby="updateStaffLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="updateStaff">Update Staff Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">
                  <!-- Section: Personal Details -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                  </div>

                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Full Name" required value="Binny John" name="staff_f_name">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Address" required value="123 Street Name, City" name="staff_address">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Mobile" required value="0412 345 678" name="staff_phone">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="email" class="form-control rounded-0" placeholder="Private Email" required value="binny@example.com" name="staff_email">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0" required name="staff_gender">
                        <option>Select Gender</option>
                        <option value="male">Male</option>
                        <option selected value="female">Female</option>
                        <option value="other">Other</option>
                     </select>
                  </div>

                  <!-- Next of Kin Section -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>
                  </div>

                  <div class="col-6 mb-3">
                     <input type="text" required name="emr_name" class="form-control rounded-0" value="Alice John" placeholder="Name">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" required name="emr_relation" class="form-control rounded-0" value="Wife" placeholder="Relationship">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" required name="emr_phone" class="form-control rounded-0" value="0412 765 432" placeholder="Mobile">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="email" name="emr_email" class="form-control rounded-0" value="alice@example.com" placeholder="Email (optional)">
                  </div>

                  <!-- Section: Other Details -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
                  </div>

                  <div class="col-6 mb-3">
                     <input type="text" required name="position" class="form-control rounded-0" value="Security Officer" placeholder="Position">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0" required name="select_city">
                        <option>Select Location</option>
                        <option selected>Delhi</option>
                        <option>Mumbai</option>
                        <option>Bangalore</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" required name="commenced_date" class="form-control rounded-0" value="2023-08-15" placeholder="Commenced Date (DD/MM/YYYY)" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0" required name="select_level">
                        <option value="Level-1">Level 1</option>
                        <option value="Level-2">Level 2</option>
                        <option value="Level-3" selected>Level 3</option>
                        <option value="Level-4">Level 4</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0" name="emp_status" required>
                        <option>Select Employment Status</option>
                        <option value="Full-Time" selected>Full Time</option>
                        <option value="Part-Time">Part Time</option>
                        <option value="Casual">Casual</option>
                        <option value="Contractor">Contractor</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0" name="agreement" required>
                        <option>Employment Agreement?</option>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                     </select>
                  </div>

                  <!-- Section: Building Security -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
                  </div>

                  <div class="col-4 mb-3">
                     <select class="form-control rounded-0" required name="code">
                        <option>Access Code Provided?</option>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                     </select>
                  </div>
                  <div class="col-4 mb-3">
                     <select class="form-control rounded-0" required name="key">
                        <option>Key Provided?</option>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                     </select>
                  </div>
                  <div class="col-4 mb-3">
                     <select class="form-control rounded-0" required name="car_parking">
                        <option>Car Park?</option>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                     </select>
                  </div>
               </div>
               <div class="modal-footer p-0 pl-2 pb-4">
                  <button type="button" class="btn btn-primary mr-3">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end -->

@endsection
@push('script')
   <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}
    "></script>
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
   $(document).ready(function(e) {
            // ajaxReload();
            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' '+countdown);

                if (countdown <= 0) {
                    $('#listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#listings').DataTable().search(this.value).draw();
            });
        })
</script>



<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".view-account-btn").forEach(function (btn) {
         btn.addEventListener("click", function (e) {
            e.preventDefault();
            const id = btn.getAttribute("data-id");
            const row = document.getElementById(`account-row-${id}`);
            
            // Toggle visibility
            if (row.style.display === "none") {
               row.style.display = "table-row";
            } else {
               row.style.display = "none";
            }
         });
      });
   });
   </script>
   
@endpush