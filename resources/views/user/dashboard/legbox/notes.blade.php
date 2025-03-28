@extends('layouts.userDashboard')
@section('style')
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
      <div class="container-fluid">
         <!--middle content-->
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9 ">
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding: 0px 0px;">
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <h2 class="h4 mb-0 text-gray-800 font-weight-500">My Legbox</h2>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive list-sec" id="sailorTableArea">
                           <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                              <div class="dataTables_length" id="myTable_length">
                                 <label>
                                    Show 
                                    <select name="myTable_length" aria-controls="myTable" class="">
                                       <option value="10">10</option>
                                       <option value="25">25</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                    </select>
                                    entries
                                 </label>
                              </div>
                              <div id="myTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="myTable"></label></div>
                              <div id="myTable_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                              <table id="myTable" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                 <thead>
                                    <tr role="row">
                                       <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                          : activate to sort column descending" style="width: 21px;">
                                          <div class="ckbox">
                                             <input type="checkbox" id="checkbox1">
                                          </div>
                                       </th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 154px;" aria-label="Name">
                                          Name
                                          <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 20px;">
                                             <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                          </svg>
                                       </th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 112px;" aria-label="Date Created">Location</th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 149px;" aria-label="Subscription Type">Type </th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 161px;" aria-label="Subscription Status">Mobile</th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 79px;" aria-label="Status">Email</th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 56px;" aria-label="Action">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr role="row" class="odd">
                                       <td class="sorting_1">1</td>
                                       <td>Kathryn Murphy</td>
                                       <td>SA</td>
                                       <td>Female</td>
                                       <td>09818 22 2222</td>
                                       <td>test@gmail.com</td>
                                       <td>
                                          <div class="dropdown no-arrow archive-dropdown">
                                             <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                <a class="dropdown-item" href="#" data-id="27" data-name="test one" data-category="27">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a>
                                                <a class="dropdown-item delete-center" href="#" data-id="27">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <div class="dataTables_info" id="myTable_info" role="status" aria-live="polite">Showing 1 to 8 of 8 entries</div>
                              <div class="dataTables_paginate paging_simple_numbers" id="myTable_paginate"><a class="paginate_button previous disabled" aria-controls="myTable" data-dt-idx="0" tabindex="0" id="myTable_previous">Previous</a><span><a class="paginate_button current" aria-controls="myTable" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="myTable" data-dt-idx="2" tabindex="0" id="myTable_next">Next</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid --><br>
            </div>
            <!--middle content end here-->
            <!--right side bar start from here-->
            <div class="col-sm-12 col-md-12 col-lg-3 ">
               <div class="sidebar-box-administrator">
                  <h2 class="h4 mb-0 text-gray-800">Favorites online</h2>
                  <table class="sidebar-table">
                     <tr>
                        <td class="leftside-table">Server Time:</td>
                        <td class="rightside-table">05:22</td>
                     </tr>
                     <tr>
                        <td class="leftside-table">Up Time:</td>
                        <td class="rightside-table">25 Days | 23hrs</td>
                     </tr>
                     <tr>
                        <td class="leftside-table">Average Load:</td>
                        <td class="rightside-table">85.9</td>
                     </tr>
                  </table>
               </div>
               <div class="sidebar-box-administrator">
                  <h2 class="h4 mb-0 text-gray-800">My Statistics</h2>
                  <table class="sidebar-table">
                     <tr>
                        <td class="leftside-table">Staff</td>
                        <td class="rightside-table">01</td>
                     </tr>
                     <tr>
                        <td class="leftside-table">Viewer</td>
                        <td class="rightside-table">01</td>
                     </tr>
                     <tr>
                        <td class="leftside-table">Agent</td>
                        <td class="rightside-table">01</td>
                     </tr>
                     <tr>
                        <td class="leftside-table">Advertiser</td>
                        <td class="rightside-table">01</td>
                     </tr>
                  </table>
               </div>
            </div>
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
@endsection