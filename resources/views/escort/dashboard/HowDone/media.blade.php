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
                                    <div class="col-lg-9">
                                        <p>
                                            Use this feature to store all of your photos, set up your default
                                            photos, and verify them. Verification is important as your photos,
                                            if they are verified, will be labeled with the E4U Verification icon.
                                            When verified, Users can also use the verification as a search
                                            filter.
                                        </p>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/img/e4u-verified-dark.png') }}"
                                                  alt="" class="w-100 rounded-sm">
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

                                <h5><b>How is it done</b></h5>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <p>
                                                There are two mandatory sets of photos required for you to
                                                create a Profile, your Banner image, which appears across the
                                                top of your Profile, and your Thumbnail and supporting images.
                                                If you do not set up your default Media, you can do so from the
                                                Creator, and you will be asked if you want to update your
                                                default Media. The Creator will also permit you to clip images.
                                            </p>
                                            <p class="sec-head">
                                                Thumbnail
                                            </p>
                                            <p>
                                                Your Thumbnail is what appears in the Listing page as well as
                                                your main photo on your profile page.
                                            </p>
                                            <p>
                                                You can select up to six additional photos as your default
                                                images, which , together with your Thumbnail, will display 7
                                                photos on your Profile. Your Thumbnail image is what will
                                                appear in the Listings and is the default image on your Profile.
                                                Viewers can scroll through your images, as well as click and
                                                view from a pop up.
                                            </p>
                                            
                                            <p>
                                                You can change any of your default images by click and hold
                                                from your repository and dropping the image into the position you want. You can not have
                                                two photos that are the same included in your Default images.

                                            </p>

                                            <p class="sec-head"> Banner</p>
                                        <p>
                                            Your Banner image sits across the top of your Profile. We recommend you select an image
                                            that is landscape in nature. If you do not have an image, your can select from our template
                                            images. The images represent a range of erotic lingerie.
                                        </p>
                                        <p>
                                            The Banner image is mandatory.
                                        </p>


                                        <p class="sec-head">Pin Up</p>
                                        <p>
                                            Your Pin Up image is your preferred image that will appear on the Website home page. The
                                            Website has geolocation operating and therefore every Location is available for a Pin Up.
                                            You can upload as many Pin Up images as you like, but it is included as a part of the tally for
                                            the maximum number of images you can upload (30 in total).
                                        </p>
                                        <p>
                                            The Pin Up image is not mandatory, but you must have uploaded one before you can register
                                            for Pin Up status.
                                        </p>
                                        </div>
                                        <div class="col-lg-5">
                                             <div class="doc-img mb-2">
                                                <img src="{{ asset('assets/dashboard/img/media-photo-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                            </div>

                                            <div class="doc-img mt-2">
                                                <img src="{{ asset('assets/dashboard/img/media-photo-video-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
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
                        <div id="collapseVideo" class="collapse " aria-labelledby="headingVideo" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-12">
                                        <p>
                                            Manage your video content here. You can upload up to six videos and select 3 as your
                                            default video.
                                        </p>
                                    </div>
                                </div>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Accepts video up to 1 minute in length</li>
                                    <li>Various formats available</li>
                                </ul>

                                <h5><b>How is it done</b></h5>
                                <p>
                                    Upload your video to your repository. Select three videos to be your default video. Your
                                    default video will always be included in any Profile you create. If you change a video in the
                                    Creator, the Creator will ask you if you want to update your default video. If you say Yes the
                                    video is updated, if you say No, your settings remain the same and the change/s you made
                                    are only applied to the Profile you are creating.
                                </p>
                                   <p>
                                        Your video is displayed in the Media pop up on your profile. If you have video available to
                                        Viewers, your Profile will also display a camera indicating that video is available for viewing.
                                   </p>
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
