<div class="modal fade upload-modal" id="upload_video_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
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
                                                          
                                <div class="col-md-6 mx-auto" id="img_for_showing">
                                    <div class="video-sec-popup mb-2" id="image_preview"> 
                                        <label class="newbtn">
                                            <img class="img-fluid" id="videonp" src="{{ asset('assets/dashboard/img/add-video.png') }}">
                                            <input name="video_upload" id="video_upload" class="pis" onchange="previewVideo();" type="file" accept="video/*" >
                                        </label>
                                        <video class="videoUp" id="videoPreview" controls="" style="display:none"></video>
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