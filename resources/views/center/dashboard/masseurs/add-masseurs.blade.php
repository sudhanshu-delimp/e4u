@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">


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

.pis {
    display: none;
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

.gal-thumb{
    width: 149px !important;
    height: 138px !important;
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
                        <h1 class="h1">Add New Masseur</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
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


               

                <div class="row">
                    <div class="col-lg-12">
                        <div class="add-mcc-section">
                            
                        
                            <form id="masseur_frm" name="masseur_frm"  method="Post">
               
                                    <!-- About The Masseur -->
                                    <div class="mcc-form-tab">
                                        <h2 class="mcc-heading">About The Masseur</h2>
                                        <div class="business-info-field pt-4">
                                            <!-- Personal Info -->
                                            <div class="form-group business-field">
                                                <label for="name" class="mb-1">Name</label>
                                                <input type="text" id="name" name="name"  class="form-control rounded-0"
                                                    placeholder="Enter Name" required>
                                            </div>
                                            <div class="form-group business-field">
                                                <label for="stage_name" class="mb-1">Stage Name</label>
                                                <input type="text" id="stage_name" name="stage_name" class="form-control rounded-0"
                                                    placeholder="Enter Stage Name" required>
                                            </div>
                                            <div class="form-group business-field">
                                                <label for="mobile" class="mb-1">Mobile</label>
                                                <input type="text" id="mobile" name="mobile" class="form-control rounded-0"
                                                    placeholder="Enter Mobile" required>
                                            </div>


                                            <div class="form-group business-field">
                                                <label for="nationality" class="mb-1">Nationality</label>
                                                    @php
                                                        $countrys = getCountryList();
                                                    @endphp
                                                <select id="nationality" name="nationality" class="form-control rounded-0" required>
                                                    <option value="">-Not Set-</option>
                                                    @if (count($countrys) > 0)
                                                        @foreach ($countrys as $ckey => $cname)
                                                            <option value="{{ old('nationality_id', $ckey) }}">{{ $cname }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>


                                            <div class="form-group business-field">
                                                <label for="ethnicity" class="mb-1">Ethnicity</label>
                                                <select id="ethnicity" name="ethnicity" class="form-control rounded-0" required>
                                                    <option value="">-Not Set-</option>
                                                    @foreach (config('escorts.profile.ethnicities') as $key => $ethnicity)
                                                        <option value="{{ $key }}"> {{ $ethnicity }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group business-field">
                                                <label for="age" class="mb-1">Age</label>
                                                <input type="text" id="age" name="age" data-type="number" data-regex="^(1[89]|[2-9][0-9])$"  data-min="18" data-max-length="2" data-label="Age" class="form-control rounded-0"
                                                    placeholder="Enter Age" required>
                                            </div>

                                            <div class="form-group">
                                                    <label class="label">Vaccination</label>
                                                    <div class="d-flex justify-content-start gap-10">
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                    type="radio"
                                                                    name="vaccination"
                                                                    value="1"
                                                                    required
                                                                    data-label="Vaccination">
                                                                <label class="form-check-label">
                                                                    Vaccinated, not up to date
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                    type="radio"
                                                                    name="vaccination"
                                                                    value="2">
                                                                <label class="form-check-label">
                                                                    Vaccinated, up to date
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                    type="radio"
                                                                    name="vaccination"
                                                                    value="3">
                                                                <label class="form-check-label">
                                                                    Not Vaccinated
                                                                </label>
                                                            </div>
                                                    </div>
                                                </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">                                                
                                            <!-- Commentary -->
                                            <div class="form-group">
                                                <label for="commentary" class="label">Commentary</label>
                                                <textarea id="commentary" name="commentary" class="form-control rounded-0" placeholder="Commentary (max 300 words)" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End About The Masseur -->

                                    <!-- Media -->
                                    {{-- media --}}
                                    <div class="mcc-form-tab">
                                        <h2 class="mcc-heading">Media</h2>
                                        <div class="row">
                                            <div class="col-md-12 my-3 d-flex justify-content-end">
                                                <button type="button" class="create-tour-sec dctour" data-toggle="modal"
                                                    data-target="#add_photo_mcc">Add Photos</button>
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
                                                        <div class="col-sm-12">
                                                            <h4 class="banner-sub-heading my-2">Thumbnail</h4>
                                                            <div class="plate">
                                                                <label class="newbtn" data-toggle="modal"
                                                                    data-target="#photo_gallery">
                                                                    <img class="w-100" id="img1"
                                                                        src="{{ asset('assets/app/img/mcc-default-thumbnail.png') }}" onclick="positionToUpdate(1)">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <h4 class="banner-sub-heading my-2">Gallery Images</h4>
                                                                </div>
                                                                <div class="col-sm-12 d-flex align-item-center gap-10">
                                                                    <div class="plate">
                                                                        <label class="newbtn" data-toggle="modal"
                                                                            data-target="#photo_gallery">
                                                                            <img class="w-100 gal-thumb"
                                                                                id="img2"src="{{ asset('assets/app/img/frame-main-thum.png') }}" onclick="positionToUpdate(2)">
                                                                        </label>
                                                                    </div>
                                                                    <div class="plate">
                                                                        <label class="newbtn" data-toggle="modal"
                                                                            data-target="#photo_gallery">
                                                                            <img class="w-100 gal-thumb"
                                                                                id="img3"src="{{ asset('assets/app/img/frame-main-thum.png') }}" onclick="positionToUpdate(3)">
                                                                        </label>
                                                                    </div>
                                                                    <div class="plate">
                                                                        <label class="newbtn" data-toggle="modal"
                                                                            data-target="#photo_gallery">
                                                                            <img class="w-100 gal-thumb"
                                                                                id="img4"src="{{ asset('assets/app/img/frame-main-thum.png') }}" onclick="positionToUpdate(4)">
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                    <div class="col-lg-8 col-sm-12" id="js_profile_media_gallery">
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
                                                                    <!-- <li class="nav-item">
                                                                        <a class="nav-link" id="menu_varified" data-toggle="tab"
                                                                            href="#menu1">Verified</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="menu_unverified" data-toggle="tab"
                                                                            href="#menu2">Unverified</a>
                                                                    </li> -->
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
                                                            <!-- <li class="nav-item">
                                                                <a class="nav-link" data-type="banner" data-toggle="tab"
                                                                    href="#Banner">Banner</a>
                                                            </li> -->
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
                                                            
                                                                <li class="page-item nextOne">
                                                                    <a class="page-link" href="#carouselExampleIndicators"
                                                                        id="nextId">››</a>
                                                                </li>
                                                            </ul>
                                                            <div class="container pt-2"
                                                                style="padding-left: 0.75rem;padding-right: 0.75rem;">
                                                                <div class="carousel-inner" id="view_all">
                                                                    
                                                                </div>
                                                                <!--.Carousel-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                                            <!-- <div class="col-lg-8 col-sm-12">
                                                                <div class="photo-top-header">
                                                                    <div class="photo-top-header">
                                                                        <div class="photo-header custom-photo-header">
                                                                            <div class="modal-header border-0 p-0"
                                                                                style="display: block;position: relative;top: 30%;">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <ul class="nav nav-tabs border-0">
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link active" id="menu_all"
                                                                                                    data-toggle="tab" href="#home">All</a>
                                                                                            </li>
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link" id="menu_varified"
                                                                                                    data-toggle="tab"
                                                                                                    href="#menu1">Verified</a>
                                                                                            </li>
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link" id="menu_unverified"
                                                                                                    data-toggle="tab"
                                                                                                    href="#menu2">Unverified</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="col-md-2 pt-1">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar bg-success"
                                                                                                role="progressbar" style="width: 100%"
                                                                                                aria-valuenow="16.16" aria-valuemin="0"
                                                                                                aria-valuemax="100"></div>
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


                                                                <div class="archive-photo-sec upload-6-img-mcc">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="grid-container p-2" id="dvSource">
                                                                                <div class="default-img-mcc">
                                                                                    <img class="img-thumbnail defult-image ui-draggable"
                                                                                        src="{{ asset('assets/app/img/banner/mcc1.jpg') }}"
                                                                                        alt="default-img-mcc">
                                                                                    <i class="fa fa-trash deleteimg"
                                                                                        title="Remove this media"></i>
                                                                                    <span class="badge badge-red">Gallery</span>
                                                                                </div>

                                                                                <div class="default-img-mcc">
                                                                                    <img class="img-thumbnail defult-image ui-draggable"
                                                                                        src="{{ asset('assets/app/img/banner/mcc2.jpg') }}"
                                                                                        alt="default-img-mcc">
                                                                                    <i class="fa fa-trash deleteimg"
                                                                                        title="Remove this media"></i>
                                                                                    <span class="badge badge-red">Gallery</span>
                                                                                </div>

                                                                                <div class="default-img-mcc">
                                                                                    <img class="img-thumbnail defult-image ui-draggable"
                                                                                        src="{{ asset('assets/app/img/banner/mcc3.jpg') }}"
                                                                                        alt="default-img-mcc">
                                                                                    <i class="fa fa-trash deleteimg"
                                                                                        title="Remove this media"></i>
                                                                                    <span class="badge badge-red">Gallery</span>
                                                                                </div>

                                                                                <div class="default-img-mcc">
                                                                                    <img class="img-thumbnail defult-image ui-draggable"
                                                                                        src="{{ asset('assets/app/img/banner/mcc4.jpg') }}"
                                                                                        alt="default-img-mcc">
                                                                                    <i class="fa fa-trash deleteimg"
                                                                                        title="Remove this media"></i>
                                                                                    <span class="badge badge-red">Gallery</span>
                                                                                </div>

                                                                                <div class="default-img-mcc">
                                                                                    <img class="img-thumbnail defult-image ui-draggable"
                                                                                        src="{{ asset('assets/app/img/banner/mcc5.jpg') }}"
                                                                                        alt="default-img-mcc">
                                                                                    <i class="fa fa-trash deleteimg"
                                                                                        title="Remove this media"></i>
                                                                                    <span class="badge badge-red">Gallery</span>
                                                                                </div>

                                                                                <div class="default-img-mcc">
                                                                                    <img class="img-thumbnail defult-image ui-draggable"
                                                                                        src="{{ asset('assets/app/img/banner/mcc6.jpg') }}"
                                                                                        alt="default-img-mcc">
                                                                                    <i class="fa fa-trash deleteimg"
                                                                                        title="Remove this media"></i>
                                                                                    <span class="badge badge-red">Gallery</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->


                                                        </div>
                                                    </div>
                                                    <!-- End Media -->


                                                    <!-- My Availability -->
                                                    <div class="mcc-form-tab">
                                                            
                                                                <h2>My Availability</h2>   
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="padding_20_all_side my-availability-mon profile_time_availibility">

                                                                            @php
                                                                                $days = [
                                                                                    'monday' => 'Monday',
                                                                                    'tuesday' => 'Tuesday',
                                                                                    'wednesday' => 'Wednesday',
                                                                                    'thursday' => 'Thursday',
                                                                                    'friday' => 'Friday',
                                                                                    'saturday' => 'Saturday',
                                                                                    'sunday' => 'Sunday',
                                                                                ];
                                                                            @endphp

                                                                            @foreach ($days as $dayKey => $dayLabel)
                                                                                <div class="d-flex align-items-center flex-wrap gap-20 my-3 parent-row" data-day="{{ $dayKey }}">
                                                                                    
                                                                                    <label style="width:100px;"><strong>{{ $dayLabel }}:</strong></label>

                                                                                    <!-- FROM -->
                                                                                    <select name="time[{{ $dayKey }}][hh_from]" class="time-field">
                                                                                        <option value="">H:M</option>
                                                                                        @for ($i = 1; $i <= 12; $i++)
                                                                                            <option value="{{ sprintf('%02d',$i) }}:00">{{ sprintf('%02d',$i) }}:00</option>
                                                                                            <option value="{{ sprintf('%02d',$i) }}:30">{{ sprintf('%02d',$i) }}:30</option>
                                                                                        @endfor
                                                                                    </select>

                                                                                    <select name="time[{{ $dayKey }}][ampm_from]" class="time-field">
                                                                                        <option value="">--</option>
                                                                                        <option value="AM">AM</option>
                                                                                        <option value="PM">PM</option>
                                                                                    </select>

                                                                                    <span class="mx-2">To</span>

                                                                                    <!-- TO -->
                                                                                    <select name="time[{{ $dayKey }}][hh_to]" class="time-field">
                                                                                        <option value="">H:M</option>
                                                                                        @for ($i = 1; $i <= 12; $i++)
                                                                                            <option value="{{ sprintf('%02d',$i) }}:00">{{ sprintf('%02d',$i) }}:00</option>
                                                                                            <option value="{{ sprintf('%02d',$i) }}:30">{{ sprintf('%02d',$i) }}:30</option>
                                                                                        @endfor
                                                                                    </select>

                                                                                    <select name="time[{{ $dayKey }}][ampm_to]" class="time-field">
                                                                                        <option value="">--</option>
                                                                                        <option value="AM">AM</option>
                                                                                        <option value="PM">PM</option>
                                                                                    </select>

                                                                                    <!-- DEFAULT STATUS -->
                                                                                    <input type="hidden" name="availability_time[{{ $dayKey }}]" value="custom">

                                                                                    <!-- STATUS RADIOS -->
                                                                                    <label class="ms-3">
                                                                                        <input type="radio" name="availability_time[{{ $dayKey }}]" value="til_late">
                                                                                        … Till late
                                                                                    </label>

                                                                                    <label class="ms-2" style="display: none;">
                                                                                        <input type="radio" name="availability_time[{{ $dayKey }}]" value="24_hours" >
                                                                                        Open 24 Hours
                                                                                    </label>

                                                                                    <label class="ms-2">
                                                                                        <input type="radio" name="availability_time[{{ $dayKey }}]" value="closed" checked="true">
                                                                                        Closed
                                                                                    </label>

                                                                                    

                                                                                    <div class="resetdays-icon"> <input type="button" value="Reset" class="resetdays"> </div>
                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                </div>              
                                            
                                                    </div>
                                                    <!-- End My Availability -->                           


                                                    <!-- Rate -->               
                                                    <div class="mcc-form-tab">
                                                        <h2>Rate</h2>
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates pt-5">
                                                                    <div class="rate_first_row row">
                                                                        <div class="col-3">
                                                                        </div>
                                                                        <div class="col-3 rate-img-center rate-tooltip">
                                                                            <img src="{{asset('assets/dashboard/img/massage-only.png')}}" class="w-50">
                                                                            <span class="tooltip-info">Massage only</span>
                                                                        </div>
                                                                        <div class="col-3 rate-img-center rate-tooltip">
                                                                            <img src="{{asset('assets/dashboard/img/massage-with2.png')}}" class="w-50">
                                                                            <span class="tooltip-info">Massage with Extras, 2 hands.</span>
                                                                        </div>
                                                                        <div class="col-3 rate-img-center rate-tooltip">
                                                                            <img src="{{asset('assets/dashboard/img/massage-with4.png')}}" class="w-50">
                                                                            <span class="tooltip-info">Massage with Extras, 2 hands.</span>
                                                                        </div>
                                                                    </div>
                                                                    @foreach($durations->whereIn('id',[2,3,4,5,6]) as $duration)

                                                                    @php
                                                                    if($duration->id!="")
                                                                    {
                                                                        $massage_price = $incall_price = $outcall_price =  $massage_profile_id = "";
                                                                        if(!empty($massage_durations))
                                                                        {
                                                                            foreach($massage_durations as $db_duration)  
                                                                            {
                                                                                if(isset($db_duration['pivot']['duration_id']) && $db_duration['pivot']['duration_id']==$duration->id)
                                                                                {
                                                                                    
                                                                                    $massage_price = isset($db_duration['pivot']['massage_price']) ? $db_duration['pivot']['massage_price'] : 0;
                                                                                    $incall_price =  isset($db_duration['pivot']['incall_price']) ? $db_duration['pivot']['incall_price'] : 0;
                                                                                    $outcall_price = isset($db_duration['pivot']['outcall_price']) ? $db_duration['pivot']['outcall_price'] : 0;
                                                                                    $massage_profile_id = isset($db_duration['pivot']['massage_profile_id']) ? $db_duration['pivot']['massage_profile_id'] : "";

                                                                                    
                                                                                    break;
                                                                                    
                                                                                } 
                                                                            }   
                                                                        }
                                                                    }
                                                                    
                                                                    
                                                                    
                                                                    @endphp

                                                                    <div class="rate_first_row">
                                                                        <input type="hidden" name="duration_id[]" value="{{ $duration->id}}">
                                                                        <div class="form-group row">
                                                                            <label class="col-3 label" for="exampleFormControlSelect1">{{ $duration->name == "1 Hour" ? '1 Hour' :  $duration->name}} : </label>
                                                                            <div class="col-3">
                                                                                <div class="service_rate_dolor_symbol form-group">
                                                                                    <span>$</span>
                                                                                    <input  placeholder="0" data-duration_id="{{$duration->id}}" data-massage_profile_id="{{$massage_profile_id}}"  data-data_type="massage_price" type="text"  class="form-control allow_only_numeric update_default_rate" id="massage_price" value="{{$massage_price}}" name="massage_price[]">
                                                                                    <input type="hidden" class="profile_massage_price"  value="{{$massage_price}}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <div class="service_rate_dolor_symbol form-group">
                                                                                    <span>$</span>
                                                                                    <input  placeholder="0" data-duration_id="{{$duration->id}}" data-massage_profile_id="{{$massage_profile_id}}"  data-data_type="incall_price"  type="text"  class="form-control allow_only_numeric update_default_rate" id="incall_price" value="{{$incall_price}}" name="incall_price[]">
                                                                                    <input type="hidden" class="profile_incall_price"  value="{{$incall_price}}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <div class="service_rate_dolor_symbol form-group">
                                                                                    <span>$</span>
                                                                                    <input  placeholder="0" data-duration_id="{{$duration->id}}"  data-massage_profile_id="{{$massage_profile_id}}"  data-data_type="outcall_price"   type="text"  class="form-control allow_only_numeric update_default_rate" id="outcall_price"  value="{{$outcall_price}}" name="outcall_price[]">
                                                                                    <input type="hidden" class="profile_outcall_price"  value="{{$outcall_price}}" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- End Rate -->                              


                                                    <div class="d-flex justify-content-end py-3">
                                                        <input type="hidden" name="page_token" id="page_token"  value="{{$page_token}}">
                                                        <button type="button" id="submitMasseur" class="btn-common">Create Masseur</button>
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
                                                                                                            
                                                                                                            <input name="img[4]" id="pic4" data-id="4"
                                                                                                                class="pis" onchange="readURL(this);"
                                                                                                                type="file" accept="image/*">
                                                                                                            <input type="hidden" name="position[4]"
                                                                                                                id="mediaId4">
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
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


                                            
                                                    
                                            </form>


                                        </div>
                                    </div>


                    
                </div>

                
            </div>
        </div>
    </div>




<div class="modal fade upload-modal" id="add_photo_mcc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 900px;position: absolute;">
            <form id="mulitiImage" method="POST" action="{{route('center.massuers-media-upload-gallery')}}" enctype="multipart/form-data">
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
                            <div class="col-lg-12">
                                 <label class="newbtn rm">
                                    
                                            <img id="blah" class="item" src="{{ asset('assets/app/img/add-images.png')}}">
                                            
                                            <input name="img[]" id="upload_file" class="pis" onchange="preview_image(event);" type="file" multiple accept="image/*">
                                        </label>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="photo-sec-popup custom-upload-photo"  id="image_preview">
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                    <input type="hidden" name="page_token" id="page_token"  value="{{$page_token}}">
                      <button type="submit" class="btn-success-modal">Verify Media</button>
                        <button type="submit" class="btn-success-modal">Upload</button>
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

                    <!-- @foreach ($media as $keyId => $image)
                        @if (!in_array($image->position, [9, 10]))
                            <div class="item4">
                                <img class="img-thumbnail defult-image select_image"
                                    src="{{ asset($image->path) }}" alt=" "
                                    data-id="{{ $image->id }}"
                                    data-position="{{ $image->position ? $image->position : '' }}">
                            </div>
                        @endif
                    @endforeach -->
                </div>
            </div>

        </div>
    </div>
</div>

    

<div class="modal programmatic" id="update_info" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content custome_modal_max_width">
         <div class="modal-header main_bg_color border-0">
            <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img src="{{ asset('assets/dashboard/img/save-info.png') }}" class="custompopicon"> Update My Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png') }}"
               class="img-fluid img_resize_in_smscreen">
            </span>
            </button>
         </div>
         <div class="modal-body">

            <form name="update_single_data" method="post" action="{{route('center.update-single-data')}}">
            <input type="hidden" name="post_field" id="post_field" value="">
            <input type="hidden" name="post_value" id="post_value" value="">

             <input type="hidden" name="post_json" id="post_json" value="">
            <input type="hidden" name="post_type" id="post_type" value="">
                
                <h3 class="my-2"><span id="Lname"><p>Would you like to update <b>
                                <span id="field_name"></span>       
                </b> in your 'My Information' page for future Profiles?</p></span> </h3>
                <div class="modal-footer">
                <button type="button" class="btn-cancel-modal gender_alert" data-dismiss="modal"
                    value="close" id="close_change">No</button>
                <button type="button" class="btn-success-modal" id="update_new_value">Yes</button>
                </div>
            </form>


         </div>
      </div>
   </div>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>


<script>
////////////// For Our Open Times ///////////////// 

    function validateAvailability() 
    {

                let isFormValid = true;

                $('.profile_time_availibility .parent-row').each(function () {

                let row = $(this);

                let status = row.find('input[type="radio"]:checked').val() || '';

                let fromHH   = row.find('select[name*="[hh_from]"]').val();
                let fromAMPM = row.find('select[name*="[ampm_from]"]').val();
                let toHH     = row.find('select[name*="[hh_to]"]').val();
                let toAMPM   = row.find('select[name*="[ampm_to]"]').val();

                row.removeClass('border border-danger');

                let hasFrom = fromHH && fromAMPM;
                let hasTo   = toHH && toAMPM;


                if (!status && !hasFrom && !hasTo) {
                isFormValid = false;
                row.addClass('border border-danger');
                return;
                }


                if (status === 'til_late' && !hasFrom) {
                isFormValid = false;
                row.addClass('border border-danger');
                return;
                }


                if (!status && hasFrom && !hasTo) {
                isFormValid = false;
                row.addClass('border border-danger');
                return;
                }

                if (status === '24_hours' || status === 'closed') {
                return;
                }
                });

                console.log('isFormValid', isFormValid);
                if (!isFormValid) {
                return true;
                }
                return false;

    }

    function getRow(row) 
    {
            return {
                from: row.find('select[name*="[hh_from]"], select[name*="[ampm_from]"]'),
                to: row.find('select[name*="[hh_to]"], select[name*="[ampm_to]"]'),
                radios: row.find('input[type="radio"]')
            };
    }


    $('.profile_time_availibility').on('change', 'input[type="radio"]', function () {

        let row = $(this).closest('.parent-row');
        let val = $(this).val();
        let { from, to } = getRow(row);

        if (val === 'til_late') {
            from.prop('disabled', false);
            to.val('').prop('disabled', true);
        } else {
            from.val('').prop('disabled', true);
            to.val('').prop('disabled', true);
        }
    });


    $('.profile_time_availibility').on(
        'change',
        'select[name*="[hh_from]"], select[name*="[ampm_from]"]',
        function () {

            let row = $(this).closest('.parent-row');
            let { from, to, radios } = getRow(row);

            radios.prop('checked', false);   // uncheck radios
            from.prop('disabled', false);
            to.prop('disabled', false);
        }
    );

    $('.profile_time_availibility .parent-row').each(function () {

        let row = $(this);
        let checked = row.find('input[type="radio"]:checked').val();
        let { from, to } = getRow(row);

        if (checked === 'til_late') {
            from.prop('disabled', false);
            to.prop('disabled', true);
        } else {
            from.prop('disabled', true);
            to.prop('disabled', true);
        }

    });
                
              
            
           

    ////////////// End For Our Open Times ///////////////// 

       
    $(function(e) 
    {

        //// ----------- Update Single Data ------------ ///////
        $('.update_default_rate').on('blur', function () {

                var duration_id  = $(this).data('duration_id');
                var massage_profile_id  = $(this).data('massage_profile_id');
                var data_type  = $(this).data('data_type');


                var current_value  = $(this).val();
                var current_feild  = $(this).attr('id');

                var current_old_input = 'profile_'+current_feild;
                var old_value  =  $(this).closest('.service_rate_dolor_symbol').find('.'+current_old_input).val();

               
            
                if(current_value==="")
                return false;    


                if (current_value !== old_value) {

                let postData = {
                    duration_id: duration_id,
                    massage_profile_id: massage_profile_id,
                    data_type: data_type,
                    new_value: current_value
                }

                $('#post_json').val(JSON.stringify(postData));
                $('#post_type').val('rate');
                $('#field_name').text('Rate');
                $('#update_info').modal('show');
                }
         });


         $('#update_new_value').on('click', function (e) {
                e.preventDefault();
                swal_waiting_popup({'title':'Updating Data.'});
                let form = $('form[name="update_single_data"]');
                

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.close();
                        $('#update_info').modal('hide');    
                    },
                    error: function (xhr) {
                       Swal.close();
                       $('#update_info').modal('hide');
                    },
                    complete: function () {
                         Swal.close();
                         $('#update_info').modal('hide');
                    }
                });
            });    

       //// ----------- Update Single Data ------------ ///////


        $('.resetdays').on('click', function () {
            let row = $(this).closest('.parent-row');
            row.find('select').val('').prop('disabled', false);
            row.find('input[type="radio"]').prop('checked', false);

        });



        function checkRates()
        {
            const selectors = [
            'input[name="massage_price[]"]',
            'input[name="incall_price[]"]',
            'input[name="outcall_price[]"]'
            ];

            let isValid = false;
            const allInputs = selectors.flatMap(selector => 
            Array.from(document.querySelectorAll(selector))
            );

            for (const input of allInputs) {
            const val = parseFloat(input.value);
            
            if (!isNaN(val) && val > 0) {
                isValid = true;
                break;
            }
            }
            return isValid;
        }

        function validateForm(formId) 
        {

                let form = $('#' + formId);
                let isValid = true;

                // reset errors
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.error-text').remove();

                function showError(el, message) {
                    el.addClass('is-invalid');
                    el.after('<span class="error-text text-danger">' + message + '</span>');
                    isValid = false;
                }

             

        
                form.find('[required]').each(function () 
                {

                    let field = $(this);
                    let label = field.data('label') || 'This field';

                    if (field.attr('type') === 'radio') {
                        let name = field.attr('name');
                        if (form.find('input[name="' + name + '"]:checked').length === 0) {
                            showError(field.closest('.d-flex'), label + ' is required');
                        }
                        return;
                    }

                
                    if ($.trim(field.val()) === '') {
                        showError(field, label + ' is required');
                        return;
                    }

                    
                 if (field.data('regex')) {

                    let value = $.trim(field.val());

                    
                    if (value !== '') {
                        let regex = new RegExp(field.data('regex'));
                        let msg   = field.data('regex-msg') || (label + ' must be 18 or older.');

                        if (!regex.test(value)) {
                            showError(field, msg);
                            return;
                        }
                    }
                }

                
                    if (field.attr('min') && Number(field.val()) < Number(field.attr('min'))) {
                        showError(field, label + ' must be at least ' + field.attr('min'));
                        return;
                    }
                });

                return isValid;
        }

        $('#submitMasseur').on('click', function (e) {
            e.preventDefault();

             var hasError  = validateAvailability();
             let existRates = checkRates();
             
            
            if (!existRates) 
            {
                 swal_error_warning('Rate','You must complete at least one rate value to proceed.')
                 return false;
            }

            else if (hasError) {
                 swal_error_warning('My Availability','Please select a time range or choose an availability option for each day.')
                 return false;
            }

            else
            {
                if (!validateForm('masseur_frm')) {
                return false;
                }
            }
            


            swal_waiting_popup({'title':'Creating new masseur.'});
            let form = $('form[name="masseur_frm"]');
            let formData = new FormData(form[0]);

            $.ajax({
                    url: "{{ route('center.create-new-masseur') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.close();
                        if (response.success === true && response.masseur_profile_id) {
                            swal_success_popup(response.message ?? 'Profile created successfully');
                            setTimeout(function () {
                                window.location = 'update-masseur/' + response.masseur_profile_id;
                            }, 2000); // 2 seconds

                        } 
                        else 
                        {
                            swal_error_popup('Something went wrong');
                        }
                    },

                    error: function (xhr) {
                        Swal.close();
                        let message = 'Error while saving profile';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        swal_error_popup(message);
                    }
                });

        });



        


    });   
    
    
        // ########## Image Upload Script ##########


            const CHUNK_SIZE = 1024 * 1024;
            let currentPageUrl = window.location.href;
            var bannerDefaultImage;
            var pinupDefaultImage;
            var allFiles = [];

            let selectedVideoId = null;
            let selectedVideoPosition = null;
            function preview_image(event)
                {
                    const input = document.getElementById("upload_file");
                    const files = Array.from(input.files);
                    const previousSelectedImagesCount = $("#image_preview .js_galleryMedia").length;
                    files.forEach((file, i) => {
                        const fileSizeMB = file.size / (1024 * 1024);
                        const index = previousSelectedImagesCount + i;
                
                        if (fileSizeMB <= 2) {
                            allFiles.push(file); 
                            const imgURL = URL.createObjectURL(file);
                            $('#image_preview').append(`
                                <a href='#'>
                                    <div class='five_column_content_top img-title-sec justify-content-between wish_span rm_${index}' style='z-index: 1;'>
                                        <span class='card_tit'>${file.name}</span>
                                        <i class='fa fa-trash deleteId' data-id='${index}'></i>
                                    </div>
                                    <label class='newbtn rm_${index}'>
                                        <img class='item js_galleryMedia' src='${imgURL}'>
                                        <input type='hidden' name='selected_files[]' value='${index}'>
                                    </label>
                                    <div style='margin-top: -34px;'></div>
                                </a>
                            `);
                        } else {
                            Swal.fire('Media', "Can't upload more than 2 MB", 'error');
                        }
                    });
                    input.value = '';
                }




        $("body").on('submit','#mulitiImage',function(e){

           
            console.log('mulitiImage===============');
            e.preventDefault();

            //return false;

            let selectedImagesCount = parseInt(countSelectedImages());
            let page_token = $('#page_token').val();
            let existingImagesCount = parseInt($("input[name='media_count']").val());
            if((existingImagesCount+selectedImagesCount) > 30){
                swal.fire('Media', "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>", 'error');
                return false;
            }
            var form = $(this);
            var url = form.attr('action');

            const formData = new FormData();
            allFiles.forEach((file) => {
                formData.append('img[]', file);
            });

            const bannerInput = document.getElementById('upload_banner');

            if (page_token) {
                formData.append('page_token', page_token);
            }


            if (bannerInput && bannerInput.files.length > 0) {
                formData.append('banner', bannerInput.files[0]);
            }
        
            
            const pinupInput = document.getElementById('upload_pinup');
            if (pinupInput && pinupInput.files.length > 0) {
                formData.append('pinup', pinupInput.files[0]);
            }

            $.ajax({
                type: 'POST',
                url:url,
                data:formData,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    Swal.fire({
                        title: 'Uploading...',
                        text: 'Please wait while we upload your files.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function (data) {
                    if(data.status == 200){
                        resetAddPhotoFrom(form);
                    } else if(data.status == 405) {
                        swal.fire('Media', "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>", 'error');
                        $("#exampleModal").modal('hide');
                    }
                    else {
                        swal.fire('Media', 'Please choose atleast one image', 'error');
                    }

                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let messages = Object.values(JSON.parse(xhr.responseText).errors).flat().join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: messages
                        });
                    } else {
                        let message = xhr.status === 500 ?JSON.parse(xhr.responseText).message:xhr.responseText;
                        Swal.fire({
                            icon: 'error',
                            title: xhr.statusText,
                            text: message || 'Something went wrong.'
                        });
                        if(xhr.status===200){
                            resetAddPhotoFrom(form);
                        }
                    }

                }
            });
        });

    var resetAddPhotoFrom = function(form){
            $('#image_preview a:not(:first)').remove();
            
            $(".js_bannerDefaultImage").attr('src',bannerDefaultImage);
            $(".js_pinupDefaultImage").attr('src',pinupDefaultImage);
            $("#add_photo_mcc").modal('hide');
            form[0].reset();
            $('#image_preview').html('');
            allFiles = [];
            Swal.fire({
                icon: 'success',
                title: 'Uploaded!',
                text: 'Your files were uploaded successfully.'
            });
            getAccountMediaGallery();
    }

    var countSelectedImages = function(){
        let excludeList = ['upload-thum-1.png', 'upload-3.png', 'add-pinup-banner-full.png'];
        let imageNames = [];
        $('.js_galleryMedia').each(function () {
            let src = $(this).attr('src');
            if (!src) return;
            let fileNameWithExt = src.split('/').pop();
            if (!excludeList.includes(fileNameWithExt)) {
                imageNames.push(fileNameWithExt);
            }
        });
        return imageNames.length;
    }

    var getAccountMediaGallery = function() {
        let page_token = $('#page_token').val();
        let activeGalleryTab = $(".js_gallery_category .nav-link.active").attr('data-type');
        return $.ajax({
            url: `/center-dashboard/get-massuers-account-media-gallery/${activeGalleryTab}/${page_token}`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            if (response.success) {
                let activePage = $("#carouselExampleIndicators .page-item.active").attr('id');
                let activeContainer = $("#carouselExampleIndicators .carousel-item.active").attr('id');
    
                $("#js_profile_media_gallery").html(response.gallery_container_html);
                $("#gallery_modal_container").html(response.gallery_modal_container_html);
                ///$("#banner_modal_container").html(response.banner_modal_container_html);
                $(".js_gallery_category li:nth-child(3)").remove();
                // if($("#pinup_modal_container").length > 0){
                //     $("#pinup_modal_container").html(response.pinup_modal_container_html);
                // }
                // else{
                //     $(".js_gallery_category li:nth-child(3)").remove();
                // }
                if (activePage && activeContainer && $(`#${activeContainer} img`).length > 0) {
                    $(`#${activePage}`).addClass('active');
                    $(`#${activeContainer}`).addClass('active');
                } else {
                    $(`#pageItem_0`).addClass('active');
                    $(`#cItem_0`).addClass('active');
                }
                initDragDrop();
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }


        function initDragDrop() 
        {
            $("#dvSource img").draggable({
                revert: "invalid",
                helper: 'clone',
                appendTo: ".upload-banner",
                refreshPositions: false,
                start: function (event, ui) {
                ui.helper.css({
                    width: "82px",   // shrink preview
                    height: "auto",
                    "z-index": 9999
                });
                ui.helper.find("img").css({
                    width: "100%",
                    height: "auto"
                });
                },
                drag: function(event, ui) {

                },
                stop: function(event, ui) {}
            });

            $(".dvDest").droppable({
                drop: function(event, ui) {
                    let dropSlot = $(this);
                    let dragSlot = ui.draggable;
                    let dropSlotType = dropSlot.find('img').data('type');
                    let dragSlotType = dragSlot.closest(".item4").find('span').text().toLowerCase();
                    if (dropSlotType != dragSlotType) {
                        let message = (dragSlotType == 'gallery') ?
                            `The photo you selected is not a Banner image. Please select a Banner image from your repository.` :
                            `The photo you selected is not a Gallery image. Please select a Gallery image from your repository.`;
                        swal.fire('Media', message, 'error');
                        return false;
                    } else {
                        $(this).trigger('click');
                        let meidaId = dragSlot.data('id');
                        let target;
                        switch (dragSlotType) {
                            case 'gallery': {
                                target = $(".modalPopup .item4 img[data-id='" + meidaId + "']").closest(
                                    ".item4");
                            }
                            break;
                            case 'banner': {
                                target = $(".modalPopup .item2 img[data-id='" + meidaId + "']").closest(
                                    ".item2");
                            }
                            break;
                        }
                        target.trigger('click');
                    }

                }
            });
        }

        function positionToUpdate(position) {
            updatePosition = position;
            return true;
        }


         let profile_selected_images = [];
        let default_image_icons = ['img-11.png', 'img-12.png', 'img-13.png'];
        $(document).on('click', '.modalPopup .item4, .modalPopup .item2', function(e) {

          

            let imageSrc = $(this).find('img').attr('src');
            let mediaId = $(this).find('img').data('id');
            let img_target = $("#img" + updatePosition);
            let targetImageSrc = img_target.attr('src');
            let targetImageName = targetImageSrc.split("/").pop();
            /**
             * Get existing profile image data to check duplicates
             */
            let srcArray = $(".upld-img").map(function() {
                return $(this).attr("src"); // Get the 'src' attribute of each <img>
            }).get();

            let newObject = {
                imageSrc: imageSrc,
                mediaId: mediaId,
                img_target: img_target,
                updatePosition: updatePosition
            };
            let duplicateImage = srcArray.findIndex(item => item === imageSrc);
            if (duplicateImage !== -1) {
                swal.fire('', "<p>It's a duplicate image. Please select another image.</p>", 'error');
            } else {
                let index = profile_selected_images.findIndex(item => item.updatePosition === updatePosition);
                if (index !== -1) {
                    profile_selected_images[index] = {
                        ...profile_selected_images[index],
                        ...newObject
                    };
                } else {
                    profile_selected_images.push(newObject);
                }
                $("#blah" + updatePosition).attr('src', imageSrc);
                $("#img" + updatePosition).attr('src', imageSrc);
                $("#mediaId" + updatePosition).val(mediaId);

                console.log('profile_selected_images.length',profile_selected_images.length);

                // if (profile_selected_images.length > 0) {
                //     let modalTitle = document.querySelector("#setAsDefaultForMainAccount .modal-title");
                //     let textNode = [...modalTitle.childNodes].find(
                //         node => node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== ""
                //     );
                //     if (textNode) {
                //         textNode.textContent = default_image_icons.includes(targetImageName) ?
                //             'Save to Default Media or Repository' : 'Replace Media';
                //     }
                //     $("#setAsDefaultForMainAccount").modal('show');
                // }
            }
            $("#photo_gallery").modal("hide");
            $("#photo_gallery_banner").modal("hide");
        });

        function setAsDefultImages() {
            if (profile_selected_images.length > 0) {
                profile_selected_images.map((item, index) => {
                    updateDefaultImage(item.updatePosition, item.mediaId, item.img_target, item.imageSrc);
                    if (profile_selected_images.length == (index + 1)) {
                        profile_selected_images = [];
                    }
                });
                $("#setAsDefaultForMainAccount").modal('hide');
            }
        }


        function readURL(input) 
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //console.log(reader);
                var imgbytes = input.files[0].size;
                var imgkbytes = Math.round(parseInt(imgbytes) / 1024);
                var imgMB = Math.round(parseInt(imgkbytes) / 1024);
                if (imgMB <= 2) {
                    reader.onload = function(e) {
                        $('#blah' + input.id[3])
                            .attr('src', e.target.result);

                    };
                } else {
                    //alert("file size in MB = "+imgMB);
                    $('.comman_msg').html("Can't upload more than 2 MB size");
                    $("#comman_modal").modal('show');
                }


                reader.readAsDataURL(input.files[0]);
                console.log("img = " + input.id[3]);


                console.log("sizeKB = " + imgkbytes);


            }
            $("body").on('click', '#manageImgId', function(e) {
                var src = $("#blah" + input.id[3]).attr('src');
                $('#img' + input.id[3])
                    .attr('src', src);
                $("#upload-sec").modal('hide');
                console.log("file = " + input.id[3]);
            })

        }



        // ########## Image Upload Script ##########
</script>


@endpush
