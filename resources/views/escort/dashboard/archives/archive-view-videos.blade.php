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
                <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Videos</button>
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
                
                <div class="d-flex justify-content-start gap-10 mt-3">
                    <label class="newbtn videoDroppable" id="videoDroppable_1">
                        <video class="videoUp" id="img1" controls="" src="{{ asset($path)}}" controls poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                            <source id="" src="{{ asset($path)}}" type="video/mp4" >
                        </video>
                        <input  type="hidden"  id="pos_1" name="position[1]" value="">
                    </label>
    
                    <label class="newbtn videoDroppable" id="videoDroppable_2">
                        <video class="videoUp" id="img2" controls="" src="{{ asset($path)}}" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                            <source id="" src="{{ asset($path)}}" type="video/mp4" >
                        </video>
                        <input  type="hidden"  id="pos_2" name="position[2]" value="">
                    </label>
    
                    <label class="newbtn videoDroppable" id="videoDroppable_3">
                        <video class="videoUp" id="img3" controls="" src="{{ asset($path)}}" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                            <source id="" src="{{ asset($path)}}" type="video/mp4" >
                        </video>
                        <input  type="hidden"  id="pos_3" name="position[3]" value="">
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/upload-videos.png" class="custompopicon" alt="cross"> Upload Videos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div class="row text-center">
                            <div class="video-sec-popup" id="image_preview">                               
                                        <div class="col-md-6 mx-auto" id="img_for_showing">
                                            <label class="newbtn">
                                                <img class="img-fluid" id="videonp" src="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                                                <input name="video_upload" id="video_upload" class="pis" onchange="previewVideo();" type="file" accept="video/*" >
                                            </label>
                                            <video class="videoUp" id="videoPreview" controls="" style="display:none">

                                            </video>
                                        </div>
                                        <div class="mb-0"><p>You can upload one video at a time.</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center pt-0">
                        <button type="button" class="btn-success-modal"  onclick="uploadVideo()">Upload</button>
                        
                    </div>
                </div>
        </div>
    </div>

</div>
<div class="modal" id="videoModel" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/delete-video.png')}}" class="custompopicon"> Delete Video</h5>
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
                <button type="submit" class="btn-cancel-modal d_img" data-dismiss="modal" id="close">Cancel</button>
                <button type="submit" class="btn-success-modal d_img" id="dImg">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/escort/profile_and_media_gallery.js') }}"></script>
<script>
const CHUNK_SIZE = 1024 * 1024;
function previewVideo() {
    const input = document.getElementById('video_upload');
    const preview = document.getElementById('videoPreview');
    const file = input.files[0];

    if (file && file.type.startsWith('video/')) {
        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.style.display = 'block';
        input.previousElementSibling.style.display = 'none';
    } else {
        preview.src = '';
        preview.style.display = 'none';
        Swal.fire('Media', 'Please select a valid video file.', 'error');
    }
}

async function uploadVideo() {
    const fileInput = document.getElementById('video_upload');
    const preview = document.getElementById('videoPreview');
    const file = fileInput.files[0];

    if (!file) {
        Swal.fire('Media', 'Please choose atleast one file', 'error');
        return;
    }

    const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
    const fileName = file.name;
    let uploadedChunks = 0;

    Swal.fire({
        title: 'Uploading...',
        html: `<div style="display: flex; flex-direction: column; align-items: center;">
            <div class="swal-spinner" style="margin: 10px;">
                <div class="custom-spinner"></div>
            </div>
            <div id="uploadPercent" style="font-weight: bold;">0%</div>
        </div>`,
        allowOutsideClick: false,
        didOpen: () => {
            
        }
    });

    for (let i = 0; i < totalChunks; i++) {
        const start = i * CHUNK_SIZE;
        const end = Math.min(file.size, start + CHUNK_SIZE);
        const chunk = file.slice(start, end);

        const formData = new FormData();
        formData.append("file", chunk);
        formData.append("chunkIndex", i);
        formData.append("fileName", fileName);

        await fetch("{{route('gallery.uploadChunk')}}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });
        uploadedChunks++;
        const percent = Math.floor((uploadedChunks / totalChunks) * 100);
        document.getElementById('uploadPercent').innerText = `${percent}%`;
    }

    // After uploading all chunks, request merge
    const mergeData = new FormData();
    mergeData.append("fileName", fileName);
    mergeData.append("totalChunks", totalChunks);

    await fetch("{{route('gallery.mergeChunks')}}", {
        method: "POST",     
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: mergeData
    });

    Swal.fire("Success", "Upload complete!", "success").then(() => {
        fileInput.previousElementSibling.style.display = 'block';
        fileInput.value = '';
        preview.src = '';
        preview.style.display = 'none';
    });
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
@endpush

