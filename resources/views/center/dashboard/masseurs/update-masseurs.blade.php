@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
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
    padding: 0px;
    margin: 0px auto;
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
            width: 100% !important;
            object-fit: cover;
        }

        .masseur_upl_img {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 5px;
        }

        .masseur_gallery {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
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
        .newbtn .upld-img.pro_gallery{
            height: 106px ;
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


        .gal-thumb-first {
            width: 100% !important;
            height: 338px !important;
        }

        .time-field {
            width: 95px;
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
                        <h1 class="h1">Update Masseur </h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                               <h3 class="NotesHeader"><b>Notes:</b></h3>
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



                            <form id="masseur_frm_about" name="masseur_frm_about" method="Post">
                                <!-- About The Masseur -->
                                <div class="mcc-form-tab">
                                    <h2 class="mcc-heading">About The Masseur  ({{ $masseur->member_id}})</h2>
                                    <div class="business-info-field pt-4">
                                        <!-- Personal Info -->
                                        <div class="form-group business-field">
                                            <label for="name" class="mb-1">Name</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control rounded-0" placeholder="Enter Name"
                                                value="{{ $masseur->name }}" required>
                                        </div>
                                        <div class="form-group business-field">
                                            <label for="stage_name" class="mb-1">Stage Name</label>
                                            <input type="text" id="stage_name" name="stage_name"
                                                class="form-control rounded-0" placeholder="Enter Stage Name"
                                                value="{{ $masseur->stage_name }}" required>
                                        </div>
                                        <div class="form-group business-field">
                                            <label for="mobile" class="mb-1">Mobile</label>
                                            <input type="text" id="mobile" name="mobile" data-ajax="phone"
                                                class="form-control rounded-0" maxlength="10" minlength="10" placeholder="Enter Mobile"
                                                value="{{ $masseur->mobile }}" required>
                                        </div>


                                        <div class="form-group business-field">
                                            <label for="nationality" class="mb-1">Nationality</label>
                                            @php
                                                $countrys = getCountryList();
                                            @endphp
                                            <select id="nationality" name="nationality" class="form-control rounded-0"
                                                required>
                                                <option value="">-Not Set-</option>
                                                @if (count($countrys) > 0)
                                                    @foreach ($countrys as $ckey => $cname)
                                                        <option {{ $masseur->nationality == $ckey ? 'selected' : '' }}
                                                            value="{{ $ckey }}">{{ $cname }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>


                                        <div class="form-group business-field">
                                            <label for="ethnicity" class="mb-1">Ethnicity</label>
                                            <select id="ethnicity" name="ethnicity" class="form-control rounded-0" required>
                                                <option value="">-Not Set-</option>
                                                @foreach (config('escorts.profile.ethnicities') as $key => $ethnicity)
                                                    <option {{ $masseur->ethnicity == $key ? 'selected' : '' }}
                                                        value="{{ $key }}"> {{ $ethnicity }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group business-field">
                                            <label for="age" class="mb-1">Age</label>
                                            <input type="text" value="{{ $masseur->age }}" id="age" name="age"
                                                data-type="number" data-regex="^(1[89]|[2-9][0-9])$" data-min="18"
                                                data-max-length="2" data-label="Age" class="form-control rounded-0"
                                                placeholder="Enter Age" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="label">Vaccination</label>
                                            <div class="d-flex justify-content-start gap-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vaccination"
                                                        value="1" {{ $masseur->vaccination == 1 ? 'checked' : '' }}
                                                        required data-label="Vaccination">
                                                    <label class="form-check-label">
                                                        Vaccinated, not up to date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vaccination"
                                                        {{ $masseur->vaccination == 2 ? 'checked' : '' }}
                                                        value="2">
                                                    <label class="form-check-label">
                                                        Vaccinated, up to date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vaccination"
                                                        {{ $masseur->vaccination == 3 ? 'checked' : '' }}
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
                                                <textarea id="commentary" name="commentary" class="form-control rounded-0" placeholder="Commentary (max 300 words)"
                                                    rows="3">{{ $masseur->commentary }}</textarea>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                          
                                            <div class="form-group">
                                            <label class="label">Services</label>
                                            <div class="d-flex justify-content-start gap-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="service[]" value="massage"
                                                        {{ in_array('massage', $services) ? 'checked' : '' }} required data-label="Vaccination" @if(!$exists) {{ !isPriceValid($default_duration['massage_price']) ? 'disabled' : '' }} @endif >
                                                    <label class="form-check-label">
                                                        Massage
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"  name="service[]" value="2_hand" 
                                                         {{ in_array('2_hand', $services) ? 'checked' : '' }} @if(!$exists) {{ !isPriceValid($default_duration['incall_price']) ? 'disabled' : '' }} @endif >
                                                    <label class="form-check-label">
                                                        +2 Hands
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="service[]"  value="4_hand"
                                                       {{ in_array('4_hand', $services) ? 'checked' : '' }}  @if(!$exists) {{ !isPriceValid($default_duration['outcall_price']) ? 'disabled' : '' }} @endif>
                                                    <label class="form-check-label">
                                                        +4 Hands.
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end py-3">

                                        <input type="hidden" name="type" id="type" value="profile">
                                        <input type="hidden" name="page_token" id="page_token"
                                            value="{{ $masseur->token_id }}">
                                        <input type="hidden" name="masseur_id" id="masseur_id"
                                            value="{{ $masseur->id }}">
                                        <button type="button" id="submitMasseur"
                                            class="btn-common save_profile_btn">Update</button>

                                    </div>

                            </form>
                            <!-- End About The Masseur -->





                            <form id="masseur_frm_media" name="masseur_frm_media" method="Post">
                                <!-- Media -->
                                {{-- media --}}
                                <div class="mcc-form-tab">
                                    <h2 class="mcc-heading">Media</h2>
                                    <div class="row">
                                        <div class="col-md-12 my-3 d-flex justify-content-end gap-10">
                                            <button type="button" class="create-tour-sec dctour" data-toggle="modal"
                                                data-target="#add_photo_mcc">Add Photos</button>
                                            <button type="button" disabled="" id="MediaVerification" class="create-tour-sec dctour verify_timer" data-toggle="modal" data-target="#veryfy_media">Media Verification
                                                <span class="timer_tooltip"></span>
                                            </button>
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
                                                    <div class="col-sm-12 masseur_upl_img">
                                                        <div class="thumnail_img">
                                                            <h4 class="banner-sub-heading my-2">Thumbnail</h4>
                                                            <div class="plate dvDest ui-droppable mass_verify_icon">
                                                                <label class="newbtn" data-toggle="modal"
                                                                    data-target="#photo_gallery">
                                                                    <img class="w-100 gal-thumb-first upld-img"
                                                                        id="img1"
                                                                        data-position=1
                                                                        data-type="gallery"
                                                                        src="{{ asset($masseur->getImagePosition(1, $masseur->id)) }}"
                                                                        onclick="positionToUpdate(1)">
                                                                </label>
                                                                 @php 
                                                                    $img_data = $masseur->getImageDetailsByPosition(1, $masseur->id);
                                                                @endphp
                                                                <div class="mass_lg_icon" style="{{ $img_data ? '' : 'display:none;' }}" id="verify_icon_1">
                                                                     @if($img_data)
                                                                        @php 
                                                                            $status = $img_data->varified ?? 0; 
                                                                            $status_icon = getMediaVerificationDataBigIcon($status);
                                                                        @endphp
                                                                        <img src="{{ $status_icon['icon'] }}">
                                                                        <span class="mass_tooltip">{{ $status_icon['label'] }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="gal_img">
                                                            <h4 class="banner-sub-heading my-2">Gallery Images</h4>
                                                            <div class="masseur_gallery">
                                                                <div class="plate dvDest ui-droppable mass_verify_icon">
                                                                    <label class="newbtn" data-toggle="modal"
                                                                        data-target="#photo_gallery">
                                                                        <img class="upld-img pro_gallery"
                                                                            data-position=2
                                                                            id="img2" data-type="gallery" src="{{ asset($masseur->getImagePosition(2, $masseur->id)) }}"
                                                                            onclick="positionToUpdate(2)">
                                                                    </label>
                                                                    @php 
                                                                        $img_data = $masseur->getImageDetailsByPosition(2, $masseur->id);
                                                                    @endphp

                                                                    <div class="mass_sm_icon" style="{{ $img_data ? '' : 'display:none;' }}" id="verify_icon_2">
                                                                        @if($img_data)
                                                                            @php 
                                                                                $status = $img_data->varified ?? 0; 
                                                                                $status_icon = getMediaVerificationDataSmallIcon($status);
                                                                            @endphp

                                                                            <img src="{{ $status_icon['icon'] }}">
                                                                            <span class="mass_sm_tooltip">{{ $status_icon['label'] }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="plate dvDest ui-droppable mass_verify_icon">
                                                                    <label class="newbtn" data-toggle="modal"
                                                                        data-target="#photo_gallery">
                                                                        <img class="upld-img pro_gallery"
                                                                            id="img3" data-position=3 data-type="gallery" src="{{ asset($masseur->getImagePosition(3, $masseur->id)) }}"
                                                                            onclick="positionToUpdate(3)">
                                                                    </label>
                                                                    @php 
                                                                        $img_data = $masseur->getImageDetailsByPosition(3, $masseur->id);
                                                                    @endphp

                                                                    <div class="mass_sm_icon" style="{{ $img_data ? '' : 'display:none;' }}" id="verify_icon_3">
                                                                        @if($img_data)
                                                                            @php 
                                                                                $status = $img_data->varified ?? 0; 
                                                                                $status_icon = getMediaVerificationDataSmallIcon($status);
                                                                            @endphp

                                                                            <img src="{{ $status_icon['icon'] }}">
                                                                            <span class="mass_sm_tooltip">{{ $status_icon['label'] }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="plate dvDest ui-droppable mass_verify_icon">
                                                                    <label class="newbtn" data-toggle="modal"
                                                                        data-target="#photo_gallery">
                                                                        <img class="upld-img pro_gallery"
                                                                            id="img4" data-position=4 data-type="gallery" src="{{ asset($masseur->getImagePosition(4, $masseur->id)) }}"
                                                                            onclick="positionToUpdate(4)">
                                                                    </label>
                                                                    @php 
                                                                        $img_data = $masseur->getImageDetailsByPosition(4, $masseur->id);
                                                                    @endphp

                                                                    <div class="mass_sm_icon" style="{{ $img_data ? '' : 'display:none;' }}" id="verify_icon_4">
                                                                        @if($img_data)
                                                                            @php 
                                                                                $status = $img_data->varified ?? 0; 
                                                                                $status_icon = getMediaVerificationDataSmallIcon($status);
                                                                            @endphp

                                                                            <img src="{{ $status_icon['icon'] }}">
                                                                            <span class="mass_sm_tooltip">{{ $status_icon['label'] }}</span>
                                                                        @endif
                                                                    </div>
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
                                                                <ul class="nav nav-tabs border-0" id="escort_profile_media_filter_type" >
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" id="menu_all"
                                                                            data-toggle="tab"  data-filter-type="all" href="#home">All</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"  data-filter-type="verified" id="menu_varified" data-toggle="tab"
                                                                            href="#menu1">Verified</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"  data-filter-type="unverified" id="menu_unverified" data-toggle="tab"
                                                                            href="#menu2">Unverified</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-2 pt-1">
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                        role="progressbar"
                                                                        style="width: {{ $media->count() * 3.3 }}%"
                                                                        aria-valuenow="25" aria-valuemin="0"
                                                                        aria-valuemax="100">
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
                                                                <a class="nav-link active" data-type="gallery"
                                                                    data-toggle="tab" href="#Gallery">Gallery</a>
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




                                    </div>


                                    <div class="d-flex justify-content-end py-3">
                                        <input type="hidden" name="type" id="type" value="media">
                                        <input type="hidden" name="page_token" id="page_token"
                                            value="{{ $masseur->token_id }}">
                                        <input type="hidden" name="masseur_id" id="masseur_id"
                                            value="{{ $masseur->id }}">
                                        <button type="button" id="submitMasseur"
                                            class="btn-common save_profile_btn">Update</button>
                                    </div>
                                </div>
                                <!-- End Media -->
                                <div class="modal fade upload-modal" id="upload-sec" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false"
                                    data-backdrop="static" aria-modal="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"> <img
                                                            src="{{ asset('assets/dashboard/img/banner.png') }}"
                                                            class="custompopicon">
                                                        Manage Photos</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true"><img
                                                                src="{{ asset('assets/app/img/cross.png') }}"
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
                                                                                    src="{{ asset($masseur->imagePosition(1)) }}"
                                                                                    style="width: 300px;height: 308px;object-fit: cover;">
                                                                                <input name="img[1]" id="pic1"
                                                                                    data-id="1" class="pis"
                                                                                    onchange="readURL(this);"
                                                                                    type="file" accept="image/*">
                                                                                <input type="hidden" name="position[1]"
                                                                                    id="mediaId1">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-8 pl-0">
                                                                        <div class="row" style="">
                                                                            <div class="col-4 pr-0">
                                                                                <div class="plate"><label class="newbtn">
                                                                                        <img id="blah2"
                                                                                            class="img-fluid modal-image"
                                                                                            src="{{ asset($masseur->imagePosition(2)) }}">
                                                                                        <input name="img[2]"
                                                                                            id="pic2" data-id="2"
                                                                                            class="pis"
                                                                                            onchange="readURL(this);"
                                                                                            type="file"
                                                                                            accept="image/*">
                                                                                        <input type="hidden"
                                                                                            name="position[2]"
                                                                                            id="mediaId2">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4 pr-0">
                                                                                <div class="plate"><label class="newbtn">
                                                                                        <img id="blah3"
                                                                                            class="img-fluid modal-image"
                                                                                            src="{{ asset($masseur->imagePosition(3)) }}">
                                                                                        <input name="img[3]"
                                                                                            id="pic3" data-id="3"
                                                                                            class="pis"
                                                                                            onchange="readURL(this);"
                                                                                            type="file"
                                                                                            accept="image/*">
                                                                                        <input type="hidden"
                                                                                            name="position[3]"
                                                                                            id="mediaId3">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4 pr-0">
                                                                                <div class="plate"><label class="newbtn">
                                                                                        <img id="blah4"
                                                                                            class="img-fluid modal-image"
                                                                                            src="{{ asset($masseur->imagePosition(4)) }}">
                                                                                        <input name="img[4]"
                                                                                            id="pic4" data-id="4"
                                                                                            class="pis"
                                                                                            onchange="readURL(this);"
                                                                                            type="file"
                                                                                            accept="image/*">
                                                                                        <input type="hidden"
                                                                                            name="position[4]"
                                                                                            id="mediaId4">
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
                                                                            <li>Two (2) selfies with your User Name and
                                                                                Membership ID printed
                                                                                (can be handwritten) on a sheet of paper
                                                                                held up to the side of
                                                                                you and not obscuring any part of you</li>
                                                                            <li>A drivers licence which matches your User
                                                                                Name and Home State
                                                                            </li>
                                                                            <li>A passport which matches your User Name and
                                                                                Home State</li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-success-modal" id="defaultImg">Use
                                                        Default</button>
                                                    <button type="button" class="btn-success-modal"
                                                        id="manageImgId">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </form>





                            <form id="masseur_frm_avail" name="masseur_frm_avail" method="Post">
                                <!-- My Availability -->
                                <div class="mcc-form-tab">

                                    <h2>My Availability</h2>
                                    

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

                                      
                                        function generateTimes($start, $end, $selected = '', $minTime = null) {

                                            $startTime = strtotime($start);
                                            $endTime   = strtotime($end);

                                            
                                            if ($end == '12:00 AM') {
                                                $endTime = strtotime('tomorrow 12:00 AM');
                                            }

                                            // fallback safety
                                            if ($endTime <= $startTime) {
                                                $endTime = strtotime('+1 day', $endTime);
                                            }

                                            $output = '';

                                            for ($time = $startTime; $time <= $endTime; $time += 1800) {

                                                $formatted = date('h:i A', $time);

                                                // skip invalid TO values
                                                if ($minTime && strtotime($formatted) <= strtotime($minTime)) {
                                                    continue;
                                                }

                                                $selectedAttr = ($formatted == $selected) ? 'selected' : '';
                                                
                                                if($selected=='--')
                                                $selectedAttr = "";


                                                $output .= "<option value=\"$formatted\" $selectedAttr>$formatted</option>";
                                            }

                                            return $output;
                                        }
                                        @endphp


                                <div class="row">
                                <div class="col-12">
                                <div class="padding_20_all_side profile_time_availibility">

                                        @foreach ($days as $dayKey => $dayLabel)

                                            @php
                                                $dayData = $availability[$dayKey] ?? [];


                                                $masseur_data = $masseur_availability[$dayKey] ?? [];
                                                $db_status =  $masseur_data['status'] ?? 'custom';




                                                $status = $dayData['status'] ?? 'custom';
                                                $from   = $dayData['from'] ?? '';
                                                $to     = $dayData['to'] ?? '';

                                                $disabled = ($status == 'closed') ? 'disabled' : '';

                    
                                                $fromStart = '12:00 AM';
                                                $fromEnd   = '12:00 AM';

                                                $toStart   = '12:00 AM';
                                                $toEnd     = '12:00 AM';

                                
                                            if ($status == 'til_late' && $from) {

                                                $fromStart = $from;
                                                $fromEnd   = '11:30 PM';

                                                $toStart = date('h:i A', strtotime($from . ' +30 minutes'));
                                                $toEnd   = '12:00 AM'; // must be this
                                            }

    
                                                if ($status == 'custom' && $from && $to) {

                                                    $fromStart = $from;
                                                    $fromEnd   = date('h:i A', strtotime($to . ' -30 minutes'));

                                                    $toStart   = date('h:i A', strtotime($from . ' +30 minutes'));
                                                    $toEnd     = $to;
                                                }

                                                $closed_row = "";
                                                if($status == 'closed')
                                                {
                                                    $closed_row = 'disabled' ;
                                                }
                                                else
                                                {
                                                    $closed_row = "";
                                                }

                                                $selected = [];
                                                $selected['from'] = $masseur_data['from'];
                                                $selected['to'] = $masseur_data['to'];   

                                            @endphp
                                            <div class="d-flex align-items-center flex-wrap gap-20 my-3 parent-row">

                                                <label style="width:100px;"><strong>{{ $dayLabel }}: </strong></label>
                                                <select name="time[{{ $dayKey }}][hh_from]"
                                                        class="time-field hh_from from"
                                                        {{ $disabled }}>

                                                    <option value="">Select</option>

                                                    {!! generateTimes($fromStart, $fromEnd, $selected['from']) !!}

                                                </select>

                                                <span class="mx-2">To  </span>

                                                <!-- TO -->
                                                <select name="time[{{ $dayKey }}][hh_to]" class="time-field hh_to to"  {{ $disabled }}>

                                                        <option value="">Select</option>

                                                       

                                                        @if($status == 'til_late')
                                                            {!! generateTimes($toStart, $toEnd, $selected['to']) !!}
                                                            <option value="12:00 AM" {{ $to == '12:00 AM' ? 'selected' : '' }}>12:00 AM</option>
                                                        @else
                                                            {!! generateTimes($toStart, $toEnd, $selected['to']) !!}
                                                        @endif

                                                </select>

                                               
                                                <label class="ms-3" style="display: none;">
                                                <input type="radio" name="availability_time[{{ $dayKey }}]"
                                                    value="custom" {{ $db_status=='custom'?'checked':'' }} {{ $closed_row  }}> Custom
                                                </label>

                                                <label class="ms-2">
                                                <input type="radio" name="availability_time[{{ $dayKey }}]"
                                                    value="til_late" {{ $db_status=='til_late'?'checked':'' }} {{ $closed_row  }}> Til Late
                                                </label>

                                                <label class="ms-2">
                                                <input type="radio" name="availability_time[{{ $dayKey }}]"
                                                    value="closed" {{ $db_status =='closed'?'checked':'' }} {{ $closed_row  }}> Not Available
                                                </label>

                                                @if($status!='closed')
                                                <div class="resetdays-icon">
                                                        <input type="button" value="Reset" class="resetdays">
                                                </div>
                                                @endif

                                            </div>

                                @endforeach

                                </div>
                                </div>
                                </div>




                                    <div class="d-flex justify-content-end py-3">
                                        <input type="hidden" name="type" id="type" value="availibility">
                                        <input type="hidden" name="page_token" id="page_token"
                                            value="{{ $masseur->token_id }}">
                                        <input type="hidden" name="masseur_id" id="masseur_id"
                                            value="{{ $masseur->id }}">
                                        <button type="button" id="submitMasseur"
                                            class="btn-common save_profile_btn">Update</button>
                                    </div>

                                </div>
                                <!-- End My Availability -->
                            </form>


                             <form id="masseur_frm_service_type" name="masseur_frm_service_type" method="Post">
                               <div class="mcc-form-tab">
                                        <h2 class="mcc-heading">My Services</h2>
                                            <div class="row">


                                                <div class="col-md-12 my-3 d-flex justify-content-end gap-10">


                                                        <div class="form-group business-field col-md-6">
                                                            
                                                            <label for="exampleFormControlSelect1">Massage services
                                                            </label>
                                                            
                                                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow update_language_data" id="massage_service" name="massage_service" >
                                                                <option value="" selected="">-- Not Set --</option>
                                                                 @foreach ($massage_default->massage_services()->where('category_id', 1)->get() as $value)

                                                                    @if(!empty($masseur->massage_service_types) && in_array($value->service_id, $masseur->massage_service_types))
                                                                        @continue
                                                                    @endif
                                                               
                                                                <option value="{{$value->service_id}}"  data-name="{{config('escorts.profile.massage-services')[$value->service_id]  }}">{{config('escorts.profile.massage-services')[$value->service_id]  }}</option>
                                                                @endforeach
                                                                </select>


                                                            
                                                                <div id="show_db_massage_service" class="d-flex">

                                                                        @if(!empty($masseur->massage_service_types)) 
                                                                            @foreach($masseur->massage_service_types as $massage_service_type)

                                                                               

                                                                                <div class='selecated_languages select_lang massage_service' id="{{ $massage_service_type }}">
                                                                                    <span class='languages_choosed_from_drop_down'>{!!config('escorts.profile.massage-services')[$massage_service_type]  !!} <small class='remove-lang remove-lang-massage-service'>×</small></span>
                                                                                    
                                                                                </div>
                                                                    
                                                                            @endforeach 
                                                                        @endif
                                                                </div>
                                                            


                                                                <div id="container_massage_service"> 
                                                                   @if(!empty($masseur->massage_service_types)) 
                                                                            @foreach($masseur->massage_service_types as $massage_service_type)
                                                                        <input type='hidden' name='massage_service_list[]' value="{{$massage_service_type}}">
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                                <div id="show_massage_service" style="display:none"></div>
                                                                <div id="container_massage_service"></div>
                                                                    
                                                        
                                                        </div>


                                                        <div class="form-group business-field col-md-6">
                                                            
                                                            <label for="exampleFormControlSelect1">Other service types
                                                            </label>
                                                            
                                                                <select class="change_default form-control form-control-sm select_tag_remove_box_sadow update_language_data" id="massage_other_service" name="massage_other_service" >
                                                                <option value="" selected="">-- Not Set --</option>
                                                                @foreach ($massage_default->massage_services()->where('category_id', 2)->get() as $value)

                                                                 @if(!empty($masseur->massage_service_types) && in_array($value->service_id, $masseur->other_service_types))
                                                                        @continue
                                                                 @endif

                                                                <option value="{{$value->service_id}}"  data-name="{{config('escorts.profile.other-services')[$value->service_id]  }}">{{config('escorts.profile.other-services')[$value->service_id]  }}</option>
                                                                @endforeach
                                                                </select>


                                                            
                                                                <div id="show_db_massage_other_service" class="d-flex">

                                                                        @if(!empty($masseur->other_service_types)) 
                                                                            @foreach($masseur->other_service_types as $other_service_type)
                                                                        
                                                                                <div class='selecated_languages massage_other_service select_lang' id="{{ $other_service_type }}">
                                                                                    <span class='languages_choosed_from_drop_down'>{!! config('escorts.profile.other-services')[$other_service_type] !!} <small class='remove-lang remove-lang-massage-other-service'>×</small></span>
                                                                                    
                                                                                </div>
                                                                    
                                                                            @endforeach 
                                                                        @endif
                                                                </div>
                                                            


                                                                <div id="container_massage_other_service"> 
                                                                    @if(!empty($masseur->other_service_types)) 
                                                                            @foreach($masseur->other_service_types as $other_service_type)
                                                                        <input type='hidden' name='massage_other_service_list[]' value="{{$other_service_type}}">
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                                <div id="show_massage_other_service" style="display:none"></div>
                                                                <div id="container_massage_other_service"></div>
                                                                    
                                                        
                                                        </div>



                                                </div>
                                            </div>

                                        <div class="d-flex justify-content-end py-3">
                                            <input type="hidden" name="type" id="type" value="my_services">
                                            <input type="hidden" name="page_token" id="page_token"
                                                value="{{ $masseur->token_id }}">
                                            <input type="hidden" name="masseur_id" id="masseur_id"
                                                value="{{ $masseur->id }}">
                                            <button type="button" id="submitMasseur"
                                                class="btn-common save_profile_btn">Update</button>
                                        </div>

                                    </div>
                            </form>





                            <form id="masseur_frm" name="masseur_frm" method="Post">
                                <!-- Rate -->
                                <!-- <div class="mcc-form-tab">
                                                            <h2>Rate</h2>
                                                                <div class="row">
                                                                    <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates pt-5">
                                                                        <div class="rate_first_row row">
                                                                            <div class="col-3">
                                                                            </div>
                                                                            <div class="col-3 rate-img-center rate-tooltip">
                                                                                <img src="{{ asset('assets/dashboard/img/massage-only.png') }}" class="w-50">
                                                                                <span class="tooltip-info">Massage only</span>
                                                                            </div>
                                                                            <div class="col-3 rate-img-center rate-tooltip">
                                                                                <img src="{{ asset('assets/dashboard/img/massage-with2.png') }}" class="w-50">
                                                                                <span class="tooltip-info">Massage with extras +2 hands.</span>
                                                                            </div>
                                                                            <div class="col-3 rate-img-center rate-tooltip">
                                                                                <img src="{{ asset('assets/dashboard/img/massage-with4.png') }}" class="w-50">
                                                                                <span class="tooltip-info">Massage with extras +4 hands.</span>
                                                                            </div>
                                                                        </div>
                                                                        @foreach ($durations->whereIn('id', [2, 3, 4, 5, 6, 7]) as $duration)
    @php
        if ($duration->id != '') {
            $massage_price = $incall_price = $outcall_price = $massage_profile_id = '';
            if (!empty($massage_durations)) {
                foreach ($massage_durations as $db_duration) {
                    if (
                        isset($db_duration['pivot']['duration_id']) &&
                        $db_duration['pivot']['duration_id'] == $duration->id
                    ) {
                        $massage_price = isset($db_duration['pivot']['massage_price'])
                            ? $db_duration['pivot']['massage_price']
                            : 0;
                        $incall_price = isset($db_duration['pivot']['incall_price'])
                            ? $db_duration['pivot']['incall_price']
                            : 0;
                        $outcall_price = isset($db_duration['pivot']['outcall_price'])
                            ? $db_duration['pivot']['outcall_price']
                            : 0;
                        $massage_profile_id = isset($db_duration['pivot']['massage_profile_id'])
                            ? $db_duration['pivot']['massage_profile_id']
                            : '';

                        break;
                    }
                }
            }
        }

    @endphp

                                                                        <div class="rate_first_row">
                                                                            <input type="hidden" name="duration_id[]" value="{{ $duration->id }}">
                                                                            <div class="form-group row">
                                                                                <label class="col-3 label" for="exampleFormControlSelect1">{{ $duration->name == '1 Hour' ? '1 Hour' : $duration->name }} : </label>
                                                                                <div class="col-3">
                                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                                        <span>$</span>
                                                                                        <input  placeholder="0" data-duration_id="{{ $duration->id }}" data-massage_profile_id="{{ $massage_profile_id }}"  data-data_type="massage_price" type="text"  class="form-control allow_only_numeric update_default_rate" id="massage_price" value="{{ $masseur->durationRate($duration->id, 'massage_price') }}" name="massage_price[]" maxlength="6">
                                                                                        <input type="hidden" class="profile_massage_price"  value="{{ $massage_price }}" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                                        <span>$</span>
                                                                                        <input  placeholder="0" data-duration_id="{{ $duration->id }}" data-massage_profile_id="{{ $massage_profile_id }}"  data-data_type="incall_price"  type="text"  class="form-control allow_only_numeric update_default_rate" id="incall_price" value="{{ $masseur->durationRate($duration->id, 'incall_price') }}" name="incall_price[]" maxlength="6">
                                                                                        <input type="hidden" class="profile_incall_price"  value="{{ $incall_price }}" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                                        <span>$</span>
                                                                                        <input  placeholder="0" data-duration_id="{{ $duration->id }}"  data-massage_profile_id="{{ $massage_profile_id }}"  data-data_type="outcall_price"   type="text"  class="form-control allow_only_numeric update_default_rate" id="outcall_price"  value="{{ $masseur->durationRate($duration->id, 'outcall_price') }}" name="outcall_price[]" maxlength="6">
                                                                                        <input type="hidden" class="profile_outcall_price"  value="{{ $outcall_price }}" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
    @endforeach
                                                                    </div>
                                                                </div>



                                                                    <div class="d-flex justify-content-end py-3">
                                                                        <input type="hidden" name="type" id="rate" name="rate"  value="rates">
                                                                        <input type="hidden" name="page_token" id="page_token"  value="{{ $masseur->token_id }}">
                                                                        <input type="hidden" name="masseur_id" id="masseur_id" value="{{ $masseur->id }}">
                                                                        <button type="button" id="submitMasseur" class="btn-common save_profile_btn">Update</button>
                                                                    </div>

                                                        </div> -->
                                <!-- End Rate -->
                            </form>




                        </div>
                    </div>
                </div>
            </div>
            <!-- End Media -->





                                                


    </div>
    </div>
    </div>



    <div class="modal fade upload-modal" id="photo_gallery" style="display: none">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><img
                            src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon"> Select Photo
                    </h5>
                    <div class="uploadModalTrigger" style="display: inline-block;position: absolute;right: 300px;">
                        <button type="button" data-toggle="modal" data-target="#add_photo_mcc"
                            class="btn-cancel-modal select-Photo" style=" padding: 5px 10px;">Upload from device</button>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="gallery_modal_container" class="grid-container modalPopup">

                        @foreach ($media as $keyId => $image)
                            @if (!in_array($image->position, [9, 10]))
                                <div class="item4">
                                    <img class="img-thumbnail defult-image select_image" src="{{ asset($image->path) }}"
                                        alt=" " data-id="{{ $image->id }}"
                                        data-position="{{ $image->position ? $image->position : '' }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade upload-modal" id="add_photo_mcc" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="mulitiImage" method="POST" action="{{ route('center.massuers-media-upload-gallery') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><img
                                    src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross">
                                Upload Photos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                        class="img-fluid img_resize_in_smscreen"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <label class="newbtn rm">
                                        <img id="blah" class="item"
                                            src="{{ asset('assets/app/img/add-images.png') }}">
                                        <input name="img[]" id="upload_file" class="pis"
                                            onchange="preview_image(event);" type="file" multiple accept="image/*">
                                    </label>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="photo-sec-popup custom-upload-photo" id="image_preview">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="page_token" id="page_token" value="{{ $masseur->token_id }}">
                            {{-- <button type="submit" class="btn-success-modal">Verify Media</button> --}}
                            <button type="submit" class="btn-success-modal">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal programmatic" id="update_info" style="display: none">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img
                            src="{{ asset('assets/dashboard/img/save-info.png') }}" class="custompopicon"> Update My
                        Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <form name="update_single_data" method="post" action="{{ route('center.update-single-data') }}">
                        <input type="hidden" name="post_field" id="post_field" value="">
                        <input type="hidden" name="post_value" id="post_value" value="">

                        <input type="hidden" name="post_json" id="post_json" value="">
                        <input type="hidden" name="post_type" id="post_type" value="">

                        <h3 class="my-2"><span id="Lname">
                                <h5 class="custom_modal_text">Would you like to update <b>
                                        <span id="field_name"></span>
                                    </b> in your 'My Information' page for future Profiles?</h5>
                            </span> </h3>
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


    @include('center.dashboard.modal.remove_gallary_image')
    @include('center.dashboard.modal.update_messeue_upload_verify_media')
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
                let status   = row.find('input[type="radio"]:checked').val() || '';
                let fromHH   = row.find('select[name*="[hh_from]"]').val();
                let toHH     = row.find('select[name*="[hh_to]"]').val();
            
                row.removeClass('border border-danger');

                let hasFrom = fromHH;
                let hasTo   = toHH;

                
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

                if ((!hasFrom || !hasTo) && status === 'custom') {
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

        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.parent-row').forEach(row => {

                const radios = row.querySelectorAll('input[type="radio"]');
                const fromDropdown = row.querySelector('.hh_from');
                const toDropdown = row.querySelector('.hh_to');
                const resetBtn = row.querySelector('.resetdays');

                function updateState() {
                    const selected = row.querySelector('input[type="radio"]:checked');
                    if (!selected) return;

                    if (selected.value === 'closed') {
                        fromDropdown.setAttribute('disabled', 'disabled');
                        toDropdown.setAttribute('disabled', 'disabled');
                    }
                    else if (selected.value === 'til_late') {
                        fromDropdown.removeAttribute('disabled');
                        toDropdown.setAttribute('disabled', 'disabled');
                    }
                    else {
                        fromDropdown.removeAttribute('disabled');
                        toDropdown.removeAttribute('disabled');
                    }
                }

                function setCustomIfTimeSelected() {

                    const selected = row.querySelector('input[type="radio"]:checked');
                    if (selected && selected.value === 'closed') return;

                    if (fromDropdown.value || toDropdown.value) {
                        const customRadio = row.querySelector('input[value="custom"]');
                        if (customRadio) {
                            customRadio.checked = true;
                        }
                    } 
                    else {
                        radios.forEach(r => r.checked = false);
                    }

                    updateState();
                }

                fromDropdown.addEventListener('change', setCustomIfTimeSelected);
                toDropdown.addEventListener('change', setCustomIfTimeSelected);

                if (resetBtn) {
                    resetBtn.addEventListener('click', function () {
                        fromDropdown.removeAttribute('disabled');
                        toDropdown.removeAttribute('disabled');

                        fromDropdown.value = '';
                        toDropdown.value = '';
                        radios.forEach(radio => radio.checked = false);
                    });
                }

                updateState();

                radios.forEach(radio => {
                    radio.addEventListener('change', updateState);
                });

            });

        });

        ////////////// End For Our Open Times ///////////////// 

        $(function(e) {

            //// ----------- Update Single Data ------------ ///////
            $('.update_default_rate').on('blur', function() {

                var duration_id = $(this).data('duration_id');
                var massage_profile_id = $(this).data('massage_profile_id');
                var data_type = $(this).data('data_type');


                var current_value = $(this).val();
                var current_feild = $(this).attr('id');

                var current_old_input = 'profile_' + current_feild;
                var old_value = $(this).closest('.service_rate_dolor_symbol').find('.' + current_old_input)
                    .val();



                if (current_value === "")
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


            $('#update_new_value').on('click', function(e) {
                e.preventDefault();
                swal_waiting_popup({
                    'title': 'Updating Data.'
                });
                let form = $('form[name="update_single_data"]');


                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.close();
                        $('#update_info').modal('hide');
                    },
                    error: function(xhr) {
                        Swal.close();
                        $('#update_info').modal('hide');
                    },
                    complete: function() {
                        Swal.close();
                        $('#update_info').modal('hide');
                    }
                });
            });

            //// ----------- Update Single Data ------------ ///////


            $('.resetdays').on('click', function() {
                let row = $(this).closest('.parent-row');
                row.find('select').val('').prop('disabled', false);
                row.find('input[type="radio"]').prop('checked', false);

            });



            function checkRates() {
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

            function validateForm(formId) {

                let form = $('#' + formId);
                let isValid = true;
                let ajaxRequests = [];

                // reset errors
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.error-text').remove();

                function showError(el, message) {
                    el.addClass('is-invalid');
                    el.after('<span class="error-text text-danger">' + message + '</span>');
                    isValid = false;
                }




                form.find('[required]').each(function() {

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
                            let msg = field.data('regex-msg') || (label + ' must be 18 or older.');

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


                    if (field.data('ajax') === 'phone') 
                    {
                       
                        let request = $.ajax({
                            url: "{{ route('center.validate-phone') }}",
                            type: 'POST',
                            data: {
                                masseur_id : "{{ $masseur->id }}",
                                form_type: 'edit',
                                phone: field.val(),
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            async: false,
                            success: function (res) {
                                if (!res.valid) {
                                    showError(field, res.message || 'Invalid phone number');
                                }
                            },
                            error: function () {
                                showError(field, 'Unable to validate phone number');
                            }
                        });

                        ajaxRequests.push(request);
                    }





                });

                return isValid;
            }



            // $('#submitMasseur').on('click', function (e) {
            //     e.preventDefault();

            //         var hasError  = validateAvailability();
            //         let existRates = checkRates();


            //     if (!existRates) 
            //     {
            //             swal_error_warning('Rate','You must complete at least one rate value to proceed.')
            //             return false;
            //     }

            //     else if (hasError) {
            //             swal_error_warning('My Availability','Please select a time range or choose an availability option for each day.')
            //             return false;
            //     }

            //     else
            //     {
            //         if (!validateForm('masseur_frm')) {
            //         return false;
            //         }
            //     }



            //     swal_waiting_popup({'title':'Creating new masseur.'});
            //     let form = $('form[name="masseur_frm"]');
            //     let formData = new FormData(form[0]);

            //     $.ajax({
            //             url: "{{ route('center.update-masseur') }}",
            //             type: 'POST',
            //             data: formData,
            //             processData: false,
            //             contentType: false,
            //             success: function (response) {
            //                 Swal.close();
            //                 if (response.success === true && response.masseur_profile_id) {
            //                     swal_success_popup(response.message ?? 'Profile updated successfully');
            //                     // setTimeout(function () {
            //                     //     window.location = 'update-masseur/' + response.masseur_profile_id;
            //                     // }, 2000); // 2 seconds

            //                 } 
            //                 else 
            //                 {
            //                     swal_error_popup('Something went wrong');
            //                 }
            //             },

            //             error: function (xhr) {
            //                 Swal.close();
            //                 let message = 'Error while saving profile';
            //                 if (xhr.responseJSON && xhr.responseJSON.message) {
            //                     message = xhr.responseJSON.message;
            //                 }
            //                 swal_error_popup(message);
            //             }
            //         });

            // });


            $(document).on('click', '.save_profile_btn', function(e) {
                e.preventDefault();


                let form = $(this).closest('form');
                let formData = new FormData(form[0]);
                let type = formData.get('type');


                if (type == 'profile') {
                    if (!validateForm('masseur_frm_about')) {
                        return false;
                    }
                } else if (type == 'availibility') {
                    var hasError = validateAvailability();
                    if (hasError) {
                        swal_error_warning('My Availability',
                            'Please select a time range or choose an availability option for each day.')
                        return false;
                    }
                } else if (type == 'rates') {
                    var existRates = checkRates();
                    if (!existRates) {
                        swal_error_warning('Rates', 'You must complete at least one rate value to proceed.')
                        return false;
                    }
                }


                $.ajax({
                    method: form.attr('method'),
                    url: "{{ route('center.update-masseur') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $(this).prop('disabled', false);
                        $(this).html('Update');
                        if (!data.error) {
                            swal_success_popup(data.message);
                            setTimeout(function() {
                                //location.reload();
                            }, 2000);
                        } else {
                            swal_error_popup('Oops.. sumthing wrong Please try again');
                        }
                    }
                });

            });






            $('.select-Photo').on('click', function(e) {
                $("#photo_gallery").modal('hide');

            })



            $("body").on('submit', '#mulitiImage', function(e) {


                console.log('mulitiImage===============');
                e.preventDefault();

                //return false;

                let selectedImagesCount = parseInt(countSelectedImages());
                let page_token = $('#page_token').val();
                let existingImagesCount = parseInt($("input[name='media_count']").val());
                if ((existingImagesCount + selectedImagesCount) > 30) {
                    swal.fire('Media',
                        "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>",
                        'error');
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
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Uploading...',
                            text: 'Please wait while we upload your files.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            resetAddPhotoFrom(form);
                        } else if (data.status == 405) {
                            swal.fire('Media',
                                "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>",
                                'error');
                            $("#exampleModal").modal('hide');
                        } else {
                            swal.fire('Media', 'Please choose atleast one image', 'error');
                        }

                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let messages = Object.values(JSON.parse(xhr.responseText).errors)
                                .flat().join('<br>');
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: messages
                            });
                        } else {
                            let message = xhr.status === 500 ? JSON.parse(xhr.responseText)
                                .message : xhr.responseText;
                            Swal.fire({
                                icon: 'error',
                                title: xhr.statusText,
                                text: message || 'Something went wrong.'
                            });
                            if (xhr.status === 200) {
                                resetAddPhotoFrom(form);
                            }
                        }

                    }
                });
            });




            var resetAddPhotoFrom = function(form) {
                $('#image_preview a:not(:first)').remove();

                $(".js_bannerDefaultImage").attr('src', bannerDefaultImage);
                $(".js_pinupDefaultImage").attr('src', pinupDefaultImage);
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

            var countSelectedImages = function() {
                let excludeList = ['upload-thum-1.png', 'upload-3.png', 'add-pinup-banner-full.png'];
                let imageNames = [];
                $('.js_galleryMedia').each(function() {
                    let src = $(this).attr('src');
                    if (!src) return;
                    let fileNameWithExt = src.split('/').pop();
                    if (!excludeList.includes(fileNameWithExt)) {
                        imageNames.push(fileNameWithExt);
                    }
                });
                return imageNames.length;
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
                    let index = profile_selected_images.findIndex(item => item.updatePosition ===
                        updatePosition);
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

                    console.log('profile_selected_images.length', profile_selected_images.length);

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
                        updateDefaultImage(item.updatePosition, item.mediaId, item.img_target, item
                            .imageSrc);
                        if (profile_selected_images.length == (index + 1)) {
                            profile_selected_images = [];
                        }
                    });
                    $("#setAsDefaultForMainAccount").modal('hide');
                }
            }


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    //console.log(reader);
                    var imgbytes = input.files[0].size;
                    var imgkbytes = Math.round(parseInt(imgbytes) / 1024);
                    var imgMB = Math.round(parseInt(imgkbytes) / 1024);
                    if (imgMB <= 4) {
                        reader.onload = function(e) {
                            $('#blah' + input.id[3])
                                .attr('src', e.target.result);

                        };
                    } else {
                        //alert("file size in MB = "+imgMB);
                        $('.comman_msg').html("Can't upload more than 4 MB size");
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




            $('.select-Photo').on('click', function(e) {
                $("#photo_gallery").modal('hide');

            })

            $(document).on('click', '.deleteId', function(e) {
                e.preventDefault();
                let index = $(this).attr('data-id');
                allFiles[index] = null;
                $(`#atag_${index}`).remove();
                $(`.rm_${index}`).remove();
                updateInputFiles();
            });

            function updateInputFiles() 
            {
                const dt = new DataTransfer();
                selectedFiles.forEach(file => {
                    dt.items.add(file);
                });

                document.getElementById('upload_file').files = dt.files;
            }



        });



        


        function positionToUpdate(position) {
            updatePosition = position;
            return true;
        }




        const CHUNK_SIZE = 1024 * 1024;
        let currentPageUrl = window.location.href;
        var bannerDefaultImage;
        var pinupDefaultImage;
        var allFiles = [];
        var max_file = 50;

        let selectedVideoId = null;
        let selectedVideoPosition = null;
        let selectedFiles = [];

        function preview_image(event) {
            const input = document.getElementById("upload_file");
            const files = Array.from(input.files);
            const previousSelectedImagesCount = $("#image_preview .js_galleryMedia").length;
            files.forEach((file, i) => {
                const fileSizeMB = file.size / (1024 * 1024);
                const index = previousSelectedImagesCount + i;

                if (fileSizeMB <= max_file) {
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
                    Swal.fire('Media', "Can't upload more than 4 MB", 'error');
                }
            });
            input.value = '';
        }


        $('body').on('click', '.deleteimg', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let prevTag = $(this).prev().children().first()[0]?.tagName;
            $('.img_comman_msg').text("Delete");
            if (prevTag == 'VIDEO') {
                $('#dVideo').attr('remove_media_id', id);
                $("#delete_video").modal('show');
            } else {
                $('#dImg').attr('remove_media_id', id);
                $("#delete_img").modal('show');
            }
        });


        $('body').on('click', '#dImg', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: `/center-dashboard/delete-masseur-photos/${$(this).attr('remove_media_id')}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $(".img_comman_msg").text('Deleting...');
                },
                success: function(data) {
                    getAccountMediaGallery().then(function() {
                        $("#delete_img").modal('hide');
                        $(".img_comman_msg").text('Delete');
                    });
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    swal.fire('', "<p>" + errors.message + "</p>", 'error');
                }
            });
        });
        $(document).on('click', '#escort_profile_media_filter_type .nav-link', function(e) {
            e.preventDefault();
            $('#escort_profile_media_filter_type .nav-link').removeClass('active');
            $(this).addClass('active');
            getAccountMediaGallery();
        });

        var getAccountMediaGallery = function() {
            let page_token = $('#page_token').val();
            let activeGalleryTab = $(".js_gallery_category .nav-link.active").attr('data-type');
            let activeStatusTab = $("#escort_profile_media_filter_type .nav-link.active").attr('data-filter-type');
            return $.ajax({
                url: `/center-dashboard/get-massuers-account-media-gallery/${activeGalleryTab}/${page_token}/${activeStatusTab}`,
                type: "GET",
                dataType: "json"
            }).done(function(response) {
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
                     getMediaCount()
                }
            }).fail(function(xhr, status, error) {
                console.error("Error:", error);
            });
        }


        
    function getMediaCount(){
        return $.ajax({
            url: `/center-dashboard/get-masseurs-media-count`,
            type: "GET",
            dataType: "json",
            data: { masseur_id: "{{$masseur->id}}" },
        }).done(function (response) {
            let btn = $('#MediaVerification');
            let tooltip = btn.find('.timer_tooltip');
            if (response.success && response.total_media_count < 1) {
                btn.prop('disabled', true);
                btn.addClass('disabled-img-btn')
                tooltip.text('No any media.');
            } 
            else if (response.success && response.media_count_for_verification < 1){
                btn.prop('disabled', true);
                tooltip.text('No media available for verification.');
                btn.addClass('disabled-img-btn');
            } 
            else {
                btn.prop('disabled', false);
                tooltip.text('You must provide your Media Verification within 48 hours.');
                btn.removeClass('disabled-img-btn')
            }

        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }

        function updateDefaultImage(position, meidaId, img_target, media_src) {
            var url = "{{ route('center.masseur.default.images') }} ";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    position: position,
                    meidaId: meidaId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.error == true) {
                        img_target.attr('data-id', meidaId);
                        img_target.attr('src', media_src);
                    } else {
                        swal.fire('', "<p>" + data.msg + "</p>", 'error');

                        $('#comman_modal').on('hidden.bs.modal', function() {

                        });
                    }
                }
            });
        }






        //     $(document).on('click','.modalPopup .item2,.modalPopup .item4', function(e) {
        //        let imageSrc = $(this).find('img').attr('src');
        //        let mediaId = $(this).find('img').data('id');
        //        let img_target = $("#img"+updatePosition);
        //        updateDefaultImage(updatePosition, mediaId, img_target, imageSrc);
        //        $(`#${$(this).parents('.modal').attr('id')}`).modal("hide");
        //    });


        $(document).on('input', '.allow_only_numeric', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });


getAccountMediaGallery();


function initDragDrop()
{

    console.log("initDragDrop");
    //$(".grid-container .defult-image.ui-draggable").draggable("destroy");
    $(".grid-container .defult-image").draggable({
        revert: "invalid",
        appendTo: "body",
        cursor: "move",
        zIndex: 999999,

        helper: function(){

            let src = $(this).attr("src");
            let mediaId = $(this).data('id');

            console.log('mediaId',mediaId);
           

            return $("<img>")
                .attr("src", src)
                .css({
                    width: "90px",
                    height: "auto",
                    borderRadius: "6px",
                    boxShadow: "0 4px 10px rgba(0,0,0,0.3)"
                });

        },
        start: function(event, ui) {
            let type = $(this).closest(".item4").find("span.badge").text().toLowerCase().trim();
            $(this).data("drag-type", type);
        }
    });

   
    $(".dvDest").droppable({

        hoverClass: "drop-hover",

        drop: function(event, ui){

            let dropSlot = $(this);
            let dragSlot = ui.draggable;

            let dropSlotType = dropSlot.find("img").attr("data-type");
            // let dragSlotType = dragSlot.closest(".item4").find("span").text().toLowerCase();
            let dragSlotType = dragSlot.data("drag-type");
            let imgSrc = dragSlot.attr("src");
            let imgId  = dragSlot.attr("data-id");
            let position  = dragSlot.attr("data-position");
            let dropPosition = dropSlot.find("img").data("position");
            if(dropSlotType === dragSlotType){

              
                let alreadyUsed = false;

                $(".dvDest img").each(function(){
                    if($(this).attr("data-id") == imgId){
                        alreadyUsed = true;
                    }
                });

                if(alreadyUsed){
                    Swal.fire({
                        icon: "warning",
                        title: "Duplicate Image",
                        text: "This image is already used."
                    });
                    return;
                }

                console.log('position',dropPosition)
                
                dropSlot.find("img")
                    .attr("src", imgSrc)
                    .attr("data-id", imgId);

                $('#mediaId'+dropPosition).val(imgId);
                getMediaByIdAndStatusShow(imgId, dropPosition)
            }

        }

    });

}
let selectedImageId = null;
let selectedPosition = null;

$(document).on('click', '.dvDest', function () {

    $(".dvDest").removeClass("active");
    $(this).addClass("active");
    selectedPosition = $(this).find("img").data("position");
    console.log("Selected Position:", selectedPosition);
});


$(document).on('click', '.select_image', function () {
    selectedImageId = $(this).data('id');
    if (!selectedPosition) {
        console.log("Position not set yet");
        return;
    }
    getMediaByIdAndStatusShow(selectedImageId,selectedPosition);
});
    
 function getMediaByIdAndStatusShow(media_id, position) {
        position = String(position).trim();
        let iconBox = $('#verify_icon_' + position);

        if (iconBox.length === 0) {
            console.log("Icon box not found for position:", position);
            return;
        }

        $.ajax({
            url: '/center-dashboard/get-masseur-image-info',
            type: 'POST',
            data: {
                media_id: media_id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                let status = res.data.varified;
                let template = res.data.template;

                if (status === null || typeof status === "undefined") {
                    iconBox.html('').hide();
                    return;
                }

                let iconPath = '';
                let iconText = '';

                if (position == 1) {
                    if (status == "0") {
                        iconPath = '/assets/app/img/pending_icon/e4u_pending_REV.png';
                        iconText = '<span class="mass_tooltip">Media Pending</span>';
                    } else if (status == "1") {
                        iconPath = '/assets/app/img/verify/e4u_verified_REV.png';
                        iconText = '<span class="mass_tooltip">Media Verified</span>';
                    } else {
                        iconPath = '/assets/app/img/verify/unverified_light.png';
                        iconText = '<span class="mass_tooltip">Media Unverified</span>';
                    }
                } else {
                    if (status == "0") {
                        iconPath = '/assets/app/img/pending_icon/e4u_pending-icon_REV.png';
                        iconText = '<span class="mass_sm_tooltip">Media Pending</span>';
                    } else if (status == "1") {
                        iconPath = '/assets/app/img/verify/verified_icon.png';
                        iconText = '<span class="mass_sm_tooltip">Media Verified</span>';
                    } else {
                        iconPath = '/assets/app/img/verify/unverified_icon.png';
                        iconText = '<span class="mass_sm_tooltip">Media Unverified</span>';
                    }
                }

                iconBox.html(`<img src="${iconPath}">${iconText}`);

                if (template == "1") {
                    iconBox.hide();
                } else {
                    iconBox.show();
                }
            },
            error: function() {
                iconBox.html('').hide();
            }
        });
}

function readVarificationImageURL(input) {
    if (input.files && input.files[0]) {
        var $img = $(input).siblings('img');
        var reader = new FileReader();
        reader.onload = function (e) {
            $img.attr('src', e.target.result);
            $('#VerifyMedia').attr('disabled', false);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


$(document).off('submit', '#mediaVerification');
$(document).on('submit', '#mediaVerification', function (e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);
    formData.append('masseur_profile_id', "{{$masseur->id}}");
    let button = $('#verifyMediaBtn');
    button.text('Verifying...');
    button.prop('disabled', true);

    let fileInput = $(form).find('input[type="file"]')[0];
   
    if (!fileInput.files.length) {
        Swal.fire({
            icon: 'warning',
            title: 'Image Required',
            text: 'Please upload verification image.'
        });
        button.prop('disabled', false).text('Verify Media');
        return;
    }

    let file = fileInput.files[0];

    let allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!allowedTypes.includes(file.type)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid File Type',
            text: 'Only JPG and PNG images are allowed.'
        });
        button.prop('disabled', false).text('Verify Media');
        return;
    }

    let maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
        Swal.fire({
            icon: 'error',
            title: 'File Too Large',
            text: 'Image size must be less than 5MB.'
        });
        button.prop('disabled', false).text('Verify Media');
        return;
    }

    $.ajax({
        url: $(form).attr('action'),
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        before: function (response) {
            button.prop('disabled', true);
            button.text('Verifing...');
        },
        success: function (response) {

            Swal.fire({
                icon: 'success',
                title: 'Success',
                html: response.message.replace(/\n/g, "<br>")
            });
            getAccountMediaGallery();
             // form.reset();  //
            $('.img_alert').show();
            $('.upload_varification_img_wrapper').addClass('has_img');
            $('#veryfy_media').modal('hide');
        },
        error: function (xhr) {
            let errorMsg = 'Something went wrong.';

            if (xhr.responseText) {
                try {
                    let res = JSON.parse(xhr.responseText);
                    if (res.message) {
                        errorMsg = res.message;
                    }
                } catch (e) {
                    console.log('JSON parse error');
                }
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMsg
            });
        },
        complete: function () {
            button.prop('disabled', false);
            button.text('Verify Media');
        }
    });

});


$(document).ready(function () 
{

    function toggleOtherServices() 
    {
        // first checkbox (Massage)
        let isMassageChecked = $('input[name="service[]"][value="massage"]').is(':checked');

        // other two checkboxes
        let otherCheckboxes = $('input[name="service[]"][value="2_hand"], input[name="service[]"][value="4_hand"]');

        if (isMassageChecked) {

            // enable other checkboxes
            otherCheckboxes.prop('disabled', false);

        } else {

            // uncheck + disable other checkboxes
            otherCheckboxes.prop('checked', false);
            otherCheckboxes.prop('disabled', true);
        }
    }

    toggleOtherServices();

    $('input[name="service[]"][value="massage"]').on('change', function () {
            toggleOtherServices();
    });


    $('#massage_service').change(function() {
            console.log('===========');
            var languageValue = $('#massage_service').val();
            $("#show_massage_service").show();
            //$(".select_lang").hide();
            var selectedLanguage = $(this).children("option:selected", this).data("name");
            $("#show_db_massage_service").append(" <div class='selecated_languages massage_service select_lang' id="+languageValue+"><span class='languages_choosed_from_drop_down'>" + selectedLanguage + " <small class='remove-lang remove-lang-massage-service'>×</small></span> </div> ");
            $("#container_massage_service").append("<input type='hidden' name='massage_service_list[]' value=" + languageValue + ">");
            $("#massage_service option[value='" + languageValue + "']").remove();
        });

        $(document).on('click', '.remove-lang-massage-service , span.custom--help', function() {
            let parent = $(this).closest('.massage_service');
            let id = parent.attr('id');
            $('#container_massage_service input[name="massage_service_list[]"][value="'+id+'"]').remove();
            $(this).closest('.massage_service').remove();
            //$(this).closest('.custom-help-contain').toggleClass('help-note-toggle');
        });


        $('#massage_other_service').change(function() {
            console.log('===========');
            var languageValue = $('#massage_other_service').val();
            $("#show_massage_other_service").show();
            //$(".select_lang").hide();
            var selectedLanguage = $(this).children("option:selected", this).data("name");
            $("#show_db_massage_other_service").append(" <div class='selecated_languages massage_other_service select_lang' id="+languageValue+"><span class='languages_choosed_from_drop_down'>" + selectedLanguage + " <small class='remove-lang remove-lang-massage-other-service'>×</small></span> </div> ");
            $("#container_massage_other_service").append("<input type='hidden' name='massage_other_service_list[]' value=" + languageValue + ">");
            $("#massage_other_service option[value='" + languageValue + "']").remove();
        });

        $(document).on('click', '.remove-lang-massage-other-service , span.custom--help', function() {
            let parent = $(this).closest('.massage_other_service');
            let id = parent.attr('id');
            $('#container_massage_other_service input[name="massage_other_service_list[]"][value="'+id+'"]').remove();
            $(this).closest('.massage_other_service').remove();
            //$(this).closest('.custom-help-contain').toggleClass('help-note-toggle');
        });


});
</script>
@endpush
