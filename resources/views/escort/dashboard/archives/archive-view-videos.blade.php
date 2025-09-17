@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
<link href="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.css') }} " rel="stylesheet" type="text/css" />
<style type="text/css">
   
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row ">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1" style="display: inline-block;">Videos</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="collapse" id="notes">
                <div class="card">
                    <div class="card-body">
                        <h2 class="NotesHeader"><b>Notes:</b> </h2>
                        <ol>
                            <li>Upload your videos here (up to six) and then select your default videos to be included in your Profiles (up to three) (<b>Default Videos</b>).</li>
                            <li>Your Default Videos will always appear in the Profile Creator when you activate the Profile Creator (for a new Profile). If you change any of the Default Videos in the Profile Creator, you will be asked if you want to update your changes to the Default Videos.</li>
                            <li>When uploading your videos, make sure they comply with our <a href="/escort-dashboard/help" class="custom_links_design">Video</a> guidelines, especially in terms of the format type and the length of the video.</li>
                            <li>Whilst you can upload up to six videos, please remember you can only display up to three in any Profile.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">    
            <div class="d-flex justify-content-end">
                <button id="add_video_button" type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#upload_video_modal">Add Videos</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="photo-top-header" style="">
                <div class="photo-header border-0">
                    <div class="modal-header border-0 p-0" style="display: block;position: relative;top: 30%;">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="pl-3 text-white">All Videos</h4>
                            </div>
                            <div class="col-md-2 pt-1">
                                <div class="progress">
                                    <div id="js_profile_video_gallery_progressbar" class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div style="display: flex;gap: 15px;">
                                    <p id="js_profile_video_gallery_count"></p>
                                    <img src="{{ asset('assets/app/img/Vector-2.png')}}" style="height: 21px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="archive-photo-sec">
                <div class="row blog">
                    <div id="js_profile_video_gallery" class="col-md-12">
                        
                     
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
                            <video class="videoUp" id="img1" controls="" src="" controls poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                                <source id="" src="" type="video/mp4" >
                            </video>
                            <input  type="hidden"  id="pos_1" name="position[1]" value="">
                        </label>
                    </div>
    
                    <div class="col-lg-4">
                        <label class="newbtn videoDroppable w-100" id="videoDroppable_2">
                            <video class="videoUp" id="img2" controls="" src="" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                                <source id="" src="" type="video/mp4" >
                            </video>
                            <input  type="hidden"  id="pos_2" name="position[2]" value="">
                        </label>
                    </div>
    
                   <div class="col-lg-4">
                    <label class="newbtn videoDroppable w-100" id="videoDroppable_3">
                        <video class="videoUp" id="img3" controls="" src="" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                            <source id="" src="" type="video/mp4" >
                        </video>
                        <input  type="hidden"  id="pos_3" name="position[3]" value="">
                    </label>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('escort.dashboard.modal.upload_gallery_video')
@include('escort.dashboard.modal.remove_gallary_video')
@endsection
@push('script')
<script src="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/escort/profile_and_media_gallery.js') }}"></script>
<style>
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
</style>
@endpush

