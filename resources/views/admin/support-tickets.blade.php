@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   #cke_1_contents {
   height: 200px !important;
   }
   .hidden {
   display:none;
   }
</style>
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
                  <div class="d-flex align-items-center mb-3">
                     <div class="v-main-heading h3">Support Tickets</div>
                  </div>
                  <div class="row">
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
               </div>
               <!-- /.container-fluid --><br>
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active show" id="tab1warning">
                                 <div class="table-responsive-xl">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">
                                                Ticket ID
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                             </th>
                                             <th scope="col">MemberID</th>
                                             <th scope="col">Service Type</th>
                                             <th scope="col">Priority</th>
                                             <th scope="col">
                                                Department
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                             </th>
                                             <th scope="col">Subject</th>
                                             <th scope="col">
                                                Date
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                             </th>
                                             <th scope="col">Status</th>
                                             <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color">TKT0001</td>
                                             <td class="theme-color">A60003</td>
                                             <td class="theme-color">A60003</td>
                                             <td class="theme-color">Urgent</td>
                                             <td class="theme-color">Photo Verification</td>
                                             <td class="theme-color">This is a sample subject</td>
                                             <td class="theme-color">12/31/2022</td>
                                             <td class="">
                                                <div id="support-ticket">
                                                   <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Resolved
                                                       <span class="caret"></span>
                                                   </button>
                                                   <ul class="dropdown-menu p-3 border-0" style="">
                                                      <li><a href="#">Waiting for Support</a></li>
                                                      <li><a href="#">Waiting for Support</a></li>
                                                   </ul>
                                                </div>
                                             </td>
                                             <td class="theme-color">
                                                <div class="dropdown no-arrow">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#replyticket">Reply<i class="fa fa-fw fa-pen"style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">View Tickets<i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color">TKT0001</td>
                                             <td class="theme-color">A60003</td>
                                             <td class="theme-color">A60003</td>
                                             <td class="theme-color">Urgent</td>
                                             <td class="theme-color">Photo Verification</td>
                                             <td class="theme-color">This is a sample subject</td>
                                             <td class="theme-color">12/31/2022</td>
                                             <td class="theme-color">
                                                <div id="support-ticket" class="dropdown">
                                                   <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Resolved<span class="caret"></span></button>
                                                   <ul class="dropdown-menu p-3 border-0" style="">
                                                      <li><a href="#">Waiting for Support</a></li>
                                                   </ul>
                                                </div>
                                             </td>
                                             <td class="theme-color">
                                                <div class="dropdown no-arrow">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#replyticket">Reply<i class="fa fa-fw fa-pen"style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">View Tickets<i class="fa fa-fw fa-trash" style="float: right;"></i></a>
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
<div class="modal fade upload-modal" id="replyticket" tabindex="-1" role="dialog" aria-labelledby="replyticket" aria-hidden="true">
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
                  <div class="col-12 mb-3 basic-font">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2">
                              <div class="hp m-0">Status:<span class="theme-text-color ml-2">Waiting for Support</span></div>
                           </div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="ml-2">
                                 <div class="hp m-0">Date:<span class="ml-2">01/02/22</span></div>
                              </div>
                              <div class="ml-4">
                                 <div class="hp m-0">Time:<span class="ml-2">5:02 PM</span></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center pt-2 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2 mr-2">
                              <div class="hp m-0">From: </div>
                           </div>
                           <div class=" ">
                              <img class="rounded-circle" width="30" src="http://localhost/e4u/public/assets/app/img/profile-img.png" alt="">
                           </div>
                           <div class="ml-2">
                              <div class="hp m-0"><span>A60003</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">Department: <span class="ml-2">Photo Verification</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">Service Type:<span class="ml-2">Alert Notification</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">Priority:<span class="ml-2">High</span></div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2 mr-2">
                              <div class="hp m-0">
                                 <p>Subject:</p>
                              </div>
                           </div>
                           <div class="ml-1">
                              <div class="hp m-0 font-weight-normal">
                                 <p>New local updates</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group pt-2">
                        <textarea cols="30" rows="5" class="form-control rounded-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </textarea>
                     </div>
                     <div class="d-flex justify-content-between align-items-center attached-files">
                        <div class="ml-2">
                           <div class="hp m-0">uploadedfile.docs</div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <ul class="list-inline m-0">
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-eye text-white" aria-hidden="true"></i>
                                 </li>
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-download text-white" aria-hidden="true"></i>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center attached-files mt-2">
                        <div class="ml-2">
                           <div class="hp m-0">uploadedfile.docs</div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <ul class="list-inline m-0">
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-eye text-white" aria-hidden="true"></i>
                                 </li>
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-download text-white" aria-hidden="true"></i>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <div id="myContent" class='hidden'>
               <hr>
               <div class="row">
                  <div class="col-12 mb-3 basic-font">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2">
                              <div class="hp m-0">You:</div>
                           </div>
                           <div class="ml-2">
                              <img class="rounded-circle" width="30" src="http://localhost/e4u/public/assets/app/img/profile-img.png" alt="">
                           </div>
                           <div class="hp m-0 ml-2"><span>E4U Support agent</span></div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="ml-2">
                                 <div class="hp m-0">Date:<span class="ml-2">01/02/22</span></div>
                              </div>
                              <div class="ml-4">
                                 <div class="hp m-0">Time:<span class="ml-2">5:02 PM</span></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group pt-2 pb-2">
                        <textarea class="form-control rounded-0" id="editor1" name="editor1" placeholder="Message" cols="30" rows="5"></textarea>
                     </div>
                     <button type="button" class="btn btn-primary float-right">Send</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer pr-3 pt-0">
            <button id="hide-btn" onclick="toggler()" type="button" class="btn btn-primary"><img src="{{ asset('assets/app/img/repeat.png')}}" class="img-profile pr-2">Reply</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="viewticket" tabindex="-1" role="dialog" aria-labelledby="viewticket" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1100px !important;">
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
                  <div class="col-12 mb-3 basic-font">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2">
                              <div class="hp m-0">Status:<span class="theme-text-color ml-2">Waiting for Support</span></div>
                           </div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="ml-2">
                                 <div class="hp m-0">Date:<span class="ml-2">01/02/22</span></div>
                              </div>
                              <div class="ml-4">
                                 <div class="hp m-0">Time:<span class="ml-2">5:02 PM</span></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center pt-2 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2 mr-2">
                              <div class="hp m-0">From: </div>
                           </div>
                           <div class=" ">
                              <img class="rounded-circle" width="30" src="http://localhost/e4u/public/assets/app/img/profile-img.png" alt="">
                           </div>
                           <div class="ml-2">
                              <div class="hp m-0"><span>A60003</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">Department: <span class="ml-2">Photo Verification</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">Service Type:<span class="ml-2">Alert Notification</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">Priority:<span class="ml-2">High</span></div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2 mr-2">
                              <div class="hp m-0">
                                 <p>Subject:</p>
                              </div>
                           </div>
                           <div class="ml-1">
                              <div class="hp m-0 font-weight-normal">
                                 <p>New local updates</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group pt-2">
                        <textarea cols="30" rows="5" class="form-control rounded-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </textarea>
                     </div>
                     <div class="d-flex justify-content-between align-items-center attached-files">
                        <div class="ml-2">
                           <div class="hp m-0">uploadedfile.docs</div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <ul class="list-inline m-0">
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-eye text-white" aria-hidden="true"></i>
                                 </li>
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-download text-white" aria-hidden="true"></i>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center attached-files mt-2">
                        <div class="ml-2">
                           <div class="hp m-0">uploadedfile.docs</div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <ul class="list-inline m-0">
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-eye text-white" aria-hidden="true"></i>
                                 </li>
                                 <li class="list-inline-item mb-0">
                                    <i class="fa fa-download text-white" aria-hidden="true"></i>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
<div class="justify-content-between align-items-center mt-5">
<div id="accordion">
      <div class="card border-right-0 border-left-0 border-bottom-0 rounded-0 background-white">
         <div class="card-header pl-0 pr-0 bg-white" id="headingOne">
            <h5 class="mb-0">
               <div class="row">
                  <div class="col-12 basic-font">
                     <div data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="d-flex justify-content-between align-items-center collapsed">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2">
                              <div class="hp m-0">You:</div>
                           </div>
                           <div class="ml-2">
                              <img class="rounded-circle" width="30" src="http://localhost/e4u/public/assets/app/img/profile-img.png" alt="">
                           </div>
                           <div class="hp m-0 ml-2"><span>E4U Support agent</span></div>
                        </div>
                        <div>
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="ml-2">
                                 <div class="hp m-0">Date:<span class="ml-2">01/02/22</span></div>
                              </div>
                              <div class="ml-4">
                                 <div class="hp m-0">Time:<span class="ml-2">5:02 PM</span></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </h5>
         </div>
         <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
            <div class="card-body pl-0 pr-0">
               <textarea cols="30" rows="5" class="form-control rounded-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </textarea>
            </div>
         </div>
      </div>
      <div class="card border-right-0 border-left-0 background-white rounded-0">
         <div class="card-header pl-0 pr-0 bg-white" id="headingTwo">
            <div class="row">
               <div class="col-12 basic-font">
                  <div data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne" class="d-flex justify-content-between align-items-center collapsed">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="ml-2">
                           <div class="hp m-0">You:</div>
                        </div>
                        <div class="ml-2">
                           <img class="rounded-circle" width="30" src="http://localhost/e4u/public/assets/app/img/profile-img.png" alt="">
                        </div>
                        <div class="hp m-0 ml-2"><span>E4U Support agent</span></div>
                     </div>
                     <div>
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="ml-2">
                              <div class="hp m-0">Date:<span class="ml-2">01/02/22</span></div>
                           </div>
                           <div class="ml-4">
                              <div class="hp m-0">Time:<span class="ml-2">5:02 PM</span></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="">
            <div class="card-body pl-0 pr-0">
               <textarea cols="30" rows="5" class="form-control rounded-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </textarea>
            </div>
         </div>
      </div>
   </div>
</div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pr-3 pt-0">
         </div>
      </div>
   </div>
</div>
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
<script type="text/javascript">
   function toggler() {
      $("#myContent").slideToggle();
      $("#hide-btn").hide();
   }
</script>
@endsection
