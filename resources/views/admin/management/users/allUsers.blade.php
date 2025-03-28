@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
</style>
@stop
@section('content')
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
                  <div class="d-flex align-items-center mb-3">
                     <div class="v-main-heading h3">Set Security & Access Levels</div>
                  </div>
                  <div class="row ml-1 mb-3">
                     <div class="panel-heading">
                        <ul class="nav nav-tabs tab-sec pb-2">
                           <li class="active"><a href="#tab1warning" data-toggle="tab" class="active">Security Settings</a></li>
                           <li><a href="#tab2warning" data-toggle="tab" class="">Access Settings</a></li>
                           <li><a href="#tab4warning" data-toggle="tab" class="">Notes</a></li>
                        </ul>
                     </div>
                  </div>
                  {{-- <div class="row">
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
                  </div> --}}
               </div>
               <!-- /.container-fluid --><br>
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active show" id="tab1warning">
                                 <div id="table-sec" class="table-responsive-xl w-75 pt-3 mt-5">
                                    <table class="table" id="securityDatatable">
                                       <thead class="table-bg">
                                          <th scope="col">Member ID</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Type</th>
                                          <th scope="col">Location</th>
                                          <th scope="col">Security Level</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       {{-- <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color"><b>S60001</b></td>
                                             <td class="theme-color">Wayne Primrose</td>
                                             <td class="theme-color">S</td>
                                             <td class="theme-color">Western Australia</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">E</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>S60001</b></td>
                                             <td class="theme-color">Wayne Primrose</td>
                                             <td class="theme-color">S</td>
                                             <td class="theme-color">Western Australia</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">E</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>S60001</b></td>
                                             <td class="theme-color">Wayne Primrose</td>
                                             <td class="theme-color">V</td>
                                             <td class="theme-color">Western Australia</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">E</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>S60001</b></td>
                                             <td class="theme-color">Wayne Primrose</td>
                                             <td class="theme-color">A</td>
                                             <td class="theme-color">Western Australia</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">E</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>S60001</b></td>
                                             <td class="theme-color">Wayne Primrose</td>
                                             <td class="theme-color">S</td>
                                             <td class="theme-color">Western Australia</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">E</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>S60001</b></td>
                                             <td class="theme-color">Wayne Primrose</td>
                                             <td class="theme-color">E</td>
                                             <td class="theme-color">Western Australia</td>
                                             <td class="theme-color">1</td>
                                             <td class="theme-color">E</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody> --}}
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
                                 <div class="table-responsive-xl w-75">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <th scope="col">Member ID</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color"><b>Escorts</b></td>
                                             <td class="theme-color">12:57 pm 12-06-2022</td>
                                             <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>Massage Centre</b></td>
                                             <td class="theme-color">12:57 pm 12-06-2022</td>
                                             <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>Viewer</b></td>
                                             <td class="theme-color">12:57 pm 12-06-2022</td>
                                             <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>Agent</b></td>
                                             <td class="theme-color">12:57 pm 12-06-2022</td>
                                             <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>Operations - Staff</b></td>
                                             <td class="theme-color">12:57 pm 12-06-2022</td>
                                             <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><b>Operations - Management</b></td>
                                             <td class="theme-color">12:57 pm 12-06-2022</td>
                                             <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
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
                                 <div class="table-responsive-xl">
                                    <ol>
                                       <li>Security and access levels <span class="theme-text-color"><b>(Levels)</b></span> can only be determined by the Managing Director of Blackbox Tech <span class="theme-text-color"><b>(Managing Director).</b></span></li>
                                       <li class="mt-2">SMS 2FA authentification is applied when setting Levels.</li>
                                       <li class="mt-2">Security levels are:</li>
                                       <ul style="list-style: lower-latin;">
                                          <li>Level 1 - Managing Director</li>
                                          <li>Level 2 - Staff of E4U</li>
                                          <li>Level 3 - Agents of E4U</li>
                                          <li>Level 4 - Advertisers</li>
                                       </ul>
                                       <li>User conventions:</li>
                                       <ul class="w-75" style="column-count: 2;list-style: outside;">
                                          <li>Escorts: <span class="ml-5 pl-5">E61234</span></li>
                                          <li>Massage Centre: <span class="ml-4">M61234:001</span></li>
                                          <li>Agent:<span class="ml-4 pl-4">V61234</span></li>
                                          <li>Viewer: <span class="ml-4 pl-4">A61234</span></li>
                                       </ul>
                                       <ul class="w-75" style="list-style: none;">
                                          <li class="pt-2 pb-2">whereby:</span></li>
                                       </ul>
                                       <ul class="w-75" style="column-count: 3;list-style: none;">
                                          <li><span class="pr-5">(a)</span>E = Escorts</li>
                                          <li>M = Massage Centre</li>
                                          <li>V = Viewer</li>
                                       </ul>
                                       <ul class="w-75" style="column-count: 3;list-style: none;">
                                          <li><span class="pr-5 mr-4"> </span>A = Agent</li>
                                          <li>S = Staff</li>
                                       </ul>
                                       <ul class="w-75 mt-2" style="list-style: none;">
                                          <li><span class="pr-5">(b)</span>The first number represents the Home State, that is, 6 is Western Australia, the second group of numbers is the Membership Number / staff number, and
                                             the last three numbers is the Masseur
                                          </li>
                                       </ul>
                                       <li class="mt-2">Location conventions:</li>

                                       <ul class="w-75 mt-2" style="column-count: 2;list-style: none;">
                                       <li>1. ACT</li> <li>2. New South Wales</li>
                                       <li>3. Victoria</li> <li>4. Queensland</li>
                                       <li>5. South Australia</li> <li>6. Western Australia</li>
                                       <li>7. Tasmania</li> <li>8. Northern Territory</li>
                                     </ul>
                                     <li class="mt-2">Access Levels for Users:</li>
                                      <ul class="w-75 mt-2" style="list-style: none;">
                                  <li>Access levels are set by the Managing Director. By default, the levels are:
                                  </li>
                                      </ul>
                                   <ul class="w-75" style="list-style: none;">
                                          <li><span class="pr-5">(a)</span>Escorts: <span class="pl-5 ml-5">Escort Console</span></li>
                                          <li><span class="pr-5">(b)</span>Massage Centre: <span class="pl-4">Massage Console</span></li>
                                          <li><span class="pr-5">(c)</span>Viewer: <span class="pl-5 ml-5">Viewer Console</span></li>
                                       </ul>
                                       <ul class="w-75" style="column-count: 3;list-style: none;">
                                          <li><span class="pr-5">(d)</span>Agent:</li>
                                       <li style="margin-left: -70px;">
<ul style="display: inline-block;">
<li style="list-style: none;margin-left: -35px;">Agent Console</li>
<li style="list-style: none;margin-left: -35px;">Escort Console:</li>
<li>My Account
</li><li>Profiles &amp; Archives
</li><li style="list-style: none;margin-left: -30px;">Massage Centre Console:</li>
<li>My Account
</li><li>Profiles &amp; Archives
</li><li>Masseurs Profiles
</li></ul>
</li></ul>

<ul class="w-75" style="list-style: none;">
                                          <li><span class="pr-5">(e)</span>Staff:<span class="pl-5 ml-5">Operations Console - Security Level 2
Consoles</span></li>


                                       </ul>
                                       <li class="mt-2">Status indicators:</li>
                                       <li style="list-style: none;">Status is an indicator of the User’s access status to the Consoles, namely:</li>
                                       <ul class="w-75 p-0" style="column-count: 3;list-style: none;">
                                          <li>E = Enabled</li>
                                          <li>D = Disabled</li>
                                          <li>S = Suspended</li>
                                       </ul>
                                    </ol>
                                 </div>
                              </div>
                           </div>
                        </div>
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
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- Modal -->
@endsection
{{-- @section('script') --}}
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $("#securityDatatable").DataTable({
       "language": {
           search: "_INPUT_",
        searchPlaceholder: "Search",
        "sSearch": '<a class="btn searchBtn" id="searchBtn"><i class="fa fa-search"></i></a>',

        oPaginate: {
       sNext: '<span aria-hidden="true">»</span>',
       sPrevious: '<span aria-hidden="true">«</span>',
       sFirst: '<span aria-hidden="true">»</span>',
       sLast: '<span aria-hidden="true">»</span>'
    }
       },

       info: false,
      bLengthChange: false,
       processing: true,
       serverSide: true,
       lengthChange: true,
       order: [0,'asc'],
       searchable:false,
       //searching:false,
       bStateSave: false,

       ajax: {
           url: "{{ route('admin.management.allUserDatatable') }}",
           data: function (d) {
               d.type = 'player';
           }
       },
       columns: [
           { data: 'memberId', id: 'memberId', searchable: true, orderable:false,defaultContent: 'NA' },
           { data: 'name', name: 'name', searchable: true, orderable:false,defaultContent: 'NA' },
           { data: 'usertype', name: 'usertype', searchable: true, orderable:false ,defaultContent: 'NA'},
           { data: 'location', name: 'location', searchable: true, orderable:false, defaultContent: 'NA' },
           { data: 'sLevel', name: 'sLevel', searchable: true, orderable:false, defaultContent: 'NA' },
           { data: 'status', name: 'status', searchable: true, orderable:false, defaultContent: 'NA' },
           { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
       ],
       aoColumnDefs:[

                       {
                           "aTargets":[0],
                            "render": function (data) { return  "<a href='#'>"+data+"  </a>";
                           }
                       }
       ]
   });

   $('body').on('shown.bs.modal', '#save-service', function (e) {
       var button = e.relatedTarget;
       $('#service-cat').val($(button).data('category'));
       $('#service-name').val($(button).data('name'));
       $('#service-id').val($(button).data('id'));
   });

   $('body').on('hide.bs.modal', '#save-service', function (e) {
       $('#service-cat').val("");
       $('#service-name').val("");
       $('#service-id').val("");
       console.log('djsffffkd');
   });

   $('#save-service-form').on('submit', function(e) {
       e.preventDefault();

       var form = $(this);

       var url = form.attr('action');
       var data = new FormData(form[0]);

       $.ajax({
           method: form.attr('method'),
           url:url + '/' + $('#service-id').val(),
           data:data,
           contentType: false,
           processData: false,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function (data) {
               if(data.status){

                   form[0].reset();
                   $('#save-service').modal('hide');

                   swal({
                       title: "",
                       text: data.message,
                       icon: "success",

                       closeModal: true,
                       buttons: {
                           cancel: false,
                           ok:true
                       },
                   })
                   .then((value) => {
                       $("#service-table").DataTable().ajax.reload();
                   });

               } else {
                   swal({
                       title: "Oops!",
                       text: "Error! Unable to save service",
                       icon: "error",
                       closeModal: true,
                       buttons: {
                           cancel: false,
                           ok:true
                       },
                   });
               }
           },
           error :function( data ) {
               var response = $.parseJSON(data.responseText);
               swal({
                       title: "Oops!",
                       text: response.errors.toString(),
                       icon: "error",
                       closeModal: true,
                       buttons: {
                           cancel: false,
                           ok:true
                       },
                   });
           }
       });
   });

   $('body').on('click', '.delete-service', function(e) {
    var button = $(this);
    var id = button.data('id');
    console.log(button);
    swal('Do you really want to remove delete this service',{
           dangerMode: true,
           buttons: ["Cancel", "Delete"],
       }).then((result) => {
           if (result) {

               var data = new FormData();
               data.append('job_id', button.data('job_id'));
               data.append('skill_id', button.data('id'));

               $.ajax({
                   type:'DELETE',
                   url: "{{route('admin.service.delete')}}" + '/' + id,
                   data:data,
                   cache:false,
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success:function(data) {

                       if(!data.error){

                           swal({
                               title: "",
                               text: data.message,
                               icon: "success",

                               closeModal: true,
                               buttons: {
                                   cancel: false,
                                   ok:true
                               },
                           })
                           .then((value) => {
                            $("#service-table").DataTable().ajax.reload();
                           });

                       } else {
                           swal({
                               title: "Oops!",
                               text: data.message,
                               icon: "error",
                               closeModal: true,
                               buttons: {
                                   cancel: false,
                                   ok:true
                               },
                           });
                       }
                   },
                   error: function(data) {
                       $("#service-table").DataTable().ajax.reload();
                   }
               });

           } else {
               console.log('laksjkjskj');
           }
       });
   });

</script>
@endpush
