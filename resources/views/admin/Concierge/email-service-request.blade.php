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
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Email Requests</h1>
                  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                        <li>An email request is to be actioned within 24 hours of receipt.</li>
                        <li>An email notification has also been sent to <a href="mailto:admin@e4u.com.au">admin@e4u.com.au</a>.</li>
                        <li>When establishing the Email account, ensure:
                           <ol class="level-2">
                              <li>The Member and Email details are entered in the Email Register before completing this page.</li>
                              <li>Activate account.</li>
                           </ol>
                        </li>
                        </ol>
                     </div>
               </div>
            </div>
         </div>   
         <div class="row mb-3">
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
            <div class="col-md-12">
               <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                     <thead class="table-bg">
                        <tr>
                           <th>Ref</th>
                           <th>Member ID</th>
                           <th>Member</th>
                           <th>Order Date</th>
                           <th>Notification Address</th>
                           <th>Order Number</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody class="table-content">
                        <tr>
                           <td>125</td>
                           <td>E40161</td>
                           <td>Julie</td>
                           <td>04-05-2025</td>
                           <td><a href="mailto:julie.1996@gmail.com">julie.1996@gmail.com</a></td>
                           <td>E40161 04052025 04 003</td>
                           <td><span class="badge badge-warning">Pending</span></td>
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
                        <tr>
                           <td>124</td>
                           <td>E50167</td>
                           <td>Mary</td>
                           <td>03-05-2025</td>
                           <td><a href="mailto:mary.1995@gmail.com">mary.1995@gmail.com</a></td>
                           <td>E50167 03052025 05 002</td>
                           <td><span class="badge badge-secondary">On Hold</span></td>
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
                        <tr>
                           <td>123</td>
                           <td>E60112</td>
                           <td>Jane</td>
                           <td>02-05-2025</td>
                           <td><a href="mailto:jane.1999@gmail.com">jane.1999@gmail.com</a></td>
                           <td>E60112 02052025 06 001</td>
                           <td><span class="badge badge-success">Active</span></td>
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
               </div>   
            </div>   
         </div>                 
      </div>
   </div>
   <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection