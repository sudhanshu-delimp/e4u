@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
<link href="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.css') }} " rel="stylesheet" type="text/css" />
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
    .modalPopup > .item4 {
        cursor: pointer;
    }
    .modalPopup > .item2 {
        cursor: pointer;
    }
    .ui-draggable-dragging {
        width: 82px !important;
        height: 82px !important;
        opacity: 0.8;
    }
    .draggable
    {
    filter: alpha(opacity=60);
    opacity: 0.6;
    }
    .dropped
    {
    position: static !important;
    }
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
    .grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    gap: 10px;
    }
    .grid-container > div {
    background-color: rgba(255, 255, 255, 0.8);
    }
    .item1 {
    grid-column: 3 / span 3;
    }
    .item4{
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
    .item2{
        height: 100% !important;
        width: 100%;
    }
    .item2 img{
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
    }
    .modal-tab{
    display:grid; grid-template-columns: 1fr 1fr 1fr;
    }
    .my-custompop-tabs .nav-item{
        margin-bottom: 0px !important;
    }
    .my-custompop-tabs .nav-item .nav-link.active{
    color: #fff;
    }
    
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
      <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Photos</h1>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
        </div>
        <div class="col-md-12 mb-4">                    
            <div class="collapse" id="notes">
                <div class="card">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Upload your photos here (up to 30) and then select your default images including your Thumbnail, other photos (up to six portrait) and your Banner Image (landscape) (<b>Default Images</b>).</li>
                            <li>Your Default Images will always appear in the Profile Creator when you activate the Profile Creator (for a new Profile). If you change any of the Default Images in the Profile Creator, like when you are creating a second Profile for the same Location, you will be asked if you want to update your changes to the Default Images.</li>
                            <li>When uploading your Photos, make sure they comply with our <a href="/escort-dashboard/help" class="custom_links_design">Profile Image</a> guidelines, especially in terms of the pixilation and the size of the photo.</li>
                            <li>If you don't upload a Banner Image (which is located at the top of your Profile), you can select a template image from the list (<b>Template</b>).  There is a Template designed to represent each Location.  We encourage you to upload your own Banner.  Remember, it is a landscape image and you can include a montage.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3 d-flex justify-content-end">
            <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Photos</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="upload-photo-sec">
                <div class="photo-top-header">                    
                    <div class="custom-img-filter-header border-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="gallery-head">Your Default Images</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <form id="defaultImage" method="post" enctype="multipart/form-data" action="{{ route('escort.default.images')}}">
                        @csrf
                        <div class="row pt-3 pl-2 pr-2">
                            <div class="col-lg-4 pr-0 pl-0">
                                
                                <h2 class="banner-sub-heading my-2">Thumbnail</h2>
                                <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(1)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec" id="dvDest">
                                    <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="1"  data-html="true" data-placement="top" title="" data-boundary="window" id="img1" src="{{ asset($path->findByposition(auth()->user()->id,1, 1)['path']) }}" style="object-fit: cover;width: 167px;height: 172px;">
                                    <input type="hidden" id="pos_1" name="position[1]" value="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="banner-sub-heading my-2">Gallery Images</h2>
                                    </div>
                                </div>
                                <div class="row" style="">
                                    <div class="col-4 pr-0">
                                        <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(2)">
                                            <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="2" data-html="true" data-placement="top" title="" data-boundary="window" id="img2" src="{{ asset($path->findByposition(auth()->user()->id,2, 1)['path'])}}">
                                            <input type="hidden" id="pos_2" name="position[2]" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(3)">
                                            <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="3" data-html="true" data-placement="top" title="" data-boundary="window"  id="img3" src="{{ asset($path->findByposition(auth()->user()->id,3, 1)['path'])}}">
                                            <input type="hidden" id="pos_3" name="position[3]" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(4)">
                                            <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="4" data-html="true" data-placement="top" title="" data-boundary="window"  id="img4" src="{{ asset($path->findByposition(auth()->user()->id,4, 1)['path'])}}">
                                            <input type="hidden" id="pos_4" name="position[4]" value="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="">
                                    <div class="col-4 pr-0">
                                        <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(5)">
                                            <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="5" data-html="true" data-placement="top" title="" data-boundary="window"  id="img5" src="{{ asset($path->findByposition(auth()->user()->id,5, 1)['path'])}}">
                                            <input type="hidden" id="pos_5" name="position[5]" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(6)">
                                            <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="6" data-html="true" data-placement="top" title="" data-boundary="window"  id="img6" src="{{ asset($path->findByposition(auth()->user()->id,6, 1)['path'])}}">
                                            <input type="hidden" id="pos_6" name="position[6]" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 pr-0">
                                        <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(7)">
                                            <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                            <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="7" data-html="true" data-placement="top" title="" data-boundary="window"  id="img7" src="{{ asset($path->findByposition(auth()->user()->id,7, 1)['path'])}}">
                                            <input type="hidden" id="pos_7" name="position[7]" value="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2 class="banner-sub-heading my-1">Banner Image</h2>
                                   
                                    <div class="about_me_drop_down_info pt-2" data-toggle="modal" data-target="#photo_gallery_banner" onclick="positionToUpdate(9)">
                                        <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec-banner">
                                        <img class="img-fluid common-img" id="img9" data-position-id="9" src="{{ asset($path->findByposition(auth()->user()->id,9, 1)['path'])}}" >
                                        <input  type="hidden"  id="pos_9" name="position[9]" value="">
                                        </label>
                                    </div>
                                </div>
                                {{-- new pinup banner --}}
                                    
                                <div class="col-lg-6">
                                    <h2 class="banner-sub-heading my-1">Pin Up Image</h2>
                                    <div class="about_me_drop_down_info pt-2" data-toggle="modal" data-target="#photo_gallery_pinup" onclick="positionToUpdate(10)">
                                        <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec-banner">
                                        <img class="img-fluid common-img" id="img10" data-position-id="10" src="{{ asset($path->findByposition(auth()->user()->id,10, 1)['path'])}}" >
                                        <input  type="hidden"  id="pos_10" name="position[10]" value="">
                                        </label>
                                    </div>
                                </div>
                                {{-- end --}}
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-left: 7rem;">
                            <button type="submit" class="btn btn-primary create-tour-sec useDefault">Use Default</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8" id="js_profile_media_gallery">
            <div class="photo-top-header">
                <div class="photo-header custom-photo-header">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="nav nav-tabs border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" id="menu_all"  href="#home">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="menu_varified"  href="#menu1">Verified</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="menu_unverified"  href="#menu2">Unverified</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2 pt-1">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$media->count() * 3.3}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div style="display: flex;gap: 15px;">
                                <p>{{ $media->count() }}/30</p>
                                <input type="hidden" name="media_count" value="{{$media->count()}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-img-filter-header">
                    <div class="row">
                        <ul class="nav nav-tabs border-0 js_gallery_category">
                           
                            <li class="nav-item">
                                <a class="nav-link active" data-type="gallery" data-toggle="tab" href="#Gallery">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-type="banner" data-toggle="tab" href="#Banner">Banner</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-type="pinup" data-toggle="tab" href="#Pinup">Pinup</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="archive-photo-sec">
                <div class="row">
                   <div class="col-md-12">
                      <div id="pagination-container"></div>
                      <div id="carouselExampleIndicators" class="carousel slide" data-bs-wrap="false" data-bs-ride="carousel">
                         <ul class="pagination ml-2 pl-1">
                            <!-- Declare the item in the group -->
                            <li class="page-item preview">
                               <!-- Declare the link of the item -->
                            <a class="page-link" href="#carouselExampleIndicators" id="preId">‹‹</a>

                            </li>


                            @for($i = 0; $i < ceil(count($mediaCategory)/10); $i++ )
                            <li class="page-item " id="pageItem_{{$i}}" data-id="{{$i}}">
                               <a data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"  class="page-link" href="#">{{$i + 1}}</a>
                            </li>
                            @endfor

                            <li class="page-item nextOne">
                            <a class="page-link" href="#carouselExampleIndicators" id="nextId">››</a>
                            </li>
                         </ul>
                         <div class="container pt-2" style="padding-left: 0.75rem;padding-right: 0.75rem;">
                            <div class="carousel-inner" id="view_all">

                               @foreach($mediaCategory->chunk(10)  as $keyId => $images)
                               <div class="carousel-item" id="cItem_{{$loop->index}}" data-id="{{$loop->index}}">
                                  <div class="grid-container" id="dvSource">
                                    @foreach($images as $image)
                                    @if(!in_array($image->position, [8])/*$image->position != 8*/)
                                    <div class="item4" id="dm_{{$image->id}}">
                                        <img class="img-thumbnail defult-image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                                        <i class="fa fa-trash deleteimg" data-id="{{$image->id}}" title="Remove this media"></i>                                        
                                        @switch($image->position)
                                        @case(9)
                                        <span class="badge badge-red">Banner</span>
                                        @break
                                        @case(10)
                                        <span class="badge badge-red">Pin Up</span>
                                        @break
                                        @default
                                        <span class="badge badge-red">Gallery</span>
                                        @endswitch
                                        
                                    </div>
                                    @endif
                                    @endforeach
                                  </div>
                               </div>

                               @endforeach
                            </div>
                            <!--.Carousel-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal delete" id="pesrmissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header main_bg_color border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
                </span>
                </button>
            </div>
            <div id="addTourForm1">
                <div class="col-md-12 p-0">
                    <span id="msg">  </span>
                </div>
                <input type="hidden" id="deleteId" value="">
                <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                    <button type="submit" class="btn btn-secondary create-tour-sec permission">Ok</button>
                    <button type="button" class="btn btn-primary create-tour-sec nopermission" data-dismiss="modal" aria-label="Close">close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('escort.dashboard.modal.upload_gallery_image')
<div class="modal" id="photo_gallery" style="display: none">
   <div class="modal-dialog modal-dialog-centered">
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
               <div id="gallery_modal_container" class="grid-container modalPopup" style="max-height: 500px; overflow-y:scroll;">
                   @foreach($media  as $keyId => $image)
                       @if(!in_array($image->position, [8, 9, 10])/*$image->position != 8*/)
                           <div class="item4">
                               <img class="img-thumbnail defult-image select_image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                           </div>
                       @endif
                   @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
<div class="modal" id="photo_gallery_banner" style="display: none">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content custome_modal_max_width">
           <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title" style="color: white;"> <img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Select Banner</h5>
              
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
            </span>
               </button>
           </div>
           <div class="modal-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs my-custompop-tabs" id="myTab" role="tablist">
                
                <li class="nav-item">
                    <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="false">
                        Upload Banner
                    </a>
                    </li>
                <li class="nav-item">
                <a class="nav-link" id="default-tab" data-toggle="tab" href="#default" role="tab" aria-controls="default" aria-selected="true">
                    Default Template
                </a>
                </li>
            </ul>
               <div class="modalPopup" style="max-height: 500px; overflow-y:scroll;">
                    
                    <div class="tab-content mt-3">
                        <!-- Tab panes -->
                        <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                            <div class="modal-tab">
                                @foreach($media  as $keyId => $image)
                                    @if(in_array($image->position, [9])/*$image->position != 8*/)                                    
                                    <!-- upload Template Tab -->
                                            <div class="item2">
                                                <img class="img-thumbnail defult-image select_image"
                                                    src="{{ asset($image->path) }}"
                                                    alt=" "
                                                    data-id="{{$image->id}}"
                                                    data-position="{{$image->position ? $image->position : ''}}">
                                            </div>              
                                                
                                    @endif
                                @endforeach                                     
                            </div>                           
                        </div>     
                        <!-- default Banner Tab -->
                        <div class="tab-pane fade" id="default" role="tabpanel" aria-labelledby="default-tab">
                            <div class="modal-tab">
                                <div class="item2">
                                    <img src="{{ asset('assets/app/img/blog-8.png') }}" class="img-thumbnail defult-image select_image">
                                </div>
                                <div class="item2">
                                    <img src="{{ asset('assets/app/img/blog-9.png') }}" class="img-thumbnail defult-image select_image">
                                </div>
                                <div class="item2">
                                    <img src="{{ asset('assets/app/img/blog-10.png') }}" class="img-thumbnail defult-image select_image">
                                </div>
                                <div class="item2">
                                    <img src="{{ asset('assets/app/img/blog-13.png') }}" class="img-thumbnail defult-image select_image">
                                </div>
                            </div>
                        </div>
                    </div>    
               </div>
           </div>
       </div>
   </div>
</div>
<div class="modal" id="photo_gallery_pinup" style="display: none">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content custome_modal_max_width">
           <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title" style="color: white;"> <img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Select Pin Up</h5>
              
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
            </span>
               </button>
           </div>
           <div class="modal-body">
               <div id="pinup_modal_container" class="grid-container modalPopup" style="max-height: 500px; overflow-y:scroll; grid-template-columns: 1fr 1fr 1fr;">
                  
                   @foreach($media  as $keyId => $image)
                       @if(in_array($image->position, [10]))
                           <div class="item2">
                               <img class="img-thumbnail defult-image select_image" style="" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                           </div>
                       @endif
                   @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
<div class="modal" id="comman_modal" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                    <span id="comman_str dd"></span>
                    <span class="comman_msg"></span>
                </h1>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
            </div>
        </div>
    </div>
</div>
@include('escort.dashboard.modal.remove_gallary_image')
@endsection
@push('script')
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/escort/profile_and_media_gallery.js') }}"></script>
<script>
    var updatePosition = 0;
    $("body").on('click','.cropEdit',function(){
        var id = $(this).attr('id');
        var val = $(this).attr('value');
        var src = $("#blah"+val).attr('src');
        console.log("id = " +id);
        console.log("val = " +src);
    });

   $(".useDefault").hide();

   function initDragDrop(){
    $("#dvSource img").draggable({
           revert: "invalid",
           helper: 'clone',
            appendTo: ".upload-photo-sec",
           refreshPositions: false,
           drag: function (event, ui) {
               
           },
           stop: function (event, ui) {
           }
       });
       $(".dvDest").droppable({
           drop: function (event, ui) {
               var img_target = $(this).find('img');
               var id = (img_target.attr('id'));
               var position = img_target.data('position-id');
               var sourceImagePosition = $(ui.draggable).data('position');
               var meidaId = ui.draggable.data('id');
                $("#pos_"+id.slice(3,4)).val(ui.draggable.data('id'));
               updateDefaultImage(position, meidaId, img_target, ui.draggable.attr('src'));
           }

       });
   }

   $(function () {
    initDragDrop();
   });

   function updateDefaultImage(position, meidaId, img_target, media_src) {
       var url = "{{ route('escort.default.images') }} ";
       $.ajax({
           type: 'POST',
           url: url,
           data: {
               position: position,
               meidaId: meidaId
           },
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success : function (data) {
               if(data.error == true) {
                   img_target.attr('data-id', meidaId);
                   img_target.attr('src', media_src);
               } else {
                   swal.fire('', "<p>"+data.msg+"</p>", 'error');
                   
                   $('#comman_modal').on('hidden.bs.modal', function () {
                       
                   });
               }
           }
       });
   }

   $("#defaultImage").on('submit',function(e){
   e.preventDefault();

   var form = $(this);
   var url = form.attr('action');
   var data = new FormData($('#defaultImage')[0]);
       $.ajax({
           method: form.attr('method'),
           url:url,
           data:data,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function (data) {
               console.log(data);
               if(data.error == true) {
                   var msg = "Saved";
                   swal.fire('', msg, 'success');

               } else {
                   var msg = "Something wrong...";
                   swal.fire('', msg, 'error');
               }
           },
           error: function (data) {
               $.toast({
                   heading: 'Error!',
                   text: data.responseJSON.message,
                   icon: 'error',
                   loader: true,
                   position: 'top-right',      // Change it to false to disable loader
                   loaderBg: '#9EC600'  // To change the background
               });

           }
       });
   });

   var positionToFill;
   $(document).ready(function(){
       $(".img-fluid.excludeTooltip, #img9").on('click', function(e) {
           positionToFill = $(this);
       });
   })

   function positionToUpdate(position) {
       console.log("positionToUpdate",position);
       updatePosition = position;
       return true;
   }

   $(document).on('click','.modalPopup .item2,.modalPopup .item4', function(e) {
       let imageSrc = $(this).find('img').attr('src');
       let mediaId = $(this).find('img').data('id');
       let img_target = $("#img"+updatePosition);
       updateDefaultImage(updatePosition, mediaId, img_target, imageSrc);
       $(`#${$(this).parents('.modal').attr('id')}`).modal("hide");
   });
</script>
@endpush
