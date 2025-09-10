@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
}

.modalPopup>.item4 {
    cursor: pointer;
}

.modalPopup>.item2 {
    cursor: pointer;
}

.ui-draggable-dragging {
    width: 82px !important;
    height: 82px !important;
    opacity: 0.8;
}

.draggable {
    filter: alpha(opacity=60);
    opacity: 0.6;
}

.dropped {
    position: static !important;
}

.pis {
    display: none;
}

.newbtn {
    cursor: pointer;
}

.grid-container>div {
    background-color: rgba(255, 255, 255, 0.8);
}

.item1 {
    grid-column: 3 / span 3;
}

.item4 {
    width: 100%;
    object-fit: cover;
}

img.img-thumbnail.defult-image {
    width: 190px;
    height: 135px;
    object-fit: cover;
}

img.img-thumbnail.defult-image-3 {
    width: 585px;
    height: 202px;
    object-fit: cover;
    position: absolute;
}

img#blah8 {
    width: 425px !important;
}

.leftLst.over {
    pointer-events: none;
}

.item4 .fa-trash {
    position: absolute;
    right: 10px;
    top: 10px;
    color: #e73b3b;
    display: none;
}

.item4:hover .fa-trash {
    display: block;
}

.item4 {
    position: relative;
}

.item2 {
    height: 100% !important;
    width: 100%;
}

.item2 img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover;
}

textarea {
    resize: none;
}

#count_message {
    background-color: smoke;
    margin-top: -20px;
    margin-right: 5px;
}

.fill_profile_headings_global {
    border-bottom: 1px solid #0c223d;
}

.upld-img {
    height: 82px !important;
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    /* default 5 columns */
    gap: 10px;
}

@media (min-width:600px) and (max-width: 1024px) {
    .grid-container {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 600px) {
    .grid-container {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">    
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Media</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol>
                           <li>Use these help pages for explanations and guidance on managing all of your Masseur
                              Photos.</li>
                           <li>You can upload four photos for each Masseur. Designate one as the Masseur’s
                              Thumbnail.</li>
                           <li>Activate up to eight Masseur Profiles at any one time to appear the Massage Centre
                              Profile.</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         
         {{-- media --}}
         <div class="row">
            <div class="col-md-12 my-3 d-flex justify-content-end">
                <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Photos</button>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="upload-banner p-0">
                <div class="photo-top-header">                    
                    <div class="custom-img-filter-header border-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="gallery-head">Your Default Images</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-lg-4 col-sm-12">
                        <h2 class="banner-sub-heading my-2">Thumbnail</h2>
                        <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photoGallery">
                            <img class="img-fluid" id="img1" src="{{ asset('assets/app/img/upload-thum-1.png')}}" style="object-fit: cover;width: 167px;height: 172px;">
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="row" style="">
                            <div class="col-lg-12">                                            
                            <h2 class="banner-sub-heading my-2">Gallery Images</h2>
                        </div>
                            <div class="col-lg-4 col-sm-6">
                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photoGallery">
                                <img class="img-fluid upld-img" id="img2"src="{{ asset('assets/app/img/frame-main-thum.png')}}">
                                </label>
                            </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photoGallery">
                                <img class="img-fluid upld-img"  id="img3"src="{{ asset('assets/app/img/frame-main-thum.png')}}">
                                </label>
                            </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#photoGallery">
                                <img class="img-fluid upld-img"  id="img4"src="{{ asset('assets/app/img/frame-main-thum.png')}}">
                                </label>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="photo-top-header">
                <div class="photo-top-header">
                    <div class="photo-header custom-photo-header">
                        <div class="modal-header border-0 p-0" style="display: block;position: relative;top: 30%;">
                            <div class="row">
                                <div class="col-md-8">
                                    <ul class="nav nav-tabs border-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="menu_all" data-toggle="tab" href="#home">All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="menu_varified" data-toggle="tab" href="#menu1">Verified</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="menu_unverified" data-toggle="tab" href="#menu2">Unverified</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 pt-1">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="16.16" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div style="display: flex;gap: 15px;">
                                        <p>6/6</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="archive-photo-sec">
                <div class="row">
                    <div class="col-md-12">
                        <div class="grid-container p-2" id="dvSource">                                                                                                                        
                            <div class="item4 pt-1" id="dm_760">
                            <img class="img-thumbnail defult-image ui-draggable" src="{{ asset('assets/app/img/banner/mcc1.jpg')}}" alt=" " data-id="760" data-position="9">
                            <i class="fa fa-trash deleteimg" data-id="760" title="Remove this media"></i>                                        
                                <span class="badge badge-red">Gallery</span>
                            </div>
                            <div class="item4 pt-1" id="dm_760">
                            <img class="img-thumbnail defult-image ui-draggable" src="{{ asset('assets/app/img/banner/mcc2.jpg')}}" alt=" " data-id="760" data-position="9">
                            <i class="fa fa-trash deleteimg" data-id="760" title="Remove this media"></i>                                        
                                <span class="badge badge-red">Gallery</span>
                            </div>
                            <div class="item4 pt-1" id="dm_760">
                            <img class="img-thumbnail defult-image ui-draggable" src="{{ asset('assets/app/img/banner/mcc3.jpg')}}" alt=" " data-id="760" data-position="9">
                            <i class="fa fa-trash deleteimg" data-id="760" title="Remove this media"></i>                                        
                                <span class="badge badge-red">Gallery</span>
                            </div>
                            <div class="item4 pt-1" id="dm_760">
                            <img class="img-thumbnail defult-image ui-draggable" src="{{ asset('assets/app/img/banner/mcc4.jpg')}}" alt=" " data-id="760" data-position="9">
                            <i class="fa fa-trash deleteimg" data-id="760" title="Remove this media"></i>                                        
                                <span class="badge badge-red">Gallery</span>
                            </div>
                            <div class="item4 pt-1" id="dm_760">
                            <img class="img-thumbnail defult-image ui-draggable" src="{{ asset('assets/app/img/banner/mcc5.jpg')}}" alt=" " data-id="760" data-position="9">
                            <i class="fa fa-trash deleteimg" data-id="760" title="Remove this media"></i>                                        
                                <span class="badge badge-red">Gallery</span>
                            </div>
                            <div class="item4 pt-1" id="dm_760">
                            <img class="img-thumbnail defult-image ui-draggable" src="{{ asset('assets/app/img/banner/mcc6.jpg')}}" alt=" " data-id="760" data-position="9">
                            <i class="fa fa-trash deleteimg" data-id="760" title="Remove this media"></i>                                        
                                <span class="badge badge-red">Gallery</span>
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



{{-- upload photo popup --}}

<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
       <div class="modal-content" style="width: 900px;position: absolute;">
           {{-- {{ route('escort.upload.gallery') }} --}}
           <form id="mulitiImage" method="POST" action="{{route('escort.upload.gallery')}}" enctype="multipart/form-data">
               @csrf
               <div class="modal-content border-0">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Upload Photos</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="container p-0">
                                   <div class="row p-0">
                                       <div class="col-12 p-0">
                                           <div class="photo-sec-popup custom-upload-photo"  id="image_preview">
                                               <a href="#">
                                                   <div class="five_column_content_top img-title-sec justify-content-between wish_span rm" style="z-index: 1;">
                                                     
                                                   </div>
                                                   <label class="newbtn rm">
                                                       <img id="blah" class="item" src="{{ asset('assets/app/img/upload-thum-1.png')}}">
                                                       
                                                       <input name="img[]" id="upload_file" class="pis" onchange="preview_image(this);" type="file" multiple accept="image/*">
                                                   </label>
                                                   <div style="margin-top: -34px;">
                                                   </div>
                                               </a>
                                           </div>
                                           
                                       </div>
                                   </div>
                                   <div class="row mt-4 pt-1" style="border: 1px dotted;">
                                       <div class="col-6 pt-4 pb-4">
                                           <h4>Verify these Photos</h4>

                                           <ul style="text-align: justify;">
                                             <li>Two (2) selfies with your User Name and Membership ID printed (can be handwritten) on a sheet of paper held up to the side of you and not obscuring any part of you</li>
                                             <li>A drivers licence which matches your User Name and Home State</li>
                                             <li>A passport which matches your User Name and Home State</li>
                                           </ul>
                                       </div>
                                       <div class="col-6">
                                           <div class="plate" style="position: relative;top: 30%;"><label class="newbtn">
                                               <img class="img-fluid" id="blah8" src="{{--- {{ asset($path->findByposition(auth()->user()->id,8)['path']) }} --}}" style="height: 138px;object-fit: cover;width: 370px;">
                                               <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readURL(this);" type="file">
                                               <input type="hidden" name="selected_files[]" value="8">
                                               </label>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn-success-modal">Verify Media</button>
                       <button type="submit" class="btn-success-modal">Upload</button>
                   </div>
               </div>
           </form>
       </div>
   </div>
</div>

{{-- end --}}


{{-- Select Photo popup --}}


<div class="modal fade upload-modal" id="photoGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content custome_modal_max_width">
           <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title" style="color: white;"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Select Photo</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
               </button>
           </div>
           <div class="modal-body">
               <div class="grid-container modalPopup" style="max-height: 500px; overflow-y:scroll;">
                   {{-- @foreach($media  as $keyId => $image)
                       @if(!in_array($image->position, [8, 9, 10])/*$image->position != 8*/)
                           <div class="item4">
                               <img class="img-thumbnail defult-image select_image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                           </div>
                       @endif
                   @endforeach --}}
               </div>
           </div>
       </div>
   </div>
</div>

{{-- end --}}
@endsection

@push('script')
<!-- file upload plugin start here -->



<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>


<script type="text/javascript">

@endpush