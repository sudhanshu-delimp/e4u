<div class="modal fade common-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
            <form id="mulitiImage" method="POST" action="{{ route('escort.upload.gallery') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content common-modal-content">
                    <div class="modal-header common-modal-header">
                        <h5 class="common-modal-title" id="exampleModalLongTitle"><img
                                src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross">
                            Upload Photos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="upload-modal-body">
                            <div class="upload-boxes">
                                <label class="upload-dropzone upload-dropzone-photo newbtn">
                                                <input name="img[]" id="upload_file" class="pis"
                                                    onchange="preview_image(event);" type="file" multiple
                                                    accept="image/*" hidden>

                                    <div class="upload-plus upload-plus-pink">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </div>

                                    <h3>Add Photos</h3>

                                    <p class="upload-main-text">
                                        Click or drag & drop to upload
                                    </p>

                                    <span>
                                        JPG, PNG or WEBP (Max 2MB)
                                    </span>

                                </label>


                                <!-- Add Banner Image -->
                                <label class="upload-dropzone upload-dropzone-cover newbtn">

                                    
                                               
                                    <div class="recommended-size">
                                        Recommended size: 1920 × 1080
                                    </div>

                                    <div class="upload-plus upload-plus-blue">
                                       <img id="blah9" class="img-fluid pl-2 pr-2 js_bannerDefaultImage js_galleryMedia" src="{{ asset('assets/app/img/add-media.png') }}">
                                        <input name="banner" id="upload_banner" class="pis galleryMedia"
                                                    onchange="readImageURL(this);" type="file" accept="image/*" hidden>
                                                <input type="hidden" name="position[]" id="mediaBanner">

                                    </div>

                                    <h3>Add Banner Image</h3>

                                    <p class="upload-main-text">
                                        Click or drag & drop to upload
                                    </p>

                                    <span>
                                        JPG, PNG or WEBP (Max 2MB)
                                    </span>

                                </label>

                                <!-- Add Pin Up Image -->
                                @if (request()->segment(2) == 'archive-view-photos')
                                <label class="upload-dropzone upload-dropzone-cover">

                                    

                                    <div class="recommended-size">
                                        Recommended size: 800 × 500
                                    </div>

                                    <div class="upload-plus upload-plus-blue">
                                       <img id="blah10"
                                                        class="img-fluid pl-2 pr-2 js_pinupDefaultImage js_galleryMedia"
                                                        src="{{ asset('assets/app/img/add-media.png') }}">
                                                    <input name="pinup" id="upload_pinup" class="pis"
                                                        onchange="readImageURL(this);" type="file" accept="image/*" hidden>
                                                    <input type="hidden" name="position[]" id="mediaPinup">
                                    </div>

                                    <h3>Add Pin Up Image</h3>

                                    <p class="upload-main-text">
                                        Click or drag & drop to upload
                                    </p>

                                    <span>
                                        JPG, PNG or WEBP (Max 2MB)
                                    </span>

                                </label>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="row mt-2">
                                     <div class="{{ request()->segment(2) == 'archive-view-photos' ? 'col-lg-4' : 'col-lg-4' }}">
                                        <div class="plate">
                                            
                                            <label class="newbtn">
                                                <img id="blah"
                                                    class="img-fluid pl-2 pr-2 js_bannerDefaultImage js_galleryMedia"
                                                    src="{{ asset('assets/app/img/upload-thum-1.png') }}"
                                                    style="height: 150px;object-fit: cover;width: 250px;">
                                                <input name="img[]" id="upload_file" class="pis"
                                                    onchange="preview_image(event);" type="file" multiple
                                                    accept="image/*">

                                            </label>
                                        </div>
                                    </div> 

                                    <div class="{{ request()->segment(2) == 'archive-view-photos' ? 'col-lg-4' : 'col-lg-4' }}">
                                        <div class="plate"><label class="newbtn">
                                                <img id="blah9"
                                                    class="img-fluid pl-2 pr-2 js_bannerDefaultImage js_galleryMedia"
                                                    src="{{ asset('assets/app/img/upload-3.png') }}"
                                                    style="height: 150px;object-fit: cover;width: 100%;">
                                                <input name="banner" id="upload_banner" class="pis galleryMedia"
                                                    onchange="readImageURL(this);" type="file" accept="image/*">
                                                <input type="hidden" name="position[]" id="mediaBanner">
                                            </label>
                                        </div>
                                    </div> 

                                    @if (request()->segment(2) == 'archive-view-photos')
                                         <div class="col-lg-4">
                                            <div class="plate"><label class="newbtn">
                                                    <img id="blah10"
                                                        class="img-fluid pl-2 pr-2 js_pinupDefaultImage js_galleryMedia"
                                                        src="{{ asset('assets/app/img/add-pinup-banner-full.png') }}"
                                                        style="height: 150px;object-fit: cover;width: 100%;">
                                                    <input name="pinup" id="upload_pinup" class="pis"
                                                        onchange="readImageURL(this);" type="file" accept="image/*">
                                                    <input type="hidden" name="position[]" id="mediaPinup">
                                                </label>
                                            </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            <div class="photo-sec-popup custom-upload-photo" id="image_preview">
                                <a href="#">
                                    <div style="margin-top: -34px;">
                                    </div>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer common-modal-footer">

                        <button type="submit" class="btn-success-modal">Upload</button>
                    </div>
                </div>
            </form>
        
    </div>
</div>

