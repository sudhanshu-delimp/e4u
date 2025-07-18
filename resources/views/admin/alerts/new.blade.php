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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row">
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1"> Alerts  </h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b> </h3>
               <ol class="level-1">
                  <li>You can create an Alert, published in the Footer, for:</li>
                     <ol class="level-2 ">
                        <li>New features launched in the Website</li>
                        <li>Scammer Alerts; and</li>
                        <li>Website updates</li>
                     </ol>
                  <li>Public notices are published on the Home page.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 ">            
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
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end"style="gap: 50px;">
               <div class="bothsearch-form" style="gap: 10px;">
                  <button type="button" class="btn btn-primary create-tour-sec dctour " style="color: var(--peach);" data-toggle="modal" data-target="#Create_Notice">New Notice</button>
               </div>
               <div class="bothsearch-form" style="gap: 10px;">
                  <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" style="color: var(--peach);" data-target="#Create_Alert">New Alert</button>
               </div>
            </div>
         </div>
         <div class="table-responsive">
            <table class="table">
               <thead class="table-bg">
                  <tr>
                     <th scope="col">
                     Ref
                        
                     </th>
                     <th scope="col">
                     Date Publised 
                        
                     </th>
                     <th scope="col">
                     type 
                        
                     </th>
                     <th scope="col">
                        Status
                     </th>
                     <th scope="col">Action</th>
                  </tr>
               </thead>
               <tbody class="table-content">
                  <tr class="row-color">
                     <td width="10%" class="theme-color">REF1001010</td>
                     <td class="theme-color">12/31/2022</td>
                     <td class="theme-color">New Frature</td>
                     <td class="theme-color">Published</td>
                     <td>
                        <div class="dropdown no-arrow ml-3">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" > <i class="fa fa-check"></i> Published </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#">  <i class="fa fa-times"></i> Withdrawn </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-eye"></i> view  </a>
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
{{-- end --}}
<div class="modal fade upload-modal" id="Create_Notice" tabindex="-1" role="dialog" aria-labelledby="Create_AlertLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
   <div class="modal-header">
      <h5 class="modal-title" id="Create_Notice"><img src="{{ asset('assets/app/img/alert.png')}}" alt="alert"> New Notice
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
      <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-12 mb-3 d-flex justify-content-start align-items-center">
                     <h6 class="mb-1">Motion : </h6>
                    <div class="pl-3">
                    <input type="radio" name="motion" id="motion"><lable name="motion"> Static</lable>
                    <input type="radio" name="motion" id="motion"><lable name="motion"> Scrolling</lable>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                     <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="up to 200 characters" rows="3"></textarea>
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
            <!-- <button type="button" class="btn btn-primary">Save as Draft</button> -->
            <button type="button" class="btn btn-primary">Publish</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="Create_Alert" tabindex="-1" role="dialog" aria-labelledby="Create_AlertLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
   <div class="modal-header">
      <h5 class="modal-title" id="Create_Alert"><img src="{{ asset('assets/app/img/alert.png')}}" alt="alert"> New Alert
      </h5>
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
                     <input type="text" class="form-control rounded-0" placeholder="Subject ">
                  </div>
                  <div class="col-12 mb-3">
                     <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="up to 500 characters" rows="3"></textarea>
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
            <!-- <button type="button" class="btn btn-primary">Save as Draft</button> -->
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