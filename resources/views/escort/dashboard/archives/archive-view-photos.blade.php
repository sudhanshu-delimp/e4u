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
</style>
<style type="text/css">
    /* body
    {
    font-family: Arial;
    font-size: 10pt;
    }
    img
    {
    height: 100px;
    width: 100px;
    margin: 2px;
    }*/
    .draggable
    {
    filter: alpha(opacity=60);
    opacity: 0.6;
    }
    .dropped
    {
    position: static !important;
    }
    /* #dvSource, #dvDest
    {
    border: 5px solid #ccc;
    padding: 5px;
    min-height: 100px;
    width: 430px;
    }  */
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
    .grid-container {
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    gap: 10px;
    }
    .grid-container > div {
    background-color: rgba(255, 255, 255, 0.8);
    }
    .item1 {
    grid-column: 3 / span 3;
    }
    img.img-thumbnail.defult-image {
        width: 190px;
        height: 202px;
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
</style>
@endsection
@section('content')
<div class="container-fluid">
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-12">
 
            <div class="row mb-4">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="v-main-heading h3" style="display: inline-block; padding-top: 0;">Photos</div>
                            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row collapse" id="notes">
                        <div class="col-md-12 mb-5">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol class="pl-4">
                                        <li>Upload your photos here (up to 30) and then select your default images including your Thumbnail, other photos (up to six portrait) and your Banner Image (landscape) (<b>Default Images</b>).</li>
                                        <li>Your Default Images will always appear in the Profile Creator when you activate the Profile Creator (for a new Profile). If you change any of the Default Images in the Profile Creator, like when you are creating a second Profile for the same Location, you will be asked if you want to update your changes to the Default Images.</li>
                                        <li>When uploading your Photos, make sure they comply with our <a href="/escort-dashboard/help">Profile Image</a> guidelines, especially in terms of the pixilation and the size of the photo.</li>
                                        <li>If you don't upload a Banner Image (which is located at the top of your Profile), you can select a template image from the list (<b>Template</b>).  There is a Template designed to represent each Location.  We encourage you to upload your own Banner.  Remember, it is a landscape image and you can include a montage.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="col-md-2" style="padding-left: 7rem;">
                  <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Photos</button>
               </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="upload-photo-sec">
                <div class="container">
                    <div class="d-sm-flex align-items-center justify-content-between pt-4">
                        <h1 class="h3 text-gray-800 mb-0">Default Images</h1>
                    </div>
                    <form id="defaultImage" method="post" enctype="multipart/form-data" action="{{ route('escort.default.images')}}">
                        @csrf
                        <div class="row pt-3 pl-2 pr-2">
                            <div class="col-4 pr-0 pl-0">
                                <div class="plate" data-toggle="modal" data-target="#photo_gallery" onclick="positionToUpdate(1)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec" id="dvDest">
                                    <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="1"  data-html="true" data-placement="top" title="" data-boundary="window" id="img1" src="{{ asset($path->findByposition(auth()->user()->id,1, 1)['path']) }}" style="object-fit: cover;width: 167px;height: 332px;">
                                    <input type="hidden" id="pos_1" name="position[1]" value="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-8">
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
                            <div class="about_me_drop_down_info pt-2" data-toggle="modal" data-target="#photo_gallery_banner" onclick="positionToUpdate(9)">
                                <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec-banner">
                                <img class="img-fluid" id="img9" data-position-id="9" src="{{ asset($path->findByposition(auth()->user()->id,9, 1)['path'])}}" >
                                <input  type="hidden"  id="pos_9" name="position[9]" value="">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-left: 7rem;">
                            <button type="submit" class="btn btn-primary create-tour-sec useDefault">Use Default</button>
                        </div>

                        {{-- <div id="usedf"> --}}

                        {{-- <div class="row" style="">
                           <div class="col-4 pr-0">
                              <div class="plate">
                                 <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid"  id="img5" src="{{ asset($path->findByposition(auth()->user()->id,5)['path'])}}">
                                 <input type="hidden" id="pos_5" name="position[5]" value="">
                                 </label>
                              </div>
                           </div>
                           <div class="col-4 pr-0">
                              <div class="plate">
                                 <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid"  id="img6" src="{{ asset($path->findByposition(auth()->user()->id,6)['path'])}}">
                                 <input type="hidden" id="pos_6" name="position[6]" value="">
                                 </label>
                              </div>
                           </div>
                           <div class="col-4 pr-0">
                              <div class="plate">
                                 <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                 <img class="img-fluid"  id="img7" src="{{ asset($path->findByposition(auth()->user()->id,7)['path'])}}">
                                 <input type="hidden" id="pos_7" name="position[7]" value="">
                                 </label>
                              </div>
                           </div>

                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="photo-top-header" style="
                ">
                <div class="photo-header border-0">
                    <div class="modal-header border-0 p-0" style="display: block;position: relative;top: 30%;">
                        <div class="row">
                            <div class="col-md-8">
                                <ul class="nav nav-tabs border-0">
                                    <li class="nav-item">
                                        <a class="nav-link show" id="menu_all" data-toggle="tab" href="#home">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="menu_varified" data-toggle="tab" href="#menu1">Verified</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="menu_unverified" data-toggle="tab" href="#menu2">Unverified</a>
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
                                    <p>{{ $media->count()}}/30</p>
                                    <img src="{{ asset('assets/app/img/Vector-2.png')}}" style="height: 21px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="archive-photo-sec">
                <div class="row">
                   <div class="col-md-12">
                      <div id="pagination-container"></div>
                      <div id="carouselExampleIndicators" class="carousel slide" data-bs-wrap="false" data-bs-ride="carousel">
                      {{-- <div id="carouselExampleIndicators" class="carousel slide" data-interval="false"> --}}
                         <ul class="pagination ml-2 pl-1">
                            <!-- Declare the item in the group -->
                            <li class="page-item preview">
                               <!-- Declare the link of the item -->
                            <a class="page-link" href="#carouselExampleIndicators" id="preId">‹‹</a>

                            </li>


                            @for($i = 0; $i < ceil(count($media)/10); $i++ )
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
                               {{-- <div class="carousel-item" id="cItem_0" data-id="0">
                                  <div class="grid-container" id="dvSource">

                                     @foreach($media_withPosition  as $key => $img)
                                     <div class="item4">
                                        <img class="img-thumbnail {{ $img->position == 9 ? 'defult-image-3' : 'defult-image' }}" src="{{  asset($img->path) }}" alt=" " data-id="{{$img->id}}">
                                     </div>
                                     @endforeach
                                  </div>
                               </div> --}}

                               @foreach($media->chunk(10)  as $keyId => $images)
                               <div class="carousel-item" id="cItem_{{$loop->index}}" data-id="{{$loop->index}}">
                                  <div class="grid-container" id="dvSource">
                                    @foreach($images as $image)
                                    @if(!in_array($image->position, [8])/*$image->position != 8*/)
                                    <div class="item4" id="dm_{{$image->id}}">
                                    <img class="img-thumbnail defult-image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                                    <i class="fa fa-trash deleteimg" data-id="{{$image->id}}" title="Remove this media"></i>
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
<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
        <div class="modal-content" style="width: 900px;position: absolute;">
            {{-- {{ route('escort.upload.gallery') }} --}}
            <form id="mulitiImage" method="POST" action="{{route('escort.upload.gallery')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Upload Photos</h5>
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
                                            <div class="photo-sec-popup"  id="image_preview">
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec justify-content-between wish_span rm" style="z-index: 1;">
                                                        {{-- <span class="card_tit" style="">Photo.img</span>
                                                        <i class="fa fa-trash"></i>    --}}
                                                    </div>
                                                    <label class="newbtn rm">
                                                        <img id="blah" class="item" src="{{ asset('assets/app/img/upload-thum-1.png')}}">
                                                        {{--
                                                        <figcaption>Edit</figcaption>
                                                        --}}
                                                        <input name="img[]" id="upload_file" class="pis" onchange="preview_image(this);" type="file" multiple accept="image/*">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                                {{-- @foreach($media as $key => $img)
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                        <span class="card_tit" style="">Photo.img</span>
                                                        <i class="fa fa-trash deleteId" data-id="{{$img->id}}"></i>
                                                    </div>
                                                    <label class="newbtn">
                                                        <img id="blah1" class="item" src="{{ asset($img->path) }}">
                                                        <figcaption>Edit</figcaption>
                                                        <input type="hidden" name="position[]" value="{{$img->position}}">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                                @endforeach --}}
                                                {{--
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                        <span class="card_tit" style="">Photo.img</span>
                                                        <i class="fa fa-trash"></i>
                                                    </div>
                                                    <label class="newbtn">
                                                        <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                        <figcaption>Edit</figcaption>
                                                        <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                        <input type="hidden" name="position[]" value="1">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                        <span class="card_tit" style="">Photo.img</span>
                                                        <i class="fa fa-trash"></i>
                                                    </div>
                                                    <label class="newbtn">
                                                        <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                        <figcaption>Edit</figcaption>
                                                        <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                        <input type="hidden" name="position[]" value="1">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                        <span class="card_tit" style="">Photo.img</span>
                                                        <i class="fa fa-trash"></i>
                                                    </div>
                                                    <label class="newbtn">
                                                        <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                        <figcaption>Edit</figcaption>
                                                        <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                        <input type="hidden" name="position[]" value="1">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                        <span class="card_tit" style="">Photo.img</span>
                                                        <i class="fa fa-trash"></i>
                                                    </div>
                                                    <label class="newbtn">
                                                        <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                        <figcaption>Edit</figcaption>
                                                        <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                        <input type="hidden" name="position[]" value="1">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                        <span class="card_tit" style="">Photo.img</span>
                                                        <i class="fa fa-trash"></i>
                                                    </div>
                                                    <label class="newbtn">
                                                        <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                        <figcaption>Edit</figcaption>
                                                        <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                        <input type="hidden" name="position[]" value="1">
                                                    </label>
                                                    <div style="margin-top: -34px;">
                                                    </div>
                                                </a>
                                                --}}
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="plate"><label class="newbtn">
                                                        <img id="blah9" class="img-fluid pl-2 pr-2" src="{{ asset('assets/app/img/upload-3.png')}}" style="height: 150px;object-fit: cover;width: 100%;">
                                                        <input name="img[9]" id="pic9" class="pis" onchange="readURL(this);" type="file" accept="image/*" >
                                                        <input type="hidden" name="position[]" id="mediaId9">
                                                        </label>
                                                    </div>
                                                </div>
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
                                        {{--
                                        <div class="col-6">
                                            <div class="plate">
                                                <label class="newbtn rm">
                                                <img class="img-fluid" id="blah8" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}" style="width: 420px;height: 143px;object-fit: cover;">
                                                <input name="img[8]" id="pic8" class="pis" onchange="readURL(this);" type="file">
                                                <input type="hidden" name="position[]" value="8">
                                                </label>
                                            </div>
                                        </div>
                                        --}}
                                        <div class="col-6">
                                            <div class="plate" style="position: relative;top: 30%;"><label class="newbtn">
                                                <img class="img-fluid" id="blah8" src="{{ asset($path->findByposition(auth()->user()->id,8)['path']) }}" style="height: 138px;object-fit: cover;width: 370px;">
                                                <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readURL(this);" type="file">
                                                {{-- <input type="hidden" name="position[]" id="mediaId8"> --}}
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
                      <button type="submit" class="btn btn-primary">Verify Media</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="photo_gallery" style="display: none">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content custome_modal_max_width">
           <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title" style="color: white;">Select Photo</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
               </button>
           </div>
           <div class="modal-body">
               <div class="grid-container modalPopup" style="max-height: 500px; overflow-y:scroll;">
{{--                   <div class="col-sm-12">--}}
                   @foreach($media  as $keyId => $image)
                       @if(!in_array($image->position, [8, 9, 10])/*$image->position != 8*/)
                           <div class="item4">
                               <img class="img-thumbnail defult-image select_image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                           </div>
                       @endif
                   @endforeach
{{--                   </div>--}}
               </div>
           </div>
           {{--<div class="modal-footer" style="justify-content: center;">
               <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
           </div>--}}
       </div>
   </div>
</div>
<div class="modal" id="photo_gallery_banner" style="display: none">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content custome_modal_max_width">
           <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title" style="color: white;">Select Banner</h5>
               {{--<div class="uploadModalTrigger" style="display: inline-block;position: absolute;right: 200px;">
                   <button type="button" data-toggle="modal" data-target="empty" class="btn btn-info" style=" padding: 5px;">Upload from device</button>
               </div>--}}
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
            </span>
               </button>
           </div>
           <div class="modal-body">
               <div class="grid-container modalPopup" style="max-height: 500px; overflow-y:scroll; grid-template-columns: auto;">
                   {{--                   <div class="col-sm-12">--}}
                   @foreach($media  as $keyId => $image)
                       @if(in_array($image->position, [9,10])/*$image->position != 8*/)
                           <div class="item2">
                               <img class="img-thumbnail defult-image select_image" style="height: 150px; width: 100%;" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                           </div>
                       @endif
                   @endforeach
                   {{--                   </div>--}}
               </div>
           </div>
           {{--<div class="modal-footer" style="justify-content: center;">
               <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
           </div>--}}
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
                    <span id="comman_str"></span>
                    <span class="comman_msg"></span>
                </h1>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="delete_img" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <span class="text-white">Delete Image</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                    <span id="img_comman_str"></span>
                    <span class="img_comman_msg"></span>
                </h1>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="submit" class="btn main_bg_color site_btn_primary d_img" data-dismiss="modal" id="close">Cancel</button>
                <button type="submit" class="btn main_bg_color site_btn_primary d_img" id="dImg">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
<script>

    var updatePosition = 0;

    $(document).ready(function() {
        /*$("#edit_1").on("click", function(e) {
            console.log($(this))
        });*/
        /*$(document).find('#defaultImage .img-fluid').tooltip({
            placement:"right",
            delay: { "show": 100, "hide": 100 }
        });
        $(document).on('mouseover', "#defaultImage .img-fluid", function() {
            var imagePath = $(this).attr('src');
            var imgElement = "<img style='position: absolute;' src='"+imagePath+"' />";
            $(this).attr('data-original-title', imgElement)
        })*/
    });
    //$(document).ready( function () {
    // var table = $('#myTable').DataTable({
    //     "language": {
    //         "zeroRecords": "No record(s) found."
    //     },
    //     processing: true,
    //     serverSide: true,
    //     lengthChange: true,
    //     order: [0,'asc'],
    //     searchable:false,
    //     //searching:false,
    //     bStateSave: false,

    //     ajax: {
    //         url: "{{ route('escort.list.dataTable') }}",
    //         data: function (d) {
    //             d.type = 'player';
    //         }
    //     },
    //     columns: [
    //         { data: 'key', name: 'key', searchable: false, orderable:true ,defaultContent: 'NA'},
    //         { data: 'profile_name', name: 'profile_name', searchable: false, orderable:true ,defaultContent: 'NA'},
    //         { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
    //         { data: 'city_name', name: 'city_name', searchable: true, orderable:true ,defaultContent: 'NA'},
    //         { data: 'phone', name: 'phone', searchable: true, orderable:true,defaultContent: 'NA' },
    //         { data: 'start_date_parsed', name: 'start_date_parsed', searchable: true, orderable:true,defaultContent: 'NA' },
    //         { data: 'enabled', name: 'enabled', searchable: false, orderable:true,defaultContent: 'NA' },
    //         { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
    //     ]
    // });

    //} );

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // $(document).on('click','.delete-center', function(e){
    //     e.preventDefault();
    //     var $this = $(this);
    //     var table = $('#myTable').DataTable();
    //     const swalWithBootstrapButtons = Swal.mixin({
    //     customClass: {
    //     confirmButton: 'btn btn-success',
    //     cancelButton: 'btn btn-danger'
    //     },
    //     buttonsStyling: false
    //     })

    //     swalWithBootstrapButtons.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, delete it!',
    //         cancelButtonText: 'No, cancel!',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.post({
    //                 type: 'POST',
    //                 url: $this.attr('href')
    //             }).done(function (data) {
    //                 if(data.error == 0)
    //                 {
    //                     Swal.fire({
    //                       icon: 'error',
    //                       title: 'Oops...',
    //                       text: 'Something went wrong!',
    //                       footer: '<a href="">Why do I have this issue?</a>'
    //                     })
    //                 }else {
    //                     swalWithBootstrapButtons.fire(
    //                     'Deleted!',
    //                     'Your file has been deleted.',
    //                     'success'
    //                     );

    //                     table.row( $this.parents('tr') ).remove().draw();
    //                 }


    //             });
    //         } else if (
    //         /* Read more about handling dismissals below */
    //         result.dismiss === Swal.DismissReason.cancel
    //         ) {
    //             swalWithBootstrapButtons.fire(
    //             'Cancelled',
    //             'Your imaginary file is safe :)',
    //             'error'
    //             )
    //         }
    //     });
    // });

    // $('#play-mates-modal').on('shown.bs.modal', function (e) {

    //     var name, city, source = e.relatedTarget;
    //     console.log($(source).data('url'));
    //     $('#hidden_escort_id').val($(source).data('id'));

    //     if(name = $(source).data('name')) {
    //         $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
    //     }

    //     if(city = $(source).data('city')) {
    //         $('#playmate-modal-location').html('<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' + $(source).data('city'));
    //     }

    //     $.ajax({
    //         url: $(source).data('url'),
    //         success: function (data) {
    //             $('#playmate-template').html(data);
    //         }
    //     });
    // });

    // $('#play-mates-modal').on('hidden.bs.modal', function () {
    //     $('#playmate-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');
    //     $('#playmate-modal-name').html('');
    //     $('#playmate-modal-location').html('');
    // });

    // $('#search-playmate-input').select2({
    //     dropdownParent: $("#play-mates-modal"),
    //     width: '100%',
    //     dropdownCssClass: "bigdrop",
    //     placeholder: {
    //         id: 0, // the value of the option
    //         text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",
    //         name: 'Search playmate',
    //         member_id: 'Type name or member id',
    //     },
    //     allowClear: true,
    //     language: {
    //         inputTooShort: function() {
    //             return 'Enter Member Id or Name';
    //         }
    //     },
    //     createTag: function(params) {
    //         var term = $.trim(params.term);

    //         if (term === '') {
    //             return null;
    //         }
    //         return {
    //             id: term,
    //             text: term,
    //             newTag: true // add additional parameters
    //         }
    //     },
    //     tags: false,
    //     minimumInputLength: 2,
    //     tokenSeparators: [','],
    //     ajax: {
    //         url: "{{ route('escort.playmates.find') }}",
    //         dataType: "json",
    //         type: "POST",
    //         data: function(params) {

    //             var queryParameters = {
    //                 query: params.term,
    //                 escort_id: $('#hidden_escort_id').val()
    //             }
    //             return queryParameters;
    //         },
    //         processResults: function(data) {
    //             return {
    //                 results: $.map(data, function(item) {

    //                     return {
    //                         text: item.default_image,
    //                         name: item.name,
    //                         member_id: item.member_id,
    //                         id: item.id
    //                     }
    //                 })
    //             };
    //         }
    //     },
    //     templateResult: formatEscortList,
    //     templateSelection: formatEscortList
    // });

    // $('#search-playmate-input').on('change', function(e) {
    //     console.log('ll',$(this).val());
    //     if($(this).val()) {
    //         $('#playmate_submit_button').show();
    //     } else {
    //         $('#playmate_submit_button').hide();
    //     }
    // });

    // function formatEscortList (data) {
    //     console.log('ckjoiujk;',data);
    //     return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+data.text+'"> '+data.name+' || '+data.member_id+'</span>');
    // }

    // $('#add-playmate-form').on('submit', function(e) {
    //     e.preventDefault();
    //     $('#playmate_submit_button').attr('disabled', true);
    //     $('#playmate_submit_button').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
    //     var $this = $(this);
    //     var escort_id = $('#hidden_escort_id').val();
    //     var member_id = $('#search-playmate-input').val();
    //     var url = $this.attr('action');
    //     $.post({
    //         type: $this.attr('method'),
    //         url: url,
    //         data: {
    //             escort_id: escort_id,
    //             playmate_id: member_id
    //         },
    //         success: function (data) {
    //             $('#search-playmate-input').val('');
    //             $('#playmate_submit_button').hide();
    //             $('#playmate-template').html(data);
    //         },
    //         error: function (data) {
    //             console.log(data);
    //         },
    //     }).done(function (data) {
    //         $('#playmate_submit_button').attr('disabled', false);
    //         $('#playmate_submit_button').html('Add Playmate');

    //         //$("#search-playmate-input").select2("val", "");

    //         $("#search-playmate-input").empty().trigger('change')
    //     });
    // });

    // $(document).on('click', '.remove-playmate', function(e) {
    //     e.preventDefault();

    //     var $this = $(this);
    //     var escort_id = $this.data('escort_id');
    //     var playmate_id = $this.data('playmate_id');
    //     const swalWithBootstrapButtons = Swal.mixin({
    //         customClass: {
    //             confirmButton: 'btn btn-success',
    //             cancelButton: 'btn btn-danger'
    //         },
    //         buttonsStyling: false
    //     });

    //     swalWithBootstrapButtons.fire({
    //         title: 'Are you sure?',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Remove',
    //         cancelButtonText: 'Cancel!',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.post({
    //                 type: 'POST',
    //                 url: "{{ route('escort.playmates.remove') }}",
    //                 data: {
    //                     escort_id: escort_id,
    //                     playmate_id: playmate_id
    //                 },
    //             }).done(function (data) {
    //                 if(data.error == 0) {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Oops...',
    //                         text: data.message
    //                     });
    //                 } else {
    //                     swalWithBootstrapButtons.fire({
    //                         icon: 'success',
    //                         title: '',
    //                         text: data.message
    //                     });

    //                     $('#playmate-template').html(data.template);
    //                 }
    //             });
    //         }
    //     });
    // });

</script>
<script>
    // $('.carousel').carousel({
    // interval: false,
    // });
</script>
<script>
    // $('.newbtn').bind("click" , function () {
    //        $('#pic').click();
    //        console.log($(this).attr('id'));
    // });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {


                var image = new Image();
                image.src = e.target.result;

                    image.onload = function () {
                        var height = image.height;
                        var width = image.width;
                        console.log(`width : ${image.width} px`, `height: ${image.height} px`);

                        if(input.id[3] == 9 && (height > 470 || width > 1921)) {
                            alert("Width and Height must not exceed 1920px * 469px.");

                        } else {
                            $('#blah'+input.id[3]).attr('src', e.target.result);

                            $('#img'+input.id[3]).attr('src', e.target.result);
                            // alert("Uploaded image has valid Width and Height.");
                        }


                    };
            };

            reader.readAsDataURL(input.files[0]);

        }
            console.log("file = "+input.id[3]);

    }
    function preview_image()
    {
        $(".rm").hide();
        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0;i<total_file;i++)
        {

            var num = i+1;
            var oFile =document.getElementById("upload_file").files[i];

            var imgkbytes = Math.round(parseInt(oFile.size)/1024);
            var imgMB = Math.round(parseInt(imgkbytes)/1024);


           console.log(oFile.size);
           console.log(imgMB);
           if(imgMB <= 2 ) {
            $('#image_preview').append("<a href='#'><div class='five_column_content_top img-title-sec justify-content-between wish_span rm_"+num+"' style='z-index: 1;'><span class='card_tit' style=''>Photo.img</span><i class='fa fa-trash deleteId' data-id='"+num+"'></i></div><label class='newbtn rm_"+num+"'><img id='blah"+num+"' class='item' src='"+URL.createObjectURL(event.target.files[i])+"'>" +
                // "<figcaption id='edit_"+num+"' class='cropEdit' value='"+num+"'> Edit</figcaption>" +
                "<input type='hidden' name='selected_files[]' value='"+i+"'></label><div style='margin-top: -34px;'></div></a>");
            } else {
                //alert("file size in MB = "+imgMB);
               swal.fire('', "Can't upload more than 2 MB size", 'error');
                /*$('.comman_msg').html("");
                $("#comman_modal").modal('show');*/
            }


        }
        $(document).on('click','.deleteId', function(){
        var mid = $(this).attr('data-id');

        $(".rm_"+mid).remove();
        console.log("data "+ mid);

        });
        console.log("total_file = " +total_file);



    }

    $("body").on('click','.cropEdit',function(){
        var id = $(this).attr('id');
        var val = $(this).attr('value');
        var src = $("#blah"+val).attr('src');
        console.log("id = " +id);
        console.log("val = " +src);
    });
    $("body").on('submit','#mulitiImage',function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData($('#mulitiImage')[0]);
        // console.log( form.attr('action'))

        // console.log("url = "+form.attr('method'));

        for (let [key, value] of data) {
         console.log(key, value)
        }


        $.ajax({
            type: 'POST',
            url:url,
            data:data,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data.my_data.status);
                if(data.my_data.status == 200){
                    // $('.comman_msg').html("Uploaded");
                    swal.fire('', 'Uploaded', 'success');
                    // $("#comman_modal").modal('show');
                    window.location.href = data.my_data.url;
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        window.location.href = data.my_data.url;
                    });
                } else if(data.my_data.status == 405) {
                    console.log(data.my_data);
                    swal.fire('', "", 'error');
                    swal.fire('', "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>", 'error');
                    // $('.comman_msg').html();  // Can't upload more than 30 Images
                    $("#exampleModal").modal('hide');
                    // $("#comman_modal").modal('show');
                    /*$('#comman_modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });*/
                }
                 else {
                    window.location.href = data.my_data.url;
                }

            },
            error: function (data) {

                var errors = $.parseJSON(data.responseText);
                var errorMsg = errors.message;
                /*console.log(errors);
                $('.comman_msg').html("<p>"+errors.message+"</p>");
                $("#comman_modal").modal('show');
                $('#comman_modal').on('hidden.bs.modal', function () {
                    location.reload();
                });*/
                Swal.fire(
                    'Error occurred',
                    'File upload failed : ' + errorMsg,
                    'error'
                )

            }
        });
    });
</script>
<script type="text/javascript">
   $(".useDefault").hide();
   $(function () {
       $("#dvSource img").draggable({
           revert: "invalid",
           helper: 'clone',
        appendTo: ".upload-photo-sec",
           refreshPositions: false,
           drag: function (event, ui) {


               //img_target.attr('data-id', ui.draggable.data('id'));

               // ui.helper.addClass("draggable");

            //    var srcc=$("#dvSource").find('img').attr('src');
            //    console.log("src="+srcc);
           },
           stop: function (event, ui) {
               // ui.helper.removeClass("draggable");
               // var image = this.src.split("/")[this.src.split("/").length - 1];
               // console.log("image = "+image);
               // if ($.ui.ddmanager.drop(ui.helper.data("draggable"), event)) {
               //     alert(image + " dropped.");
               // }
               // else {
               //     alert(image + " not dropped.");
               // }

           }
       });
       $(".dvDest").droppable({
           drop: function (event, ui) {
               // if ($("#dvDest img").length == 0) {
               //     var sc = $("#dvDest img").attr('src');
               //     console.log("src=" + sc);

               //     console.log("if ok");
               // }
               // ui.draggable.addClass("dropped");

               //$("#dvDest").append(ui.draggable[0]);
               //$("#myimg").append(ui.draggable);
               //console.log(ui.draggable.attr('src'));

               var img_target = $(this).find('img');


               //img_target.attr('data-id', ui.draggable.data('id'));
               var id = (img_target.attr('id'));


               var position = id.slice(3,4);
               var sourceImagePosition = $(ui.draggable).data('position');
               // console.log(sourceImagePosition);
               // debugger;
               var meidaId = ui.draggable.data('id');





                $("#pos_"+id.slice(3,4)).val(ui.draggable.data('id'));
               // $("#usedf").append("<input type='hidden' name='imgId[]' value='"+ui.draggable.data('id')+"'>");
               // $('#item-id').draggable( "disable" )

               console.log("sourcePosition :"+ sourceImagePosition);
               console.log("destinationPosition :"+ position);
               console.log("meidaId :"+ meidaId);
               console.log("1198");
               updateDefaultImage(position, meidaId, img_target, ui.draggable.attr('src'));
               // debugger;

                // if(position != 9){
                /*if(position != 0){


                } else {
                    $('.comman_msg').html("<p>It's not a banner image .Please select banner image</p>");
                    $("#comman_modal").modal('show');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                    //location.reload();
                    });
                }*/
               //$(".useDefault").show();
           }

       });
   });

   function updateDefaultImage(position, meidaId, img_target, media_src) {
    console.log({position:position,meidaId:meidaId});
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
                   // $('.comman_msg').html();
                   // $("#comman_modal").modal('show');
                   $('#comman_modal').on('hidden.bs.modal', function () {
                       // location.reload();
                   });
               }
           }
       });
   }

   $("#defaultImage").on('submit',function(e){
   e.preventDefault();

   var form = $(this);
   var url = form.attr('action');
   //console.log("hii"+ src);
   var data = new FormData($('#defaultImage')[0]);
       $.ajax({
           method: form.attr('method'),
           url:url,
           data:data,
           // contentType: false,
           // processData: false,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function (data) {
               console.log(data);
               if(data.error == true) {
                   var msg = "Saved";
                   // var url = "{{asset('avatars/name')}}";
                   // url = url.replace('name',data.avatarName);
                   swal.fire('', msg, 'success');
                   // $('.comman_msg').text(msg);
                   // $("#comman_modal").modal('show');

               } else {
                   var msg = "Something wrong...";
                   swal.fire('', msg, 'error');
                   // $('.comman_msg').text(msg);
                   //$("#my_account_modal").show();
                   //$("#comman_modal").modal('show');
                   //location.reload();
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

   $('body').on('click','.deleteimg', function () {
        var id = $(this).data('id');
        $('#deleteId').val(id);
        var msg = "Delete";
        $('.img_comman_msg').text(msg);
        $("#delete_img").modal('show');

        $('#dImg').click(function () {


            var url = "{{ route('escort.delete.gallery',':id') }} ";
            url = url.replace(':id',id);

                $.ajax({
                type: "POST",
                url:url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.error == true) {
                        $("#delete_img").modal('hide');
                        $("#dm_"+id).remove();
                        //location.reload();
                        // $('#delete_img').on('hidden.bs.modal', function () {
                        //     location.reload();
                        // });
                    } else {
                        var msg = "Sumthing wrong...";
                        $('.img_comman_msg').text(msg);

                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    swal.fire('', "<p>"+errors.message+"</p>", 'error');
                    /*$('.comman_msg').html();
                    $("#comman_modal").modal('show');*/
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });


                }
            });
        });

   });

      $('#cItem_0').addClass(' active');
      $('#pageItem_0').addClass(' active');
      var activeClass = $(".pagination li.active").attr('id');
      let arr = activeClass.split('_');
      var list_array = [0,1,2,3];
      //console.log("acc="+arr[1])

    //   $(".preview").bind('click', false);
        $("body").on('click','.page-link', function(e){
         var id = $(this).attr('data-slide-to');
         $('.page-item').removeClass(' active');
         $('#pageItem_'+id).addClass(' active');
        // console.log("iddd="+id);
         if(id == 0) {
            $(".preview").addClass('leftLst over');
         } else {
            $(".preview").removeClass('leftLst over');
         }
         if(id == 2) {
            $(".nextOne").addClass('leftLst over');
         } else {
            $(".nextOne").removeClass('leftLst over');
         }



      })
    //   $(".preview").addClass('leftLst over');

      $("body").on('click','.preview', function(e){
        var carouselEl = $(".carousel-inner").carousel('prev');
        var carouselItems = carouselEl.find('.carousel-item');
        //console.log("classsid="+carouselItems.siblings('.active').index())
        var id = carouselItems.siblings('.active').index();
        if(id == 0) {
            $(".preview").addClass('leftLst over');
        //$(".carousel-inner").carousel('pause');
        } else {
            $(".preview").removeClass('leftLst over');
        }
        var clm = $(".carousel-inner").carousel('pause');
        $('#pageItem_'+id).addClass(' active');




      })
      $("body").on('click','.nextOne', function(e){

         var carouselEl = $(".carousel-inner").carousel('next');
         var carouselItems = carouselEl.find('.carousel-item');
         //console.log("classsid="+carouselItems.siblings('.active').index())
         var id = carouselItems.siblings('.active').index();
         if(id == 2) {
            $(".nextOne").addClass('leftLst over');

           // $(".carousel-inner").carousel('pause');//leftLst over
         } else {
            $(".nextOne").removeClass('leftLst over');
         }
         var clm = $(".carousel-inner").carousel('pause');
         $('#pageItem_'+id).addClass(' active');

         console.log(id)
      })

      //$(".carousel-inner").carousel();

      // $('.carousel-inner').on('slide.bs.carousel', function (e) {
      // console.log($(".carousel-inner").carousel())
      // })
   })

   // var items = $(".listall .listitem");
   // var numItems = items.length;
   // var perPage = 4;

   // items.slice(perPage).hide();

   // $('#pagination-container').pagination({
   //     items: numItems,
   //     itemsOnPage: perPage,
   //     prevText: "&laquo;",
   //     nextText: "&raquo;",
   //     onPageClick: function (pageNumber) {
   //         var showFrom = perPage * (pageNumber - 1);
   //         var showTo = showFrom + perPage;
   //         items.hide().slice(showFrom, showTo).show();
   //     }
   // });
   $("body").on('click','#menu_varified', function(e){
        $("#view_all").hide();
        $("#carouselExampleIndicators").hide();
   });
   $("body").on('click','#menu_unverified', function(e){
        $("#view_all").show();
        $("#carouselExampleIndicators").show();
   });
   $("body").on('click','#menu_all', function(e){
        $("#view_all").show();
        $("#carouselExampleIndicators").show();
   });

   function positionToUpdate(position) {
       console.log("positionToUpdate",position);
       updatePosition = position;
       return true;
   }
   $(".modalPopup .item4").on('click', function(e) {
       let imageSrc = $(this).find('img').attr('src');
       let mediaId = $(this).find('img').data('id');
       let img_target = $("#img"+updatePosition);
       console.log("1458");
       updateDefaultImage(updatePosition, mediaId, img_target, imageSrc);

       $("#photo_gallery").modal("hide");
   });
   $(".modalPopup .item2").on('click', function(e) {
       let imageSrc = $(this).find('img').attr('src');
       let mediaId = $(this).find('img').data('id');
       let img_target = $("#img"+updatePosition);
       console.log("1467");
       updateDefaultImage(updatePosition, mediaId, img_target, ima