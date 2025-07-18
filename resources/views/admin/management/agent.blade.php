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
                           <h1>Manage Agent  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span></h1>
                     </div>
                     <div class=" my-4">
                           <div class="card collapse" id="notes">
                              <div class="card-body">
                                 <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                 <ol>
                                       <li>Create and manage Agents here.</li>
                                       <li>Manage status of Agents.</li>
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
                                          <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#addStaffnew">Add New Agent</button>
                                       </div>
                                    </div>
                                 </div>                                    
                                 <div class="table-responsive-xl">
                                    <table class="table mb-0">
                                       <thead class="table-bg">
                                       <tr>
                                          <th scope="col">
                                          Agent ID
                                             
                                          </th>
                                          <th scope="col">
                                          Agent Member
                                             
                                          </th>
                                          <th scope="col">
                                             Territory
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
                                          <th scope="col">
                                             Status
                                             </th>
                                          
                                          <th scope="col">Action</th>
                                       </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr>
                                             <td width="10%" class="theme-color">S60001</td>
                                             <td class="theme-color">Binny Primrose</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">Managing Director</td>
                                             <td class="theme-color">0438 028 728</td>
                                             <td class="theme-color">Binny@blackboxtech.com.au </td>
                                             <td class="theme-color">1,999</td>
                                             <td class="theme-color">20-05-2025 09:12 am </td>
                                             <td class="theme-color">Active </td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-id="S60001">  <i class="fa fa-eye "></i> View Account</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-ban"></i> Suspend</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#edit_agent_data" data-toggle="modal"> <i class="fa fa-pen"></i> Edit </a>
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
                                                      <h6 class="mb-0">Binny Primrose (S60001)</h6>
                                                   </div>
                                          
                                                   <!-- Details Table -->
                                                   <table class="table table-bordered mb-3">
                                                      <tr><th>Business Name</th><td>Binny Pty Ltd</td></tr>
                                                      <tr><th>Mobile</th><td>0438 028 728</td></tr>
                                                      <tr><th>Email</th><td>binny@blackboxtech.com.au</td></tr>
                                                      <tr><th>ABN</th><td>12345678901</td></tr>
                                                      <tr><th>Address</th><td>123 King St, Melbourne</td></tr>
                                                   </table>
                                          
                                                   <div class="d-flex justify-content-end">
                                                      <!-- Print Button -->
                                                   <button class="save_profile_btn bg-second d-block" onclick="printAgent('account-row-S60001')">
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

<!-- add new Agent member popupform -->
<div class="modal fade upload-modal" id="addStaffnew" tabindex="-1" role="dialog" aria-labelledby="addStaffnewLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="addStaffnew">Add New Agent</h5>
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
                  <input type="text" class="form-control rounded-0" placeholder="Agent ID (Auto)" readonly>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Date Joined" readonly>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Business Name" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="ABN" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Business Address" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Business Number" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Point of Contact" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Mobile" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="email" class="form-control rounded-0" placeholder="Private Email" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="email" class="form-control rounded-0" placeholder="E4U Email" required>
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" required>
                    <option>Select Territory</option>
                    <option>North</option>
                    <option>South</option>
                    <option>East</option>
                    <option>West</option>
                  </select>
               </div>
               <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                  <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="contactText" value="text">
                    <label class="form-check-label" for="contactText">Text</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="contactEmail" value="email">
                    <label class="form-check-label" for="contactEmail">Email</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="contactCall" value="call">
                    <label class="form-check-label" for="contactCall">Call Me</label>
                  </div>
               </div>

               <!-- Section: Agreement Details -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
               </div>
               <div class="col-6 mb-3">
                  <input type="text"  class="form-control rounded-0"  required placeholder="Agreement Date (DD/MM/YYYY)" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Term" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="Option Period" required>
               </div>
               <div class="col-6 mb-3">
                  <select class="form-control rounded-0" required>
                    <option>Option Exercised?</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
               </div>

               <!-- Section: Commission -->
               <div class="col-12 my-2">
                  <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
               </div>
               <div class="col-6 mb-3">
                  <input type="number" step="0.01" class="form-control rounded-0" placeholder="Advertising Commission %" required>
               </div>
               <div class="col-6 mb-3">
                  <input type="number" step="0.01" class="form-control rounded-0" placeholder="Massage Centre Commission %" required>
               </div>

            </div>
            <div class="modal-footer p-0 pl-2 pb-4">
               <button type="submit" class="btn btn-primary mr-2">Save</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
 <!-- end -->
 
<!-- Edit Agent member popupform -->
<div class="modal fade upload-modal" id="edit_agent_data" tabindex="-1" role="dialog" aria-labelledby="edit_agent_dataLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="edit_agent_data">Update Agent Details </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">
                  <!-- Personal Details -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                  </div>

                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Agent ID (Auto)" readonly value="S60001">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Date Joined" readonly value="2024-03-01">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Business Name" value="Wayne Pty Ltd">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="ABN" value="12345678901">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Business Address" value="123 King St, Melbourne">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Business Number" value="028888999">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Point of Contact" value="Wayne Primrose">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Mobile" value="0438 028 728">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="email" class="form-control rounded-0" placeholder="Private Email" value="wayne.personal@gmail.com">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="email" class="form-control rounded-0" placeholder="E4U Email" value="wayne@blackboxtech.com.au">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select Territory</option>
                        <option selected>North</option>
                        <option>South</option>
                        <option>East</option>
                        <option>West</option>
                     </select>
                  </div>

                  <!-- Method of Contact -->
                  <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                     <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contactText" value="text" checked>
                        <label class="form-check-label" for="contactText">Text</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contactEmail" value="email">
                        <label class="form-check-label" for="contactEmail">Email</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="contactCall" value="call" checked>
                        <label class="form-check-label" for="contactCall">Call Me</label>
                     </div>
                  </div>

                  <!-- Agreement Details -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" value="2023-12-01">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Term" value="12 Months">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Option Period" value="6 Months">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Option Exercised?</option>
                        <option selected>Yes</option>
                        <option>No</option>
                     </select>
                  </div>

                  <!-- Commission -->
                  <div class="col-12 my-2">
                     <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Advertising Commission %" value="10.50">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="number" step="0.01" class="form-control rounded-0" placeholder="Massage Centre Commission %" value="15.00">
                  </div>
               </div>
            <div class="modal-footer p-0 pl-2 pb-4">
               <button type="submit" class="btn btn-primary mr-2">Update</button>
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