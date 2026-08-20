<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
            <form id="mulitiImage" method="POST" action="{{ route('escort.upload.gallery') }}"
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
                        </div>
                    </div>
                    <div class="modal-footer common-modal-footer">

                        <button type="submit" class="btn-success-modal">Upload</button>
                    </div>
                </div>
            </form>
        
    </div>
</div>

