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
         <h1 class="h1"> Alerts</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b> </h3>
               <ol class="level-1">
                  <li>You can create an Alert, published in the Footer, for:</li>
                     <ol class="level-2 ">
                        <li>Employment, and adjust lettering accordingly.</li>
                        <li>New features launched in the Website.</li>
                        <li>Scammer Alerts; and</li>
                        <li>Website updates.</li>
                     </ol>
                  <li>Public notices are published on the Home page.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 "> 
         <div class="d-flex justify-content-end gap-20 my-3">
               <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#Create_Notice">New Notice</button>
               <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#Create_Alert">New Alert</button>
         </div>
         <div class="table-responsive">
            <table class="table" id="AlertTable">
               <thead class="table-bg">
                  <tr>
                     <th scope="col">
                     Ref
                        
                     </th>
                     <th scope="col">
                     Date Publised 
                        
                     </th>
                     <th scope="col">
                     Type 
                        
                     </th>
                     <th scope="col">
                        Status
                     </th>
                     <th scope="col" class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody class="table-content">
                  <tr class="row-color">
                     <td width="10%" class="theme-color">REF1001010</td>
                     <td class="theme-color">12-31-2022</td>
                     <td class="theme-color">New Frature</td>
                     <td class="theme-color">Published</td>
                     <td class="text-center">
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
         </div>                              
      </div>
   </div>
</div>
{{-- end --}}
<div class="modal fade upload-modal" id="Create_Notice" tabindex="-1" role="dialog" aria-labelledby="Create_AlertLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
   <div class="modal-header">
      <h5 class="modal-title" id="Create_Notice"><img src="{{ asset('assets/dashboard/img/new-notice.png')}}" alt="alert" class="custompopicon"> New Notice
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
      <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-12 mb-3 d-flex justify-content-start align-items-center">
                     <label class="mb-1 label">Motion : </label>
                    <div class="pl-3">
                    <input type="radio" name="motion" id="motion"><lable name="motion"> Static</lable>
                    <input type="radio" name="motion" id="motion"><lable name="motion"> Scrolling</lable>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                     <label for="Descrioption" class="label">Descrioption</label>
                     <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="up to 200 characters" rows="3"></textarea>
                  </div>
                  <div class="col-12">
                     <div class="form-group mb-0">
                        <label class="form-check-label pr-4" for="exampleCheck1">Date: <span class="ml-1">12-31-2022</span></label>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pb-4 mb-2">
            <button type="button" class="btn-success-modal">Publish</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="Create_Alert" tabindex="-1" role="dialog" aria-labelledby="Create_AlertLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content basic-modal">
   <div class="modal-header">
      <h5 class="modal-title" id="Create_Alert"><img src="{{ asset('assets/app/img/alert.png')}}" alt="alert" class="custompopicon"> New Alert
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
      </button>
   </div>
      <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-12 mb-3">
                     <label for="Alert Type" class="label">Select Alert Type</label>
                     <select class="form-control rounded-0">
                        <option class="text-secondary">Select Alert Type</option>
                        <option class="text-secondary">Employment</option>
                        <option class="text-secondary">New Features</option>
                        <option class="text-secondary">Scammer Alerts</option>
                        <option class="text-secondary">Website Updates</option>
                     </select>
                  </div>
                  <div class="col-12 mb-3">
                     <label for="Subject" class="label">Subject</label>
                     <input type="text" class="form-control rounded-0" placeholder="Subject ">
                  </div>
                  <div class="col-12 mb-3">
                     <label for="Descrioption" class="label">Descrioption</label>
                     <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="up to 500 characters" rows="3"></textarea>
                  </div>
                  <div class="col-12 mb-3">
                     <label for="Message" class="label">Message</label>
                     <textarea class="form-control rounded-0" id="editor1" name="editor1" placeholder="Message" rows="1" cols="1"></textarea>
                  </div>
                  <div class="col-12">
                     <div class="form-group mb-0">
                        <label class="form-check-label pr-4" for="exampleCheck1">Date: <span class="ml-1">12-31-2022</span></label>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pb-4 mb-2">
            <button type="button" class="btn-success-modal">Publish</button>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script') 

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#AlertTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Ref No..."
      },
      info: true,
      paging: true,
      lengthChange: true,
      searching: true,
      bStateSave: true,
      order: [[1, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10
   });

 </script>
@endpush