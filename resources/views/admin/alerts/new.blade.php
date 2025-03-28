@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
   #cke_1_contents {
    height: 150px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
   <!--middle content-->
   <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 ">
         <!-- Begin Page Content -->
         <div class="container-fluid" style="padding: 0px 0px;">
            <!-- Page Heading -->
            <div class="d-flex align-items-center mb-3">
               <div class="v-main-heading h3">Alerts</div>
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
                     <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#Create_Alert">Create New Alert</button>
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
                                       <th scope="col">
                                          Alert Type 
                                          <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                          </svg>
                                       </th>
                                       <th scope="col">Title</th>
                                       <th scope="col">
                                          Content 
                                          <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                          </svg>
                                       </th>
                                       <th scope="col">
                                          Notes
                                       </th>
                                       <th scope="col">
                                          Date Publised 
                                          <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                          </svg>
                                       </th>
                                       <th scope="col">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                    <tr class="row-color">
                                       <td width="10%" class="theme-color">New Feature</td>
                                       <td width="20%" class="theme-color">This is a new feature to be apply</td>
                                       <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis  aliquam malesuada bibendum arcu.</td>
                                       <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </td>
                                       <td class="theme-color" width="15%">12/31/2022</td>
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
                                       <td width="10%" class="theme-color">New Feature</td>
                                       <td width="20%" class="theme-color">This is a new feature to be apply</td>
                                       <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis  aliquam malesuada bibendum arcu.</td>
                                       <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </td>
                                       <td class="theme-color" width="15%">12/31/2022</td>
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
                                       <td width="10%" class="theme-color">New Feature</td>
                                       <td width="20%" class="theme-color">This is a new feature to be apply</td>
                                       <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis  aliquam malesuada bibendum arcu.</td>
                                       <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </td>
                                       <td class="theme-color" width="15%">12/31/2022</td>
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
                           Revenue
                        </div>
                        <div class="tab-pane fade" id="tab3warning">
                           <div class="table-responsive-xl">
                              Sales
                           </div>
                        </div>
                        <div class="tab-pane fade" id="tab4warning">
                           <div class="table-responsive-xl">
                              Advertiser Credit
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

<div class="modal fade upload-modal" id="Create_Alert" tabindex="-1" role="dialog" aria-labelledby="Create_AlertLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
   <div class="modal-header">
      <h5 class="modal-title" id="Create_Alert">Create Alert</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
<div class="modal-body pb-0">
      <form>
         <div class="row">
            <div class="col-12 mb-3">
               <select class="form-control rounded-0">
                  <option class="text-secondary">Select Alert Type</option>
                  <option class="text-secondary">New Features</option>
                  <option class="text-secondary">Scammer Alerts</option>
                  <option class="text-secondary">Website Updates</option>
               </select>
            </div>
            <div class="col-12 mb-3">
               <input type="text" class="form-control rounded-0" placeholder="Title">
            </div>
            <div class="col-12 mb-3">
               <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Notes" rows="3"></textarea>
            </div>
            <div class="col-12 mb-3">
               <textarea class="form-control rounded-0" id="editor1" name="editor1" placeholder="Message" rows="1" cols="1"></textarea>
            </div>
            <div class="col-12">
               <div class="form-group mb-0">
                  <label class="form-check-label pr-4" for="exampleCheck1">Date:<span class="ml-1" style="font-weight: 300;">12/31/2022</span></label>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="modal-footer pb-4 mb-2">
      <button type="button" class="btn btn-primary">Save as Draft</button>
      <button type="button" class="btn btn-primary">Publish</button>
   </div>
</div>
   </div>
</div>

<div class="modal fade upload-modal" id="Edit_Competitor" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
   <div class="modal-header">
      <h5 class="modal-title" id="Edit_Competitor">Create Alert</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
<div class="modal-body pb-0">
      <form>
         <div class="row">
            <div class="col-12 mb-3">
               <select class="form-control rounded-0">
                  <option>Select Alert Type</option>
               </select>
            </div>
            <div class="col-12 mb-3">
               <input type="text" class="form-control rounded-0" placeholder="Title">
            </div>
            <div class="col-12 mb-3">
               <textarea class="form-control" id="editor1" name="editor1" placeholder="Notes" rows="3"></textarea>
            </div>
            <div class="col-12 mb-3">
               <textarea class="form-control rounded-0" id="editor1" name="editor1" placeholder="Message" rows="4" cols="4"></textarea>
            </div>
            <div class="col-12">
               <div class="form-group mb-0">
                  <label class="form-check-label pr-4" for="exampleCheck1">Date:<span class="ml-1" style="font-weight: 300;">12/31/2022</span></label>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="modal-footer pb-4 mb-2">
      <button type="button" class="btn btn-primary">Save as Draft</button>
      <button type="button" class="btn btn-primary">Publish</button>
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
@endsection
@push('script')
@endpush