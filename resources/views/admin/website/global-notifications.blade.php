@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   #cke_1_contents {
   height: 150px !important;
   }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid">
         <div class="d-flex align-items-center mb-3">
            <div class="v-main-heading h3">Global Notification</div>
         </div>
         <div class="col-md-8 pl-0">
            <div class="row pb-3">
               <div class="col-lg-4 col-md-6 col-sm-6">
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
                     <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#new-ban">Create Notification</button>
                  </div>
               </div>
            </div>
         </div>
         <!--middle content-->
         <div class="row">
            <div class="col-md-8">
               <div class="panel with-nav-tabs panel-warning">
                  <div class="panel-body">
                     <div class="tab-content">
                        <div class="tab-pane fade in active show" id="tab1warning">
                           <div class="table-responsive-xl">
                              <table class="table">
                                 <thead class="table-bg">
                                    <tr>
                                       <th scope="col">Title
                                       </th>
                                       <th scope="col">Notes</th>
                                       <th scope="col">
                                          Date Created
                                          <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 5px;">
                                             <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                          </svg>
                                       </th>
                                       <th scope="col">Published Notification</th>
                                       <th scope="col">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                    <tr class="row-color">
                                       <td class="theme-color"><b>Maintenance</b></td>
                                       <td class="theme-color">We are currently under maintenance, <br>sorry for the inconvinience</td>
                                       <td class="theme-color">12/31/2022</td>
                                       <td class="theme-color">
                                          <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input" id="customSwitch_1">
                                             <label class="custom-control-label" for="customSwitch_1"></label>
                                          </div>
                                       </td>
                                       <td class="theme-color">
                                          <div class="dropdown no-arrow">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#">View <i class="fa fa-eye" style="float: right;"></i></a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new-ban">Edit<i class="fa fa-fw fa-pen" style="float: right;" data-toggle="modal" data-target="#new-ban"></i></a>
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
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
</div>
<div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban">Edit Alert</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-12 mb-3">
                     <input type="text" class="form-control rounded-0" placeholder="Title">
                  </div>
                  <div class="col-12 mb-3">
                     <textarea class="form-control" id="editor1" name="editor1" placeholder="Notes" rows="3"></textarea>
                  </div>
                  <div class="col-12 mb-3">
                     <div class="form-group">
                        <label class="form-check-label" for="exampleCheck1">Display Notification</label>
                        <input type="checkbox" class="form-check-input ml-2" id="exampleCheck1">
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pr-3">
            <div class="col-7 pl-0">
               <div class="form-group mb-0">
                  <label class="form-check-label pr-4" for="exampleCheck1">Date:<span class="ml-1" style="font-weight: 300;">12/31/2022</span></label>
               </div>
            </div>
            <button type="button" class="btn btn-primary">Save as Draft</button>
            <button type="button" class="btn btn-primary">Save</button>
         </div>
      </div>
   </div>
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
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
@endsection