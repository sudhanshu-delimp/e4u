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
#cke_2_contents {
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
         
             {{-- Page Heading   --}}
             <div class="row">
               <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                   <h1 class="h1">Email Management</h1>
                   <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
               </div>
               <div class="col-md-12 my-2">
                   <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                       <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                       <ol></ol>
                   </div>
                   </div>
               </div>
           </div>
           {{-- end --}}
         <div class="row mt-2">
            <div class="col-sm-12 col-md-12 col-lg-12 ">
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding: 0px 0px;">
                
                  <div class="row ml-1 mb-3">
                     <div class="panel-heading">
                        <ul class="nav nav-tabs tab-sec pb-2">
                           <li class="active"><a href="#tab1warning" data-toggle="tab" class="active">Inbox</a></li>
                           <li><a href="#tab2warning" data-toggle="tab" class="">Sent</a></li>
                           <li><a href="#tab3warning" data-toggle="tab" class="">Drafts</a></li>
                           <li><a href="#tab3warning" data-toggle="tab" class="">Trash</a></li>
                        </ul>
                     </div>
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
                     <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="bothsearch-form" style="gap: 10px;">
                           <span class="pt-2 mt-1" style="font-size: 14px;font-weight: 600;color: #5D6D7E;">1 - 50 of 17,377</span>
                           <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#Competitor">Create Note</button>
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
                              <div class="tab-pane fade in active show" id="tab1warning">
                                 <div class="table-responsive-xl">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col"><input type="checkbox"></th>
                                             <th scope="col">Name</th>
                                             <th scope="col">Subject</th>
                                             <th scope="col">Message</th>
                                             <th scope="col">Date</th>
                                             <th scope="col">Time</th>
                                             <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color"><input type="checkbox"></td>
                                             <td class="theme-color"><a href="#" data-toggle="modal" data-target="#New-Mail"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Kathy -Adelaide 1</a></td>
                                             <td class="theme-color">New local updates</td>
                                             <td class="theme-color w-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </td>
                                             <td class="theme-color">01/02/22</td>
                                             <td class="theme-color">5:02 PM</td>
                                             <td>
                                                <div class="dropdown no-arrow ml-3">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#replyticket">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr class="row-color">
                                             <td class="theme-color"><input type="checkbox"></td>
                                             <td class="theme-color"><a href="#"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Kathy -Adelaide 1</a></td>
                                             <td class="theme-color">New local updates</td>
                                             <td class="theme-color w-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </td>
                                             <td class="theme-color">01/02/22</td>
                                             <td class="theme-color">5:02 PM</td>
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
                                             <td class="theme-color"><input type="checkbox"></td>
                                             <td class="theme-color"><a href="#"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Kathy -Adelaide 1</a></td>
                                             <td class="theme-color">New local updates</td>
                                             <td class="theme-color w-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </td>
                                             <td class="theme-color">01/02/22</td>
                                             <td class="theme-color">5:02 PM</td>
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
                                             <td class="theme-color"><input type="checkbox"></td>
                                             <td class="theme-color"><a href="#"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Kathy -Adelaide 1</a></td>
                                             <td class="theme-color">New local updates</td>
                                             <td class="theme-color w-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </td>
                                             <td class="theme-color">01/02/22</td>
                                             <td class="theme-color">5:02 PM</td>
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
                                             <td class="theme-color"><input type="checkbox"></td>
                                             <td class="theme-color"><a href="#"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Kathy -Adelaide 1</a></td>
                                             <td class="theme-color">New local updates</td>
                                             <td class="theme-color w-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </td>
                                             <td class="theme-color">01/02/22</td>
                                             <td class="theme-color">5:02 PM</td>
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
                                             <td class="theme-color"><input type="checkbox"></td>
                                             <td class="theme-color"><a href="#"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Kathy -Adelaide 1</a></td>
                                             <td class="theme-color">New local updates</td>
                                             <td class="theme-color w-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </td>
                                             <td class="theme-color">01/02/22</td>
                                             <td class="theme-color">5:02 PM</td>
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
                                             <td class="theme-color"><input type="checkbox"></td>
                                             <td class="theme-color"><a href="#"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Kathy -Adelaide 1</a></td>
                                             <td class="theme-color">New local updates</td>
                                             <td class="theme-color w-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices in iaculis nunc sed augue lacus viverra. Placerat in egestas erat imperdiet sed euismod nisi porta. </td>
                                             <td class="theme-color">01/02/22</td>
                                             <td class="theme-color">5:02 PM</td>
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
                              <div class="tab-pane fade" id="tab2warning">
                                 Sent
                              </div>
                              <div class="tab-pane fade" id="tab3warning">
                                 <div class="table-responsive-xl">
                                    Drafts
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
<div class="modal fade upload-modal" id="Competitor" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Competitor">New Email</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">
                  <div class="col-12 mb-3">
                    <select class="form-control rounded-0 p-1">
                     <option>To</option>
                        <option disabled="">sample@email.com</option>
                        <option>sample@email.com</option>
                     </select>
                  </div>
                  <div class="col-12 mb-3">
                     <select class="form-control rounded-0 p-1">
                        <option>Cc</option>
                     </select>
                  </div>
                  <div class="col-12 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Subject">
                  </div>
                  <div class="col-12 mb-3">
                     <textarea class="form-control rounded-0" id="editor1" name="editor1" placeholder="Message" rows="5" cols="10"></textarea>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer p-0 pl-2 pb-4">
            <button type="button" class="btn btn-primary mr-3">Send</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="replyticket" tabindex="-1" role="dialog" aria-labelledby="replyticketLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="replyticket">Mail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <form>
               <div class="row">
                  <div class="col-12 mb-3 basic-font">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="ml-2">
                                 <div class="hp m-0">Date:<span class="ml-2">01/02/22</span></div>
                              </div>
                              <div class="ml-4">
                                 <div class="hp m-0">Time:<span class="ml-2">5:02 PM</span></div>
                              </div>
                        </div>
                        <div>
                           
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
                              <div class="hp m-0"><span>Wayne Primrose</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">CC: <span class="ml-2">sample@email.com</span> <span class="ml-2">sample@email.com</span></div>
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
            <div id="myContent1" class='hidden'>
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
                        <textarea class="form-control rounded-0" id="editor2" name="editor2" placeholder="Message" cols="30" rows="5"></textarea>
                     </div>
                     <button type="button" class="btn btn-primary float-right">Send</button>
                  </div>
               </div>
            </div>
         </div>
                  <div class="modal-footer pr-3 pt-0">
            <button id="hide-btn1" onclick="toggler()" type="button" class="btn btn-primary"><img src="{{ asset('assets/app/img/repeat.png')}}" class="img-profile pr-2">Reply</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="New-Mail" tabindex="-1" role="dialog" aria-labelledby="New-Mail" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="New-Mail">Mails</h5>
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
                                 <div class="hp m-0">Date:<span class="ml-2">01/02/22</span></div>
                              </div>
                              <div class="ml-4">
                                 <div class="hp m-0">Time:<span class="ml-2">5:02 PM</span></div>
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
                              <div class="hp m-0"><span>Wayne Primrose</span></div>
                           </div>
                           <div class="ml-5">
                              <div class="hp m-0">CC: <span class="ml-2">sample@email.com</span> <span class="ml-2">sample@email.com</span></div>
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
                              <img class="rounded-circle" width="30" src="{{ asset('assets/app/img/profile-img.png')}}" alt="">
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
                           <img class="rounded-circle" width="30" src="{{ asset('assets/app/img/profile-img.png')}}" alt="">
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
<script>
   CKEDITOR.replace('editor2', {
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
      $("#myContent1").slideToggle();
      $("#hide-btn1").hide();
   }
</script>
@endsection