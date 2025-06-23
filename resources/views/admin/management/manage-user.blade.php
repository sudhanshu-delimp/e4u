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
                  
                  
                  <div class="col-md-12">
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
                  <div class="row ml-1
                     ">
                     <div class="panel-heading">
                        <ul class="nav nav-tabs tab-sec pb-2">
                           <li class="active"><a href="#tab1warning" data-toggle="tab" class="active">Manage User</a></li>
                           <li><a href="#tab2warning" data-toggle="tab" class="">Awaiting Activation</a></li>
                           <li><a href="#tab3warning" data-toggle="tab" class="">Manage Staff</a></li>
                           <li><a href="#tab4warning" data-toggle="tab" class="">Manage Bans</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid --><br>
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active show" id="tab1warning">
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
                                          <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#Competitor">Add New User</button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="table-responsive-xl">
                                    <table class="table" style="margin-bottom:0px;">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">ID</th>
                                             <th scope="col">Name</th>
                                             <th scope="col">Type</th>
                                             <th scope="col">Location</th>
                                             <th scope="col">Email</th>
                                             <th scope="col">Last Login</th>
                                             <th scope="col">
                                                Registered
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                             </th>
                                             <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color">E20000043</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">Ewan Dev </td>
                                             <td class="theme-color">Australia</td>
                                             <td class="theme-color">ewan@clerkingservices.com.au</td>
                                             <td class="theme-color">01-03-2021</td>
                                             <td class="theme-color">26-05-20 01:04 PM </td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    {{-- <nav aria-label="Page navigation example">
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
                                    </nav> --}}
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab2warning">
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
                                 </div>
                                 
                                 <div class="table-responsive-xl">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">ID</th>
                                             <th scope="col">Name</th>
                                             <th scope="col">Type</th>
                                             <th scope="col">Location</th>
                                             <th scope="col">Email</th>
                                             <th scope="col">Last Login</th>
                                             <th scope="col">
                                                Registered
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                             </th>
                                             <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color">E20000043</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">Ewan Dev</td>
                                             <td class="theme-color">Australia</td>
                                             <td class="theme-color">ewan@clerkingservices.com.au</td>
                                             <td class="theme-color">01-03-2021</td>
                                             <td class="theme-color">26-05-20 01:04 PM </td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#">Activate</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Reject</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color">E20000043</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">Ewan Dev</td>
                                             <td class="theme-color">Australia</td>
                                             <td class="theme-color">ewan@clerkingservices.com.au</td>
                                             <td class="theme-color">01-03-2021</td>
                                             <td class="theme-color">Not Activated</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#">Activate</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Reject</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete</a>
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
                              <div class="tab-pane fade" id="tab3warning">
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
                                    <table class="table">
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
                                          <tr class="row-color">
                                             <td width="10%" class="theme-color">S60001</td>
                                             <td class="theme-color">Wayne Primrose</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">Managing Director</td>
                                             <td class="theme-color">0438 028 728</td>
                                             <td class="theme-color">wayne@blackboxtech.com.au </td>
                                             <td class="theme-color">1,999</td>
                                             <td class="theme-color">20-05-2025 09:12 am </td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" style="display: flex;align-items: center;justify-content: space-between;">View Account  <i class="fa fa-eye text-dark "></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" style="display: flex;align-items: center;justify-content: space-between;">Suspend   <i class="fa fa-times text-dark" style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" style="display: flex;align-items: center;justify-content: space-between;">Edit   <i class="fa fa-pen text-dark" style="float: right;"></i></a>
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
                              <div class="tab-pane fade" id="tab4warning">
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
                                          <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#new-ban">Create a New Ban</button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="table-responsive-xl">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Member Id</th>
                                             <th scope="col">ID</th>
                                             <th scope="col">Name</th>
                                             <th scope="col">Reason</th>
                                             <th scope="col">Ban Lenght</th>
                                             <th scope="col">Ban Date</th>
                                             <th scope="col">
                                                Ban Lift Date
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                             </th>
                                             <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color">E20000043</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">Ewan Dev</td>
                                             <td class="theme-color">Australia</td>
                                             <td class="theme-color">ewan@clerkingservices.com.au</td>
                                             <td class="theme-color">01-03-2021</td>
                                             <td class="theme-color">26-05-20 01:04 PM </td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit-Ban">Edit Ban</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Remove Ban</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete</a>
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
<div class="modal fade upload-modal" id="Competitor" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Competitor">Create New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select User Type</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3"> </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Email">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Display Name">
                  </div>
                  <div class="col-12 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select Home State</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <input type="Password" class="form-control rounded-0" placeholder="Password">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="Password" class="form-control rounded-0" placeholder="Confirm Password">
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer p-0 pl-2 pb-4">
            <button type="button" class="btn btn-primary mr-3">Save</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Edit_Competitor" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Edit_Competitor">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option value="Admin">Admin</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Email">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Name">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Choose Home Country</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select Home State</option>
                     </select>
                  </div>
                  <div class="col-12 mb-3">
                     <select class="form-control rounded-0">
                        <option>Australia</option>
                     </select>
                  </div>
                  <div class="col-6">
                     <input type="password" class="form-control rounded-0" placeholder="Password">
                  </div>
                  <div class="col-6">
                     <input type="password" class="form-control rounded-0" placeholder="Confirm Password">
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="New-Mail" tabindex="-1" role="dialog" aria-labelledby="New-Mail" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="New-Mail">Edit Competitor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body p-4 pb-0">
            <form>
               <div class="row">
                  <div class="col-12 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Competitor Name">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Competitor Website">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Rating">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Choose Home Country</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select Home State</option>
                     </select>
                  </div>
                  <div class="col-12 mb-3">
                     <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" placeholder="Notes" rows="3"></textarea>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pr-3">
            <button type="button" class="btn btn-primary"><img src="{{ asset('assets/app/img/repeat.png')}}" class="img-profile pr-2">Reply</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal change-security" id="change-security" tabindex="-1" role="dialog" aria-labelledby="change-security" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="Competitor">Change Security Level</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <p class="pr-5 pt-4 mb-0"> You’re about to change <b>Ewan Dev</b> Security Level 
               from <b>Owner</b> to <b>Admin</b>
            </p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" style="background: #5D6D7E;border: #5D6D7E;">Cancel</button>
            <button type="button" class="btn btn-primary">Confirm</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal new-ban" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="New-Mail">Create a New Ban</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body p-4 pb-0">
            <form>
               <div class="row">
                  <div class="col-6">
                     <div class="input-group mb-3">
                        <input type="text" class="form-control rounded-0 border-right-0" placeholder="Select User By ID" aria-label="Username" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-white border-left-0" id="basic-addon1"><i class="fa fa-search" style="color: #5D6D7E; font-size: 13px;"></i></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-6 mb-3"></div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" placeholder="Competitor Website">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" placeholder="Rating">
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Choose Home Country</option>
                     </select>
                  </div>
                  <div class="col-6 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select Home State</option>
                     </select>
                  </div>
                  <div class="col-12 mb-3">
                     <div class="form-check form-check-inline m-0">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Other</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Permanent</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Temporary</label>
                     </div>
                  </div>
                  <div class="col-12 mb-3">
                     <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" placeholder="Reason" rows="3"></textarea>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pr-3">
            <button type="button" class="btn btn-primary">Create</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal Edit-Ban" id="Edit-Ban" tabindex="-1" role="dialog" aria-labelledby="Edit-Ban" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Edit-Ban">Edit Ban</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body p-4 pb-0">
            <form>
               <div class="row">
                  <div class="col-6 mb-3">
                     <input type="text" value="E20000043" class="form-control rounded-0" placeholder="Select User By ID">
                  </div>
                  <div class="col-6 mb-3"><span style="font-size: 14px;"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img mr-2">Carla Brasil</span></div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" placeholder="Competitor Website">
                  </div>
                  <div class="col-6 mb-3">
                     <input type="date" class="form-control rounded-0" placeholder="Rating">
                  </div>
                  <div class="col-12 mb-3">
                     <div class="form-check form-check-inline m-0">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Other</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Permanent</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Temporary</label>
                     </div>
                  </div>
                  <div class="col-12 mb-3">
                     <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" placeholder="Reason" rows="3"></textarea>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pr-3">
            <button type="button" class="btn btn-primary">Update</button>
         </div>
      </div>
   </div>
</div>
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
   
@endpush