@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Media</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use these help pages for explanations and guidance on managing your Media files.</li>
                            <li>You can upload your photos, up to 30, and video, up to 6.</li>
                            <li>Organise your Media before you create any Profiles to make the whole process a
                                whole lot more easy for you.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row how-it-done">
            <div class="col-md-12 mt-2 mb-5">
                <div id="accordion" class="myacording-design">

                    <!-- Photos -->
                    <div class="card">
                        <div class="card-header" id="headingPhotos">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapsePhotos"
                                    aria-expanded="false">
                                    Photos
                                </a>
                            </h2>
                        </div>
                        <div id="collapsePhotos" class="collapse" aria-labelledby="headingPhotos" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-10">
                                        <p>
                                            Use this feature to store, set up your default photos, and to verify
                                            them. Verification is important as your photos, if they are
                                            verified, will be labeled with the E4U Verification icon. When
                                            your Media is verified, Users can also use the verification as a
                                            search filter.
                                        </p>
                                        <p>
                                            The verification process lets the Viewer know what stage the verification is up
                                            to by attaching
                                            to your Media the appropriate verification label. The verification status
                                            changes automatically
                                            at each stage.
                                        </p>
                                        <p class="d-flex justify-content-start gap-10 align-items-center">
                                            <img src="{{ asset('assets/app/img/verify/verified_icon_dark.png') }}"
                                                alt="" style="width: 30px"> <span> Represents that the Advertiser's
                                                Media has been Verified by E4U.</span>
                                        </p>
                                        <p class="d-flex justify-content-start gap-10 align-items-center">
                                            <img src="{{ asset('assets/app/img/verify/e4u_pending-icon.png') }}"
                                                alt="" style="width: 30px"> <span> Represents that the Advertiser's
                                                Media has been submitted for verification and is pending with E4U.</span>
                                        </p>
                                        <p class="d-flex justify-content-start gap-10 align-items-center">
                                            <img src="{{ asset('assets/app/img/verify/unverified_icon_dark.png') }}"
                                                alt="" style="width: 30px"> <span> Represents that the Advertiser's
                                                Media has not been submitted to E4U for verification, or has been
                                                rejected.</span>
                                        </p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/app/img/e4u_verified_media.png') }}" alt=""
                                                class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Thumbnail</li>
                                    <li>Default images</li>
                                    <li>Banner image</li>
                                    <li>Pin Up image</li>
                                </ul>

                                <h5><b>How is it done - Media</b></h5>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            There are two mandatory sets of photos required for you to
                                            create a Profile, they are your Banner image, which appears
                                            across the top of your Profile, and your Thumbnail and
                                            supporting images. If you do not set up your default Media
                                            initially, you can do so from the Profile Creator. You will be
                                            asked if you want to update your default Media. The Profile
                                            Creator will also permit you to arrange your photos in your
                                            preferred order.
                                        </p>
                                        
                                        <p class="sec-head">
                                            Thumbnail
                                        </p>
                                        <p>
                                            Your Thumbnail image is what will appear in the Listing page
                                            as well as being your main photo on your Profile page.
                                        </p>
                                        <p>
                                            You can select up to six additional photos as your default
                                            images, which, together with your Thumbnail, will display
                                            7 photos in total on your Profile. Viewers can scroll
                                            through your images, as well as click and view from a pop
                                            up, which will include up to three videos that you may
                                            have included in the Profile.
                                        </p>

                                        <p>
                                            When your Media is in a pop up format, the Viewer can
                                            expand the image for easier viewing.
                                        </p>
                                        <p>
                                            You can change any of your default images by click and
                                            hold from your repository and dropping the image into the
                                            position you want. You can not have two photos that are
                                            the same included in your Default images.
                                        </p>
                                        <p>
                                            The same applies to your Banner and Pin Up images.
                                        </p>
                                       
                                       
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/media-photo-scr.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                         <div class="d-flex justify-content-start gap-10">
                                            <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/media-photo-video-scr.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                         <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/gallery-banner.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                         </div>
                                    </div>
                                </div>
                                <p class="sec-head"> Banner</p>
                                <div class="row">
                                    <div class="col-lg-7">
                                         
                                        <p>
                                            Your Banner image sits across the top of your Profile.
                                            We recommend you select an image that is landscape in
                                            nature. If you do not have an image, your can select from
                                            our template images. The images represent a range of
                                            moods including BDSM, Lingerie, Passive, Sheets and
                                            Subtle.
                                        </p>
                                        <p>
                                            The Banner image is mandatory.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">                                        
                                          <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/template-banner.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                         <p class="sec-head">Pin Up</p>
                                        <p>
                                            Your Pin Up image is your preferred image that will appear on the Website home
                                            page. The
                                            Website has geolocation operating and therefore every Location is available for
                                            a Pin Up.
                                            You can upload as many Pin Up images as you like, but it is included as a part
                                            of the tally for
                                            the maximum number of images you can upload (30 in total).
                                        </p>
                                        <p>
                                            The Pin Up image is not mandatory, but you must have uploaded one (see example
                                            above)
                                            before you can register for Pin Up status in the Location the Profile is Listed
                                            for.
                                        </p>
                                    </div>
                                </div>

                                <p class="sec-head">Verification</p>
                                <div class="row">
                                    <div class="col-lg-7">
                                        
                                        <p>
                                            Media Verification can be undertaken at any
                                            time. The Website has an automated system
                                            in place to manage your Media to ensure
                                            Users can always see the correct status of
                                            your Media at any time. This only applies to
                                            photos.
                                        </p>
                                        <p>
                                            When you upload your Media, irrespective of
                                            any existing Media in your repository, and the
                                            status of that Media, the newly uploaded
                                            Media will automatically be tagged as
                                        </p>
                                        <p>
                                            ‘Pending’. You can use any Pending Media in any Profile you have listed or
                                            create. The
                                            Pending status will remain in place for 48 hours.
                                        </p>
                                        <p>
                                            You have 48 to upload your Media Verification image.
                                            When uploading your Verification image, you have three
                                            image type choices: Selfie, Licence or Passport.
                                        </p>
                                        <p>
                                            If you do not upload your Media Verification image within
                                            48 hours, then the Pending Media’s status will
                                            automatically change to ‘Unverified’, which will be reflected
                                            in your repository, and any Profiles you have listed which
                                            have included the Pending Media. Any previously verified
                                            Media will retain its status.
                                        </p>

                                        <p>
                                            When you upload your Media Verification image, our Operations team
                                            will review the Pending Media to the Media Verification image and
                                            approve or reject the Pending Media accordingly.
                                        </p>
                                        <p>If your Pending Media is approved, then all of the Pending Media across
                                            your repository and any Listed Profile will automatically have the status
                                            changed to ‘Verified’. If the Pending Media is rejected, the Pending
                                            status is automatically changed to ‘Unverified’. The new status is
                                            reflected across your repository and any Listed Profiles incorporating
                                            that Media. You can upload a Verification image any time after the 48
                                            hours to have your Unverified Media verified.</p>
                                        <p>All Media images have the E4U Verification status icon attached to it
                                            according to the Verification status. You can have a mix of Verification
                                            statuses in your
                                            repository. It is important you upload the correct Verification image each time
                                            to ensure the
                                            correct outcome.</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img my-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/verification.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                        <div class="d-flex justify-content-between gap-10">
                                            <div class="doc-img mt-2">
                                                <img src="{{ asset('assets/dashboard/img/how-is-done/media-verify-banner.png') }}"
                                                    alt="" class="w-100">
                                            </div>

                                            <div class="doc-img mt-2">
                                                <img src="{{ asset('assets/dashboard/img/how-is-done/profile-image.png') }}"
                                                    alt="" class="w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Video  -->
                    <div class="card">
                        <div class="card-header" id="headingVideo">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseVideo"
                                    aria-expanded="false">
                                    Video
                                </a>
                            </h2>
                        </div>
                        <div id="collapseVideo" class="collapse " aria-labelledby="headingVideo"
                            data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            Manage your video content here. You can upload up to six videos and select 3 as
                                            your
                                            default video.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                         <h5><b>Features</b></h5>
                                        <ul class="custom-ul">
                                            <li>Upload up to six videos</li>
                                            <li>Select your default videos</li>
                                        </ul>
                                    </div>
                                </div>
                                 <h5><b>How is it done - Video</b></h5>
                                 <div class="row">
                                    <div class="col-lg-7">
                                       
                                        <p>
                                            You can upload up to six videos to your repository and
                                            then select three videos, by drag and drop, to be your
                                            default videos. Your default video will always be
                                            included in any Profile you create.
                                        </p>
                                        <p>
                                            If you change a video in the Profile Creator, the
                                            Creator will ask you if you want to update your default
                                            video. If you say Yes the video is updated, if you say
                                            No, your settings remain the same and the change/s
                                            you made are only applied to the Profile you are
                                            creating.
                                        </p>
                                        <p>
                                            Your video is displayed in the Media pop up on your
                                            Profile. Viewers simply click the navigation buttons to
                                            scroll through the videos.
                                        </p>
                                        <p>
                                            If you have video available to Viewers, your Profile will
                                            also display a camera indicating that video is available
                                            for viewing.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/upload-video-banner.png') }}" alt=""
                                                class="w-100 rounded-sm">
                                        </div>
                                        <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/video-banner.png') }}" alt=""
                                                class="w-100 rounded-sm">
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
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush
