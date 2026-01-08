<link rel="stylesheet" href="{{ asset('assets/richtexteditor/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('assets/richtexteditor/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/richtexteditor/plugins/all_plugins.js') }}"></script>
<style>.parsley-errors-list {
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

 .modal-tab {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
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
<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
      <div class="col-lg-12">
         <div class="member-id pl-0 pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
            </svg>
            <span>Member ID: M60218:001</span>
        </div>
      </div>
      {{-- <div class="about_me_drop_down_info profile-sec">
         <div class="row tab-input- pl-2 pt-4">            
            <div class="col-lg-4 col-md-12 col-sm-12">
               <div class="form-group row tab-about-me-row-padding">
                  <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
                  Profile Name:</label>
                  <div class="col-sm-7">
                     <input type="text" value="{{ $escort->profile_name}}" name="profile_name" class="form-control form-control-sm select_tag_remove_box_sadow" id="profile_name" required data-parsley-required-message="Enter profile name" data-parsley-group="goup_one">
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
               <div class="form-group row tab-about-me-row-padding">
                  <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Profile start date:</label>
                  <div class="col-sm-7">
                     <input type="date" name="start_date" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}" id="start_date" onkeydown="return false" required data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
               <div class="form-group row tab-about-me-row-padding">
                  <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Profile end date:</label>
                  <div class="col-sm-7">
                     <input type="date" name="end_date" class="form-control form-control-sm select_tag_remove_box_sadow" value="{{ $escort->end_date ? date('Y-m-d',strtotime($escort->end_date)) : ''}}" id="end_date" onkeydown="return false" required data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                  </div>
               </div>
            </div>
         </div>
      </div> --}}
      {{-- Our Business --}}
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="fill_profile_headings_global">          
            <h2>Our Business</h2>
         </div>
         <div class="business-info-field pt-4">
            <div class="form-group business-field">
               <label for="profile_name">Profile Name:</label>
                  <input type="text" name="profile_name" class="form-control" id="profile_name"  placeholder="Enter Profile Name" required data-tab="group_one">
               
            </div>

            <div class="form-group business-field">
               <label for="business_name">
                  Business Name:</label>
                  <input type="text" name="business_name" class="form-control" id="business_name" placeholder="Enter Business Name"  required data-tab="group_one">
            </div>           

            <div class="form-group business-field">
               <label for="business_no">
                  Business No:</label>
                  <input type="text" name="business_no" class="form-control" id="business_no" placeholder="Enter Business Number" >               
            </div>

            <div class="form-group business-field">
               <label for="mobile_no">
                  Mobile No:</label>
               <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Mobile Number">           
            </div>

            <div class="form-group business-field">
               <label for="address">Address:</label>
               <textarea name="address" rows="3" class="form-control" id="address" placeholder="Enter Address" data-parsley-group="goup_one" ></textarea>              
            </div>

         </div>
      </div>
      {{-- media --}}
      

      <!-- ########## Photos Tab ############ -->
       
     <div class="about_me_drop_down_info profile-sec">
        @if (request()->segment(2) == 'profile' && request()->segment(3))
            <form id="myProfileMediaForm" name="myProfileMediaForm"
                action="{{ route('escort.profile.media', [$escort->id]) }}" method="POST"
                enctype="multipart/form-data">
                @CSRF
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="col-lg-12 py-3">
                    <div class="border_covid covid_heading ">
                        <h2>Media
                            <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}" data-toggle="tooltip"
                                data-html="true" data-placement="top"
                                title="You can move your photos into any order you like by picking up and dropping into the preferred position."
                                data-boundary="window">

                        </h2>

                    </div>
                    <div class="row  mt-3">

                        <div class="col-md-12 mb-3 d-flex justify-content-end">
                            <button type="button" class="create-tour-sec dctour" data-toggle="modal"
                                data-target="#exampleModal">Add Photos</button>
                        </div>

                        <div class="col-lg-4">
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
                                    <div class="col-4">
                                        <h2 class="banner-sub-heading my-2">Thumbnail</h2>
                                        <div class="plate"><label class="newbtn dvDest" data-toggle="modal"
                                                data-target="#photo_gallery" onclick="positionToUpdate(1)">
                                                <img class="img-fluid upld-img profile-gallery" data-type="gallery"
                                                    id="img1" src="{{ asset($escort->imagePosition(1)) }}"
                                                    style="object-fit: cover;width: 167px;height: 172px;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h2 class="banner-sub-heading my-2">Gallery Images</h2>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal"
                                                        data-target="#photo_gallery" onclick="positionToUpdate(2)">
                                                        <img class="img-fluid upld-img profile-gallery"
                                                            data-type="gallery" id="img2"
                                                            src="{{ asset($escort->imagePosition(2)) }}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal"
                                                        data-target="#photo_gallery" onclick="positionToUpdate(3)">
                                                        <img class="img-fluid upld-img profile-gallery"
                                                            data-type="gallery" id="img3"
                                                            src="{{ asset($escort->imagePosition(3)) }}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal"
                                                        data-target="#photo_gallery" onclick="positionToUpdate(4)">
                                                        <img class="img-fluid upld-img profile-gallery"
                                                            data-type="gallery" id="img4"
                                                            src="{{ asset($escort->imagePosition(4)) }}">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="">
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal"
                                                        data-target="#photo_gallery" onclick="positionToUpdate(5)">
                                                        <img class="img-fluid upld-img profile-gallery"
                                                            data-type="gallery" id="img5"
                                                            src="{{ asset($escort->imagePosition(5)) }}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal"
                                                        data-target="#photo_gallery" onclick="positionToUpdate(6)">
                                                        <img class="img-fluid upld-img profile-gallery"
                                                            data-type="gallery" id="img6"
                                                            src="{{ asset($escort->imagePosition(6)) }}">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="plate"><label class="newbtn dvDest" data-toggle="modal"
                                                        data-target="#photo_gallery" onclick="positionToUpdate(7)">
                                                        <img class="img-fluid upld-img profile-gallery"
                                                            data-type="gallery" id="img7"
                                                            src="{{ asset($escort->imagePosition(7)) }}">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-3 pb-2">
                                    <div class="col-lg-12">
                                        <h2 class="banner-sub-heading my-2">Banner Image</h2>
                                        <label class="newbtn dvDest" data-toggle="modal"
                                            data-target="#photo_gallery_banner" onclick="positionToUpdate(9)">
                                            <img class="img-fluid profile-gallery" data-type="banner" id="img9"
                                                src="{{ asset($escort->imagePosition(9)) }}"
                                                style="height: 167.578px;width: 1066.640px;object-fit: cover;">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8" id="js_profile_media_gallery">
                            <div class="photo-top-header">
                                <div class="photo-header custom-photo-header">
                                    <div class="modal-header border-0 p-0"
                                        style="display: block;position: relative;top: 30%;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <ul class="nav nav-tabs border-0">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="menu_all" data-toggle="tab"
                                                            href="#home">All</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="menu_varified" data-toggle="tab"
                                                            href="#menu1">Verified</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="menu_unverified" data-toggle="tab"
                                                            href="#menu2">Unverified</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2 pt-1">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: {{ $media->count() * 3.3 }}%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div style="display: flex;gap: 15px;">
                                                    <p>{{ $media->count() }}/30</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-img-filter-header">
                                    <div class="row">
                                        <ul class="nav nav-tabs border-0 js_gallery_category">

                                            <li class="nav-item">
                                                <a class="nav-link active" data-type="gallery" data-toggle="tab"
                                                    href="#Gallery">Gallery</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-type="banner" data-toggle="tab"
                                                    href="#Banner">Banner</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="archive-photo-sec">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="pagination-container"></div>
                                        <div id="carouselExampleIndicators" class="carousel slide"
                                            data-bs-wrap="false" data-bs-ride="carousel">

                                            <ul class="pagination ml-2 pl-1">
                                                <!-- Declare the item in the group -->
                                                <li class="page-item preview">
                                                    <!-- Declare the link of the item -->
                                                    <a class="page-link" href="#carouselExampleIndicators"
                                                        id="preId">‹‹</a>

                                                </li>
                                                @for ($i = 0;
                                                        $i <
                                                        ceil(
                                                            collect($media)->whereNotIn('position', [9, 10])->count() / 10,
                                                        );
                                                        $i++)
                                                    <li class="page-item" id="pageItem_{{ $i }}"
                                                        data-id="{{ $i }}">
                                                        <a data-target="#carouselExampleIndicators"
                                                            data-slide-to="{{ $i }}" class="page-link"
                                                            href="#">{{ $i + 1 }}</a>
                                                    </li>
                                                @endfor
                                                <li class="page-item nextOne">
                                                    <a class="page-link" href="#carouselExampleIndicators"
                                                        id="nextId">››</a>
                                                </li>
                                            </ul>
                                            <div class="container pt-2"
                                                style="padding-left: 0.75rem;padding-right: 0.75rem;">
                                                <div class="carousel-inner" id="view_all">
                                                    @foreach (collect($media)->whereNotIn('position', [9, 10])->chunk(10) as $keyId => $images)
                                                        <div class="carousel-item" id="cItem_{{ $loop->index }}"
                                                            data-id="{{ $loop->index }}">
                                                            <div class="grid-container" id="dvSource">
                                                                @foreach ($images as $image)
                                                                    @if (!in_array($image->position, [8]))
                                                                        <div class="item4"
                                                                            id="dm_{{ $image->id }}">
                                                                            <img class="img-thumbnail defult-image ui-draggable"
                                                                                src="{{ asset($image->path) }}"
                                                                                alt=" "
                                                                                data-id="{{ $image->id }}"
                                                                                data-position="{{ $image->position ? $image->position : '' }}">
                                                                            <i class="fa fa-trash deleteimg"
                                                                                data-id="{{ $image->id }}"
                                                                                title="Remove this media"></i>
                                                                            @switch($image->position)
                                                                                @case(9)
                                                                                    <span class="badge badge-red">Banner</span>
                                                                                @break

                                                                                @case(10)
                                                                                    <span class="badge badge-red">Pin Up</span>
                                                                                @break

                                                                                @default
                                                                                    <span
                                                                                        class="badge badge-red">Gallery</span>
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
                </div>
            </div>
        </div>

        <div class="modal" id="photo_gallery_banner" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title" style="color: white;"> <img
                                src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross">
                            Select Banner</h5>
    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs my-custompop-tabs" id="myTab" role="tablist">
    
                            <li class="nav-item">
                                <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload"
                                    role="tab" aria-controls="upload" aria-selected="false">
                                    Uploaded
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="default-tab" data-toggle="tab" href="#default"
                                    role="tab" aria-controls="default" aria-selected="true">
                                    Templates
                                </a>
                            </li>
                        </ul>
                        <div class="modalPopup" style="max-height: 350px; min-height:100px; overflow:auto;">
    
                            <div class="tab-content mt-3">
                                <!-- Tab panes -->
                                <div class="tab-pane fade show active" id="upload" role="tabpanel"
                                    aria-labelledby="upload-tab">
                                    <div id="banner_modal_container" class="modal-tab">
                                        @foreach ($media as $keyId => $image)
                                            @if (!$image->template && in_array($image->position, [9]) /*$image->position != 8*/)
                                                <!-- upload Template Tab -->
                                                <div class="item2">
                                                    <img class="img-thumbnail defult-image select_image"
                                                        src="{{ asset($image->path) }}" alt=" "
                                                        data-id="{{ $image->id }}"
                                                        data-position="{{ $image->position ? $image->position : '' }}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                               

                                {{-- Issko remove nahi karna hai Bhai Log --}}
                                <!-- Templates Tab -->
                                    <div class="tab-pane fade" id="default" role="tabpanel" aria-labelledby="default-tab">

                                        <!-- Nested Tabs (Static) -->
                                        <ul class="sub-nav-tabs nav nav-tabs mt-3">
                                            <li class="nav-item">
                                                <a class="sub-nav nav-link active" data-toggle="tab" href="#bdsm">BDSM</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="sub-nav nav-link" data-toggle="tab" href="#lingerie">Lingerie</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="sub-nav nav-link" data-toggle="tab" href="#passive">Passive</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="sub-nav nav-link" data-toggle="tab" href="#sheets">Sheets</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="sub-nav nav-link" data-toggle="tab" href="#subtle">Subtle</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content mt-3">

                                            <!-- GROUP 1 STATIC -->
                                            <div class="tab-pane fade show active" id="bdsm">
                                                @php  
                                                    $bannerTemplates = getBannerTemplates(1);
                                                @endphp
                                                <div class="modal-tab">
                                                @if(!empty($bannerTemplates))
                                                    @foreach($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}" data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}" class="img-thumbnail defult-image select_image">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>

                                            <!-- GROUP 2 STATIC -->
                                            <div class="tab-pane fade" id="lingerie">
                                                @php  
                                                    $bannerTemplates = getBannerTemplates(2);
                                                @endphp
                                                <div class="modal-tab">
                                                @if(!empty($bannerTemplates))
                                                    @foreach($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}" data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}" class="img-thumbnail defult-image select_image">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>

                                            <!-- GROUP 3 STATIC -->
                                            <div class="tab-pane fade" id="passive">
                                                @php  
                                                    $bannerTemplates = getBannerTemplates(3);
                                                @endphp
                                                <div class="modal-tab">
                                                @if(!empty($bannerTemplates))
                                                    @foreach($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}" data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}" class="img-thumbnail defult-image select_image">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>

                                            <!-- GROUP 4 STATIC -->
                                            <div class="tab-pane fade" id="sheets">
                                                @php  
                                                    $bannerTemplates = getBannerTemplates(4);
                                                @endphp
                                                <div class="modal-tab">
                                                @if(!empty($bannerTemplates))
                                                    @foreach($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}" data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}" class="img-thumbnail defult-image select_image">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>

                                            <!-- GROUP 5 STATIC -->
                                            <div class="tab-pane fade" id="subtle">
                                                @php  
                                                    $bannerTemplates = getBannerTemplates(5);
                                                @endphp
                                                <div class="modal-tab">
                                                @if(!empty($bannerTemplates))
                                                    @foreach($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}" data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}" class="img-thumbnail defult-image select_image">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    {{-- end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade upload-modal" id="upload-sec" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false"
            data-backdrop="static" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"> <img
                                    src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon">
                                Manage Photos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/cross.png') }}"
                                        class="img-fluid img_resize_in_smscreen"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container p-0">
                                        <div class="row pr-2">
                                            <div class="col-4">
                                                <div class="plate"><label class="newbtn">
                                                        <img id="blah1" class="img-fluid"
                                                            src="{{ asset($escort->imagefrontPosition(1)) }}"
                                                            style="width: 300px;height: 308px;object-fit: cover;">
                                                        <input name="img[1]" id="pic1" data-id="1"
                                                            class="pis" onchange="readURL(this);" type="file"
                                                            accept="image/*">
                                                        <input type="hidden" name="position[1]" id="mediaId1">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-8 pl-0">
                                                <div class="row" style="">
                                                    <div class="col-4 pr-0">
                                                        <div class="plate"><label class="newbtn">
                                                                <img id="blah2" class="img-fluid modal-image"
                                                                    src="{{ asset($escort->imagefrontPosition(2)) }}">
                                                                <input name="img[2]" id="pic2" data-id="2"
                                                                    class="pis" onchange="readURL(this);"
                                                                    type="file" accept="image/*">
                                                                <input type="hidden" name="position[2]"
                                                                    id="mediaId2">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 pr-0">
                                                        <div class="plate"><label class="newbtn">
                                                                <img id="blah3" class="img-fluid modal-image"
                                                                    src="{{ asset($escort->imagefrontPosition(3)) }}">
                                                                <input name="img[3]" id="pic3" data-id="3"
                                                                    class="pis" onchange="readURL(this);"
                                                                    type="file" accept="image/*">
                                                                <input type="hidden" name="position[3]"
                                                                    id="mediaId3">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 pr-0">
                                                        <div class="plate"><label class="newbtn">
                                                                <img id="blah4" class="img-fluid modal-image"
                                                                    src="{{ asset($escort->imagefrontPosition(4)) }}">
                                                                <input name="img[4]" id="pic4" data-id="4"
                                                                    class="pis" onchange="readURL(this);"
                                                                    type="file" accept="image/*">
                                                                <input type="hidden" name="position[4]"
                                                                    id="mediaId4">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="">
                                                    <div class="col-4 pr-0">
                                                        <div class="plate"><label class="newbtn">
                                                                <img id="blah5" class="img-fluid modal-image"
                                                                    src="{{ asset($escort->imagefrontPosition(5)) }}">
                                                                <input name="img[5]" id="pic5" data-id="5"
                                                                    class="pis" onchange="readURL(this);"
                                                                    type="file" accept="image/*">
                                                                <input type="hidden" name="position[5]"
                                                                    id="mediaId5">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 pr-0">
                                                        <div class="plate"><label class="newbtn">
                                                                <img id="blah6" class="img-fluid modal-image"
                                                                    src="{{ asset($escort->imagefrontPosition(6)) }}">
                                                                <input name="img[6]" id="pic6" data-id="6"
                                                                    class="pis" onchange="readURL(this);"
                                                                    type="file" accept="image/*">
                                                                <input type="hidden" name="position[6]"
                                                                    id="mediaId6">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 pr-0">
                                                        <div class="plate"><label class="newbtn">
                                                                <img id="blah7" class="img-fluid modal-image"
                                                                    src="{{ asset($escort->imagefrontPosition(7)) }}">
                                                                <input name="img[7]" id="pic7" data-id="7"
                                                                    class="pis" onchange="readURL(this);"
                                                                    type="file" accept="image/*">
                                                                <input type="hidden" name="position[7]"
                                                                    id="mediaId7">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 pt-1" style="border: 1px dotted;">
                                            <div class="col-6 pt-4 pb-4">
                                                <h4>Verify these Photos</h4>
    
                                                <ul style="text-align: justify;">
                                                    <li>Two (2) selfies with your User Name and Membership ID printed
                                                        (can be handwritten) on a sheet of paper held up to the side of
                                                        you and not obscuring any part of you</li>
                                                    <li>A drivers licence which matches your User Name and Home State
                                                    </li>
                                                    <li>A passport which matches your User Name and Home State</li>
                                                </ul>
                                            </div>
                                            <div class="col-6 pt-4">
                                                <div class="plate" style="position: relative;top: 25%;"><label
                                                        class="newbtn">
                                                        {{-- <img class="img-fluid" id="blah8" src="{{ asset('assets/app/img/upload-6.png')}}" style="height: 138px;object-fit: cover;width: 370px;"> --}}
                                                        <img class="img-fluid cl_blash8" id="blah8"
                                                            src="{{ asset($escort->imagefrontPosition(8)) }}"
                                                            style="height: 138px;object-fit: cover;width: 370px;">
                                                        <input id="pic8" class="pis"
                                                            onchange="readURL(this);" type="file"
                                                            accept="image/*">
                                                        <input type="hidden" name="position[8]" id="mediaId8">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-success-modal" id="defaultImg">Use Default</button>
                            <button type="button" class="btn-success-modal" id="manageImgId">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade upload-modal" id="upload-sec-banner" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false"
            data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> <img
                                src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon"> Manage
                            Banner</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/cross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="plate"><label class="newbtn">
                                                    <img id="blah9" class="img-fluid"
                                                        src="{{ asset($escort->imagefrontPosition(9)) }}"
                                                        style="height: 118px;object-fit: cover;width: 618px;">
    
                                                    <input name="img[9]" id="pic9" class="pis"
                                                        onchange="readURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[9]" id="mediaId9">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-success-modal" id="defaultImg2">Use Default</button>
                        <button type="button" class="btn-success-modal" id="manageImgId">Save</button>
                    </div>
                </div>
            </div>
        </div>
        @if (request()->segment(2) == 'profile' && request()->segment(3))
            <div class="row">
                <div class="col-md-12 text-right media-profile">
                    <button id="mediaProfileBtn" type="submit" class="save_profile_btn">Update</button>
                </div>
            </div>
            </form>
        @endif
                {{-- video section start --}}
                <hr>
                @if (request()->segment(2) == 'profile' && request()->segment(3))
                <form id="myProfileMediaVideoForm" name="myProfileMediaVideoForm"
                    action="{{ route('escort.profile.video', [$escort->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @CSRF
            @endif
                <div class="row">
                    <div class="col-md-12">
                <div class="col-md-12 mb-3">    
                    <div class="d-flex justify-content-end">
                        <button id="add_video_button" type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#upload_video_modal">Add Videos</button>
                    </div>
                </div>
            <div class="col-md-12 py-3">
                <div class="video-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="media-head">All Videos</h3>
                        </div>
                        <div class="col-md-2 my-auto">
                            <div class="progress">
                                <div id="js_profile_video_gallery_progressbar" class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-2 my-auto">
                            <div class="d-flex gap-10">
                                <p id="js_profile_video_gallery_count" class="m-0 text-white"></p>
                                <img src="{{ asset('assets/app/img/Vector-2.png')}}" style="height: 21px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="archive-photo-sec">
                    <div class="row blog">
                        <div id="js_profile_video_gallery" class="col-md-12">
                           
                            <!--.Carousel-->
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 my-4">
                <div class="upload-photo-sec">
                    <div class="d-sm-flex align-items-center justify-content-between p-3 custom-img-filter-header">
                        <h4 class="text-white">Default Video</h4>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-lg-4">
                            <label class="newbtn videoDroppable w-100" id="videoDroppable_1">
                                <video class="videoUp" id="img1" controls=""  controls poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                                    <source id=""  type="video/mp4" >
                                </video>
                                <input  type="hidden"  id="pos_1" name="video_position[1]" value="">
                            </label>
                        </div>
        
                        <div class="col-lg-4">
                            <label class="newbtn videoDroppable w-100" id="videoDroppable_2">
                                <video class="videoUp" id="img2" controls="" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                                    <source id="" type="video/mp4" >
                                </video>
                                <input  type="hidden"  id="pos_2" name="video_position[2]" value="">
                            </label>
                        </div>
        
                       <div class="col-lg-4">
                        <label class="newbtn videoDroppable w-100" id="videoDroppable_3">
                            <video class="videoUp" id="img3" controls="" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                                <source id="" type="video/mp4" >
                            </video>
                            <input  type="hidden"  id="pos_3" name="video_position[3]" value="">
                        </label>
                       </div>
                    </div>
                </div>
            </div>
            {{-- end video section --}}
            </div>
        </div>
        @if (request()->segment(2) == 'profile' && request()->segment(3))
            <div class="row">
                <div class="col-md-12 text-right media-profile">
                    <button id="mediaProfileVideoBtn" type="submit" class="save_profile_btn">Update</button>
                </div>
            </div>
            </form>
        @endif
    </div>
      <!-- ########## End Photos Tab #################    -->




      {{-- about us--}}
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="fill_profile_headings_global mb-3">
            <h2>About Us</h2>
         </div>
         <div class="">
            <div class="card" style="border: #90A0B7 solid 0px;padding: 0;margin-top: -10px;">
               <div>
                  <div class="card-body p-0">
                     <div>
                        <!-- upload video  -->
                        <div class="about_me_drop_down_info ">

                              <div class="business-info-field pt-3">
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">
                                       Building<span style="color:red">*</span>
                                    </label>                                       
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="" name="building" required="">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Building') as $key =>$buldingName)
                                       <option value="{{$key}}" {{ ($escort->building == $key)? 'selected' : ''}}>{{$buldingName}}</option>
                                       @endforeach
                                    </select>
                                    
                                 </div>
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Parking</label>
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="parking" name="parking">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Parking') as $key =>$ParkingName)
                                       <option value="{{$key}}" {{ ($escort->parking == $key)? 'selected' : ''}} >{{$ParkingName}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Entry</label>
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="entry" name="entry">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Entry') as $key =>$EntryName)
                                       <option value="{{$key}}" {{ ($escort->entry == $key)? 'selected' : ''}}>{{$EntryName}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Type</label>
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="Type" name="furniture_types">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.furniture_types') as $key =>$furniture_type)
                                       <option value="{{$key}}" {{ ($escort->furniture_types == $key)? 'selected' : ''}} >{{$furniture_type}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">
                                    Shower</label>
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="" name="shower">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Shower') as $key =>$Type)
                                       <option value="{{$key}}" {{ ($escort->shower == $key)? 'selected' : ''}} >{{$Type}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Ambiance</label>
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="ambiance" name="ambiance">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Ambiance') as $key =>$AmbianceName)
                                       <option value="{{$key}}" {{ ($escort->ambiance == $key)? 'selected' : ''}} >{{$AmbianceName}}</option>
                                       @endforeach
                                    </select>
                                 </div>

                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Security</label>
                                    
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="security" name="security">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Security') as $key =>$SecurityName)
                                       <option value="{{$key}}" {{ ($escort->security == $key)? 'selected' : ''}} data-name="{{$SecurityName}}">{{$SecurityName}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Payment</label>                                       
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="payment" name="payment">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Payments') as $key =>$PaymentType)
                                       <option value="{{$key}}" {{ ($escort->payment == $key)? 'selected' : ''}} data-name="{{$PaymentType}}">{{$PaymentType}}</option>
                                       @endforeach>
                                    </select>
                                    @if(!empty($escort->payment)) 
                                    <div class='select_pay'>
                                          <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.payments.$escort->payment") !!}</span>
                                    </div>
                                    @endif                                      
                                    <div class="col-sm-12">                                       
                                          <div id="show_payment_type" style="display:none">
                                             <div class='select_pay' style='display: inline-block'>
                                                <span class='languages_choosed_from_drop_down'> </span>
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Loyalty program
                                    </label>
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="loyalty" name="loyalty">
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.Loyalty') as $key =>$LoyaltyType)
                                       <option value="{{$key}}" {{ ($escort->loyalty == $key)? 'selected' : ''}} >{{$LoyaltyType}}</option>
                                       @endforeach>
                                    </select>
                                 </div>

                                 <div class="form-group business-field">
                                    <label for="exampleFormControlSelect1">Languages
                                    </label>
                                    
                                    <select class="change_default form-control form-control-sm select_tag_remove_box_sadow" id="language" >
                                       <option value="" selected="">-- Not Set --</option>
                                       @foreach(config('escorts.profile.languages') as $key =>$language)
                                       <option value="{{$key}}"  @if(!empty($massage_profile->language)) @if(in_array($key ,$escort->language)) selected @endif @endif data-name="{{ $language }}">{{$language}}</option>
                                       @endforeach>
                                    </select>
                                    <div id="show_language">
                                       <div class='selecated_languages'>
                                          @if(!empty($escort->language)) 
                                          @foreach($escort->language as $language)
                                          <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!}<small class="remove-lang">×</small></span>
                                          <input type='hidden' name='language[]' value="{{$language}}">
                                          @endforeach
                                          @endif
                                       </div>
                                       <div id="container_language">
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
      {{-- who are we --}}
      <div class="about_me_drop_down_info profile-sec p-4">
         <div class="fill_profile_headings_global">
            <h2>Who are We ?</h2>
         </div>
         <div class="padding_20_all_side">
            <input type="text" name="about_title" id="about_title" value="{{$escort->about_title ? $escort->about_title : null }}" class="whoiamtitle mc-whoiam-title mb-1" placeholder="Enter Your Title Here" required data-tab="group_one" >
               <div class="row mt-3">
                  <div class="col-12">
                     <textarea id="about_us_box" name="about_us_box"  required>@if(!empty($escort->about)) {{ $escort->about}} @endif</textarea>
                     <span class="theme-text-color text-capitalize">max limit 2500 characters</span>
                     <div id="about_me_error"></div>
                  </div>
               
               </div>

               {{-- <div class="row pt-3">
                  <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                        <button id="update_who_am_i" type="button" class="save_profile_btn who_am_i">Update</button>
                  </div>
               </div> --}}
      </div>

      </div>
      <div class="tab_btm_btns_preview_and_next py-3">
         <div class="row pt-3 pb-2">
            <div class="col-md-12 text-right mb-2 a_text_white_hover">

            
               <a class="nex_sterp_btn" id="profile-tab_next" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="profile" aria-selected="false">              
                  Next Step <i class="fas fa-arrow-right"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
   
<div class="modal fade upload-modal" id="upload-sec" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width: 800px;position: absolute;">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle"> <img class="custompopicon" src="{{  asset('assets/dashboard/img/upload-photos.png') }}"> Manage Photos</h5>               

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="container p-0">
                        <div class="row pr-2 modal_inner_area">
                           <div class="col-4 full_pic">
                              <div class="plate"><label class="newbtn">
                                 <img id="blah1" class="img-fluid" src="{{ asset($escort->imagefrontPosition(1))  }}" style="width: 171px;object-fit: cover;height: 308px;">
                                 <input name="img[1]" id="pic1" data-id="1" class="pis" onchange="readURL(this);" type="file">
                                 <input type="hidden" name="position[]" id="mediaId1">
                                 </label>
                              </div>
                           </div>
                           <div class="col-8 pl-0">
                              <div class="row" style="">
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah2" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(2))   }}">
                                       <input name="img[2]" id="pic2" data-id="2" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId2">    
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah3" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(3))   }}">
                                       <input name="img[3]" id="pic3" data-id="3" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId3">
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah4" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(4))   }}">
                                       <input name="img[4]" id="pic4" data-id="4" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId4">
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="row" style="">
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah5" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(5))   }}">
                                       <input name="img[5]" id="pic5" data-id="5" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId5">
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah6" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(6))   }}">
                                       <input name="img[6]" id="pic6" data-id="6" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId6">
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn">
                                       <img id="blah7" class="img-fluid modal-image" src="{{ asset($escort->imagefrontPosition(7)) }}">
                                       <input name="img[7]" id="pic7" data-id="7" class="pis" onchange="readURL(this);" type="file">
                                       <input type="hidden" name="position[]" id="mediaId7">
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row pt-1 varify_box" style="border: 1px dotted;">
                           <div class="col-6 pt-4 pb-4">
                              <h4>Verify these photos</h4>
                              <p>Upload a picture of your ID with your most recent photo for verification.</p>
                           </div>
                           <div class="col-6">
                              <div class="plate"><label class="newbtn">
                                 <img class="img-fluid" id="blah8" src="{{ asset($escort->imagefrontPosition(8)) }}" style="height: 138px;object-fit: cover;width: 370px;">
                                 <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readURL(this);" type="file">
                                 <input type="hidden" name="position[]" id="mediaId8">
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn-success-modal" id="defaultImg">Use Default</button>
               <button type="button" class="btn-success-modal" id="manageImgId">Save</button>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade upload-modal" id="upload-sec-banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" style="color: white;" id="exampleModalLongTitle"> <img src="{{ asset('assets/dashboard/img/banner.png')}}" class="custompopicon">Manage Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="container p-0">
                     <div class="row">
                        <div class="col-12">
                           <div class="plate"><label class="newbtn">
                              <img id="blah9" class="img-fluid" src="{{ asset($escort->imagefrontPosition(9)) }}" style="height: 118px;object-fit: cover;width: 618px;">
                              <input name="img[9]" id="pic9" class="pis" onchange="readURL(this);" type="file">
                              <input type="hidden" name="position[]" id="mediaId9">
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="row mt-3" style="border: 1px dotted;">
                        <div class="col-6 pt-4 pb-4">
                           <h4>Verify these photos</h4>
                           <p>Upload a picture of your ID with your most recent photo for verification.</p>
                        </div>
                        <div class="col-6">
                           <div class="plate"><label class="newbtn">
                              <img class="img-fluid" id="blah0" src="{{  asset($escort->imagefrontPosition(10)) }}" style="height: 138px;object-fit: cover;width: 291px;">
                              <input name="img[10]" id="pic0" class="pis" onchange="readURL(this);" type="file">
                              <input type="hidden" name="position[]" id="mediaId10">
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn-success-modal" id="defaultImg2">Use Default</button>
            <button type="button" class="btn-success-modal" id="manageImgId">Save</button>
         </div>
      </div>
   </div>
</div>






<div class="modal" id="photo_gallery" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" style="color: white;"><img
                        src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon"> Select Photo
                </h5>
                <div class="uploadModalTrigger" style="display: inline-block;position: absolute;right: 200px;">
                    <button type="button" data-toggle="modal" data-target="empty" class="btn-cancel-modal"
                        style=" padding: 5px 10px;">Upload from device</button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div id="gallery_modal_container" class="grid-container modalPopup"
                    style="max-height: 500px; overflow-y:scroll;">

                    @foreach ($media as $keyId => $image)
                        @if (!in_array($image->position, [9, 10]))
                            <div class="item4">
                                <img class="img-thumbnail defult-image select_image"
                                    src="{{ asset($image->path) }}" alt=" "
                                    data-id="{{ $image->id }}"
                                    data-position="{{ $image->position ? $image->position : '' }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal programmatic" id="setAsDefaultForMainAccount" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img
                        src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon">Update Media
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body">
                Would you like to update Media in your My Information page for future Profiles?
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                        id="close_change">No</button>
                    <button type="button" class="btn-success-modal" onclick="setAsDefultImages()">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   
   function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();
           
           reader.onload = function (e) {
               $('#blah'+input.id[3])
                   .attr('src', e.target.result);
               
           };
   
           reader.readAsDataURL(input.files[0]); 
           
       }
       $("body").on('click','#manageImgId',function(e){
           var src = $("#blah"+input.id[3]).attr('src');
           $('#img'+input.id[3])
                   .attr('src', src);
           $("#upload-sec").modal('hide');
           console.log("file = "+input.id[3]);
       })
           
   }

   
</script>
<style>
   .pis{
   display: none;
   }
   .newbtn{
   cursor: pointer;
   }
</style>