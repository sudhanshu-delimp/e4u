@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style>


.pis {
    display: none;
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
                {{-- start content --}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="add-mcc-section">
                            <form action="">
                              {{-- About The Masseur --}}
                                <div class="mcc-form-tab">
                                    <h2 class="mcc-heading">About The Masseur</h2>
                                    <div class="business-info-field pt-4">
                                        <!-- Personal Info -->
                                        <div class="form-group business-field">
                                            <label for="masseurName" class="mb-1">Name</label>
                                            <input type="text" id="masseurName" class="form-control rounded-0"
                                                placeholder="Enter Name" required>
                                        </div>
                                        <div class="form-group business-field">
                                            <label for="stageName" class="mb-1">Stage Name</label>
                                            <input type="text" id="stageName" class="form-control rounded-0"
                                                placeholder="Enter Stage Name" required>
                                        </div>
                                        <div class="form-group business-field">
                                            <label for="masseurMobile" class="mb-1">Mobile</label>
                                            <input type="text" id="masseurMobile" class="form-control rounded-0"
                                                placeholder="Enter Mobile" required>
                                        </div>

                                        <div class="form-group business-field">
                                            <label for="nationality" class="mb-1">Nationality</label>
                                            <select id="nationality" class="form-control rounded-0" required>
                                                <option value="">-Not Set-</option>
                                            </select>
                                        </div>

                                        <div class="form-group business-field">
                                            <label for="ethnicity" class="mb-1">Ethnicity</label>
                                            <select id="ethnicity" class="form-control rounded-0" required>
                                                <option value="">-Not Set-</option>
                                            </select>
                                        </div>

                                        <div class="form-group business-field">
                                            <label for="age" class="mb-1">Age</label>
                                            <input type="number" id="age" class="form-control rounded-0"
                                                placeholder="Enter Age">
                                        </div>
                                        <div class="form-group">
                                            <label class="label">Vaccination</label>
                                            <div class="d-flex justify-content-start gap-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vaccination"
                                                        id="vaccinatedNotUpToDate" value="not_up_to_date">
                                                    <label class="form-check-label" for="vaccinatedNotUpToDate">
                                                        Vaccinated, not up to date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vaccination"
                                                        id="vaccinatedUpToDate" value="up_to_date">
                                                    <label class="form-check-label" for="vaccinatedUpToDate">
                                                        Vaccinated, up to date
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vaccination"
                                                        id="notVaccinated" value="not_vaccinated">
                                                    <label class="form-check-label" for="notVaccinated">
                                                        Not Vaccinated
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                       
                                        <!-- Commentary -->
                                        <div class="form-group">
                                            <label for="commentary" class="label">Commentary</label>
                                            <textarea id="commentary" class="form-control rounded-0" placeholder="Commentary (max 300 words)" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
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
                                                                    src="{{ asset('assets/app/img/mcc-default-thumbnail.png') }}">
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
                                                                        <img class="w-100"
                                                                            id="img2"src="{{ asset('assets/app/img/frame-main-thum.png') }}">
                                                                    </label>
                                                                </div>
                                                                <div class="plate">
                                                                    <label class="newbtn" data-toggle="modal"
                                                                        data-target="#photo_gallery">
                                                                        <img class="w-100"
                                                                            id="img3"src="{{ asset('assets/app/img/frame-main-thum.png') }}">
                                                                    </label>
                                                                </div>
                                                                <div class="plate">
                                                                    <label class="newbtn" data-toggle="modal"
                                                                        data-target="#photo_gallery">
                                                                        <img class="w-100"
                                                                            id="img4"src="{{ asset('assets/app/img/frame-main-thum.png') }}">
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
                                        </div>
                                    </div>
                                </div>
                                {{-- My Availability --}}
                                <div class="mcc-form-tab">
                                    <h2>My Availability</h2>
                                    <div
                                        class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                        <div style="width:100px;">
                                            <label class="col-0 label" for="monday">Monday:
                                            </label>
                                            <input type="hidden" value="monday">
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date monday p-0 change_default"
                                                name="mon_from" id="monfrom" data-parsley-gt="#mon_to"
                                                day_key_from="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow monday p-0 change_default"
                                                id="monfromtime" name="mon_time_from" day_key_from="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">
                                                    AM</option>
                                                <option value="PM">
                                                    PM</option>
                                            </select>
                                        </div>

                                        <div class=" p-md-0" style="text-align: center;">
                                            <span class="text-muted font-13">To</span>
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date monday p-0 change_default"
                                                name="mon_to" id="mon_to" day_key_to="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow monday p-0 change_default"
                                                id="mon_time_to" name="mon_time_to" day_key_to="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">AM
                                                </option>
                                                <option value="PM">PM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input monday" type="radio"
                                                    name="availability_time[monday]" id="monday_til_ate" value="til_ate"
                                                    data-parsley-multiple="covidreport" availability_time_key="mon">
                                                <label class="form-check-label" for="monday_til_ate">... Til late</label>
                                            </div>
                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input monday" type="radio"
                                                    name="availability_time[monday]" id="monday_unavailable"
                                                    value="unavailable" data-parsley-multiple="covidreport"
                                                    checked="" availability_time_key="mon">
                                                <label class="form-check-label"
                                                    for="monday_unavailable">Unavailable</label>
                                            </div>
                                        </div>

                                        <div class="resetdays-icon">
                                            <input type="button" value="Reset" class="resetdays" data-day="monday"
                                                id="resetMonday">
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                        <div style="width:100px;">
                                            <label class="col-0 label" for="tuesday">Tuesday:
                                            </label>
                                            <input type="hidden" value="tuesday">
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date tuesday p-0 change_default"
                                                name="mon_from" id="monfrom" data-parsley-gt="#mon_to"
                                                day_key_from="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow tuesday p-0 change_default"
                                                id="monfromtime" name="mon_time_from" day_key_from="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">
                                                    AM</option>
                                                <option value="PM">
                                                    PM</option>
                                            </select>
                                        </div>

                                        <div class=" p-md-0" style="text-align: center;">
                                            <span class="text-muted font-13">To</span>
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date tuesday p-0 change_default"
                                                name="mon_to" id="mon_to" day_key_to="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow tuesday p-0 change_default"
                                                id="mon_time_to" name="mon_time_to" day_key_to="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">AM
                                                </option>
                                                <option value="PM">PM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input tuesday" type="radio"
                                                    name="availability_time[tuesday]" id="tuesday_til_ate" value="til_ate"
                                                    data-parsley-multiple="covidreport" availability_time_key="mon">
                                                <label class="form-check-label" for="tuesday_til_ate">... Til late</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input tuesday" type="radio"
                                                    name="availability_time[tuesday]" id="tuesday_unavailable"
                                                    value="unavailable" data-parsley-multiple="covidreport"
                                                    checked="" availability_time_key="mon">
                                                <label class="form-check-label"
                                                    for="tuesday_unavailable">Unavailable</label>
                                            </div>
                                        </div>

                                        <div class="resetdays-icon">
                                            <input type="button" value="Reset" class="resetdays" data-day="tuesday"
                                                id="resetTuesday">
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                        <div style="width:100px;">
                                            <label class="col-0 label" for="wednesday">Wednesday:

                                            </label>
                                            <input type="hidden" value="wednesday">
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date wednesday p-0 change_default"
                                                name="mon_from" id="monfrom" data-parsley-gt="#mon_to"
                                                day_key_from="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow wednesday p-0 change_default"
                                                id="monfromtime" name="mon_time_from" day_key_from="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">
                                                    AM</option>
                                                <option value="PM">
                                                    PM</option>
                                            </select>
                                        </div>

                                        <div class=" p-md-0" style="text-align: center;">
                                            <span class="text-muted font-13">To</span>
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date wednesday p-0 change_default"
                                                name="mon_to" id="mon_to" day_key_to="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow wednesday p-0 change_default"
                                                id="mon_time_to" name="mon_time_to" day_key_to="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">AM
                                                </option>
                                                <option value="PM">PM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input wednesday" type="radio"
                                                    name="availability_time[wednesday]" id="wednesday_til_ate" value="til_ate"
                                                    data-parsley-multiple="covidreport" availability_time_key="mon">
                                                <label class="form-check-label" for="wednesday_til_ate">... Til late</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input wednesday" type="radio"
                                                    name="availability_time[wednesday]" id="wednesday_unavailable"
                                                    value="unavailable" data-parsley-multiple="covidreport"
                                                    checked="" availability_time_key="mon">
                                                <label class="form-check-label"
                                                    for="wednesday_unavailable">Unavailable</label>
                                            </div>
                                        </div>

                                        <div class="resetdays-icon">
                                            <input type="button" value="Reset" class="resetdays" data-day="wednesday"
                                                id="resetWednesday">
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                        <div style="width:100px;">
                                            <label class="col-0 label" for="thursday">Thursday:


                                            </label>
                                            <input type="hidden" value="thursday">
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date thursday p-0 change_default"
                                                name="mon_from" id="monfrom" data-parsley-gt="#mon_to"
                                                day_key_from="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow thursday p-0 change_default"
                                                id="monfromtime" name="mon_time_from" day_key_from="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">
                                                    AM</option>
                                                <option value="PM">
                                                    PM</option>
                                            </select>
                                        </div>

                                        <div class=" p-md-0" style="text-align: center;">
                                            <span class="text-muted font-13">To</span>
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date thursday p-0 change_default"
                                                name="mon_to" id="mon_to" day_key_to="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow thursday p-0 change_default"
                                                id="mon_time_to" name="mon_time_to" day_key_to="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">AM
                                                </option>
                                                <option value="PM">PM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input thursday" type="radio"
                                                    name="availability_time[thursday]" id="thursday_til_ate" value="til_ate"
                                                    data-parsley-multiple="covidreport" availability_time_key="mon">
                                                <label class="form-check-label" for="thursday_til_ate">... Til late</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input thursday" type="radio"
                                                    name="availability_time[thursday]" id="thursday_unavailable"
                                                    value="unavailable" data-parsley-multiple="covidreport"
                                                    checked="" availability_time_key="mon">
                                                <label class="form-check-label"
                                                    for="thursday_unavailable">Unavailable</label>
                                            </div>
                                        </div>

                                        <div class="resetdays-icon">
                                            <input type="button" value="Reset" class="resetdays" data-day="thursday"
                                                id="resetThursday">
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                        <div style="width:100px;">
                                            <label class="col-0 label" for="friday">Friday:



                                            </label>
                                            <input type="hidden" value="friday">
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date friday p-0 change_default"
                                                name="mon_from" id="monfrom" data-parsley-gt="#mon_to"
                                                day_key_from="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow friday p-0 change_default"
                                                id="monfromtime" name="mon_time_from" day_key_from="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">
                                                    AM</option>
                                                <option value="PM">
                                                    PM</option>
                                            </select>
                                        </div>

                                        <div class=" p-md-0" style="text-align: center;">
                                            <span class="text-muted font-13">To</span>
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date friday p-0 change_default"
                                                name="mon_to" id="mon_to" day_key_to="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow friday p-0 change_default"
                                                id="mon_time_to" name="mon_time_to" day_key_to="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">AM
                                                </option>
                                                <option value="PM">PM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input friday" type="radio"
                                                    name="availability_time[friday]" id="friday_til_ate" value="til_ate"
                                                    data-parsley-multiple="covidreport" availability_time_key="mon">
                                                <label class="form-check-label" for="friday_til_ate">... Til late</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input friday" type="radio"
                                                    name="availability_time[friday]" id="friday_unavailable"
                                                    value="unavailable" data-parsley-multiple="covidreport"
                                                    checked="" availability_time_key="mon">
                                                <label class="form-check-label"
                                                    for="friday_unavailable">Unavailable</label>
                                            </div>
                                        </div>

                                        <div class="resetdays-icon">
                                            <input type="button" value="Reset" class="resetdays" data-day="friday"
                                                id="resetFriday">
                                        </div>
                                    </div>


                                    <div
                                        class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                        <div style="width:100px;">
                                            <label class="col-0 label" for="saturday">Saturday:


                                            </label>
                                            <input type="hidden" value="saturday">
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date saturday p-0 change_default"
                                                name="mon_from" id="monfrom" data-parsley-gt="#mon_to"
                                                day_key_from="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow saturday p-0 change_default"
                                                id="monfromtime" name="mon_time_from" day_key_from="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">
                                                    AM</option>
                                                <option value="PM">
                                                    PM</option>
                                            </select>
                                        </div>

                                        <div class=" p-md-0" style="text-align: center;">
                                            <span class="text-muted font-13">To</span>
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date saturday p-0 change_default"
                                                name="mon_to" id="mon_to" day_key_to="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow saturday p-0 change_default"
                                                id="mon_time_to" name="mon_time_to" day_key_to="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">AM
                                                </option>
                                                <option value="PM">PM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input saturday" type="radio"
                                                    name="availability_time[saturday]" id="saturday_til_ate" value="til_ate"
                                                    data-parsley-multiple="covidreport" availability_time_key="mon">
                                                <label class="form-check-label" for="saturday_til_ate">... Til late</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input saturday" type="radio"
                                                    name="availability_time[saturday]" id="saturday_unavailable"
                                                    value="unavailable" data-parsley-multiple="covidreport"
                                                    checked="" availability_time_key="saturday">
                                                <label class="form-check-label"
                                                    for="saturday_unavailable">Unavailable</label>
                                            </div>
                                        </div>

                                        <div class="resetdays-icon">
                                            <input type="button" value="Reset" class="resetdays" data-day="saturday"
                                                id="resetSaturday">
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                        <div style="width:100px;">
                                            <label class="col-0 label" for="sunday">Sunday:



                                            </label>
                                            <input type="hidden" value="sunday">
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date sunday p-0 change_default"
                                                name="mon_from" id="monfrom" data-parsley-gt="#mon_to"
                                                day_key_from="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow sunday p-0 change_default"
                                                id="monfromtime" name="mon_time_from" day_key_from="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">
                                                    AM</option>
                                                <option value="PM">
                                                    PM</option>
                                            </select>
                                        </div>

                                        <div class=" p-md-0" style="text-align: center;">
                                            <span class="text-muted font-13">To</span>
                                        </div>

                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date sunday p-0 change_default"
                                                name="mon_to" id="mon_to" day_key_to="mon">
                                                <option value="" selected="">H:M</option>
                                            </select>
                                            <select
                                                class="form-control form-control-sm select_tag_remove_box_sadow sunday p-0 change_default"
                                                id="mon_time_to" name="mon_time_to" day_key_to="mon"
                                             >
                                                <option value="" selected="">--</option>
                                                <option value="AM">AM
                                                </option>
                                                <option value="PM">PM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input sunday" type="radio"
                                                    name="availability_time[sunday]" id="sunday_til_ate" value="til_ate"
                                                    data-parsley-multiple="covidreport" availability_time_key="mon">
                                                <label class="form-check-label" for="sunday_til_ate">... Til late</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input sunday" type="radio"
                                                    name="availability_time[sunday]" id="sunday_unavailable"
                                                    value="unavailable" data-parsley-multiple="covidreport"
                                                    checked="" availability_time_key="mon">
                                                <label class="form-check-label"
                                                    for="sunday_unavailable">Unavailable</label>
                                            </div>
                                        </div>

                                        <div class="resetdays-icon">
                                            <input type="button" value="Reset" class="resetdays" data-day="sunday"
                                                id="resetSunday">
                                        </div>
                                    </div>
                                </div>
                                {{-- Rate --}}
                                <div class="mcc-form-tab">
                                    <h2>Rate</h2>
                                    <div class="row">
                                        <div
                                            class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates pt-5">
                                            <div class="rate_first_row row">
                                                <div class="col-3">
                                                </div>
                                                <div class="col-3 rate-img-center rate-tooltip">
                                                    <img src="{{ asset('assets/dashboard/img/massage-only.png') }}"
                                                        class="w-50">
                                                    <span class="tooltip-info">Massage only</span>
                                                </div>
                                                <div class="col-3 rate-img-center rate-tooltip">
                                                    <img src="{{ asset('assets/dashboard/img/massage-with2.png') }}"
                                                        class="w-50">
                                                    <span class="tooltip-info">Massage with Extras, 2 hands.</span>
                                                </div>
                                                <div class="col-3 rate-img-center rate-tooltip">
                                                    <img src="{{ asset('assets/dashboard/img/massage-with4.png') }}"
                                                        class="w-50">
                                                    <span class="tooltip-info">Massage with Extras, 2 hands.</span>
                                                </div>
                                            </div>
                                            <div class="rate_first_row">
                                                <input type="hidden" name="duration_id[]" value="2">
                                                <div class="form-group row">
                                                    <label class="col-3 label" for="exampleFormControlSelect1">30
                                                        Minutes:</label>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="massage_price" name="massage_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="incall_price" name="incall_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="outcall_price" name="outcall_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rate_first_row">
                                                <input type="hidden" name="duration_id[]" value="3">
                                                <div class="form-group row">
                                                    <label class="col-3 label" for="exampleFormControlSelect1">45
                                                        Minutes:</label>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="massage_price" name="massage_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="incall_price" name="incall_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="outcall_price" name="outcall_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rate_first_row">
                                                <input type="hidden" name="duration_id[]" value="4">
                                                <div class="form-group row">
                                                    <label class="col-3 label" for="exampleFormControlSelect1">1
                                                        Hour:</label>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="massage_price" name="massage_price[]"
                                                                value="" step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="incall_price" name="incall_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="outcall_price" name="outcall_price[]"
                                                                value="" step="10" max="200">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rate_first_row">
                                                <input type="hidden" name="duration_id[]" value="5">
                                                <div class="form-group row">
                                                    <label class="col-3 label" for="exampleFormControlSelect1">1.5
                                                        Hours:</label>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="massage_price" name="massage_price[]"
                                                                value="" step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="incall_price" name="incall_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="outcall_price" name="outcall_price[]"
                                                                value="" step="10" max="200">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rate_first_row">
                                                <input type="hidden" name="duration_id[]" value="6">
                                                <div class="form-group row">
                                                    <label class="col-3 label" for="exampleFormControlSelect1">2
                                                        Hours:</label>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="massage_price" name="massage_price[]"
                                                                value="" step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="incall_price" name="incall_price[]" value=""
                                                                step="10" max="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="service_rate_dolor_symbol form-group">
                                                            <span>$</span>
                                                            <input min="0" placeholder="0" type="number"
                                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                                id="outcall_price" name="outcall_price[]"
                                                                value="" step="10" max="200">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end py-3">
                                    <button type="button" class="btn-common">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- end --}}
            </div>
        </div>
    </div>



    <div class="modal" id="photo_gallery" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title" style="color: white;"><img
                            src="{{ asset('assets/dashboard/img/banner.png') }}" class="custompopicon"> Select Photo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body gallery-modal">
                    <div id="gallery_modal_container" class="grid-container modalPopup"
                        style="max-height: 500px; overflow-y:scroll;">


                        <div class="default-img-mcc">
                            <img class="img-thumbnail defult-image select_image"
                                src="{{ asset('escorts/images/203/9539b7a0b8f7dfe5b5ff82675.jpg') }}" alt=" "
                               >
                        </div>
                        <div class="default-img-mcc">
                            <img class="img-thumbnail defult-image select_image"
                                src="{{ asset('escorts/images/203/6bb13756ba0293d53e059f499.jpg') }}" alt=" "
                                >
                        </div>
                        <div class="default-img-mcc">
                            <img class="img-thumbnail defult-image select_image"
                                src="{{ asset('escorts/images/203/2175285317b919c07f892ff40.jpg') }}" alt=" "
                                >
                        </div>
                        <div class="default-img-mcc">
                            <img class="img-thumbnail defult-image select_image"
                                src="{{ asset('escorts/images/203/c75304a26c587132b15efe031.jpg') }}" alt=" "
                                >
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
{{-- upload photo popup --}}

<div class="modal fade upload-modal" id="add_photo_mcc" tabindex="-1" role="dialog" aria-labelledby="add_photo_mccLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document">
       <div class="modal-content" style="width: 900px;position: absolute;">
           <form id="mulitiImage" method="POST" action="{{route('escort.upload.gallery')}}" enctype="multipart/form-data">
               @csrf
               <div class="modal-content border-0">
                   <div class="modal-header">
                       <h5 class="modal-title" id="add_photo_mccLongTitle"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Upload Photos</h5>
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
                                                   <div class="five_column_content_top img-title-sec justify-content-start wish_span rm" 2tyle="z-index: 1;">
                                                     
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

@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
@endpush
