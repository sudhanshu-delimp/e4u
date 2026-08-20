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

        .modalPopup>.item4 {
            cursor: pointer;
        }

        .modalPopup>.item2 {
            cursor: pointer;
        }
        
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
            gap: 10px;
        }

        .grid-container>div {
            background-color: rgba(255, 255, 255, 0.8);
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

     .modal-tab {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
        }

        .my-custompop-tabs .nav-item {
            margin-bottom: 0px !important;
        }

        .my-custompop-tabs .nav-item .nav-link.active {
            color: #fff;
        } 
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Photos</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true"><b>Help?</b></span>
            </div>
            @if (request('from') == 'dashbaord')
                <div class="back-to-dashboard">
                    <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                    </a>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Upload your photos here (up to 30) and then select your default images including your
                                Thumbnail, other photos (up to six portrait) and your Banner Image (landscape) (<b>Default
                                    Images</b>).</li>
                            <li>Your Default Images will always appear in the Profile Creator when you activate the Profile
                                Creator (for a new Profile). If you change any of the Default Images in the Profile Creator,
                                like when you are creating a second Profile for the same Location, you will be asked if you
                                want to update your changes to the Default Images.</li>
                            <li>When uploading your Photos, make sure they comply with our <a href="/escort-dashboard/help"
                                    class="custom_links_design">Profile Image</a> guidelines, especially in terms of the
                                pixilation and the size of the photo.</li>
                            <li>If you don't upload a Banner Image (which is located at the top of your Profile), you can
                                select a template image from the list (<b>Template</b>). There is a range of Templates to
                                suit every mood, although we do encourage you to upload your own Banner. Remember, it is a
                                landscape image and you can include a montage.</li>
                            <li>
                                <ol class="level-2">
                                    <li>Uploaded Media will by default be labelled 'Pending' verification. If you List a
                                        Profile without having verified your Media, your Default Images verification status
                                        will be displayed as Pending.</li>
                                    <li>You must provide your Media Verification within 48 hours of having uploaded any
                                        Media otherwise your Media Verification status for all Media will change to
                                        Unverified and the appropriate icon will be displayed on any Listed Profile.</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3 d-flex justify-content-end gap-10">
                <button type="button" class="remove-avatar-btn" data-toggle="modal" data-target="#exampleModal">
                    <!-- Upload SVG -->
                    <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                        fill="#000000">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">
                            <path fill="#ffffff" fill-rule="evenodd"
                                d="M14,9.41421 C14.5523,9.41421 15,9.86192 15,10.41418 L15,13.41418 C15,14.51878 14.1046,15.41418 13,15.41418 L3,15.41418 C1.89543,15.41418 1,14.51878 1,13.41418 L1,10.41418 C1,9.86192 1.44772,9.41421 2,9.41421 C2.55228,9.41421 3,9.86192 3,10.41418 L3,13.41418 L13,13.41418 L13,10.41418 C13,9.86192 13.4477,9.41421 14,9.41421 Z M8,2 L11.7071,5.7071 C12.0976,6.09763 12.0976,6.73079 11.7071,7.12132 C11.3166,7.51184 10.6834,7.51184 10.2929,7.12132 L9,5.82842 L9,10.41418 C9,10.96648 8.55228,11.41418 8,11.41418 C7.44772,11.41418 7,10.96648 7,10.41418 L7,5.82842 L5.70711,7.12132 C5.31658,7.51184 4.68342,7.51184 4.29289,7.12132 C3.90237,6.73079 3.90237,6.09763 4.29289,5.7071 L8,2 Z">
                            </path>
                        </g>
                    </svg> Add Photos</button>
                @php
                    $isDisabled = false;
                    $tooltipMessage = '';
                    $disabledClass = '';

                    if ($total_media_count < 1) {
                        $isDisabled = true;
                        $disabledClass = 'disabled-img-btn';
                        $tooltipMessage = 'No media available.';
                    } elseif ($media_count_for_verification < 1) {
                        $isDisabled = true;
                        $disabledClass = 'disabled-img-btn';
                        $tooltipMessage = 'No media available for verification.';
                    } else {
                        $isDisabled = false;
                        $tooltipMessage = 'You must provide your Media Verification within 48 hours.';
                    }
                @endphp

                <button type="button" id="mediaVerification" class="change-avatar-btn verify_timer {{ $disabledClass }}"
                    data-toggle="modal" data-target="#mediaVerificationModal" {{ $isDisabled ? 'disabled' : '' }}>
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M9 12L11 14L15 9.99999M20 12C20 16.4611 14.54 19.6937 12.6414 20.683C12.4361 20.79 12.3334 20.8435 12.191 20.8712C12.08 20.8928 11.92 20.8928 11.809 20.8712C11.6666 20.8435 11.5639 20.79 11.3586 20.683C9.45996 19.6937 4 16.4611 4 12V8.21759C4 7.41808 4 7.01833 4.13076 6.6747C4.24627 6.37113 4.43398 6.10027 4.67766 5.88552C4.9535 5.64243 5.3278 5.50207 6.0764 5.22134L11.4382 3.21067C11.6461 3.13271 11.75 3.09373 11.857 3.07827C11.9518 3.06457 12.0482 3.06457 12.143 3.07827C12.25 3.09373 12.3539 3.13271 12.5618 3.21067L17.9236 5.22134C18.6722 5.50207 19.0465 5.64233 19.3223 5.88552C19.566 6.10027 19.7537 6.37113 19.8692 6.6747C20 7.01833 20 7.41808 20 8.21759V12Z"
                                stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </g>

                    </svg> Media Verification
                    <span class="timer_tooltip">
                        {{ $tooltipMessage }}
                    </span>
                </button>
            </div>
        </div>



        <div class="pm-layout">
            <div class="pm-default-card">
                <div class="pm-default-title">
                    <div class="pm-section-icon">
                        <!-- Image SVG -->
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                            <circle cx="8" cy="9" r="1.5"></circle>
                            <path d="m4 17 5-5 3 3 2-2 6 5"></path>
                        </svg>
                    </div>
                    <span>Your Default Images</span>
                </div>
                <div class="upload-photo-sec pm-default-body">
                    <form id="defaultImage" method="post" enctype="multipart/form-data"
                        action="{{ route('escort.default.images') }}">
                        @csrf
                        <div class="pm-default-section">
                            <h3>Thumbnail</h3>
                            <div class="plate pm-main-placeholder" data-toggle="modal" data-target="#photo_gallery"
                                onclick="positionToUpdate(1)">
                                <label class="newbtn dvDest lg_icon_wrapper" data-toggle="modal" data-target="#upload-sec"
                                    id="dvDest">
                                    <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="1"
                                        data-html="true" data-placement="top" title="" data-boundary="window"
                                        id="img1"
                                        src="{{ asset($path->findByposition(auth()->user()->id, 1, 1)['path']) }}">
                                    <input type="hidden" id="pos_1" name="position[1]" value="">
                                    @php
                                        $imageData = $path->findByposition(auth()->user()->id, 1, 1);
                                        if (!empty($imageData['id'])) {
                                            $media_details = get_media_by_id($imageData['id'], 'escort');
                                            $status = $media_details->varified;
                                        }
                                    @endphp

                                    <div class="pm_lgverify_icon" id="verify_icon_1"
                                        style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">
                                        @if (!empty($imageData['id']))
                                            @if ($status == '0')
                                                <img src="{{ asset('assets/app/img/pending_icon/e4u_pending_REV.png') }}">
                                                <span class="pm_lg_tooltip">Media Pending</span>
                                            @elseif($status == '1')
                                                <img src="{{ asset('assets/app/img/verify/e4u_verified_REV.png') }}">
                                                <span class="pm_lg_tooltip">Media Verified</span>
                                            @else
                                                <img src="{{ asset('assets/app/img/verify/unverified_light.png') }}">
                                                <span class="pm_lg_tooltip">Media Unverified</span>
                                            @endif
                                        @endif

                                    </div>
                                </label>

                            </div>
                            
                        </div>
                        <div class="pm-default-section">
                            <div class="pm-label-row">
                                <h3>Gallery Images</h3>
                            </div>
                            <div class="pm-mini-grid">
                                <div class="plate pm-mini-placeholder" data-toggle="modal" data-target="#photo_gallery"
                                    onclick="positionToUpdate(2)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="2"
                                            data-html="true" data-placement="top" title="" data-boundary="window"
                                            id="img2"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 2, 1)['path']) }}">
                                        <input type="hidden" id="pos_2" name="position[2]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 2, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp

                                        <div class="pm_verify_icon" id="verify_icon_2"
                                            style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">

                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                                    <span class="pm_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/verified_icon.png') }}"><span
                                                        class="pm_tooltip">Media verified</span>
                                                @else
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/unverified_icon.png') }}"><span
                                                        class="pm_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>
                                    </label>
                                </div>

                                <div class="plate pm-mini-placeholder" data-toggle="modal" data-target="#photo_gallery"
                                    onclick="positionToUpdate(3)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="3"
                                            data-html="true" data-placement="top" title="" data-boundary="window"
                                            id="img3"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 3, 1)['path']) }}">
                                        <input type="hidden" id="pos_3" name="position[3]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 3, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp

                                        <div class="pm_verify_icon" id="verify_icon_3"
                                            style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">

                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                                    <span class="pm_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/verified_icon.png') }}"><span
                                                        class="pm_tooltip">Media verified</span>
                                                @else
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/unverified_icon.png') }}"><span
                                                        class="pm_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>
                                    </label>
                                </div>

                                <div class="plate pm-mini-placeholder" data-toggle="modal" data-target="#photo_gallery"
                                    onclick="positionToUpdate(4)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="4"
                                            data-html="true" data-placement="top" title="" data-boundary="window"
                                            id="img4"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 4, 1)['path']) }}">
                                        <input type="hidden" id="pos_4" name="position[4]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 4, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp

                                        <div class="pm_verify_icon" id="verify_icon_4"
                                            style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">

                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                                    <span class="pm_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/verified_icon.png') }}"><span
                                                        class="pm_tooltip">Media verified</span>
                                                @else
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/unverified_icon.png') }}"><span
                                                        class="pm_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>
                                    </label>
                                </div>

                                <div class="plate pm-mini-placeholder" data-toggle="modal" data-target="#photo_gallery"
                                    onclick="positionToUpdate(5)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="5"
                                            data-html="true" data-placement="top" title="" data-boundary="window"
                                            id="img5"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 5, 1)['path']) }}">
                                        <input type="hidden" id="pos_5" name="position[5]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 5, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp

                                        <div class="pm_verify_icon" id="verify_icon_5"
                                            style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">

                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                                    <span class="pm_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/verified_icon.png') }}"><span
                                                        class="pm_tooltip">Media verified</span>
                                                @else
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/unverified_icon.png') }}"><span
                                                        class="pm_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>
                                    </label>
                                </div>

                                <div class="plate pm-mini-placeholder" data-toggle="modal" data-target="#photo_gallery"
                                    onclick="positionToUpdate(6)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="6"
                                            data-html="true" data-placement="top" title="" data-boundary="window"
                                            id="img6"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 6, 1)['path']) }}">
                                        <input type="hidden" id="pos_6" name="position[6]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 6, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp

                                        <div class="pm_verify_icon" id="verify_icon_6"
                                            style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">

                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                                    <span class="pm_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/verified_icon.png') }}"><span
                                                        class="pm_tooltip">Media verified</span>
                                                @else
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/unverified_icon.png') }}"><span
                                                        class="pm_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>
                                    </label>
                                </div>

                                <div class="plate pm-mini-placeholder" data-toggle="modal" data-target="#photo_gallery"
                                    onclick="positionToUpdate(7)">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid excludeTooltip" data-toggle="tooltip" data-position-id="7"
                                            data-html="true" data-placement="top" title="" data-boundary="window"
                                            id="img7"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 7, 1)['path']) }}">
                                        <input type="hidden" id="pos_7" name="position[7]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 7, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp

                                        <div class="pm_verify_icon" id="verify_icon_7"
                                            style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">

                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                                    <span class="pm_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/verified_icon.png') }}"><span
                                                        class="pm_tooltip">Media verified</span>
                                                @else
                                                    <img
                                                        src="{{ asset('assets/app/img/verify/unverified_icon.png') }}"><span
                                                        class="pm_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="pm-banner-sections">
                            <div class="pm-default-section">
                                <h3>Banner Image</h3>
                                <div class="pm-wide-placeholder" data-toggle="modal" data-target="#photo_gallery_banner"
                                    onclick="positionToUpdate(9)">
                                    <label class="newbtn dvDest lg_icon_wrapper" data-toggle="modal"
                                        data-target="#upload-sec-banner">
                                        <img class="img-fluid common-img" id="img9" data-position-id="9"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 9, 1)['path']) }}">
                                        <input type="hidden" id="pos_9" name="position[9]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 9, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp
                                        <div class="pm_lgverify_icon" id="verify_icon_9"
                                            style="{{ !empty($imageData['id']) && $media_details->template != '1' ? '' : 'display:none;' }}">
                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending_REV.png') }}">
                                                    <span class="pm_lg_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img src="{{ asset('assets/app/img/verify/e4u_verified_REV.png') }}">
                                                    <span class="pm_lg_tooltip">Media Verified</span>
                                                @else
                                                    <img src="{{ asset('assets/app/img/verify/unverified_light.png') }}">
                                                    <span class="pm_lg_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="pm-default-section">
                                <h3>Pin Up Image</h3>
                                <div class="pm-wide-placeholder" data-toggle="modal" data-target="#photo_gallery_pinup"
                                    onclick="positionToUpdate(10)">
                                    <label class="newbtn dvDest lg_icon_wrapper" data-toggle="modal"
                                        data-target="#upload-sec-banner">
                                        <img class="img-fluid common-img" id="img10" data-position-id="10"
                                            src="{{ asset($path->findByposition(auth()->user()->id, 10, 1)['path']) }}">
                                        <input type="hidden" id="pos_10" name="position[10]" value="">
                                        @php
                                            $imageData = $path->findByposition(auth()->user()->id, 10, 1);
                                            if (!empty($imageData['id'])) {
                                                $media_details = get_media_by_id($imageData['id'], 'escort');
                                                $status = $media_details->varified;
                                            }
                                        @endphp
                                        <div class="pm_lgverify_icon" id="verify_icon_10"
                                            style="{{ !empty($imageData['id']) ? '' : 'display:none;' }}">
                                            @if (!empty($imageData['id']))
                                                @if ($status == '0')
                                                    <img
                                                        src="{{ asset('assets/app/img/pending_icon/e4u_pending_REV.png') }}">
                                                    <span class="pm_lg_tooltip">Media Pending</span>
                                                @elseif($status == '1')
                                                    <img src="{{ asset('assets/app/img/verify/e4u_verified_REV.png') }}">
                                                    <span class="pm_lg_tooltip">Media Verified</span>
                                                @else
                                                    <img src="{{ asset('assets/app/img/verify/unverified_light.png') }}">
                                                    <span class="pm_lg_tooltip">Media Unverified</span>
                                                @endif
                                            @endif
                                        </div>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div style="padding-left: 7rem;">
                            <button type="submit" class="btn btn-primary create-tour-sec useDefault">Use
                                Default</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="pm-gallery-card" id="js_profile_media_gallery">
                <div class="photo-top-header">
                    <div class="pm-filter-row">
                        <div class="pm-status-tabs">
                            <ul class="nav nav-tabs border-0" id="escort_profile_media_filter_type">
                                <li class="nav-item">
                                    <a class="nav-link pm-status-tab active" data-filter-type="all" id="menu_all"
                                        href="#home">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pm-status-tab" data-filter-type="verified" id="menu_varified"
                                        href="#menu1"> <svg width="20px" height="20px" class="icons"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M7.5 12L10.5 15L16.5 9M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                                    stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg> Verified</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pm-status-tab" data-filter-type="unverified" id="menu_unverified"
                                        href="#menu2"><svg width="20px" height="20px" class="icons"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path stroke="#ff3c5f" stroke-width="2"
                                                    d="M5.5 5.5L18.5 18.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z">
                                                </path>
                                            </g>
                                        </svg>
                                        Unverified</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pm-storage">
                            <div class="pm-storage-label">
                                <span><strong>{{ $media->count() }}/30</strong> Photos Used</span>
                                <input type="hidden" name="media_count" value="{{ $media->count() }}">
                            </div>
                            <div class="pm-storage-bar">
                                <div class="pm-storage-progress" role="progressbar"
                                    style="width: {{ $media->count() * 3.3 }}%" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="pm-category-tabs">
                        <ul class="nav nav-tabs border-0 js_gallery_category">
                            <li>
                                <a class="nav-link pm-category active" data-type="gallery" data-toggle="tab"
                                    href="#Gallery">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                        <circle cx="8" cy="9" r="1.5"></circle>
                                        <path d="m4 17 5-5 3 3 2-2 6 5"></path>
                                    </svg> Gallery
                                </a>
                            </li>
                            <li>
                                <a class="nav-link pm-category" data-type="banner" data-toggle="tab" href="#Banner">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                        <path d="M3 15h18"></path>
                                        <path d="M8 20v-5"></path>
                                        <path d="M16 20v-5"></path>
                                    </svg>
                                    Banner</a>
                            </li>
                            <li>
                                <a class="nav-link pm-category" data-type="pinup" data-toggle="tab" href="#Pinup">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 3v18"></path>
                                        <path d="M7 7h10"></path>
                                        <path d="M5 11h14"></path>
                                        <path d="M8 15h8"></path>
                                        <path d="M9 19h6"></path>
                                    </svg>
                                    Pin Up</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="archive-photo-sec ">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="pagination-container"></div>
                            <div id="carouselExampleIndicators" class="carousel slide " data-bs-wrap="false"
                                data-bs-ride="carousel">
                                <ul class="pagination ml-3 px-2 ">
                                    <!-- Declare the item in the group -->
                                    <li class="page-item preview">
                                        <!-- Declare the link of the item -->
                                        <a class="page-link" href="#carouselExampleIndicators" id="preId">‹‹</a>

                                    </li>


                                    @for ($i = 0;
                                        $i <
                                        ceil(
                                            collect($media)->whereNotIn('position', [9, 10])->count() / 12,
                                        );
                                        $i++)
                                        <li class="page-item " id="pageItem_{{ $i }}"
                                            data-id="{{ $i }}">
                                            <a data-target="#carouselExampleIndicators"
                                                data-slide-to="{{ $i }}" class="page-link"
                                                href="#">{{ $i + 1 }}</a>
                                        </li>
                                    @endfor

                                    <li class="page-item nextOne">
                                        <a class="page-link" href="#carouselExampleIndicators" id="nextId">››</a>
                                    </li>
                                </ul>
                                <div class="">
                                    <div class="carousel-inner" id="view_all">

                                        @foreach (collect($media)->whereNotIn('position', [9, 10])->chunk(12) as $keyId => $images)
                                            <div class="carousel-item " id="cItem_{{ $loop->index }}"
                                                data-id="{{ $loop->index }}">
                                                <div class="pm-gallery-grid" id="dvSource">
                                                    @foreach ($images as $image)
                                                        @if (!in_array($image->position, [12]) /*$image->position != 8*/)
                                                            <div class="item4 pm-photo-card" id="dm_{{ $image->id }}">
                                                                <img class="img-thumbnail defult-image"
                                                                    src="{{ asset($image->path) }}" alt=" "
                                                                    data-id="{{ $image->id }}"
                                                                    data-position="{{ $image->position ? $image->position : '' }}">
                                                                <i class="fa fa-times deleteimg"
                                                                    data-id="{{ $image->id }}"></i>
                                                                @switch($image->position)
                                                                    @case(9)
                                                                        <span class="pm-gallery-badge">Banner</span>
                                                                    @break

                                                                    @case(10)
                                                                        <span class="pm-gallery-badge">Pin Up</span>
                                                                    @break

                                                                    @default
                                                                        <span class="pm-gallery-badge">Gallery</span>
                                                                @endswitch
                                                                @switch($image->varified)
                                                                    @case(0)
                                                                        {{-- Pending --}}
                                                                        <div class="pm_verify_icon">
                                                                            <img
                                                                                src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                                                            <span class="pm_tooltip">Media Pending</span>
                                                                        </div>
                                                                    @break

                                                                    @case(1)
                                                                        {{-- Verified --}}
                                                                        <div class="pm_verify_icon">
                                                                            <img
                                                                                src="{{ asset('assets/app/img/verify/verified_icon.png') }}">
                                                                            <span class="pm_tooltip">Media Verified</span>
                                                                        </div>
                                                                    @break

                                                                    @case(2)
                                                                        {{-- Unverified --}}
                                                                        <div class="pm_verify_icon">
                                                                            <img
                                                                                src="{{ asset('assets/app/img/verify/unverified_icon.png') }}">
                                                                            <span class="pm_tooltip">Media Unverified</span>
                                                                        </div>
                                                                    @break

                                                                    @default
                                                                        <div class="pm_verify_icon">
                                                                            <img
                                                                                src="{{ asset('assets/app/img/verify/unverified_icon.png') }}">
                                                                            <span class="pm_tooltip">Media Unverified</span>
                                                                        </div>
                                                                @endswitch
                                                                @php $status = $image->varified ?? "2"; @endphp
                                                                <div class="upload_date">
                                                                    @if ($status == '0')
                                                                        Uploaded:
                                                                        <span>{{ showDateWithFormat($image->created_at) }}</span>
                                                                    @elseif($status == '1')
                                                                        Approved:
                                                                        <span>{{ showDateWithFormat($image->updated_at) }}</span>
                                                                    @else
                                                                        Rejected:
                                                                        <span>{{ showDateWithFormat($image->updated_at) }}</span>
                                                                    @endif
                                                                </div>
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
        <div class="row">
            <div class="col-lg-12">

                <div class="pm-tips">

                    <div class="pm-tip-title">

                        <div class="pm-tip-icon">
                           <svg width="25px" height="25px" viewBox="-4 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13.0912 30.5454C13.0912 29.742 12.44 29.0908 11.6367 29.0908C10.8334 29.0908 10.1821 29.742 10.1821 30.5454C10.1821 31.3487 10.8334 31.9999 11.6367 31.9999C12.44 31.9999 13.0912 31.3487 13.0912 30.5454Z" fill="#000000"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2847 18.1412C22.61 16.1755 23.2727 14.0072 23.2727 11.6364C23.2727 8.42307 22.1367 5.68035 19.8646 3.40822C17.5924 1.13607 14.8496 0 11.6364 0C8.42307 0 5.68035 1.13607 3.40822 3.40822C1.13607 5.68035 0 8.42307 0 11.6364C0 14.0072 0.662666 16.1755 1.988 18.1412C2.8852 19.472 3.98233 20.5561 5.27939 21.3935V21.3984C5.90081 21.8673 6.38841 22.4812 6.74214 23.2397C7.09587 23.9983 7.27273 24.8092 7.27273 25.6727C7.27273 25.7511 7.27117 25.8295 7.26807 25.9078C7.26498 25.9862 7.26032 26.0643 7.25412 26.1424H7.27273V26.1818H16V25.6727C16 24.7962 16.1818 23.9747 16.5456 23.2079C16.9094 22.4409 17.4095 21.8247 18.046 21.3593C19.3201 20.5267 20.3996 19.454 21.2847 18.1412Z" fill="url(#paint0_radial_103_1531)"></path> <path d="M7.27246 27.6364C7.27246 29.2431 8.57491 30.5455 10.1816 30.5455H13.0906C14.6973 30.5455 15.9997 29.2431 15.9997 27.6364V26.1819H7.27246V27.6364Z" fill="url(#paint1_radial_103_1531)"></path> <path d="M13.8184 27.6364H9.45481C9.05315 27.6364 8.72754 27.962 8.72754 28.3636C8.72754 28.7653 9.05315 29.0909 9.45481 29.0909H13.8184C14.2201 29.0909 14.5457 28.7653 14.5457 28.3636C14.5457 27.962 14.2201 27.6364 13.8184 27.6364Z" fill="#000000" fill-opacity="0.2"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.55045 8.55082C9.40251 7.69877 10.431 7.27274 11.636 7.27274C12.0377 7.27274 12.3805 7.13073 12.6645 6.84672C12.9485 6.56269 13.0906 6.21985 13.0906 5.81819C13.0906 5.41653 12.9485 5.07369 12.6645 4.78967C12.3805 4.50566 12.0377 4.36365 11.636 4.36365C9.6277 4.36365 7.9135 5.07369 6.49342 6.49379C5.07333 7.91387 4.36328 9.62806 4.36328 11.6364C4.36328 12.038 4.50529 12.3809 4.78931 12.6649C5.07333 12.9489 5.41617 13.0909 5.81783 13.0909C6.21948 13.0909 6.56232 12.9489 6.84635 12.6649C7.13037 12.3809 7.27237 12.038 7.27237 11.6364C7.27237 10.4314 7.6984 9.40287 8.55045 8.55082Z" fill="white"></path> <defs> <radialGradient id="paint0_radial_103_1531" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(7.74574 7.19893) rotate(56.4705) scale(19.63 17.4489)"> <stop stop-color="#FADF73"></stop> <stop offset="0.457142" stop-color="#FFD500"></stop> <stop offset="1" stop-color="#FC9900"></stop> </radialGradient> <radialGradient id="paint1_radial_103_1531" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(4.42694 24.8264) rotate(38.4256) scale(9.20221 18.4044)"> <stop stop-color="#EFFCFF"></stop> <stop offset="0.999999" stop-color="#A5F2FF"></stop> </radialGradient> </defs> </g></svg>
                        </div>

                        <div>
                            <strong>Photo Tips</strong>
                            <span>
                                High quality photos get more attention and increase your profile visibility.
                            </span>
                        </div>

                    </div>


                    <div class="pm-tip-item">

                        <div class="pm-tip-round">

                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                <circle cx="8" cy="9" r="1.5"></circle>
                                <path d="m4 17 5-5 3 3 2-2 6 5"></path>
                            </svg>

                        </div>

                        <span>Use clear, high resolution images</span>

                    </div>


                    <div class="pm-tip-item">

                        <div class="pm-tip-round">✦</div>

                        <span>Show variety in your photos</span>

                    </div>


                    <div class="pm-tip-item">

                        <div class="pm-tip-round">↻</div>

                        <span>Keep your gallery up to date</span>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade upload-modal delete" id="pesrmissionModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                            <span aria-hidden="true">
                            </span>
                        </button>
                    </div>
                    <div id="addTourForm1">
                        <div class="col-md-12 p-0">
                            <span id="msg"> </span>
                        </div>
                        <input type="hidden" id="deleteId" value="">
                        <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                            <button type="submit" class="btn btn-secondary create-tour-sec permission">Ok</button>
                            <button type="button" class="btn btn-primary create-tour-sec nopermission"
                                data-dismiss="modal" aria-label="Close">close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('escort.dashboard.modal.upload_gallery_image')

        <div class="modal fade upload-modal" id="photo_gallery" style="display: none">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon"
                                alt="cross"> Select Photo</h5>
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
                                @if (!in_array($image->position, [9, 10]) /*$image->position != 8*/)
                                    <div class="item4 pm-photo-card ">
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




        <div class="modal fade upload-modal" id="photo_gallery_banner" style="display: none">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: white;"> <img src="/assets/dashboard/img/upload-photos.png"
                                class="custompopicon" alt="cross"> Select Banner</h5>

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
                                <a class="nav-link" id="default-tab" data-toggle="tab" href="#default" role="tab"
                                    aria-controls="default" aria-selected="true">
                                    Templates
                                </a>
                            </li>
                        </ul>
                        <div class="modalPopup">

                            <div class="tab-content mt-3">
                                <!-- Tab panes -->
                                <div class="tab-pane fade show active" id="upload" role="tabpanel"
                                    aria-labelledby="upload-tab">
                                    <div id="banner_modal_container" class="modal-tab grid-container">
                                        @foreach ($media as $keyId => $image)
                                            @if (in_array($image->position, [9]))
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
                                <!-- default Banner Tab -->
                                {{-- <div class="tab-pane fade" id="default" role="tabpanel" aria-labelledby="default-tab">
                            @php  
                            $bannerTemplates = getBannerTemplates();
                            @endphp
                            <div class="modal-tab">
                                @if (!empty($bannerTemplates))
                                @foreach ($bannerTemplates as $keyId => $image)
                                <div class="item2">
                                    <img src="{{ asset($image->path) }}" data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}" class="img-thumbnail defult-image select_image">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div> --}}

                                {{-- Don't Remove This  --}}
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
                                                @if (!empty($bannerTemplates))
                                                    @foreach ($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}"
                                                                data-id="{{ $image->id }}"
                                                                data-position="{{ $image->position ? $image->position : '' }}"
                                                                class="img-thumbnail defult-image select_image">
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
                                                @if (!empty($bannerTemplates))
                                                    @foreach ($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}"
                                                                data-id="{{ $image->id }}"
                                                                data-position="{{ $image->position ? $image->position : '' }}"
                                                                class="img-thumbnail defult-image select_image">
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
                                                @if (!empty($bannerTemplates))
                                                    @foreach ($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}"
                                                                data-id="{{ $image->id }}"
                                                                data-position="{{ $image->position ? $image->position : '' }}"
                                                                class="img-thumbnail defult-image select_image">
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
                                                @if (!empty($bannerTemplates))
                                                    @foreach ($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}"
                                                                data-id="{{ $image->id }}"
                                                                data-position="{{ $image->position ? $image->position : '' }}"
                                                                class="img-thumbnail defult-image select_image">
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
                                                @if (!empty($bannerTemplates))
                                                    @foreach ($bannerTemplates as $keyId => $image)
                                                        <div class="item2">
                                                            <img src="{{ asset($image->path) }}"
                                                                data-id="{{ $image->id }}"
                                                                data-position="{{ $image->position ? $image->position : '' }}"
                                                                class="img-thumbnail defult-image select_image">
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




        <div class="modal fade upload-modal" id="photo_gallery_pinup" style="display: none">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: white;"> <img src="/assets/dashboard/img/upload-photos.png"
                                class="custompopicon" alt="cross"> Select Pin Up</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="pinup_modal_container" class="grid-container modalPopup"
                            style="max-height: 350px; overflow:auto; grid-template-columns: 1fr 1fr 1fr;">

                            @foreach ($media as $keyId => $image)
                                @if (in_array($image->position, [10]))
                                    <div class="item2">
                                        <img class="img-thumbnail defult-image select_image" style=""
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

        <div class="modal fade upload-modal" id="comman_modal" style="display: none">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen">
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
                        <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                            id="close">Ok</button>
                    </div>
                </div>
            </div>
        </div>

        @include('escort.dashboard.modal.remove_gallary_image')
        @include('escort.dashboard.modal.verify_media')

    @endsection
    @push('script')
        <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
        </script>
        <script src="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/escort/profile_and_media_gallery.js') }}?v={{ time() }}"></script>
        <script src="{{ asset('js/escort/media-varification.js') }}"></script>
        <script>
            var updatePosition = 0;
            $("body").on('click', '.cropEdit', function() {
                var id = $(this).attr('id');
                var val = $(this).attr('value');
                var src = $("#blah" + val).attr('src');
                console.log("id = " + id);
                console.log("val = " + src);
            });

            $(".useDefault").hide();

            function initDragDrop() {
                $("#dvSource img").draggable({
                    revert: "invalid",
                    helper: 'clone',
                    appendTo: ".upload-photo-sec",
                    refreshPositions: false,
                    drag: function(event, ui) {

                    },
                    stop: function(event, ui) {}
                });
                $(".dvDest").droppable({
                    drop: function(event, ui) {
                        var img_target = $(this).find('img');
                        var id = (img_target.attr('id'));
                        var position = img_target.data('position-id');
                        var sourceImagePosition = $(ui.draggable).data('position');
                        var meidaId = ui.draggable.data('id');
                        $("#pos_" + id.slice(3, 4)).val(ui.draggable.data('id'));
                        updateDefaultImage(position, meidaId, img_target, ui.draggable.attr('src'));
                    }

                });
            }

            $(function() {
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
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.error == true) {
                            img_target.attr('data-id', meidaId);
                            img_target.attr('src', media_src);
                            let resp = data.media_data;
                            let status = resp?.media_data?.varified ?? 'template';
                            let iconPath = '';
                            let iconText = '';
                            if (position == 1 || position == 9 || position == 10) {

                                if (status == "0") {
                                    iconPath = '/assets/app/img/pending_icon/e4u_pending_REV.png';
                                    iconText = '<span class="pm_lg_tooltip">Media Pending</span>';
                                } else if (status == "1") {
                                    iconPath = '/assets/app/img/verify/e4u_verified_REV.png';
                                    iconText = '<span class="pm_lg_tooltip">Media Verified</span>';
                                } else {
                                    iconPath = '/assets/app/img/verify/unverified_light.png';
                                    iconText = '<span class="pm_lg_tooltip">Media Unverified</span>';
                                }

                            } else {
                                if (status == "0") {
                                    iconPath = '/assets/app/img/pending_icon/e4u_pending-icon_REV.png';
                                    iconText = '<span class="pm_tooltip">Media Pending</span>';
                                } else if (status == "1") {
                                    iconPath = '/assets/app/img/verify/verified_icon.png';
                                    iconText = '<span class="pm_tooltip">Media Verified</span>';
                                } else {
                                    iconPath = '/assets/app/img/verify/unverified_icon.png';
                                    iconText = '<span class="pm_tooltip">Media Unverified</span>';
                                }
                            }

                            let iconBox = $('#verify_icon_' + position);
                            iconBox.html(`<img src="${iconPath}">${iconText}`);
                            if (status == "template" && position == "9") {
                                iconBox.hide();
                            } else {
                                iconBox.show('');
                            }

                        } else {
                            swal.fire('', "<p>" + data.msg + "</p>", 'error');
                            $('#comman_modal').on('hidden.bs.modal', function() {});
                        }
                    }
                });
            }

            $("#defaultImage").on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var data = new FormData($('#defaultImage')[0]);
                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.error == true) {
                            var msg = "Saved";
                            swal.fire('', msg, 'success');

                        } else {
                            var msg = "Something wrong...";
                            swal.fire('', msg, 'error');
                        }
                    },
                    error: function(data) {
                        $.toast({
                            heading: 'Error!',
                            text: data.responseJSON.message,
                            icon: 'error',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    }
                });
            });

            var positionToFill;
            $(document).ready(function() {
                $(".img-fluid.excludeTooltip, #img9").on('click', function(e) {
                    positionToFill = $(this);
                });
            })

            function positionToUpdate(position) {
                console.log("positionToUpdate", position);
                updatePosition = position;
                return true;
            }

            $(document).on('click', '.modalPopup .item2,.modalPopup .item4', function(e) {
                let imageSrc = $(this).find('img').attr('src');
                let mediaId = $(this).find('img').data('id');
                let img_target = $("#img" + updatePosition);
                updateDefaultImage(updatePosition, mediaId, img_target, imageSrc);
                $(`#${$(this).parents('.modal').attr('id')}`).modal("hide");
            });
        </script>
    @endpush
