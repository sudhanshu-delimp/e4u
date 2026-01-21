<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 900px;position: absolute;">
            <form id="mulitiImage" method="POST" action="{{route('center.upload.gallery')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Upload Photos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                 <label class="newbtn rm">
                                    
                                            <img id="blah" class="item" src="{{ asset('assets/app/img/add-images.png')}}">
                                            
                                            <input name="img[]" id="upload_file" class="pis" onchange="preview_image(event);" type="file" multiple accept="image/*">
                                        </label>
                            </div>
                            <div class="col-lg-6">
                                <div class="{{request()->segment(2) == 'archive-view-photos'?'col-lg-12':'col-lg-12'}}">
                                                    <div class="plate"><label class="newbtn">
                                                        <img id="blah9" class="img-fluid   js_bannerDefaultImage js_galleryMedia" src="{{ asset('assets/app/img/add-banner22.png')}}" >
                                                        <input name="banner" id="upload_banner" class="pis galleryMedia" onchange="readImageURL(this);" type="file" accept="image/*" >
                                                        <input type="hidden" name="position[]" id="mediaBanner">
                                                        </label>
                                                    </div>
                                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="photo-sec-popup custom-upload-photo"  id="image_preview">
                                    
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