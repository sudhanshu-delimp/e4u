@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid">
         <!--middle content-->
         <div class="row">
            <div class="col-md-12">
               <div class="v-main-heading h3">Punterbox Report</div>
            </div>
            <div class="col-md-9 mt-4">
               <div class="row">
                  <div class="col-md-8 mb-2">
                     <div class="card">
                        <div class="card-body">
                           <p><b>Notes:</b> </p>
                           <ul style="list-style: auto;">
                              <li>This report is a consolidation of Viewer reports on Advertisers.</li>
                              <li>To action a Viewer report, the Viewer’s consent must be first obtained.</li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row pt-3 pb-3">
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
               <div class="row">
                  <div class="col-md-7">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active show" id="tab1warning">
                                 <div class="table-responsive-xl">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col"> </th>
                                             <th scope="col"> </th>
                                             <th style="text-align: center;font-size: 16px;" scope="col">Viewer</th>
                                             <th scope="col"> </th>
                                             <th scope="col"> </th>
                                          </tr>
                                       </thead>
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Ref</th>
                                             <th scope="col">Member ID</th>
                                             <th scope="col">Location</th>
                                             <th scope="col">Date</th>
                                             <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color"><b>123</b></td>
                                             <td class="theme-color">V60012 </td>
                                             <td class="theme-color">WA</td>
                                             <td class="theme-color">12/31/2022</td>
                                             <td class="theme-color">
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab2warning">Mobile Sim Request</div>
                              <div class="tab-pane fade" id="tab3warning">
                                 <div class="table-responsive-xl">Product Request</div>
                              </div>
                              <div class="tab-pane fade" id="tab4warning">
                                 <div class="table-responsive-xl">
                                    Login Attemps
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5 pl-0">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active show" id="tab1warning">
                                 <div class="table-responsive-xl">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col"> </th>
                                             <th style="text-align: center;font-size: 16px;" scope="col">Advertiser</th>
                                             <th scope="col"> </th>
                                          </tr>
                                       </thead>
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Member ID</th>
                                             <th scope="col">Home State</th>
                                             <th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color">V60012 </td>
                                             <td class="theme-color">WA</td>
                                             <td class="theme-color">
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="tab2warning">Mobile Sim Request</div>
                              <div class="tab-pane fade" id="tab3warning">
                                 <div class="table-responsive-xl">Product Request</div>
                              </div>
                              <div class="tab-pane fade" id="tab4warning">
                                 <div class="table-responsive-xl">
                                    Login Attemps
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
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
@endsection